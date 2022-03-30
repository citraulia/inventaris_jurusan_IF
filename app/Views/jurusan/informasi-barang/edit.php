<!-- Get nama Barang Status -->
<?php if ($informasiBarang['barang_status'] == 1) {
    $status = 'ACTIVE';
} else if ($informasiBarang['barang_status'] == 0) {
    $status = 'INACTIVE';
} else if ($informasiBarang['barang_status'] == 2) {
    $status = 'SEDANG DIPINJAM';
} ?>
<!-- Get nama Barang Status selesai -->

<!-- Get Status Peminjaman Barang -->
<?php if ($informasiBarang['barang_dipinjamkan'] == 1) {
    $dipinjamkan = 'BOLEH DIPINJAMKAN';
} else if ($informasiBarang['barang_dipinjamkan'] == 0) {
    $dipinjamkan = 'TIDAK DIPINJAMKAN';
} ?>
<!-- Get Status Peminjaman Barang Selesai -->

<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Edit <?= $informasiBarang['barang_nama']; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/informasibarang'); ?>">Informasi Barang</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/informasibarang/' . $informasiBarang['barang_kode']); ?>">Detail Barang</a></li>
            <li class="breadcrumb-item active">Edit Barang</li>
        </ol>
        <div class="card border-dark mb-3">
            <div class=" card-header">Edit <?= $informasiBarang['barang_nama']; ?></div>
            <div class="card-body text-dark">
                <form action="<?= base_url('jurusan/informasibarang/update/' . $informasiBarang['barang_id']); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kode">Kode Barang</label>
                            <input type="text" class="form-control" id="kode" name="kode" style="font-weight: bold;" value="<?= $informasiBarang['barang_kode']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama">Nama Barang</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= (old('nama')) ? old('nama') : $informasiBarang['barang_nama']; ?>" autofocus>
                            <div id="namaFeedback" class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="merk">Merk</label>
                            <input type="text" class="form-control <?= ($validation->hasError('merk')) ? 'is-invalid' : ''; ?>" id="merk" name="merk" value="<?= (old('merk')) ? old('merk') : $informasiBarang['barang_merk']; ?>">
                            <div id="merkFeedback" class="invalid-feedback">
                                <?= $validation->getError('merk'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kategori">Kategori</label>
                            <select class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>" id="kategori" name="kategori">
                                <?php foreach ($kategoriBarang as $kategori) : ?>
                                    <option <?= ($informasiBarang['kategori_fk'] == $kategori['kategori_nama']) ? 'selected' : ''; ?>><?= $kategori['kategori_nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="kategoriFeedback" class="invalid-feedback">
                                <?= $validation->getError('kategori'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lokasi">Lokasi</label>
                            <select class="form-control <?= ($validation->hasError('lokasi')) ? 'is-invalid' : ''; ?>" id="lokasi" name="lokasi" value="<?= old('lokasi'); ?>">
                                <?php foreach ($lokasiBarang as $lokasi) : ?>
                                    <option value="<?= $lokasi['lokasi_kode']; ?>" <?= ($informasiBarang['lokasi_fk'] == $lokasi['lokasi_kode']) ? 'selected' : ''; ?>><?= ($lokasi['lokasi_nama']) ? $lokasi['lokasi_kode'] . " - " . $lokasi['lokasi_nama'] : $lokasi['lokasi_kode']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="lokasiFeedback" class="invalid-feedback">
                                <?= $validation->getError('lokasi'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" value="<?= (old('deskripsi')) ? old('deskripsi') : $informasiBarang['barang_deskripsi']; ?>">
                        <div id="deskripsiFeedback" class="invalid-feedback">
                            <?= $validation->getError('deskripsi'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="keadaan">Keadaan Barang</label>
                            <select class="form-control <?= ($validation->hasError('keadaan')) ? 'is-invalid' : ''; ?>" id="keadaan" name="keadaan" value="<?= old('keadaan'); ?>">
                                <option <?= ($informasiBarang['barang_keadaan'] == 'BAIK') ? 'selected' : ''; ?>>BAIK</option>
                                <option <?= ($informasiBarang['barang_keadaan'] == 'RUSAK') ? 'selected' : ''; ?>>RUSAK</option>
                            </select>
                            <div id="keadaanFeedback" class="invalid-feedback">
                                <?= $validation->getError('keadaan'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tahun">Tahun Perolehan</label>
                            <input type="year" class="form-control <?= ($validation->hasError('tahun')) ? 'is-invalid' : ''; ?>" id="tahun" name="tahun" value="<?= (old('tahun')) ? old('tahun') : $informasiBarang['barang_tahun_perolehan']; ?>">
                            <div id="tahunFeedback" class="invalid-feedback">
                                <?= $validation->getError('tahun'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="harga">Harga Barang</label>
                            <input type="number" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= (old('harga')) ? old('harga') : $informasiBarang['barang_harga']; ?>">
                            <div id="hargaFeedback" class="invalid-feedback">
                                <?= $validation->getError('harga'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= (old('keterangan')) ? old('keterangan') : $informasiBarang['barang_keterangan']; ?>">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="status">Status Keaktifan Barang</label>
                            <input type="text" class="form-control" id="status" name="status" style="font-weight: bold;" value="<?= $status; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dipinjamkan">Apakah Barang Boleh Dipinjamkan?</label>
                            <?php if ($informasiBarang['barang_status'] == 1) : ?>
                                <select class="custom-select form-control <?= ($validation->hasError('dipinjamkan')) ? 'is-invalid' : ''; ?>" id="dipinjamkan" name="dipinjamkan">
                                    <option <?= ($informasiBarang['barang_dipinjamkan'] == '0') ? 'selected' : ''; ?> value="0">Tidak Dipinjamkan</option>
                                    <option <?= ($informasiBarang['barang_dipinjamkan'] == '1') ? 'selected' : ''; ?> value="1">Boleh Dipinjamkan</option>
                                </select>
                            <?php endif; ?>

                            <?php if ($informasiBarang['barang_status'] == 0 || $informasiBarang['barang_status'] == 2) : ?>
                                <input type="text" class="form-control" id="dipinjamkan" name="dipinjamkan" style="font-weight: bold;" value="<?= $informasiBarang['barang_dipinjamkan']; ?>" readonly />
                            <?php endif; ?>

                            <div id="dipinjamkanFeedback" class="invalid-feedback">
                                <?= $validation->getError('dipinjamkan'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="foto">Tambah Foto Barang</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto[]" multiple>
                            <div id="fotoFeedback" class="invalid-feedback">
                                <?= $validation->getError('foto'); ?>
                            </div>
                            <label class="custom-file-label" for="foto">Masukan Foto Barang...</label>
                        </div>
                        <div class="mt-lg-2 gallery">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-lg-2"><i class="fas fa-check mr-3"></i>Simpan Perubahan Data</button>
                    <a href="<?= base_url('jurusan/informasibarang/' . $informasiBarang['barang_kode']); ?>" class="btn btn-danger mt-lg-2"><i class="fas fa-times mr-3"></i>Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>