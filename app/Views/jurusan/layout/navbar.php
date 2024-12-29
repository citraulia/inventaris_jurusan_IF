<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="<?= base_url('jurusan'); ?>">
        <img src="<?= base_url('img/logo_sakti.png'); ?>" alt="Logo" style="height: 30px; margin-right: 10px;">
        Inventaris Jurusan
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto">
        <li class="nav-link dropdown-toggle" id="userDropdown" href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-user fa-fw"></i></li>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?= base_url('jurusan/myprofile/' . session('slug')); ?>">My Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= base_url('Auth/logout'); ?>">Logout</a>
        </div>
    </ul>
</nav>