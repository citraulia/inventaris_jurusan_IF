<?php

use App\Models\user_jurusan_model;

function getUserName($username)
{
    $userJurusan = new user_jurusan_model();
    $nama = $userJurusan->where(['user_username' => $username])->first();


    return $nama['user_nama'];
}

function getName($barang, $isNew = false)
{
    if ($isNew) {
        return $barang['pending_nama'];
    }

    return $barang['barang_nama'];
}

function getLevel($jenis)
{
    if ($jenis != 'HAPUS') {
        return '2';
    }
}
?>

<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Riwayat Pengelolaan Barang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Riwayat Pengelolaan Barang</li>
        </ol>

        <!-- Flash Session -->
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <!-- End Flash Session -->

        <!-- Flash Session -->
        <?php if (session()->getFlashdata('tolak')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('tolak'); ?>
            </div>
        <?php endif; ?>
        <!-- End Flash Session -->

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-table mr-1"></i>
                    DataTable Riwayat Pengelolaan Barang
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Pengelola</th>
                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Pengelola</th>
                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($pengelolaanBarang as $log) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $log['pengelolaan_kode']; ?></td>
                                    <td><?= ($log['barang_fk']) ? getName($barangOri->getInformasiBarang($log['barang_fk'])) : getName($barangPending->getBarangPending($log['pending_fk']), true); ?></td>
                                    <td><?= getUserName($log['user_fk']); ?></td>
                                    <td><?= $log['pengelolaan_tanggal']; ?></td>
                                    <td><?= $log['jenis_fk']; ?></td>
                                    <td><span class="badge text-white badge-
                                        <?php if ($log['pengelolaan_status'] == 1) {
                                            echo 'bg-success';
                                        } else if ($log['pengelolaan_status'] == 2) {
                                            echo 'bg-warning';
                                        } else if ($log['pengelolaan_status'] == 0) {
                                            echo 'bg-danger';
                                        } ?>
                                    ">
                                            <?php if ($log['pengelolaan_status'] == 1) {
                                                echo 'DISETUJUI';
                                            } else if ($log['pengelolaan_status'] == 2) {
                                                echo 'PENDING';
                                            } else if ($log['pengelolaan_status'] == 0) {
                                                echo 'DITOLAK';
                                            } ?>
                                        </span>
                                    </td>

                                    <td>
                                        <a href="<?= base_url('jurusan/pengelolaan/' . $log['pengelolaan_kode'] . '/' . $log['barang_fk']); ?>" class="btn btn-info btn-block">Detail</a>

                                        <?php if ($log['pengelolaan_status'] == 2) : ?>
                                            <?php if (allow('1', getLevel($log['jenis_fk']))) : ?>
                                                <form action="<?= base_url('Jurusan/RiwayatPengelolaanBarang/setujui/' . $log['pengelolaan_kode'] . '/' . $log['barang_fk']); ?>" method="POST">
                                                    <div class="btn-group mt-2 btn-block">
                                                        <input type="hidden" id="id" name="id" value="<?= $log['pengelolaan_id']; ?>" />
                                                        <button type="submit" href="#" class="btn btn-success ">Setujui</button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#editModal<?= $log['pengelolaan_kode']; ?><?= $log['pengelolaan_id']; ?>">Tolak</button>
                                                    </div>
                                                </form>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <!-- Modal Tolak Pengelolaan -->
                                <div class="modal fade" id="editModal<?= $log['pengelolaan_kode']; ?><?= $log['pengelolaan_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <form action="<?= base_url('Jurusan/RiwayatPengelolaanBarang/tolak/' . $log['pengelolaan_kode']); ?>" method="post">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Keterangan Penolakan "<?= $log['jenis_fk']; ?>" Barang (Kode: <?= $log['pengelolaan_kode']; ?>)</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="keterangan">Keterangan</label>
                                                        <textarea class="form-control" id="keterangan" name="keterangan" cols="50" rows="10" placeholder="Jelaskan alasan penolakan terhadap pengajuan pengelolaan barang."></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" id="id" name="id" value="<?= $log['pengelolaan_id']; ?>" />
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- End Modal Edit Product-->
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>