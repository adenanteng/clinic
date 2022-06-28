<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use Illuminate\Database\Seeder;

class PharmacySeeder extends Seeder
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
                'dept_id' => Pharmacy::PHARMACY,
                'name' => 'PARACETAMOL 50MG',
                'category_id' => Pharmacy::OBAT,
                'unit_id' => Pharmacy::TABLET,
            ],
            [
                'dept_id' => Pharmacy::PHARMACY,
                'name' => 'VALDOXAN 100MG',
                'category_id' => Pharmacy::OBAT,
                'unit_id' => Pharmacy::TABLET,
            ],
            [
                'dept_id' => Pharmacy::PHARMACY,
                'name' => 'OMEPRAZOL-500MG',
                'category_id' => Pharmacy::BHP,
                'unit_id' => Pharmacy::TABLET,
            ],
            [
                'dept_id' => Pharmacy::GENERAL,
                'name' => 'OERANG TUA',
                'category_id' => Pharmacy::OBAT,
                'unit_id' => Pharmacy::VIAL,
            ],
        ];

        foreach ($input as $data) {
            Pharmacy::create($data);
        }
    }
}
