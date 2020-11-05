<ul class="nav nav-main">
    <li>
        <a class="nav-link" href="<?= base_url('dashboard/kecamatan') ?>">
            <i class="fas fa-home" aria-hidden="true"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="<?= getSegment(2) == 'poli' ? 'nav-active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('dashboard/poli') ?>">
            <i class="fas fa-clinic-medical" aria-hidden="true"></i>
            <span>Data Poli</span>
        </a>
    </li>
    <li class="<?= getSegment(2) == 'petugas' ? 'nav-active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('dashboard/petugas') ?>">
            <i class="fas fa-user-md" aria-hidden="true"></i>
            <span>Data Petugas Kesehatan</span>
        </a>
    </li>
    <li class="<?= getSegment(2) == 'jadwal' ? 'nav-active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('dashboard/jadwal') ?>">
            <i class="fas fa-stopwatch" aria-hidden="true"></i>
            <span>Jadwal Klinik</span>
        </a>
    </li>
    <li class="<?= getSegment(2) == 'pengguna' ? 'nav-active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('dashboard/pengguna') ?>">
            <i class="fas fa-chalkboard-teacher" aria-hidden="true"></i>
            <span>Data Pengguna</span>
        </a>
    </li>
    <li class="<?= getSegment(2) == 'log' ? 'nav-active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('dashboard/log') ?>">
            <i class="fas fa-history" aria-hidden="true"></i>
            <span>Log Aktivitas</span>
        </a>
    </li>
    <li class="<?= getSegment(2) == 'konfigurasi' ? 'nav-active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('dashboard/konfigurasi') ?>">
            <i class="fas fa-cog" aria-hidden="true"></i>
            <span>Konfigurasi App</span>
        </a>
    </li>


</ul>