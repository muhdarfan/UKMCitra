<?php

namespace Database\Seeders;

use App\Models\Citra;
use Database\Factories\CitraFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            CitraSeeder::class,
            ApplicationSeeder::class
        ]);
    }
}
