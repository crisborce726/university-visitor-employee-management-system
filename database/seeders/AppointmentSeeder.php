<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
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

        
        for ($i=1; $i <= 1; $i++) {
            $userData[] = [
                'departmentOffice'=> 'sbaa',
                'date'=> Carbon::today()->toDateString(),
                'time'=> '8:00 - 8:59',
                'purpose'=> 'Purpose',
                'visitant'=> '3',
                'status'=> 'Approved',
                'reason'=> NULL,
		        'created_at'=> now(),
		        'updated_at'=> now(),
                'user_id' => '3',
            ];
            $usersData[] = [
                'departmentOffice'=> 'sit',
                'date'=> Carbon::today()->toDateString(),
                'time'=> '8:00 - 8:59',
                'purpose'=> 'Purpose',
                'visitant'=> '4',
                'status'=> 'Approved',
                'reason'=> NULL,
		        'created_at'=> now(),
		        'updated_at'=> now(),
                'user_id' => '4',
            ];
        }

        foreach ($userData as $user) {
            Appointment::create($user);
        }

        foreach ($usersData as $users) {
            Appointment::create($users);
        }
    }
}
