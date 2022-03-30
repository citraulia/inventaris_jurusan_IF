<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Tambah Kategori Barang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/kategoribarang'); ?>">Kategori Barang</a></li>
            <li class="breadcrumb-item active">Tambah Kategori Barang</li>
        </ol>
        <div class="card border-dark mb-3">
            <div class=" card-header">Tambah Kategori Barang Invetaris Jurusan</div>
            <div class="card-body text-dark">
                <form action="<?= base_url('jurusan/kategoribarang/save'); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="inputNama">Nama Kategori</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="inputNama" name="nama" value="<?= old('nama'); ?>" autofocus>
                        <div id="namaFeedback" class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputKeterangan">Keterangan</label>
                        <input type="text" class="form-control" id="inputKeterangan" name="keterangan" value="<?= old('keterangan'); ?>">
                    </div>

                    <button type="submit" class="btn btn-success mt-lg-2"><i class="fas fa-check mr-3"></i>Simpan Data</button>
                    <a href="<?= base_url('jurusan/kategoribarang'); ?>" class="btn btn-danger mt-lg-2"><i class="fas fa-times mr-3"></i>Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>