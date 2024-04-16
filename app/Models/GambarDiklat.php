<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarDiklat extends Model
{
    use HasFactory;
    protected $table = 'gambar_diklat';
    protected $guarded = [];
    public $timestamps = false;
    public function diklat()
    {
        return $this->belongsTo(Diklat::class, 'id_diklat');
    }
    
}
