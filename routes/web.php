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
Route::get('/register/ormawa', 'RegisterController@getRegisterOrmawa');
Route::get('register/mahasiswa', 'RegisterController@getRegisterMahasiswa');
Route::get('register/dosen', 'RegisterController@getRegisterDosen');
Route::post('/register/regist', 'RegisterController@postRegister');
Route::get('/login', 'LoginController@getLogin')->name('login');
Route::post('/login/authentication', 'LoginController@postLogin');
Route::get('/logout', 'LoginController@postLogout');

//Admin - V
Route::get('/admin/dashboard', 'AdminDashboardController@dashboardAdmin');
//Admin-Barang - V
Route::get('/admin/barang', 'AdminDataBarangController@index');
Route::get('/admin/barang/tambah', 'AdminDataBarangController@tambah');
Route::get('/admin/barang/ubah/{id}', 'AdminDataBarangController@ubah');
Route::get('/admin/barang/lihat/{id}', 'AdminDataBarangController@lihat');
Route::post('/admin/barang/prosesTambah', 'AdminDataBarangController@prosesTambah');
Route::post('/admin/barang/prosesUbah', 'AdminDataBarangController@prosesUbah');
Route::post('/admin/barang/prosesHapus', 'AdminDataBarangController@prosesHapus');
Route::post('/admin/barang/cetakTahunan', 'AdminDataBarangController@cetakTahunan');
Route::post('/admin/barang/cetakBulanan', 'AdminDataBarangController@cetakBulanan');
Route::post('/admin/barang/cetakHarian', 'AdminDataBarangController@cetakTanggal');
Route::post('/admin/barang/prosesRestock', 'AdminDataBarangController@prosesRestock');

//Admin-Inventaris - V
Route::get('/admin/inventaris', 'AdminDataInventarisController@index');
Route::get('/admin/inventaris/tambah', 'AdminDataInventarisController@tambah');
Route::get('/admin/inventaris/ubah/{id}', 'AdminDataInventarisController@ubah');
Route::get('/admin/inventaris/lihat/{id}', 'AdminDataInventarisController@lihat');
Route::post('/admin/inventaris/prosesTambah', 'AdminDataInventarisController@prosesTambah');
Route::post('/admin/inventaris/prosesUbah', 'AdminDataInventarisController@prosesUbah');
Route::post('/admin/inventaris/prosesHapus', 'AdminDataInventarisController@prosesHapus');
Route::post('/admin/inventaris/cetakTahunan', 'AdminDataInventarisController@cetakTahunan');
Route::post('/admin/inventaris/cetakBulanan', 'AdminDataInventarisController@cetakBulanan');
Route::post('/admin/inventaris/cetakHarian', 'AdminDataInventarisController@cetakTanggal');

//Admin-Pengguna - V
Route::get('/admin/pengguna', 'AdminDataPenggunaController@index');
Route::get('/admin/pengguna/tambah/{jenis}', 'AdminDataPenggunaController@tambah');
Route::get('/admin/pengguna/ubah/{id}', 'AdminDataPenggunaController@ubah');
Route::get('/admin/pengguna/lihat/{id}', 'AdminDataPenggunaController@lihat');
Route::post('/admin/pengguna/prosesTambah', 'AdminDataPenggunaController@prosesTambah');
Route::post('/admin/pengguna/prosesUbah', 'AdminDataPenggunaController@prosesUbah');
Route::post('/admin/pengguna/prosesHapus', 'AdminDataPenggunaController@prosesHapus');
Route::post('/admin/pengguna/resetPassword', 'AdminDataPenggunaController@resetPassword');

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


Route::get('/bagumum/dashboard', 'BagumumDashboardController@dashboardBagUmum');
//Bagumum-Barang - V
Route::get('/bagumum/barang', 'BagumumDataBarangController@index');
Route::get('/bagumum/barang/tambah', 'BagumumDataBarangController@tambah');
Route::get('/bagumum/barang/ubah/{id}', 'BagumumDataBarangController@ubah');
Route::get('/bagumum/barang/lihat/{id}', 'BagumumDataBarangController@lihat');
Route::post('/bagumum/barang/prosesTambah', 'BagumumDataBarangController@prosesTambah');
Route::post('/bagumum/barang/prosesUbah', 'BagumumDataBarangController@prosesUbah');
Route::post('/bagumum/barang/prosesHapus', 'BagumumDataBarangController@prosesHapus');
Route::post('/bagumum/barang/cetakTahunan', 'BagumumDataBarangController@cetakTahunan');
Route::post('/bagumum/barang/cetakBulanan', 'BagumumDataBarangController@cetakBulanan');
Route::post('/bagumum/barang/cetakHarian', 'BagumumDataBarangController@cetakTanggal');
Route::post('/bagumum/barang/prosesRestock', 'BagumumDataBarangController@prosesRestock');

//Bagumum-Inventaris - V
Route::get('/bagumum/inventaris', 'BagumumDataInventarisController@index');
Route::get('/bagumum/inventaris/tambah', 'BagumumDataInventarisController@tambah');
Route::get('/bagumum/inventaris/ubah/{id}', 'BagumumDataInventarisController@ubah');
Route::get('/bagumum/inventaris/lihat/{id}', 'BagumumDataInventarisController@lihat');
Route::post('/bagumum/inventaris/prosesTambah', 'BagumumDataInventarisController@prosesTambah');
Route::post('/bagumum/inventaris/prosesUbah', 'BagumumDataInventarisController@prosesUbah');
Route::post('/bagumum/inventaris/prosesHapus', 'BagumumDataInventarisController@prosesHapus');
Route::post('/bagumum/inventaris/cetakTahunan', 'BagumumDataInventarisController@cetakTahunan');
Route::post('/bagumum/inventaris/cetakBulanan', 'BagumumDataInventarisController@cetakBulanan');
Route::post('/bagumum/inventaris/cetakHarian', 'BagumumDataInventarisController@cetakTanggal');

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

Route::get('/default', function () {
    return view('dashboard');
});
Route::get('/400', function () {
    return view('400');
});
