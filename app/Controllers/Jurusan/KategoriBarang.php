<?php

namespace App\Controllers\Jurusan;

use App\Controllers\BaseController;
use App\Models\kategori_barang_model;

class KategoriBarang extends BaseController
{
    protected $kategoriBarangModel;
    public function __construct()
    {
        if (session()->get('role') != 'Jurusan') {
            echo 'Access denied.';
            exit;
        }

        $this->kategoriBarangModel = new kategori_barang_model();
    }

    public function index()
    {
        $data = [
            'title' => 'Jurusan | Kategori Barang',
            'kategoriBarang' => $this->kategoriBarangModel->getKategoriBarang()
        ];

        return view('jurusan/kategori-barang/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Kategori Barang | Tambah Kategori',
            'validation' => \Config\Services::validation()
        ];

        return view('jurusan/kategori-barang/create', $data);
    }

    public function save()
    {
        // Validasi input
        if (!$this->validate([
            'nama' => 'required|is_unique[kategori_barang.kategori_nama]',
        ])) {
            return redirect()->to('/jurusan/kategoribarang/create')->withInput();
        }

        $slug = url_title($this->request->getVar('nama'), '-', true);
        $this->kategoriBarangModel->save([
            'kategori_nama' => $this->request->getVar('nama'),
            'kategori_slug' => $slug,
            'kategori_keterangan' => $this->request->getVar('keterangan'),
        ]);

        session()->setFlashdata('pesan', 'Kategori "' . $this->request->getVar('nama') . '" berhasil ditambahkan.');

        return redirect()->to('/jurusan/kategoribarang');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Kategori Barang | Edit Kategori Barang',
            'kategoriBarang' => $this->kategoriBarangModel->getKategoriBarang($slug),
            'validation' => \Config\Services::validation()
        ];

        return view('jurusan/kategori-barang/edit', $data);
    }

    public function update($id)
    {
        // Cek username
        $namaLama = $this->kategoriBarangModel->getKategoriBarang($this->request->getVar('slug'));
        if ($namaLama['kategori_nama'] == $this->request->getVar('nama')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[kategori_barang.kategori_nama]';
        }

        // Validasi input
        if (!$this->validate([
            'nama' => $rule_nama,
        ])) {
            return redirect()->to('/jurusan/kategoribarang/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('nama'), '-', true);
        $this->kategoriBarangModel->save([
            'kategori_id' => $id,
            'kategori_nama' => $this->request->getVar('nama'),
            'kategori_slug' => $slug,
            'kategori_keterangan' => $this->request->getVar('keterangan'),
        ]);

        session()->setFlashdata('pesan', 'Kategori "' . $this->request->getVar('nama') . '" berhasil diubah.');

        return redirect()->to('/jurusan/kategoribarang');
    }
}
