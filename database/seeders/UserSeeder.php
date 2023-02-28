<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Manila');
        
        $faker = \Faker\Factory::create();

        for ($i=1; $i <= 50; $i++) {
            $userData[] = [
                'userType'=>$faker->randomElement(['student', 'employee']),
                'fName'=>$faker->firstName,
                'lName'=>$faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'contactNo'=>$faker->numberBetween($min = 90000000000, $max = 99999999999),
                'department_id'=>$faker->numberBetween($min = 1, $max = 42),
                'address'=>$faker->address,
                'password' =>bcrypt('user'), // password
                'activity'=>$faker->randomElement(['enabled']),
                'status'=> '1',
                'remember_token' => Str::random(10),
                'created_at'=> now(),
		        'updated_at'=> now(),
            ];
        }

        foreach ($userData as $user) {
            User::create($user);
        }
    }
}
