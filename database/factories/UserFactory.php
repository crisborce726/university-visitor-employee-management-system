<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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
            'userType'=>$faker->randomElement(['marshall', 'student', 'employee']),
            'fName'=>$faker->firstName,
            'lName'=>$faker->lastName,
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'contactNo'=>$faker->numberBetween($min = 90000000000, $max = 99999999999),
            'department_id'=>$faker->numberBetween($min = 1, $max = 42),
            'address'=>$faker->address,
            'password' =>bcrypt('secret'), // password
            'activity'=>$faker->randomElement(['enabled']),
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
