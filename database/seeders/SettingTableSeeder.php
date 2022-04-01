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

        Setting::create(['key' => 'clinic_name', 'value' => 'Clinic Appointment Management']);
        Setting::create(['key' => 'contact_no', 'value' => '1234567890']);
        Setting::create(['key' => 'email', 'value' => 'info@clinic.com']);
        Setting::create(['key' => 'specialities', 'value' => '1']);
        Setting::create(['key' => 'currency', 'value' => '1']);
        Setting::create([
            'key' => 'address_one', 'value' =>
                'Jl. in aja dulu',
        ]);
        Setting::create([
            'key' => 'address_two', 'value' =>
                'no. 2',
        ]);
        Setting::create(['key' => 'country_id', 'value' => '101']);
        Setting::create(['key' => 'state_id', 'value' => '12']);
        Setting::create(['key' => 'city_id', 'value' => '1041']);
        Setting::create(['key' => 'postal_code', 'value' => '394101']);
        Setting::create(['key' => 'logo', 'value' => $logoUrl]);
        Setting::create(['key' => 'favicon', 'value' => $favicon]);
        Setting::create(['key' => 'region_code', 'value' => '62']);
    }
}
