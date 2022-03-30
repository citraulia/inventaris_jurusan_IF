<?php

namespace App\Models;

use CodeIgniter\Model;

class kategori_barang_model extends Model
{
    protected $table      = 'kategori_barang';
    protected $primaryKey = 'kategori_id';

    protected $allowedFields = ['kategori_nama', 'kategori_slug', 'kategori_keterangan'];

    protected $useTimestamps = true;

    public function getKategoriBarang($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['kategori_slug' => $slug])->first();
    }
}
