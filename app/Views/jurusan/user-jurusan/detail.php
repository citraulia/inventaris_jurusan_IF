<?= $this->extend('jurusan/layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Detail <?= $userJurusan['user_nama']; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('jurusan/userjurusan'); ?>">User Jurusan</a></li>
            <li class="breadcrumb-item active">Detail User Jurusan</li>
        </ol>
        <div class="card border-dark mb-3">
            <div class=" card-header">Detail dari <?= $userJurusan['user_nama']; ?></div>
            <div class="card-body text-dark">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="readName">Nama</label>
                            <input type="text" class="form-control" id="readName" name="name" style="font-weight: bold;" value="<?= $userJurusan['user_nama']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="readPosisi">Posisi</label>
                            <input type="text" class="form-control" id="readPosisi" name="posisi" style="font-weight: bold;" value="<?= $userJurusan['user_posisi']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="readNip">NIP.</label>
                        <input type="text" class="form-control" id="readNip" name="nip" style="font-weight: bold;" value="<?= $userJurusan['user_nip']; ?>" readonly>
                    </div>
                    <div class="form-row mt-lg-1">
                        <div class="form-group col-md-6">
                            <label for="readUsername">Username</label>
                            <input type="text" class="form-control" id="readUsername" name="username" style="font-weight: bold;" value="<?= $userJurusan['user_username']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="readPassword">Password</label>
                            <input type="password" class="form-control" id="readPassword" name="password" style="font-weight: bold;" value="<?= $userJurusan['user_password']; ?>" readonly>
                        </div>
                    </div>
                </form>

                <?php if (allow('3')) : ?>
                    <!-- Buttons -->
                    <a href="<?= base_url('jurusan/userjurusan/edit/' . $userJurusan['user_slug']); ?>" class="btn btn-warning mt-lg-3"><i class="fas fa-pen mr-3"></i>Edit</a>

                    <?php if ($userJurusan['user_level'] == '3') : ?>
                        <form action="<?= base_url('jurusan/userjurusan/' . $userJurusan['user_id']); ?>" method="POST" class="d-inline">
                            <?= csrf_field(); ?>
                            <Input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger mt-lg-3" onclick="return confirm('Apakah anda yakin?');"><i class="fas fa-trash mr-3"></i>Delete</a>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>