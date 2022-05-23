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
                'name' => 'Administrasi',
                'slug' => 'administration'
            ],
            [
                'name' => 'Jasa',
                'slug' => 'service'
            ],
            [
                'name' => 'Tindakan',
                'slug' => 'treatment'
            ],
        ];

        foreach ($input as $data) {
            TreatmentCategory::create($data);
        }
    }
}
