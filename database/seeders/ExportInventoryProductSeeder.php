<?php

namespace Database\Seeders;

use App\Models\ExportInventoryProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExportInventoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExportInventoryProduct::factory()
            ->count(10)
            ->create();
    }
}
