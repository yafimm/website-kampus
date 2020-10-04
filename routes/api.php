<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//authentikasi user - V

Route::get('/dashboard', 'UsersController@dashboard')->name('api.dashboard');

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
->where('filename', '[A-Za-z0-9\-\_\.]+')->name('api.downloadsurat');


Route::post('/login', 'api\LoginController@login');

Route::group(['namespace' => 'Api', 'middleware' => ['auth:api', 'roleAPI:admin,staff_inventaris']], function() {
    Route::group(['prefix' => 'barang'], function(){
        Route::get('/', 'BarangController@index');
        Route::get('/{id}', 'BarangController@lihat');
        Route::post('/cetak', 'BarangController@cetak');
        Route::post('/', 'BarangController@prosesTambah');
        Route::delete('/hapus', 'BarangController@prosesHapus');
        Route::put('/{id}', 'BarangController@prosesUbah');
    });

    Route::group(['prefix' => 'inventaris'], function(){
        Route::get('/', 'InventarisController@index');
        Route::get('/{id}', 'InventarisController@lihat');
        Route::post('/cetak', 'InventarisController@cetak');
        Route::post('/', 'InventarisController@prosesTambah');
        Route::delete('/hapus', 'InventarisController@prosesHapus');
        Route::put('/{id}', 'InventarisController@prosesUbah');
    });

    Route::group(['prefix' => 'pengadaan'], function(){
        Route::get('/', 'PengadaanController@index');
        Route::get('/getnoregister', 'PengadaanController@getNoRegister');
        Route::get('/cari', 'PengadaanController@loadData');
        Route::get('/{id}', 'PengadaanController@show');
        Route::post('/cetak', 'PengadaanController@cetak');
        Route::post('/', 'PengadaanController@prosesTambah');
        Route::delete('/hapus', 'PengadaanController@prosesHapus');
        Route::put('/{id}', 'PengadaanController@prosesUbah');
    });

    Route::group(['prefix' => 'maintenance'], function(){
        Route::get('/', 'MaintenanceController@index');
        Route::get('/getnoregister', 'MaintenanceController@getNoRegister');
        Route::get('/cari', 'MaintenanceController@loadData');
        Route::get('/getbarang', 'MaintenanceController@getBarang');
        Route::get('/{id}', 'MaintenanceController@show');
        Route::post('/cetak', 'MaintenanceController@cetak');
        Route::post('/', 'MaintenanceController@store');
        Route::put('/{id}', 'MaintenanceController@update');
    });
});
