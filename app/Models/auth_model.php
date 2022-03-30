<?php

namespace App\Models;

use CodeIgniter\Model;

class auth_model extends Model
{
    function getLoginData($username, $table)
    {
        $builder = $this->db->table($table);
        if ($table == 'user_jurusan') {
            $builder->where('user_username', $username);
        } else if ($table == 'user_peminjam') {
            $builder->where('peminjam_username', $username);
        }

        $log = $builder->get()->getRow();
        return $log;
    }
}
