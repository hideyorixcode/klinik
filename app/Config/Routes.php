<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('LoginController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
//$routes->set404Override(function () {
//    return view('backend/404');
//});
$routes->setAutoRoute(true);
$routes->get('/', 'HomeController::index');
$routes->get('blank', 'HomeController::blank');
$routes->get('daftar', 'HomeController::daftar');
$routes->post('daftar-pasien', 'HomeController::createPasien');
$routes->get('jadwal', 'HomeController::infojadwal');
$routes->post('read-jadwal', 'HomeController::read_jadwal');
$routes->get('detail-jadwal/(:any)', 'HomeController::detail_jadwal/$1');
$routes->get('detail-petugas/(:any)', 'HomeController::detail_petugas/$1');
$routes->get('profil', 'HomeController::profil', ['filter' => 'ceklogin']);
$routes->post('update-profil', 'HomeController::update_profil_pasien', ['filter' => 'ceklogin']);
$routes->post('upload-image', 'HomeController::upload_image', ['filter' => 'ceklogin']);
$routes->post('delete-image', 'HomeController::delete_image', ['filter' => 'ceklogin']);
$routes->get('layanan', 'HomeController::layanan', ['filter' => 'ceklogin']);
$routes->get('daftar-layanan', 'HomeController::daftar_layanan', ['filter' => 'ceklogin']);
$routes->get('select-jadwal', 'HomeController::getJadwal', ['filter' => 'ceklogin']);
$routes->post('create-layanan', 'HomeController::createLayanan', ['filter' => 'ceklogin']);
$routes->post('read-layanan', 'HomeController::read_layanan', ['filter' => 'ceklogin']);
$routes->get('detail-layanan/(:any)', 'HomeController::detail_layanan/$1', ['filter' => 'ceklogin']);
$routes->get('print-layanan/(:any)', 'HomeController::print_layanan/$1', ['filter' => 'ceklogin']);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'HomeController::index_front');
$routes->group('dashboard', ['filter' => 'cekloginLevel'], function ($routes) {
    $routes->get('/', 'HomeController::dashboard');
    $routes->get('profil', 'HomeController::profil');
    $routes->post('update-profil', 'HomeController::update_profil');

    $routes->get('log', 'LogController::index', ['filter' => 'cekloginAdmin']);
    $routes->post('log/read', 'LogController::read', ['filter' => 'cekloginAdmin']);
    $routes->post('log/bulk_delete', 'LogController::bulk_delete', ['filter' => 'cekloginAdmin']);


    $routes->group('konfigurasi', ['filter' => 'cekloginAdmin'], function ($routes) {
        $routes->get('/', 'KonfigurasiController::index');
        $routes->get('edit/(:any)', 'KonfigurasiController::edit/$1');
        $routes->post('update', 'KonfigurasiController::update');
        $routes->post('updateAll', 'KonfigurasiController::updateAll');
        $routes->post('read', 'KonfigurasiController::read');
    });

    $routes->group('poli', ['filter' => 'cekloginAdmin'], function ($routes) {
        $routes->get('/', 'PoliController::index');
        $routes->post('read', 'PoliController::read');
        $routes->post('create', 'PoliController::create');
        $routes->get('edit/(:any)', 'PoliController::edit/$1');
        $routes->post('update', 'PoliController::update');
        $routes->get('delete/(:any)', 'PoliController::delete/$1');
        $routes->post('bulk_delete', 'PoliController::bulk_delete');
        $routes->post('bulk_status', 'PoliController::bulk_status');
    });

    $routes->group('pasien', ['filter' => 'cekloginAdmin'], function ($routes) {
        $routes->get('/', 'PasienController::index');
        $routes->post('read', 'PasienController::read');
        $routes->post('create', 'PasienController::create');
        $routes->get('edit/(:any)', 'PasienController::edit/$1');
        $routes->get('detail/(:any)', 'PasienController::detail/$1');
        $routes->post('update', 'PasienController::update');
        $routes->get('delete/(:any)', 'PasienController::delete/$1');
        $routes->post('bulk_delete', 'PasienController::bulk_delete');
        $routes->post('bulk_status', 'PasienController::bulk_status');
    });

    $routes->group('jadwal', ['filter' => 'cekloginAdmin'], function ($routes) {
        $routes->get('/', 'JadwalController::index');
        $routes->post('read', 'JadwalController::read');
        $routes->get('form', 'JadwalController::form');
        $routes->post('create', 'JadwalController::create');
        $routes->get('edit/(:any)', 'JadwalController::edit/$1');
        $routes->get('detail/(:any)', 'JadwalController::detail/$1');
        $routes->post('update', 'JadwalController::update');
        $routes->get('delete/(:any)', 'JadwalController::delete/$1');
        $routes->post('bulk_delete', 'JadwalController::bulk_delete');
        $routes->post('bulk_status', 'JadwalController::bulk_status');
    });

    $routes->group('layanan', ['filter' => 'cekloginAdmin'], function ($routes) {
        $routes->get('/', 'LayananController::index');
        $routes->post('read', 'LayananController::read');
        $routes->get('rekam-medis/(:any)', 'LayananController::rekam_medis/$1');
        $routes->post('create-rekam', 'LayananController::createRekam');
        $routes->post('update-rekam', 'LayananController::updateRekam');
        $routes->get('konsultasi/(:any)', 'LayananController::konsultasi/$1');
        $routes->post('create-konsultasi', 'LayananController::createKonsultasi');
        $routes->post('update-konsultasi', 'LayananController::updateKonsultasi');
        $routes->get('surat/(:any)', 'LayananController::surat/$1');
        $routes->post('create-surat', 'LayananController::createSurat');
        $routes->post('update-surat', 'LayananController::updateSurat');

        $routes->get('edit/(:any)', 'LayananController::edit/$1');
        $routes->get('detail/(:any)', 'LayananController::detail/$1');
        $routes->post('update', 'LayananController::update');
        $routes->get('delete/(:any)', 'LayananController::delete/$1');
        $routes->post('bulk_delete', 'LayananController::bulk_delete');
        $routes->post('bulk_status', 'LayananController::bulk_status');
    });

    $routes->group('pengguna', ['filter' => 'cekloginAdmin'], function ($routes) {
        $routes->get('/', 'PenggunaController::index');
        $routes->get('getViewData', 'PenggunaController::view_data');
        $routes->get('getSearchData', 'PenggunaController::search');
        $routes->post('create', 'PenggunaController::create');
        $routes->get('edit/(:any)', 'PenggunaController::edit/$1');
        $routes->post('update', 'PenggunaController::update');
        $routes->get('delete/(:any)', 'PenggunaController::delete/$1');
        $routes->post('bulk_delete', 'PenggunaController::bulk_delete');
        $routes->post('bulk_status', 'PenggunaController::bulk_status');
    });

    $routes->group('petugas', ['filter' => 'cekloginAdmin'], function ($routes) {
        $routes->get('/', 'PetugasController::index');
        $routes->get('getViewData', 'PetugasController::view_data');
        $routes->get('getSearchData', 'PetugasController::search');
        $routes->get('form', 'PetugasController::form');
        $routes->post('create', 'PetugasController::create');
        $routes->get('edit/(:any)', 'PetugasController::edit/$1');
        $routes->get('detail/(:any)', 'PetugasController::detail/$1');
        $routes->post('update', 'PetugasController::update');
        $routes->get('delete/(:any)', 'PetugasController::delete/$1');
        $routes->post('bulk_delete', 'PetugasController::bulk_delete');
        $routes->post('bulk_status', 'PetugasController::bulk_status');
    });
});
$routes->get('/syslog', 'LoginController::index');
$routes->post('/syslog/cek_login/', 'LoginController::cek_login');
$routes->get('/syslog/logout/', 'LoginController::logout');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}