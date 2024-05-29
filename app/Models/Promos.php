<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Promos extends Model
{
    use HasFactory;
    use LogsActivity;

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
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Tabel pendaftaran')
            ->logUnguarded();
        // Chain fluent methods for configuration options
    }
}
