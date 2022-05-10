<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=>'Yerulan',
            'email'=>'27816@iitu.edu.kz',
            'password'=>bcrypt('qwerty123'),
            'admin'=> 1
        ]);
        Profile::create([
            'user_id'=> $user->id,
            'avataro' =>   'uploads/avatars/img.png',
            'about'=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores autem consectetur itaque numquam omnis qui quis quos, tenetur? Ab ad aliquam consequatur doloremque earum eligendi esse impedit quae, ullam veritatis.',
            'facebook'=>'facebook.com',
            'youtube'=>'youtube.com'
        ]);
    }

}
