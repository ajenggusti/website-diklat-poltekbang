<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\DbUtamaController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\GbrLandingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\GambarDiklatController;
use App\Http\Controllers\KelKatDiklatController;
use App\Http\Controllers\KabupatenDropdownController;
use App\Http\Controllers\KecamatanDropdownController;
use App\Http\Controllers\KelurahanDropdownController;

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

// route halaman utama
Route::get('/', [UtamaController::class, 'index']);
Route::get('/utama/macamDiklat/{kategori}', [UtamaController::class, 'allDiklat']);
Route::get('/utama/detailDiklat/{detail}', [UtamaController::class, 'detailDiklat']);
// dashboard admin
Route::get('/dbSuperAdmin', [DbUtamaController::class, 'index']);
Route::get('/dbDpuk', [DbUtamaController::class, 'dbDpuk']);
Route::get('/dbKeuangan', [DbUtamaController::class, 'dbKeuangan']);
Route::get('/dbDpukDetail/{id}', [DbUtamaController::class, 'dbDpukDetail']);

Route::get('/riwayat', [RiwayatController::class, 'index'])->middleware('auth');
Route::get('/riwayat/{detail}', [RiwayatController::class, 'detailRiwayat'])->middleware('auth')->name('riwayat.detail');
// route bukti pembayaran
Route::post('/bukti-pembayaran', [RiwayatController::class, 'buktiPembayaran'])->name('bukti-pembayaran.buktiPembayaran');


// route login registrasi
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// route crud kategori dikklat
Route::resource('/kelKatDiklat', kelKatDiklatController::class)->except('show')->middleware('auth');
// route crud user  (register)
Route::get('/indexKelolaUser', [RegisterController::class, 'tampil']);
// biodata user
Route::get('/editProfil', [RegisterController::class, 'editProfil']);
Route::put('/updateProfil/{id}', [RegisterController::class, 'updateProfil'])->name('updateProfil.update');
// permohonan ubah biodata
Route::get('/permohonan/{id}', [RegisterController::class, 'editPermohonan']);
Route::put('/updatePermohonan/{id}', [RegisterController::class, 'updatePermohonan'])->name('updatePermohonan.update');
// alamat
Route::get('provinsi-dropdown', [ProvinsiController::class, 'showAll'])->name('kabupaten.dropdown');
Route::get('kabupaten-dropdown/{id}', KabupatenDropdownController::class)->name('kabupaten.dropdown');
Route::get('kecamatan-dropdown/{id}', KecamatanDropdownController::class)->name('kecamatan.dropdown');
Route::get('kelurahan-dropdown/{id}', KelurahanDropdownController::class)->name('kelurahan.dropdown');
// // route crud user  (register)
Route::resource('/register', RegisterController::class)->except('create');
// route crud promo
Route::resource('/kelPromo', PromoController::class);
// route CRUD gbr LandingPage
Route::resource('/gbrLandingPage', GbrLandingController::class)->except('show');
// route CRUD Testimoni
Route::get('/testimoniAdmin', [TestimoniController::class, 'testimoniAdminCreate'])->name('testimoniAdmin.create');
Route::post('/testimoniAdmin-store', [TestimoniController::class, 'testimoniAdminStore'])->name('testimoniAdmin-store.store');
Route::resource('/kelTestimoni', TestimoniController::class);
// route CRUD Diklat
Route::resource('/kelDiklat', DiklatController::class);
// route CRUD pendaftaran
Route::get('/kelPendaftaran/{id}/editAsAdmin', [PendaftaranController::class, 'editAsAdmin'])->name('pendaftaranAsAdmin.edit');
Route::put('/kelPendaftaranAdmin/{id}', [PendaftaranController::class, 'updateAsAdmin'])->name('pendaftaranAsAdmin.update');
Route::resource('/kelPendaftaran', PendaftaranController::class);

//route CRUD pembayarn
// Route::get('/kelPembayaran/getPaymentInfo/{type}/{id}', [PembayaranController::class, 'getPaymentInfo']);
Route::post('/kelPembayaranDiklat-store/{id}', [PembayaranController::class, 'storeDiklat'])->name('kelPembayaranDiklat-store/{id}.storeDiklat');
Route::post('/kelPembayaranDiklat-form', [PembayaranController::class, 'createDiklat'])->name('kelPembayaranDiklat-form.createDiklat');
Route::post('/kelPembayaranPendaftaran', [PembayaranController::class, 'savePendaftaran'])->name('kelPembayaranPendaftaran.savePendaftaran');
Route::post('/kelPembayaranDiklat', [PembayaranController::class, 'saveDiklat'])->name('kelPembayaranDiklat.saveDiklat');

Route::resource('/kelPembayaran', PembayaranController::class)->except('update');
//route CRUD gambar diklat
Route::resource('/kelGambarDiklat', GambarDiklatController::class);
// route CRUD Kalender
Route::resource('/kelKalender', KalenderController::class);