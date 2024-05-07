<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;
    protected $table = 'nationalities';
    protected $guarded = [];
    public $timestamps = false;
    
    public function user()
    {
        return $this->hasMany(User::class, 'id_nationality');
    }
}




