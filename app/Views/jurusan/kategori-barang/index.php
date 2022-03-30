<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Kategori Barang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Kategori Barang</li>
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
                    Kategori Barang Inventaris Jurusan
                </div>

                <?php if (allow('3')) : ?>
                    <div>
                        <a href="<?= base_url('jurusan/kategoribarang/create'); ?>" class="btn btn-primary"><i class="fas fa-plus mr-3"></i>Tambah Kategori</a>
                    </div>
                <?php endif; ?>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>

                                <?php if (allow('3')) : ?>
                                    <th>Aksi</th>
                                <?php endif; ?>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Nama Kategori</th>
                                <th>Keteterangan</th>

                                <?php if (allow('3')) : ?>
                                    <th>Aksi</th>
                                <?php endif; ?>

                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($kategoriBarang as $kategori) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $kategori['kategori_nama']; ?></td>
                                    <td><?= $kategori['kategori_keterangan']; ?></td>

                                    <?php if (allow('3')) : ?>
                                        <td><a href="<?= base_url('jurusan/kategoribarang/edit/' . $kategori['kategori_slug']); ?>" class="btn btn-warning btn-block"><i class="fas fa-pen mr-3"></i>Edit</td>
                                    <?php endif; ?>

                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>