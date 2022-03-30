<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('UserLogin');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('login', 'UserLogin::index');
$routes->get('jurusanlogin', 'UserLogin::jurusanLogin');
$routes->get('register', 'UserLogin::register');

/*
 * --------------------------------------------------------------------
 * Jurusan Routes
 * --------------------------------------------------------------------
 */
$routes->get('jurusan', "Jurusan\Dashboard::index");
$routes->get('jurusan/myprofile/(:any)', "Jurusan\MyProfile::index/$1");

// User Jurusan Menu
$routes->get('jurusan/userjurusan', "Jurusan\UserJurusan::index");
$routes->get('jurusan/userjurusan/create', 'Jurusan\UserJurusan::create');
$routes->get('jurusan/userjurusan/edit/(:segment)', 'Jurusan\UserJurusan::edit/$1');
$routes->delete('jurusan/userjurusan/(:num)', 'Jurusan\UserJurusan::delete/$1');
$routes->get('jurusan/userjurusan/(:any)', 'Jurusan\UserJurusan::detail/$1');
// End User Jurusan Manu

// Kategori Barang Menu
$routes->get('jurusan/kategoribarang', "Jurusan\KategoriBarang::index");
$routes->get('jurusan/kategoribarang/create', 'Jurusan\KategoriBarang::create');
$routes->get('jurusan/kategoribarang/edit/(:segment)', 'Jurusan\KategoriBarang::edit/$1');
// End Kategori Barang Menu

// Lokasi Barang Menu
$routes->get('jurusan/lokasibarang', "Jurusan\LokasiBarang::index");
$routes->get('jurusan/lokasibarang/create', 'Jurusan\LokasiBarang::create');
$routes->get('jurusan/lokasibarang/edit/(:segment)', 'Jurusan\LokasiBarang::edit/$1');
$routes->get('jurusan/lokasibarang/print/(:any)', 'Jurusan\LokasiBarang::print/$1');
$routes->get('jurusan/lokasibarang/(:any)', 'Jurusan\LokasiBarang::detail/$1');
// End Lokasi Barang Menu

// Informasi Barang Menu
$routes->get('jurusan/informasibarang', "Jurusan\InformasiBarang::index");
$routes->get('jurusan/informasibarang/create', 'Jurusan\InformasiBarang::create');
$routes->get('jurusan/informasibarang/edit/(:segment)', 'Jurusan\InformasiBarang::edit/$1');
$routes->delete('jurusan/informasibarang/(:num)', 'Jurusan\InformasiBarang::delete/$1');
$routes->get('jurusan/informasibarang/foto/(:segment)', 'Jurusan\InformasiBarang::deleteImgPage/$1');
$routes->delete('jurusan/informasibarang/foto/(:num)', 'Jurusan\InformasiBarang::deleteImg/$1');
$routes->get('jurusan/informasibarang/(:any)', 'Jurusan\InformasiBarang::detail/$1');
// End Informasi Barang Menu

// Informasi Riwayat Pengelolaan Barang
$routes->get('jurusan/pengelolaan', "Jurusan\RiwayatPengelolaanBarang::index");
$routes->get('jurusan/pengelolaan/(:segment)', 'Jurusan\RiwayatPengelolaanBarang::detail/$1');
$routes->get('jurusan/pengelolaan/(:segment)/(:segment)', 'Jurusan\RiwayatPengelolaanBarang::detail/$1/$2');
// End Informasi Riwayat Pengelolaan Barang

// Informasi Riwayat Peminjaman Barang
$routes->get('jurusan/peminjaman', "Jurusan\RiwayatPeminjamanBarang::index");
$routes->get('jurusan/peminjaman/(:num)', "Jurusan\RiwayatPeminjamanBarang::detail/$1");
// End Riwayat Peminjaman Barang

// User Peminjam Menu
$routes->get('jurusan/userpeminjam', "Jurusan\UserPeminjam::index");
$routes->get('jurusan/userpeminjam/edit/(:segment)', 'Jurusan\UserPeminjam::edit/$1');
$routes->delete('jurusan/userpeminjam/(:num)', 'Jurusan\UserPeminjam::delete/$1');
$routes->get('jurusan/userpeminjam/(:any)', 'Jurusan\UserPeminjam::detail/$1');
// End User Peminjam Manu

/*
 * --------------------------------------------------------------------
 * Peminjam Routes
 * --------------------------------------------------------------------
 */
$routes->get('peminjam', "Peminjam\Dashboard::index");
$routes->get('peminjam/myprofile/(:any)', "Peminjam\MyProfile::index/$1");

// Menu Barang yang dapat Dipinjamkan
$routes->get('peminjam/barangpinjaman', "Peminjam\BarangPinjaman::index");
$routes->get('peminjam/barangpinjaman/(:any)', 'Peminjam\BarangPinjaman::detail/$1');
// End Menu Barang yang dapat Dipinjamkan

// Pinjam Barang Menu
$routes->get('peminjam/pinjambarang', "Peminjam\PinjamBarang::index");
// End Pinjam Barang Menu

// Riwayat Peminjaman Menu
$routes->get('peminjam/riwayatpeminjaman/surat/(:any)/(:num)', 'Peminjam\RiwayatPeminjaman::printSurat/$1/$2');
$routes->get('peminjam/riwayatpeminjaman/(:num)', "Peminjam\RiwayatPeminjaman::detail/$1");
$routes->get('peminjam/riwayatpeminjaman/(:segment)', "Peminjam\RiwayatPeminjaman::index/$1");
// End Riwayat Peminjaman Menu

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
