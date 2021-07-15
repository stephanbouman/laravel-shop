<?php

namespace Database\Factories;

use App\Models\Procon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProconFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Procon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(['pro','con'])
        ];
    }
}
