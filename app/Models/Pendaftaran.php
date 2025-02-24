<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Pendaftaran extends Model
{
    use HasFactory;
    use LogsActivity;


    protected $table = 'pendaftaran';
    public $timestamps = true;
    protected $guarded = [''];
    public function diklat()
    {
        return $this->belongsTo(Diklat::class, 'id_diklat');
    }
    public function testimoni()
    {
        return $this->hasMany(Testimoni::class, 'id_pendaftaran');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function promo()
    {
        return $this->belongsTo(Promos::class, 'id_promo');
    }
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_pendaftaran');
    }
    public static function countPendaftar()
    {
        return self::count();
    }
    public static function countPendaftaranAsDiklat()
    {
        return pendaftaran::join('diklat', 'pendaftaran.id_diklat', '=', 'diklat.id')
            ->select('diklat.nama_diklat', DB::raw('COUNT(*) as total_pendaftar'))
            ->groupBy('diklat.nama_diklat')
            ->get();
    }
    public static function getDiklat()
    {
        $userId = Auth::id();
        return pendaftaran::join('diklat', 'pendaftaran.id_diklat', '=', 'diklat.id')
            ->where('pendaftaran.id_user', $userId)
            ->select('diklat.*')
            ->get();
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Tabel pendaftaran')
            ->logUnguarded();
        // Chain fluent methods for configuration options
    }
}
