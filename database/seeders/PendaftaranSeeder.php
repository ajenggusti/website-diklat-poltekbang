<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        DB::table('pendaftaran')->insert([
            [
                'id_diklat' => 1,
                'id_user' => 1,
                'id_promo' => 1,
                'harga_diklat' => '90000',
                'status_pembayaran_diklat' => 'Menunggu pembayaran',
                'pendidikan_terakhir' => 'SMA',
                'no_hp' => '089-898-098-999',
                'status_pembayaran_daftar' => 'Menunggu pembayaran',
                'status_pelaksanaan'=>'Belum terlaksana'
            ],
            [
                'id_diklat' => 1,
                'id_user' => 2,
                'id_promo' => 1,
                'harga_diklat' => '90000',
                'status_pembayaran_diklat' => 'Menunggu pembayaran',
                'pendidikan_terakhir' => 'SMk',
                'no_hp' => '089-898-888-999',
                'status_pembayaran_daftar' => 'Menunggu pembayaran',
                'status_pelaksanaan'=>'Belum terlaksana'
            ],
                        
        ]);
    }
}