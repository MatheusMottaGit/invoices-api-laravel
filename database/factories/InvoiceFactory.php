<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isPaid = $this->faker->boolean();
        return [
            'user_id' => User::all()->random()->id,
            'type' => $this->faker->randomElement(['B', 'C', 'P']), // boleto, cartão ou pix
            'isPaid' => $isPaid,
            'value' => $this->faker->numberBetween(1000, 10000),
            'payment_date' => $isPaid ? $this->faker->randomElement([$this->faker->dateTimeThisMonth()]) : null
        ];
    }
}
