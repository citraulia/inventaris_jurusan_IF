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

                    <!-- Flash Session -->
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <!-- End Flash Session -->

                    <!-- Wrong Username and Password Flash Session -->
                    <?php if (session()->getFlashdata('gagal')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('gagal'); ?>
                        </div>
                    <?php endif; ?>
                    <!-- End Wrong Username and Password Flash Session -->

                    <div class="card-body">
                        <form action=<?= base_url('Auth/loginJurusan'); ?>>
                            <div class="form-group">
                                <label class="small mb-1" for="inputUsername">Username</label>
                                <input type="text" class="form-control py-4" id="inputUsername" name="username" placeholder="Masukan username Anda" autofocus />
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="password">Password</label>
                                <input type="password" class="form-control py-4" id="password" name="password" placeholder="Masukan password Anda" />
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="login">Peminjam Login</a>
                                <button type="submit" class="btn btn-primary" href="#">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection('content'); ?>