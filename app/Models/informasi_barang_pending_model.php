<?php

namespace App\Models;

use CodeIgniter\Model;

class informasi_barang_pending_model extends Model
{
    protected $table      = 'informasi_barang_pending';
    protected $primaryKey = 'pending_id';

    protected $allowedFields = [
        'pending_kode', 'pending_nama', 'kategori_fk', 'pending_merk',
        'pending_deskripsi', 'pending_tahun_perolehan', 'pending_keadaan', 'pending_harga',
        'lokasi_fk', 'pending_keterangan', 'pending_status', 'pending_dipinjamkan',
    ];

    protected $useTimestamps = true;

    public function getBarangPending($kode = false)
    {
        if ($kode == false) {
            return $this->findAll();
        }

        return $this->where(['pending_kode' => $kode])->first();
    }

    public function createKode($kategori, $lokasi, $barang, $id)
    {
        $kategoriNama = substr($kategori, 0, 3);
        $lokasiNama = trim($lokasi, "R.");
        $barangNama = substr($barang, 0, 2) . $id;
        $kode = 'p-' . $kategoriNama . $lokasiNama . $barangNama;

        return $kode;
    }
}
