<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
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

        
        for ($i=0; $i <= 50; $i++) {
            $userData[] = [
                'timeIN'=> $faker->randomElement(['07:00:00', '07:30:00', '08:00:00', '08:30:00', '09:00:00']),
                'entrance'=>$faker->randomElement(['Main Entrance', 'A-Entrance 1', 'B-Entrance 2', 'F-Entrance 1']),
                'dateIN'=> $faker->randomElement(['2021-09-26','2021-09-27','2021-09-28','2021-09-23','2021-09-24', '2021-09-25',]),
                'user_id'=>$faker->numberBetween($min = 22, $max = 71),
                'timeOUT'=> $faker->randomElement(['17:00:00', '17:30:00', '18:00:00', '18:30:00', '19:00:00']),
                'ext'=>$faker->randomElement(['Main Entrance', 'A-Entrance 1', 'B-Entrance 2', 'F-Entrance 1']),
                'created_at'=> now(),
		        'updated_at'=> now(),
            ];
        }

        foreach ($userData as $user) {
            Transaction::create($user);
        }
    }
}
