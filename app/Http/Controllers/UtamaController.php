<?php

namespace App\Http\Controllers;

use App\Models\KatDiklat;
use App\Models\Diklat;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Testimoni;

class UtamaController extends Controller
{
    public function index()
    {
        $jmlPendaftar = Pendaftaran::countPendaftar();
        $jmlDiklat = Diklat::countDiklat();
        $katDiklat = KatDiklat::selectAll();
        $testimonis = Testimoni::joinPendafataran();

        return view('utama/landingPage', [
            'jmlPendaftar' => $jmlPendaftar,
            'jmlDiklat' => $jmlDiklat,
            'katDiklat' => $katDiklat,
            'testimonis' => $testimonis,
            
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
        return view('utama.detailDiklat', ['detailDiklat' => $detailDiklat]);
    }
}
