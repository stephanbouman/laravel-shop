<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = $this->faker->randomElement(['open', 'paid']);

        return [
            'email'      => $this->faker->email,
            'status'     => $status,
            'payment_id' => $status === 'paid' ? Str::random(8) : null,
        ];
    }
}
