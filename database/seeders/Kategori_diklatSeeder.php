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
            'kategori_diklat' => 'diklat1'
        ], 
        [
            'kategori_diklat' => 'diklat2'
        ],
        [
            'kategori_diklat' => 'diklat3'
        ]]);
    }
}
