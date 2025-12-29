<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('/', fn() => view('landing'));
// =======================
// DASHBOARD (SEMUA USER)
// =======================
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'login']);

// =======================
// KONTEN (KONTRIBUTOR)
// =======================
$routes->group('konten', ['filter' => 'login'], function ($routes) {
    $routes->get('/', 'ContentController::index');
    $routes->get('create', 'ContentController::create');
    $routes->post('store', 'ContentController::store');
    $routes->get('edit/(:num)', 'ContentController::edit/$1');
    $routes->post('update/(:num)', 'ContentController::update/$1');
});

// =======================
// ADMIN (FITUR TAMBAHAN)
// =======================
$routes->group('admin', ['filter' => 'role:administrator'], function ($routes) {
    $routes->get('moderasi', 'AdminController::moderasi');
    $routes->get('users', 'AdminController::users');
});

// OPTIONAL: redirect dashboard lama
$routes->get('admin/dashboard', fn () => redirect()->to('/dashboard'));

$routes->group('ajax', function ($routes) {
    $routes->get('provinsi', 'RegionController::provinsi');
    $routes->get('kabupaten/(:num)', 'RegionController::kabupaten/$1');
    $routes->get('kecamatan/(:num)', 'RegionController::kecamatan/$1');
    $routes->get('desa/(:num)', 'RegionController::desa/$1');
});

// =======================
// PUBLIC SEARCH & CONTENT
// =======================
$routes->get('cari', 'PublicController::index');
$routes->get('cari/cerita/(:segment)', 'PublicController::show/$1');

// (opsional) backward compatibility
$routes->get('cerita', fn() => redirect()->to('/cari'));
$routes->get('cerita/(:segment)', fn($slug) => redirect()->to("/cari/cerita/$slug"));

