<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KatDiklat extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'kategori_diklat';
    protected $guarded = [];
    public $timestamps = false;
    public static function selectAll(){
        return self::all();
    }
    public function diklat()
    {
        return $this->hasMany(Diklat::class, 'id_kategori_diklat');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Tabel kategori diklat')
            ->logUnguarded();
        // Chain fluent methods for configuration options
    }
}
