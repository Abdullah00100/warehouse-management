<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dealer>
 */
class DealerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'mobile_number' =>$this->faker->phoneNumber(),
            'address' => $this->faker->sentences(),
            'country' => $this->faker->word(),
            'city' => $this->faker->word(),
            'dealer_type' => 'seller',
        ];
    }
}
