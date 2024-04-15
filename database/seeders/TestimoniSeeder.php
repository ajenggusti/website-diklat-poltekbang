<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('testimoni')->insert([
            [
            'id_diklat' => 1,
            'id_pendaftaran' => '1',
            'profesi' => 'Pilot',
            'testimoni' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta in dolorum dolor porro aut assumenda vitae esse, id quae maiores nihil alias, amet facere voluptatibus eum delectus quod similique iste.',
            ],
            [
            'id_diklat' => 1,
            'id_pendaftaran' => '2',
            'profesi' => 'Teknisi pesawat lion air',
            'testimoni' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta in dolorum dolor porro aut assumenda vitae esse, id quae maiores nihil alias, amet facere voluptatibus eum delectus quod similique iste.',
            ],
        ]);
    }
}
