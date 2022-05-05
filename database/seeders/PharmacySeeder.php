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
                'drug_unique_id' => 'paracetamol-50mg',
                'name' => 'PARACETAMOL 50MG',
                'brand' => 'KIMIA FARMING',
                'category' => Pharmacy::OBAT,
                'unit' => Pharmacy::TABLET,
            ],
            [
                'drug_unique_id' => 'valdoxan-100mg',
                'name' => 'VALDOXAN 100MG',
                'brand' => 'KALDU FARMA',
                'category' => Pharmacy::OBAT,
                'unit' => Pharmacy::TABLET,
            ],
            [
                'drug_unique_id' => 'orang-tua-50mg',
                'name' => 'OERANG TUA',
                'brand' => 'VISIT INDONESIA',
                'category' => Pharmacy::OBAT,
                'unit' => Pharmacy::INJEKSI,
            ],
            [
                'drug_unique_id' => 'omeprazol-500mg',
                'name' => 'OMEPRAZOL-500MG',
                'brand' => 'UNKNOWN',
                'category' => Pharmacy::OBAT,
                'unit' => Pharmacy::TABLET,
            ],
        ];

        foreach ($input as $data) {
            Pharmacy::create($data);
        }
    }
}
