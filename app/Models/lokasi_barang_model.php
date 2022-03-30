<?php

namespace App\Models;

use CodeIgniter\Model;

class lokasi_barang_model extends Model
{
    protected $table      = 'lokasi_barang';
    protected $primaryKey = 'lokasi_id';

    protected $allowedFields = ['lokasi_kode', 'lokasi_slug', 'lokasi_nama', 'lokasi_lantai', 'lokasi_fakultas', 'lokasi_keterangan'];

    protected $useTimestamps = true;

    public function getLokasiBarang($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['lokasi_slug' => $slug])->first();
    }
}
