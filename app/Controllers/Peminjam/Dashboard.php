<?php

namespace App\Controllers\Peminjam;

use App\Controllers\BaseController;
use App\Models\informasi_barang_model;
use App\Models\kumpulan_barang_dipinjam_model;
use App\Models\lokasi_barang_model;
use App\Models\transaksi_peminjaman_model;

class Dashboard extends BaseController
{
    protected $transaksiPeminjamanModel;
    protected $kumpulanBarangModel;

    //Main Barang Model
    protected $informasiBarangModel;

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

        $this->lokasiBarangModel = new lokasi_barang_model();
    }

    public function index()
    {
        $data = [
            'title' => 'Peminjam | Dashboard',
            'transaksiPeminjaman' => $this->transaksiPeminjamanModel->where(['pengajuan_status' => 2, 'peminjam_fk' => session('username')])->findAll(),
        ];

        return view('peminjam/dashboard', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Riwayat Peminjaman | Detail Peminjaman',
            'informasiBarang' => $this->informasiBarangModel,
            'transaksiPeminjaman' => $this->transaksiPeminjamanModel->getTransaksi($id),
            'kumpulanBarang' => $this->kumpulanBarangModel->getKumpulanBarang($id),
        ];

        return view('peminjam/riwayat-peminjaman/detail', $data);
    }
}
