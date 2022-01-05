<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('citras')->insert([
            'courseCode' => 'LMCR2482',
            'courseName' => 'ASAS REKA BENTUK GRAFIK',
            'courseCredit' => 2,
            'courseCategory' => 'C4',
            'courseAvailability' => 40,
            'descriptions' => ' Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry'
        ]);

        //Citra::factory()->count(10)->create();
    }
}
