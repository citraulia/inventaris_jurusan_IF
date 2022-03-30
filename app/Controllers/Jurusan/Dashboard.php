<?php

namespace App\Controllers\Jurusan;

use App\Controllers\BaseController;
use App\Models\informasi_barang_model;
use App\Models\informasi_barang_pending_model;
use App\Models\pengelolaan_barang_model;
use App\Models\transaksi_peminjaman_model;

class Dashboard extends BaseController
{
    protected $pengelolaanModel;
    protected $transaksiPeminjamanModel;
    protected $informasiBarangModel;
    protected $barangPendingModel;

    public function __construct()
    {
        if (session()->get('role') != 'Jurusan') {
            echo 'Access denied.';
            exit;
        }

        $this->pengelolaanModel = new pengelolaan_barang_model();
        $this->transaksiPeminjamanModel = new transaksi_peminjaman_model();
        $this->informasiBarangModel = new informasi_barang_model();
        $this->barangPendingModel = new informasi_barang_pending_model();
    }

    public function index()
    {
        $data = [
            'title' => 'Jurusan | Dashboard',
            'pengelolaanBarang' => $this->pengelolaanModel->where(['pengelolaan_status' => 2])->findAll(),
            'transaksiPeminjaman' => $this->transaksiPeminjamanModel->where(['pengajuan_status' => 2])->findAll(),
            'barangOri' => $this->informasiBarangModel,
            'barangPending' => $this->barangPendingModel,
        ];

        return view('jurusan/dashboard', $data);
    }
}
