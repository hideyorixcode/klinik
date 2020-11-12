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
        <div class="col-lg-12 col-xl-12">
            <form id="form" name="form" method="post" class="p-3" enctype="multipart/form-data"
                  action="<?= base_url('dashboard/layanan/create-surat') ?>" class="form-horizontal">
                <?= csrf_field() ?>
                <input type="hidden" name="id_daftar" id="id_daftar" value="<?= $id; ?>">
                <section class="card card-secondary">
                    <header class="card-header">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                        </div>

                        <h2 class="card-title">Form Surat</h2>
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


                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Tanggal Surat</label>
                            <div class="col-sm-9">
                                <input type="tgl_surat"
                                       class="form-control tanggal <?= ($validation->hasError('tgl_surat')) ? 'is-invalid' : '' ?>"
                                       id="tgl_surat" name="tgl_surat" placeholder="Tanggal Surat" required
                                       value="<?= old('tgl_surat') ? old('tgl_surat') : TanggalIndo2($dataMaster['tgl_daftar']); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tgl_surat'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Jenis Surat</label>
                            <div class="col-sm-9">
                                <select name="jenis_surat" id="jenis_surat"
                                        class="form-control  <?= ($validation->hasError('jenis_surat')) ? 'is-invalid' : '' ?>"
                                        required>
                                    <option value="">Pilih</option>
                                    <?php
                                    $x = 0;
                                    $selected_jenis_surat = old('jenis_surat') ? old('jenis_surat') : '';
                                    while ($x < count(enumValues('surat', 'jenis_surat'))) {
                                        $stringjenis_surat = enumValues('surat', 'jenis_surat')[$x];
                                        ?>
                                        <option <?= $selected_jenis_surat == $stringjenis_surat ? 'selected' : ''; ?>
                                                value="<?= $stringjenis_surat ?>">
                                            <?= strtoupper($stringjenis_surat) ?></option>
                                        <?php
                                        $x++;
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jenis_surat'); ?>
                                </div>
                            </div>
                        </div>

                        <div id="sehat" class="mb-4">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-2">Pemeriksaan</label>
                                <div class="col-sm-9">
                                    <select name="pemeriksaan" id="pemeriksaan"
                                            class="form-control  <?= ($validation->hasError('pemeriksaan')) ? 'is-invalid' : '' ?>">
                                        <?php
                                        $x = 0;
                                        $selected_pemeriksaan = old('pemeriksaan') ? old('pemeriksaan') : '';
                                        while ($x < count(enumValues('surat', 'pemeriksaan'))) {
                                            $stringpemeriksaan = enumValues('surat', 'pemeriksaan')[$x];
                                            ?>
                                            <option <?= $selected_pemeriksaan == $stringpemeriksaan ? 'selected' : ''; ?>
                                                    value="<?= $stringpemeriksaan ?>">
                                                <?= strtoupper($stringpemeriksaan) ?></option>
                                            <?php
                                            $x++;
                                        }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pemeriksaan'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-2">Surat digunakan untuk</label>
                                <div class="col-sm-9">
                                    <input type="text" id="untuk" name="untuk"
                                           class="form-control <?= ($validation->hasError('untuk')) ? 'is-invalid' : '' ?>"
                                           value="<?= old('untuk') ? old('untuk') : '' ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('untuk'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-2">Tensi Darah (mmgh)</label>
                                <div class="col-sm-9">
                                    <input type="number" id="td" name="td"
                                           class="form-control <?= ($validation->hasError('td')) ? 'is-invalid' : '' ?>"
                                           value="<?= old('td') ? old('td') : '' ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('td'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-2">Denyut Nadi /mnt</label>
                                <div class="col-sm-9">
                                    <input type="number" id="dn" name="dn"
                                           class="form-control <?= ($validation->hasError('dn')) ? 'is-invalid' : '' ?>"
                                           value="<?= old('dn') ? old('dn') : '' ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('dn'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-2">Tinggi Badan (Cm)</label>
                                <div class="col-sm-9">
                                    <input type="number" id="tb" name="tb"
                                           class="form-control <?= ($validation->hasError('tb')) ? 'is-invalid' : '' ?>"
                                           value="<?= old('tb') ? old('tb') : $dataMaster['tinggi_badan'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tb'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-2">Berat Badan (Kg)</label>
                                <div class="col-sm-9">
                                    <input type="number" id="bb" name="bb"
                                           class="form-control <?= ($validation->hasError('bb')) ? 'is-invalid' : '' ?>"
                                           value="<?= old('bb') ? old('bb') : $dataMaster['berat_badan'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('bb'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="sakit">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-2">Mulai Tanggal (Cuti)</label>
                                <div class="col-sm-9">
                                    <input type="mulai"
                                           class="form-control tanggal <?= ($validation->hasError('mulai')) ? 'is-invalid' : '' ?>"
                                           id="mulai" name="mulai" placeholder="Tanggal Mulai Cuti"
                                           value="<?= old('mulai') ? old('mulai') : ''; ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('mulai'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-2">Sampai Tanggal (Cuti)</label>
                                <div class="col-sm-9">
                                    <input type="sampai"
                                           class="form-control tanggal <?= ($validation->hasError('sampai')) ? 'is-invalid' : '' ?>"
                                           id="sampai" name="sampai" placeholder="Tanggal Selesai Cuti"
                                           value="<?= old('sampai') ? old('sampai') : ''; ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('sampai'); ?>
                                    </div>
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

        cek_div();


    });


    $('#jenis_surat').change(function () {
        cek_div();
    });

    function cek_div() {
        var jenis_surat = $('#jenis_surat').val();
        if (jenis_surat == 'SURAT SAKIT') {
            $('#sakit').show();
            $('#sehat').hide();
        } else if (jenis_surat == 'SURAT SEHAT/TIDAK SEHAT') {
            $('#sakit').hide();
            $('#sehat').show();
        } else {
            $('#sakit').hide();
            $('#sehat').hide();
        }
    }
</script>
<?= $this->endSection(); ?>
<!-- end js -->