<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt("password"),
            ],
            [
                'name' => 'yerulan',
                'email' => 'yerulan@gmail.com',
                'password' => bcrypt("password"),
            ],
        ];
        User::insert($users);
    }
}
