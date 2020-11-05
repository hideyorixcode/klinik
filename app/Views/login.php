<!DOCTYPE html>
<html lang="en" class="fixed">

<head>
    <meta charset="utf-8" />
    <title>Log In | <?=$nama_app;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Aplikasi Klinik Version 1" name="description" />
    <meta content="HideyorixCode" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url('public/uploads/'.$favicon)?>">
    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light"
        rel="stylesheet" type="text/css">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?=base_url('public/assets/vendor/bootstrap/css/bootstrap.css')?>" />
    <link rel="stylesheet" href="<?=base_url('public/assets/vendor/animate/animate.css')?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/vendor/font-awesome/css/all.min.css')?>" />
    <link rel="stylesheet" href="<?=base_url('public/assets/vendor/magnific-popup/magnific-popup.css')?>" />
    <link rel="stylesheet"
        href="<?=base_url('public/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css')?>" />
    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?=base_url('public/assets/css/theme.css')?>" />
    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?=base_url('public/assets/css/skins/default.css')?>" />
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?=base_url('public/assets/css/custom.css')?>" />
    <!-- Head Libs -->
    <script src="<?=base_url('public/assets/vendor/modernizr/modernizr.js')?>"></script>

</head>

<body>
    <section class="body-sign">
        <div class="center-sign">
            <a href="#" class="logo float-left">
                <img src="<?=base_url('public/uploads/'.$logo_web)?>" height="54" alt="Porto Admin" />
            </a>

            <div class="panel card-sign">
                <div class="card-title-sign mt-3 text-right">
                    <h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Halaman Login
                    </h2>
                </div>
                <div class="card-body">
                    <form action="<?=base_url('syslog/cek_login')?>" method="post" id="form" name="form"
                        enctype="multipart/form-data">

                        <?php if (!empty(session()->getFlashdata('gagal'))) {?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Gagal!</strong> <?=session()->getFlashdata('gagal');?>
                        </div>
                        <?php }?>
                        <?=csrf_field()?>

                        <div class="form-group mb-3">
                            <label>Username</label>
                            <div class="input-group">
                                <input name="username" type="text"
                                    class="form-control form-control-lg <?=($validation->hasError('username')) ? 'is-invalid' : ''?>"
                                    required placeholder="USERNAME" autofocus value="<?=old('username')?>" />
                                <span class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </span>
                                <div class="invalid-feedback"><?=$validation->getError('username');?></div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="clearfix">
                                <label class="float-left">Password</label>

                            </div>
                            <div class="input-group">
                                <input name="password" type="password"
                                    class="form-control form-control-lg <?=($validation->hasError('password')) ? 'is-invalid' : ''?>"
                                    placeholder="PASSWORD" value="<?=old('password')?>" required />
                                <span class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </span>
                                <div class="invalid-feedback"><?=$validation->getError('password');?></div>

                            </div>
                            <a href="pages-recover-password.html" class="float-right">Lupa Password?</a>
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="checkbox-custom checkbox-default">
                                    <input id="RememberMe" name="rememberme" type="checkbox" />
                                    <label for="RememberMe">Ingat Saya</label>
                                </div>
                            </div>
                            <div class="col-sm-4 text-right">
                                <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-sign-in-alt"></i>
                                    Log
                                    In
                                </button>
                            </div>
                        </div>

                        <span class="mt-3 mb-3 line-thru text-center text-uppercase">
                            <span>atau</span>
                        </span>

                        <p class="text-center">Belum memiliki akun pasien? <a href="#">Daftar!</a></p>

                    </form>
                </div>
            </div>

            <p class="text-center text-muted mt-3 mb-3">&copy; Copyright <?=date('Y')?>. <?=$nama_app; ?>.</p>
        </div>
    </section>
    <!-- end: page -->

    <script src="<?=base_url('public/assets/vendor/jquery/jquery.js')?>"></script>
    <script src="<?=base_url('public/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js')?>"></script>
    <script src="<?=base_url('public/assets/vendor/popper/umd/popper.min.js')?>"></script>
    <script src="<?=base_url('public/assets/vendor/bootstrap/js/bootstrap.js')?>"></script>
    <script src="<?=base_url('public/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')?>"></script>
    <script src="<?=base_url('public/assets/vendor/common/common.js')?>"></script>
    <script src="<?=base_url('public/assets/vendor/nanoscroller/nanoscroller.js')?>"></script>
    <script src="<?=base_url('public/assets/vendor/magnific-popup/jquery.magnific-popup.js')?>"></script>
    <script src="<?=base_url('public/assets/vendor/jquery-placeholder/jquery.placeholder.js')?>"></script>

    <!-- Theme Base, Components and Settings -->
    <script src="<?=base_url('public/assets/js/theme.js')?>"></script>

    <!-- Theme Custom -->
    <script src="<?=base_url('public/assets/js/custom.js')?>"></script>

    <!-- Theme Initialization Files -->
    <script src="<?=base_url('public/assets/js/theme.init.js')?>"></script>

</body>

</html>