<?= $this->extend('peminjam/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">My Profile</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('peminjam'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">My Profile</li>
        </ol>

        <!-- Flash Session -->
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <!-- End Flash Session -->

        <div class="card border-dark mb-3">
            <div class=" card-header">Profil Saya</div>
            <div class="card-body text-dark">
                <form action="<?= base_url('Peminjam/MyProfile/update/' . $userPeminjam['peminjam_id']); ?>" method="POST">
                    <input type="hidden" name="slug" value="<?= session('slug'); ?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="small mb-1" for="inputNama">Nama</label>
                            <input type="text" class="form-control py-4 <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="inputNama" name="nama" value="<?= (old('nama')) ? old('nama') : session('nama'); ?>">
                            <div id="namaFeedback" class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small mb-1" for="inputHp">Nomor Hp</label>
                            <input type="tel" class="form-control py-4 <?= ($validation->hasError('hp')) ? 'is-invalid' : ''; ?>" id="inputHp" name="hp" pattern="[0-9]{9-13}" value="<?= (old('hp')) ? old('hp') : $userPeminjam['peminjam_hp']; ?>">
                            <small>Format: 082112345678</small>
                            <div id="hpFeedback" class="invalid-feedback">
                                <?= $validation->getError('hp'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="small mb-1" for="inputAlamat">Alamat</label>
                        <input type="text" class="form-control py-4 <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="inputAlamat" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $userPeminjam['peminjam_alamat']; ?>">
                        <div id="alamatFeedback" class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                    <p style="font-weight: bold;">Please re-enter or change password to confirm</p>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="small mb-1" for="inputUsername">Username</label>
                            <input type="text" class="form-control py-4 <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="inputUsername" name="username" value="<?= (old('username')) ? old('username') : session('username'); ?>">
                            <div id="usernameFeedback" class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="small mb-1" for="inputPassword">Password</label>
                            <input type="password" class="form-control py-4 <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="inputPassword" name="password" value="<?= $userPeminjam['peminjam_password']; ?>">
                            <div id="passwordFeedback" class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                            <input type="password" class="form-control py-4 <?= ($validation->hasError('confirmPassword')) ? 'is-invalid' : ''; ?>" id="inputConfirmPassword" name="confirmPassword" value="<?= $userPeminjam['peminjam_password']; ?>">
                            <div id="confirmPasswordFeedback" class="invalid-feedback">
                                <?= $validation->getError('confirmPassword'); ?>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-lg-2"><i class="fas fa-check mr-3"></i>Simpan Perubahan Data</button>
                    <a href="<?= base_url('peminjam'); ?>" class="btn btn-danger mt-lg-2"><i class="fas fa-times mr-3"></i>Batal</a>
                </form>

            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>