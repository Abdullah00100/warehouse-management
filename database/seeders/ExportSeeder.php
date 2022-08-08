<?php

namespace Database\Seeders;

use App\Models\export;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        export::factory()
            ->count(10)
            ->create();
    }
}
