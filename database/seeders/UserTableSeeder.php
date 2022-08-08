<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            0 => [
                'id' => 1,
                'name' => 'manager',
                'email' => 'manager@admin.com',
                'password' => Hash::make('123123'),
                'role_id' => 1,

            ],
            1 => [
                'id' => 2,
                'name' => 'warehouse_guard',
                'email' => 'warehouse_guard@admin.com',
                'password' => Hash::make('123123'),
                'role_id' => 2,

            ],
            2 => [
                'id' => 3,
                'name' => 'accountant',
                'email' => 'accountant@admin.com',
                'password' => Hash::make('123123'),
                'role_id' => 3,

            ],
            3 => [
                'id' => 4,
                'name' => 'customer',
                'email' => 'customer@admin.com',
                'password' => Hash::make('123123'),
                'role_id' => 4,

            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
