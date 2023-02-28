<?php

namespace Database\Seeders;

use App\Models\Report;

use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
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

        for ($i=1; $i <= 30; $i++) {
            $userData[] = [
                'areasOfConcern' => $faker->randomElement(['Security Matters', 'Safety Matter', 'Other Matters']),
                'status' => $faker->randomElement(['Security Matters', 'Safety Matter', 'Other Matters']),
                'actionTaken' =>$faker->randomElement(['Security Matters', 'Safety Matter', 'Other Matters']),
                'remarks' =>$faker->randomElement(['Security Matters', 'Safety Matter', 'Other Matters']),
                'created_at'=> now(),
		        'updated_at'=> now(),
                'user_id' => $faker->numberBetween($min = 5, $max = 14),
            ];
        }

        foreach ($userData as $user) {
            Report::create($user);
        }
    }
}
