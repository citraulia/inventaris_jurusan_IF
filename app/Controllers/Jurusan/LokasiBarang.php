<?php

namespace App\Controllers\Jurusan;

use App\Controllers\BaseController;
use App\Controllers\Functions\MultiCellsTable;
use App\Models\informasi_barang_model;
use App\Models\kepala_bagian_tu_model;
use App\Models\lokasi_barang_model;
use App\Models\user_jurusan_model;
use FPDF;

class LokasiBarang extends BaseController
{
    protected $lokasiBarang;
    protected $kepalaBagianTUModel;

    protected $informasiBarangModel;
    protected $userJurusanModel;

    public function __construct()
    {
        if (session()->get('role') != 'Jurusan') {
            echo 'Access denied.';
            exit;
        }

        $this->lokasiBarangModel = new lokasi_barang_model();
        $this->kepalaBagianTUModel = new kepala_bagian_tu_model();

        $this->informasiBarangModel = new informasi_barang_model();
        $this->userJurusanModel = new user_jurusan_model();
    }

    public function index()
    {
        $lokasiBarang = $this->lokasiBarangModel;
        //$informasiBarang = $this->informasiBarangModel;

        $data = [
            'title' => 'Jurusan | Lokasi Barang',
            'lokasiBarang' => $lokasiBarang->getLokasiBarang(),
            'kepalaBagianTU' => $this->kepalaBagianTUModel->findAll(),
            'informasiBarang' => $this->informasiBarangModel,
        ];

        return view('jurusan/lokasi-barang/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Lokasi Barang | Detail Ruangan',
            'lokasiBarang' => $this->lokasiBarangModel->getLokasiBarang($slug)
        ];

        //Jika User tidak tidak ada dalam tabel
        if (empty($data['lokasiBarang'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kode lokasi ' . strtoupper($slug) . ' tidak ditemukan.');
        }

        return view('jurusan/lokasi-barang/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => "Lokasi Barang | Tambah Lokasi",
            'validation' => \Config\Services::validation()
        ];

        return view('jurusan/lokasi-barang/create', $data);
    }

    public function save()
    {
        //Validasi input
        if (!$this->validate([
            'kode' => 'required|is_unique[lokasi_barang.lokasi_kode]',
            'nama' => 'required',
            'lantai' => 'required',
            'fakultas' => 'required',
        ])) {
            return redirect()->to('/jurusan/lokasibarang/create')->withInput();
        }

        $slug = url_title($this->request->getVar('kode'), '', true);
        $this->lokasiBarangModel->save([
            'lokasi_kode' => $this->request->getVar('kode'),
            'lokasi_slug' => $slug,
            'lokasi_nama' => $this->request->getVar('nama'),
            'lokasi_lantai' => $this->request->getVar('lantai'),
            'lokasi_fakultas' => $this->request->getVar('fakultas'),
            'lokasi_keterangan' => $this->request->getVar('keterangan')
        ]);

        session()->setFlashdata('pesan', 'Data "' . $this->request->getVar('kode') . '" berhasil ditambahkan.');

        return redirect()->to("/jurusan/lokasibarang");
    }

    public function edit($slug)
    {
        $data = [
            'title' => "Lokasi Barang | Edit Info Ruangan",
            'validation' => \Config\Services::validation(),
            'lokasiBarang' => $this->lokasiBarangModel->getLokasiBarang($slug)
        ];

        return view('jurusan/lokasi-barang/edit', $data);
    }

    public function update($id)
    {
        //Cek Kode
        $kodeLama = $this->lokasiBarangModel->getLokasiBarang($this->request->getVar('slug'));
        if ($kodeLama['lokasi_kode'] == $this->request->getVar(('kode'))) {
            $ruleKode = 'required';
        } else {
            $ruleKode = 'required|is_unique[lokasi_barang.lokasi_kode]';
        }

        //Validasi input
        if (!$this->validate([
            'kode' => $ruleKode,
            'nama' => 'required',
            'lantai' => 'required',
            'fakultas' => 'required',
        ])) {
            return redirect()->to('/jurusan/lokasibarang/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('kode'), '', true);
        $this->lokasiBarangModel->save([
            'lokasi_id' => $id,
            'lokasi_slug' => $slug,
            'lokasi_kode' => $this->request->getVar('kode'),
            'lokasi_nama' => $this->request->getVar('nama'),
            'lokasi_lantai' => $this->request->getVar('lantai'),
            'lokasi_fakultas' => $this->request->getVar('fakultas'),
            'lokasi_keterangan' => $this->request->getVar('keterangan')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to("/jurusan/lokasibarang");
    }

    public function updateTU()
    {
        $this->kepalaBagianTUModel->save([
            'tu_id' => 1,
            'tu_nama' => $this->request->getVar('nama'),
            'tu_nip' => $this->request->getVar('nip'),
        ]);

        session()->setFlashdata('pesan', 'Data Kepala Bagian TU berhasil diubah.');

        return redirect()->to("/jurusan/lokasibarang");
    }

    public function print($kode)
    {
        $namaLokasi = $this->lokasiBarangModel->where(['lokasi_kode' => $kode])->findAll();
        $barang = $this->informasiBarangModel->where(['lokasi_fk' => $kode])->where(['barang_status' => '1'])->findAll();
        $kajur = $this->userJurusanModel->where(['user_level' => '1'])->findAll();
        $kepalaTU = $this->kepalaBagianTUModel->findAll();
        $namaBarang = array(); // Berisikan masing-masing nama barang yang ada pada tabel Informasi Barang maksimal 1 buah.

        $pdf = new MultiCellsTable();
        $pdf->SetMargins(25.4, 3, 25.4);
        $pdf->AddPage();
        $width = $pdf->GetPageWidth(); // Width of Current Page
        $height = $pdf->GetPageHeight(); // Height of Current Page

        $pdf->SetFont('Times', 'B', 14);
        $pdf->SetAutoPageBreak(true);

        // Header
        $pdf->Cell(0, 7, 'KEMENTRIAN AGAMA', 0, 1, 'C');
        $pdf->Cell(0, 7, 'UNIVERSITAS ISLAM NEGERI', 0, 1, 'C');
        $pdf->SetFont('Times', 'B', 13);
        $pdf->Cell(0, 7, 'SUNAN GUNUNG DJATI BANDUNG', 0, 1, 'C');
        $pdf->Cell(0, 7, 'FAKULTAS SAINS DAN TEKNOLOGI', 0, 1, 'C');
        $pdf->Cell(0, 7, 'JURUSAN TEKNIK INFORMATIKA', 0, 1, 'C');
        $pdf->Line(25.4, 40, $width - 25.4, 40);

        // Alamat Kampus
        $pdf->SetFont('Times', '', 8);
        $pdf->Cell(0, 9, '
                    Jalan A.H. Nasution No. 105 Cibiru - Bandung 40614 Telp. (022) 7800525 Fax. (022) 7803936 web: http://www.fst.uinsgd.ac.id
                    ', 0, 1, 'C');
        $pdf->Line(25.4, 45, $width - 25.4, 45);
        $pdf->Cell(0, 3, '', 0, 1);

        // Judul Surat
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 7, 'DAFTAR BARANG RUANGAN', 0, 1, 'C');
        $pdf->Line(72, 56, $width - 72, 56);
        $pdf->Cell(0, 5, '', 0, 1);

        $pdf->SetFont('Times', 'B', 9);
        $pdf->Cell(95, 6, 'Nomor UPB : UIN SGD Bandung', 0, 0, 'L');
        $pdf->Cell(25, 6, 'Nama Ruangan  :', 0, 0, 'L');
        $pdf->MultiCell(0, 6, $namaLokasi[0]['lokasi_nama'], 0, 'J');
        $pdf->Cell(95, 6, 'Kode UPB    : ', 0, 0, 'L');
        $pdf->Cell(10, 6, 'Kode Ruangan   : ' . $kode, 0, 1, 'L');
        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Times', 'B', 9);
        $pdf->Cell(7, 6, 'No.', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Nama Barang', 1, 0, 'C');
        $pdf->Cell(15, 6, 'Jumlah', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Merk Barang', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Keadaan Barang', 1, 0, 'C');
        $pdf->Cell(29, 6, 'Tahun Perolehan', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Ket.', 1, 1, 'C');

        $pdf->SetFont('Times', '', 9);

        $no = 0;
        $pdf->SetWidths(array(7, 30, 15, 25, 30, 29, 25));
        foreach ($barang as $value) {
            if (in_array($value['barang_nama'], $namaBarang)) {
                continue;
            } else {
                array_push($namaBarang, $value['barang_nama']);
                $jumlah = Count($this->informasiBarangModel->where(['barang_nama' => $value['barang_nama']])->where(['barang_status' => '1'])->findAll());

                $no++;
                $pdf->Row(array($no, $value['barang_nama'], $jumlah, $value['barang_merk'], $value['barang_keadaan'], $value['barang_tahun_perolehan'], $value['barang_keterangan']));
            }
        }

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->Cell(0, 7, "Bandung, " . date("d F Y"), 0, 1, 'R');

        $pdf->Cell(0, 7, "Mengetahui,", 0, 1, 'L');
        $pdf->Cell(0, 7, "Penanggung Jawab UAKPB", 0, 1, 'L');
        $pdf->Cell(0, 2, "Kepala Bagian TU, ", 0, 0, 'L');
        $pdf->Cell(0, 2, "Ketua Jurusan Teknik Informatika, ", 0, 1, 'R');
        $pdf->Cell(10, 15, '', 0, 1);
        $pdf->Cell(0, 7, $kepalaTU[0]['tu_nama'], 0, 0, 'L');
        $pdf->Cell(0, 7, $kajur[0]['user_nama'], 0, 1, 'R');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 4, "NIP. " . $kepalaTU[0]['tu_nip'], 0, 0, 'L');
        $pdf->Cell(0, 4, "NIP. " . $kajur[0]['user_nip'], 0, 1, 'R');


        $pdf->Output();
        exit();
    }

    //--------------------------------------------------------------------
}
