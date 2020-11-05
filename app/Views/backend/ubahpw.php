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
                    <h4 class="header-title m-t-0">Form Ubah Password</h4>
                    <p class="text-muted font-14 m-b-20">
                        Silahkan lengkapi data berikut ini, tanda <span class="text-danger">*</span> wajib diisi
                    </p>

                    <form id="form" name="form" method="post" enctype="multipart/form-data"
                          action="<?= base_url('dashboard/update-password') ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" class="form-control" name="id"
                               id="id" value="<?= ($sesi_id); ?>">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">Username</label>
                            <div class="col-7">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text"
                                               class="form-control"
                                               id="username" name="username" placeholder="Username Login"
                                               aria-describedby="inputGroupPrepend" readonly
                                               value="<?=$sesi_username ?>">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-4 col-form-label">Password Lama</label>
                            <div class="col-7">
                                <input type="password"
                                       class="form-control <?= ($validation->hasError('password_lama')) ? 'is-invalid' : '' ?>"
                                       id="password_lama" name="password_lama"
                                       value="<?= old('password_lama') ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password_lama'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-4 col-form-label">Password Baru</label>
                            <div class="col-7">
                                <input type="password"
                                       class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
                                       id="password" name="password"
                                       value="<?= old('password') ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-4 col-form-label">Konfirmasi Password</label>
                            <div class="col-7">
                                <input type="password"
                                       class="form-control <?= ($validation->hasError('confirm_password')) ? 'is-invalid' : '' ?>"
                                       id="confirm_password" name="confirm_password"
                                       value="<?= old('confirm_password') ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('confirm_password'); ?>
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
</script>
<?= $this->endSection(); ?><!-- end js -->
