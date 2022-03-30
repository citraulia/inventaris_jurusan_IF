<!-- Konversi harga barang ke mata uang Rupiah -->
<?php
$amount = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);
$amount->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 0);
$harga = $amount->format($informasiBarang['barang_harga']);
?>
<!-- Konversi harga barang ke mata uang Rupiah selesai -->

<!-- Get Nama Lokasi -->
<?php
$lokasi = $lokasiBarang->where(['lokasi_kode' => $informasiBarang['lokasi_fk']])->findAll();
?>
<!-- Get Nama Lokasi -->

<!-- Get nama Barang Status -->
<?php if ($informasiBarang['barang_status'] == 1) {
    $status = 'ACTIVE';
} else if ($informasiBarang['barang_status'] == 0) {
    $status = 'INACTIVE';
} else if ($informasiBarang['barang_status'] == 2) {
    $status = 'SEDANG DIPINJAM';
}
?>
<!-- Get nama Barang Status selesai -->

<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Detail <?= $informasiBarang['barang_nama']; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/informasiBarang'); ?>">Informasi Barang</a></li>
            <li class="breadcrumb-item active">Detail Barang</li>
        </ol>
        <div class="card border-dark mb-3">
            <div class=" card-header">Detail dari <?= $informasiBarang['barang_nama']; ?></div>
            <div class="card-body text-dark">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kode">Kode Barang</label>
                            <input type="text" class="form-control" id="kode" name="kode" style="font-weight: bold;" value="<?= $informasiBarang['barang_kode']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" style="font-weight: bold;" value="<?= $informasiBarang['barang_nama']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="merk">Merk</label>
                            <input type="text" class="form-control" id="merk" name="merk" style="font-weight: bold;" value="<?= $informasiBarang['barang_merk']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" style="font-weight: bold;" value="<?= $informasiBarang['kategori_fk']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" style="font-weight: bold;" value="<?= $informasiBarang['lokasi_fk'] . " - " . $lokasi[0]['lokasi_nama']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" style="font-weight: bold;" value="<?= $informasiBarang['barang_deskripsi']; ?>" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="keadaan">Keadaan Barang</label>
                            <input type="text" class="form-control" id="keadaan" name="keadaan" style="font-weight: bold;" value="<?= $informasiBarang['barang_keadaan']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tahun">Tahun Perolehan</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" style="font-weight: bold;" value="<?= $informasiBarang['barang_tahun_perolehan']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="harga">Harga Barang</label>
                            <input type="text" class="form-control" id="harga" name="harga" style="font-weight: bold;" value="<?= $harga; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" style="font-weight: bold;" value="<?= $informasiBarang['barang_keterangan']; ?>" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="status">Status Keaktifan Barang</label>
                            <input type="text" class="form-control" id="status" name="status" style="font-weight: bold;" value="<?= $status; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dipinjamkan">Apakah Barang Boleh Dipinjamkan?</label>
                            <input type="text" class="form-control" id="dipinjamkan" name="dipinjamkan" style="font-weight: bold;" value="<?= ($informasiBarang['barang_dipinjamkan']) ? 'BOLEH DIPINJAMKAN' : 'TIDAK DIPINJAMKAN'; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto-Foto Barang</label>
                        <div class="mt-lg-2">
                            <?php foreach ($fotoBarang as $foto) : ?>
                                <img style="margin-left:5px;" src="<?= '/img/' . $foto['foto_nama']; ?>" class="img-thumbnail text-center" width="300">
                            <?php endforeach ?>
                        </div>
                    </div>
                </form>
                <?php if ($status != 'INACTIVE') : ?>
                    <?php if (allow('3')) : ?>
                        <a href="<?= base_url('jurusan/informasibarang/edit/' . $informasiBarang['barang_kode']); ?>" class="btn btn-warning mt-lg-2"><i class="fas fa-pen mr-3"></i>Edit</a>

                        <?php if ($status != 'SEDANG DIPINJAM') : ?>
                            <button type="button" class="btn btn-danger mt-lg-2" data-toggle="modal" data-target="#editModal"><i class="fas fa-times mr-3"></i>Delete Barang</button>

                            <?php if ($fotoBarang) : ?>
                                <a href="<?= base_url('jurusan/informasibarang/foto/' . $informasiBarang['barang_kode']); ?>" class="btn btn-danger mt-lg-2"><i class="fas fa-image mr-3"></i>Delete Foto Barang</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<form action="<?= base_url('jurusan/informasibarang/' . $informasiBarang['barang_id']); ?>" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <?= csrf_field(); ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pengajuan Penghapusan Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="keteranganPenghapusan">Keterangan</label>
                        <textarea class="form-control" id="keteranganPenghapusan" name="keteranganPenghapusan" cols="50" rows="10" placeholder="Jelaskan alasan ajuan penghapusan barang."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="kode" value="<?= $informasiBarang['barang_kode']; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection('content'); ?>