<?= $this->extend('user-login/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4"><?= $title; ?></h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('UserLogin/save'); ?>" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="inputNama">Nama</label>
                                    <input type="text" class="form-control py-4 <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="inputNama" name="nama" placeholder="Masukan nama Anda" value="<?= old('nama'); ?>" autofocus>
                                    <div id="namaFeedback" class="invalid-feedback">
                                        <?= $validation->getError('nama'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="inputHp">Nomor Hp</label>
                                    <input type="tel" class="form-control py-4 <?= ($validation->hasError('hp')) ? 'is-invalid' : ''; ?>" id="inputHp" name="hp" placeholder="Masukan Nomor Hp Anda" pattern="[0-9]{9-13}" value="<?= old('hp'); ?>">
                                    <small>Format: 082112345678</small>
                                    <div id="hpFeedback" class="invalid-feedback">
                                        <?= $validation->getError('hp'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="inputAlamat">Alamat</label>
                                <input type="text" class="form-control py-4 <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="inputAlamat" name="alamat" placeholder="Masukan alamat Anda" value="<?= old('alamat'); ?>">
                                <div id="alamatFeedback" class="invalid-feedback">
                                    <?= $validation->getError('alamat'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="inputUsername">Username</label>
                                <input type="text" class="form-control py-4 <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="inputUsername" placeholder="Masukan username Anda" name="username" value="<?= old('username'); ?>">
                                <div id="usernameFeedback" class="invalid-feedback">
                                    <?= $validation->getError('username'); ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="inputPassword">Password</label>
                                    <input type="password" class="form-control py-4 <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="inputPassword" name="password" placeholder="Masukan password Anda">
                                    <div id="passwordFeedback" class="invalid-feedback">
                                        <?= $validation->getError('password'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control py-4 <?= ($validation->hasError('confirmPassword')) ? 'is-invalid' : ''; ?>" id="inputConfirmPassword" name="confirmPassword" placeholder="Masukan Kembali password Anda">
                                    <div id="confirmPasswordFeedback" class="invalid-feedback">
                                        <?= $validation->getError('confirmPassword'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-flex flex-row-reverse mt-4 mb-0">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small"><a href="/">Sudah punya akun? Ayo login!</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection('content'); ?>