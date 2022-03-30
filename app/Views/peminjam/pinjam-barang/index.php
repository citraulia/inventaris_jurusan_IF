<?= $this->extend('peminjam/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Pinjam Barang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pinjam Barang</li>
        </ol>

        <!-- Tidak ada Barang yang Dipinjam Flash Session -->
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <!-- End Tidak ada Barang yang Dipinjam Flash Session -->

        <div class="card border-dark mb-3">
            <div class=" card-header">Pinjam Barang</div>
            <div class="card-body text-dark">
                <form id="pinjamBarang" action="PinjamBarang/ajukan" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label class="mb-1" for="readNama">Nama Lengkap</label>
                        <input type="text" class="form-control py-3" id="readNama" name="nama" value="<?= session('nama'); ?>" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="mb-1" for="tanggalPinjam">Tanggal Peminjaman</label>
                            <input type="date" class="form-control <?= ($validation->hasError('pinjam')) ? 'is-invalid' : ''; ?>" id="tanggalPinjam" name="pinjam">
                            <div id="tanggalPinjamFeedback" class="invalid-feedback">
                                <?= $validation->getError('pinjam'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mb-1" for="tanggalKembali">Tanggal Dikembalikan</label>
                            <input type="date" class="form-control <?= ($validation->hasError('kembali')) ? 'is-invalid' : ''; ?>" id="tanggalKembali" name="kembali">
                            <div id="tanggalKembaliFeedback" class="invalid-feedback">
                                <?= $validation->getError('kembali'); ?>
                            </div>
                        </div>
                    </div>
                    <label class="mb-1" for="barang" style="font-weight: bold;">Check Barang yang akan Anda Pinjam</label>
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fas fa-table mr-1"></i>
                                DataTable Barang yang Dapat Dipinjam dari Jurusan Teknik Informatika
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>CheckBox</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Merk</th>
                                            <th>Keadaan</th>
                                            <th>Lokasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>CheckBox</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Merk</th>
                                            <th>Keadaan</th>
                                            <th>Lokasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($informasiBarang as $barang) : ?>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="<?= $barang['barang_kode']; ?>" id="flexCheckDefault" name="kode[]">
                                                    </div>
                                                </td>
                                                <td><?= $barang['barang_kode']; ?></td>
                                                <td><?= $barang['barang_nama']; ?></td>
                                                <td><?= $barang['barang_merk']; ?></td>
                                                <td><?= $barang['barang_keadaan']; ?></td>
                                                <td><?= $barang['lokasi_fk']; ?></td>
                                                <td>
                                                    <div class="btn-group btn-block">
                                                        <a href="<?= base_url('peminjam/barangpinjaman/' . $barang['barang_kode']); ?>" class="btn btn-info">Detail</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-lg-2"><i class="fas fa-check mr-3"></i>Ajukan Peminjaman Barang</button>
                    <a href="<?= base_url('/peminjam'); ?>" class="btn btn-danger mt-lg-2"><i class="fas fa-times mr-3"></i>Batal</a>
                </form>

            </div>
        </div>
    </div>
</main>


<?= $this->endSection('content'); ?>