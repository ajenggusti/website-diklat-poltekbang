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
            'name' => 'Member1',
            'email' => 'member1@gmail.com',
            'password' => Hash::make('123456'),
        ], 
            [
            'id_level' => 1,
            'name' => 'Member2',
            'email' => 'member2@gmail.com',
            'password' => Hash::make('123456'),
        ], 
            [
            'id_level' => 1,
            'name' => 'Member3',
            'email' => 'member3@gmail.com',
            'password' => Hash::make('123456'),
        ], 
        [
            'id_level' => 2,
            'name' => 'Super Admin',
            'email' => 'superAdmin@gmail.com',
            'password' => Hash::make('123456'),
        ],
        [
            'id_level' => 3,
            'name' => 'DPUK',
            'email' => 'dpuk@gmail.com',
            'password' => Hash::make('123456'),
        ],
        [
            'id_level' => 4,
            'name' => 'Keuangan',
            'email' => 'keuangan@gmail.com',
            'password' => Hash::make('123456'),
        ]]);
    }
}
