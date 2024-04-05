<?php

namespace App\Models;

use App\Models\KatDiklat;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diklat extends Model
{
    use HasFactory;

    protected $table = 'diklat';
    protected $guarded = [];
    public $timestamps = false;

    public function kategori()
    {
        return $this->belongsTo(KatDiklat::class, 'id_kategori_diklat', 'id');
    }
    public function promos()
    {
        return $this->hasMany(Promos::class, 'id_diklat');
    }
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'id_diklat');
    }
    public function updateStatus()
    {
        if ($this->jumlah_pendaftar >= $this->kuota_minimal) {
            $this->status = 'full';
            $this->save();
        }
    }
    public static function countDiklat()
    {
        // return self::count();
        return DB::table('diklat')->count();
    }
    public static function joinKatDiklat($kategori){
        return DB::table('diklat')
            ->join('kategori_diklat', 'diklat.id_kategori_diklat', '=', 'kategori_diklat.id')
            ->select('diklat.id', 'diklat.nama_diklat', 'kategori_diklat.*')
            ->where('kategori_diklat.id', $kategori)
            ->get();
    }    
    
    public static function showAll($id){
        return DB::table('diklat')
        ->where('id', $id)
        ->get();
    }
    public static function getKategori(){
        return DB::table('diklat')
        ->join('kategori_diklat', 'diklat.id_kategori_diklat', '=', 'kategori_diklat.id')
        ->select('diklat.*', 'kategori_diklat.kategori_diklat')
        ->get();
    }
    public static function getDiklatWithKategori($diklatId){
        return DB::table('diklat')
        ->join('kategori_diklat', 'diklat.id_kategori_diklat', '=', 'kategori_diklat.id')
        ->select('diklat.*', 'kategori_diklat.kategori_diklat')
        ->where('diklat.id', $diklatId)
        ->first();
    }
}
