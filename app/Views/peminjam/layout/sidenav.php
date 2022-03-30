<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="<?= base_url('peminjam'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Peminjaman Barang</div>
                    <a class="nav-link" href="<?= base_url('peminjam/pinjambarang'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Pinjam Barang
                    </a>
                    <a class="nav-link" href="<?= base_url('peminjam/barangpinjaman'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Barang yang Dapat Dipinjam
                    </a>
                    <a class="nav-link" href="<?= base_url('peminjam/riwayatpeminjaman/' . session('username')); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Riwayat Peminjaman
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