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
        return self::where('jenis_pembayaran', 'diklat')->where('status', 'Lunas')->count();
    }
    public static function getCountBayarPendaftaran(){
        return self::where('jenis_pembayaran', 'pendaftaran')->where('status', 'Lunas')->count();
    }

    public static function hitungPembayaranDiklatDicek()
    {
        return self::where('jenis_pembayaran', 'diklat')->where('status', 'Menunggu verifikasi')->count();
    }
    public static function hitungPembayaranDiklatLunas()
    {
        return self::where('jenis_pembayaran', 'diklat')->where('metode_pembayaran', 'offline')->where('status', 'Lunas')->count();
    }
    public static function hapusOtomatis(){
        $data = Pembayaran::all();
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Tabel pembayaran')
            ->logUnguarded();
    }


}
