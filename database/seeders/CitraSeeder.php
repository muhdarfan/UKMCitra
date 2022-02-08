<?php

namespace Database\Seeders;

use App\Models\Citra;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::table('citras')->insert([
            'courseCode' => 'LMCR2482',
            'courseName' => 'ASAS REKA BENTUK GRAFIK',
            'courseCredit' => 2,
            'courseCategory' => 'C4',
            'courseAvailability' => 40,
            'descriptions' => ' Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry'
        ]);
        */

        $csvFile = fopen(base_path('database/data/citras.csv'), 'r');
        $firstLine = true;

        while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            if (!$firstLine) {
                Citra::create([
                    'courseCode' => $data['0'],
                    'courseName' => $data['1'],
                    'courseCredit' => $data['2'],
                    'courseCategory' => $data['3'],
                    'courseAvailability' => empty($data['4']) ? rand(1, 100) : $data['4'],
                    'descriptions' => $data['5'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            $firstLine = false;
        }

        fclose($csvFile);
        //Citra::factory()->count(10)->create();
    }
}
