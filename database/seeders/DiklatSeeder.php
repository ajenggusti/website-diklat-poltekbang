<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiklatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        DB::table('diklat')->insert([
            [
            'id_kategori_diklat' => 1,
            'nama_diklat' => 'Airfield Lighting System (ALS) - Initial Expert Level',
            'harga' => 5598000,
            'kuota_minimal' => 5,
            'jumlah_pendaftar' => 0,
            'status' => 'belum full',
            'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum hic ullam, fugiat molestias porro, autem    mollitia ipsum magni nostrum quas quaerat omnis vel officiis eos nam facere facilis odio minus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum itaque perspiciatis ducimus temporibus facere facilis nihil quia fugiat possimus illo.',
            
            'gambar' => 'blob gambar belum',
        ], 
            [
            'id_kategori_diklat' => 1,
            'nama_diklat' => 'Specified Skilled Worker',
            'harga' => 49900000,
            'kuota_minimal' => 5,
            'jumlah_pendaftar' => 0,
            'status' => 'belum full',
            'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum hic ullam, fugiat molestias porro, autem    mollitia ipsum magni nostrum quas quaerat omnis vel officiis eos nam facere facilis odio minus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum itaque perspiciatis ducimus temporibus facere facilis nihil quia fugiat possimus illo.',
            
            'gambar' => 'blob gambar belum',
        ], 
            [
            'id_kategori_diklat' => 2,
            'nama_diklat' => 'TOEIC Test',
            'harga' => 675000,
            'kuota_minimal' => 5,
            'jumlah_pendaftar' => 0,
            'status' => 'belum full',
            'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum hic ullam, fugiat molestias porro, autem    mollitia ipsum magni nostrum quas quaerat omnis vel officiis eos nam facere facilis odio minus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum itaque perspiciatis ducimus temporibus facere facilis nihil quia fugiat possimus illo.',
            'gambar' => 'blob gambar belum',
        ], 
        ]);
    }
}
