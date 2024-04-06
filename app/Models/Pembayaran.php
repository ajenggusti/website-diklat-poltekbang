<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    public $timestamps = false;
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
}
