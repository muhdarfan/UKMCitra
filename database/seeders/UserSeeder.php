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
        // ADMIN
        DB::table('users')->insert([
            'matric_no' => 'D123456',
            'name' => 'Muhammad Arfan',
            'email' => 'D123456@ukm.my',
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'role' => 'admin',
            'phone' => '011-33900016'
        ]);

        // Lecturer
        DB::table('users')->insert([
            'matric_no' => 'K123',
            'name' => 'Awnar bin Bujang',
            'email' => 'K123@ukm.my',
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'role' => 'lecturer',
            'phone' => '011-2345510'
        ]);

        DB::table('users')->insert([
            'matric_no' => 'K1234',
            'name' => 'Aifaa Athirah binti Mohd Azmi',
            'email' => 'K1234@ukm.my',
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'role' => 'lecturer',
            'phone' => '013-5190041'
        ]);

        DB::table('users')->insert([
            'matric_no' => 'K12345',
            'name' => 'Haiqal bin Najmi',
            'email' => 'K12345@ukm.my',
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'role' => 'lecturer',
            'phone' => '011-2342510'
        ]);

        // Student
        DB::table('users')->insert([
            'matric_no' => 'A123',
            'name' => 'Putera Niq',
            'email' => 'A123@siswa.ukm.edu.my',
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'role' => 'student',
            'phone' => '019-8918231'
        ]);

        DB::table('student_information')->insert([
            'matric_no' => 'A123',
            'student_name' => 'Putera Niq',
            'faculty' => 'FTSM',
            'credit_limit' => 20,
            'phone_number' => '019-8918231',
        ]);


        DB::table('users')->insert([
            'matric_no' => 'A1234',
            'name' => 'Syazili Juhari',
            'email' => 'A1234@siswa.ukm.edu.my',
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'role' => 'student',
            'phone' => '013-5123908'
        ]);

        DB::table('student_information')->insert([
            'matric_no' => 'A1234',
            'student_name' => 'Syazili Juhari',
            'faculty' => 'FKAB',
            'credit_limit' => 23,
            'phone_number' => '013-5123908',
        ]);


        DB::table('users')->insert([
            'matric_no' => 'A12345',
            'name' => 'Aina Batrisyia',
            'email' => 'A12345@siswa.ukm.edu.my',
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'role' => 'student',
            'phone' => '013-5126612'
        ]);

        DB::table('student_information')->insert([
            'matric_no' => 'A12345',
            'student_name' => 'Aina Batrisyia',
            'faculty' => 'FST',
            'credit_limit' => 25,
            'phone_number' => '013-5126612',
        ]);
    }
}
