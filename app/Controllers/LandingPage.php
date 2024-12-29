<?php

namespace App\Controllers;

use App\Models\StatistikKategoriBarang;
use App\Models\StatistikInformasiBarang;

class LandingPage extends BaseController
{
    protected $statistikKategoriBarang;
    protected $statistikInformasiBarang;

    public function __construct()
    {
        $this->statistikKategoriBarang = new StatistikKategoriBarang();
        $this->statistikInformasiBarang = new StatistikInformasiBarang();
    }

    public function index()
    {
        // Ambil data kategori dan jumlah barang
        $kategoriData = $this->statistikKategoriBarang->getKategoriWithCount();

        // Siapkan data untuk chart
        $labels = array_column($kategoriData, 'kategori'); // Label untuk kategori
        $data = array_column($kategoriData, 'jumlah'); // Jumlah barang per kategori

        // Hitung statistik tambahan (status barang)
        $totalBarang = $this->statistikInformasiBarang->countAllResults(); // Total barang
        $totalActive = $this->statistikInformasiBarang->where(['barang_status' => '1'])->countAllResults();
        $totalInactive = $this->statistikInformasiBarang->where(['barang_status' => '0'])->countAllResults();
        $totalDipinjam = $this->statistikInformasiBarang->where(['barang_status' => '2'])->countAllResults();

        // Kirim data ke view
        $data = [
            'labels' => json_encode($labels), // Encode sebagai JSON untuk Chart.js
            'data' => json_encode($data), // Encode sebagai JSON untuk Chart.js
            'totalBarang' => $totalBarang,
            'totalActive' => $totalActive,
            'totalInactive' => $totalInactive,
            'totalDipinjam' => $totalDipinjam,
        ];

        return view('landing/index', $data);
    }
}
