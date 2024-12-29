<?php

namespace App\Controllers\Peminjam;

use App\Controllers\BaseController;
use App\Models\informasi_barang_model;
use App\Models\kumpulan_barang_dipinjam_model;
use App\Models\lokasi_barang_model;
use App\Models\transaksi_peminjaman_model;

class PinjamBarang extends BaseController
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
            'title' => 'Peminjam | Pinjam Barang',
            'informasiBarang' => $this->informasiBarangModel->getDipinjamkan(),
            'validation' => \Config\Services::validation(),
        ];

        return view('peminjam/pinjam-barang/index', $data);
    }

    public function ajukan()
    {
        // Validasi input
        if (!$this->validate([
            'pinjam' => 'required',
            'kembali' => 'required',
        ])) {
            return redirect()->to('peminjam/pinjambarang')->withInput();
        }

        if ($this->request->getVar('kode') == null) {
            session()->setFlashdata('pesan', 'Tidak ada Barang yang Anda pinjam.');
            return redirect()->to('peminjam/pinjambarang');
        }

        // Insert Transaksi Barang
        $this->transaksiPeminjamanModel->save([
            'peminjam_fk' => session('username'),
            'tanggal_peminjaman' => $this->request->getVar('pinjam'),
            'tanggal_pengembalian' => $this->request->getVar('kembali'),
            'jurusan_fk' => 'ketuajurusan',
        ]);

        $idTransaksi = $this->transaksiPeminjamanModel->getInsertID();

        // Masukan kumpulan barang yang Dipinjam.
        foreach ($this->request->getVar('kode') as $kodeBarang) {
            $barang = $this->informasiBarangModel->getInformasiBarang($kodeBarang);
            $this->informasiBarangModel->save([
                'barang_id' => $barang['barang_id'],
                'barang_status' => 2,
                'barang_dipinjamkan' => 0,
            ]);

            $this->kumpulanBarangModel->save([
                'barang_dipinjam_fk' => $kodeBarang,
                'transaksi_fk' => $idTransaksi,
            ]);
        }

        session()->setFlashdata('pesan', 'Peminjaman barang berhasil diajukan.');

        return redirect()->to('peminjam/riwayatpeminjaman/' . session('username'));
    }
}
