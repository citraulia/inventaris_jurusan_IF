<?= $this->extend('peminjam/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-table mr-1"></i>
                    DataTable Riwayat Peminjaman Barang yang sedang Pending
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status Pengelolaan</th>
                                <th>Status Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status Pengelolaan</th>
                                <th>Status Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($transaksiPeminjaman as $log) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $log['tanggal_peminjaman']; ?></td>
                                    <td><?= $log['tanggal_pengembalian']; ?></td>
                                    <td><span class="badge text-white badge-
                                        <?php if ($log['pengajuan_status'] == 1) {
                                            echo 'bg-success';
                                        } else if ($log['pengajuan_status'] == 2) {
                                            echo 'bg-warning';
                                        } else if ($log['pengajuan_status'] == 0 || $log['pengajuan_status'] == -1) {
                                            echo 'bg-danger';
                                        } ?>
                                    ">
                                            <?php if ($log['pengajuan_status'] == 1) {
                                                echo 'DISETUJUI';
                                            } else if ($log['pengajuan_status'] == 2) {
                                                echo 'PENDING';
                                            } else if ($log['pengajuan_status'] == 0) {
                                                echo 'DITOLAK';
                                            } else if ($log['pengajuan_status'] == -1) {
                                                echo 'DIBATALKAN';
                                            } ?>
                                        </span>
                                    </td>
                                    <td><span class="badge text-white badge-
                                        <?php if ($log['peminjaman_status'] == 0) {
                                            echo 'bg-info';
                                        } else if ($log['peminjaman_status'] == 2) {
                                            echo 'bg-warning';
                                        } else if ($log['peminjaman_status'] == 1) {
                                            echo 'bg-success';
                                        } else if ($log['peminjaman_status'] == -1) {
                                            echo 'bg-danger';
                                        } ?>
                                    ">
                                            <?php if ($log['peminjaman_status'] == 0) {
                                                echo 'DIKEMBALIKAN';
                                            } else if ($log['peminjaman_status'] == 2) {
                                                echo 'PENDING';
                                            } else if ($log['peminjaman_status'] == 1) {
                                                echo 'SEDANG DIPINJAM';
                                            } else if ($log['peminjaman_status'] == -1) {
                                                echo 'TIDAK DIPINJAM';
                                            } ?>
                                        </span>
                                    </td>

                                    <td>
                                        <a href="<?= base_url('peminjam/riwayatpeminjaman/' . $log['transaksi_id']); ?>" class="btn btn-info btn-block">Detail</a>
                                        <?php if ($log['pengajuan_status'] == 2) : ?>
                                            <form action="<?= base_url('Peminjam/RiwayatPeminjaman/batal/' . session('username') . '/' . $log['transaksi_id']); ?>" method="POST">
                                                <div class="btn-group btn-block mt-lg-2">
                                                    <input type="hidden" id="id" name="id" value="<?= $log['transaksi_id']; ?>" />
                                                    <button type="submit" href="#" class="btn btn-danger">Batalkan</button>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>