<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    use LogsActivity;
    
    protected $table = 'events';
    protected $guarded=[];
    public function diklat()
    {
        return $this->belongsTo(Diklat::class, 'id_diklat');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Tabel event kalender')
            ->logUnguarded();
        // Chain fluent methods for configuration options
    }
}
