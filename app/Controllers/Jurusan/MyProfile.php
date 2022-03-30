<?php

namespace App\Controllers\Jurusan;

use App\Controllers\BaseController;
use App\Models\user_jurusan_model;

class MyProfile extends BaseController
{
    protected $userJurusanModel;
    public function __construct()
    {
        if (session()->get('role') != 'Jurusan') {
            echo 'Access denied.';
            exit;
        }

        $this->userJurusanModel = new user_jurusan_model();
    }

    public function index($slug)
    {
        if (session()->get('slug') != $slug) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User ' . $slug . ' tidak ditemukan.');
        }

        $data = [
            'title' => 'User Jurusan | Ubah Data User',
            'userJurusan' => $this->userJurusanModel->getUserJurusan($slug),
            'validation' => \Config\Services::validation()
        ];

        return view('jurusan/my-profile', $data);
    }

    public function update($id)
    {
        // Cek username
        $usernameLama = $this->userJurusanModel->getUserJurusan($this->request->getVar('slug'));
        if ($usernameLama['user_username'] == $this->request->getVar('username')) {
            $rule_username = 'required|alpha_numeric';
        } else {
            $rule_username = 'required|alpha_numeric|is_unique[user_jurusan.user_username]';
        }

        // Validasi input
        if (!$this->validate([
            'nama' => 'required',
            'nip' => 'numeric',
            'username' => $rule_username,
            'password' => 'required|alpha_numeric|min_length[8]',
            'confirmPassword' => 'matches[password]'
        ])) {
            return redirect()->to('/jurusan/myprofile/' . $this->request->getVar('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('username'), '-', true);
        $this->userJurusanModel->save([
            'user_id' => $id,
            'user_nama' => $this->request->getVar('nama'),
            'user_slug' => $slug,
            'user_nip' => $this->request->getVar('nip'),
            'user_username' => $this->request->getVar('username'),
            'user_password' => $this->request->getVar('password')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/jurusan/myprofile/' . session('slug'));
    }
}
