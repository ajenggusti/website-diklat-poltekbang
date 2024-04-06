<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Kategori_diklatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_diklat')->insert([
            [
            'kategori_diklat' => 'IATA COURSES'
        ], 
        [
            'kategori_diklat' => 'ICAO TRAINAIR PLUS COURSES'
        ],
        [
            'kategori_diklat' => 'INSTITUTIONAL COURSES'
        ]]);
    }
}
