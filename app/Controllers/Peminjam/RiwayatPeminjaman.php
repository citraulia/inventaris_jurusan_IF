<?php

namespace App\Controllers\Peminjam;

use App\Controllers\BaseController;
use App\Controllers\Functions\MultiCellsTable;
use App\Models\informasi_barang_model;
use App\Models\kumpulan_barang_dipinjam_model;
use App\Models\lokasi_barang_model;
use App\Models\transaksi_peminjaman_model;
use App\Models\user_jurusan_model;
use App\Models\user_peminjam_model;
use FPDF;

class RiwayatPeminjaman extends BaseController
{
    protected $transaksiPeminjamanModel;
    protected $kumpulanBarangModel;

    //Main Barang Model
    protected $informasiBarangModel;

    // Users
    protected $userJurusanModel;
    protected $userPeminjamModel;

    //Keterangan
    protected $lokasiBarangModel;

    public function __construct()
    {
        if (session()->get('role') != 'Peminjam') {
            echo 'Access denied.';
            exit;
        }

        $this->transaksiPeminjamanModel = new transaksi_peminjaman_model();
        $this->kumpulanBarangModel = new kumpulan_barang_dipinjam_model();

        $this->informasiBarangModel = new informasi_barang_model();

        $this->userJurusanModel = new user_jurusan_model();
        $this->userPeminjamModel = new user_peminjam_model();

        $this->lokasiBarangModel = new lokasi_barang_model();
    }

    public function index($username)
    {
        if (session()->get('username') != $username) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

        $data = [
            'title' => 'Peminjam | Riwayat Peminjaman',
            'transaksiPeminjaman' => $this->transaksiPeminjamanModel->getUserTransaksi($username),
        ];

        return view('peminjam/riwayat-peminjaman/index', $data);
    }

    public function detail($id)
    {
        $transaksi = $this->transaksiPeminjamanModel->getTransaksi($id);

        if (session()->get('username') != $transaksi['peminjam_fk']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

        $data = [
            'title' => 'Riwayat Peminjaman | Detail Peminjaman',
            'informasiBarang' => $this->informasiBarangModel,
            'transaksiPeminjaman' => $transaksi,
            'kumpulanBarang' => $this->kumpulanBarangModel->where('transaksi_fk', $id)->findAll(),
        ];

        return view('peminjam/riwayat-peminjaman/detail', $data);
    }

    public function batal($username, $id)
    {
        if (session()->get('username') != $username) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

        $this->transaksiPeminjamanModel->save([
            'transaksi_id' => $id,
            'pengajuan_status' => -1,
            'peminjaman_status' => -1,
        ]);

        $kumpulanBarang = $this->kumpulanBarangModel->getKumpulanBarang($id);
        foreach ($kumpulanBarang as $barangPinjaman) {
            $barang = $this->informasiBarangModel->getInformasiBarang($barangPinjaman['barang_dipinjam_fk']);
            $this->informasiBarangModel->save([
                'barang_id' => $barang['barang_id'],
                'barang_status' => 1,
                'barang_dipinjamkan' => 1,
            ]);
        }

        session()->setFlashdata('pesan', "Pengajuan Peminjaman Barang Berhasil Dibatalkan.");

        return redirect()->to('peminjam/riwayatpeminjaman/' . session('username'));
    }

    public function printSurat($username, $id)
    {
        $riwayatPeminjaman = $this->transaksiPeminjamanModel->getTransaksi($id);
        $kumpulanBarang = $this->kumpulanBarangModel->getKumpulanBarang($id);
        $peminjam = $this->userPeminjamModel->where(['peminjam_username' => $riwayatPeminjaman['peminjam_fk']])->first();
        $kajur = $this->userJurusanModel->where(['user_level' => '1'])->first();

        if (session()->get('username') != $username || $riwayatPeminjaman['pengajuan_status'] != 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

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
        $pdf->Cell(0, 7, 'SURAT IZIN PEMINJAMAN BARANG', 0, 1, 'C');
        $pdf->Line(67, 56, $width - 67, 56);
        $pdf->Cell(0, 5, '', 0, 1);

        // Keterangan Peminjam
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(23, 6, "Peminjam    : ", 0, 0, 'L');
        $pdf->Cell(73, 6, $peminjam['peminjam_nama'], 0, 0, 'J');
        $pdf->Cell(40, 6, "Tanggal Peminjaman    : ", 0, 0, 'L');
        $pdf->Cell(0, 6, date('d M Y', strtotime($riwayatPeminjaman['tanggal_peminjaman'])), 0, 1, 'L');
        $pdf->Cell(23, 6, 'Nomor HP.  :', 0, 0, 'L');
        $pdf->Cell(73, 6, $peminjam['peminjam_hp'], 0, 0, 'J');
        $pdf->Cell(40, 6, "Tanggal Pengembalian  : ", 0, 0, 'L');
        $pdf->Cell(0, 6, date('d M Y', strtotime($riwayatPeminjaman['tanggal_pengembalian'])), 0, 1, 'L');
        $pdf->Cell(0, 7, '', 0, 1);

        // Kumpulan Barang yang Dipinjam
        $pdf->Cell(0, 7, 'Kumpulan Barang Jurusan Teknik Informatika yang akan Dipinjam: ', 0, 1, 'L');
        $pdf->Cell(0, 2, '', 0, 1);

        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(11, 6, 'No.', 1, 0, 'C');
        $pdf->Cell(47, 6, 'Nama Barang', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Merk Barang', 1, 0, 'C');
        $pdf->Cell(33, 6, 'Keadaan Barang', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Lokasi Barang', 1, 1, 'C');

        $pdf->SetFont('Times', '', 9);
        $no = 0;
        $pdf->SetWidths(array(11, 47, 25, 33, 45));
        foreach ($kumpulanBarang as $value) {
            $barang = $this->informasiBarangModel->getInformasiBarang($value['barang_dipinjam_fk']);
            $no++;
            $pdf->Row(array($no, $barang['barang_nama'], $barang['barang_merk'], $barang['barang_keadaan'], $barang['lokasi_fk']));
        }

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->Cell(0, 7, "Bandung, ..............................", 0, 1, 'R');

        $pdf->Cell(0, 7, "Mengetahui,", 0, 1, 'L');
        $pdf->Cell(0, 2, "Ketua Jurusan Teknik Informatika, ", 0, 0, 'L');
        $pdf->Cell(0, 2, "Peminjam Barang, ", 0, 1, 'R');
        $pdf->Cell(10, 15, '', 0, 1);
        $pdf->Cell(0, 7, $kajur['user_nama'], 0, 0, 'L');
        $pdf->Cell(0, 7, $peminjam['peminjam_nama'], 0, 1, 'R');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 4, "NIP. " . $kajur['user_nip'], 0, 1, 'L');

        $pdf->Output();
        exit();
    }
}
