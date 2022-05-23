<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PaymentGateway;
use App\Models\Specialization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultPaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentGateways = [
            [
                'payment_gateway_id' => Appointment::MANUALLY,
                'payment_category_id' => Appointment::TUNAI,
                'payment_name'    => Appointment::PAYMENT_METHOD[1],
            ],
            [
                'payment_gateway_id' => Appointment::BPJS_MANDIRI,
                'payment_category_id' => Appointment::BPJS,
                'payment_name'    => Appointment::PAYMENT_METHOD[2],
            ],
            [
                'payment_gateway_id' => Appointment::BPJS_KETENAGAKERJAAN,
                'payment_category_id' => Appointment::BPJS,
                'payment_name'    => Appointment::PAYMENT_METHOD[3],
            ],
            [
                'payment_gateway_id' => Appointment::JASA_RAHARJA,
                'payment_category_id' => Appointment::ASURANSI,
                'payment_name'    => Appointment::PAYMENT_METHOD[4],
            ],
            [
                'payment_gateway_id' => Appointment::ASTRA_LIFE,
                'payment_category_id' => Appointment::ASURANSI,
                'payment_name'    => Appointment::PAYMENT_METHOD[5],
            ],
        ];

        foreach ($paymentGateways as $paymentGateway) {
            PaymentGateway::create($paymentGateway);
        }

    }
}
