<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            0 => [
                'id' => 1,
                'name' => 'manager',
            ],
            1 => [
                'id' => 2,
                'name' => 'warehouse guard',
            ],
            2 => [
                'id' => 3,
                'name' => 'accountant',
            ],
            3 => [
                'id' => 4,
                'name' => 'customer',
            ],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
