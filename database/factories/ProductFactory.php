<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name(),
            'department_id' =>Department::all()->random()->id,
            'image_path' => $this->faker->imageUrl($width = 200, $height = 200),
            'product_code' => $this->faker->randomDigit(),
            'purchasing_price' => $this->faker->randomDigit(),
            'seling_price' => $this->faker->randomDigit(),
            'note' => $this->faker->paragraph(),

        ];
    }
}
