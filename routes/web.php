<?php

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

Route::get('/','WelcomeController@index');

//authentikasi user - V
Route::get('/register/bagumum','RegisterController@getRegisterBagUmum');
Route::get('register/mahasiswa', 'RegisterController@getRegisterMahasiswa');
Route::get('register/dosen', 'RegisterController@getRegisterDosen');
Route::post('/register/regist', 'RegisterController@postRegister');
Route::get('/login', 'LoginController@getLogin')->name('login');
Route::post('/login/authentication', 'LoginController@postLogin');
Route::get('/logout', 'LoginController@postLogout');


//Admin-Peminjaman - V
Route::get('/admin/peminjaman', 'AdminDataPeminjamanController@index');
Route::get('/admin/peminjaman/lihat/{id}', 'AdminDataPeminjamanController@lihat');
Route::post('/admin/peminjaman/konfirmasi', 'AdminDataPeminjamanController@prosesKonfirmasi');
Route::post('/admin/peminjaman/prosesHapus', 'AdminDataPeminjamanController@prosesHapus');
Route::post('/admin/peminjaman/cetakTahunan', 'AdminDataPeminjamanController@cetakTahunan');
Route::post('/admin/peminjaman/cetakBulanan', 'AdminDataPeminjamanController@cetakBulanan');
Route::post('/admin/peminjaman/cetakHarian', 'AdminDataPeminjamanController@cetakTanggal');

//Admin-Request - V
Route::get('/admin/request', 'AdminDataRequestController@index');
Route::get('/admin/request/lihat/{id}', 'AdminDataRequestController@lihat');
Route::post('/admin/request/konfirmasi', 'AdminDataRequestController@prosesKonfirmasi');
Route::post('/admin/request/prosesHapus', 'AdminDataRequestController@prosesHapus');
Route::post('/admin/request/cetakTahunan', 'AdminDataRequestController@cetakTahunan');
Route::post('/admin/request/cetakBulanan', 'AdminDataRequestController@cetakBulanan');
Route::post('/admin/request/cetakHarian', 'AdminDataRequestController@cetakTanggal');

//Bagumum-Peminjaman - V
Route::get('/bagumum/peminjaman', 'BagumumDataPeminjamanController@index');
Route::get('/bagumum/peminjaman/lihat/{id}', 'BagumumDataPeminjamanController@lihat');
Route::post('/bagumum/peminjaman/konfirmasi', 'BagumumDataPeminjamanController@prosesKonfirmasi');
Route::post('/bagumum/peminjaman/prosesHapus', 'BagumumDataPeminjamanController@prosesHapus');
Route::post('/bagumum/peminjaman/cetakTahunan', 'BagumumDataPeminjamanController@cetakTahunan');
Route::post('/bagumum/peminjaman/cetakBulanan', 'BagumumDataPeminjamanController@cetakBulanan');
Route::post('/bagumum/peminjaman/cetakHarian', 'BagumumDataPeminjamanController@cetakTanggal');

//Bagumum-Request - V
Route::get('/bagumum/request', 'BagumumDataRequestController@index');
Route::get('/bagumum/request/lihat/{id}', 'BagumumDataRequestController@lihat');
Route::post('/bagumum/request/konfirmasi', 'BagumumDataRequestController@prosesKonfirmasi');
Route::post('/bagumum/request/prosesHapus', 'BagumumDataRequestController@prosesHapus');
Route::post('/bagumum/request/cetakTahunan', 'BagumumDataRequestController@cetakTahunan');
Route::post('/bagumum/request/cetakBulanan', 'BagumumDataRequestController@cetakBulanan');
Route::post('/bagumum/request/cetakHarian', 'BagumumDataRequestController@cetakTanggal');


//User
Route::get('/user/dashboard', 'UserDashboardController@dashboardUser');
Route::get('/user/peminjaman', 'UserDataPeminjamanController@index');
Route::get('/user/peminjaman/pinjam', 'UserDataPeminjamanController@pinjam');
Route::get('/user/peminjaman/lihat/{id}', 'UserDataPeminjamanController@lihat');
Route::get('/user/peminjaman/ubah/{id}', 'UserDataPeminjamanController@ubah');
Route::post('/user/peminjaman/prosesPinjam', 'UserDataPeminjamanController@prosesPinjam');
Route::post('/user/peminjaman/prosesHapus', 'UserDataPeminjamanController@prosesHapus');
Route::post('/user/peminjaman/prosesUbah', 'UserDataPeminjamanController@prosesUbah');


//Dosen-Request V
Route::get('/dosen/dashboard', 'DosenDashboardController@dashboardDosen'); //x
Route::get('/dosen/request', 'DosenDataRequestController@index'); //x
Route::get('/dosen/request/lihat/{id}', 'DosenDataRequestController@lihat'); //x
Route::get('/dosen/request/tambah', 'DosenDataRequestController@ajukan'); //x
Route::get('/dosen/request/ubah/{id}', 'DosenDataRequestController@ubah'); //x
Route::post('/dosen/request/prosesTambah', 'DosenDataRequestController@prosesTambah'); //x
Route::post('/dosen/request/prosesHapus', 'DosenDataRequestController@prosesHapus'); //x
Route::post('/dosen/request/prosesUbah', 'DosenDataRequestController@prosesUbah'); //x
Route::get('/dosen/peminjaman', 'DosenDataPeminjamanController@index'); //x
Route::get('/dosen/peminjaman/lihat/{id}', 'DosenDataPeminjamanController@lihat'); //x
Route::get('/dosen/peminjaman/tambah', 'DosenDataPeminjamanController@pinjam');
Route::get('/dosen/peminjaman/ubah/{id}', 'DosenDataPeminjamanController@ubah');
Route::post('/dosen/peminjaman/prosesPinjam', 'DosenDataPeminjamanController@prosesPinjam');
Route::post('/dosen/peminjaman/prosesHapus', 'DosenDataPeminjamanController@prosesHapus'); //x
Route::post('/dosen/peminjaman/prosesUbah', 'DosenDataPeminjamanController@prosesUbah');

Route::get('/dosen/peminjaman/cetak/{id}', 'DosenDataPeminjamanController@cetak');
Route::get('/user/peminjaman/cetak/{id}', 'UserDataPeminjamanController@cetak');

Route::group(['middleware' => ['web', 'role:admin,bagumum']], function() {
  // Modul Barang
  Route::get('/barang', 'BarangController@index')->name('barang.index');
  Route::post('/barang/restock', 'BarangController@prosesRestock')->name('barang.restock');
  Route::get('/barang/tambah', 'BarangController@tambah')->name('barang.tambah');
  Route::post('/barang/cetaktahunan', 'BarangController@cetakTahunan')->name('barang.cetakTahunan');
  Route::post('/barang/cetakBulanan', 'BarangController@cetakBulanan')->name('barang.cetakBulanan');
  Route::post('/barang/cetakHarian', 'BarangController@cetakTanggal')->name('barang.cetakHarian');
  Route::post('/barang', 'BarangController@prosesTambah')->name('barang.prosesTambah');
  Route::delete('/barang/{id}', 'BarangController@prosesHapus')->name('barang.prosesHapus');
  Route::get('/barang/{id}', 'BarangController@lihat')->name('barang.lihat');
  Route::put('/barang/{id}', 'BarangController@prosesUbah')->name('barang.prosesUbah');
  Route::get('/barang/{id}/edit', 'BarangController@ubah')->name('barang.ubah');

  // Modul Inventaris
  Route::get('/inventaris', 'InventarisController@index')->name('inventaris.index');
  Route::post('/inventaris', 'InventarisController@prosesTambah')->name('inventaris.prosesTambah');
  Route::post('/inventaris/prosesHapus', 'InventarisController@prosesHapus')->name('inventaris.prosesHapus');
  Route::get('/inventaris/tambah', 'InventarisController@tambah')->name('inventaris.tambah');
  Route::get('/inventaris/{id}', 'InventarisController@lihat')->name('inventaris.lihat');
  Route::put('/inventaris/{id}', 'InventarisController@prosesUbah')->name('inventaris.prosesUbah');
  Route::get('/inventaris/{id}/edit', 'InventarisController@ubah')->name('inventaris.ubah');
});


// Modul Peminjaman
Route::group(['middleware' => ['web', 'role:admin,bagumum']], function() {
  Route::post('/peminjaman/konfirmasi', 'PeminjamanController@prosesKonfirmasi')->name('peminjaman.prosesKonfirmasi');
  Route::post('/peminjaman/cetakTahunan', 'PeminjamanController@cetakTahunan')->name('peminjaman.cetakTahunan');
  Route::post('/peminjaman/cetakBulanan', 'PeminjamanController@cetakBulanan')->name('peminjaman.cetakBulanan');
  Route::post('/peminjaman/cetakHarian', 'PeminjamanController@cetakTanggal')->name('peminjaman.cetakHarian');
});

Route::group(['middleware' => ['web', 'role:admin,bagumum,dosen,mahasiswa']], function() {
  Route::get('/peminjaman', 'PeminjamanController@index')->name('peminjaman.index');
  Route::get('/peminjaman/{id}', 'PeminjamanController@lihat')->name('peminjaman.lihat');
  Route::post('/peminjaman/prosesHapus', 'PeminjamanController@prosesHapus')->name('peminjaman.prosesHapus');
});

Route::group(['middleware' => ['web', 'role:dosen,mahasiswa']], function() {
  Route::get('/peminjaman/pinjam', 'PeminjamanController@pinjam')->name('peminjaman.pinjam');
  Route::post('/peminjaman/prosesPinjam', 'PeminjamanController@prosesPinjam')->name('peminjaman.prosesPinjam');
});


// Modul Pengguna
Route::group(['middleware' => ['web', 'role:admin']], function() {
    Route::get('/pengguna', 'UsersController@index')->name('user.index');
    Route::get('/pengguna/tambah/{role}', 'UsersController@tambah')->name('user.tambah');
    Route::get('/pengguna/{id}', 'UsersController@lihat')->name('user.lihat');
    Route::put('/pengguna/{id}', 'UsersController@prosesUbah')->name('user.prosesUbah');
    Route::get('/pengguna/{id}/edit', 'UsersController@ubah')->name('user.ubah');
    Route::post('/pengguna/prosesHapus', 'UsersController@prosesHapus')->name('user.prosesHapus');
    Route::post('/pengguna/prosesUbahPassword', 'UsersController@prosesUbahPassword')->name('user.resetPassword');
});

// Modul request
Route::group(['middleware' => ['web', 'role:dosen,admin,bagumum']], function() {
  Route::get('/request', 'RequestController@index')->name('request.index');
  Route::get('/request/tambah', 'RequestController@tambah')->name('request.tambah');
  Route::get('/request/{id}/edit', 'RequestController@ubah')->name('request.ubah');
  Route::get('/request/{id}', 'RequestController@lihat')->name('request.lihat');
  Route::post('/request/konfirmasi', 'RequestController@prosesKonfirmasi')->name('request.prosesKonfirmasi');
  Route::post('/request/prosesHapus', 'RequestController@prosesHapus')->name('request.prosesHapus');
});

Route::group(['middleware' => ['web', 'role:admin,bagumum']], function() {
  Route::post('/request/cetakTahunan', 'RequestController@cetakTahunan')->name('request.cetakTahunan');
  Route::post('/request/cetakBulanan', 'RequestController@cetakBulanan')->name('request.cetakBulanan');
  Route::post('/request/cetakHarian', 'RequestController@cetakTanggal')->name('request.cetakHarian');
});


Route::get('/dashboard', 'UsersController@dashboard')->name('dashboard');

Route::get('/default', function () {
    return view('dashboard');
});
Route::get('/400', function () {
    return view('400');
});
