<?php

namespace App\Controllers\Jurusan;

use App\Controllers\BaseController;
use App\Models\foto_barang_model;
use App\Models\foto_pending_model;
use App\Models\informasi_barang_model;
use App\Models\informasi_barang_pending_model;
use App\Models\jenis_pengelolaan_model;
use App\Models\kategori_barang_model;
use App\Models\lokasi_barang_model;
use App\Models\pengelolaan_barang_model;
use CodeIgniter\HTTP\Files\UploadedFile;

class InformasiBarang extends BaseController
{
    //Main Barang Model
    protected $informasiBarangModel;
    protected $fotoBarangModel;

    //Pending Model
    protected $barangPendingModel;
    protected $fotoPendingModel;

    //Keterangan
    protected $kategoriBarangModel;
    protected $lokasiBarangModel;
    protected $pengelolaanModel;
    protected $jenisPengelolaanModel;

    public function __construct()
    {
        if (session()->get('role') != 'Jurusan') {
            echo 'Access denied.';
            exit;
        }


        $this->informasiBarangModel = new informasi_barang_model();
        $this->fotoBarangModel = new foto_barang_model();

        $this->barangPendingModel = new informasi_barang_pending_model();
        $this->fotoPendingModel = new foto_pending_model();

        $this->kategoriBarangModel = new kategori_barang_model();
        $this->lokasiBarangModel = new lokasi_barang_model();
        $this->pengelolaanModel = new pengelolaan_barang_model();
        $this->jenisPengelolaanModel = new jenis_pengelolaan_model();
    }

    public function index()
    {
        $data = [
            'title' => 'Jurusan | Informasi Barang',
            'informasiBarang' => $this->informasiBarangModel->getInformasiBarang(),
            'statusBarang' => $this->informasiBarangModel,
        ];

        return view('jurusan/informasi-barang/index', $data);
    }

    public function detail($kode)
    {
        $data = [
            'title' => 'Informasi Barang | Detail Barang',
            'informasiBarang' => $this->informasiBarangModel->getInformasiBarang($kode),
            'lokasiBarang' => $this->lokasiBarangModel,
            'fotoBarang' => $this->fotoBarangModel->getFoto($kode),
        ];

        // Jika user tidak ditemukan
        if (empty($data['informasiBarang'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Barang dengan kode ' . $kode . ' tidak ditemukan.');
        }

        return view('jurusan/informasi-barang/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Informasi Barang | Tambah Barang',
            'kategoriBarang' => $this->kategoriBarangModel->getKategoriBarang(),
            'lokasiBarang' => $this->lokasiBarangModel->getLokasiBarang(),
            'validation' => \Config\Services::validation()
        ];

        return view('jurusan/informasi-barang/create', $data);
    }

    public function save()
    {
        $jenisPengelolaan = $this->jenisPengelolaanModel->where(['jenis_nama' => 'TAMBAH'])->findAll();

        // Validasi input
        if (!$this->validate([
            'nama' => 'required',
            'kategori' => 'required',
            //'merk' => 'required',
            'lokasi' => 'required',
            //'deskripsi' => 'required',
            'keadaan' => 'required',
            //'tahun' => 'required',
            //'harga' => 'required',
            //'keterangan' => 'required',
            'dipinjamkan' => 'required',
            'foto' => 'uploaded[foto]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->to('/jurusan/informasibarang/create')->withInput();
        }

        // Insert barang pending
        $this->barangPendingModel->save([
            'pending_nama' => $this->request->getVar('nama'),
            'kategori_fk' => $this->request->getVar('kategori'),
            'pending_merk' => $this->request->getVar('merk'),
            'pending_deskripsi' => $this->request->getVar('deskripsi'),
            'pending_tahun_perolehan' => $this->request->getVar('tahun'),
            'pending_keadaan' => $this->request->getVar('keadaan'),
            'pending_harga' => $this->request->getVar('harga'),
            'lokasi_fk' => $this->request->getVar('lokasi'),
            'pending_keterangan' => $this->request->getVar('keterangan'),
            'pending_dipinjamkan' => $this->request->getVar('dipinjamkan'),
        ]);

        // Buat kode barang pending
        $idPending = $this->barangPendingModel->getInsertID();
        $createKodePending = $this->barangPendingModel->createKode($this->request->getVar('kategori'), $this->request->getVar('lokasi'), $this->request->getVar('nama'), $idPending);
        $kodePending = url_title($createKodePending, '-', true);

        $this->barangPendingModel->save([
            'pending_id' => $idPending,
            'pending_kode' => $kodePending,
        ]);

        // Buat kode pengelolaan
        $createKodePengelolaan = $this->pengelolaanModel->createKode($jenisPengelolaan[0]['jenis_nama'], $kodePending);
        $kodePengelolaan = url_title($createKodePengelolaan, '-', true);

        // Insert Kode Barang Pending dan Pengelolaan
        $this->pengelolaanModel->save([
            'pengelolaan_kode' => $kodePengelolaan,
            'pending_fk' => $kodePending,
            'user_fk' => session('username'),
            'pengelolaan_tanggal' => date("Y-m-d"),
            'jenis_fk' => $jenisPengelolaan[0]['jenis_nama'],
        ]);

        //Ambil foto dan namanya
        if ($this->request->getFileMultiple('foto')) {
            foreach ($this->request->getFileMultiple('foto') as $fileFoto) {
                $fileFoto->move('img');

                $fotoNama = $fileFoto->getName();
                $this->fotoPendingModel->save([
                    'pending_fk' => $kodePending,
                    'foto_pending_nama' => $fotoNama,
                ]);
            }
        }

        session()->setFlashdata('pesan', 'Penambahan data "' . $this->request->getVar('nama') . '" berhasil diajukan.');

        return redirect()->to('/jurusan/informasibarang');
    }

    public function edit($kode)
    {
        $data = [
            'title' => 'Informasi Barang | Edit Barang',
            'informasiBarang' => $this->informasiBarangModel->getInformasiBarang($kode),
            'kategoriBarang' => $this->kategoriBarangModel->getKategoriBarang(),
            'lokasiBarang' => $this->lokasiBarangModel->getLokasiBarang(),
            'validation' => \Config\Services::validation()
        ];

        return view('jurusan/informasi-barang/edit', $data);
    }

    public function update($id)
    {
        $jenisPengelolaan = $this->jenisPengelolaanModel->where(['jenis_nama' => 'UBAH'])->findAll();

        $uploaded_file = $this->request->getFileMultiple('foto');
        if ($uploaded_file[0]->getName() == "") {
            // Validasi input
            if (!$this->validate([
                'nama' => 'required',
                'kategori' => 'required',
                //'merk' => 'required',
                'lokasi' => 'required',
                //'deskripsi' => 'required',
                'keadaan' => 'required',
                //'tahun' => 'required',
                //'harga' => 'required',
                //'keterangan' => 'required',
                'dipinjamkan' => 'required',
            ])) {
                return redirect()->to('/jurusan/informasibarang/edit/' . $this->request->getVar('kode'))->withInput();
            }
        } else {
            if (!$this->validate([
                'nama' => 'required',
                'kategori' => 'required',
                //'merk' => 'required',
                'lokasi' => 'required',
                //'deskripsi' => 'required',
                'keadaan' => 'required',
                //'tahun' => 'required',
                //'harga' => 'required',
                //'keterangan' => 'required',
                'dipinjamkan' => 'required',
                'foto' => 'uploaded[foto]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
            ])) {
                return redirect()->to('/jurusan/informasibarang/edit/' . $this->request->getVar('kode'))->withInput();
            }
        }

        // Insert barang pending
        $this->barangPendingModel->save([
            'pending_nama' => $this->request->getVar('nama'),
            'kategori_fk' => $this->request->getVar('kategori'),
            'pending_merk' => $this->request->getVar('merk'),
            'pending_deskripsi' => $this->request->getVar('deskripsi'),
            'pending_tahun_perolehan' => $this->request->getVar('tahun'),
            'pending_keadaan' => $this->request->getVar('keadaan'),
            'pending_harga' => $this->request->getVar('harga'),
            'lokasi_fk' => $this->request->getVar('lokasi'),
            'pending_keterangan' => $this->request->getVar('keterangan'),
            'pending_dipinjamkan' => $this->request->getVar('dipinjamkan'),
        ]);

        // Buat kode barang pending
        $idPending = $this->barangPendingModel->getInsertID();
        $createKodePending = $this->barangPendingModel->createKode($this->request->getVar('kategori'), $this->request->getVar('lokasi'), $this->request->getVar('nama'), $idPending);
        $kodePending = url_title($createKodePending, '-', true);

        $this->barangPendingModel->save([
            'pending_id' => $idPending,
            'pending_kode' => $kodePending,
        ]);

        // Buat kode pengelolaan
        $createKodePengelolaan = $this->pengelolaanModel->createKode($jenisPengelolaan[0]['jenis_nama'], $kodePending);
        $kodePengelolaan = url_title($createKodePengelolaan, '-', true);

        // Insert Kode Barang Pending dan Pengelolaan
        $this->pengelolaanModel->save([
            'pengelolaan_kode' => $kodePengelolaan,
            'barang_fk' => $this->request->getVar('kode'),
            'pending_fk' => $kodePending,
            'user_fk' => session('username'),
            'pengelolaan_tanggal' => date("Y-m-d"),
            'jenis_fk' => $jenisPengelolaan[0]['jenis_nama'],
        ]);

        //Ambil foto dan namanya
        if ($uploaded_file[0]->getName() != "") {
            if ($this->request->getFileMultiple('foto')) {
                foreach ($this->request->getFileMultiple('foto') as $fileFoto) {
                    $fileFoto->move('img');

                    $fotoNama = $fileFoto->getName();
                    $this->fotoPendingModel->save([
                        'pending_fk' => $kodePending,
                        'foto_pending_nama' => $fotoNama,
                    ]);
                }
            }
        }

        $this->informasiBarangModel->save([
            'barang_id' => $id,
            'barang_status' => 0,
        ]);

        session()->setFlashdata('pesan', 'Perubahan data "' . $this->request->getVar('nama') . '" berhasil diajukan.');

        return redirect()->to('/jurusan/informasibarang');
    }

    // Delete Image Method
    public function deleteImgPage($kode)
    {
        $data = [
            'title' => 'Informasi Barang | Foto Barang',
            'informasiBarang' => $this->informasiBarangModel->getInformasiBarang($kode),
            'fotoBarang' => $this->fotoBarangModel->getFoto($kode),
        ];

        // Jika user tidak ditemukan
        if (empty($data['informasiBarang'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Foto pada Barang dengan kode ' . $kode . ' tidak ditemukan.');
        }

        return view('jurusan/informasi-barang/delete_img', $data);
    }

    public function deleteImg($fotoId)
    {
        $foto = $this->fotoBarangModel->find($fotoId);

        $fotoNama = $foto['foto_nama'];
        $fotoPending = $this->fotoPendingModel->where(['foto_pending_nama' => $fotoNama])->first();

        unlink('img/' . $fotoNama);

        $this->fotoBarangModel->delete($foto['foto_id']);
        $this->fotoPendingModel->delete($fotoPending['foto_pending_id']);

        return redirect()->to('/jurusan/informasibarang/' . $this->request->getVar('kode'));
    }
    // End Delete Image Method

    public function delete($id)
    {
        $jenisPengelolaan = $this->jenisPengelolaanModel->where(['jenis_nama' => 'HAPUS'])->findAll();
        $barangOriginal = $this->informasiBarangModel->getInformasiBarang($this->request->getVar('kode'));

        // Insert barang pending
        $this->barangPendingModel->save([
            'pending_nama' => $barangOriginal['barang_nama'],
            'kategori_fk' => $barangOriginal['kategori_fk'],
            'pending_merk' => $barangOriginal['barang_merk'],
            'pending_deskripsi' => $barangOriginal['barang_deskripsi'],
            'pending_tahun_perolehan' => $barangOriginal['barang_tahun_perolehan'],
            'pending_keadaan' => $barangOriginal['barang_keadaan'],
            'pending_harga' => $barangOriginal['barang_harga'],
            'lokasi_fk' => $barangOriginal['lokasi_fk'],
            'pending_keterangan' => $barangOriginal['barang_keterangan'],
            'pending_status' => 0,
            'pending_dipinjamkan' => 0,
        ]);

        // Buat kode barang pending
        $idPending = $this->barangPendingModel->getInsertID();
        $createKodePending = $this->barangPendingModel->createKode($barangOriginal['kategori_fk'], $barangOriginal['lokasi_fk'], $barangOriginal['barang_nama'], $idPending);
        $kodePending = url_title($createKodePending, '-', true);

        $this->barangPendingModel->save([
            'pending_id' => $idPending,
            'pending_kode' => $kodePending,
        ]);

        // Buat kode pengelolaan
        $createKodePengelolaan = $this->pengelolaanModel->createKode($jenisPengelolaan[0]['jenis_nama'], $kodePending);
        $kodePengelolaan = url_title($createKodePengelolaan, '-', true);

        // Insert Kode Barang Pending dan Pengelolaan
        $this->pengelolaanModel->save([
            'pengelolaan_kode' => $kodePengelolaan,
            'barang_fk' => $barangOriginal['barang_kode'],
            'pending_fk' => $kodePending,
            'user_fk' => session('username'),
            'pengelolaan_tanggal' => date("Y-m-d"),
            'jenis_fk' => $jenisPengelolaan[0]['jenis_nama'],
            'pengelolaan_keterangan' => $this->request->getVar('keteranganPenghapusan')
        ]);

        //Pindahkan Foto
        $fotoOriginal = $this->fotoBarangModel->getFoto($barangOriginal['barang_kode']);
        if ($fotoOriginal) {
            foreach ($fotoOriginal as $foto) {
                $fotoNama = $foto['foto_nama'];
                $this->fotoPendingModel->save([
                    'pending_fk' => $kodePending,
                    'foto_pending_nama' => $fotoNama,
                ]);
            }
        }

        $this->informasiBarangModel->save([
            'barang_id' => $id,
            'barang_status' => 0,
        ]);

        session()->setFlashdata('pesan', 'Penghapusan data "' . $barangOriginal['barang_nama'] . '" berhasil diajukan.');

        return redirect()->to("/jurusan/riwayatpengelolaanbarang");
    }
}
