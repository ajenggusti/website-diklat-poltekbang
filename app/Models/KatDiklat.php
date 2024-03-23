<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KatDiklat extends Model
{
    use HasFactory;
    protected $table = 'kategori_diklat';
    protected $guarded = [];
    public $timestamps = false;
    public static function selectAll(){
        return self::all();
    }
}
