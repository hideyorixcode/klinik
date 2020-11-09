<?= $this->extend('backend/template'); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url('public/assets/vendor/select2/css/select2.css') ?>"/>
<link rel="stylesheet"
      href="<?= base_url('public/assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css') ?>"/>

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
        <div class="col-lg-12 col-xl-12">
            <form id="form" name="form" method="post" class="p-3" enctype="multipart/form-data"
                  action="<?= base_url('dashboard/jadwal/update') ?>" class="form-horizontal">
                <?= csrf_field() ?>
                <input type="hidden" name="id_jadwal" id="id_jadwal" value="<?= $id; ?>">
                <section class="card card-primary">
                    <header class="card-header">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                        </div>

                        <h2 class="card-title">Form Ubah Jadwal</h2>
                    </header>
                    <div class="card-body">

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

                        <?php if (!empty(session()->getFlashdata('ValidasiJadwal'))) { ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Info!</strong> <?= session()->getFlashdata('ValidasiJadwal'); ?>
                            </div>
                        <?php } ?>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Pilih Petugas Kesehatan</label>
                            <div class="col-sm-9">
                                <?php $selected_petugas = old('idpetugas_fk') ? old('idpetugas_fk') : $dataMaster['idpetugas_fk']; ?>
                                <select class="form-control select2 <?= ($validation->hasError('idpetugas_fk')) ? 'is-invalid' : '' ?>"
                                        name="idpetugas_fk" id="idpetugas_fk">
                                    <?php foreach ($dataPetugas as $x) : ?>
                                        <option value="<?= ($x['id']) ?>" <?= ($x['id']) == $selected_petugas ? 'selected' : ''; ?>><?= $x['nama'] . ' [' . strtoupper($x['level']) . '] - ' . $x['nama_poli'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('idpetugas_fk'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Hari</label>
                            <div class="col-sm-9">
                                <select name="hari" id="hari"
                                        class="form-control  <?= ($validation->hasError('hari')) ? 'is-invalid' : '' ?>">
                                    <?php
                                    $x = 0;
                                    $selected_hari = old('hari') ? old('hari') : $dataMaster['hari'];
                                    while ($x < count(enumValues('jadwal', 'hari'))) {
                                        $stringhari = enumValues('jadwal', 'hari')[$x];
                                        ?>
                                        <option <?= $selected_hari == $stringhari ? 'selected' : ''; ?>
                                                value="<?= $stringhari ?>">
                                            <?= strtoupper($stringhari) ?></option>
                                        <?php
                                        $x++;
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('hari'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Mulai (Waktu)</label>
                            <div class="col-sm-9">
                                <div class="input-group">
														<span class="input-group-prepend">
															<span class="input-group-text">
																<i class="far fa-clock"></i>
															</span>
														</span>
                                    <input type="text" data-plugin-timepicker
                                           class="form-control  <?= ($validation->hasError('dari')) ? 'is-invalid' : '' ?>"
                                           name="dari" id="dari"
                                           data-plugin-options='{ "showMeridian": false }'
                                           value="<?= old('dari') ? old('dari') : $dataMaster['dari'] ?>">
                                </div>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('dari'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Selesai (Waktu)</label>
                            <div class="col-sm-9">
                                <div class="input-group">
														<span class="input-group-prepend">
															<span class="input-group-text">
																<i class="far fa-clock"></i>
															</span>
														</span>
                                    <input type="text" data-plugin-timepicker
                                           class="form-control  <?= ($validation->hasError('sampai')) ? 'is-invalid' : '' ?>"
                                           name="sampai" id="sampai"
                                           data-plugin-options='{ "showMeridian": false }'
                                           value="<?= old('sampai') ? old('sampai') : $dataMaster['sampai'] ?>">
                                </div>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('sampai'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Active</label>
                            <div class="col-sm-9">
                                <?php $selected_active = old('active') ? old('active') : $dataMaster['active']; ?>
                                <select name="active" id="active"
                                        class="form-control  <?= ($validation->hasError('active')) ? 'is-invalid' : '' ?>">
                                    <option <?= $selected_active == 1 ? 'selected' : ''; ?> value="1">
                                        YA
                                    </option>
                                    <option <?= $selected_active == 0 ? 'selected' : ''; ?> value="0">TIDAK
                                    </option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('active'); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <footer class="card-footer">
                        <div class="row justify-content-end text-right">
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit"><i
                                            class="fa fa-save"></i>
                                    Simpan Perubahan
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
<script src="<?= base_url('public/assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js') ?>"></script>

<script>
    var token = "<?=csrf_hash()?>";
    $(document).ready(function () {

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