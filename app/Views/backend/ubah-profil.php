<?= $this->extend('backend/template'); ?>

<?= $this->section('css'); ?>
<?= $this->endSection(); ?><!-- end css -->

<?= $this->section('content'); ?>
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard/profil') ?>">Profil</a></li>
                            <li class="breadcrumb-item active"><?= ucfirst($judul) ?></li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?= ucfirst($judul) ?></h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0">Form Ubah Profil</h4>
                    <p class="text-muted font-14 m-b-20">
                        Silahkan lengkapi data berikut ini, tanda <span class="text-danger">*</span> wajib diisi
                    </p>

                    <form id="form" name="form" method="post" enctype="multipart/form-data"
                          action="<?= base_url('dashboard/update-profil') ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" class="form-control" name="id"
                               id="id" value="<?= ($sesi_id); ?>">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                            <div class="col-7">
                                <input type="text"
                                       class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>"
                                       id="nama" name="nama" placeholder="Nama Lengkap" required autofocus
                                       value="<?= old('nama') ? old('nama') : $sesi_nama ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-4 col-form-label">Username<span class="text-danger">*</span></label>
                            <div class="col-7">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text"
                                               class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>"
                                               id="username" name="username" placeholder="Username Login"
                                               aria-describedby="inputGroupPrepend" required
                                               value="<?= old('username') ? old('username') : $sesi_username ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('username'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-4 col-form-label">Email</label>
                            <div class="col-7">
                                <input type="email"
                                       class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                                       id="email" name="email" placeholder="Email Valid"
                                       value="<?= old('email') ? old('email') : $sesi_email ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-4 col-form-label">No Telepon</label>
                            <div class="col-7">
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



                        <div class="form-group row">
                            <label class="col-4 col-form-label">Avatar</label>
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="<?= $sesi_avatar ? base_url('public/uploads/' . $sesi_avatar) : base_url('public/uploads/user.png') ?>"
                                             class="img-thumbnail img-preview">
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="avatar" name="avatar"
                                                   onchange="previewImg()" accept="image/*">
                                            <label class="custom-file-label" for="validatedCustomFile">Pilih
                                                Avatar...</label>
                                            <div class="invalid-feedback"><?= $validation->getError('logo'); ?></div>
                                        </div>
                                        <?php if ($sesi_avatar) { ?>
                                            <input type="checkbox" name="remove_avatar" id="remove_avatar"
                                                   value="<?= $sesi_avatar; ?>">
                                            hapus avatar
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-8 offset-4">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    <i class="mdi mdi-content-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-box -->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div>
<?= $this->endSection(); ?><!-- end content -->

<?= $this->section('modal'); ?>
<?= $this->endSection(); ?><!-- end modal -->

<?= $this->section('js'); ?>

<script>
    $(document).ready(function () {

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
        return (charCode >= 46 && charCode <= 57 || charCode == 8 || charCode == 32 || charCode == 40 || charCode == 41 || charCode == 43);
    }
</script>
<?= $this->endSection(); ?><!-- end js -->
