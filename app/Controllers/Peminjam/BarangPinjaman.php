<?php

namespace App\Controllers\Peminjam;

use App\Controllers\BaseController;
use App\Models\foto_barang_model;
use App\Models\informasi_barang_model;
use App\Models\lokasi_barang_model;

class BarangPinjaman extends BaseController
{
    //Main Barang Model
    protected $informasiBarangModel;
    protected $fotoBarangModel;

    //Keterangan
    protected $kategoriBarangModel;
    protected $lokasiBarangModel;

    public function __construct()
    {
        if (session()->get('role') != 'Peminjam') {
            echo 'Access denied.';
            exit;
        }

        $this->informasiBarangModel = new informasi_barang_model();
        $this->fotoBarangModel = new foto_barang_model();

        $this->lokasiBarangModel = new lokasi_barang_model();
    }

    public function index()
    {
        $data = [
            'title' => 'Peminjam | Barang Pinjaman',
            'informasiBarang' => $this->informasiBarangModel->getDipinjamkan(),
        ];

        return view('peminjam/barang-pinjaman/index', $data);
    }

    public function detail($kode)
    {
        $data = [
            'title' => 'Barang Pinjaman | Detail Barang',
            'informasiBarang' => $this->informasiBarangModel->getInformasiBarang($kode),
            'lokasiBarang' => $this->lokasiBarangModel,
            'fotoBarang' => $this->fotoBarangModel->getFoto($kode),
        ];

        // Jika user tidak ditemukan
        if (empty($data['informasiBarang'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Barang dengan kode ' . $kode . ' tidak ditemukan.');
        }

        return view('peminjam/barang-pinjaman/detail', $data);
    }
}
