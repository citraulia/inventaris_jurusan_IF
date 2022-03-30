<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Edit <?= $userPeminjam['peminjam_nama']; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/userpeminjam'); ?>">User Peminjam</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/userpeminjam/' . $userPeminjam['peminjam_slug']); ?>">Detail User Peminjam</a></li>
            <li class="breadcrumb-item active">Edit User Peminjam</li>
        </ol>
        <div class="card border-dark mb-3">
            <div class=" card-header">Edit Data <?= $userPeminjam['peminjam_nama']; ?></div>
            <div class="card-body text-dark">
                <form action="<?= base_url('jurusan/userpeminjam/update/' . $userPeminjam['peminjam_id']); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="slug" value="<?= $userPeminjam['peminjam_slug']; ?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNama">Nama</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="inputNama" name="nama" value="<?= (old('nama')) ? old('nama') : $userPeminjam['peminjam_nama']; ?>" autofocus>
                            <div id="namaFeedback" class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputHp">Nomor Hp</label>
                            <input type="tel" class="form-control <?= ($validation->hasError('hp')) ? 'is-invalid' : ''; ?>" id="inputHp" name="hp" pattern="[0-9]{9-13}" value="<?= (old('hp')) ? old('hp') : $userPeminjam['peminjam_hp']; ?>">
                            <small>Format: 082112345678</small>
                            <div id="hpFeedback" class="invalid-feedback">
                                <?= $validation->getError('hp'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAlamat">Alamat</label>
                        <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="inputAlamat" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $userPeminjam['peminjam_alamat']; ?>">
                        <div id="alamatFeedback" class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                    <p style="font-weight: bold;">Please re-enter or change password to confirm</p>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputUsername">Username</label>
                            <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="inputUsername" name="username" value="<?= (old('username')) ? old('username') : $userPeminjam['peminjam_username']; ?>">
                            <div id="usernameFeedback" class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="inputPassword" name="password" />
                            <div id="passwordFeedback" class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputConfirmPassword">Password</label>
                            <input type="password" class="form-control <?= ($validation->hasError('confirmPassword')) ? 'is-invalid' : ''; ?>" id="inputConfirmPassword" name="confirmPassword" />
                            <div id="confirmPasswordFeedback" class="invalid-feedback">
                                <?= $validation->getError('confirmPassword'); ?>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-lg-2"><i class="fas fa-check mr-3"></i>Simpan Perubahan Data</button>
                    <a href="<?= base_url('jurusan/userpeminjam/' . $userPeminjam['peminjam_slug']); ?>" class="btn btn-danger mt-lg-2"><i class="fas fa-times mr-3"></i>Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>