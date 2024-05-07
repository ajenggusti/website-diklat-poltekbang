<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Level;
use App\Models\Kelurahan;
use App\Models\Pendaftaran;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded=[];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $table = 'users';

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'id_user');
    }
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan');
    }
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten');
    }
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'id_nationality');
    }
    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level');
    }
    public static function countUserAsLevel(){
        return User::join('level', 'users.id_level', '=', 'level.id')
        ->select('level.level', DB::raw('COUNT(*) as total_users'))
        ->groupBy('level.level')
        ->get();
    }
    public static function getLevel(){
        return User::join('level', 'users.id_level', '=', 'level.id')
                ->select('users.*', 'level.level as userLevel')
                ->get();
    }


}
