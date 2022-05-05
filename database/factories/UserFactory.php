<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nric_type' => 1,
            'nric_id' => $this->faker->numerify('############'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'region_code' => 62,
            'contact' => $this->faker->phoneNumber,
            'dob' => $this->faker->date('y-m-d'),
//            'gender' => $this->faker->randomElements([1,2]),
//            'marriage' => $this->faker->randomElements([1,2,3]),
//            'religion' => $this->faker->randomElements([1,2,3,4,5,6]),
            'profession' => $this->faker->regexify('[A-Za-z0-9]{8}'),
//            'blood_group' => $this->faker->randomElements([1,2,3,4]),
            'password' => Hash::make('123456'),

            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
