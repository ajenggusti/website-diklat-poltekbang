<?php

namespace App\Models;

use App\Models\Diklat;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimoni extends Model
{
    use HasFactory;
    protected $table = 'testimoni';
    protected $guarded=[];
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
    }
    public function diklat()
    {
        return $this->belongsTo(Diklat::class, 'id_diklat');
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->tampil = 'tidak';
            $model->created_at = now();
        });
    }
 
}
