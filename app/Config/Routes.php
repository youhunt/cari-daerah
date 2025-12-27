<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('/', fn() => view('landing'));
$routes->get('/dashboard', fn() => view('dashboard/index'), ['filter' => 'login']);

$routes->group('region', function ($routes) {
    $routes->get('provinsi', 'RegionApi::provinsi');
    $routes->get('kabupaten/(:num)', 'RegionApi::kabupaten/$1');
    $routes->get('kecamatan/(:num)', 'RegionApi::kecamatan/$1');
    $routes->get('desa/(:num)', 'RegionApi::desa/$1');
});

$routes->group('konten', ['filter' => 'login'], function ($routes) {
    $routes->get('/', 'ContentController::index');
    $routes->get('create', 'ContentController::create');
    $routes->post('store', 'ContentController::store');
    $routes->get('edit/(:num)', 'ContentController::edit/$1');
    $routes->post('update/(:num)', 'ContentController::update/$1');
});

$routes->get('cerita/(:segment)', 'ContentController::show/$1');

$routes->group('admin', ['filter' => 'role:administrator'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('moderasi', 'Admin\Moderasi::index');
    $routes->post('moderasi/update/(:num)', 'Admin\Moderasi::update/$1');
});
