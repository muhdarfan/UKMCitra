<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        //
        for($i = 0; $i < 6; $i++) {
            DB::table('feedback')->insert([
                'matric_no' => User::inRandomOrder()->where('role', 'student')->first()->matric_no,
                'comment' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
