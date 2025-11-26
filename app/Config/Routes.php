<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/barang-lelang', 'Home::barangLelang');
$routes->get('/barang-lelang/(:segment)', 'Home::detailBarangLelang/$1');
$routes->get('/barang-gadai/lelang/list', 'BarangGadaiController::ListLelang');
$routes->get('/cek-transaksi', 'CekTransaksiController::index');
$routes->post('/cek-transaksi', 'CekTransaksiController::getTransaksi');

service('auth')->routes($routes);
$routes->group('backend', static function ($routes) {
    $routes->resource('karyawan', ['controller' => 'KaryawanController']);
    $routes->resource('nasabah', ['controller' => 'NasabahController']);
    $routes->resource('barang-gadai', ['controller' => 'BarangGadaiController']);
    $routes->resource('laporan', ['controller' => 'LaporanController']);
    $routes->resource('backup', ['controller' => 'BackupController']);
    $routes->get('pembayaran/datatable', 'PembayaranController::datatable');
    $routes->resource('pembayaran', ['controller' => 'PembayaranController']);
    $routes->post('transaksi/generate-qrcode/(:segment)', 'TransaksiController::generateQRCode/$1');
    $routes->get('transaksi/datatable', 'TransaksiController::datatable');
    $routes->get('transaksi/getTransaksi', 'TransaksiController::getTransaksi');
    $routes->resource('transaksi', ['controller' => 'TransaksiController']);
    $routes->get('upload/file/(:segment)/(:alpha)', 'BarangGadaiController::showFile/$1/$2', ['as' => 'file.barang']);
    $routes->post('report/(:segment)', 'TransaksiController::createReport/$1');
    $routes->get('preview/(:any)', 'PreviewController::view/$1', ['as' => 'preview']);
});
