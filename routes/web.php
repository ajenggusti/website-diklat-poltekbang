<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\DbUtamaController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\KelKatDiklatController;

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

// Route::get('/', function () {
//     return view('utama/landingPage');
// });

// route landing page
Route::get('/', [UtamaController::class, 'index']);
Route::get('/utama/macamDiklat/{kategori}', [UtamaController::class, 'allDiklat']);
Route::get('/utama/detailDiklat/{detail}', [UtamaController::class, 'detailDiklat']);
Route::get('/dbSuperAdmin', [DbUtamaController::class, 'index']);
Route::get('/dbDpuk', [DbUtamaController::class, 'dbDpuk']);
Route::get('/dbKeuangan', [DbUtamaController::class, 'dbKeuangan']);
Route::get('/riwayat', [RiwayatController::class, 'index'])->middleware('auth');

// route login registrasi
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// route crud kategori dikklat
Route::resource('/kelKatDiklat', kelKatDiklatController::class)->except('show')->middleware('auth');
// route crud user
Route::get('/indexKelolaUser', [RegisterController::class, 'tampil']);
Route::resource('/register', RegisterController::class)->except('show', 'create');
// route crud promo
Route::resource('/kelPromo', PromoController::class)->except('show');
