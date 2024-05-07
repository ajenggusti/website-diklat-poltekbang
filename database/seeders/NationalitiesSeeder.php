<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nationality;
use Illuminate\Support\Facades\Storage;

class NationalitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_nationality = public_path('json/negara.json');
        $json_nationality = file_get_contents($file_nationality);
        $data_nationality = json_decode($json_nationality, true);
        foreach ($data_nationality as $nationalityData) {
            // dd($nationalityData['nationality']);
            if (isset($nationalityData['nationality'])) {
                Nationality::create([
                    'name' => $nationalityData['nationality']
                ]);
            }
        }
    }
}
