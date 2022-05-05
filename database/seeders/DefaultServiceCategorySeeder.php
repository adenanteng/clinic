<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\Setting;
use App\Models\Specialization;
use Illuminate\Database\Seeder;

class DefaultServiceCategorySeeder extends Seeder
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
                'name' => 'Rawat Jalan',
            ],
            [
                'name' => 'Rawat Inap',
            ],
            [
                'name' => 'Promotif/Preventif',
            ],
        ];

        foreach ($input as $data) {
            ServiceCategory::create($data);
        }
    }
}
