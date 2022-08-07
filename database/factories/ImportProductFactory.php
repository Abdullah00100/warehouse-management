<?php

namespace Database\Factories;

use App\Models\Import;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\importProduct>
 */
class ImportProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' =>Product::all()->random()->id,
            'import_id' =>Import::all()->random()->id,
            'quantity' => $this->faker->randomNumber(2)
        ];
    }
}
