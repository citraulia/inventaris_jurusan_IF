<?php

namespace App\Controllers\Peminjam;

use App\Controllers\BaseController;
use App\Models\user_peminjam_model;

class MyProfile extends BaseController
{
    protected $userPeminjamModel;
    public function __construct()
    {
        if (session()->get('role') != 'Peminjam') {
            echo 'Access denied.';
            exit;
        }

        $this->userPeminjamModel = new user_peminjam_model();
    }

    public function index($slug)
    {
        if (session()->get('slug') != $slug) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User ' . $slug . ' tidak ditemukan.');
        }

        $data = [
            'title' => 'Peminjam | My Profile',
            'userPeminjam' => $this->userPeminjamModel->getUserPeminjam($slug),
            'validation' => \Config\Services::validation(),
        ];

        //Jika User tidak tidak ada dalam tabel
        if (empty($data['userPeminjam'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User ' . $slug . ' tidak ditemukan.');
        }

        return view('peminjam/my-profile', $data);
    }

    public function update($id)
    {
        // Cek username
        $usernameLama = $this->userPeminjamModel->getUserPeminjam($this->request->getVar('slug'));
        if ($usernameLama['peminjam_username'] == $this->request->getVar('username')) {
            $rule_username = 'required|alpha_numeric';
        } else {
            $rule_username = 'required|alpha_numeric|is_unique[user_peminjam.peminjam_username]';
        }

        //Validasi input
        if (!$this->validate([
            'nama' => 'required',
            'hp' => 'required',
            'alamat' => 'required',
            'username' => $rule_username,
            'password' => 'required|alpha_numeric|min_length[8]',
            'confirmPassword' => 'matches[password]',
        ])) {
            return redirect()->to("/peminjam/myprofile/" . session('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('username'), '-', true);
        $this->userPeminjamModel->save([
            'peminjam_id' => $id,
            'peminjam_nama' => $this->request->getVar('nama'),
            'peminjam_slug' => $slug,
            'peminjam_hp' => $this->request->getVar('hp'),
            'peminjam_alamat' => $this->request->getVar('alamat'),
            'peminjam_username' => $this->request->getVar('username'),
            'peminjam_password' => $this->request->getVar('password')
        ]);

        session()->set([
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'slug' => $slug,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to("peminjam/myprofile/" . session('slug'));
    }

    //--------------------------------------------------------------------
}
