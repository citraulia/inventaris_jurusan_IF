<?php

namespace App\Models;

use CodeIgniter\Model;

class kumpulan_barang_dipinjam_model extends Model
{
    protected $table      = 'kumpulan_barang_dipinjam';
    protected $primaryKey = 'kumpulan_id';

    protected $allowedFields = ['barang_dipinjam_fk', 'transaksi_fk'];

    protected $useTimestamps = true;

    public function getKumpulanBarang($kode)
    {
        return $this->where(['transaksi_fk' => $kode])->findAll();
    }
}
