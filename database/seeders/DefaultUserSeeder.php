<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name'        => 'Aden',
                'last_name'         => 'Anteng',
                'contact'           => '82280031916',
                'gender'            => User::MALE,
                'type'              => User::ADMIN,
                'email'             => 'admin@clinic.com',
                'email_verified_at' => Carbon::now(),
                'password'          => Hash::make('123456'),
                'region_code'       => '62',
            ],
            [
                'first_name'        => 'Arliyans',
                'last_name'         => 'Soebandono',
                'contact'           => '1234567890',
                'gender'            => User::MALE,
                'type'              => User::DOCTOR,
                'email'             => 'doctor@clinic.com',
                'email_verified_at' => Carbon::now(),
                'password'          => Hash::make('123456'),
            ],
            [
                'first_name'        => 'Handy',
                'last_name'         => 'Wahyono',
                'contact'           => '1234567890',
                'gender'            => User::MALE,
                'type'              => User::PATIENT,
                'email'             => 'patient@clinic.com',
                'email_verified_at' => Carbon::now(),
                'password'          => Hash::make('123456'),
            ],
        ];

        foreach ($users as $key => $user) {
            $user = User::create($user);
            if ($key == 1) {
                $doctor = Doctor::create(['user_id' => $user->id]);
                $user->address()->create(['owner_id' => $user->id]);
            }
            if ($key == 2) {
                $patient = Patient::create(['user_id' => $user->id, 'patient_unique_id' => '000001']);
                $patient->address()->create(['owner_id' => $patient['user_id']]);
            }
        }

        $specializationIds = Specialization::pluck('id');
        $doctor->specializations()->sync($specializationIds);

    }
}
