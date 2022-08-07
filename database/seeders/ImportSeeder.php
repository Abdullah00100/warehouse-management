<?php

namespace Database\Seeders;

use App\Models\Import;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Import::factory()
         ->count(10)
         ->create();
    }
}
