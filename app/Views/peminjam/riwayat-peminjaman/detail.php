<?php

use App\Models\informasi_barang_model;

function getBarang($kode)
{
    $informasiBarang = new informasi_barang_model();

    return $informasiBarang->getInformasiBarang($kode);
}
?>

<?php if ($transaksiPeminjaman['pengajuan_status'] == 1) {
    $status = 'DISETUJUI';
    $bgStatus = 'success';
} else if ($transaksiPeminjaman['pengajuan_status'] == 0 || $transaksiPeminjaman['pengajuan_status'] == -1) {
    $status = 'DITOLAK';
    $bgStatus = 'danger';
} else if ($transaksiPeminjaman['pengajuan_status'] == 2) {
    $status = 'PENDING';
    $bgStatus = 'warning';
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

<?= $this->extend('peminjam/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Detail Transaksi Peminjaman Barang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('peminjam/riwayatpeminjaman'); ?>">Riwayat Peminjaman</a></li>
            <li class="breadcrumb-item active">Detail Peminjaman Barang</li>
        </ol>
        <div class="card border-dark mb-3">
            <div class=" card-header">Detail Peminjaman Barang</div>
            <div class="card-body text-dark">
                <form>
                    <div class="form-group">
                        <label class="mb-1" for="readNama">Nama Lengkap</label>
                        <input type="text" class="form-control py-3" id="readNama" name="nama" style="font-weight: bold;" value="<?= session('nama'); ?>" readonly>
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
                    <label class="mb-1" for="barang" style="font-weight: bold;">Barang yang Anda Pinjam</label>
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fas fa-table mr-1"></i>
                                DataTable Barang yang Anda Pinjam
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
                                            <th>Status Pengajuan Barang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Merk</th>
                                            <th>Keadaan</th>
                                            <th>Status Pengajuan Barang</th>
                                            <th>Aksi</th>
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
                                                <td>
                                                    <?php if (isset($barang['status_barang'])): ?>
                                                        <?php if ($barang['status_barang'] == 1): ?>
                                                            <span class="badge badge-success">Disetujui</span>
                                                        <?php elseif ($barang['status_barang'] == 0): ?>
                                                            <span class="badge badge-danger">Ditolak</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-warning">Pending</span>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary">Tidak Ada Status</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-block">
                                                        <a href="<?= base_url('peminjam/barangpinjaman/' . $barangPinjaman['barang_kode']); ?>" class="btn btn-info">Detail</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
                <?php if ($transaksiPeminjaman['pengajuan_status'] == 2) : ?>
                    <form action="<?= base_url('Peminjam/RiwayatPeminjaman/batal/' . session('username') . '/' . $transaksiPeminjaman['transaksi_id']); ?>" method="POST">
                        <div class="btn-group btn-block mt-lg-2">
                            <input type="hidden" id="id" name="id" value="<?= $transaksiPeminjaman['transaksi_id']; ?>" />
                            <button type="submit" href="#" class="btn btn-danger">Batalkan</button>
                        </div>
                    </form>
                <?php endif; ?>
                <?php if ($transaksiPeminjaman['pengajuan_status'] == 1 && $transaksiPeminjaman['peminjaman_status'] == 1) : ?>
                    <a href="<?= base_url('peminjam/riwayatpeminjaman/surat/' . session('username') . '/' . $transaksiPeminjaman['transaksi_id']); ?>" class="btn btn-warning btn-block small" target="_blank"><i class="fas fa-print mr-3"></i>Print Surat Peminjaman</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>