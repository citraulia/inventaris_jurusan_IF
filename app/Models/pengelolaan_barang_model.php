<?php

namespace App\Models;

use CodeIgniter\Model;

class pengelolaan_barang_model extends Model
{
    protected $table      = 'pengelolaan_barang';
    protected $primaryKey = 'pengelolaan_id';

    protected $allowedFields = [
        'pengelolaan_kode', 'barang_fk', 'pending_fk', 'user_fk',
        'pengelolaan_tanggal', 'jenis_fk', 'pengelolaan_status',
        'pengelolaan_keterangan'
    ];

    protected $useTimestamps = true;

    public function getPengelolaan($kode = false)
    {
        if ($kode == false) {
            return $this->orderBy('pengelolaan_tanggal DESC')->findAll();
        }

        return $this->where(['pengelolaan_kode' => $kode])->first();
    }

    public function createKode($jenis, $kodeBarang)
    {
        $pengelolaanJenis = substr($jenis, 0, 3);
        $kode = $pengelolaanJenis . "-" . $kodeBarang;

        return $kode;
    }
}
