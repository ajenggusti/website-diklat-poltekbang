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

        $totalPendaftar = Pendaftaran::count();
        $jmlPendaftarBelumTerlaksana = Pendaftaran::where('status_pelaksanaan', 'Belum terlaksana')->count();
        $jmlDiklat = Diklat::all()->count();
        $katDiklat = KatDiklat::get();
        $alumni = Pendaftaran::where('status_pelaksanaan', 'Terlaksana')->count();
        // dd($user);
        $testimonis = Testimoni::where('tampil', 'iya')->get();
        $countTestimoni = Testimoni::where('tampil', 'iya')->get()->count();
        // dd($testimonis);
        $gbrSlide = Gambar_navbar::where('status', 'tampilkan')->get();
        $promos = Promos::where(function ($query) {
            $query->whereDate('tgl_akhir', '>=', now())
                ->where('pakai_kuota', 'iya')
                ->where('tampil', 'ya')
                ->where('kuota', '>', 0);
        })->orWhere(function ($query) {
            $query->whereDate('tgl_akhir', '>=', now())
                ->where('tampil', 'ya')
                ->where('pakai_kuota', 'tidak');
        })
            ->get();
        // $countPromo = count($promos);
        $countPromo = Promos::where(function ($query) {
            $query->whereDate('tgl_akhir', '>=', now())
                ->where('pakai_kuota', 'iya')
                ->where('tampil', 'ya')
                ->where('kuota', '>', 0);
        })
            ->orWhere(function ($query) {
                $query->whereDate('tgl_akhir', '>=', now())
                    ->where('tampil', 'ya')
                    ->where('pakai_kuota', 'tidak');
            })
            ->get()->count();
        // dd($countPromo);


        return view('utama/landingPage', [
            'jmlPendaftarBelumTerlaksana' => $jmlPendaftarBelumTerlaksana,
            'jmlDiklat' => $jmlDiklat,
            'katDiklat' => $katDiklat,
            'testimonis' => $testimonis,
            'gbrSlide' => $gbrSlide,
            'promos' => $promos,
            'alumni' => $alumni,
            'totalPendaftar' => $totalPendaftar,
            'countTestimoni' => $countTestimoni,
            'countPromo' => $countPromo,


        ]);
    }
    public function allDiklat($kategori)
    {
        $diklat = Diklat::with('kategori')
            ->where('id_kategori_diklat', $kategori)
            ->get();
        $diklatOne = KatDiklat::findOrFail($kategori);
        //    dd($diklatOne->kategori_diklat);
        $allDiklat = Diklat::get();

        return view('utama.macamDiklat', [
            'diklat' => $diklat,
            'allDiklat' => $allDiklat,
            'diklatOne' => $diklatOne,
        ]);
    }
    // dd($kategori);
    //     $diklat = Diklat::findOrFail($kategori);
    //     $allDiklat=Diklat::get();
    //     dd($diklat->kategori_diklat);
    //     return view('utama.macamDiklat', [
    //         'diklat' => $diklat,
    //         'allDiklat'=>$allDiklat
    //     ]);
    // }

    public function detailDiklat($id)
    {
        // JEJE
        // $detailDiklat = Diklat::showAll($id); 
        // dd($detailDiklat);
        // NEW C
        $detailDiklat = Diklat::findOrFail($id);
        // dd($detailDiklat);

        // if (!$detailDiklat) {
        //     return redirect('/')->with('error', 'Diklat not found');
        // }
        // END NEW C
        $gambars = GambarDiklat::where('id_diklat', $id)
            ->orWhereNull('id_diklat')
            ->orderByRaw('CASE WHEN id_diklat IS NULL THEN 0 ELSE 1 END, id_diklat ASC')
            ->get();
        $user = Auth::user();
        // dd($user);
        if (Auth::check()) {
            $dobelDiklat = Pendaftaran::where('id_user', $user->id)
                ->where('id_diklat', $id)
                ->exists();
        } else {
            $dobelDiklat = false;
        }

        // NEW C
        $id_kategori_diklat = $detailDiklat->id_kategori_diklat;
        $diklatOne = KatDiklat::findOrFail($id_kategori_diklat);

        return view('utama.detailDiklat', [
            'detailDiklat' => $detailDiklat,
            'gambars' => $gambars,
            'dobelDiklat' => $dobelDiklat,
            'diklatOne' => $diklatOne,  // NEW C
            'user' => $user
        ]);
    }
}
