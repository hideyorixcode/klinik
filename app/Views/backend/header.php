<header class="header">
    <div class="logo-container">
        <a href="#" class="logo">
            <img src="<?= base_url('public/uploads/'.$logo_web) ?>" width="75" height="35" alt="<?= $nama_app; ?>"/>
        </a>
        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
             data-fire-event="sidebar-left-opened">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">

        <form class="search nav-form">
            <div class="input-group">
                <input type="text" class="form-control" readonly value="<?=$nama_app;?>">
                <span class="input-group-append">
								<button class="btn btn-default" type="submit"><i class="fas fa-clinic-medical"></i></button>
							</span>
            </div>
        </form>

        <span class="separator"></span>

        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="<?= base_url('public/uploads/thumbs/' . $sesi_avatar) ?>" alt="<?= $sesi_username; ?>"
                         class="rounded-circle" data-lock-picture="<?= base_url('public/uploads/thumbs/' . $sesi_avatar) ?>"/>
                </figure>
                <div class="profile-info" data-lock-name="<?= $sesi_username; ?>" data-lock-email="<?= $sesi_email; ?>">
                    <span class="name"><?= $sesi_username; ?></span>
                    <span class="role"><?= $sesi_level; ?></span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled mb-2">
                    <li class="divider"></li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="<?= base_url('dashboard/profil') ?>"><i
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
</header>