<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Lokasi Barang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Lokasi Barang</li>
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
                    Lokasi Barang Invetaris Jurusan
                </div>

                <?php if (allow('3')) : ?>
                    <div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit mr-3"></i>Ubah Kepala Bagian TU</button>
                        <a href="<?= base_url('jurusan/lokasibarang/create'); ?>" class="btn btn-primary"><i class="fas fa-plus mr-3"></i>Tambah Lokasi</a>
                    </div>
                <?php endif; ?>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Ruangan</th>
                                <th>Nama</th>
                                <th>Jumlah Barang Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Kode Ruangan</th>
                                <th>Nama</th>
                                <th>Jumlah Barang Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($lokasiBarang as $lokasi) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $lokasi['lokasi_kode']; ?></td>
                                    <td><?= $lokasi['lokasi_nama']; ?></td>
                                    <td>
                                        <?= Count($informasiBarang->where(['lokasi_fk' => $lokasi['lokasi_kode']])->where(['barang_status' => '1'])->findAll()); ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('jurusan/lokasibarang/' . $lokasi['lokasi_slug']); ?>" class="btn btn-info btn-block"><i class="fas fa-info-circle mr-3"></i>Detail</a>

                                        <?php if (allow('3')) : ?>
                                            <a href="<?= base_url('jurusan/lokasibarang/print/' . $lokasi['lokasi_kode']); ?>" class="btn btn-warning btn-block small" target="_blank"><i class="fas fa-print mr-3"></i>Print Daftar Barang</a>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


<!-- Modal Edit Product (muncul ketika pengguna berlevel admin (3) -->
<form action="<?= base_url('jurusan/lokasibarang/updateTU'); ?>" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kepala Bagian TU</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?= $kepalaBagianTU[0]['tu_nama']; ?>">
                    </div>
                    <div class="form-group">
                        <label>NIP.</label>
                        <input type="text" class="form-control" name="nip" value="<?= $kepalaBagianTU[0]['tu_nip']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id" value="<?= $kepalaBagianTU[0]['tu_id']; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->


<?= $this->endSection('content'); ?>