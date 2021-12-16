<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    protected $model = Application::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'matric_no' => User::inRandomOrder()->where('role', 'student')->first()->matric_no,
            'courseCode' => 'LMCR2482',
            'reason' => $this->faker->text(30),
            'status' => 'pending',
            'semester' => 1,
            //
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Application $app) {
           Carbon::setTestNow(Carbon::now()->addMinute());
        });
    }
}
