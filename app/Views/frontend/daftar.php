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
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                    </div>

                    <h2 class="card-title">Form Registrasi Pasien</h2>
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

                    <form id="form" name="form" method="post" class="p-3" enctype="multipart/form-data"
                          action="<?= base_url('daftar-pasien') ?>">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-lg-6 col-xl-6">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Nama Lengkap</label>
                                        <input type="text" id="nama" name="nama"
                                               class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>"
                                               placeholder="Nama Lengkap" required autofocus
                                               value="<?= old('nama') ? old('nama') : '' ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Nama Kepala Keluarga</label>
                                        <input type="text" id="nama_kk" name="nama_kk"
                                               class="form-control <?= ($validation->hasError('nama_kk')) ? 'is-invalid' : '' ?>"
                                               placeholder="Nama Kepala Keluarga" required autofocus
                                               value="<?= old('nama_kk') ? old('nama_kk') : '' ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_kk'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" id="alamat" name="alamat"
                                           class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>"
                                           placeholder="Alamat" value="<?= old('alamat') ? old('alamat') : '' ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('alamat'); ?>
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label>No Telp.</label>
                                        <input type="text"
                                               class="form-control <?= ($validation->hasError('notelepon')) ? 'is-invalid' : '' ?>"
                                               id="notelepon" name="notelepon" placeholder="No Telepon Valid"
                                               onkeypress="return check_int(event)" maxlength="14"
                                               value="<?= old('notelepon') ? old('notelepon') : '' ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('notelepon'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Jenis Kelamin</label>
                                        <select name="jk" id="jk"
                                                class="form-control  <?= ($validation->hasError('jk')) ? 'is-invalid' : '' ?>">
                                            <?php
                                            $x = 0;
                                            $selected_jk = old('jk') ? old('jk') : '';
                                            while ($x < count(enumValues('pengguna', 'jk'))) {
                                                $stringjk = enumValues('pengguna', 'jk')[$x];
                                                ?>
                                                <option <?= $selected_jk == $stringjk ? 'selected' : ''; ?>
                                                        value="<?= $stringjk ?>">
                                                    <?= strtoupper($stringjk) ?></option>
                                                <?php
                                                $x++;
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('jk'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Tanggal Lahir</label>
                                        <input type="text"
                                               class="form-control tanggal <?= ($validation->hasError('tgl_lahir')) ? 'is-invalid' : '' ?>"
                                               id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir"
                                               value="<?= old('tgl_lahir') ? old('tgl_lahir') : '' ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tgl_lahir'); ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>Foto</label>
                                    <div class="row">
                                        <?php $fotonya = 'user.png'; ?>
                                        <div class="col-sm-3 mb-2">
                                            <img src="<?= base_url('public/uploads/' . $fotonya) ?>"
                                                 class="img-thumbnail img-preview">
                                        </div>
                                        <div class="col-sm-9 mb-2">
                                            <div class="custom-file mb-3">
                                                <input type="file" class="custom-file-input" id="avatar" name="avatar"
                                                       onchange="previewImg()" accept="image/*">
                                                <label class="custom-file-label" for="validatedCustomFile">Pilih
                                                    Foto...</label>
                                                <p style="color: red"><?= $validation->getError('avatar'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-xl-6 col-lg-6">


                                <div class="form-group">
                                    <label>Deskripsikan diri anda / tentang anda (tidak wajib)</label>

                                    <textarea name="deskripsi" class="form-control" rows="3"
                                              id="summernote"><?= old('deskripsi') ? old('deskripsi') : '' ?></textarea>
                                    <p style="color: red"><?= $validation->getError('deskripsi'); ?></p>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Golongan Darah</label>
                                        <select name="gol_darah" id="gol_darah"
                                                class="form-control  <?= ($validation->hasError('gol_darah')) ? 'is-invalid' : ''; ?>">
                                            <?php
                                            $x = 0;
                                            $selected_goldar = old('gol_darah') ? old('gol_darah') : '';
                                            while ($x < count(enumValues('pengguna', 'gol_darah'))) {
                                                $stringgol = enumValues('pengguna', 'gol_darah')[$x];
                                                ?>
                                                <option <?= $selected_goldar == $stringgol ? 'selected' : ''; ?>
                                                        value="<?= $stringgol ?>">
                                                    <?= strtoupper($stringgol) ?></option>
                                                <?php
                                                $x++;
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('gol_darah'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Tinggi Badan (cm)</label>
                                        <input type="number"
                                               class="form-control <?= ($validation->hasError('tinggi_badan')) ? 'is-invalid' : ''; ?>"
                                               id="tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan"
                                               value="<?= old('tinggi_badan') ? old('tinggi_badan') : '' ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tinggi_badan'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Berat Badan (kg)</label>
                                        <input type="number"
                                               class="form-control <?= ($validation->hasError('tinggi_badan')) ? 'is-invalid' : ''; ?>"
                                               id="berat_badan" name="berat_badan" placeholder="Berat Badan"
                                               value="<?= old('berat_badan') ? old('berat_badan') : '' ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('berat_badan'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Jenis Pasien</label>
                                        <?php $selected_bpjs = old('bpjs') ? old('bpjs') : ''; ?>
                                        <select name="bpjs" id="bpjs"
                                                class="form-control  <?= ($validation->hasError('bpjs')) ? 'is-invalid' : '' ?>">
                                            <option <?= $selected_bpjs == 'YA' ? 'selected' : ''; ?> value="YA">
                                                BPJS
                                            </option>
                                            <option <?= $selected_bpjs == 'TIDAK' ? 'selected' : ''; ?> value="TIDAK">
                                                UMUM
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('bpjs'); ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-9">
                                        <label>Pekerjaan</label>
                                        <input type="text"
                                               class="form-control <?= ($validation->hasError('pekerjaan')) ? 'is-invalid' : ''; ?>"
                                               id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan"
                                               value="<?= old('pekerjaan') ? old('pekerjaan') : '' ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('pekerjaan'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Agama</label>
                                        <select name="agama" id="agama"
                                                class="form-control  <?= ($validation->hasError('agama')) ? 'is-invalid' : ''; ?>">
                                            <?php
                                            $x = 0;
                                            $selected_agama = old('agama') ? old('agama') : '';
                                            while ($x < count(enumValues('pengguna', 'agama'))) {
                                                $stringagama = enumValues('pengguna', 'agama')[$x];
                                                ?>
                                                <option <?= $selected_agama == $stringagama ? 'selected' : ''; ?>
                                                        value="<?= $stringagama ?>">
                                                    <?= strtoupper($stringagama) ?></option>
                                                <?php
                                                $x++;
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('agama'); ?>
                                        </div>
                                    </div>

                                </div>

                                <hr class="dotted tall">

                                <h4 class="mb-3">::Login Akun::</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Username</label>
                                        <input type="text"
                                               class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>"
                                               id="username" name="username" placeholder="Username Login" required
                                               value="<?= old('username') ? old('username') : '' ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('username'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Password</label>
                                        <input type="password"
                                               class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
                                               id="password" name="password" placeholder="wajib berikan password"
                                               value="<?= old('password') ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Konfirmasi Password</label>
                                        <input type="password"
                                               class="form-control <?= ($validation->hasError('confirm_password')) ? 'is-invalid' : '' ?>"
                                               id="confirm_password" name="confirm_password"
                                               placeholder="konfirmasi password baru"
                                               value="<?= old('confirm_password') ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('confirm_password'); ?>
                                        </div>
                                    </div>

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
</script>
<?= $this->endSection(); ?>
<!-- end js -->