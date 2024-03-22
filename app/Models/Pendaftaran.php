<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    public static function countPendaftar()
    {
        return self::count();
    }
    public static function countPendaftaranAsDiklat(){
        return pendaftaran::join('diklat', 'pendaftaran.id_diklat', '=', 'diklat.id')
        ->select('diklat.nama_diklat', DB::raw('COUNT(*) as total_pendaftar'))
        ->groupBy('diklat.nama_diklat')
        ->get();
    }
}
