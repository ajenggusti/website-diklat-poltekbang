<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        DB::table('pembayaran')->insert([
            [
            'id_pendaftaran' => 1,
            'jenis_pembayaran' => 'diklat',
            'bukti_pembayaran' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            ],
            [
            'id_pendaftaran' => 1,
            'jenis_pembayaran' => 'pendaftaran',
            'bukti_pembayaran' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            ],
            [
            'id_pendaftaran' => 2,
            'jenis_pembayaran' => 'diklat',
            'bukti_pembayaran' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            ],
            [
            'id_pendaftaran' => 3,
            'jenis_pembayaran' => 'pendaftaran',
            'bukti_pembayaran' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
        ]]);
    }
}
