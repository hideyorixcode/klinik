<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title> <?= $judul ?></title>
    <meta name="keywords" content="<?= $keyword_web ?>"/>
    <meta name="description" content="<?= $deskripsi_web ?>">
    <meta name="author" content="<?= $author ?>">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <?= $this->include('backend/basecss'); ?>
    <!-- App favicon -->
    <?= $this->renderSection('css'); ?>
</head>

<body>
<section class="body">
    <!-- Topbar Start -->
    <?= $this->include('frontend/header'); ?>
    <!-- end Topbar -->
    <div class="inner-wrapper">
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