<?= $this->extend('frontend/template'); ?>

<?= $this->section('css'); ?>
<!-- third party css -->
<!-- third party css end -->
<?= $this->endSection(); ?><!-- end css -->
<?= $this->section('content'); ?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2><?= $judul ?></h2>
    </header>

    <div class="row mb-2">
        <div class="col-lg-12 col-xl-12 mb-4 mb-xl-0">

            <section class="card">

                <div class="card-body">
                    <div class="content row">
                        <div class="col-lg-8">
                            <div class="jumbotron">
                                <h1 class="display-4"><?= $nama_app; ?></h1>
                                <p class="lead"><?= $judul_aplikasi; ?></p>
                                <hr class="my-4">
                                <p><?= $deskripsi_web; ?></p>
                                <div class="btn-group flex-wrap pull-left">
                                    <a class="btn btn-sm btn-primary" target="_blank"
                                       href="https://wedearrachman.wixsite.com/home/"><i
                                                class="fas fa-clinic-medical"></i> Kunjungi Website Resmi
                                    </a>
                                    <a class="btn btn-sm btn-info" href="<?= base_url('jadwal') ?>"><i
                                                class="fas fa-clock"></i> Informasi Jadwal Klinik
                                    </a>
                                    <a class="btn btn-sm btn-success" href="<?= base_url('daftar') ?>"><i
                                                class="fas fa-user-check"></i> Form Registrasi
                                    </a>
                                    <a class="btn btn-sm btn-secondary" href="<?= base_url('syslog') ?>"><i
                                                class="fas fa-lock"></i> Login Pasien
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">

                            <img src="<?= $logo_web ? base_url('public/uploads/' . $logo_web) : base_url('public/uploads/nologo.png') ?>"
                                 class="img-thumbnail img-preview">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr class="text-center">
                                    <td class="font-weight-bold" colspan="2"><?= $area; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Email</td>
                                    <td> <?= $email_web; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">No Telp</td>
                                    <td> <?= $notelepon_web; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Alamat</td>
                                    <td> <?= $alamat_web; ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

        </div><!-- end col-->
    </div>

    <!-- start: page -->
    <!-- end: page -->
</section>
<?= $this->endSection(); ?><!-- end content -->

<?= $this->section('modal'); ?>
<?= $this->endSection(); ?><!-- end modal -->

<?= $this->section('js'); ?>
<!-- third party js -->
<?= $this->endSection(); ?><!-- end js -->

