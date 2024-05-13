<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\Promos;
use App\Models\KatDiklat;
use App\Models\Testimoni;
use App\Models\Pendaftaran;
use App\Models\GambarDiklat;
use Illuminate\Http\Request;
use App\Models\Gambar_navbar;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UtamaController extends Controller
{
    public function index()
    {
        // aku menambah ini cerr
        $totalPendaftar = Pendaftaran::count();
        $jmlPendaftarBelumTerlaksana = Pendaftaran::where('status_pelaksanaan', 'Belum terlaksana')->count();
        $jmlDiklat = Diklat::all()->count();
        $katDiklat = KatDiklat::get();
        $alumni = Pendaftaran::where('status_pelaksanaan', 'Terlaksana')->count();
        // dd($user);
        $testimonis = Testimoni::where('tampil', 'iya')->get();
        // dd($testimonis);
        $gbrSlide = Gambar_navbar::where('status', 'tampilkan')->get();
        $promos = Promos::where(function($query) {
            $query->whereDate('tgl_akhir', '>=', now())
                  ->where('pakai_kuota', 'iya')
                  ->where('tampil', 'ya')
                  ->where('kuota', '>', 0);
                //   cherr aku menambah ini
            })->orWhere(function($query) {
                $query->whereDate('tgl_akhir', '>=', now())
                        ->where('tampil', 'ya')
                    ->where('pakai_kuota', 'tidak');
            })
            ->get();
    
    
        return view('utama/landingPage', [
            'jmlPendaftarBelumTerlaksana' => $jmlPendaftarBelumTerlaksana,
            'jmlDiklat' => $jmlDiklat,
            'katDiklat' => $katDiklat,
            'testimonis' => $testimonis,
            'gbrSlide' => $gbrSlide,
            'promos'=>$promos,
            'alumni'=>$alumni,
            'totalPendaftar'=>$totalPendaftar,


        ]);
    }
    public function allDiklat($kategori)
    {
        $diklat = Diklat::with('kategori')
            ->where('id_kategori_diklat', $kategori)
            ->get();
        $allDiklat=Diklat::get();

        return view('utama.macamDiklat', [
            'diklat' => $diklat,
            'allDiklat'=>$allDiklat
        ]);
    }

    public function detailDiklat($id)
    {
        $detailDiklat = Diklat::showAll($id);
        $gambars = GambarDiklat::where('id_diklat', $id)
            ->orWhereNull('id_diklat')
            ->orderByRaw('CASE WHEN id_diklat IS NULL THEN 0 ELSE 1 END, id_diklat ASC')
            ->get();
        if(Auth::check()) {
            $user = Auth::user();
            $dobelDiklat = Pendaftaran::where('id_user', $user->id)
                ->where('id_diklat', $id)
                ->exists();
        } else {
            $dobelDiklat = false;
        }
        return view('utama.detailDiklat', [
            'detailDiklat' => $detailDiklat,
            'gambars' => $gambars,
            'dobelDiklat' => $dobelDiklat
        ]);
    }
    
}
