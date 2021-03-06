<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigasi
        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html"
             data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">

                <?php if ($sesi_level == 'admin') {
                    echo $this->include('backend/admin/sidebarAdmin');
                } else if ($sesi_level == 'dokter') {
                    echo $this->include('backend/petugas/sidebarPetugas');
                } else if ($sesi_level == 'bidan') {
                    echo $this->include('backend/petugas/sidebarPetugas');
                } else {
                    echo $this->include('backend/pimpinan/sidebarPimpinan');
                }
                ?>


            </nav>
        </div>

        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>


    </div>

</aside>