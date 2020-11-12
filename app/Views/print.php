<?php
?>
<html>
<head>
    <title><?= $judul; ?></title>
    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?= base_url('public/assets/vendor/bootstrap/css/bootstrap.css') ?>"/>

    <!-- Invoice Print Style -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/invoice-print.css') ?>"/>
    <link rel="shortcut icon" href="<?= base_url('public/uploads/' . $favicon) ?>">
</head>
<body>
<div class="invoice">
    <p style="text-align: center; font-weight: bold; font-size: xx-large"><?= strtoupper($area); ?></p>
    <p style="text-align: center; font-size: large"><?= ($alamat_web); ?></p>
    <hr/>
    <?= $this->renderSection('printcontent'); ?>
</div>

<script>
    window.print();
</script>
</body>
</html>
