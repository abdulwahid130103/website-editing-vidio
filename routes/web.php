<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\VidioController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PlaylistController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Pengguna\DetailPlaylistPengguna;
use App\Http\Controllers\Pengguna\DetailVidioPengguna;
use App\Http\Controllers\Pengguna\HomeController;
use App\Http\Controllers\Pengguna\VidioPenggunaController;

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

Route::get('/', [HomeController::class,"index"])->name('home.index');
Route::prefix('pengguna')->name("pengguna")->group(function () {
    Route::get('/vidio', [VidioPenggunaController::class,"index"])->name('vidio.index');
    Route::get('/detailPlaylist/{id}',[DetailPlaylistPengguna::class,'index']);
    Route::get('/detailVidio/{id}',[DetailVidioPengguna::class,"index"]);
    Route::get('/get_rating_komen/{id}',[DetailVidioPengguna::class,"get_rating_komen"])->name('get_rating_komen');
    Route::post('/store_comment',[DetailVidioPengguna::class,"store_comment"])->name('store_comment');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/login','index')->name('login');
    Route::post('/login','authenticate')->name('authenticate');
    Route::get('/logout','logout')->name('logout');
});

Route::middleware(['auth','cekJabatan:admin'])->prefix('admin')->group(function () {
    Route::resource('/user',UserController::class);
    Route::resource('/role',RoleController::class);
    Route::get('/dashboard', [DashboardController::class,"index"])->name('dashboard.index');
    Route::resource('/playlist',PlaylistController::class);
    Route::resource('/profile',ProfileController::class);
    Route::resource('/kategori',KategoriController::class);
    Route::post('/user/password',[UserController::class,"ganti_password"])->name('user.password');
    Route::post('/profile/password',[ProfileController::class,"ganti_password"])->name('profile.password');
    Route::resource('/vidio',VidioController::class);
});
