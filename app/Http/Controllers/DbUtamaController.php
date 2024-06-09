<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Charts\KeuanganChart;
use App\Charts\DpukPendaftarChart;
use App\Charts\SuperAdminChart;
use Illuminate\Support\Facades\DB;

class DbUtamaController extends Controller
{
    // kelola db super admin
    public function index(SuperAdminChart $SuperAdminChart)
    {
        // $this->authorize('superAdmin');
        $userCounts = User::groupBy('id_level')
            ->select('id_level', DB::raw('count(*) as total_user'))
            ->get();
        // dd($userCounts);
        $count = User::count();
        $statusCounts = User::groupBy('status')->select('status',DB::raw('count(*) as total_byStatus'))->get();
        // dd($statusCounts);
        return view('kelola.kelDbSuperAdmin.dbSuperAdmin', [
            'userCounts' => $userCounts,
            'count' => $count,
            'statusCounts'=>$statusCounts,
            'SuperAdminChart' => $SuperAdminChart->build(),
        ]);
    }
    public function byStatus($status)
    {
        $datas = User::where('status', $status)->get();
        return view('kelola.kelDbSuperAdmin.detailStatus', [
            'datas'=>$datas
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

    public function dbDpuk(Request $request, DpukPendaftarChart $DpukPendaftarChart)
    {
        $year = $request->input('year', date('Y'));

        $alumni = Pendaftaran::where('status_pelaksanaan', 'Terlaksana')->whereYear('updated_at', $year)->count();
        $jumlahBelumTerlaksana = Pendaftaran::where('status_pelaksanaan', 'Belum terlaksana')->whereYear('updated_at', $year)->count();
        $totalSemua = Pendaftaran::whereYear('updated_at', $year)->count();
        $sertifikat = Pendaftaran::where('status_pembayaran_diklat', 'Lunas')
            ->where('status_pembayaran_daftar', 'Lunas')
            ->where('status_pelaksanaan', 'Belum terlaksana')
            ->whereYear('updated_at', $year)
            ->count();
        $pendaftarans = Pendaftaran::whereYear('updated_at', $year)
            ->groupBy('id_diklat')
            ->select('id_diklat', DB::raw('count(*) as total_pendaftar'))
            ->get();
        // dd($totalSemua);
        return view('kelola.kelDbDpuk.dbDpuk', [
            'alumni' => $alumni,
            'jumlahBelumTerlaksana' => $jumlahBelumTerlaksana,
            'totalSemua' => $totalSemua,
            'pendaftarans' => $pendaftarans,
            'sertifikat' => $sertifikat,
            'DpukPendaftarChart' => $DpukPendaftarChart->build($year),
            'selectedYear' => $year
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
    public function dbKeuangan(Request $request, KeuanganChart $KeuanganChart)
    {
        $year = $request->input('year', date('Y'));
        $getBayarDiklat = Pembayaran::getCountBayarDiklat();
        $getBayarPendaftaran = Pembayaran::getCountBayarPendaftaran();
        $hitungPembayaranDiklatDicek = Pembayaran::hitungPembayaranDiklatDicek();
        $hitungPembayaranDiklatLunas = Pembayaran::hitungPembayaranDiklatLunas();

        return view('kelola.kelDbKeuangan.dbKeuangan', [
            'getBayarDiklat' => $getBayarDiklat,
            'getBayarPendaftaran' => $getBayarPendaftaran,
            'hitungPembayaranDiklatDicek' => $hitungPembayaranDiklatDicek,
            'hitungPembayaranDiklatLunas' => $hitungPembayaranDiklatLunas,
            'KeuanganChart' => $KeuanganChart->build($year),
            'selectedYear' => $year
        ]);
    }

    public function detailpembayaranPembayaranDiklat()
    {
        $pembayarans = Pembayaran::where('jenis_pembayaran', 'diklat')->where('status', 'Lunas')->get();
        return view('kelola.kelDbKeuangan.dbDetailPembayaran', [
            'pembayarans' => $pembayarans
        ]);
    }
    public function detailpembayaranPembayaranDaftar()
    {
        $pembayarans = Pembayaran::where('jenis_pembayaran', 'pendaftaran')->where('status', 'Lunas')->get();
        return view('kelola.kelDbKeuangan.dbDetailPembayaran', [
            'pembayarans' => $pembayarans
        ]);
    }
    public function pembayaranBelumVerifikasi()
    {
        $datas = Pendaftaran::where('status_pembayaran_diklat', 'Menunggu verifikasi')->get();
        return view('kelola.kelDbKeuangan.pendaftaranDetail', [
            'datas' => $datas
        ]);
    }
}