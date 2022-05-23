<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logoUrl = ('assets/image/infycare-logo.png');
        $favicon = ('assets/image/infyCare-favicon.ico');

        Setting::create(['key' => 'clinic_name', 'value' => 'Clinically']);
        Setting::create(['key' => 'contact_no', 'value' => '1234567890']);
        Setting::create(['key' => 'email', 'value' => 'info@clinically.com']);
        Setting::create(['key' => 'specialities', 'value' => '1']);
        Setting::create(['key' => 'currency', 'value' => '1']);
        Setting::create(['key' => 'address_one', 'value' => 'Jl. Mengkudu',]);
        Setting::create(['key' => 'address_two', 'value' => 'No. 22',]);
        Setting::create(['key' => 'country_id', 'value' => '102']);
        Setting::create(['key' => 'state_id', 'value' => '1683']);
        Setting::create(['key' => 'city_id', 'value' => '21503']);
        Setting::create(['key' => 'postal_code', 'value' => '35111']);
        Setting::create(['key' => 'logo', 'value' => $logoUrl]);
        Setting::create(['key' => 'favicon', 'value' => $favicon]);
        Setting::create(['key' => 'region_code', 'value' => '62']);
    }
}
