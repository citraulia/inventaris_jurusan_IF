<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Tambah Admin Jurusan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/userjurusan'); ?>">User Jurusan</a></li>
            <li class="breadcrumb-item active">Tambah Admin Jurusan</li>
        </ol>
        <div class="card border-dark mb-3">
            <div class=" card-header">Tambah Admin</div>
            <div class="card-body text-dark">
                <form action="<?= base_url('jurusan/userjurusan/save'); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNama">Nama</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="inputNama" name="nama" value="<?= old('nama'); ?>" />
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="readPosisi">Posisi</label>
                            <input type="text" class="form-control" id="readPosisi" name="posisi" style="font-weight: bold;" placeholder="Admin Jurusan" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNip">NIP.</label>
                        <input type="num" class="form-control <?= ($validation->hasError('nip')) ? 'is-invalid' : ''; ?>" id="inputNip" name="nip" value="<?= old('nip'); ?>" />
                        <div class="invalid-feedback">
                            <?= $validation->getError('nip'); ?>
                        </div>
                    </div>
                    <div class="form-row mt-lg-1">
                        <div class="form-group col-md-4">
                            <label for="inputUsername">Username</label>
                            <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="inputUsername" name="username" value="<?= old('username'); ?>" />
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="inputPassword" name="password" />
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputConfirmPassword">Confirm Password</label>
                            <input type="password" class="form-control <?= ($validation->hasError('confirmPassword')) ? 'is-invalid' : ''; ?>" id="inputConfirmPassword" name="confirmPassword" />
                            <div class="invalid-feedback">
                                <?= $validation->getError('confirmPassword'); ?>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-lg-3"><i class="fas fa-check mr-3"></i>Tambah Data Admin</button>
                    <a href="<?= base_url('jurusan/userjurusan'); ?>" class="btn btn-danger mt-lg-3"><i class="fas fa-times mr-3"></i>Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>