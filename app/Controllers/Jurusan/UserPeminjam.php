<?php

namespace App\Controllers\Jurusan;

use App\Controllers\BaseController;
use App\Models\user_peminjam_model;

class UserPeminjam extends BaseController
{
    protected $userPeminjamModel;
    public function __construct()
    {
        if (session()->get('role') != 'Jurusan') {
            echo 'Access denied.';
            exit;
        }

        $this->userPeminjamModel = new user_peminjam_model();
    }

    public function index()
    {
        $data = [
            'title' => 'Jurusan | Users Peminjam',
            'userPeminjam' => $this->userPeminjamModel->getUserPeminjam(),
        ];

        return view('jurusan/user-peminjam/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Jurusan | Detail User Peminjam',
            'userPeminjam' => $this->userPeminjamModel->getUserPeminjam($slug)
        ];

        //Jika User tidak tidak ada dalam tabel
        if (empty($data['userPeminjam'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User ' . $slug . ' tidak ditemukan.');
        }

        return view('jurusan/user-peminjam/detail', $data);
    }

    public function edit($slug)
    {
        $data = [
            'title' => "Jurusan | Edit User Peminjam",
            'validation' => \Config\Services::validation(),
            'userPeminjam' => $this->userPeminjamModel->getUserPeminjam($slug)
        ];

        return view('jurusan/user-peminjam/edit', $data);
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
            return redirect()->to('/jurusan/userpeminjam/edit/' . $this->request->getVar('slug'))->withInput();
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

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to("/jurusan/userpeminjam");
    }

    public function delete($id)
    {
        $this->userPeminjamModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus.');

        return redirect()->to("/jurusan/userpeminjam");
    }

    //--------------------------------------------------------------------

}
