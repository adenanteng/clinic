<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Specialization;
use App\Models\TreatmentCategory;
use Illuminate\Database\Seeder;

class DefaultTreatmentCategorySeeder extends Seeder
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
                'name' => 'ADMINISTRASI',
                'slug' => 'administration'
            ],
            [
                'name' => 'JASA',
                'slug' => 'service'
            ],
            [
                'name' => 'TINDAKAN',
                'slug' => 'treatment'
            ],
            [
                'name' => 'LABORATORIUM',
                'slug' => 'laboratorium'
            ],
            [
                'name' => 'RADIOLOGI',
                'slug' => 'radiology'
            ],
        ];

        foreach ($input as $data) {
            TreatmentCategory::create($data);
        }
    }
}
