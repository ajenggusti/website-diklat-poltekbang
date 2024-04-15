<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        DB::table('promos')->insert([
            [
                'id_diklat' => 1,
                'gambar' => '', // Tambahkan nilai gambar jika ada
                'potongan' => 20000,
                'kode' => 'kode1',
                'tgl_awal' => '2023-12-23',
                'tgl_akhir' => '2023-12-25',
                'kuota' => '2',
                'pakai_kuota' => true,
            ]
        ]);
    }
}
