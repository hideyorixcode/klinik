<?= $this->extend('frontend/template'); ?>

<?= $this->section('css'); ?>
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet"
      href="<?= base_url('public/assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') ?>"/>
<link rel="stylesheet"
      href="<?= base_url('public/assets/vendor/datatables/media/css/dataTables.bootstrap4.min.css') ?>"/>
<link rel="stylesheet" href="<?= base_url('public/assets/vendor/select2/css/select2.css') ?>"/>

<?= $this->endSection(); ?>
<!-- end css -->

<?= $this->section('content'); ?>

<section role="main" class="content-body">
    <header class="page-header">
        <h2><?= $judul ?></h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= base_url('') ?>">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span><?= $judul ?></span></li>
            </ol>

            <span class="sidebar-right-toggle"><i class="fas fa-angle-double-down"></i></span>
        </div>
    </header>

    <!-- start: page -->

    <div class="row">
        <div class="col">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    </div>

                    <h2 class="card-title">Layanan Klinik</h2>
                </header>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <div class="mb-3">
                                <a class="btn btn-primary" href="<?= base_url('daftar-layanan') ?>"><i
                                            class="fas fa-plus"></i>
                                    Daftar Layanan
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="tabs">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item active">
                                <a class="nav-link active" href="#div_rekam" data-toggle="tab">Rekam Medis</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#div_konsultasi" data-toggle="tab">Konsultasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#div_surat" data-toggle="tab">Pembuatan Surat</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="div_rekam" class="tab-pane active">
                                <table class="table table-bordered table-striped mb-0" id="hideyori_datatable">
                                    <thead class="th-primary">
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th width="10%">Hari</th>
                                        <th width="20%">Waktu</th>
                                        <th width="20%">Nama Petugas</th>
                                        <th width="20%">Poli</th>
                                        <th width="5%">Active</th>
                                        <th width="15%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div id="div_konsultasi" class="tab-pane">
                                <p>Recent</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitat.</p>
                            </div>
                            <div id="div_surat" class="tab-pane">
                                <p>Surat</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitat.</p>
                            </div>
                        </div>
                    </div>


                </div>
        </div>
    </div>
</section>


<?= $this->endSection(); ?>
<!-- end content -->

<?= $this->section('modal'); ?>

<?= $this->endSection(); ?>
<!-- end modal -->

<?= $this->section('js'); ?>

<script src="<?= base_url('public/assets/vendor/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/assets/vendor/datatables/media/js/dataTables.bootstrap4.min.js') ?>"></script>
<script
        src="<?= base_url('public/assets/vendor/datatables/extras/TableTools/Responsive-2.2.0/js/dataTables.responsive.min.js') ?>">
</script>
<script
        src="<?= base_url('public/assets/vendor/datatables/extras/TableTools/Responsive-2.2.0/js/responsive.bootstrap4.min.js') ?>">
</script>
<script src="<?= base_url('public/assets/vendor/select2/js/select2.js') ?>"></script>

<script>
    var token = "<?=csrf_hash()?>";
    var table;
    var base_url = '<?=base_url();?>';

    $(document).ready(function () {
        $('.select2').select2({
            width: '100%',
            height: '100%'
        });

        $(window).resize(function () {
            $('.select2').css('width', "100%");
        });
    // initialize datatable

</script>
<?= $this->endSection(); ?>
<!-- end js -->