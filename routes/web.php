<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\FasilitasKesehatanController;
use App\Http\Controllers\JadwalDokterController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $menu = '';
    $title = '';
    return view('layouts.master',compact('menu', 'title'));
});

// Route::get('/login',function(){
//     $menu = '';
//     $title = '';
//     return view('apps.login.login',compact('menu','title'));
// });

Route::middleware(['auth','check.role:Admin'])->group(function(){
    Route::controller(KategoriController::class)->group(function(){
        Route::get('/data-kategori','awal');
        Route::get('/tambah-kategori','tambah_kategori');
        Route::post('/simpan-kategori','simpan_kategori');
        Route::get('/data-kategori/{kategori}/edit','edit_kategori');
        Route::post('/data-kategori/{kategori}/update','update_kategori');
        Route::get('/data-kategori/{kategori}/delete','delete_kategori');
        Route::get('/get-icon/{id}','get_icon');
    });

    Route::controller(FasilitasKesehatanController::class)->group(function(){
        Route::get('/data-fasilitas','awal');
        Route::get('/tambah-fasilitas','tambah_fasilitas');
        Route::post('/simpan-fasilitas','simpan_fasilitas');
        Route::get('/data-fasilitas/{fasilitas}/edit','edit_fasilitas');
        Route::post('/data-fasilitas/{fasilitas}/update','update_fasilitas');
        Route::get('/data-fasilitas/{fasilitas}/delete','delete_fasilitas');
    });

    Route::controller(DokterController::class)->group(function (){
        Route::get('/data-dokter','awal');
        Route::get('/tambah-dokter','tambah_dokter');
        Route::post('/simpan-dokter','simpan_dokter');
        Route::get('/data-dokter/{dokter}/edit','edit_dokter');
        Route::post('/data-dokter/{dokter}/update','update_dokter');
        Route::get('/data-dokter/{dokter}/delete','delete_dokter');
    });

    Route::controller(JadwalDokterController::class)->group(function(){
        Route::get('/data-jadwal','awal');
        Route::get('/tambah-jadwal','tambah_jadwal');
        Route::post('/simpan-jadwal','simpan_jadwal');
        Route::get('/data-jadwal/{jadwal}/edit','edit_jadwal');
        Route::post('/data-jadwal/{jadwal}/update','update_jadwal');
        Route::get('/data-jadwal/{jadwal}/delete','delete_jadwal');
        Route::get('/get-dokter/{id}','get_dokter');
    });

    Route::controller(LayananController::class)->group(function(){
        Route::get('/data-layanan','awal');
        Route::get('/tambah-layanan','tambah_layanan');
        Route::post('/simpan-layanan','simpan_layanan');
        Route::get('/data-layanan/{layanan}/edit','edit_layanan');
        Route::post('/data-layanan/{layanan}/update','update_layanan');
        Route::get('/data-layanan/{layanan}/delete','delete_layanan');
        Route::get('/get-fasilitas/{id}','get_fasilitas');
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/data-user','awal');
        Route::get('/data-user/{user}/edit','edit_user');
        Route::post('/data-user/{user}/update','update_user');
    });

});

Route::controller(DashboardController::class)->group(function(){
    Route::get('/dashboard','awal');
});

Route::controller(LokasiController::class)->group(function(){
    Route::get('/data-lokasi','awal');
});

Auth::routes();
