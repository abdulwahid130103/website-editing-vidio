<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PlaylistController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VidioController;
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
    return view('Auth.login');
});


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class,"index"])->name('dashboard.index');
    Route::resource('/role',RoleController::class);
    Route::resource('/playlist',PlaylistController::class);
    Route::resource('/kategori',KategoriController::class);
    Route::resource('/user',UserController::class);
    Route::post('/user/password',[UserController::class,"ganti_password"])->name('user.password');
    Route::resource('/vidio',VidioController::class);
});