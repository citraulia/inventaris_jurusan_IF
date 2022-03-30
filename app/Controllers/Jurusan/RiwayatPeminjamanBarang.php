<?php

namespace App\Controllers\Jurusan;

use App\Controllers\BaseController;
use App\Models\informasi_barang_model;
use App\Models\kumpulan_barang_dipinjam_model;
use App\Models\transaksi_peminjaman_model;
use App\Models\user_peminjam_model;

class RiwayatPeminjamanBarang extends BaseController
{
    protected $transaksiPeminjamanModel;
    protected $kumpulanBarangModel;
    protected $informasiBarangModel;
    protected $userPeminjamModel;

    public function __construct()
    {
        if (session()->get('role') != 'Jurusan') {
            echo 'Access denied.';
            exit;
        }

        $this->transaksiPeminjamanModel = new transaksi_peminjaman_model();
        $this->kumpulanBarangModel = new kumpulan_barang_dipinjam_model();
        $this->informasiBarangModel = new informasi_barang_model();
        $this->userPeminjamModel = new user_peminjam_model();
    }

    public function index()
    {
        $data = [
            'title' => 'Jurusan | Riwayat Peminjaman Barang',
            'transaksiPeminjaman' => $this->transaksiPeminjamanModel->getTransaksi(),
        ];

        return view('jurusan/riwayat-peminjaman-barang/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Riwayat Peminjaman | Detail Peminjaman',
            'informasiBarang' => $this->informasiBarangModel,
            'transaksiPeminjaman' => $this->transaksiPeminjamanModel->getTransaksi($id),
            'kumpulanBarang' => $this->kumpulanBarangModel->getKumpulanBarang($id),
        ];

        return view('jurusan/riwayat-peminjaman-barang/detail', $data);
    }

    public function setujui($id)
    {
        $this->transaksiPeminjamanModel->save([
            'transaksi_id' => $id,
            'jurusan_fk' => session('username'),
            'pengajuan_status' => 1,
            'peminjaman_status' => 1,
        ]);

        $kumpulanBarang = $this->kumpulanBarangModel->getKumpulanBarang($id);
        foreach ($kumpulanBarang as $barangPinjaman) {
            $barang = $this->informasiBarangModel->getInformasiBarang($barangPinjaman['barang_dipinjam_fk']);
            $this->informasiBarangModel->save([
                'barang_id' => $barang['barang_id'],
                'barang_status' => 2,
                'barang_dipinjamkan' => 0,
            ]);
        }

        session()->setFlashdata('pesan', "Pengajuan Peminjaman Barang berhasil disetujui.");

        return redirect()->to("jurusan/peminjaman");
    }

    public function tolak($id)
    {
        $this->transaksiPeminjamanModel->save([
            'transaksi_id' => $id,
            'jurusan_fk' => session('username'),
            'pengajuan_status' => 0,
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

        session()->setFlashdata('pesan', "Pengajuan Peminjaman Barang Ditolak.");

        return redirect()->to("jurusan/peminjaman");
    }

    public function dikembalikan($id)
    {
        $this->transaksiPeminjamanModel->save([
            'transaksi_id' => $id,
            'jurusan_fk' => session('username'),
            'peminjaman_status' => 1,
        ]);

        $kumpulanBarang = $this->kumpulanBarangModel->getKumpulanBarang($id);
        foreach ($kumpulanBarang as $barangPinjaman) {
            $barang = $this->informasiBarangModel->getInformasiBarang($barangPinjaman['barang_dipinjam_fk']);
            $this->informasiBarangModel->save([
                'barang_id' => $barang['barang_id'],
                'barang_status' => 1,
                'barang_dipinjamkan' => 0,
            ]);
        }

        session()->setFlashdata('pesan', "Konfirmasi bahwa Barang sudah Dikembalikan Berhasil.");

        return redirect()->to("jurusan/peminjaman");
    }
}
