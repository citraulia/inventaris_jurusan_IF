<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Tambah Barang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/informasiBarang'); ?>">Informasi Barang</a></li>
            <li class="breadcrumb-item active">Tambah Barang</li>
        </ol>
        <div class="card border-dark mb-3">
            <div class=" card-header">Tambah Barang</div>
            <div class="card-body text-dark">
                <form action="<?= base_url('jurusan/informasibarang/save'); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="nama">Nama Barang</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama'); ?>" autofocus>
                        <div id="namaFeedback" class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="merk">Merk</label>
                            <input type="text" class="form-control <?= ($validation->hasError('merk')) ? 'is-invalid' : ''; ?>" id="merk" name="merk" value="<?= old('merk'); ?>">
                            <div id="merkFeedback" class="invalid-feedback">
                                <?= $validation->getError('merk'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kategori">Kategori</label>
                            <select class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>" id="kategori" name="kategori">
                                <option selected></option>
                                <?php foreach ($kategoriBarang as $kategori) : ?>
                                    <option><?= $kategori['kategori_nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="kategoriFeedback" class="invalid-feedback">
                                <?= $validation->getError('kategori'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lokasi">Lokasi</label>
                            <select class="form-control <?= ($validation->hasError('lokasi')) ? 'is-invalid' : ''; ?>" id="lokasi" name="lokasi" value="<?= old('lokasi'); ?>">
                                <option selected></option>
                                <?php foreach ($lokasiBarang as $lokasi) : ?>
                                    <option value="<?= $lokasi['lokasi_kode']; ?>"><?= ($lokasi['lokasi_nama']) ? $lokasi['lokasi_kode'] . " - " . $lokasi['lokasi_nama'] : $lokasi['lokasi_kode']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="lokasiFeedback" class="invalid-feedback">
                                <?= $validation->getError('lokasi'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" value="<?= old('deskripsi'); ?>">
                        <div id="deskripsiFeedback" class="invalid-feedback">
                            <?= $validation->getError('deskripsi'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="keadaan">Keadaan Barang</label>
                            <select class="form-control <?= ($validation->hasError('keadaan')) ? 'is-invalid' : ''; ?>" id="keadaan" name="keadaan" value="<?= old('keadaan'); ?>">
                                <option selected></option>
                                <option>BAIK</option>
                                <option>RUSAK</option>
                            </select>
                            <div id="keadaanFeedback" class="invalid-feedback">
                                <?= $validation->getError('keadaan'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tahun">Tahun Perolehan</label>
                            <input type="year" class="form-control <?= ($validation->hasError('tahun')) ? 'is-invalid' : ''; ?>" id="tahun" name="tahun" value="<?= old('tahun'); ?>">
                            <div id="tahunFeedback" class="invalid-feedback">
                                <?= $validation->getError('tahun'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="harga">Harga Barang</label>
                            <input type="number" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= old('harga'); ?>">
                            <div id="hargaFeedback" class="invalid-feedback">
                                <?= $validation->getError('harga'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= old('keterangan'); ?>">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="status">Status Keaktifan Barang</label>
                            <input type="text" class="form-control" id="status" name="status" style="font-weight: bold;" value="ACTIVE" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dipinjamkan">Apakah Barang Boleh Dipinjamkan?</label>
                            <select class="custom-select form-control <?= ($validation->hasError('dipinjamkan')) ? 'is-invalid' : ''; ?>" id="dipinjamkan" name="dipinjamkan">
                                <option selected></option>
                                <option value="0">Tidak Dipinjamkan</option>
                                <option value="1">Boleh Dipinjamkan</option>
                            </select>
                            <div id="dipinjamkanFeedback" class="invalid-feedback">
                                <?= $validation->getError('dipinjamkan'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto-Foto Barang</label>
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

                    <button type="submit" class="btn btn-success mt-lg-2"><i class="fas fa-check mr-3"></i>Simpan Data</button>
                    <a href="<?= base_url('jurusan/informasibarang'); ?>" class="btn btn-danger mt-lg-2"><i class="fas fa-times mr-3"></i>Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>