<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GambarDiklat extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'gambar_diklat';
    protected $guarded = [];
    public $timestamps = false;
    public function diklat()
    {
        return $this->belongsTo(Diklat::class, 'id_diklat');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Tabel gambar diklat')
            ->logUnguarded();
        // Chain fluent methods for configuration options
    }
    
}
