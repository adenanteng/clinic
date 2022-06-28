<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\PharmacyProcurement;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PharmacyProcurementSeeder extends Seeder
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
                'drug_id' => 1,
                'supplier_id' => Pharmacy::TOKO_ABADI,
                'expired_date' => Carbon::parse('2024-01-01'),
                'amount' => 120,
                'remaining' => 120,
                'lifetime' => false,
                'invoice_no' => '4DEN94NT3N9',
                'purchase_price' => 20000,
                'selling_price' => 25000,
                'selling_price_bpjs' => 23000,
            ],
            [
                'drug_id' => 2,
                'supplier_id' => Pharmacy::TOKO_ABADI,
                'expired_date' => Carbon::parse('2024-01-01'),
                'amount' => 120,
                'remaining' => 120,
                'lifetime' => false,
                'invoice_no' => '4DENHUDGHB8UH4',
                'purchase_price' => 20000,
                'selling_price' => 25000,
                'selling_price_bpjs' => 23000,
            ],
            [
                'drug_id' => 3,
                'supplier_id' => Pharmacy::TOKO_ABADI,
                'expired_date' => Carbon::parse('2024-01-01'),
                'amount' => 120,
                'remaining' => 120,
                'lifetime' => false,
                'invoice_no' => '4DEN967GBVH7',
                'purchase_price' => 20000,
                'selling_price' => 25000,
                'selling_price_bpjs' => 23000,
            ],
            [
                'drug_id' => 4,
                'supplier_id' => Pharmacy::TOKO_ABADI,
                'expired_date' => Carbon::parse('2024-01-01'),
                'amount' => 120,
                'remaining' => 120,
                'lifetime' => true,
                'invoice_no' => '4DEN9KJNU7676',
                'purchase_price' => 20000,
                'selling_price' => 25000,
                'selling_price_bpjs' => 23000,
            ],
            [
                'drug_id' => 1,
                'supplier_id' => Pharmacy::TOKO_ABADI,
                'expired_date' => Carbon::parse('2026-01-01'),
                'amount' => 80,
                'remaining' => 80,
                'lifetime' => false,
                'invoice_no' => 'HYG7FTT6FG6778',
                'purchase_price' => 30000,
                'selling_price' => 50000,
                'selling_price_bpjs' => 23000,
            ],
        ];

        foreach ($input as $data) {
            PharmacyProcurement::create($data);
        }
    }
}
