<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Event; 

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'id_diklat' => 1,
                'title' => null,
                'start_date' => now()->addDays(1),
                'end_date' => now()->addDays(2),
                'category' => 'primary',
            ],
            [
                'id_diklat' => 2,
                'title' => null,
                'start_date' => now()->addDays(3),
                'end_date' => now()->addDays(4),
                'category' => 'secondary',
            ],
            [
                'id_diklat' => 3,
                'title' => null,
                'start_date' => now()->addDays(5),
                'end_date' => now()->addDays(6),
                'category' => 'success',
            ],
            [
                'id_diklat' => null,
                'title' => 'Event 4',
                'start_date' => now()->addDays(7),
                'end_date' => now()->addDays(8),
                'category' => 'danger',
            ],
            [
                'id_diklat' => null,
                'title' => 'Event 5',
                'start_date' => now()->addDays(9),
                'end_date' => now()->addDays(10),
                'category' => 'warning',
            ],
        ]);
    }
}
