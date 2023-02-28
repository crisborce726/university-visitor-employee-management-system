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

class TransactionController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Array portion is for you to except pages.
        //$this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        
        $per_deptartment = $request->departmentOffice;
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;
        $timeFrom = $request->timeFrom;
        $timeTo = $request->timeTo;
        $status = $request->status;

        if(Auth::user()->userType =='marshall')
        {
            $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')
                                        ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                        ->orderBy('transactions.id', 'desc')
                                        ->paginate(10);
            
            $data = $request->all();

            if ($request->filled('departmentOffice'))
            {
                $transactions = DB::table('transactions')
                                ->join('users', 'users.id', '=', 'transactions.user_id')
                                ->where('transactions.visit_department', $per_deptartment)
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.id', 'desc')
                                ->paginate(10);
            }

            if ($request->filled('departmentOffice') && $request->filled('dateFrom') && $request->filled('dateTo'))
            {
                $transactions = DB::table('transactions')
                                ->join('users', 'users.id', '=', 'transactions.user_id')
                                ->where('transactions.visit_department', $per_deptartment)
                                ->whereBetween('transactions.dateIn', [$dateFrom, $dateTo])
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.id', 'desc')
                                ->paginate(10);
            }

            if ($request->filled('departmentOffice') && $request->filled('timeFrom') && $request->filled('timeTo'))
            {
                $transactions = DB::table('transactions')
                                ->join('users', 'users.id', '=', 'transactions.user_id')
                                ->where('transactions.visit_department', $per_deptartment)
                                ->whereTime('transactions.timeIn', '>=', $timeFrom)
                                ->whereTime('transactions.timeOut', '<=', $timeTo)
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.id', 'desc')
                                ->paginate(10);
            }

            if ($request->filled('departmentOffice') && $request->filled('status'))
            {
                if($request->status == 'in')
                {
                    $transactions = DB::table('transactions')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->where('transactions.visit_department', $per_deptartment)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.id', 'desc')
                                    ->paginate(10);
                }
                else
                {
                    $transactions = DB::table('transactions')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->where('transactions.visit_department', $per_deptartment)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNotNull('transactions.timeOut')
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.id', 'desc')
                                    ->paginate(10);
                }
            }

            if ($request->filled('departmentOffice') && $request->filled('dateFrom') && $request->filled('dateTo') && $request->filled('timeFrom') && $request->filled('timeTo') && $request->filled('status'))
            {
                if($request->status == 'in')
                {
                    $transactions = DB::table('transactions')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->where('transactions.visit_department', $per_deptartment)
                                    ->whereBetween('transactions.dateIn', [$dateFrom, $dateTo])
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->whereTime('transactions.timeIn', '>=', $timeFrom)
                                    ->whereTime('transactions.timeOut', '<=', $timeTo)
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.id', 'desc')
                                    ->paginate(10);
                }
                else
                {
                    $transactions = DB::table('transactions')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->where('transactions.visit_department', $per_deptartment)
                                    ->whereBetween('transactions.dateIn', [$dateFrom, $dateTo])
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNotNull('transactions.timeOut')
                                    ->whereTime('transactions.timeIn', '>=', $timeFrom)
                                    ->whereTime('transactions.timeOut', '<=', $timeTo)
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.id', 'desc')
                                    ->paginate(10);
                }
            }

            if ($request->filled('dateFrom') && $request->filled('dateTo'))
            {
                $transactions = DB::table('transactions')
                                ->join('users', 'users.id', '=', 'transactions.user_id')
                                ->whereBetween('transactions.dateIn', [$dateFrom, $dateTo])
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.id', 'desc')
                                ->paginate(10);
            }

            if ($request->filled('timeFrom') && $request->filled('timeTo'))
            {
                $transactions = DB::table('transactions')
                                ->join('users', 'users.id', '=', 'transactions.user_id')
                                ->whereTime('transactions.timeIn', '>=', $timeFrom)
                                ->whereTime('transactions.timeOut', '<=', $timeTo)
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.id', 'desc')
                                ->paginate(10);
            }

            if ($request->filled('status'))
            {
                if($request->status == 'in')
                {
                    $transactions = DB::table('transactions')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.id', 'desc')
                                    ->paginate(10);
                }
                else
                {
                    $transactions = DB::table('transactions')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNotNull('transactions.timeOut')
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.id', 'desc')
                                    ->paginate(10);
                }
            }

            if ($request->filled('dateFrom') && $request->filled('dateTo') && $request->filled('timeFrom') && $request->filled('timeTo'))
            {
                $transactions = DB::table('users')
                            ->join('transactions', 'users.id', '=', 'transactions.user_id')
                            ->join('departments', 'users.department_id', '=', 'departments.id')
                            ->whereBetween('transactions.dateIn', [$dateFrom, $dateTo])
                            ->whereTime('transactions.timeIn', '>=', $timeFrom)
                            ->whereTime('transactions.timeOut', '<=', $timeTo)
                            ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                            ->orderBy('transactions.id', 'desc')
                            ->paginate(10);
            }

            if ($request->filled('dateFrom') && $request->filled('dateTo') && $request->filled('status'))
            {
                if($request->status == 'in')
                {
                    $transactions = DB::table('transactions')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->whereBetween('transactions.dateIn', [$dateFrom, $dateTo])
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.id', 'desc')
                                    ->paginate(10);
                }
                else
                {
                    $transactions = DB::table('transactions')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->whereBetween('transactions.dateIn', [$dateFrom, $dateTo])
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNotNull('transactions.timeOut')
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.id', 'desc')
                                    ->paginate(10);
                }
            }

            if ($request->filled('timeFrom') && $request->filled('timeTo') && $request->filled('status'))
            {
                if($request->status == 'in')
                {
                    $transactions = DB::table('transactions')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->whereTime('transactions.timeIn', '>=', $timeFrom)
                                    ->whereTime('transactions.timeIn', '<=', $timeTo)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.id', 'desc')
                                    ->paginate(10);
                }
                else
                {
                    $transactions = DB::table('transactions')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->whereTime('transactions.timeIn', '>=', $timeFrom)
                                    ->whereTime('transactions.timeOut', '<=', $timeTo)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNotNull('transactions.timeOut')
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.id', 'desc')
                                    ->paginate(10);
                }
            }

            if ($request->filled('dateFrom') && $request->filled('dateTo') && $request->filled('timeFrom') && $request->filled('timeTo') && $request->filled('status'))
            {
                if($request->status == 'in')
                {
                    $transactions = DB::table('transactions')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->whereBetween('transactions.dateIn', [$dateFrom, $dateTo])
                                    ->whereTime('transactions.timeIn', '>=', $timeFrom)
                                    ->whereTime('transactions.timeIn', '<=', $timeTo)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.id', 'desc')
                                    ->paginate(10);
                }
                else
                {
                    $transactions = DB::table('transactions')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->whereBetween('transactions.dateIn', [$dateFrom, $dateTo])
                                    ->whereTime('transactions.timeIn', '>=', $timeFrom)
                                    ->whereTime('transactions.timeOut', '<=', $timeTo)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNotNull('transactions.timeOut')
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.id', 'desc')
                                    ->paginate(10);
                }
            }

            $by_deptartment = '';

            if($request->departmentOffice == 'sbaa')
            {
                $by_deptartment = 'School of Business Administration and Accountancy';
            }
            elseif($request->departmentOffice == 'scjps')
            {
                $by_deptartment = 'School of Criminal Justice and Public Safety';
            }
            elseif($request->departmentOffice == 'sod')
            {
                $by_deptartment = 'School of Dentistry';
            }
            elseif($request->departmentOffice == 'sea')
            {
                $by_deptartment = 'School of Engineering and Architecture';
            }
            elseif($request->departmentOffice == 'sit')
            {
                $by_deptartment = 'School of Information Technology';
            }
            elseif($request->departmentOffice == 'sihtm')
            {
                $by_deptartment = 'School of International Hospitality and Tourism Management';
            }
            elseif($request->departmentOffice == 'sol')
            {
                $by_deptartment = 'School of Law';
            }
            elseif($request->departmentOffice == 'son')
            {
                $by_deptartment = 'School of Nursing';
            }
            elseif($request->departmentOffice == 'sns')
            {
                $by_deptartment = 'School of Natural Sciences';
            }
            elseif($request->departmentOffice == 'stela')
            {
                $by_deptartment = 'School of Teacher Education and Liberal Arts';
            }
            

            return view('transactions.index', compact('transactions', 'data', 'by_deptartment', 'dateFrom', 'dateTo', 'timeFrom', 'timeTo', 'status'));
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
