<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'matric_no' => 'A174652',
            'name' => 'Muhammad Arfan',
            'email' => 'a174652@siswa.ukm.edu.my',
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'role' => 'admin',
            'phone' => '011-33900016'
        ]);

        DB::table('users')->insert([
            'matric_no' => 'A177016',
            'name' => 'Awnar bin Bujang',
            'email' => 'a177016@siswa.ukm.edu.my',
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'role' => 'lecturer',
            'phone' => '011-2345510'
        ]);
    }
}
