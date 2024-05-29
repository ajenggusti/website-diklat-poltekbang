<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Pembayaran extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'pembayaran';
    protected $guarded = [];
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
    }
    public static function getCountBayarDiklat(){
        return self::where('jenis_pembayaran', 'diklat')->count();
    }
    public static function getCountBayarPendaftaran(){
        return self::where('jenis_pembayaran', 'pendaftaran')->count();
    }

    public static function hitungPembayaranDiklatDicek()
    {
        return DB::table('pembayaran')
            ->join('pendaftaran', 'pembayaran.id_pendaftaran', '=', 'pendaftaran.id')
            ->where('pembayaran.jenis_pembayaran', 'diklat')
            ->where('pendaftaran.status_pembayaran_diklat', 'Dicek')
            ->count();
    }
    public static function hitungPembayaranDiklatLunas()
    {
        return DB::table('pembayaran')
            ->join('pendaftaran', 'pembayaran.id_pendaftaran', '=', 'pendaftaran.id')
            ->where('pembayaran.jenis_pembayaran', 'diklat')
            ->where('pendaftaran.status_pembayaran_diklat', 'Lunas')
            ->count();
    }
    public static function hitungPembayaranPendaftaranDicek()
    {
        return DB::table('pembayaran')
            ->join('pendaftaran', 'pembayaran.id_pendaftaran', '=', 'pendaftaran.id')
            ->where('pembayaran.jenis_pembayaran', 'pendaftaran')
            ->where('pendaftaran.status_pembayaran_daftar', 'Dicek')
            ->count();
    }
    public static function hitungPembayaranPendaftaranLunas()
    {
        return DB::table('pembayaran')
            ->join('pendaftaran', 'pembayaran.id_pendaftaran', '=', 'pendaftaran.id')
            ->where('pembayaran.jenis_pembayaran', 'pendaftaran')
            ->where('pendaftaran.status_pembayaran_daftar', 'Lunas')
            ->count();
    }
    public static function hapusOtomatis(){
        $data = Pembayaran::all();
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Tabel pembayaran')
            ->logUnguarded();
        // Chain fluent methods for configuration options
    }
}
