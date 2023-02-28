<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gates;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\Appointment;
use App\Models\Blocklist;
use App\Models\Department;
use App\Models\Notification;
use App\Models\Question;
use App\Models\Report;
use App\Models\Transaction;
use App\Models\User;

class TestController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Manila');

        $dateFrom =  Carbon::parse('2021-09-22')->toDateString();
        $dateTo =  Carbon::parse('2021-09-23')->toDateString();
        //Time G 24 hours, g 8 hours
        //Month F:j:y F-name of months, Y:m:d  m-# of months
        //Greater than or latest
        //Less than or oldest
        $timeFrom = '07:00:00';
        $timeTo = '21:00:00';

        //DATE
        if('2021-09-14' >= $dateFrom && '2021-09-14' <= $dateTo)
        {
            'True <br>';
        }
        else
        {
              'No  <br>';
        }
        
        //TIME
        if('07:07:32' >= $timeFrom && '20:31:01' >= $timeFrom)
        {
            'True  <br>';
        }
        else
        {
            'No  <br>';
        }


        
        DB::table('reports')
                    ->whereDate('updated_at', '>=', $dateFrom)
                    ->whereDate('updated_at', '<=', $dateTo)
                    ->whereTime('updated_at', '>=', $timeFrom)
                    ->whereTime('updated_at', '<=', $timeTo)
                    ->get();
        
        Carbon::parse(now());
        Carbon::parse(now())->format('Y-m-d');
        Carbon::parse(now())->format('G:i:s');
        now();
        Report::all();

        DB::table('users')
        ->join('transactions', 'transactions.user_id', '=', 'users.id')
        ->join('appointments', 'appointments.user_id', '=', 'users.id')
        ->whereNotNull('transactions.timeOut')
        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
        ->whereIn('appointments.status', ['Approved', 'Conclude'])
        ->where('appointments.departmentOffice', 'sbaa')
        ->distinct()->get();

        //DATE TODAY
        echo $dateToday = Carbon::today();
        echo '<br/>';
        echo $dateToday2 = $dateToday->toDateString();
        echo '<br/>';
        //TIME NOW
        echo $times = Carbon::now();
        echo '<br/>';
        echo $times2 = $times->subSeconds(10);
        echo '<br/>';
        echo $times4 = $times->toTimeString();
        echo '<br/>';
        echo $times3 = $times2->toTimeString();
    }
}
