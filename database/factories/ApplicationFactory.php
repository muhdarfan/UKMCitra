<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Citra;
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
        /*
        $citras = ['LMCB1412', 'LMCA1402', 'LMCA1442', 'LMCA1432', 'LMCB1432'];
        $citra = Citra::find($citras[array_rand($citras)]);

        $status = 'approved';

        // Kalau dah penuh,
        // masukkan 10 random pending / rejected
        // kalau dah cukup,
        // masukkan ke random citra

        if (!$citra->isAvailable()) {
            if ($citra->availableSlot() >= 10) {
                $citra = Citra::whereNotIn('courseCode', $citras)->inRandomOrder()->first();
            } else {
                $status = $this->faker->randomElement(['pending', 'rejected']);
            }
        }
        */

        return [
            //'courseCode' => $citra->courseCode,
            'courseCode' => Citra::inRandomOrder()->first()->courseCode,
            'reason' => $this->faker->text(30),
            //'status' => $status,
            'status' => $this->faker->randomElement(['pending', 'rejected', 'approved']),
            //'session' => config('app.session'),
            'session' => $this->faker->randomElement(['20182019', '20192020', '20202021', '20212022']),
            'semester' => $this->faker->numberBetween(1, 2),
            'created_at' => Carbon::now()->subHours($this->faker->numberBetween(1, 128)),
            //
        ];
    }
}
