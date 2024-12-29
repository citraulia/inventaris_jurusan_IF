<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Aset</title>
    <link href="<?= base_url('css/landing.css'); ?>" rel="stylesheet" />
    <link rel="icon" type="image/png" href="<?= base_url('img/logo_sakti.png'); ?>" sizes="32x32">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?= $this->include('landing/navbar'); ?>

    <!-- Home Section -->
    <section id="home" class="landing-home text-left py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 text-white">Manajemen Aset</h1>
                    <p class="lead text-white">Kelola dan pantau inventaris departemen Anda secara efisien.</p>
                    <a href="#statistik" class="btn btn-primary"> lihat Statistik</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2>About Us</h2>
                    <p>Manajemen Aset adalah solusi digital yang dirancang untuk membantu institusi pendidikan dalam mengelola dan memantau aset atau barang yang dimiliki secara efisien. Aplikasi ini menyederhanakan proses pelacakan inventaris dan memastikan transparansi serta efisiensi dalam pengelolaannya.</p>
                </div>
                <div class="col-md-6">
                    <img src="<?= base_url('img/about.jpg'); ?>" alt="About Us" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik Section -->
    <section id="statistik" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center">Statistik Inventaris</h2>
            <div class="row">
                <div class="col-md-6">
                    <h5>Kategori Barang</h5>
                    <canvas id="kategoriChart"></canvas>
                </div>
                <div class="col-md-6">
                    <h5>Kondisi Barang</h5>
                    <canvas id="keadaanChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Kategori Barang Chart
        const kategoriCtx = document.getElementById('kategoriChart').getContext('2d');
        const kategoriChart = new Chart(kategoriCtx, {
            type: 'bar',
            data: {
                labels: <?= $labels; ?>,
                datasets: [{
                    label: 'Jumlah Barang',
                    data: <?= $data; ?>,
                    backgroundColor: '#ffd964',
                }]
            },
        });

        // Keadaan Barang Chart
        const keadaanCtx = document.getElementById('keadaanChart').getContext('2d');
        const keadaanChart = new Chart(keadaanCtx, {
            type: 'pie',
            data: {
                labels: ['Baik', 'Rusak', 'Dipinjam'],
                datasets: [{
                    data: [
                        <?= $totalActive; ?>,
                        <?= $totalInactive; ?>,
                        <?= $totalDipinjam; ?>
                    ],
                    backgroundColor: [
                        '#4a53fa',
                        '#ff3b4b',
                        '#ffd964'
                    ],
                }]
            },
        });
    </script>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Kolom Logo dan Teknik Informatika -->
                <div class="col-md-3">
                    <img src="<?= base_url('img/logo-if.png'); ?>" alt="Logo IF" class="img-fluid mb-2" style="max-height: 50px;">
                    <img src="<?= base_url('img/logo_sakti.png'); ?>" alt="Logo SAKTI" class="img-fluid mb-2" style="max-height: 50px;">
                    <h5>Teknik Informatika</h5>
                    <p>
                        Universitas Islam Negeri Sunan Gunung Djati<br>
                        Jalan A.H Nasution No. 105, Cibiru, Kota Bandung, Jawa Barat 40614
                    </p>
                </div>
                <!-- Kolom Layanan Akademik -->
                <div class="col-md-3">
                    <h5>Layanan Akademik</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-black">Sistem Informasi Layanan Akademik (SALAM)</a></li>
                        <li><a href="#" class="text-black">Learning Management Sistem (LMS)</a></li>
                        <li><a href="#" class="text-black">E-Library UIN Sunan Gunung Djati</a></li>
                        <li><a href="#" class="text-black">Jurnal Online Informatika</a></li>
                    </ul>
                </div>
                <!-- Kolom Akses Cepat -->
                <div class="col-md-3">
                    <h5>Akses Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-black">Fakultas Sains dan Teknologi</a></li>
                        <li><a href="#" class="text-black">UIN Sunan Gunung Djati</a></li>
                        <li><a href="#" class="text-black">SINTA Dikti Kemendikbud RI</a></li>
                        <li><a href="#" class="text-black">Pangkalan Data DIKTI Kemendikbud RI</a></li>
                    </ul>
                </div>
            </div>
            <!--<hr class="my-3">
            <div class="copyrights">
                <p class="mb-0">&copy; Copyrightss. All rights reserved. <a href="https://if.uinsgd.ac.id" class="text-black">if.uinsgd.ac.id</a></p>
            </div> -->
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
