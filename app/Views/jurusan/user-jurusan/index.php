<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">User Jurusan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">User Jurusan</li>
        </ol>

        <!-- Flash Session -->
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <!-- End Flash Session -->

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-table mr-1"></i>
                    Data User dari Jurusan Teknik Informatika
                </div>

                <?php if (allow('3')) : ?>
                    <div>
                        <a href="<?= base_url('jurusan/userjurusan/create'); ?>" class="btn btn-primary"><i class="fas fa-plus mr-3"></i>Tambah Admin</a>
                    </div>
                <?php endif; ?>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Posisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Posisi</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($userJurusan as $user) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $user['user_nama']; ?></td>
                                    <td><?= $user['user_posisi']; ?></td>
                                    <td><a href="<?= base_url('jurusan/userjurusan/' . $user['user_slug']); ?>" class="btn btn-info btn-block">Detail</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>