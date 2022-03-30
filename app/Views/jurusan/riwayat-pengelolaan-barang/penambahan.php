<!-- Konversi harga barang ke mata uang Rupiah -->
<?php
$amount = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);
$amount->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 0);
$harga = $amount->format($barangPending['pending_harga']);
?>
<!-- Konversi harga barang ke mata uang Rupiah selesai -->

<!-- Get Nama Lokasi -->
<?php
$lokasi = $lokasiBarang->where(['lokasi_kode' => $barangPending['lokasi_fk']])->findAll();
?>
<!-- Get Nama Lokasi -->

<!-- Get nama Barang Pending Status -->
<?php if ($barangPending['pending_status'] == 1) {
    $status = 'ACTIVE';
} else if ($barangPending['pending_status'] == 0) {
    $status = 'INACTIVE';
} else if ($barangPending['pending_status'] == 2) {
    $status = 'SEDANG DIPINJAM';
} ?>
<!-- Get nama Barang Pending Status selesai -->

<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Detail Pengajuan Penambahan Barang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/pengelolaan'); ?>">Riwayat Pengelolaan Barang</a></li>
            <li class="breadcrumb-item active">Detail Pengajuan Penambahan Barang</li>
        </ol>

        <?php if ($pengelolaanBarang['pengelolaan_status'] == 0) : ?>
            <div class="card border-dark mb-3">
                <div class="card-header">Keterangan Penolakan</div>
                <div class="card-body text-dark">
                    <form>
                        <div class="form-group">
                            <label for="readKeteranganPengelolaan">Keterangan</label>
                            <textarea class="form-control" id="readKeteranganPengelolaan" name="keteranganPengelolaan" cols="50" rows="3" style="font-weight: bold;" readonly><?= $pengelolaanBarang['pengelolaan_keterangan']; ?></textarea>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <div class="card border-dark mb-3">
            <div class="card-header">Penambahan <?= $barangPending['pending_nama']; ?></div>
            <div class="card-body text-dark">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kode">Kode Barang</label>
                            <input type="text" class="form-control" id="kode" name="kode" style="font-weight: bold;" value="<?= $barangPending['pending_kode']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" style="font-weight: bold;" value="<?= $barangPending['pending_nama']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="merk">Merk</label>
                            <input type="text" class="form-control" id="merk" name="merk" style="font-weight: bold;" value="<?= $barangPending['pending_merk']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" style="font-weight: bold;" value="<?= $barangPending['kategori_fk']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" style="font-weight: bold;" value="<?= $barangPending['lokasi_fk'] . " - " .  $lokasi[0]['lokasi_nama']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" style="font-weight: bold;" value="<?= $barangPending['pending_deskripsi']; ?>" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="keadaan">Keadaan Barang</label>
                            <input type="text" class="form-control" id="keadaan" name="keadaan" style="font-weight: bold;" value="<?= $barangPending['pending_keadaan']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tahun">Tahun Perolehan</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" style="font-weight: bold;" value="<?= $barangPending['pending_tahun_perolehan']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="harga">Harga Barang</label>
                            <input type="text" class="form-control" id="harga" name="harga" style="font-weight: bold;" value="<?= $harga; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" style="font-weight: bold;" value="<?= $barangPending['pending_keterangan']; ?>" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="status">Status Keaktifan Barang</label>
                            <input type="text" class="form-control" id="status" name="status" style="font-weight: bold;" value="<?= $status; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dipinjamkan">Apakah Barang Boleh Dipinjamkan?</label>
                            <input type="text" class="form-control" id="dipinjamkan" name="dipinjamkan" style="font-weight: bold;" value="<?= ($barangPending['pending_dipinjamkan']) ? 'BOLEH DIPINJAMKAN' : 'TIDAK DIPINJAMKAN'; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto-Foto Barang</label>
                        <div class="mt-lg-2">
                            <?php foreach ($fotoPending as $foto) : ?>
                                <img style="margin-left:5px;" src="<?= '/img/' . $foto['foto_pending_nama']; ?>" class="img-thumbnail text-center" width="300">
                            <?php endforeach ?>
                        </div>
                    </div>
                </form>

                <?php if ($pengelolaanBarang['pengelolaan_status'] == 2) : ?>
                    <?php if (allow('1', '2')) : ?>
                        <form action="<?= base_url('Jurusan/RiwayatPengelolaanBarang/setujui/' . $pengelolaanBarang['pengelolaan_kode'] . '/' . $pengelolaanBarang['barang_fk']); ?>" method="POST">
                            <div class="btn-group mt-2 btn-block col-md-3">
                                <input type="hidden" id="id" name="id" value="<?= $pengelolaanBarang['pengelolaan_id']; ?>" />
                                <button type="submit" href="#" class="btn btn-success mr-2">Setujui</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#editModal<?= $pengelolaanBarang['pengelolaan_kode']; ?><?= $pengelolaanBarang['pengelolaan_id']; ?>">Tolak</button>
                            </div>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>

<!-- Modal Tolak Pengelolaan -->
<div class="modal fade" id="editModal<?= $pengelolaanBarang['pengelolaan_kode']; ?><?= $pengelolaanBarang['pengelolaan_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="<?= base_url('Jurusan/RiwayatPengelolaanBarang/tolak/' . $pengelolaanBarang['pengelolaan_kode']); ?>" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keterangan Penolakan Ajuan "<?= $pengelolaanBarang['jenis_fk']; ?>" Barang (Kode: <?= $pengelolaanBarang['pengelolaan_kode']; ?>)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" cols="50" rows="10" placeholder="Jelaskan alasan penolakan terhadap pengajuan pengelolaan barang."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id" name="id" value="<?= $pengelolaanBarang['pengelolaan_id']; ?>" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- End Modal Edit Product-->
<?= $this->endSection('content'); ?>