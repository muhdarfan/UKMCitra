<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CitraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'courseCode' => 'LMCX' . $this->faker->unique->numberBetween(1000, 3999),
            'courseName' => $this->faker->unique()->word(),
            'courseCredit' => $this->faker->numberBetween(1, 3),
            'courseCategory' => 'C' . $this->faker->numberBetween(1, 6),
            'descriptions' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry'
        ];
    }
}
