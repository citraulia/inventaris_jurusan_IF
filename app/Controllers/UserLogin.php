<?php

namespace App\Controllers;

use App\Models\user_peminjam_model;

class UserLogin extends BaseController
{
    protected $userPeminjamModel;
    public function __construct()
    {
        $this->userPeminjamModel = new user_peminjam_model();
    }

    //Return to User (peminjam) Login Page.
    public function index()
    {
        $data = [
            'title' => 'User Login',
            'background' => 'primary'
        ];

        return view('user-login/index', $data);
    }

    public function register()
    {
        session();
        $data = [
            'title' => 'Register',
            'background' => 'primary',
            'validation' => \Config\Services::validation()
        ];

        return view('user-login/register', $data);
    }

    //Save User Register
    public function save()
    {
        //Validasi input
        if (!$this->validate([
            'nama' => 'required',
            'hp' => 'required|numeric',
            'alamat' => 'required',
            'username' => 'required|is_unique[user_peminjam.peminjam_username]',
            'password' => 'required|min_length[8]',
            'confirmPassword' => 'matches[password]',
        ])) {
            return redirect()->to('register')->withInput();
        }

        $slug = url_title($this->request->getVar('username'), '-', true);
        $this->userPeminjamModel->save([
            'peminjam_nama' => $this->request->getVar('nama'),
            'peminjam_slug' => $slug,
            'peminjam_hp' => $this->request->getVar('hp'),
            'peminjam_alamat' => $this->request->getVar('alamat'),
            'peminjam_username' => $this->request->getVar('username'),
            'peminjam_password' => $this->request->getVar('password')
        ]);

        session()->setFlashdata('pesan', 'Anda berhasil mendaftar. Silahkan LogIn.');

        return redirect()->to("/");
    }

    public function jurusanLogin()
    {
        $data = [
            'title' => 'Login Jurusan',
            'background' => 'info'
        ];

        return view('user-login/jurusan_login', $data);
    }

    //--------------------------------------------------------------------

}
