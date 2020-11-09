<?= $this->extend('backend/template'); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet"
      href="<?= base_url('public/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') ?>"/>
<link rel="stylesheet" href="<?= base_url('public/assets/vendor/summernote/summernote-bs4.css') ?>"/>
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

            <section class="card card-primary">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                    </div>

                    <h2 class="card-title">Form Ubah Petugas Kesehatan</h2>
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
                          action="<?= base_url('dashboard/petugas/update') ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" id="nama" name="nama"
                                   class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>"
                                   placeholder="Nama Lengkap" required autofocus
                                   value="<?= old('nama') ? old('nama') : $dataMaster['nama'] ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" id="alamat" name="alamat"
                                   class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>"
                                   placeholder="Alamat"
                                   value="<?= old('alamat') ? old('alamat') : $dataMaster['alamat'] ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat'); ?>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label>Jenis Petugas</label>
                                <?php $selected_petugas = old('level') ? old('level') : $dataMaster['level']; ?>
                                <select name="level" id="level"
                                        class="form-control  <?= ($validation->hasError('level')) ? 'is-invalid' : '' ?>">
                                    <option <?= $selected_petugas == 'dokter' ? 'selected' : ''; ?> value="dokter">
                                        DOKTER
                                    </option>
                                    <option <?= $selected_petugas == 'bidan' ? 'selected' : ''; ?> value="bidan">BIDAN
                                    </option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('level'); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Pilih Poli</label>
                                <?php $selected_poli = old('id_poli_fk') ? old('id_poli_fk') : $dataMaster['id_poli_fk'];; ?>
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

                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email"
                                       class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>"
                                       id="email" name="email" placeholder="Email Valid"
                                       value="<?= old('email') ? old('email') : $dataMaster['email'] ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email'); ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>No Telp.</label>
                                <input type="text"
                                       class="form-control <?= ($validation->hasError('notelepon')) ? 'is-invalid' : ''; ?>"
                                       id="notelepon" name="notelepon" placeholder="No Telepon Valid"
                                       onkeypress="return check_int(event)" maxlength="14"
                                       value="<?= old('notelepon') ? old('notelepon') : $dataMaster['notelepon'] ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('notelepon'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Jenis Kelamin</label>
                                <select name="jk" id="jk"
                                        class="form-control  <?= ($validation->hasError('jk')) ? 'is-invalid' : ''; ?>">
                                    <?php
                                    $x = 0;
                                    $selected_jk = old('jk') ? old('jk') : $dataMaster['jk'];
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
                                <input type="tgl_lahir"
                                       class="form-control tanggal <?= ($validation->hasError('tgl_lahir')) ? 'is-invalid' : ''; ?>"
                                       id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir"
                                       value="<?= old('tgl_lahir') ? old('tgl_lahir') : TanggalIndo2($dataMaster['tgl_lahir']) ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tgl_lahir'); ?>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label>Ubah Foto</label>
                            <div class="row">
                                <?php $fotonya = $dataMaster['avatar'] ? $dataMaster['avatar'] : 'user.png'; ?>
                                <div class="col-sm-3 mb-2">
                                    <img src="<?= base_url('public/uploads/' . $fotonya) ?>"
                                         class="img-thumbnail img-preview">
                                </div>
                                <div class="col-sm-7 mb-2">
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="avatar" name="avatar"
                                               onchange="previewImg()" accept="image/*">
                                        <label class="custom-file-label" for="validatedCustomFile">Pilih
                                            Foto...</label>
                                        <p style="color: red"><?= $validation->getError('avatar'); ?></p>
                                    </div>
                                </div>
                                <?php if ($dataMaster['avatar']) { ?>
                                    <div class="col-sm-2 mb-2">
                                        <input type="checkbox" name="remove_avatar" id="remove_avatar"
                                               value="<?= $dataMaster['avatar']; ?>"><span>Hapus Foto</span>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label>Deskripsi Petugas Kesehatan</label>

                                <textarea name="deskripsi"
                                          id="summernote"><?= old('deskripsi') ? old('deskripsi') : $dataMaster['deskripsi']; ?></textarea>
                                <p style="color: red"><?= $validation->getError('deskripsi'); ?></p>

                            </div>

                            <hr class="dotted tall">

                            <h4 class="mb-3">::Login Akun::</h4>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Username</label>
                                    <input type="text"
                                           class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>"
                                           id="username" name="username" placeholder="Username Login" required
                                           value="<?= old('username') ? old('username') : $dataMaster['username']; ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('username'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Password</label>
                                    <input type="password"
                                           class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
                                           id="password" name="password" placeholder="wajib berikan password"
                                           value="<?= old('password') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
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
                                <div class="form-group col-md-3">
                                    <label>Active</label>
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

                            <div class="form-row">
                                <div class="col-md-12 text-right mt-3">
                                    <button class="btn btn-primary modal-confirm" type="submit"><i
                                                class="fa fa-save"></i>
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
            url: "<?php echo site_url('dashboard/upload-image') ?>",
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
            url: "<?php echo site_url('dashboard/delete-image') ?>",
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