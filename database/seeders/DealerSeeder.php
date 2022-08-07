<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Dealer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DealerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0; $i < 10; $i++) { 
        
        $faker = Factory::create();

       

        DB::table('dealers')->insert([
            'name' => $faker->name(),
            'mobile_number' =>$faker->phoneNumber(),
            'address' => $faker->address(),
            'country' => $faker->country(),
            'city' => $faker->city(),
            'dealer_type' => 'seller',
        ]);

    }

        
    }
}
