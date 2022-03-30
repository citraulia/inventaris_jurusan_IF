<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Tambah Lokasi Barang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/lokasibarang'); ?>">Lokasi Barang</a></li>
            <li class="breadcrumb-item active">Tambah Lokasi Barang</li>
        </ol>
        <div class="card border-dark mb-3">
            <div class=" card-header">Tambah Lokasi Barang Inventaris Jurusan</div>
            <div class="card-body text-dark">
                <form action="<?= base_url('jurusan/lokasibarang/save'); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputKode">Kode Ruangan</label>
                            <input type="text" class="form-control <?= ($validation->hasError('kode')) ? 'is-invalid' : ''; ?>" id="inputKode" name="kode" value="<?= old('kode'); ?>" autofocus>
                            <div id="kodeFeedback" class="invalid-feedback">
                                <?= $validation->getError('kode'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="inputNama">Nama Ruangan</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="inputNama" name="nama" value="<?= old('nama'); ?>" autofocus>
                            <div id="namaFeedback" class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputLantai">Lantai</label>
                            <input type="number" min="1" max="5" class="form-control <?= ($validation->hasError('lantai')) ? 'is-invalid' : ''; ?>" id="inputLantai" name="lantai" value="<?= old('lantai'); ?>">
                            <div id="lantaiFeedback" class="invalid-feedback">
                                <?= $validation->getError('lantai'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="inputFakultas">Fakultas</label>
                            <input type="text" class="form-control <?= ($validation->hasError('fakultas')) ? 'is-invalid' : ''; ?>" id="inputFakultas" name="fakultas" value="<?= (old('fakultas')) ? old('fakultas') : "Sains dan Teknologi"; ?>">
                            <div id="fakultasFeedback" class="invalid-feedback">
                                <?= $validation->getError('fakultas'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputKeterangan">Keterangan</label>
                        <input type="text" class="form-control" id="inputKeterangan" name="keterangan" value="<?= old('keterangan'); ?>">
                    </div>

                    <button type="submit" class="btn btn-success mt-lg-2"><i class="fas fa-check mr-3"></i>Simpan Data</button>
                    <a href="<?= base_url('jurusan/lokasibarang'); ?>" class="btn btn-danger mt-lg-2"><i class="fas fa-times mr-3"></i>Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>