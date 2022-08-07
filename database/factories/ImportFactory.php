<?php

namespace Database\Factories;

use App\Models\Dealer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Import>
 */
class ImportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dealer_id' =>Dealer::all()->random()->id,
            'shipping_charge_price' => $this->faker->randomNumber(2),
            'bill_number' => $this->faker->randomNumber(6),
            'total_price' => $this->faker->randomDigit(4)

        ];
    }
}
