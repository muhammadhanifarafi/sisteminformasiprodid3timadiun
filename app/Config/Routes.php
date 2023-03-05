<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'AuthController::index');
// $routes->post('proses-login', 'AuthController::auth');
$routes->get('/', 'DashboardController::index');
$routes->get('dashboard', 'DashboardController::index');

// // Pengelolaan Data Mahasiswa
// // Tampil Data
// $routes->get('mahasiswa', 'MahasiswaController::index');
// $routes->get('/landing', 'LandingController::index');
// // Tambah Data
// $routes->get('mahasiswa/tambah', 'MahasiswaController::tambah');
// $routes->post('mahasiswa/simpan', 'MahasiswaController::simpan');
// // Edit Data
// $routes->get('mahasiswa/edit/(:segment)', 'BidangController::edit/$1');
// $routes->put('mahasiswa/update/(:segment)', 'BidangController::update/$1');
// // Hapus Data
// $routes->delete('bidang/hapus/(:segment)', 'BidangController::hapus/$1');

// SIPEMA
// Pengelolaan Data Bidang
$routes->group('bidang', static function ($routes) {
    // Tampil Data
    $routes->get('', 'Sipema\BidangController::index');
    // Tambah Data
    $routes->get('tambah', 'Sipema\BidangController::tambah');
    $routes->post('simpan', 'Sipema\BidangController::simpan');
    // Edit Data
    $routes->get('edit/(:segment)', 'Sipema\BidangController::edit/$1');
    $routes->put('update/(:segment)', 'Sipema\BidangController::update/$1');
    // Hapus Data
    $routes->delete('hapus/(:segment)', 'Sipema\BidangController::hapus/$1');
});

// Pengelolaan Data Sub Bidang
$routes->group('sub-bidang', static function ($routes) {
    // Tampil Data
    $routes->get('', 'Sipema\SubBidangController::index');
    $routes->get('tambah', 'Sipema\SubBidangController::tambah');
    $routes->post('simpan', 'Sipema\SubBidangController::simpan');
    // Edit Data
    $routes->get('edit/(:segment)', 'Sipema\SubBidangController::edit/$1');
    $routes->put('update/(:segment)', 'Sipema\SubBidangController::update/$1');
    // Hapus Data
    $routes->delete('hapus/(:segment)', 'Sipema\SubBidangController::delete/$1');
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}