<?php

namespace App\Models;

use CodeIgniter\Model;

class foto_pending_model extends Model
{
    protected $table      = 'foto_barang_pending';
    protected $primaryKey = 'foto_pending_id';

    protected $allowedFields = ['pending_fk', 'foto_pending_nama'];

    protected $useTimestamps = true;

    public function getFoto($barang = false)
    {
        if ($barang == false) {
            return $this->findAll();
        }

        return $this->where(['pending_fk' => $barang])->findAll();
    }
}
