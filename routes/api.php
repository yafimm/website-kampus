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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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

Route::group(['namespace' => 'api'], function() {
    Route::group(['prefix' => 'barang'], function(){
        Route::get('/', 'BarangController@index');
        Route::get('/{id}', 'BarangController@lihat');
    });
});
