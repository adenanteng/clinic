<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Specialization;
use Illuminate\Database\Seeder;

class DefaultSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'name' => 'Dokter Umum',
            ],
            [
                'name' => 'Dr. gigi',
            ],
            [
                'name' => 'Dr. mata',
            ],
            [
                'name' => 'Bidan',
            ],
        ];

        foreach ($input as $data) {
            Specialization::create($data);
        }
    }
}
