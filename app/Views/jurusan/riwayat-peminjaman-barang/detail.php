<?php

use App\Models\informasi_barang_model;
use App\Models\user_peminjam_model;

$userPeminjam = new user_peminjam_model();

$peminjam = $userPeminjam->where(['peminjam_slug' => $transaksiPeminjaman['peminjam_fk']])->first();


function getBarang($kode)
{
    $informasiBarang = new informasi_barang_model();

    return $informasiBarang->getInformasiBarang($kode);
}
?>

<?php if ($transaksiPeminjaman['pengajuan_status'] == 1) {
    $status = 'DISETUJUI';
    $bgStatus = 'success';
} else if ($transaksiPeminjaman['pengajuan_status'] == 0) {
    $status = 'DITOLAK';
    $bgStatus = 'danger';
} else if ($transaksiPeminjaman['pengajuan_status'] == 2) {
    $status = 'PENDING';
    $bgStatus = 'warning';
} else if ($transaksiPeminjaman['pengajuan_status'] == -1) {
    $status = 'DIBATALKAN';
    $bgStatus = 'danger';
} ?>

<?php if ($transaksiPeminjaman['peminjaman_status'] == 0) {
    $peminjaman = 'DIKEMBALIKAN';
    $bgPeminjaman = 'info';
} else if ($transaksiPeminjaman['peminjaman_status'] == 1) {
    $peminjaman = 'SEDANG DIPINJAM';
    $bgPeminjaman = 'success';
} else if ($transaksiPeminjaman['peminjaman_status'] == 2) {
    $peminjaman = 'PENDING';
    $bgPeminjaman = 'warning';
} else if ($transaksiPeminjaman['peminjaman_status'] == -1) {
    $peminjaman = 'TIDAK DIPINJAM';
    $bgPeminjaman = 'danger';
} ?>

<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Detail Transaksi Peminjaman Barang <?= $transaksiPeminjaman['transaksi_id']; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/peminjaman'); ?>">Riwayat Peminjaman</a></li>
            <li class="breadcrumb-item active">Detail Peminjaman Barang</li>
        </ol>
        <div class="card border-dark mb-3">
            <div class=" card-header">Detail Peminjaman Barang</div>
            <div class="card-body text-dark">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="mb-1" for="readNama">Nama Lengkap</label>
                            <input type="text" class="form-control py-3" id="readNama" name="nama" style="font-weight: bold;" value="<?= $peminjam['peminjam_nama']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="readHp">Nomor Hp</label>
                            <input type="text" class="form-control" id="readHp" name="hp" style="font-weight: bold;" value="<?= $peminjam['peminjam_hp']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="readAlamat">Alamat</label>
                        <input type="text" class="form-control" id="readAlamat" name="alamat" style="font-weight: bold;" value="<?= $peminjam['peminjam_alamat']; ?>" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="mb-1" for="tanggalPinjam">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" id="tanggalPinjam" name="pinjam" style="font-weight: bold;" value="<?= $transaksiPeminjaman['tanggal_peminjaman']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mb-1" for="tanggalKembali">Tanggal Dikembalikan</label>
                            <input type="date" class="form-control" id="tanggalKembali" name="kembali" style="font-weight: bold;" value="<?= $transaksiPeminjaman['tanggal_pengembalian']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="status">Status Pengajuan Barang</label>
                            <input type="text" class="form-control bg-<?= $bgStatus; ?>" id="status" name="status" style="font-weight: bold;" value="<?= $status; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="peminjaman">Status Peminjaman Barang</label>
                            <input type="text" class="form-control bg-<?= $bgPeminjaman; ?>" id="peminjaman" name="peminjaman" style="font-weight: bold;" value="<?= $peminjaman; ?>" readonly>
                        </div>
                    </div>
                    <label class="mb-1" for="barang" style="font-weight: bold;">Barang yang Dipinjam</label>
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fas fa-table mr-1"></i>
                                DataTable Barang yang Dipinjam
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Merk</th>
                                            <th>Keadaan</th>
                                            <th>Lokasi</th>
                                            <th>Aksi</th>
                                            <th>Detail Barang</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Merk</th>
                                            <th>Keadaan</th>
                                            <th>Lokasi</th>
                                            <th>Aksi</th>
                                            <th>Detail Barang</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($kumpulanBarang as $barang) : ?>
                                            <tr>
                                                <td><?= $i++; ?> </td>

                                                <?php $barangPinjaman = getBarang($barang['barang_dipinjam_fk']); ?>
                                                <td><?= $barangPinjaman['barang_kode']; ?></td>
                                                <td><?= $barangPinjaman['barang_nama']; ?></td>
                                                <td><?= $barangPinjaman['barang_merk']; ?></td>
                                                <td><?= $barangPinjaman['barang_keadaan']; ?></td>
                                                <td><?= $barangPinjaman['lokasi_fk']; ?></td>
                                                <td>
                                                    <?php if (isset($barang['status_barang'])): ?>
                                                        <?php if ($barang['status_barang'] == 1): ?>
                                                            <span class="badge badge-success">Disetujui</span>
                                                        <?php elseif ($barang['status_barang'] == 0): ?>
                                                            <span class="badge badge-danger">Ditolak</span>
                                                        <?php else: ?>
                                                            <?php if (session('user_level') == 1): // Hanya untuk user_level 1 ?>
                                                                <form action="<?= base_url('jurusan/riwayatpeminjamanbarang/setujuiBarang'); ?>" method="POST">
                                                                    <?= csrf_field(); ?>
                                                                    <input type="hidden" name="transaksi_id" value="<?= $transaksiPeminjaman['transaksi_id']; ?>">
                                                                    <input type="hidden" name="barang_id" value="<?= $barang['barang_dipinjam_fk']; ?>">
                                                                    <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                                                </form>
                                                                <form action="<?= base_url('jurusan/riwayatpeminjamanbarang/tolakBarang'); ?>" method="POST">
                                                                    <?= csrf_field(); ?>
                                                                    <input type="hidden" name="transaksi_id" value="<?= $transaksiPeminjaman['transaksi_id']; ?>">
                                                                    <input type="hidden" name="barang_id" value="<?= $barang['barang_dipinjam_fk']; ?>">
                                                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                                                </form>
                                                            <?php else: ?>
                                                                <span class="badge badge-warning">Pending</span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary">Pending</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-block">
                                                        <a href="<?= base_url('jurusan/informasibarang/' . $barangPinjaman['barang_kode']); ?>" class="btn btn-info">Detail</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php if (allow('1', '2')) : ?>
                        <?php if ($transaksiPeminjaman['pengajuan_status'] == 2) : ?>
                            <div class="form-row">
                                <form action="<?= base_url('Jurusan/RiwayatPeminjamanBarang/setujui/' . $transaksiPeminjaman['transaksi_id']); ?>" method="POST">
                                    <div class="btn-group">
                                        <input type="hidden" id="id" name="id" value="<?= $transaksiPeminjaman['transaksi_id']; ?>" />
                                        <button type="submit" href="#" class="btn btn-success ">Setujui</button>
                                    </div>
                                </form>
                                <form action="<?= base_url('Jurusan/RiwayatPeminjamanBarang/tolak/' . $transaksiPeminjaman['transaksi_id']); ?>" method="POST">
                                    <div class="btn-group btn-block">
                                        <input type="hidden" id="id" name="id" value="<?= $transaksiPeminjaman['transaksi_id']; ?>" />
                                        <button type="submit" href="#" class="btn btn-danger">Tolak</button>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                        <?php if ($transaksiPeminjaman['pengajuan_status'] == 1 && $transaksiPeminjaman['peminjaman_status'] == 1) : ?>
                            <form action="<?= base_url('Jurusan/RiwayatPeminjamanBarang/dikembalikan/' . $transaksiPeminjaman['transaksi_id']); ?>" method="POST">
                                <div class="btn-group mt-2 btn-block">
                                    <input type="hidden" id="id" name="id" value="<?= $transaksiPeminjaman['transaksi_id']; ?>" />
                                    <button type="submit" href="#" class="btn btn-success ">Sudah Dikembalikan</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>