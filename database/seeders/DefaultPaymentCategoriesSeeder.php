<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\PaymentCategory;
use Illuminate\Database\Seeder;

class DefaultPaymentCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentCategories = [
            [
                'payment_category_id' => Appointment::TUNAI,
                'payment_category'    => Appointment::PAYMENT_CATEGORY[1],
            ],
            [
                'payment_category_id' => Appointment::BPJS,
                'payment_category'    => Appointment::PAYMENT_CATEGORY[2],
            ],
            [
                'payment_category_id' => Appointment::ASURANSI,
                'payment_category'    => Appointment::PAYMENT_CATEGORY[3],
            ],
            [
                'payment_category_id' => Appointment::REKANAN,
                'payment_category'    => Appointment::PAYMENT_CATEGORY[4],
            ]
        ];

        foreach ($paymentCategories as $paymentCategory) {
            PaymentCategory::create($paymentCategory);
        }
    }
}
