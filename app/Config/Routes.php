<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


 $routes->get('/', 'Home::index');

$routes->get('auth', 'Auth\AuthController::index');
$routes->post('auth/login/process', 'Auth\AuthController::loginProcess');
$routes->post('auth/register/process', 'Auth\AuthController::registerProcess');
$routes->get('test-ktp', 'TestKtp::index');

// Routes KTP
$routes->get('form/ktp', 'Form\FormController::ktp');
$routes->post('form/ktp/ajax', 'Form\FormController::prosesKtpAjax');
$routes->get('form/ktp/preview/(:num)', 'Form\FormController::previewKtp/$1');
$routes->get('form/download-ktp/(:num)', 'Form\FormController::downloadKtp/$1');
$routes->get('form/riwayat', 'Form\FormController::riwayat');
$routes->get('form/ktp-preview-test', 'Form\FormController::ktpPreviewTest');


//Route Akte Kelahiran 

$routes->get('form/aktekelahiran', 'Form\AkteLahirController::index');
$routes->post('form/aktekelahiran/ajax', 'Form\AkteLahirController::prosesAkteAjax');
$routes->get('form/aktekelahiran/preview/(:num)', 'Form\AkteLahirController::previewAkte/$1');
$routes->get('form/aktekelahiran/riwayat', 'Form\AkteLahirController::riwayat');
$routes->get('form/download-akte/(:num)', 'Form\AkteLahirController::downloadAkte/$1');


//Route Akte Kematian 
$routes->get('form/aktekematian', 'Form\AkteKematianController::index');
$routes->post('form/aktekematian/prosesAkteAjax', 'Form\AkteKematianController::prosesAkteAjax');
$routes->get('form/aktekematian/riwayat', 'Form\AkteKematianController::riwayat');
$routes->get('form/aktekematian/download/(:num)', 'Form\AkteKematianController::downloadAkte/$1');

//Route Kartu Keluarga

$routes->get('form/kartukeluarga', 'Form\KartuKeluargaController::index');
$routes->post('form/kartukeluarga/prosesKkAjax', 'Form\KartuKeluargaController::prosesKkAjax');
$routes->get('form/kartukeluarga/riwayat', 'Form\KartuKeluargaController::riwayat');
$routes->get('form/kartukeluarga/download/(:num)', 'Form\KartuKeluargaController::downloadKk/$1');

//Route Akte Perkawinan
$routes->get('form/akteperkawinan', 'Form\AktePerkawinanController::index');
$routes->post('form/akteperkawinan/prosesAkteAjax', 'Form\AktePerkawinanController::prosesAkteAjax');
$routes->get('form/akteperkawinan/riwayat', 'Form\AktePerkawinanController::riwayat');
$routes->get('form/akteperkawinan/downloadAkte/(:num)', 'Form\AktePerkawinanController::downloadAkte/$1');

$routes->get('form/akteperceraian', 'Form\AktePerceraianController::index');
$routes->post('form/akteperceraian/prosesAkteAjax', 'Form\AktePerceraianController::prosesAkteAjax');
$routes->get('form/akteperceraian/riwayat', 'Form\AktePerceraianController::riwayat');
$routes->get('form/akteperceraian/downloadAkte/(:num)', 'Form\AktePerceraianController::downloadAkte/$1');


$routes->get('form/keteranganpindah', 'Form\KeteranganPindahController::index');
$routes->post('form/keteranganpindah/prosesPindahAjax', 'Form\KeteranganPindahController::prosesPindahAjax');
$routes->get('form/keteranganpindah/riwayat', 'Form\KeteranganPindahController::riwayat');
$routes->get('form/keteranganpindah/download/(:num)', 'Form\KeteranganPindahController::downloadPindah/$1');

// Route untuk menampilkan form KIA
$routes->get('form/kia', 'Form\KartuIdentitasAnakController::index');
$routes->post('form/kia/prosesKiaAjax', 'Form\KartuIdentitasAnakController::prosesKiaAjax');
$routes->get('form/kia/riwayat', 'Form\KartuIdentitasAnakController::riwayat');
$routes->get('form/kia/download/(:num)', 'Form\KartuIdentitasAnakController::downloadKia/$1');










$routes->get('logout', 'Auth\AuthController::logout');


