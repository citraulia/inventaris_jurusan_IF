<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title; ?></title>
    <link href="<?= base_url('css/styles.css'); ?>" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= base_url('img/logo_sakti.png'); ?>" sizes="32x32">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>

<?php
$url = $_SERVER['REQUEST_URI'];
$bgClass = (strpos($url, 'jurusanlogin') !== false) ? 'bg-jurusan' : 'bg-peminjam';
?>
<body class="<?= $bgClass; ?>">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">

            <?= $this->renderSection('content'); ?>

        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-2 bg-light mt-5">
                <div class="container-fluid">
                    <div class="text-center text-muted small">Copyright &copy; Akbar Hidayatullah Harahap 2020</div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('js/scripts.js'); ?>"></script>
</body>

</html>