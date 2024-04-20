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

class UtamaController extends Controller
{
    public function index()
    {
        $jmlPendaftar = Pendaftaran::countPendaftar();
        $jmlDiklat = Diklat::countDiklat();
        $katDiklat = KatDiklat::selectAll();
        $testimonis = Testimoni::where('tampil', 'iya')->get();
        $gbrSlide = Gambar_navbar::where('status', 'tampilkan')->get();
        $promos = Promos::where(function($query) {
            $query->whereDate('tgl_akhir', '>=', now())
                  ->where('pakai_kuota', 'iya')
                  ->where('kuota', '>', 0);
        })
        ->orWhere(function($query) {
            $query->whereDate('tgl_akhir', '>=', now())
                  ->where('pakai_kuota', 'tidak');
        })
        ->get();
    
    
        return view('utama/landingPage', [
            'jmlPendaftar' => $jmlPendaftar,
            'jmlDiklat' => $jmlDiklat,
            'katDiklat' => $katDiklat,
            'testimonis' => $testimonis,
            'gbrSlide' => $gbrSlide,
            'promos'=>$promos

        ]);
    }
    public function allDiklat($kategori)
    {
        $diklat = Diklat::with('kategori')
            ->where('id_kategori_diklat', $kategori)
            ->get();

        return view('utama.macamDiklat', [
            'diklat' => $diklat
        ]);
    }

    public function detailDiklat($id)
    {
        $detailDiklat = Diklat::showAll($id);
        $gambars = GambarDiklat::where('id_diklat', $id)
            ->orWhereNull('id_diklat')
            ->orderByRaw('CASE WHEN id_diklat IS NULL THEN 0 ELSE 1 END, id_diklat ASC')
            ->get();


        // dd($gambars);
        return view('utama.detailDiklat', [
            'detailDiklat' => $detailDiklat,
            'gambars' => $gambars
        ]);
    }
}
