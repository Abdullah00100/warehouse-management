<?php

namespace Database\Seeders;

use App\Models\Import;
use App\Models\importProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImportProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        importProduct::factory()
            ->count(10)
            ->create();
    }
}
