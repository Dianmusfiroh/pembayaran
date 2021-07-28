<?php

use App\Http\Controllers\SkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/login');
// Route::get('/alur','Front@alur');
// Route::get('/help','Front@help');

Auth::routes([
    'register' => true
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('master/wilayah/provinsi', 'ProvincesController');
Route::resource('master/wilayah/kabupaten', 'KabupatensController');
Route::resource('master/wilayah/kecamatan', 'KecamatansController');
Route::resource('master/wilayah/desa', 'VillagesController');
Route::resource('master/instansi', 'InstitutesController');
Route::resource('master/assesment-option', 'AssesmentOptionsController');
Route::resource('master/assesment-score', 'AssesmentScoresController');
Route::resource('master/assesment-form', 'AssesmentFormsController');
Route::post('pembayaran/tagihan-detail', 'InvoiceDetailsController@store')->name('storePesertaInvoice');
Route::get('pembayaran/tagihan/{id}/peserta', 'InvoiceDetailsController@create')->name('addPesertaInvoice');
Route::delete('pembayaran/tagihan-detail/{id}', 'InvoiceDetailsController@destroy')->name('destroyPesertaInvoice');
// Route::delete('apps/sk/{id}', 'SkDetailsController@destroy');
// Route::('apps/sk/{id}', 'SkDetailsController@destroy')->name('destroyPesertaSK');

Route::get('apps/sk/{id}/peserta', 'SkDetailsController@create')->name('createPesertaSK');
Route::post('apps/sk/{id}/peserta', 'SkDetailsController@store')->name('storePesertaSK');
Route::get('apps/sk/generate-peserta/{id}','SkController@generatePeserta')->name('generatePesertaSk');
Route::resource('apps/sk', 'SkController');
Route::post('apps/tambah-peserta-sk','SkDetailsController@store')->name('addPesertaToSk');
Route::resource('master/skdetail', 'SkDetailsController');
Route::get('apps/gtt/search', 'GttsController@search')->name('searchGtt');
// Route::get('apps/gtt/{id}', 'GttsController@index');
// Route::get('apps/gtt', 'GttsController');
// // Route::get('apps/gtt/{id}/create', 'GttsController@create');
Route::delete('master/gtt/{id}', 'GttsController@destroy');

Route::resource('master/gtt', 'GttsController');

// Route::get('master/ gtt/{id}', 'GttsController@index');
// Route::get('master/gtt', 'GttsController@index');
Route::resource('master/jabatan', 'JabatansController');

// Route::get('master/formasi/{kategori}', 'FormationNeedsController@ByCategory');
Route::resource('master/formasi', 'FormationNeedsController');
Route::resource('master/qualifikasi', 'QualificationsController');
Route::resource('master/opsekolah', 'opsekolahsController');
Route::resource('master/cluster', 'ClustersController');
Route::get('pendaftaran/peserta/search', 'FormationsController@search');
Route::get('gtt/search', 'skController@search');

Route::get('pendaftaran/peserta/{kategori}/{category_formation}', 'FormationsController@index');
Route::get('pendaftaran/penilaian/{kategori}/{formation_category}', 'AssesmentsController@index');
Route::get('pendaftaran/penilaian/{kategori}/{formation_category}/create', 'AssesmentsController@create');
Route::get('pendaftaran/penilaian/{kategori}/{formation_category}/download', 'AssesmentsController@download');
Route::resource('pendaftaran/peserta', 'FormationsController');
// Route::get('pendaftaran/penilaian/create', 'AssesmentsController@create');
// Route::get('pendaftaran/penilaian/{kategori}', 'AssesmentsController@index');
Route::resource('pendaftaran/penilaian', 'AssesmentsController');
Route::resource('pembayaran/tagihan', 'InvoicesController');
Route::resource('pengaturan/pengguna', 'UserController');
Route::resource('pengaturan/pagu', 'PagusController');
Route::resource('pengaturan/sumber-anggaran', 'SumbersController');
Route::resource('pengaturan/umum', 'SettingsController');
Route::resource('apps/biodata', 'BiodatasController');
Route::get('apps/informasi', 'HomeController@information');
Route::get('apps/informasi/{id}', 'HomeController@information_detail');
Route::get('apps/import', 'ImportExportController@index');
Route::post('apps/import', 'ImportExportController@import');
Route::get('apps/export', 'ImportExportController@export');
Route::post('apps/bid/{job_id}', 'FormationsController@store');
Route::get('apps/sk/{id}/print', 'SkController@print')->name('printSk');
Route::get('apps/tagihan/{id}/print', 'InvoicesController@print')->name('printTagihan');
Route::get('apps/bid/{job_id}/{peserta_id}/cetak-kartu','FormationsController@kartu')->name('cetakKartuRegistrasi');
Route::get('apps/formasi/{kategori}/{position}','FormationNeedsController@ByCategory')->name('formasiPendaftaran');
Route::get('apps/formasi/{kategori}/{position}/{id}', 'FormationNeedsController@show')->name('formasiPendaftaran');
Route::get('pembayaran/laporan/rekap-kecamatan','LaporanController@rekapKecamatan')->name('cetakPembayaranRekapKecamatan');
Route::get('pembayaran/laporan/rekap-total', 'LaporanController@rekapTotal')->name('cetakPembayaranRekapTotal');
Route::get('dashboard_pendaftaran', 'HomeController@dash_pendaftaran');
Route::resource('kinerja', 'KinerjasController');
Route::get('Kinerja/search', 'kinerjasController@search');
// Route::post('apps/kinerja/{id}/', 'kinerjaDetailsController@store')->name('storeKinerja');
