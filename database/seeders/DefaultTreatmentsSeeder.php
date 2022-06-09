<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Setting;
use App\Models\Specialization;
use App\Models\Treatment;
use Illuminate\Database\Seeder;

class DefaultTreatmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $treat = [
            [
                'category_id'       => '1',
                'name'              => 'Administrasi Pasien Rawat Jalan',
                'status'            => Treatment::ACTIVE,
                'charges'           => 30000,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
            ],
            [
                'category_id'       => '1',
                'name'              => 'Administrasi Pasien Rawat Inap',
                'status'            => Treatment::ACTIVE,
                'charges'           => 50000,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
            ],
            [
                'category_id'       => '2',
                'name'              => 'Poli: Jasa Dokter Umum',
                'status'            => Treatment::ACTIVE,
                'charges'           => 80000,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
            ],
            [
                'category_id'       => '2',
                'name'              => 'Poli: Jasa Dokter Mata',
                'status'            => Treatment::ACTIVE,
                'charges'           => 90000,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
            ],

            [
                'category_id'       => '2',
                'name'              => 'Poli: Jasa Paramedis',
                'status'            => Treatment::ACTIVE,
                'charges'           => 5000,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
            ],
            [
                'category_id'       => '3',
                'name'              => 'Poli: Aspirasi',
                'status'            => Treatment::ACTIVE,
                'charges'           => 15000,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
            ],
            [
                'category_id'       => '3',
                'name'              => 'Poli: Ganti Perban',
                'status'            => Treatment::ACTIVE,
                'charges'           => 18000,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
            ],
            [
                'category_id'       => '4',
                'name'              => 'Lab: Darah Lengkap',
                'status'            => Treatment::ACTIVE,
                'charges'           => 1800000,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
            ],
            [
                'category_id'       => '4',
                'name'              => 'Lab: Gula Darah',
                'status'            => Treatment::ACTIVE,
                'charges'           => 300000,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
            ],

        ];

        foreach ($treat as $data) {
            $service = Treatment::create($data);
        }
    }
}
