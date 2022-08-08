<?php

namespace Database\Factories;

use App\Models\Import;
use App\Models\inventoryProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExportInventoryProduct>
 */
class ExportInventoryProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'inventory_product_id' => inventoryProduct::all()->random()->id,
            'export_id' => Import::all()->random()->id,
            'quantity' => $this->faker->randomNumber(2),
            'export_product_price' => $this->faker->randomNumber()
        ];
    }
}
