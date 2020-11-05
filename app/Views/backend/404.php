<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        ERROR 404 NOT FOUND
    </title>
    <meta name="description" content="Big Error">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="<?= base_url('public/css/vendors.bundle.css') ?>">
    <link rel="stylesheet" media="screen, print" href="<?= base_url('public/css/app.bundle.css') ?>">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('public/img/favicon/favicon.ico') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('public/img/favicon/favicon.ico') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('public/img/favicon/favicon.ico') ?>">
    <link rel="mask-icon" href="<?= base_url('public/img/favicon/safari-pinned-tab.svg') ?>" color="#5bbad5">
    <!-- Optional: page related CSS-->
</head>
<body>
<!-- BEGIN Page Wrapper -->
<div class="page-wrapper alt">
    <!-- BEGIN Page Content -->
    <!-- the #js-page-content id is needed for some plugins to initialize -->
    <main id="js-page-content" role="main" class="page-content">
        <div class="h-alt-f d-flex flex-column align-items-center justify-content-center text-center">
            <h1 class="page-error color-fusion-500">
                ERROR <span class="text-gradient">404</span>
                <small class="fw-500">
                    Terjadi <u>Masalah</u> !!!
                </small>
            </h1>
            <h3 class="fw-500 mb-5">
                Halaman yang anda cari tidak ditemukan, kembali ke <a href="<?= base_url('dashboard') ?>"> Dashboard</a>
            </h3>

        </div>
    </main>
    <!-- END Page Content -->
    <!-- BEGIN Page Footer -->
</div>

<script src="<?= base_url('public/js/vendors.bundle.js') ?>"></script>
<script src="<?= base_url('public/js/app.bundle.js') ?>"></script>
</body>
</html>
