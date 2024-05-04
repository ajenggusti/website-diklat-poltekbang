<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelurahan extends Model
{
    use HasFactory;

    protected $table = 'kelurahans';
    protected $guarded = [];
    public $timestamps = false;

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
    public function user()
    {
        return $this->hasMany(User::class, 'id_kelurahan');
    }
    
}
