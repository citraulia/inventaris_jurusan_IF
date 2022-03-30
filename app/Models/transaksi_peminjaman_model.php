<?php

namespace App\Models;

use CodeIgniter\Model;

class transaksi_peminjaman_model extends Model
{
    protected $table      = 'transaksi_peminjaman';
    protected $primaryKey = 'transaksi_id';

    protected $allowedFields = ['peminjam_fk', 'tanggal_peminjaman', 'tanggal_pengembalian', 'jurusan_fk', 'pengajuan_status', 'peminjaman_status'];

    protected $useTimestamps = true;

    public function getTransaksi($id = false)
    {
        if ($id == false) {
            return $this->orderBy('peminjaman_status DESC')->findAll();
        }

        return $this->where(['transaksi_id' => $id])->first();
    }

    public function getUserTransaksi($username)
    {
        return $this->where(['peminjam_fk' => $username])->orderBy('peminjaman_status DESC')->findAll();
    }
}
