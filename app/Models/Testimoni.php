<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimoni extends Model
{
    use HasFactory;
    protected $table = 'testimoni';

    public static function joinPendafataran(){
        return DB::table('testimoni')
        ->join('pendaftaran', 'testimoni.id_pendaftaran', '=', 'pendaftaran.id')
        ->join('diklat', 'pendaftaran.id_diklat', '=', 'diklat.id')
        ->select('*')
        ->get();
    }
}
