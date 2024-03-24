<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DbUtamaController extends Controller
{
    public function index()
    {
        $this->authorize('superAdmin');
        $userCounts = User::countUserAsLevel();
        $count = User::count();
        return view('kelola.dbSuperAdmin', [
            'userCounts' => $userCounts,
            'count' => $count
        ]);
    }
    public function dbDpuk(){
        $this->authorize('dpuk');
        $jumlahPendaftar = Pendaftaran::countPendaftar();
        $diklatCounts = Pendaftaran::countPendaftaranAsDiklat();
        return view('kelola.dbDpuk', [
            'jumlahPendaftar'=>$jumlahPendaftar,
            'diklatCounts' =>$diklatCounts
        ]);
    }
    public function dbKeuangan(){
        $this->authorize('keuangan');
        $getBayarDiklat = Pembayaran::getCountBayarDiklat();
        $getBayarPendaftaran = Pembayaran::getCountBayarPendaftaran();
        $hitungPembayaranDiklatDicek = Pembayaran::hitungPembayaranDiklatDicek();
        $hitungPembayaranDiklatLunas = Pembayaran ::hitungPembayaranDiklatLunas();
        $hitungPembayaranPendaftaranDicek = Pembayaran::hitungPembayaranPendaftaranDicek();
        $hitungPembayaranPendaftaranLunas = Pembayaran::hitungPembayaranPendaftaranLunas();
        return view('kelola.dbKeuangan', [
            'getBayarDiklat'=>$getBayarDiklat,
            'getBayarPendaftaran'=>$getBayarPendaftaran,
            'hitungPembayaranDiklatDicek'=>$hitungPembayaranDiklatDicek,
            'hitungPembayaranDiklatLunas'=>$hitungPembayaranDiklatLunas,
            'hitungPembayaranPendaftaranDicek'=> $hitungPembayaranPendaftaranDicek,
            'hitungPembayaranPendaftaranLunas' => $hitungPembayaranPendaftaranLunas

        ]);
    }
}
