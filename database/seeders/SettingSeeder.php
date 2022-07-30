<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();
        Setting::create([
            'name' => 'Nama Sistem',
            'logo' => 'logo/default.png',
            'email' => 'admin@gmail.com.com',
            'phone_number' => '011',
            'address' => 'Pekanbaru',
            'facebook' => 'https://facebook.com',
            'youtube' => 'https://youtube.com',
            'instagram' => 'https://instagram.com',
            // 'twitter ' => 'https://twitter.com'
        ]);
    }
}
