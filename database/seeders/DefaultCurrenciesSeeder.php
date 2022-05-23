<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Setting;
use App\Models\Specialization;
use Illuminate\Database\Seeder;

class DefaultCurrenciesSeeder extends Seeder
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
                'currency_name' => 'Indonesian Rupiah',
                'currency_icon' => 'Rp',
                'currency_code' => 'IDR',
            ],
        ];

        foreach ($input as $data) {
            Currency::create($data);
        }
    }
}
