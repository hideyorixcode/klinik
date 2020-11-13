<?= $this->extend('backend/template'); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url('public/assets/vendor/select2/css/select2.css') ?>"/>
<link rel="stylesheet"
      href="<?= base_url('public/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') ?>"/>

<?= $this->endSection(); ?>
<!-- end css -->

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

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <section class="card card-dark">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                    </div>

                    <h2 class="card-title">Data Pasien</h2>
                </header>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td class="font-weight-bold">Nama Pasien</td>
                            <td> <?= $dataPasien['nama']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Nama KK</td>
                            <td> <?= $dataPasien['nama_kk']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Jenis Kelamin</td>
                            <td> <?= $dataPasien['jk']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Pekerjaan</td>
                            <td> <?= $dataPasien['pekerjaan']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Alamat</td>
                            <td> <?= $dataPasien['alamat']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Agama</td>
                            <td> <?= $dataPasien['agama']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">No. Telp</td>
                            <td> <?= $dataPasien['notelepon']; ?></td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </section>


        </div>
        <div class="col-lg-8 col-xl-8">
            <section class="card card-secondary">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                    </div>

                    <h2 class="card-title">Form Konsultasi</h2>
                </header>
                <div class="card-body">
                    <form id="form" name="form" method="post" class="p-3" enctype="multipart/form-data"
                          action="<?= base_url('dashboard/layanan/create-konsultasi') ?>" class="form-horizontal">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_daftar" id="id_daftar" value="<?= $id; ?>">

                        <?php if (!empty(session()->getFlashdata('sukses'))) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Sukses!</strong> <?= session()->getFlashdata('sukses'); ?>
                            </div>
                        <?php } ?>

                        <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Gagal!</strong> <?= session()->getFlashdata('gagal'); ?>
                            </div>
                        <?php } ?>


                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Nomor Konsultasi</label>
                            <div class="col-sm-9">
                                <input type="text" id="nomor_konsultasi" name="nomor_konsultasi"
                                       class="form-control <?= ($validation->hasError('nomor_konsultasi')) ? 'is-invalid' : '' ?>"
                                       placeholder="Nomor Konsultasi" required autofocus
                                       value="<?= old('nomor_konsultasi') ? old('nomor_konsultasi') : '' ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nomor_konsultasi'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Tanggal Konsultasi</label>
                            <div class="col-sm-9">
                                <input type="tgl_konsultasi"
                                       class="form-control tanggal <?= ($validation->hasError('tgl_konsultasi')) ? 'is-invalid' : '' ?>"
                                       id="tgl_konsultasi" name="tgl_konsultasi" placeholder="Tanggal Konsultasi"
                                       value="<?= old('tgl_konsultasi') ? old('tgl_konsultasi') : TanggalIndo2($dataMaster['tgl_daftar']); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tgl_konsultasi'); ?>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Diagnosis</label>
                            <div class="col-sm-9">
                                <input type="text" id="diagnosis" name="diagnosis" required
                                       class="form-control <?= ($validation->hasError('diagnosis')) ? 'is-invalid' : '' ?>"
                                       value="<?= old('diagnosis') ? old('diagnosis') : '' ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('diagnosis'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Saran/Tindakan</label>
                            <div class="col-sm-9">
                                <input type="text" id="saran" name="saran" required
                                       class="form-control <?= ($validation->hasError('saran')) ? 'is-invalid' : '' ?>"
                                       value="<?= old('saran') ? old('saran') : '' ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('saran'); ?>
                                </div>
                            </div>
                        </div>


                </div>
                <footer class="card-footer">
                    <div class="row justify-content-end text-right">
                        <div class="col-sm-12">
                            <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-save"></i>
                                Simpan
                            </button>
                        </div>
                    </div>
                </footer>
            </section>
            </form>
        </div>
    </div>
    <!-- end: page -->
</section>

<?= $this->endSection(); ?>
<!-- end content -->

<?= $this->section('modal'); ?>
<?= $this->endSection(); ?>
<!-- end modal -->

<?= $this->section('js'); ?>
<script src="<?= base_url('public/assets/vendor/select2/js/select2.js') ?>"></script>
<script src="<?= base_url('public/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') ?>"></script>

<script>
    var token = "<?=csrf_hash()?>";
    $(document).ready(function () {
        $('.tanggal').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            orientation: "top"
        });
        $('.select2').select2({
            width: '100%',
            height: '100%'
        });

        $(window).resize(function () {
            $('.select2').css('width', "100%");
        });


    });
</script>
<?= $this->endSection(); ?>
<!-- end js -->