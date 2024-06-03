<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
            'id_level' => 1,
            'name' => 'Adam Ashraf',
            'email' => 'Adam@gmail.com',
            'password' => Hash::make('123456'),
            'status'=>'Perlu dilengkapi',
            'jenis_berkas' => 'ktp',
            'id_provinsi'=> 3,
            'id_kabupaten'=>260,
            'id_kecamatan'=>2545,
            'id_kelurahan'=>54965,
            'tgl_lahir' => '2003-05-11',
            'nik'=>'53330299999889',
            'id_nationality'=>null,
            'no_paspor' => null,
            'tgl_exp_paspor' => null

        ], 
            [
            'id_level' => 1,
            'name' => 'Rendi Alkautsar',
            'email' => 'Rendi@gmail.com',
            'password' => Hash::make('123456'),
            'status'=>'Perlu dilengkapi',
            'jenis_berkas' => 'paspor',
            'id_provinsi'=> null,
            'id_kabupaten'=>null,
            'id_kecamatan'=>null,
            'id_kelurahan'=>null,
            'tgl_lahir' => null,
            'nik'=>null,
            'id_nationality'=>2,
            'no_paspor' => 'M09898',
            'tgl_exp_paspor' => '2024-05-11'
        ], 
        [
            'id_level' => 2,
            'name' => 'Super Admin',
            'email' => 'superAdmin@gmail.com',
            'password' => Hash::make('123456'),
            'status'=>'Perlu dilengkapi',
            'jenis_berkas' => 'ktp',
            'id_provinsi'=> 3,
            'id_kabupaten'=>260,
            'id_kecamatan'=>2545,
            'id_kelurahan'=>54965,
            'tgl_lahir' => '2003-05-11',
            'nik'=>'53330299999889',
            'id_nationality'=>null,
            'no_paspor' => null,
            'tgl_exp_paspor' => null
        ],
        [
            'id_level' => 3,
            'name' => 'DPUK',
            'email' => 'dpuk@gmail.com',
            'password' => Hash::make('123456'),
            'status'=>'Perlu dilengkapi',
            'jenis_berkas' => 'paspor',
            'id_provinsi'=> null,
            'id_kabupaten'=>null,
            'id_kecamatan'=>null,
            'id_kelurahan'=>null,
            'tgl_lahir' => null,
            'nik'=>null,
            'id_nationality'=>2,
            'no_paspor' => 'M09898',
            'tgl_exp_paspor' => '2024-05-11'
        ],
        [
            'id_level' => 4,
            'name' => 'Keuangan',
            'email' => 'keuangan@gmail.com',
            'password' => Hash::make('123456'),
            'status'=>'Perlu dilengkapi',
            'jenis_berkas' => 'ktp',
            'id_provinsi'=> 3,
            'id_kabupaten'=>260,
            'id_kecamatan'=>2545,
            'id_kelurahan'=>54965,
            'tgl_lahir' => '2003-05-11',
            'nik'=>'53330299999889',
            'id_nationality'=>null,
            'no_paspor' => null,
            'tgl_exp_paspor' => null
        ]]);
    }
}



