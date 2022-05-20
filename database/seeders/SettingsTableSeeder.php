<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use App\Models\Setting;
class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'site_name' => "Laravel's block",
            'contact_number' => '87077082145',
            'contact_email' => '27816@iitu.edu.kz',
            'address' => 'Almaty, Kazakhstan'
        ]);
    }
}
