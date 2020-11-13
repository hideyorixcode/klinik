<?= $this->extend('backend/template'); ?>

<?= $this->section('css'); ?>
<!-- third party css -->
<!-- third party css end -->
<?= $this->endSection(); ?><!-- end css -->
<?= $this->section('content'); ?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2><?= $judul ?></h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= base_url('dashboard') ?>">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span><?= $judul ?></span></li>
            </ol>

            <span class="sidebar-right-toggle"><i class="fas fa-angle-double-down"></i></span>
        </div>
    </header>

    <div class="row">

        <div class="col-lg-6 col-xl-6">
            <section class="card card-featured-left card-featured-primary mb-4">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-primary">
                                <i class="fas fa-diagnoses"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">DATA PASIEN</h4>
                                <div class="info">
                                    <strong class="amount"><?= $jumlahPasien; ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="card card-featured-left card-featured-secondary mb-4">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-secondary">
                                <i class="fas fa-user-md"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">DATA DOKTER</h4>
                                <div class="info">
                                    <strong class="amount"><?= $jumlahDokter; ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="card card-featured-left card-featured-danger mb-4">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-danger">
                                <i class="fas fa-user-md"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">DATA BIDAN</h4>
                                <div class="info">
                                    <strong class="amount"><?= $jumlahBidan; ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="card card-featured-left card-featured-success mb-4">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-success">
                                <i class="fas fa-clinic-medical"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">DATA POLI</h4>
                                <div class="info">
                                    <strong class="amount"><?= $jumlahPoli; ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
        <div class="col-lg-6 col-xl-6">
            <section class="card card-featured-left card-featured-dark mb-4">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-dark">
                                <i class="fas fa-stopwatch"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">DATA JADWAL</h4>
                                <div class="info">
                                    <strong class="amount"><?= $jumlahJadwal; ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="card card-featured-left card-featured-info mb-4">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-info">
                                <i class="fas fa-book-medical"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">LAYANAN REKAM MEDIS</h4>
                                <div class="info">
                                    <strong class="amount"><?= $jumlahRekam; ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-uppercase"><?= $jumlahRekamSelesai . ' Selesai, ' . $jumlahRekamProses . ' Proses, ' . $jumlahRekamTunda . ' Tunda, ' . $jumlahRekamBatal . ' Batal' ?> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="card card-featured-left card-featured-quaternary mb-4">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-quaternary">
                                <i class="fas fa-comment-medical"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">LAYANAN KONSULTASI</h4>
                                <div class="info">
                                    <strong class="amount"><?= $jumlahSurat; ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-uppercase"><?= $jumlahSuratSelesai . ' Selesai, ' . $jumlahSuratProses . ' Proses, ' . $jumlahSuratTunda . ' Tunda, ' . $jumlahSuratBatal . ' Batal' ?> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="card card-featured-left card-featured-tertiary mb-4">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-tertiary">
                                <i class="fas fa-file-medical"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">LAYANAN PEMBUATAN SURAT</h4>
                                <div class="info">
                                    <strong class="amount"><?= $jumlahSurat; ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-uppercase"><?= $jumlahSuratSelesai . ' Selesai, ' . $jumlahSuratProses . ' Proses, ' . $jumlahSuratTunda . ' Tunda, ' . $jumlahSuratBatal . ' Batal' ?> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
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

