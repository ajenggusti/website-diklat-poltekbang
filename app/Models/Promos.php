<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promos extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'id_promo');
    }
    public function diklat()
    {
        return $this->belongsTo(Diklat::class, 'id_diklat');
    }
}
