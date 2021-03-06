<ul class="nav nav-main">
    <li class="<?= getSegment(2) == '' ? 'nav-active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-home" aria-hidden="true"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="<?= getSegment(2) == 'pasien' ? 'nav-active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('dashboard/pasien') ?>">
            <i class="fas fa-diagnoses" aria-hidden="true"></i>
            <span>Pasien</span>
        </a>
    </li>
    <li class="<?= getSegment(2) == 'poli' ? 'nav-active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('dashboard/poli') ?>">
            <i class="fas fa-clinic-medical" aria-hidden="true"></i>
            <span>Poli</span>
        </a>
    </li>
    <li class="<?= getSegment(2) == 'petugas' ? 'nav-active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('dashboard/petugas') ?>">
            <i class="fas fa-user-md" aria-hidden="true"></i>
            <span>Petugas Kesehatan</span>
        </a>
    </li>
    <li class="<?= getSegment(2) == 'jadwal' ? 'nav-active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('dashboard/jadwal') ?>">
            <i class="fas fa-stopwatch" aria-hidden="true"></i>
            <span>Jadwal Klinik</span>
        </a>
    </li>

    <li class="<?= getSegment(2) == 'layanan' ? 'nav-active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('dashboard/layanan') ?>">
            <i class="fas fa-reply" aria-hidden="true"></i>
            <span>Pendaftaran Layanan</span>
        </a>
    </li>


</ul>