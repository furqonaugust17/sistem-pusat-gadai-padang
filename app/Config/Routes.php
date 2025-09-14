<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes);
$routes->group('backend', static function ($routes) {
    $routes->resource('karyawan', ['controller' => 'KaryawanController']);
});
