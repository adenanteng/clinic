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
                'name' => 'Paracetamol 50mg',
                'brand' => 'Kimia Farming',
                'category' => Pharmacy::OBAT,
                'unit' => Pharmacy::TABLET,
            ],
            [
                'drug_unique_id' => 'valdoxan-100mg',
                'name' => 'Valdoxan 100mg',
                'brand' => 'Kalbe Farma',
                'category' => Pharmacy::OBAT,
                'unit' => Pharmacy::TABLET,
            ],
            [
                'drug_unique_id' => 'orang-tua-50mg',
                'name' => 'Orang Tua 50mg',
                'brand' => 'Budaya Indonesia',
                'category' => Pharmacy::BHP,
                'unit' => Pharmacy::KAPSUL,
            ],
            [
                'drug_unique_id' => 'omeprazol-500mg',
                'name' => 'OMEPRAZOL-500MG',
                'brand' => 'Kimia Farma',
                'category' => Pharmacy::OBAT,
                'unit' => Pharmacy::TABLET,
            ],
            [
                'drug_unique_id' => 'Surya-16',
                'name' => 'Surya 16',
                'brand' => 'Gudang Garam',
                'category' => Pharmacy::INJEKSI,
                'unit' => Pharmacy::PIL,
            ],
        ];

        foreach ($input as $data) {
            Pharmacy::create($data);
        }
    }
}
