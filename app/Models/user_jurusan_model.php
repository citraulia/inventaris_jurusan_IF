<?php

namespace App\Models;

use CodeIgniter\Model;

class user_jurusan_model extends Model
{
    protected $table      = 'user_jurusan';
    protected $primaryKey = 'user_id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['user_nama', 'user_slug', 'user_nip', 'user_username', 'user_password'];

    protected $useTimestamps = true;

    public function getUserJurusan($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['user_slug' => $slug])->first();
    }
}
