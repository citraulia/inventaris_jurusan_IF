<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Edit Ruangan <?= $lokasiBarang['lokasi_nama']; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/lokasibarang'); ?>">Lokasi Barang</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/lokasibarang/' . $lokasiBarang['lokasi_slug']); ?>">Detail Ruangan <?= $lokasiBarang['lokasi_nama']; ?></a></li>
            <li class="breadcrumb-item active">Edit Ruangan <?= $lokasiBarang['lokasi_nama']; ?></li>
        </ol>
        <div class="card border-dark mb-3">
            <div class=" card-header">Edit Informasi Ruangan <?= $lokasiBarang['lokasi_nama']; ?></div>
            <div class="card-body text-dark">
                <form action="<?= base_url('jurusan/lokasibarang/update/' . $lokasiBarang['lokasi_id']); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="slug" value="<?= $lokasiBarang['lokasi_slug']; ?>">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputKode">Kode Ruangan</label>
                            <input type="text" class="form-control <?= ($validation->hasError('kode')) ? 'is-invalid' : ''; ?>" id="inputKode" name="kode" value="<?= (old('kode')) ? old('kode') : $lokasiBarang['lokasi_kode']; ?>" autofocus>
                            <div id="kodeFeedback" class="invalid-feedback">
                                <?= $validation->getError('kode'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="inputNama">Nama Ruangan</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="inputNama" name="nama" value="<?= (old('nama')) ? old('nama') : $lokasiBarang['lokasi_nama']; ?>">
                            <div id="namaFeedback" class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputLantai">Lantai</label>
                            <input type="number" min="1" max="5" class="form-control <?= ($validation->hasError('lantai')) ? 'is-invalid' : ''; ?>" id="inputLantai" name="lantai" value="<?= (old('lantai')) ? old('lantai') : $lokasiBarang['lokasi_lantai']; ?>">
                            <div id="lantaiFeedback" class="invalid-feedback">
                                <?= $validation->getError('lantai'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="inputFakultas">Fakultas</label>
                            <input type="text" class="form-control <?= ($validation->hasError('fakultas')) ? 'is-invalid' : ''; ?>" id="inputFakultas" name="fakultas" value="<?= (old('fakultas')) ? old('fakultas') : $lokasiBarang['lokasi_fakultas']; ?>">
                            <div id="fakultasFeedback" class="invalid-feedback">
                                <?= $validation->getError('fakultas'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputKeterangan">Keterangan</label>
                        <input type="text" class="form-control" id="inputKeterangan" name="keterangan" value="<?= (old('keterangan')) ? old('keterangan') : $lokasiBarang['lokasi_keterangan']; ?>">
                    </div>

                    <button type="submit" class="btn btn-success mt-lg-2"><i class="fas fa-check mr-3"></i>Simpan Perubahan Data</button>
                    <a href="<?= base_url('jurusan/lokasibarang/' . $lokasiBarang['lokasi_slug']); ?>" class="btn btn-danger mt-lg-2"><i class="fas fa-times mr-3"></i>Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection('content'); ?>