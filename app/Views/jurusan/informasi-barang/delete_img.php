<?php
if (!$fotoBarang) {
    return redirect()->to('/jurusan/informasibarang/' . $informasiBarang['barang_kode']);
}
?>

<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Delete Foto <?= $informasiBarang['barang_nama']; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/informasiBarang'); ?>">Informasi Barang</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/informasibarang/' . $informasiBarang['barang_kode']); ?>">Detail Barang</a></li>
            <li class="breadcrumb-item active">Delete Foto Barang</li>
        </ol>
        <div class="card border-dark mb-3">
            <div class=" card-header">Foto dari <?= $informasiBarang['barang_nama']; ?></div>
            <div class="card-body text-dark">
                <div class="form-group">
                    <label for="foto">Foto-Foto <?= $informasiBarang['barang_nama']; ?></label>
                    <div class="mt-lg-2">
                        <?php foreach ($fotoBarang as $foto) : ?>
                            <form action="<?= base_url('jurusan/informasibarang/foto/' . $foto['foto_id']); ?>" method="POST" class="d-inline">
                                <?= csrf_field(); ?>
                                <Input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="kode" value="<?= $informasiBarang['barang_kode']; ?>">
                                <button type="submit" class="btn btn-group-vertical btn-danger" onclick="return confirm('Apakah anda yakin?');">
                                    <img style="margin-left:5px;" src="<?= '/img/' . $foto['foto_nama']; ?>" class="img-thumbnail text-center" width="300">
                                    Delete Photo
                                </button>
                            </form>
                        <?php endforeach ?>
                    </div>
                </div>
                <a href="<?= base_url('jurusan/informasibarang/' . $informasiBarang['barang_kode']); ?>" class="btn btn-primary mt-lg-2"><i class="fas fa-times mr-3"></i>Selesai</a>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>