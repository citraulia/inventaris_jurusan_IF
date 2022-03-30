<?= $this->extend('user-login/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4"><?= $title; ?></h3>
                    </div>

                    <!-- Save Flash Session -->
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <!-- End Save Flash Session -->

                    <!-- Wrong Username and Password Flash Session -->
                    <?php if (session()->getFlashdata('gagal')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('gagal'); ?>
                        </div>
                    <?php endif; ?>
                    <!-- End Wrong Username and Password Flash Session -->

                    <div class="card-body">
                        <form action="<?= base_url('Auth/login'); ?>">
                            <div class="form-group">
                                <label class="small mb-1" for="inputUsername">Username</label>
                                <input type="text" class="form-control py-4" id="usernameInput" name="username" placeholder="Masukan username Anda" />
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="inputPassword">Password</label>
                                <input type="password" class="form-control py-4" id="inputPassword" name="password" placeholder="Masukan password Anda" />
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href=<?= base_url('jurusanlogin'); ?>>Admin Login</a>
                                <button type="submit" class="btn btn-primary" href="#">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small"><a href=<?= base_url('register'); ?>>Tidak punya akun? Ayo daftar!</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection('content'); ?>