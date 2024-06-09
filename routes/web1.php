<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\DbUtamaController;
use App\Http\Controllers\RiwayatController;
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

// Route halaman utama
Route::get('/', [UtamaController::class, 'index']);
Route::get('/utama/macamDiklat/{kategori}', [UtamaController::class, 'allDiklat']);
Route::get('/utama/detailDiklat/{detail}', [UtamaController::class, 'detailDiklat']);

// Route untuk db superAdmin
Route::prefix('dbSuperAdmin')->group(function () {
    Route::get('/', [DbUtamaController::class, 'index']);
    Route::get('/allUser', [DbUtamaController::class, 'allUser']);
    Route::get('/byLevel/{id}', [DbUtamaController::class, 'byLevel']);
});

// Route untuk db keuangan
Route::prefix('dbKeuangan')->group(function () {
    Route::get('/', [DbUtamaController::class, 'dbKeuangan']);
    Route::get('/detailPembayaranDiklat', [DbUtamaController::class, 'detailpembayaranPembayaranDiklat']);
    Route::get('/detailPembayaranDaftar', [DbUtamaController::class, 'detailpembayaranPembayaranDaftar']);
    Route::get('/pembayaranBelumVerifikasi', [DbUtamaController::class, 'pembayaranBelumVerifikasi']);
    Route::get('/pembayaranSudahVerifikasi', [DbUtamaController::class, 'pembayaranSudahVerifikasi']);
});

// Route untuk db DPUK
Route::prefix('dbDpuk')->group(function () {
    Route::get('/', [DbUtamaController::class, 'dbDpuk']);
    Route::get('/PendaftaranTerlaksana', [DbUtamaController::class, 'PendaftaranTerlaksana']);
    Route::get('/PendaftaranBelumTerlaksana', [DbUtamaController::class, 'PendaftaranBelumTerlaksana']);
    Route::get('/perluSertifikat', [DbUtamaController::class, 'perluSertifikat']);
    Route::get('/PendaftaranByDiklat/{id}', [DbUtamaController::class, 'PendaftaranByDiklat']);
});

Route::middleware('auth')->group(function () {
    // Route riwayat dan invoice
    Route::get('/riwayat', [RiwayatController::class, 'index']);
    Route::get('/invoice/{detail}', [RiwayatController::class, 'invoiceDetail']);
    Route::get('/detailRiwayat/{detail}', [RiwayatController::class, 'detailRiwayat'])->name('riwayat.detail');
    Route::get('/invoicePdf/{id}', [RiwayatController::class, 'viewPdf']);
    Route::post('/bukti-pembayaran', [RiwayatController::class, 'buktiPembayaran'])->name('bukti-pembayaran.buktiPembayaran');
    
    // Route CRUD kategori diklat
    Route::resource('/kelKatDiklat', KelKatDiklatController::class)->except('show');

    // Route CRUD user (register)
    Route::get('/indexKelolaUser', [RegisterController::class, 'tampil']);
    Route::get('/editProfil', [RegisterController::class, 'editProfil'])->middleware('verified');
    Route::put('/updateProfil/{id}', [RegisterController::class, 'updateProfil'])->name('updateProfil.update');
    Route::get('/permohonan/{id}', [RegisterController::class, 'editPermohonan']);
    Route::put('/updatePermohonan/{id}', [RegisterController::class, 'updatePermohonan'])->name('updatePermohonan.update');

    // Route CRUD pendaftaran keuangan
    Route::resource('/kelPendaftaranKeuangan', PendaftaranKeuanganController::class)->except('destroy','create', 'store');

    // Route CRUD pendaftaran
    Route::get('/kelPendaftaran/{id}/editAsAdmin', [PendaftaranController::class, 'editAsAdmin'])->name('pendaftaranAsAdmin.edit');
    Route::put('/kelPendaftaranAdmin/{id}', [PendaftaranController::class, 'updateAsAdmin'])->name('pendaftaranAsAdmin.update');
    Route::resource('/kelPendaftaran', PendaftaranController::class);

    // Route pembayaran
    Route::post('/kelPembayaranDiklat-store/{id}', [PembayaranController::class, 'storeDiklat'])->name('kelPembayaranDiklat-store/{id}.storeDiklat');
    Route::post('/kelPembayaranDiklat-form', [PembayaranController::class, 'createDiklat'])->name('kelPembayaranDiklat-form.createDiklat');
    Route::post('/kelPembayaranPendaftaran', [PembayaranController::class, 'savePendaftaran'])->name('kelPembayaranPendaftaran.savePendaftaran');
    Route::post('/kelPembayaranDiklat', [PembayaranController::class, 'saveDiklat'])->name('kelPembayaranDiklat.saveDiklat');
    Route::get('/laporanExport/{tgl_awal}', [PembayaranController::class, 'export']);
    Route::get('/allLaporanExport', [PembayaranController::class, 'exportAll']);
    Route::resource('/kelPembayaran', PembayaranController::class)->except('update');
    Route::get('/filterPembayaran', [PembayaranController::class, 'filterPembayaran']);

    // Log activity
    Route::get('/logActivity', [LogActivityController::class, 'index']);
});

// Route login registrasi
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/google/redirect', [LoginController::class, 'redirect']);
Route::get('/google/callback', [LoginController::class, 'callback'])->name('google.callback');

// Route register verifikasi email
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');
    
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/editProfil');
    })->middleware('signed')->name('verification.verify');
    
    // Ubah password
    Route::get('/password/edit', [UpdatePasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password/update', [UpdatePasswordController::class, 'update'])->name('password.update');
});

// Forget password
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    })->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

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
    })->name('password.update');
});

// Route alamat dropdown
Route::get('provinsi-dropdown', [ProvinsiController::class, 'showAll'])->name('provinsi.dropdown');
Route::get('kabupaten-dropdown/{id}', KabupatenDropdownController::class)->name('kabupaten.dropdown');
Route::get('kecamatan-dropdown/{id}', KecamatanDropdownController::class)->name('kecamatan.dropdown');
Route::get('kelurahan-dropdown/{id}', KelurahanDropdownController::class)->name('kelurahan.dropdown');

// Route CRUD promo
Route::resource('/kelPromo', PromoController::class);

// Route CRUD gambar landing page
Route::resource('/gbrLandingPage', GbrLandingController::class)->except('show');

// Route CRUD testimoni
Route::get('/testimoniAdmin', [TestimoniController::class, 'testimoniAdminCreate'])->name('testimoniAdmin.create');
Route::post('/testimoniAdmin-store', [TestimoniController::class, 'testimoniAdminStore'])->name('testimoniAdmin-store.store');
Route::resource('/kelTestimoni', TestimoniController::class);

// Route CRUD diklat
Route::resource('/kelDiklat', DiklatController::class);

// Route CRUD gambar diklat
Route::resource('/kelGambarDiklat', GambarDiklatController::class);

// Route CRUD kalender
Route::get('events/list', [EventController::class, 'listEvent'])->name('events.list');
Route::resource('events', EventController::class);
Route::resource('eventsUser', EventUserController::class);