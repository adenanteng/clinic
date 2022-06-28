<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DefaultUserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();

        $users = [
            [
                'nric_type'         => 1,
                'nric_id'           => $this->faker->numerify('############'),
                'first_name'        => 'Aden',
                'last_name'         => 'Anteng',
                'email'             => 'admin@enola.com',
                'region_code'       => 62,
                'contact'           => '82280031916',
                'dob'               => '1996-12-20',
                'gender'            => Patient::MALE,
                'marriage'          => Patient::SINGLE,
                'religion'          => Patient::ISLAM,
                'blood_group'       => Patient::A,
                'profession'        => 'Developer',
                'type'              => User::ADMIN,
                'password'          => Hash::make('123456'),
                'email_verified_at' => Carbon::now(),
            ],
            [
                'nric_type'         => 1,
                'nric_id'           => $this->faker->numerify('############'),
                'first_name'        => $this->faker->firstName('female'),
                'last_name'         => $this->faker->lastName(),
                'email'             => 'dokter@enola.com',
                'region_code'       => 62,
                'contact'           => $this->faker->numerify('822########'),
                'dob'               => $this->faker->date('y-m-d'),
                'gender'            => Patient::FEMALE,
                'marriage'          => Patient::SINGLE,
                'religion'          => Patient::ISLAM,
                'blood_group'       => Patient::B,
                'type'              => User::DOCTOR,
                'password'          => Hash::make('123456'),
                'email_verified_at' => Carbon::now(),
            ],
            [
                'nric_type'         => 1,
                'nric_id'           => $this->faker->numerify('############'),
                'first_name'        => $this->faker->firstName('male'),
                'last_name'         => $this->faker->lastName(),
                'email'             => 'dokter2@enola.com',
                'region_code'       => 62,
                'contact'           => $this->faker->numerify('822########'),
                'dob'               => $this->faker->date('y-m-d'),
                'gender'            => Patient::MALE,
                'marriage'          => Patient::SINGLE,
                'religion'          => Patient::ISLAM,
                'blood_group'       => Patient::AB,
                'type'              => User::DOCTOR,
                'password'          => Hash::make('123456'),
                'email_verified_at' => Carbon::now(),
            ],
            [
                'nric_type'         => 1,
                'nric_id'           => $this->faker->numerify('############'),
                'first_name'        => $this->faker->firstName('female'),
                'last_name'         => $this->faker->lastName(),
                'email'             => 'pasien@enola.com',
                'region_code'       => 62,
                'contact'           => $this->faker->numerify('822########'),
                'dob'               => $this->faker->date('y-m-d'),
                'gender'            => Patient::FEMALE,
                'marriage'          => Patient::SINGLE,
                'religion'          => Patient::ISLAM,
                'blood_group'       => Patient::B,
                'type'              => User::PATIENT,
                'password'          => Hash::make('123456'),
                'email_verified_at' => Carbon::now(),
            ],
        ];

        foreach ($users as $key => $user) {
            $user = User::create($user);
            if ($key == 1) {
                $doctor = Doctor::create(['user_id' => $user->id]);
                $user->address()->create(['owner_id' => $user->id]);
            }
            if ($key == 2) {
                $doctor = Doctor::create(['user_id' => $user->id]);
                $user->address()->create(['owner_id' => $user->id]);
            }
            if ($key == 3) {
                $patient = Patient::create(['user_id' => $user->id]);
                $patient->address()->create(['owner_id' => $patient['user_id']]);
            }
        }

        $specializationIds = Specialization::pluck('id');
        $doctor->specializations()->sync($specializationIds);

    }
}
