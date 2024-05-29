<?php

namespace App\Models;

use App\Models\Diklat;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Testimoni extends Model
{
    use HasFactory;
    use LogsActivity;

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
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Tabel testimoni')
            ->logUnguarded();
        // Chain fluent methods for configuration options
    }
 
}
