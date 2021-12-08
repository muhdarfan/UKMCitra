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
            'matric_no' => 'K123456',
            'name' => 'Muhammad Arfan',
            'email' => 'a174652@siswa.ukm.edu.my',
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'role' => 'admin',
            'phone' => '011-33900016'
        ]);

        DB::table('users')->insert([
            'matric_no' => 'A1234',
            'name' => 'Awnar bin Bujang',
            'email' => 'a177016@siswa.ukm.edu.my',
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'role' => 'lecturer',
            'phone' => '011-2345510'
        ]);

        DB::table('users')->insert([
            'matric_no' => 'A123',
            'name' => 'Putera Niq',
            'email' => 'A123456@siswa.ukm.edu.my',
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'role' => 'student',
            'phone' => '011-2345511'
        ]);
    }
}
