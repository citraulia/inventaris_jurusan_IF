<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Detail Ruangan <?= $lokasiBarang['lokasi_kode']; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/lokasibarang'); ?>">Lokasi Barang</a></li>
            <li class="breadcrumb-item active">Detail Lokasi Barang</li>
        </ol>
        <div class="card border-dark mb-3">
            <div class=" card-header">Detail dari <?= $lokasiBarang['lokasi_kode']; ?></div>
            <div class="card-body text-dark">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="readKode">Kode Ruangan</label>
                            <input type="text" class="form-control" id="readKode" name="kode" style="font-weight: bold;" value="<?= $lokasiBarang['lokasi_kode']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="readNama">Nama Ruangan</label>
                            <input type="text" class="form-control" id="readNama" name="nama" style="font-weight: bold;" value="<?= $lokasiBarang['lokasi_nama']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="readLantai">Lantai</label>
                            <input type="text" class="form-control" id="readLantai" name="lantai" style="font-weight: bold;" value="<?= $lokasiBarang['lokasi_lantai']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="readFakultas">Fakultas</label>
                            <input type="text" class="form-control" id="readFakultas" name="fakultas" style="font-weight: bold;" value="<?= $lokasiBarang['lokasi_fakultas']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="readKeterangan">Keterangan</label>
                        <input type="text" class="form-control" id="readKeterangan" name="keterangan" style="font-weight: bold;" value="<?= $lokasiBarang['lokasi_keterangan']; ?>" readonly>
                    </div>
                </form>

                <?php if (allow('3')) : ?>
                    <a href="<?= base_url('jurusan/lokasibarang/edit/' . $lokasiBarang['lokasi_slug']); ?>" class="btn btn-warning mt-lg-2"><i class="fas fa-pen mr-3"></i>Edit</a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>