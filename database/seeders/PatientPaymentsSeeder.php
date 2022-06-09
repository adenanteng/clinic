<?php

namespace Database\Seeders;

use App\Models\ClinicSchedule;
use App\Models\PatientPayment;
use Illuminate\Database\Seeder;

class PatientPaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = [
            [
                'patient_id'   => 1,
                'payment_gateway_id'    => 1,
            ],
            [
                'patient_id'   => 1,
                'payment_gateway_id'    => 2,
                'payment_card'      => '437373900090',
            ],
        ];

        foreach ($payments as $data) {
            $patient = PatientPayment::create($data);
        }
    }
}
