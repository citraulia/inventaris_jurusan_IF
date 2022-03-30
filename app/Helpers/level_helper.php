<?php

use App\Models\user_jurusan_model;

function allow($level)
{
    $session = \Config\Services::session();
    $slug = $session->get('slug');
    $model = new user_jurusan_model();
    $row = $model->where(['user_slug' => $slug])->first();

    if ($row != null) {
        if ($row['user_level'] == $level) {
            return true;
        } else {
            return false;
        }
    }
}
