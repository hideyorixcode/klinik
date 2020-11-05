<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title> <?= $judul ?></title>
    <meta name="keywords" content="Klinik Template by HideyorixCode"/>
    <meta name="description" content="Klinik - Responsive HTML5 Template">
    <meta name="author" content="hideyorixcode">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <?= $this->include('backend/basecss'); ?>
    <!-- App favicon -->
    <?= $this->renderSection('css'); ?>
</head>

<body>
<section class="body">
    <!-- Topbar Start -->
    <?= $this->include('backend/header'); ?>
    <!-- end Topbar -->
    <div class="inner-wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <?= $this->include('backend/sidebar'); ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <?= $this->renderSection('content'); ?>
        <!-- ============================================================== -->
        <!-- End Page Content -->
    </div>
</section>

<!-- Right Sidebar -->


<?= $this->renderSection('modal'); ?>
<?= $this->include('backend/basejs'); ?>
<?= $this->renderSection('js'); ?>
<!-- Theme Base, Components and Settings -->
<script src="<?= base_url('public/assets/js/theme.js') ?>"></script>
<!-- Theme Custom -->
<script src="<?= base_url('public/assets/js/custom.js') ?>"></script>
<!-- Theme Initialization Files -->
<script src="<?= base_url('public/assets/js/theme.init.js') ?>"></script>
</body>
</html>