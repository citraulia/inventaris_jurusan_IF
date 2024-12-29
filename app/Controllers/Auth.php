<?php

namespace App\Controllers;

use App\Models\auth_model;

class Auth extends BaseController
{
    protected $authModel;
    public function __construct()
    {
        $this->authModel = new auth_model();
    }

    //Login untuk Peminjam
    public function login()
    {
        $table = 'user_peminjam';
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $row = $this->authModel->getLoginData($username, $table);
        if ($row == null) {
            session()->setFlashdata('gagal', 'Username atau Password anda salah.');
            return redirect()->to("/");
        }

        if ($password == $row->peminjam_password) {
            $data = array(
                'log' => TRUE,
                'nama' => $row->peminjam_nama,
                'username' => $row->peminjam_username,
                'slug' => $row->peminjam_slug,
                'role' => 'Peminjam',
                'level' => $row->peminjam_level,
            );
            session()->set($data);
            session()->setFlashdata('pesan', 'Berhasil Login');
            return redirect()->to("peminjam");
        }

        session()->setFlashdata('gagal', 'Username atau Password anda salah.');
        return redirect()->to("/");
    }

    public function loginJurusan()
    {
        $table = 'user_jurusan';
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $row = $this->authModel->getLoginData($username, $table);

        if ($row == null) {
            session()->setFlashdata('gagal', 'Username atau Password anda salah.');
            return redirect()->to("jurusanlogin");
        }

        if ($password == $row->user_password) {
            $data = array(
                'log' => true,
                'nama' => $row->user_nama,
                'username' => $row->user_username,
                'slug' => $row->user_slug,
                'role' => 'Jurusan',
                'user_level' => $row->user_level,
            );
            session()->set($data);
            session()->setFlashdata('pesan', 'Berhasil Login');
            return redirect()->to("jurusan");
        }

        session()->setFlashdata('gagal', 'Username atau Password anda salah.');
        return redirect()->to("jurusanlogin");
    }

    public function logout()
    {
        $session = session();

        $session->destroy();

        session()->setFlashdata('pesan', 'Berhasil Logout.');

        return redirect()->to("/");
    }

    //--------------------------------------------------------------------
}
