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
                'name' => 'PARACETAMOL 50MG',
                'brand' => 'KIMIA FARMING',
                'category' => Pharmacy::OBAT,
                'unit' => Pharmacy::TABLET,
            ],
            [
                'name' => 'VALDOXAN 100MG',
                'brand' => 'KALDU FARMA',
                'category' => Pharmacy::OBAT,
                'unit' => Pharmacy::TABLET,
            ],
            [
                'name' => 'OMEPRAZOL-500MG',
                'brand' => 'UNKNOWN',
                'category' => Pharmacy::OBAT,
                'unit' => Pharmacy::TABLET,
            ],
            [
                'name' => 'OERANG TUA',
                'brand' => 'VISIT INDONESIA',
                'category' => Pharmacy::OBAT,
                'unit' => Pharmacy::VIAL,
            ],
        ];

        foreach ($input as $data) {
            Pharmacy::create($data);
        }
    }
}
