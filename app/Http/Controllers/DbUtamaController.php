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
    public function dbDpuk()
    {
        $this->authorize('dpuk');
        $alumni = Pendaftaran::where('status_pelaksanaan', 'Terlaksana')->count();
        $jumlahBelumTerlaksana = Pendaftaran::where('status_pelaksanaan', 'Belum terlaksana')->count();
        $totalSemua = Pendaftaran::count();
        $pendaftarans = Pendaftaran::groupBy('id_diklat')
            ->select('id_diklat', DB::raw('count(*) as total_pendaftar'))
            ->get();
        return view('kelola.kelDbDpuk.dbDpuk', [
            'alumni' => $alumni,
            'jumlahBelumTerlaksana'=>$jumlahBelumTerlaksana,
            'totalSemua'=>$totalSemua,
            'pendaftarans' => $pendaftarans
        ]);
    }
    public function PendaftaranByDiklat($id)
    {
        $datas = Pendaftaran::where('id_diklat', $id)
                   ->where('status_pelaksanaan', 'Belum terlaksana')
                   ->get();
        // dd($datas);
        return view('kelola.kelDbDpuk.detailByIdDiklat', [
            'datas' => $datas
        ]);
    }
    public function PendaftaranBelumTerlaksana()
    {
        $datas = Pendaftaran::where('status_pelaksanaan', 'Belum terlaksana')->get();
        // dd($datas);
        return view('kelola.kelDbDpuk.detailByIdDiklat', [
            'datas' => $datas
        ]);
    }
    public function PendaftaranTerlaksana()
    {
        $datas = Pendaftaran::where('status_pelaksanaan', 'Terlaksana')->get();
        // dd($datas);
        return view('kelola.kelDbDpuk.detailByIdDiklat', [
            'datas' => $datas
        ]);
    }
    public function dbKeuangan()
    {
        $this->authorize('keuangan');
        $getBayarDiklat = Pembayaran::getCountBayarDiklat();
        $getBayarPendaftaran = Pembayaran::getCountBayarPendaftaran();
        $hitungPembayaranDiklatDicek = Pembayaran::hitungPembayaranDiklatDicek();
        $hitungPembayaranDiklatLunas = Pembayaran::hitungPembayaranDiklatLunas();
        $hitungPembayaranPendaftaranDicek = Pembayaran::hitungPembayaranPendaftaranDicek();
        $hitungPembayaranPendaftaranLunas = Pembayaran::hitungPembayaranPendaftaranLunas();
        return view('kelola.dbKeuangan', [
            'getBayarDiklat' => $getBayarDiklat,
            'getBayarPendaftaran' => $getBayarPendaftaran,
            'hitungPembayaranDiklatDicek' => $hitungPembayaranDiklatDicek,
            'hitungPembayaranDiklatLunas' => $hitungPembayaranDiklatLunas,
            'hitungPembayaranPendaftaranDicek' => $hitungPembayaranPendaftaranDicek,
            'hitungPembayaranPendaftaranLunas' => $hitungPembayaranPendaftaranLunas

        ]);
    }
}
