<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Charts\DpukPendaftarChart;
use Illuminate\Support\Facades\DB;

class DbUtamaController extends Controller
{
    // kelola db super admin
    public function index()
    {
        $this->authorize('superAdmin');
        $userCounts = User::groupBy('id_level')
            ->select('id_level', DB::raw('count(*) as total_user'))
            ->get();
        // dd($userCounts);
        $count = User::count();
        return view('kelola.kelDbSuperAdmin.dbSuperAdmin', [
            'userCounts' => $userCounts,
            'count' => $count
        ]);
    }

    public function allUser()
    {
        $judul = "Semua User";
        $datas = User::all();
        return view('kelola.kelDbSuperAdmin.detailLevel', [
            'datas' => $datas,
            'judul' => $judul
        ]);
    }
    public function byLevel($id)
    {
        $datas = User::where('id_level', $id)->get();
        $judul1 = Level::findOrFail($id);
        $judul = $judul1->level;
        // dd($datas);
        return view('kelola.kelDbSuperAdmin.detailLevel', [
            'datas' => $datas,
            'judul' => $judul

        ]);
    }
    // kelola dpuk
    public function dbDpuk(DpukPendaftarChart $DpukPendaftarChart)
    {
        $this->authorize('dpuk');
        $alumni = Pendaftaran::where('status_pelaksanaan', 'Terlaksana')->count();
        $jumlahBelumTerlaksana = Pendaftaran::where('status_pelaksanaan', 'Belum terlaksana')->count();
        $totalSemua = Pendaftaran::count();
        $sertifikat = Pendaftaran::where('status_pembayaran_diklat', 'Lunas')
            ->where('status_pembayaran_daftar', 'Lunas')
            ->where('status_pelaksanaan', 'Belum terlaksana')
            ->count();
        $pendaftarans = Pendaftaran::groupBy('id_diklat')
            ->select('id_diklat', DB::raw('count(*) as total_pendaftar'))
            ->get();
        return view('kelola.kelDbDpuk.dbDpuk', [
            'alumni' => $alumni,
            'jumlahBelumTerlaksana' => $jumlahBelumTerlaksana,
            'totalSemua' => $totalSemua,
            'pendaftarans' => $pendaftarans,
            'sertifikat' => $sertifikat,
            'DpukPendaftarChart' => $DpukPendaftarChart->build()
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
    public function perluSertifikat()
    {
        $datas = Pendaftaran::where('status_pembayaran_diklat', 'Lunas')
            ->where('status_pembayaran_daftar', 'Lunas')
            ->where('status_pelaksanaan', 'Belum terlaksana')
            ->get();

        return view('kelola.kelDbDpuk.detailByIdDiklat', [
            'datas' => $datas
        ]);
    }
    // kelola keuangan
    public function dbKeuangan()
    {
        $this->authorize('keuangan');
        $getBayarDiklat = Pembayaran::getCountBayarDiklat();
        $getBayarPendaftaran = Pembayaran::getCountBayarPendaftaran();
        $hitungPembayaranDiklatDicek = Pembayaran::hitungPembayaranDiklatDicek();
        $hitungPembayaranDiklatLunas = Pembayaran::hitungPembayaranDiklatLunas();
        return view('kelola.kelDbKeuangan.dbKeuangan', [
            'getBayarDiklat' => $getBayarDiklat,
            'getBayarPendaftaran' => $getBayarPendaftaran,
            'hitungPembayaranDiklatDicek' => $hitungPembayaranDiklatDicek,
            'hitungPembayaranDiklatLunas' => $hitungPembayaranDiklatLunas,

        ]);
    }
    public function detailpembayaranPembayaranDiklat()
    {
        $pembayarans=Pembayaran::where('jenis_pembayaran', 'diklat')->where('status', 'Lunas')->get();
        return view('kelola.kelDbKeuangan.dbDetailPembayaran', [
            'pembayarans'=>$pembayarans
        ]);
    }
    public function detailpembayaranPembayaranDaftar()
    {
        $pembayarans=Pembayaran::where('jenis_pembayaran', 'pendaftaran')->where('status', 'Lunas')->get();
        return view('kelola.kelDbKeuangan.dbDetailPembayaran', [
            'pembayarans'=>$pembayarans
        ]);
    }
    public function pembayaranBelumVerifikasi()
    {
        $datas=Pendaftaran::where('status_pembayaran_diklat', 'Menunggu verifikasi')->get();
        return view('kelola.kelDbKeuangan.pendaftaranDetail', [
            'datas'=>$datas
        ]);
    }
}
