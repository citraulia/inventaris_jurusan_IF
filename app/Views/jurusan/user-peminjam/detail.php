<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Detail <?= $userPeminjam['peminjam_nama']; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/userpeminjam'); ?>">User Peminjam</a></li>
            <li class="breadcrumb-item active">Detail User Peminjam</li>
        </ol>
        <div class="card border-dark mb-3">
            <div class=" card-header">Detail dari <?= $userPeminjam['peminjam_nama']; ?></div>
            <div class="card-body text-dark">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="readNama">Nama</label>
                            <input type="text" class="form-control" id="readNama" name="nama" style="font-weight: bold;" value="<?= $userPeminjam['peminjam_nama']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="readHp">Nomor Hp</label>
                            <input type="text" class="form-control" id="readHp" name="hp" style="font-weight: bold;" value="<?= $userPeminjam['peminjam_hp']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="readAlamat">Alamat</label>
                        <input type="text" class="form-control" id="readAlamat" name="alamat" style="font-weight: bold;" value="<?= $userPeminjam['peminjam_alamat']; ?>" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="readUsername">Username</label>
                            <input type="text" class="form-control" id="readUsername" name="username" style="font-weight: bold;" value="<?= $userPeminjam['peminjam_username']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="readPassword">Password</label>
                            <input type="password" class="form-control" id="readPassword" name="password" style="font-weight: bold;" value="<?= $userPeminjam['peminjam_password']; ?>" readonly>
                        </div>
                    </div>
                </form>

                <?php if (allow('3')) : ?>
                    <a href="<?= base_url('jurusan/userpeminjam/edit/' . $userPeminjam['peminjam_slug']); ?>" class="btn btn-warning mt-lg-2"><i class="fas fa-pen mr-3"></i>Edit</a>
                    <form action="<?= base_url('jurusan/userpeminjam/' . $userPeminjam['peminjam_id']); ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger mt-lg-2" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-times mr-3"></i>Delete</button>
                    </form>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>