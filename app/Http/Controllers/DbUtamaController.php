<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DbUtamaController extends Controller
{
    public function index()
    {
        $userCounts = User::countUserAsLevel();
        $count = User::count();
        return view('kelola.dbSuperAdmin', [
            'userCounts' => $userCounts,
            'count' => $count
        ]);
    }
    public function dbDpuk(){
        $jumlahPendaftar = Pendaftaran::countPendaftar();
        $diklatCounts = Pendaftaran::countPendaftaranAsDiklat();
        return view('kelola.dbDpuk', [
            'jumlahPendaftar'=>$jumlahPendaftar,
            'diklatCounts' =>$diklatCounts
        ]);
    }
    public function dbKeuangan(){
        return view('kelola.dbKeuangan');
    }
}
