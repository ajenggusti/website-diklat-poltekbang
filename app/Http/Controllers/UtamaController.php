<?php

namespace App\Http\Controllers;

use App\Models\KatDiklat;
use App\Models\Diklat;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Gambar_navbar;
use App\Models\GambarDiklat;
use App\Models\Testimoni;

class UtamaController extends Controller
{
    public function index()
    {
        $jmlPendaftar = Pendaftaran::countPendaftar();
        $jmlDiklat = Diklat::countDiklat();
        $katDiklat = KatDiklat::selectAll();
        $testimonis = Testimoni::where('tampil', 'iya')->get();
        $gbrSlide = Gambar_navbar::all();

        return view('utama/landingPage', [
            'jmlPendaftar' => $jmlPendaftar,
            'jmlDiklat' => $jmlDiklat,
            'katDiklat' => $katDiklat,
            'testimonis' => $testimonis,
            'gbrSlide'=>$gbrSlide
            
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
    
    public function detailDiklat($id){
        $detailDiklat = Diklat::showAll($id);
        $gambars = GambarDiklat::where('id_diklat', $id)
        ->orWhereNull('id_diklat')
        ->orderByRaw('CASE WHEN id_diklat IS NULL THEN 0 ELSE 1 END, id_diklat ASC')
        ->get();
    

        // dd($gambars);
        return view('utama.detailDiklat', [
            'detailDiklat' => $detailDiklat,
            'gambars'=>$gambars
        ]);
    }
}
