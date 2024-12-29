<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="<?= base_url('peminjam'); ?>">
        <img src="<?= base_url('img/logo_sakti.png'); ?>" alt="Logo" style="height: 30px; margin-right: 10px;">
        Peminjaman Barang
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url('peminjam/myprofile/' . session('slug')); ?>">My Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('Auth/logout'); ?>">Logout</a>
            </div>
        </li>
    </ul>
</nav>