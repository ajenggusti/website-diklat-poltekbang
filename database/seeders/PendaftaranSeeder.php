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
                'status_pembayaran_diklat' => 'Belum dibayar',
                'nama_depan' => 'member1 albert',
                'nama_belakang' => 'wicaksono',
                'tempat_lahir' => 'surabaya',
                'tanggal_lahir' => '2003-07-29',
                'alamat' => 'alamat Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                'pendidikan_terakhir' => 'SMA',
                'email' => 'membedwdwr@gmail.com',
                'no_hp' => '089-898-098-999',
                'status_pembayaran_daftar' => 'Belum dibayar',
                'sertifikat' => 'sertifikat jkdfagjhgsaj',
            ],
            [
                'id_diklat' => 1,
                'id_user' => 2,
                'id_promo' => 1,
                'harga_diklat' => '90000',
                'status_pembayaran_diklat' => 'Belum dibayar',
                'nama_depan' => 'rendi',
                'nama_belakang' => 'pangabean',
                'tempat_lahir' => 'Solo',
                'tanggal_lahir' => '2000-09-29',
                'alamat' => 'alamat Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                'pendidikan_terakhir' => 'SMk',
                'email' => 'membkevinwr@gmail.com',
                'no_hp' => '089-898-888-999',
                'status_pembayaran_daftar' => 'Belum dibayar',
                'sertifikat' => 'sertifikat jkdfagjhgsaj',
            ],
            [
                'id_diklat' => 2,
                'id_user' => 2,
                'id_promo' => 1,
                'harga_diklat' => '80000',
                'status_pembayaran_diklat' => 'Belum dibayar',
                'nama_depan' => 'kevin',
                'nama_belakang' => 'julian',
                'tempat_lahir' => 'Solo',
                'tanggal_lahir' => '2000-09-29',
                'alamat' => 'alamat Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                'pendidikan_terakhir' => 'SMk',
                'email' => 'membkevinwr@gmail.com',
                'no_hp' => '089-898-888-999',
                'status_pembayaran_daftar' => 'Belum dibayar',
                'sertifikat' => 'sertifikat jkdfagjhgsaj',
            ],
            
        ]);
    }
}
