<!-- start: header -->
<header class="header header-nav-menu header-nav-stripe">
    <div class="logo-container">
        <a href="#" class="logo">
            <img src="<?= base_url('public/uploads/' . $logo_web) ?>" width="75" height="35" alt="<?= $nama_app; ?>"/>
        </a>
        <button class="btn header-btn-collapse-nav d-lg-none" data-toggle="collapse" data-target=".header-nav">
            <i class="fas fa-bars"></i>
        </button>

        <!-- start: header nav menu -->
        <div class="header-nav collapse">
            <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 header-nav-main-square">
                <nav>
                    <ul class="nav nav-pills" id="mainNav">

                        <li class="<?= getSegment(1) == '' ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?= base_url('') ?>">
                                <i class="fas fa-home" aria-hidden="true"></i>
                                <span>Beranda</span>
                            </a>
                        </li>

                        <li class="<?= getSegment(1) == 'jadwal' ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?= base_url('jadwal') ?>">
                                <i class="fas fa-clock" aria-hidden="true"></i>
                                <span>Informasi Jadwal Klinik</span>
                            </a>
                        </li>
                        <?php if (session()->get('level') == 'pasien') : ?>
                            <li class="<?= getSegment(1) == 'layanan' ? 'active' : ''; ?>">
                                <a class="nav-link" href="<?= base_url('layanan') ?>">
                                    <i class="fas fa-reply" aria-hidden="true"></i>
                                    <span>Layanan</span>
                                </a>
                            </li>
                        <?php else : ?>
                            <li class="<?= getSegment(1) == 'daftar' ? 'active' : ''; ?>">
                                <a class="nav-link" href="<?= base_url('daftar') ?>">
                                    <i class="fas fa-user-check" aria-hidden="true"></i>
                                    <span>Form Registrasi Pasien</span>
                                </a>
                            </li>


                        <?php endif; ?>


                        <?php if (!session('id')) : ?>
                            <li class="<?= getSegment(1) == 'syslog' ? 'active' : ''; ?>">
                                <a class="nav-link" href="<?= base_url('syslog') ?>">
                                    <i class="fas fa-lock" aria-hidden="true"></i>
                                    <span>Login</span>
                                </a>
                            </li>
                        <?php else : ?>
                            <?php if (session()->get('level') != 'pasien') : ?>
                                <li class="<?= getSegment(1) == 'dashboard' ? 'active' : ''; ?>">
                                    <a class="nav-link" href="<?= base_url('dashboard') ?>">
                                        <i class="fas fa-backward" aria-hidden="true"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- end: header nav menu -->
    </div>

    <!-- start: search & user box -->
    <?php if (session()->get('level') == 'pasien') : ?>
        <div class="header-right">

            <form class="search nav-form">
                <div class="input-group">
                    <input type="text" class="form-control" readonly value="<?= $nama_app; ?>">
                    <span class="input-group-append">
								<button class="btn btn-default" type="submit"><i
                                            class="fas fa-clinic-medical"></i></button>
							</span>
                </div>
            </form>


            <span class="separator"></span>

            <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                    <figure class="profile-picture">
                        <img src="<?= base_url('public/uploads/thumbs/' . $sesi_avatar) ?>" alt="<?= $sesi_username; ?>"
                             class="rounded-circle"
                             data-lock-picture="<?= base_url('public/uploads/thumbs/' . $sesi_avatar) ?>"/>
                    </figure>
                    <div class="profile-info" data-lock-name="<?= $sesi_username; ?>"
                         data-lock-email="ngehek@gmail.com">
                        <span class="name"><?= $sesi_username; ?></span>
                        <span class="role"><?= $sesi_level; ?></span>
                    </div>

                    <i class="fa custom-caret"></i>
                </a>

                <div class="dropdown-menu">
                    <ul class="list-unstyled mb-2">
                        <li class="divider"></li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="<?= base_url('profil') ?>"><i
                                        class="fas fa-user"></i> Profil</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="<?= base_url('syslog/logout') ?>"><i
                                        class="fas fa-power-off"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end: search & user box -->
    <?php endif; ?>
</header>
<!-- end: header -->

