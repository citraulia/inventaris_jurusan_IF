<?php

namespace App\Models;

use CodeIgniter\Model;

class StatistikKategoriBarang extends Model
{
    protected $table = 'informasi_barang';

    public function getKategoriWithCount()
    {
        return $this->select('kategori_fk as kategori, COUNT(barang_id) as jumlah')
                    ->groupBy('kategori_fk')
                    ->orderBy('kategori_fk', 'ASC')
                    ->findAll();
    }
}
