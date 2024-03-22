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
        DB::table('promo')->insert([
            [
            'potongan' => 20000,
            'kode' => 'kode1',
            'tgl_awal' => '2023-12-23',
            'tgl_akhir' => '2023-12-25',
            ],
            [
            'potongan' => 50000,
            'kode' => 'kode2',
            'tgl_awal' => '2024-01-01',
            'tgl_akhir' => '2024-03-01',
        ]]);
    }
}
