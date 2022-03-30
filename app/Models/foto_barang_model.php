<?php

namespace App\Models;

use CodeIgniter\Model;

class foto_barang_model extends Model
{
    protected $table      = 'foto_barang';
    protected $primaryKey = 'foto_id';

    protected $allowedFields = ['barang_fk', 'foto_nama'];

    protected $useTimestamps = true;

    public function getFoto($barang = false)
    {
        if ($barang == false) {
            return $this->findAll();
        }

        return $this->where(['barang_fk' => $barang])->findAll();
    }
}
