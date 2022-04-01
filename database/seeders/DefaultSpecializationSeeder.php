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
                'name' => 'Poli Umum',
            ],
            [
                'name' => 'Poli Gigi',
            ],
            [
                'name' => 'Poli Kebidanan',
            ],
            [
                'name' => 'Poli KIA',
            ],
        ];

        foreach ($input as $data) {
            Specialization::create($data);
        }
    }
}
