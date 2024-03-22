<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diklat extends Model
{
    use HasFactory;

    protected $table = 'diklat';

    public static function countDiklat()
    {
        // return self::count();
        return DB::table('diklat')->count();
    }
    public static function joinKatDiklat($kategori){
        return DB::table('diklat')
                ->join('kategori_diklat', 'diklat.id_kategori_diklat', '=', 'kategori_diklat.id')
                ->select('diklat.*')
                ->where('kategori_diklat.id', $kategori)
                ->get();
    }
    public static function showAll($id){
        return DB::table('diklat')
        ->where('id', $id)
        ->get();
    }
}
