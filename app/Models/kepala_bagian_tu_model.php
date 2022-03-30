<?php

namespace App\Models;

use CodeIgniter\Model;

class kepala_bagian_tu_model extends Model
{
    protected $table      = 'kepala_bagian_tu';
    protected $primaryKey = 'tu_id';

    protected $allowedFields = ['tu_nama', 'tu_nip'];

    protected $useTimestamps = true;
}
