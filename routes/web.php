<?php

use App\Models\Pendaftaran;
use App\Charts\DpukPendaftarChart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
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
use App\Http\Controllers\EventUserController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\GbrLandingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\GambarDiklatController;
use App\Http\Controllers\KelKatDiklatController;
use App\Http\Controllers\KabupatenDropdownController;
use App\Http\Controllers\KecamatanDropdownController;
use App\Http\Controllers\KelurahanDropdownController;
use App\Http\Controllers\PendaftaranKeuanganController;
use App\Http\Controllers\UpdatePasswordController;
use App\Http\Middleware\DpukMiddleware;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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

    Route::get('/', [UtamaController::class, 'index'])->name('home');
    Route::get('/utama/macamDiklat/{kategori}', [UtamaController::class, 'allDiklat']);
    Route::get('/utama/detailDiklat/{detail}', [UtamaController::class, 'detailDiklat']);

// db superAdmin
Route::get('/dbSuperAdmin', [DbUtamaController::class, 'index'])->middleware(['auth', 'verified']); //Userpolicy
Route::get('/allUser', [DbUtamaController::class, 'allUser'])->middleware(['auth', 'verified']); //userpolicy
Route::get('/byLevel/{id}', [DbUtamaController::class, 'byLevel'])->middleware(['auth', 'verified']); //userpolicy
Route::get('/byStatus/{status}', [DbUtamaController::class, 'byStatus'])->middleware(['auth', 'verified']); //userpolicy
// db keuangan
Route::get('/dbKeuangan', [DbUtamaController::class, 'dbKeuangan'])->middleware(['auth', 'verified']); //userpolicy
Route::get('/dbDetailPembayaranDiklat', [DbUtamaController::class, 'detailpembayaranPembayaranDiklat'])->middleware(['auth', 'verified']); //userpolicy
Route::get('/dbDetailPembayaranDaftar', [DbUtamaController::class, 'detailpembayaranPembayaranDaftar'])->middleware(['auth', 'verified']); //userpolicy
Route::get('/pembayaranBelumVerifikasi', [DbUtamaController::class, 'pembayaranBelumVerifikasi'])->middleware(['auth', 'verified']); //userpolicy
// db DPUK
Route::get('/dbDpuk', [DbUtamaController::class, 'dbDpuk'])->middleware(['auth', 'verified']); //userpolicy
Route::get('/PendaftaranTerlaksana', [DbUtamaController::class, 'PendaftaranTerlaksana'])->middleware(['auth', 'verified']); //userpolicy
Route::get('/PendaftaranBelumTerlaksana', [DbUtamaController::class, 'PendaftaranBelumTerlaksana'])->middleware(['auth', 'verified']); //userpolicy
Route::get('/perluSertifikat', [DbUtamaController::class, 'perluSertifikat'])->middleware(['auth', 'verified']); //userpolicy
Route::get('/PendaftaranByDiklat/{id}', [DbUtamaController::class, 'PendaftaranByDiklat'])->middleware(['auth', 'verified']); //userpolicy
Route::get('/riwayat', [RiwayatController::class, 'index'])->middleware(['auth', 'verified']); //policy
// Show Invoice
Route::get('/invoice/{detail}', [RiwayatController::class, 'invoiceDetail'])->middleware(['auth', 'verified']); //policy
Route::get('/detailRiwayat/{detail}', [RiwayatController::class, 'detailRiwayat'])->name('riwayat.detail')->middleware(['auth', 'verified']); //policy
// download invoice
Route::get('/invoicePdf/{id}', [RiwayatController::class, 'viewPdf'])->middleware(['auth', 'verified']); //policy
// route bukti pembayaran
Route::post('/bukti-pembayaran', [RiwayatController::class, 'buktiPembayaran'])->name('bukti-pembayaran.buktiPembayaran')->middleware(['auth', 'verified']);

// route login registrasi
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/google/redirect', [LoginController::class, 'redirect']);
Route::get('/google/callback', [LoginController::class, 'callback'])->name('google.callback')->middleware('guest');

// route crud kategori dikklat
Route::resource('/kelKatDiklat', kelKatDiklatController::class)->except('show')->middleware(['auth', 'verified']); //KatDiklatPolicy
// route crud user  (register)
Route::get('/indexKelolaUser', [RegisterController::class, 'tampil'])->middleware(['auth', 'verified']); //userPolicy
// biodata user
Route::get('/editProfil', [RegisterController::class, 'editProfil'])->middleware(['auth', 'verified']);
Route::put('/updateProfil/{id}', [RegisterController::class, 'updateProfil'])->name('updateProfil.update')->middleware(['auth', 'verified']);
// permohonan ubah biodata
Route::get('/permohonan/{id}', [RegisterController::class, 'editPermohonan'])->middleware(['auth', 'verified']);
Route::put('/updatePermohonan/{id}', [RegisterController::class, 'updatePermohonan'])->name('updatePermohonan.update')->middleware(['auth', 'verified']);
// alamat
Route::get('provinsi-dropdown', [ProvinsiController::class, 'showAll'])->name('provinsi.dropdown')->middleware(['auth', 'verified']);
Route::get('kabupaten-dropdown/{id}', KabupatenDropdownController::class)->name('kabupaten.dropdown')->middleware(['auth', 'verified']);
Route::get('kecamatan-dropdown/{id}', KecamatanDropdownController::class)->name('kecamatan.dropdown')->middleware(['auth', 'verified']);
Route::get('kelurahan-dropdown/{id}', KelurahanDropdownController::class)->name('kelurahan.dropdown')->middleware(['auth', 'verified']);
// route crud user  (register)
Route::resource('/register', RegisterController::class)->except('create');
// register verifikasi email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/editProfil');
})->middleware(['auth', 'signed'])->name('verification.verify');

// ubah password
Route::get('/password/edit', [UpdatePasswordController::class, 'edit'])->name('password.edit')->middleware(['auth', 'verified']);
Route::put('/password/update', [UpdatePasswordController::class, 'update'])->name('password.update')->middleware(['auth', 'verified']);
// forget password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink(
        $request->only('email')
    );
    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        }
    );
    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update.post');

// route crud promo
Route::resource('/kelPromo', PromoController::class)->middleware(['auth', 'verified']); //promoPolicy
// route CRUD gbr LandingPage
Route::resource('/gbrLandingPage', GbrLandingController::class)->except('show')->middleware(['auth', 'verified']);
// route CRUD Testimoni
Route::get('/testimoniAdmin', [TestimoniController::class, 'testimoniAdminCreate'])->name('testimoniAdmin.create')->middleware(['auth', 'verified']);
Route::post('/testimoniAdmin-store', [TestimoniController::class, 'testimoniAdminStore'])->name('testimoniAdmin-store.store')->middleware(['auth', 'verified']);
Route::resource('/kelTestimoni', TestimoniController::class)->middleware(['auth', 'verified']);
// route CRUD Diklat
Route::resource('/kelDiklat', DiklatController::class)->middleware(['auth', 'verified']);
// route CRUD pendaftaran
Route::get('/kelPendaftaran/{id}/editAsAdmin', [PendaftaranController::class, 'editAsAdmin'])->name('pendaftaranAsAdmin.edit')->middleware(['auth', 'verified']);
Route::put('/kelPendaftaranAdmin/{id}', [PendaftaranController::class, 'updateAsAdmin'])->name('pendaftaranAsAdmin.update')->middleware(['auth', 'verified']);
Route::resource('/kelPendaftaran', PendaftaranController::class)->middleware(['auth', 'verified']);
// route CRUD pendaftaran keuangan
Route::resource('/kelPendaftaranKeuangan', PendaftaranKeuanganController::class)->except('destroy', 'create', 'store')->middleware(['auth', 'verified']);

//route CRUD pembayaran
Route::post('/kelPembayaranDiklat-store/{id}', [PembayaranController::class, 'storeDiklat'])->name('kelPembayaranDiklat-store/{id}.storeDiklat')->middleware(['auth', 'verified']);
Route::post('/kelPembayaranDiklat-form', [PembayaranController::class, 'createDiklat'])->name('kelPembayaranDiklat-form.createDiklat')->middleware(['auth', 'verified']);
Route::post('/kelPembayaranPendaftaran', [PembayaranController::class, 'savePendaftaran'])->name('kelPembayaranPendaftaran.savePendaftaran')->middleware(['auth', 'verified']);
Route::post('/kelPembayaranDiklat', [PembayaranController::class, 'saveDiklat'])->name('kelPembayaranDiklat.saveDiklat')->middleware(['auth', 'verified']);
// export laporan
Route::get('/laporanExport/{tgl_awal}', [PembayaranController::class, 'export'])->middleware(['auth', 'verified']);
Route::get('/allLaporanExport', [PembayaranController::class, 'exportAll'])->middleware(['auth', 'verified']);

Route::resource('/kelPembayaran', PembayaranController::class)->except('update')->middleware(['auth', 'verified']);
Route::get('/filterPembayaran', [PembayaranController::class, 'filterPembayaran'])->middleware(['auth', 'verified']);

// route pembayaran export A.K.A. Laporan
//route CRUD gambar diklat
Route::resource('/kelGambarDiklat', GambarDiklatController::class)->middleware(['auth', 'verified']);
// route CRUD Kalender
Route::get('events/list', [EventController::class, 'listEvent'])->name('events.list');
// view kalender admin crud
Route::resource('events', EventController::class)->middleware(['auth', 'verified']);
//view kalender user tidak pakai crud
Route::resource('eventsUser', EventUserController::class)->only('index');
// log activity
Route::get('/logActivity', [LogActivityController::class, 'index'])->middleware(['auth', 'verified']);
// select kalender chart
