<?= $this->extend('frontend/template'); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet"
      href="<?= base_url('public/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') ?>"/>
<link rel="stylesheet" href="<?= base_url('public/assets/vendor/summernote/summernote-bs4.css') ?>"/>
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
        <div class="col-lg-5 col-xl-5 mb-4 mb-xl-0">

            <section class="card">
                <div class="card-body">
                    <div class="thumb-info mb-3">
                        <img src="<?= base_url('public/uploads/' . $sesi_avatar) ?>"
                             class="rounded img-fluid img-preview"
                             alt="John Doe">
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner"><?= $sesi_username ?></span>
                            <span class="thumb-info-type"><?= $sesi_level ?></span>
                        </div>
                    </div>

                    <div class="widget-toggle-expand mb-3">
                        <div class="widget-header">
                            <h5 class="mb-2">Profil</h5>
                            <div class="widget-toggle">+</div>
                        </div>

                        <div class="widget-content-expanded">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td class="font-weight-bold">Nama Lengkap</td>
                                    <td><i class="fa fa-address-card"></i> <?= $sesi_nama; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tanggal Lahir</td>
                                    <td><i class="fa fa-calendar"></i> <?= TanggalIndo2($sesi_tgl_lahir); ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Alamat</td>
                                    <td><i class="fa fa-map-marker"></i> <?= $sesi_alamat; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Email</td>
                                    <td><i class="fa fa-envelope"></i> <?= $sesi_email; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">No. Telp</td>
                                    <td><i class="fa fa-phone"></i> <?= $sesi_notelepon; ?></td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Gol Darah</td>
                                    <td> <?= $sesi_gol_darah; ?></td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Tinggi Badan (Cm)</td>
                                    <td> <?= $sesi_tinggi_badan; ?></td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Berat Badan (Kg)</td>
                                    <td> <?= $sesi_berat_badan; ?></td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">BPJS</td>
                                    <td><?= $sesi_bpjs == 'YA' ? '<span class="fas fa-circle fa-xs" style="color: green"> YA</span>' : '<span class="fas fa-circle fa-xs" style="color: red"> TIDAK</span>' ?></td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Jenis Kelamin</td>
                                    <td><i class="fa fa-user-check"></i> <?= $sesi_jk; ?></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php if ($sesi_deskripsi) { ?>

                        <h5 class="mb-2 mt-3">Deskripsi</h5>
                        <?= $sesi_deskripsi; ?>
                    <?php } ?>

                </div>
            </section>

        </div>
        <div class="col-lg-7 col-xl-7">

            <section class="card card-primary">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                    </div>

                    <h2 class="card-title">Form Ubah Profil</h2>
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

                    <form id="form" name="form" method="post" class="p-3" enctype="multipart/form-data"
                          action="<?= base_url('update-profil') ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" class="form-control" name="id" id="id" value="<?= ($sesi_id); ?>">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" id="nama" name="nama"
                                   class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>"
                                   placeholder="Nama Lengkap" required autofocus
                                   value="<?= old('nama') ? old('nama') : $sesi_nama ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" id="alamat" name="alamat"
                                   class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>"
                                   placeholder="Alamat" value="<?= old('alamat') ? old('alamat') : $sesi_alamat ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat'); ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Username</label>
                                <input type="text"
                                       class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>"
                                       id="username" name="username" placeholder="Username Login" required
                                       value="<?= old('username') ? old('username') : $sesi_username ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username'); ?>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <input type="email"
                                       class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                                       id="email" name="email" placeholder="Email Valid"
                                       value="<?= old('email') ? old('email') : $sesi_email ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email'); ?>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>No Telp.</label>
                                <input type="text"
                                       class="form-control <?= ($validation->hasError('notelepon')) ? 'is-invalid' : '' ?>"
                                       id="notelepon" name="notelepon" placeholder="No Telepon Valid"
                                       onkeypress="return check_int(event)" maxlength="14"
                                       value="<?= old('notelepon') ? old('notelepon') : $sesi_notelepon ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('notelepon'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Jenis Kelamin</label>
                                <select name="jk" id="jk"
                                        class="form-control  <?= ($validation->hasError('jk')) ? 'is-invalid' : '' ?>">
                                    <?php
                                    $x = 0;
                                    $selected_jk = old('jk') ? old('jk') : $sesi_jk;
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
                            <div class="form-group col-md-4">
                                <label>Tanggal Lahir</label>
                                <input type="tgl_lahir"
                                       class="form-control tanggal <?= ($validation->hasError('tgl_lahir')) ? 'is-invalid' : '' ?>"
                                       id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir"
                                       value="<?= old('tgl_lahir') ? old('tgl_lahir') : TanggalIndo2($sesi_tgl_lahir) ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tgl_lahir'); ?>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label>Ubah Foto</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="avatar" name="avatar"
                                       onchange="previewImg()" accept="image/*">
                                <label class="custom-file-label" for="validatedCustomFile">Pilih
                                    Foto...</label>
                                <p style="color: red"><?= $validation->getError('avatar'); ?></p>
                            </div>

                            <?php if ($sesi_avatar != 'user.png') { ?>
                                <input type="checkbox" name="remove_avatar" id="remove_avatar"
                                       value="<?= $sesi_avatar; ?>">
                                HAPUS FOTO
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi Profil</label>

                            <textarea name="deskripsi"
                                      id="summernote"><?= old('deskripsi') ? old('deskripsi') : ($sesi_deskripsi) ?></textarea>
                            <p style="color: red"><?= $validation->getError('deskripsi'); ?></p>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Golongan Darah</label>
                                <select name="gol_darah" id="gol_darah"
                                        class="form-control  <?= ($validation->hasError('gol_darah')) ? 'is-invalid' : ''; ?>">
                                    <?php
                                    $x = 0;
                                    $selected_goldar = old('gol_darah') ? old('gol_darah') : $sesi_gol_darah;
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
                                    <?= $validation->getError('stringgol'); ?>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Tinggi Badan (cm)</label>
                                <input type="number"
                                       class="form-control <?= ($validation->hasError('tinggi_badan')) ? 'is-invalid' : ''; ?>"
                                       id="tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan"
                                       value="<?= old('tinggi_badan') ? old('tinggi_badan') : $sesi_tinggi_badan ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tinggi_badan'); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Berat Badan (kg)</label>
                                <input type="number"
                                       class="form-control <?= ($validation->hasError('tinggi_badan')) ? 'is-invalid' : ''; ?>"
                                       id="berat_badan" name="berat_badan" placeholder="Berat Badan"
                                       value="<?= old('berat_badan') ? old('berat_badan') : $sesi_berat_badan ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('berat_badan'); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Pasien BPJS</label>
                                <?php $selected_bpjs = old('bpjs') ? old('bpjs') : $sesi_bpjs; ?>
                                <select name="bpjs" id="bpjs"
                                        class="form-control  <?= ($validation->hasError('bpjs')) ? 'is-invalid' : '' ?>">
                                    <option <?= $selected_bpjs == 'YA' ? 'selected' : ''; ?> value="YA">
                                        YA
                                    </option>
                                    <option <?= $selected_bpjs == 'TIDAK' ? 'selected' : ''; ?> value="TIDAK">TIDAK
                                    </option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('bpjs'); ?>
                                </div>
                            </div>

                        </div>

                        <hr class="dotted tall">

                        <h4 class="mb-3">Ubah Password</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Password Baru</label>
                                <input type="password"
                                       class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
                                       id="password" name="password" placeholder="kosongkan jika tidak merubah password"
                                       value="<?= old('password') ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password'); ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
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
                                <button class="btn btn-primary modal-confirm" type="submit"><i class="fa fa-save"></i>
                                    Simpan Perubahan
                                </button>
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
<script src="<?= base_url('public/assets/vendor/summernote/summernote-bs4.js') ?>"></script>
<script>
    var token = "<?=csrf_hash()?>";
    $(document).ready(function () {
        $('.tanggal').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            orientation: "top"
        });


        $('#summernote').summernote({
            height: "300px",
            callbacks: {
                onImageUpload: function (image) {
                    uploadImage(image[0]);
                },
                onMediaDelete: function (target) {
                    deleteImage(target[0].src);
                }
            }
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