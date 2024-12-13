<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('dashboard', 'DashboardController::index');


// Group Routes untuk Kategori
$routes->group('kategori', function ($routes) {
    $routes->get('', 'KategoriController::index');
    $routes->get('create', 'KategoriController::create');
    $routes->post('store', 'KategoriController::store');
    $routes->get('edit/(:num)', 'KategoriController::edit/$1');
    $routes->post('update/(:num)', 'KategoriController::update/$1');
    $routes->get('delete/(:num)', 'KategoriController::delete/$1');
});

// Group Routes untuk Produk
$routes->group('produk', function ($routes) {
    $routes->get('', 'ProdukController::index');
    $routes->get('create', 'ProdukController::create');
    $routes->post('store', 'ProdukController::store');
    $routes->get('edit/(:num)', 'ProdukController::edit/$1');
    $routes->post('update/(:num)', 'ProdukController::update/$1');
    $routes->get('delete/(:num)', 'ProdukController::delete/$1');
});

// Group Routes untuk Pelanggan
$routes->group('pelanggan', function ($routes) {
    $routes->get('', 'PelangganController::index');
    $routes->get('create', 'PelangganController::create');
    $routes->post('store', 'PelangganController::store');
    $routes->get('edit/(:num)', 'PelangganController::edit/$1');
    $routes->post('update/(:num)', 'PelangganController::update/$1');
    $routes->get('delete/(:num)', 'PelangganController::delete/$1');
});

// Group Routes untuk Pemasok
$routes->group('pemasok', function ($routes) {
    $routes->get('', 'PemasokController::index');
    $routes->get('create', 'PemasokController::create');
    $routes->post('store', 'PemasokController::store');
    $routes->get('edit/(:num)', 'PemasokController::edit/$1');
    $routes->post('update/(:num)', 'PemasokController::update/$1');
    $routes->get('delete/(:num)', 'PemasokController::delete/$1');
});

// Group Routes untuk Stok
$routes->group('stok', function ($routes) {
    $routes->get('', 'StokController::index');
    $routes->get('create', 'StokController::create');
    $routes->post('store', 'StokController::store');
    $routes->get('edit/(:num)', 'StokController::edit/$1');
    $routes->post('update/(:num)', 'StokController::update/$1');
    $routes->get('delete/(:num)', 'StokController::delete/$1');
});

// Group Routes untuk Pembelian
$routes->group('pembelian', function ($routes) {
    $routes->get('', 'PembelianController::index');
    $routes->get('create', 'PembelianController::create');
    $routes->post('store', 'PembelianController::store');
    $routes->get('edit/(:num)', 'PembelianController::edit/$1');
    $routes->post('update/(:num)', 'PembelianController::update/$1');
    $routes->post('delete/(:num)', 'PembelianController::delete/$1'); // Ubah ini menjadi DELETE
    $routes->get('detail/(:num)', 'PembelianController::detail/$1');
});


// Group Routes untuk Penjualan
$routes->group('penjualan', function ($routes) {
    $routes->get('', 'PenjualanController::index');
    $routes->get('create', 'PenjualanController::create');
    $routes->post('store', 'PenjualanController::store');
    $routes->get('edit/(:num)', 'PenjualanController::edit/$1');
    $routes->post('update/(:num)', 'PenjualanController::update/$1');
    $routes->post('delete/(:num)', 'PenjualanController::delete/$1');
    $routes->get('detail/(:num)', 'PenjualanController::detail/$1');
});

// Group Routes untuk Detail Penjualan
$routes->group('detailpenjualan', function ($routes) {
    $routes->get('', 'DetailPenjualanController::index');
    $routes->get('create', 'DetailPenjualanController::create');
    $routes->post('store', 'DetailPenjualanController::store');
    $routes->get('edit/(:num)', 'DetailPenjualanController::edit/$1');
    $routes->post('update/(:num)', 'DetailPenjualanController::update/$1');
    $routes->get('delete/(:num)', 'DetailPenjualanController::delete/$1');
});

// Route untuk registrasi
$routes->get('register', 'AuthController::register', ['as' => 'register']); // Halaman registrasi
$routes->post('register', 'AuthController::storeRegister'); // Proses simpan registrasi

// Route untuk login
$routes->get('login', 'AuthController::login', ['as' => 'login']); // Halaman login
$routes->post('login', 'AuthController::authenticate'); // Proses autentikasi login

// Route untuk logout
$routes->get('logout', 'AuthController::logout', ['as' => 'logout']); // Proses logout
