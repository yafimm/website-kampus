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
Route::get('/register/staff_inventaris','RegisterController@getRegisterstaff_inventaris');
Route::get('register/mahasiswa', 'RegisterController@getRegisterMahasiswa');
Route::get('register/dosen', 'RegisterController@getRegisterDosen');
Route::post('/register/regist', 'RegisterController@postRegister');
Route::get('/login', 'LoginController@getLogin')->name('login');
Route::post('/login/authentication', 'LoginController@postLogin');
Route::get('/logout', 'LoginController@postLogout');

Route::get('/dashboard', 'UsersController@dashboard')->name('dashboard');

Route::get('download/{filename}', function($filename)
{
    // Check if file exists in app/storage/file folder
    $file_path = public_path('suratpeminjaman/'.$filename);
    if (file_exists($file_path))
    {
        // Send Download
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        // Error
        exit('Requested file does not exist on our server!');
    }
})
->where('filename', '[A-Za-z0-9\-\_\.]+')->name('downloadsurat');

Route::group(['middleware' => ['web','auth','role:admin,staff_inventaris']], function() {

  Route::post('/request/konfirmasi', 'RequestController@prosesKonfirmasi')->name('request.prosesKonfirmasi');

  // Modul Barang
  Route::get('/barang', 'BarangController@index')->name('barang.index');
  Route::post('/barang/restock', 'BarangController@prosesRestock')->name('barang.restock');
  Route::get('/barang/tambah', 'BarangController@tambah')->name('barang.tambah');
  Route::post('/barang', 'BarangController@prosesTambah')->name('barang.prosesTambah');
  Route::delete('/barang/hapus', 'BarangController@prosesHapus')->name('barang.prosesHapus');
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

// Modul Pengguna
Route::group(['middleware' => ['web', 'auth', 'role:admin,yayasan']], function() {
    Route::post('/barang/cetak', 'BarangController@cetak')->name('barang.cetak');
    Route::post('/inventaris/cetak', 'InventarisController@cetak')->name('inventaris.cetak');
    Route::post('/peminjaman/cetak', 'PeminjamanController@cetakTanggal')->name('peminjaman.cetak');
    Route::post('/pengadaan/cetak', 'PengadaanController@cetak')->name('pengadaan.cetak');
    Route::post('/pengadaan/cetakTanggal', 'PengadaanController@cetakTanggal')->name('pengadaan.cetakTanggal');
    Route::post('/maintenance/cetak', 'MaintenanceController@cetak')->name('maintenance.cetak');
    Route::post('/maintenance/cetakTanggal', 'MaintenanceController@cetakTanggal')->name('maintenance.cetakTanggal');
    Route::post('/request/cetakTanggal', 'RequestController@cetakTanggal')->name('request.cetak');
    Route::post('/pengguna/cetak', 'UsersController@cetak')->name('user.cetak');


    Route::get('/pengguna', 'UsersController@index')->name('user.index');
    Route::get('/pengguna/tambah/{role}', 'UsersController@tambah')->name('user.tambah');
    Route::get('/pengguna/{id}', 'UsersController@lihat')->name('user.lihat');
    Route::put('/pengguna/{id}', 'UsersController@prosesUbah')->name('user.prosesUbah');
    Route::get('/pengguna/{id}/edit', 'UsersController@ubah')->name('user.ubah');
    Route::post('/pengguna/prosesHapus', 'UsersController@prosesHapus')->name('user.prosesHapus');
    Route::post('/pengguna/prosesUbahPassword', 'UsersController@prosesUbahPassword')->name('user.resetPassword');
    Route::post('/pengguna/prosesTambah', 'UsersController@prosesTambah')->name('user.prosesTambah');
});



// Modul Peminjaman
Route::group(['middleware' => ['web', 'auth', 'role:dosen,mahasiswa']], function() {
  Route::get('/peminjaman/pinjam', 'PeminjamanController@pinjam')->name('peminjaman.pinjam');
  Route::post('/peminjaman/prosesPinjam', 'PeminjamanController@prosesPinjam')->name('peminjaman.prosesPinjam');
  Route::post('/peminjaman/prosesUbah', 'PeminjamanController@prosesUbah')->name('peminjaman.prosesUbah');
  Route::put('/peminjaman/{id}', 'PeminjamanController@prosesUbah')->name('peminjaman.prosesUbah');
  Route::get('/peminjaman/{id}/edit', 'PeminjamanController@ubah')->name('peminjaman.ubah');
  Route::get('/peminjaman/cetak/{id}', 'PeminjamanController@cetak')->name('peminjaman.cetak.user');
});

Route::group(['middleware' => ['web', 'auth', 'role:admin,staff_inventaris']], function() {
  Route::post('/peminjaman/konfirmasi', 'PeminjamanController@prosesKonfirmasi')->name('peminjaman.prosesKonfirmasi');
  Route::get('/pengadaan', 'PengadaanController@index')->name('pengadaan.index');
  Route::post('/pengadaan', 'PengadaanController@store')->name('pengadaan.store');
  Route::get('/pengadaan/create', 'PengadaanController@create')->name('pengadaan.create');
  Route::get('/pengadaan/cari', 'PengadaanController@loadData')->name('pengadaan.cari');
  Route::get('/pengadaan/getbarang', 'PengadaanController@getBarang')->name('pengadaan.getBarang');
  Route::get('/pengadaan/{id}', 'PengadaanController@show')->name('pengadaan.show');
  Route::get('/pengadaan/{id}/edit', 'PengadaanController@edit')->name('pengadaan.edit');
  Route::post('/pengadaan/{id}', 'PengadaanController@update')->name('pengadaan.update');


  Route::get('/maintenance', 'MaintenanceController@index')->name('maintenance.index');
  Route::get('/maintenance/create', 'MaintenanceController@create')->name('maintenance.create');
  Route::post('/maintenance', 'MaintenanceController@store')->name('maintenance.store');
  Route::post('/maintenance/{id}', 'MaintenanceController@update')->name('maintenance.update');
  Route::get('/maintenance/{id}', 'MaintenanceController@show')->name('maintenance.show');
  Route::get('/maintenance/{id}/edit', 'MaintenanceController@edit')->name('maintenance.edit');

});

Route::group(['middleware' => ['web', 'auth', 'role:admin,staff_inventaris,dosen,mahasiswa']], function() {
  Route::get('/peminjaman', 'PeminjamanController@index')->name('peminjaman.index');
  Route::get('/peminjaman/{id}', 'PeminjamanController@lihat')->name('peminjaman.lihat');
  Route::post('/peminjaman/prosesHapus', 'PeminjamanController@prosesHapus')->name('peminjaman.prosesHapus');
  Route::get('/peminjaman/download/surat_pengembalian/{id}', 'PeminjamanController@cetakSuratPengembalian')->name('peminjaman.cetaksuratpengembalian');
});

//Modul executive dashboard
Route::group(['middleware' => ['web', 'auth', 'role:yayasan']], function() {
  Route::get('/report', 'ReportController@index')->name('report.index');
  Route::get('/grafik', 'ReportController@grafik')->name('report.grafik');
});
// Modul request
Route::group(['middleware' => ['web', 'auth', 'role:dosen,admin,staff_inventaris']], function() {
  Route::get('/request', 'RequestController@index')->name('request.index');
  Route::post('/request', 'RequestController@prosesTambah')->name('request.prosesTambah');
  Route::get('/request/tambah', 'RequestController@tambah')->name('request.tambah');
  Route::get('/request/cetak/{id}', 'RequestController@cetak')->name('request.cetak.user');
  Route::get('/request/{id}/edit', 'RequestController@ubah')->name('request.ubah');
  Route::get('/request/{id}', 'RequestController@lihat')->name('request.lihat');
  Route::put('request/{id}', 'RequestController@prosesUbah')->name('request.prosesUbah');
  Route::post('/request/prosesHapus', 'RequestController@prosesHapus')->name('request.prosesHapus');
});
