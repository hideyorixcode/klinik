<?= $this->extend('backend/template'); ?>
<?= $this->section('css'); ?>
<?= $this->endSection(); ?><!-- end css -->
<?= $this->section('content'); ?>
<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?=ucfirst($judul)?></a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">Starter</li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?=ucfirst($judul)?></h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div> <!-- container -->
</div>
<?= $this->endSection(); ?><!-- end content -->
<?= $this->section('modal'); ?>

<?= $this->endSection(); ?>
<!-- end modal -->
<?= $this->section('js'); ?>
<?= $this->endSection(); ?>
