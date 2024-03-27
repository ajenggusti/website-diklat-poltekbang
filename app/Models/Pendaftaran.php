<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
    public static function countPendaftaranAsDiklat()
    {
        return pendaftaran::join('diklat', 'pendaftaran.id_diklat', '=', 'diklat.id')
            ->select('diklat.nama_diklat', DB::raw('COUNT(*) as total_pendaftar'))
            ->groupBy('diklat.nama_diklat')
            ->get();
    }
    public static function getDiklat()
    {
        $userId = Auth::id();
        return pendaftaran::join('diklat', 'pendaftaran.id_diklat', '=', 'diklat.id')
            ->where('pendaftaran.id_user', $userId)
            ->select('diklat.*')
            ->get();
    }
    public static function getDiklatOne($id)
    {
        return Pendaftaran::join('diklat', 'pendaftaran.id_diklat', '=', 'diklat.id')
            ->join('promos', 'pendaftaran.id_promo', '=', 'promos.id')
            ->where('pendaftaran.id', $id)
            ->select('pendaftaran.*', 'diklat.*', 'promos.*')
            ->first();
    }
}
