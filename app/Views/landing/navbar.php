<nav class="navbar navbar-expand-lg" id="custom-navbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= base_url('/'); ?>">
            <img src="<?= base_url('img/logo_sakti.png'); ?>" alt="Logo" style="height: 30px; margin-right: 10px;">
            <span>Manajemen Aset</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#statistik">Statistik</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('/login'); ?>">Login</a></li>
            </ul>
        </div>
    </div>
</nav>
