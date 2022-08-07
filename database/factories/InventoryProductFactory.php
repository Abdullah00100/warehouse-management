<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\inventoryProduct>
 */
class InventoryProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $productIDs = DB::table('products')->pluck('id');

        return [
            'product_id' => $this->faker->randomElement($productIDs),
            'quantity' => $this->faker->randomNumber(),
        ];
    }
}
