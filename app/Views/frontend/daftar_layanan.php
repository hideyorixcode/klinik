<?= $this->extend('frontend/template'); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet"
      href="<?= base_url('public/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') ?>"/>
<link rel="stylesheet" href="<?= base_url('public/assets/vendor/select2/css/select2.css') ?>"/>
<link rel="stylesheet"
      href="<?= base_url('public/assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') ?>"/>

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
        <div class="col-lg-12 col-xl-12">

            <section class="card card-primary">

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

                    <form id="form" name="form" method="post" class="p-3" enctype="multipart/form-data"
                          action="<?= base_url('create-layanan') ?>">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-lg-2 col-xl-2">
                            </div>
                            <div class="col-lg-8 col-xl-8">
                                <input type="hidden" name="id_pasien_fk" id="id_pasien_fk" value="<?= $sesi_id; ?>">

                                <div class="form-group">
                                    <label>Pilih Poli</label>
                                    <?php $selected_poli = old('id_poli_fk') ? old('id_poli_fk') : ''; ?>
                                    <select class="form-control select2" name="id_poli_fk" id="id_poli_fk"
                                            class="form-control  <?= ($validation->hasError('id_poli_fk')) ? 'is-invalid' : '' ?>">
                                        <?php foreach ($dataPoli as $x) : ?>
                                            <option value="<?= ($x['id_poli']) ?>" <?= ($x['id_poli']) == $selected_poli ? 'selected' : ''; ?>><?= $x['nama_poli'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('id_poli_fk'); ?>
                                    </div>
                                </div>


                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label>Tanggal Daftar</label>
                                        <input type="text"
                                               class="form-control tanggal <?= ($validation->hasError('tgl_daftar')) ? 'is-invalid' : '' ?>"
                                               id="tgl_lahir" name="tgl_daftar" placeholder="Tanggal Daftar"
                                               value="<?= old('tgl_daftar') ? old('tgl_daftar') : '' ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tgl_daftar'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Pilih Layanan</label>
                                        <select name="layanan" id="layanan"
                                                class="form-control  <?= ($validation->hasError('layanan')) ? 'is-invalid' : ''; ?>">
                                            <?php
                                            $x = 0;
                                            $selected_layanan = old('layanan') ? old('layanan') : '';
                                            while ($x < count(enumValues('daftar', 'layanan'))) {
                                                $stringlay = enumValues('daftar', 'layanan')[$x];
                                                ?>
                                                <option <?= $selected_layanan == $stringlay ? 'selected' : ''; ?>
                                                        value="<?= $stringlay ?>">
                                                    <?= strtoupper($stringlay) ?></option>
                                                <?php
                                                $x++;
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('layanan'); ?>
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group">

                                    <label>Pilih Jadwal</label>
                                    <select class="form-control select2" id="id_jadwal_fk"
                                            name="id_jadwal_fk">
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('id_jadwal_fk'); ?>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>Keterangan (opsional)</label>

                                    <textarea name="keterangan" class="form-control" rows="3"
                                              id="keterangan"><?= old('keterangan') ? old('keterangan') : '' ?></textarea>
                                    <p style="color: red"><?= $validation->getError('keterangan'); ?></p>

                                </div>


                                <div class="form-row">
                                    <div class="col-md-12 text-right mt-3">
                                        <button class="btn btn-primary btn-lg" type="submit"><i
                                                    class="fa fa-save"></i>
                                            Submit
                                        </button>
                                    </div>
                                </div>


                            </div>
                            <div class="col-xl-2 col-lg-2"></div>
                        </div>

                    </form>

                </div>
            </section>
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
<script src="<?= base_url('public/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') ?>"></script>

<script src="<?= base_url('public/assets/vendor/select2/js/select2.js') ?>"></script>

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

        jadwalSelect();


    });

    function previewImg() {
        const logo = document.querySelector('#avatar');
        const logoLabel = document.querySelector('.custom-file-label');
        const logoPreview = document.querySelector('.img-preview');

        logoLabel.textContent = logo.files[0].name;

        const fileLogo = new FileReader();
        fileLogo.readAsDataURL(logo.files[0]);

        fileLogo.onload = function (e) {
            logoPreview.src = e.target.result;
        }
    }

    $("input").change(function () {
        $(this).closest('.form-group').find('input.form-control').removeClass('is-invalid');
        $(this).closest('.form-group').find('span.invalid-feedback').text('');
    });
    $("select").change(function () {
        $(this).closest('.form-group').find('div.input-group').removeClass('is-invalid');
        $(this).closest('.form-group').find('span.invalid-feedback').text('');
    });

    function check_int(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        return (charCode >= 46 && charCode <= 57 || charCode == 8 || charCode == 32 || charCode == 40 || charCode == 41 ||
            charCode == 43);
    }

    function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        data.append('<?=csrf_token()?>', token);
        $.ajax({
            url: "<?php echo site_url('upload-image') ?>",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            dataType: "JSON",
            type: "POST",
            success: function (data) {
                token = data.csrf_token;
                $('[name="<?=csrf_token()?>"]').val(token);
                if (data.status) {
                    $('#summernote').summernote("insertImage", data.message);
                } else {
                    alert(data.message);
                }
            },
            error: function (data) {
                //console.log(data);
                alert(data);
            }
        });
    }

    function deleteImage(src) {
        $.ajax({
            data: {
                src: src,
                '<?=csrf_token()?>': token
            },
            type: "POST",
            url: "<?php echo site_url('delete-image') ?>",
            cache: false,
            success: function (response) {
                //console.log(response);
                token = response;
                $('[name="<?=csrf_token()?>"]').val(token);
            }
        });
    }

    function nampilin_jadwal(id_poli_fk) {
        var urlData = '<?=base_url('select-jadwal?id_poli_fk=')?>';
        $.ajax({
            url: urlData + id_poli_fk,
            success: function (option) {
                $('select[name="id_jadwal_fk"]').html(option);
            }
        });
    }

    $('select[name="id_poli_fk"]').on('change', function () {
        jadwalSelect();
    });

    function jadwalSelect() {
        var id_poli_fk = $("#id_poli_fk").val();
        nampilin_jadwal(id_poli_fk);
    }
</script>
<?= $this->endSection(); ?>
<!-- end js -->