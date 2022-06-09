<?php

namespace Database\Seeders;

use App\Models\ClinicSchedule;
use Illuminate\Database\Seeder;

class ClinicSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules = [
            [
                'day_of_week'   => '1',
                'start_time'    => '00:00',
                'end_time'      => '23:55',
            ],
            [
                'day_of_week'   => '2',
                'start_time'    => '00:00',
                'end_time'      => '23:55',
            ],
            [
                'day_of_week'   => '3',
                'start_time'    => '00:00',
                'end_time'      => '23:55',
            ],
            [
                'day_of_week'   => '4',
                'start_time'    => '00:00',
                'end_time'      => '23:55',
            ],
            [
                'day_of_week'   => '5',
                'start_time'    => '00:00',
                'end_time'      => '23:55',
            ],
            [
                'day_of_week'   => '6',
                'start_time'    => '00:00',
                'end_time'      => '23:55',
            ],
            [
                'day_of_week'   => '0',
                'start_time'    => '00:00',
                'end_time'      => '23:55',
            ],

        ];

        foreach ($schedules as $data) {
            $clinic = ClinicSchedule::create($data);
        }
    }
}
