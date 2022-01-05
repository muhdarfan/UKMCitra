<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**inci
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function role($role)
    {
        return $this->state(function (array $attributes) use ($role) {
            if ($role === 'student')
                $matric = $this->faker->unique()->numerify('A1#####');
            elseif ($role === 'lecturer')
                $matric = $this->faker->unique()->numerify('K1#####');
            elseif ($role === 'admin')
                $matric = $this->faker->unique()->numerify('D1#####');

            return [
                'matric_no' => $matric,
                'email' => $matric . ($role === 'student' ? '@siswa.ukm.edu.my' : '@ukm.my'),
                'role' => $role,
            ];
        });
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            DB::table('student_information')->insert([
                'matric_no' => $user->matric_no,
                'faculty' => $this->faker->randomElement(['FTSM', 'FKAB', 'FEP', 'FST']),
                'credit_limit' => $this->faker->numberBetween(18, 24),
                'session_enter' => $this->faker->randomElement(['20182019', '20192020', '20202021']),
            ]);
        });
    }
}
