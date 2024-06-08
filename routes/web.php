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
Route::get('/', [UtamaController::class, 'index']);
Route::get('/utama/macamDiklat/{kategori}', [UtamaController::class, 'allDiklat']);
Route::get('/utama/detailDiklat/{detail}', [UtamaController::class, 'detailDiklat']);
// db superAdmin
Route::get('/dbSuperAdmin', [DbUtamaController::class, 'index']);
Route::get('/allUser', [DbUtamaController::class, 'allUser']);
Route::get('/byLevel/{id}', [DbUtamaController::class, 'byLevel']);
// db keuangan
Route::get('/dbKeuangan', [DbUtamaController::class, 'dbKeuangan']);
Route::get('/dbDetailPembayaranDiklat', [DbUtamaController::class, 'detailpembayaranPembayaranDiklat']);
Route::get('/dbDetailPembayaranDaftar', [DbUtamaController::class, 'detailpembayaranPembayaranDaftar']);
Route::get('/pembayaranBelumVerifikasi', [DbUtamaController::class, 'pembayaranBelumVerifikasi']);
Route::get('/pembayaranSudahVerifikasi', [DbUtamaController::class, 'pembayaranSudahVerifikasi']);
// db DPUK
Route::get('/dbDpuk', [DbUtamaController::class, 'dbDpuk']);
Route::get('/PendaftaranTerlaksana', [DbUtamaController::class, 'PendaftaranTerlaksana']);
Route::get('/PendaftaranBelumTerlaksana', [DbUtamaController::class, 'PendaftaranBelumTerlaksana']);
Route::get('/perluSertifikat', [DbUtamaController::class, 'perluSertifikat']);
Route::get('/PendaftaranByDiklat/{id}', [DbUtamaController::class, 'PendaftaranByDiklat']);
Route::get('/riwayat', [RiwayatController::class, 'index'])->middleware('auth');
// Show Invoice
Route::get('/invoice/{detail}', [RiwayatController::class, 'invoiceDetail']);
Route::get('/detailRiwayat/{detail}', [RiwayatController::class, 'detailRiwayat'])->name('riwayat.detail');
// download invoice
Route::get('/invoicePdf/{id}', [RiwayatController::class, 'viewPdf']);
// route bukti pembayaran
Route::post('/bukti-pembayaran', [RiwayatController::class, 'buktiPembayaran'])->name('bukti-pembayaran.buktiPembayaran');



// route login registrasi
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/google/redirect', [LoginController::class, 'redirect']);
Route::get('/google/callback', [LoginController::class, 'callback'])->name('google.callback');


// route crud kategori dikklat
Route::resource('/kelKatDiklat', kelKatDiklatController::class)->except('show')->middleware('auth');
// route crud user  (register)
Route::get('/indexKelolaUser', [RegisterController::class, 'tampil']);
// biodata user
Route::get('/editProfil', [RegisterController::class, 'editProfil'])->middleware(['auth', 'verified']);;
Route::put('/updateProfil/{id}', [RegisterController::class, 'updateProfil'])->name('updateProfil.update');
// permohonan ubah biodata
Route::get('/permohonan/{id}', [RegisterController::class, 'editPermohonan']);
Route::put('/updatePermohonan/{id}', [RegisterController::class, 'updatePermohonan'])->name('updatePermohonan.update');
// alamat
Route::get('provinsi-dropdown', [ProvinsiController::class, 'showAll'])->name('provinsi.dropdown');
Route::get('kabupaten-dropdown/{id}', KabupatenDropdownController::class)->name('kabupaten.dropdown');
Route::get('kecamatan-dropdown/{id}', KecamatanDropdownController::class)->name('kecamatan.dropdown');
Route::get('kelurahan-dropdown/{id}', KelurahanDropdownController::class)->name('kelurahan.dropdown');
// // route crud user  (register)
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
Route::get('/password/edit', [UpdatePasswordController::class, 'edit'])->name('password.edit');
Route::put('/password/update', [UpdatePasswordController::class, 'update'])->name('password.update');
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
})->middleware('guest')->name('password.update');

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
// Route::get('/pendaftaranKeuanganIndex', [PendaftaranController::class, 'indexKeuangan']);
// Route::get('/pendaftaranKeuanganShow/{id}', [PendaftaranController::class, 'showKeuangan']);
Route::get('/kelPendaftaran/{id}/editAsAdmin', [PendaftaranController::class, 'editAsAdmin'])->name('pendaftaranAsAdmin.edit');
Route::put('/kelPendaftaranAdmin/{id}', [PendaftaranController::class, 'updateAsAdmin'])->name('pendaftaranAsAdmin.update');
Route::resource('/kelPendaftaran', PendaftaranController::class);
// route CRUD pendaftaran keuangan
Route::resource('/kelPendaftaranKeuangan', PendaftaranKeuanganController::class)->except('destroy','create', 'store' );

//route CRUD pembayarn
// Route::get('/kelPembayaran/getPaymentInfo/{type}/{id}', [PembayaranController::class, 'getPaymentInfo']);
Route::post('/kelPembayaranDiklat-store/{id}', [PembayaranController::class, 'storeDiklat'])->name('kelPembayaranDiklat-store/{id}.storeDiklat');
Route::post('/kelPembayaranDiklat-form', [PembayaranController::class, 'createDiklat'])->name('kelPembayaranDiklat-form.createDiklat');
Route::post('/kelPembayaranPendaftaran', [PembayaranController::class, 'savePendaftaran'])->name('kelPembayaranPendaftaran.savePendaftaran');
Route::post('/kelPembayaranDiklat', [PembayaranController::class, 'saveDiklat'])->name('kelPembayaranDiklat.saveDiklat');
// export laporan
Route::get('/laporanExport/{tgl_awal}', [PembayaranController::class, 'export']);
Route::get('/allLaporanExport', [PembayaranController::class, 'exportAll']);
Route::resource('/kelPembayaran', PembayaranController::class)->except('update');
Route::get('/filterPembayaran', [PembayaranController::class, 'filterPembayaran']);

// route pembayaran export A.K.A. Laporan
//route CRUD gambar diklat
Route::resource('/kelGambarDiklat', GambarDiklatController::class);
// route CRUD Kalender
Route::get('events/list', [EventController::class, 'listEvent'])->name('events.list');
Route::resource('events', EventController::class);

Route::resource('eventsUser', EventUserController::class);
// log activity
Route::get('/logActivity', [LogActivityController::class, 'index']);
// select kalender chart
// Route::get('/chart', [DpukPendaftarChart::class, 'showChart'])->name('showChart');