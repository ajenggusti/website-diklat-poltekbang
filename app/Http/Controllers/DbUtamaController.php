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
        // $jumlahPendaftar = Pendaftaran::countPendaftar();
        $jumlahPendaftar = Pendaftaran::all()->count();
        // $diklatCounts = Pendaftaran::countPendaftaranAsDiklat();
        $pendaftarans = Pendaftaran::groupBy('id_diklat')
        ->select('id_diklat', DB::raw('count(*) as total_pendaftar'))
        ->get();
        return view('kelola.kelDbDpuk.dbDpuk', [
            'jumlahPendaftar'=>$jumlahPendaftar,
            'pendaftarans' =>$pendaftarans
        ]);
    }
    public function dbDpukDetail($id){
        $datas = Pendaftaran::where('id_diklat', $id)->get();
        // dd($datas);
        return view('kelola.kelDbDpuk.detailByIdDiklat', [
            'datas'=>$datas
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
