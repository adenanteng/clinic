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
                'slug' => 'opd'
            ],
            [
                'name' => 'Rawat Inap',
                'slug' => 'ipd'
            ],
            [
                'name' => 'Promotif Preventif',
                'slug' => 'preventif'
            ],
        ];

        foreach ($input as $data) {
            ServiceCategory::create($data);
        }
    }
}
