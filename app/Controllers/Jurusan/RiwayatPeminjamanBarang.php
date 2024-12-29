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

    public function setujuiBarang()
    {
        $transaksiId = $this->request->getPost('transaksi_id');
        $barangId = $this->request->getPost('barang_id');

        if (!$transaksiId || !$barangId) {
            log_message('error', 'Data tidak valid: Transaksi ID atau Barang ID kosong');
            return redirect()->back()->with('pesan', 'Data tidak valid!');
        }

        log_message('info', "Setujui Barang: Transaksi ID = $transaksiId, Barang ID = $barangId");
        
        // Perbarui status barang dalam transaksi
        $this->kumpulanBarangModel->where(['barang_dipinjam_fk' => $barangId, 'transaksi_fk' => $transaksiId])
                                ->set(['status_barang' => 1]) // 1 berarti "Disetujui"
                                ->update();
        
        // Cek status global transaksi
        $this->updateTransaksiStatus($transaksiId);

        session()->setFlashdata('pesan', "Barang berhasil disetujui.");
        return redirect()->to("jurusan/riwayatpeminjamanbarang/detail/$transaksiId");
    }

    public function tolakBarang()
    {
        $transaksiId = $this->request->getPost('transaksi_id');
        $barangId = $this->request->getPost('barang_id');

        if (!$transaksiId || !$barangId) {
            return redirect()->back()->with('pesan', 'Data tidak valid!');
        }

        // Perbarui status barang dalam transaksi
        $this->kumpulanBarangModel->where(['barang_dipinjam_fk' => $barangId, 'transaksi_fk' => $transaksiId])
                                ->set(['status_barang' => 0]) // 0 berarti "Ditolak"
                                ->update();

        // Perbarui informasi barang untuk mengembalikan ketersediaan
        $barang = $this->informasiBarangModel->where('barang_kode', $barangId)->first();
        $this->informasiBarangModel->save([
            'barang_id' => $barang['barang_id'],
            'barang_status' => 1, // 1 berarti "Tersedia"
            'barang_dipinjamkan' => 1, // 1 berarti "Dapat Dipinjamkan"
        ]);

        // Cek status global transaksi
        $this->updateTransaksiStatus($transaksiId);

        session()->setFlashdata('pesan', "Barang berhasil ditolak.");
        return redirect()->to("jurusan/riwayatpeminjamanbarang/detail/$transaksiId");
    }

    private function updateTransaksiStatus($transaksiId)
    {
        $barangStatuses = $this->kumpulanBarangModel->where('transaksi_fk', $transaksiId)->findAll();
    
        $isAnyApproved = false;
        $isAnyPending = false;
        $isAllRejected = true;
    
        foreach ($barangStatuses as $barang) {
            if ($barang['status_barang'] == 1) {
                $isAnyApproved = true;
                $isAllRejected = false;
            } elseif (!isset($barang['status_barang']) || $barang['status_barang'] == 2) { // 2: Pending
                $isAnyPending = true;
                $isAllRejected = false;
            } elseif ($barang['status_barang'] == 0) { // Barang ditolak
                // Tetap lanjut, hanya periksa jika semuanya ditolak
            }
        }

        log_message('info', "isAnyApproved: $isAnyApproved, isAnyPending: $isAnyPending, isAllRejected: $isAllRejected");
    
        // Logika Status Global
        if ($isAllRejected) {
            $pengajuanStatus = 0; // Ditolak
            $peminjamanStatus = -1; // Tidak Dipinjam
        } elseif ($isAnyPending) {
            $pengajuanStatus = 2; // Pending
            $peminjamanStatus = 2; // Pending
        } elseif ($isAnyApproved) {
            $pengajuanStatus = 1; // Disetujui
            $peminjamanStatus = 1; // Sedang Dipinjam
        }

        log_message('info', "Updated pengajuan_status: $pengajuanStatus, peminjaman_status: $peminjamanStatus");
    
        $this->transaksiPeminjamanModel->save([
            'transaksi_id' => $transaksiId,
            'pengajuan_status' => $pengajuanStatus,
            'peminjaman_status' => $peminjamanStatus,
        ]);
    }

    public function dikembalikan($id)
    {
        $this->transaksiPeminjamanModel->save([
            'transaksi_id' => $id,
            'jurusan_fk' => session('username'),
            'peminjaman_status' => 0,
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

        session()->setFlashdata('pesan', "Konfirmasi bahwa Barang sudah Dikembalikan Berhasil.");

        return redirect()->to("jurusan/peminjaman");
    }
}
