<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes);
$routes->group('backend', static function ($routes) {
    $routes->resource('karyawan', ['controller' => 'KaryawanController']);
    $routes->resource('nasabah', ['controller' => 'NasabahController']);
    $routes->resource('barang-gadai', ['controller' => 'BarangGadaiController']);
    $routes->get('upload/file/(:segment)/(:alpha)', 'BarangGadaiController::showFile/$1/$2', ['as' => 'file.barang']);
});
