<?php

namespace Database\Seeders;

use App\Models\inventoryProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        inventoryProduct::factory()
        ->count(10)
        ->create();
    }
}
