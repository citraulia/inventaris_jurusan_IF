<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="<?= base_url('jurusan'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Inventarisasi</div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBarang" aria-expanded="false" aria-controls="collapseBarang">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Barang
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseBarang" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url('jurusan/informasibarang'); ?>">Informasi Barang</a>
                            <a class="nav-link" href="<?= base_url('jurusan/kategoribarang'); ?>">Kategori Barang</a>
                            <a class="nav-link" href="<?= base_url('jurusan/lokasibarang'); ?>">Lokasi Barang</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRiwayat" aria-expanded="false" aria-controls="collapseRiwayat">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Riwayat
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseRiwayat" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url('jurusan/pengelolaan'); ?>">Riwayat Pengelolaan</a>
                            <a class="nav-link" href="<?= base_url('jurusan/peminjaman'); ?>">Riwayat Peminjaman</a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Users</div>
                    <a class="nav-link" href="<?= base_url('jurusan/userjurusan'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        User Jurusan
                    </a>
                    <a class="nav-link" href="<?= base_url('jurusan/userpeminjam'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        User Peminjam
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?= session('nama'); ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">