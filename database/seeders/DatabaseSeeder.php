<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Import;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DepartmentSeeder::class,
            ProductSeeder::class,
            InventoryProductSeeder::class,
            DealerSeeder::class,
            ImportSeeder::class,
            ImportProductSeeder::class
        ]);
    }
}
