<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gates;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use PDF;

use App\Models\Appointment;
use App\Models\Blocklist;
use App\Models\Department;
use App\Models\Notification;
use App\Models\Question;
use App\Models\Report;
use App\Models\Transaction;
use App\Models\User;

class MonitoringController extends Controller
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
    public function index()
    {
        if(Auth::user()->userType == 'marshall')
        {
            //=============================STUDENTS
            $students = DB::table('users')
                        ->join('transactions', 'transactions.user_id', '=', 'users.id')
                        ->where('users.userType', 'student')
                        ->where('transactions.dateIn', Carbon::today()->toDateString())
                        ->distinct()
                        ->count();
            //=============================EMPLOYEES
            $employees = DB::table('users')
                        ->join('transactions', 'transactions.user_id', '=', 'users.id')
                        ->where('users.userType', 'employee')
                        ->where('transactions.dateIn', Carbon::today()->toDateString())
                        ->distinct()
                        ->count();
            //=============================VISITORS
            $visitors = DB::table('users')
                        ->join('transactions', 'transactions.user_id', '=', 'users.id')
                        ->where('users.userType', 'visitor')
                        ->where('transactions.dateIn', Carbon::today()->toDateString())
                        ->distinct()
                        ->count();
                        
            
            //=============================SBAA(IN)
            $sbaaIN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sbaa')
                        ->count();
            
            $sbaaPEN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', '=',\Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sbaa')
                        ->count();
            //=============================SBAA(OUT)
            $sbaaOUT = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNotNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sbaa')
                        ->count();

            //=============================SCJPS(IN)
            $scjpsIN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'scjps')
                        ->count();
            $scjpsPEN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', '=',\Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'scjps')
                        ->count();
            //=============================SCJPS(OUT)
            $scjpsOUT = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNotNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'scjps')
                        ->count();

            //=============================SEA(IN)
            $seaIN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sea')
                        ->count();
            $seaPEN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', '=',\Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sea')
                        ->count();
            //=============================SEA(OUT)
            $seaOUT = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNotNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sea')
                        ->count();

            //=============================SIHTM(IN)
            $sihtmIN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sihtm')
                        ->count();
            $sihtmPEN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', '=',\Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sihtm')
                        ->count();
            //=============================SIHTM(OUT)
            $sihtmOUT = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNotNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sihtm')
                        ->count();

            //=============================SIT(IN)
            $sitIN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sit')
                        ->count();
            $sitPEN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', '=',\Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sit')
                        ->count();
            //=============================SIT(OUT)
            $sitOUT = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNotNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sit')
                        ->count();

            //=============================SOD(IN)
            $sodIN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sod')
                        ->count();
            $sodPEN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', '=',\Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sod')
                        ->count();
            //=============================SOD(OUT)
            $sodOUT = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNotNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sod')
                        ->count();

            //=============================SOL(IN)
            $solIN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sol')
                        ->count();
            $solPEN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', '<=',\Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sol')
                        ->count();
            //=============================SOL(OUT)
            $solOUT = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNotNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sol')
                        ->count();

            //=============================SON(IN)
            $sonIN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'son')
                        ->count();
            $sonPEN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', '=',\Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'son')
                        ->count();
            //=============================SON(OUT)
            $sonOUT = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNotNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'son')
                        ->count();

            //=============================SNS(IN)
            $snsIN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sns')
                        ->count();
            $snsPEN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', '=',\Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sns')
                        ->count();
            //=============================SNS(OUT)
            $snsOUT = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNotNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'sns')
                        ->count();

            //=============================STELA(IN)
            $stelaIN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'stela')
                        ->count();
            $stelaPEN = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', '=',\Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'stela')
                        ->count();
            //=============================STELA(OUT)
            $stelaOUT = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNotNull('transactions.timeOut')
                        ->where('transactions.dateIn', \Carbon\Carbon::today()->toDateString())
                        ->where('transactions.visit_department', 'stela')
                        ->count();


            $pendingToday = DB::table('users')
                            ->join('transactions', 'users.id', '=', 'transactions.user_id')
                            ->whereNull('transactions.timeOut')
                            ->where('transactions.dateIn',\Carbon\Carbon::today()->toDateString())
                            ->count();            
            $pending = DB::table('users')
                        ->join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->whereNull('transactions.timeOut')
                        ->where('transactions.dateIn', '<',\Carbon\Carbon::today()->toDateString())
                        ->count();

            return view('dashboard.index', compact('students', 'employees', 'visitors', 
                                                    'sbaaIN', 'sbaaOUT', 'sbaaPEN', 
                                                    'scjpsIN', 'scjpsOUT', 'scjpsPEN',
                                                    'seaIN', 'seaOUT','seaPEN',
                                                    'sihtmIN', 'sihtmOUT','sihtmPEN',
                                                    'sitIN', 'sitOUT','sitPEN',
                                                    'sodIN', 'sodOUT','sodPEN',
                                                    'solIN', 'solOUT','solPEN',
                                                    'sonIN', 'sonOUT','sonPEN',
                                                    'snsIN', 'snsOUT','snsPEN',
                                                    'stelaIN', 'stelaOUT', 'stelaPEN',
                                                    'pending', 'pendingToday'
                                                ));
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function indexActive($department)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType == 'marshall')
        {
            $data = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                            ->where('transactions.visit_department', $department)
                            ->whereNull('transactions.timeOut')
                            ->where('transactions.dateIn', Carbon::today()->toDateString())
                            ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                            ->orderBy('users.userType')
                            ->orderBy('transID', 'DESC')
                            ->distinct()
                            ->paginate(10);
            $userType = $department;

            return view('active.index', compact('data', 'userType'));
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function indexHistory(Request $request, $department)
    {
        date_default_timezone_set('Asia/Manila');
        
        if(Auth::user()->userType == 'marshall')
        {
            $usertype = $request->usertype;
            $dateFrom = $request->dateFrom;
            $dateTo = $request->dateTo;
            $timeFrom = $request->timeFrom;
            $timeTo = $request->timeTo;

            $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                            ->where('transactions.visit_department', $department)
                            ->whereNotNull('transactions.timeIn')
                            ->whereNotNull('transactions.timeOut')
                            ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                            ->orderBy('transactions.dateIn', 'desc')
                            ->paginate(10);

            $data = $request->all();
            $button = 0;

        
            if ($request->filled('usertype'))
            {
                $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->where('users.userType', $usertype)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNotNull('transactions.timeOut')
                                    ->where('transactions.visit_department', $department)
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);

                if(count($dataHistory) == 0)
                    $button = 0;
                else
                {
                    $button = 1;
                }
            }

            if( $request->filled('dateFrom') &&  $request->filled('dateTo') )
            {
                $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->whereBetween('transactions.dateIn', [$dateFrom, $dateTo])
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNotNull('transactions.timeOut')
                                    ->where('transactions.visit_department', $department)
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);

                if(count($dataHistory) == 0)
                    $button = 0;
                else
                {
                    $button = 1;
                }
            }

            if( $request->filled('timeFrom') &&  $request->filled('timeTo') )
            {
                $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNotNull('transactions.timeOut')
                                    ->where('transactions.visit_department', $department)
                                    ->where('transactions.timeIn', '>=', $timeFrom)
                                    ->where('transactions.timeOut', '<=', $timeTo)
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);

                if(count($dataHistory) == 0)
                    $button = 0;
                else
                {
                    $button = 1;
                }
            }

            if ($request->filled('usertype') && $request->filled('dateFrom') &&  $request->filled('dateTo'))
            {
                $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->where('users.userType', $usertype)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNotNull('transactions.timeOut')
                                    ->where('transactions.dateIn', '>=', $dateFrom)
                                    ->where('transactions.dateIn', '<=', $dateTo)
                                    ->where('transactions.visit_department', $department)
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);

                if(count($dataHistory) == 0)
                    $button = 0;
                else
                {
                    $button = 1;
                }
            }

            if ($request->filled('usertype') && $request->filled('timeFrom') &&  $request->filled('timeTo'))
            {
                $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->where('users.userType', $usertype)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNotNull('transactions.timeOut')
                                    ->where('transactions.timeIn', '>=', $timeFrom)
                                    ->where('transactions.timeOut', '<=', $timeTo)
                                    ->where('transactions.visit_department', $department)
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);

                if(count($dataHistory) == 0)
                    $button = 0;
                else
                {
                    $button = 1;
                }
            }

            if( $request->filled('dateFrom') &&  $request->filled('dateTo') && $request->filled('timeFrom') &&  $request->filled('timeTo') )
            {
                $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNotNull('transactions.timeOut')
                                    ->whereBetween(DB::raw('DATE(transactions.dateIn)'), [$dateFrom, $dateTo])
                                    ->where('transactions.timeIn', '>=', $timeFrom)
                                    ->where('transactions.timeOut', '<=', $timeTo)
                                    ->where('transactions.visit_department', $department)
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);

                if(count($dataHistory) == 0)
                    $button = 0;
                else
                {
                    $button = 1;
                }
            }

            if( $request->filled('usertype') && $request->filled('dateFrom') &&  $request->filled('dateTo') && $request->filled('timeFrom') &&  $request->filled('timeTo') )
            {
                $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->where('users.userType', $usertype)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNotNull('transactions.timeOut')
                                    ->whereBetween(DB::raw('DATE(transactions.dateIn)'), [$dateFrom, $dateTo])
                                    ->where('transactions.timeIn', '>=', $timeFrom)
                                    ->where('transactions.timeOut', '<=', $timeTo)
                                    ->where('transactions.visit_department', $department)
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);

                if(count($dataHistory) == 0)
                    $button = 0;
                else
                {
                    $button = 1;
                }
            }
        
            return view('history.index', compact('dataHistory', 'data', 'department', 'button', 'usertype', 'dateFrom', 'dateTo', 'timeFrom', 'timeTo'));
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function indexHistoryPDF(Request $request, $department)
    {
        $usertype = $request->usertype;
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;
        $timeFrom = $request->timeFrom;
        $timeTo = $request->timeTo;

        if ($request->filled('usertype'))
        {
            $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->where('users.userType', $usertype)
                                ->whereNotNull('transactions.timeIn')
                                ->whereNotNull('transactions.timeOut')
                                ->where('transactions.visit_department', $department)
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.dateIn', 'desc')
                                ->get();
        }

        if( $request->filled('dateFrom') &&  $request->filled('dateTo') )
        {
            $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->whereBetween('transactions.dateIn', [$dateFrom, $dateTo])
                                ->whereNotNull('transactions.timeIn')
                                ->whereNotNull('transactions.timeOut')
                                ->where('transactions.visit_department', $department)
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.dateIn', 'desc')
                                ->get();
        }

        if( $request->filled('timeFrom') &&  $request->filled('timeTo') )
        {
            $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->whereNotNull('transactions.timeIn')
                                ->whereNotNull('transactions.timeOut')
                                ->where('transactions.visit_department', $department)
                                ->where('transactions.timeIn', '>=', $timeFrom)
                                ->where('transactions.timeOut', '<=', $timeTo)
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.dateIn', 'desc')
                                ->get();
        }

        if ($request->filled('usertype') && $request->filled('dateFrom') &&  $request->filled('dateTo'))
        {
            $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->where('users.userType', $usertype)
                                ->whereNotNull('transactions.timeIn')
                                ->whereNotNull('transactions.timeOut')
                                ->where('transactions.dateIn', '>=', $dateFrom)
                                ->where('transactions.dateIn', '<=', $dateTo)
                                ->where('transactions.visit_department', $department)
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.dateIn', 'desc')
                                ->get();
        }

        if ($request->filled('usertype') && $request->filled('timeFrom') &&  $request->filled('timeTo'))
        {
            $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->where('users.userType', $usertype)
                                ->whereNotNull('transactions.timeIn')
                                ->whereNotNull('transactions.timeOut')
                                ->where('transactions.timeIn', '>=', $timeFrom)
                                ->where('transactions.timeOut', '<=', $timeTo)
                                ->where('transactions.visit_department', $department)
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.dateIn', 'desc')
                                ->get();
        }

        if( $request->filled('dateFrom') &&  $request->filled('dateTo') && $request->filled('timeFrom') &&  $request->filled('timeTo') )
        {
            $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->whereNotNull('transactions.timeIn')
                                ->whereNotNull('transactions.timeOut')
                                ->whereBetween(DB::raw('DATE(transactions.dateIn)'), [$dateFrom, $dateTo])
                                ->where('transactions.timeIn', '>=', $timeFrom)
                                ->where('transactions.timeOut', '<=', $timeTo)
                                ->where('transactions.visit_department', $department)
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.dateIn', 'desc')
                                ->get();
        }

        if( $request->filled('usertype') && $request->filled('dateFrom') &&  $request->filled('dateTo') && $request->filled('timeFrom') &&  $request->filled('timeTo') )
        {
            $dataHistory = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->where('users.userType', $usertype)
                                ->whereNotNull('transactions.timeIn')
                                ->whereNotNull('transactions.timeOut')
                                ->whereBetween(DB::raw('DATE(transactions.dateIn)'), [$dateFrom, $dateTo])
                                ->where('transactions.timeIn', '>=', $timeFrom)
                                ->where('transactions.timeOut', '<=', $timeTo)
                                ->where('transactions.visit_department', $department)
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.dateIn', 'desc')
                                ->get();
        }
    
        
        $pdf = PDF::loadView('history.history_pdf', compact('dataHistory', 'department', 'dateFrom', 'dateTo', 'timeFrom', 'timeTo', 'usertype'))->setPaper('legal','landscape');
        return $pdf->stream(Carbon::parse($dateFrom)->format('F j, Y').'-'.Carbon::parse($dateTo)->format('F j, Y').'.pdf');

    }

    public function indexListStudent(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType == 'marshall')
        {
            $activeStudent = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                            ->where('users.userType', 'student')
                            ->where('transactions.dateIn', Carbon::today()->toDateString())
                            ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                            ->orderBy('transactions.dateIn', 'desc')
                            ->distinct()
                            ->paginate(10);
            $data = $request->all();

            $department =  $request->departmentOffice;
            $timeFrom = $request->timeFrom;
            $timeTo = $request->timeTo;
            $userType = 'STUDENTS';
            
            
                if( $request->filled(['departmentOffice', 'timeFrom', 'timeTo']))
                {
                    $activeStudent = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->where('users.userType', 'student')
                                ->whereBetween(DB::raw('TIME(transactions.timeIn)'), [$timeFrom, $timeTo])
                                ->where('transactions.visit_department', $department)
                                ->where('transactions.dateIn', Carbon::today()->toDateString())
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.timeIn', 'desc')
                                ->distinct()
                                ->paginate(10);
                }
                elseif( $request->filled(['timeFrom', 'timeTo']))
                {
                    $activeStudent = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->where('users.userType', 'student')
                                ->whereBetween(DB::raw('TIME(transactions.timeIn)'), [$timeFrom, $timeTo])
                                ->where('transactions.dateIn', Carbon::today()->toDateString())
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.timeIn', 'desc')
                                ->distinct()
                                ->paginate(10);
                }
                elseif( $request->filled(['departmentOffice']))
                {
                    $activeStudent = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->where('users.userType', 'student')
                                ->where('transactions.visit_department', $department)
                                ->where('transactions.dateIn', '=', Carbon::today()->toDateString())
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.timeIn', 'desc')
                                ->distinct()
                                ->paginate(10);
                }

            $selected_dept = '';

            if($request->departmentOffice == 'sbaa')
            {
                $selected_dept = 'School of Business Administration and Accountancy';
            }
            elseif($request->departmentOffice == 'scjps')
            {
                $selected_dept = 'School of Criminal Justice and Public Safety';
            }
            elseif($request->departmentOffice == 'sod')
            {
                $selected_dept = 'School of Dentistry';
            }
            elseif($request->departmentOffice == 'sea')
            {
                $selected_dept = 'School of Engineering and Architecture';
            }
            elseif($request->departmentOffice == 'sit')
            {
                $selected_dept = 'School of Information Technology';
            }
            elseif($request->departmentOffice == 'sihtm')
            {
                $selected_dept = 'School of International Hospitality and Tourism Management';
            }
            elseif($request->departmentOffice == 'sol')
            {
                $selected_dept = 'School of Law';
            }
            elseif($request->departmentOffice == 'son')
            {
                $selected_dept = 'School of Nursing';
            }
            elseif($request->departmentOffice == 'sns')
            {
                $selected_dept = 'School of Natural Sciences';
            }
            elseif($request->departmentOffice == 'stela')
            {
                $selected_dept = 'School of Teacher Education and Liberal Arts';
            }
    

                return view('dashboard.show_student', compact('activeStudent', 'data', 'userType', 'selected_dept', 'timeFrom', 'timeTo'));
        }
        else
        {
            return redirect()->route('error.page');
        }
    }
    
    public function indexListEmployee(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType == 'marshall')
        {
            $activeEmployee = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                            ->where('users.userType', 'employee')
                            ->where('transactions.dateIn', Carbon::today()->toDateString())
                            ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                            ->orderBy('transactions.dateIn', 'desc')
                            ->distinct()
                            ->paginate(10);
            $data = $request->all();

            $department =  $request->departmentOffice;
            $timeFrom = $request->timeFrom;
            $timeTo = $request->timeTo;
            $userType = 'EMPLOYEES';
            
                if( $request->filled(['departmentOffice', 'timeFrom', 'timeTo']))
                {
                    $activeEmployee = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->where('users.userType', 'employee')
                                ->whereBetween(DB::raw('TIME(transactions.timeIn)'), [$timeFrom, $timeTo])
                                ->where('transactions.visit_department', $department)
                                ->where('transactions.dateIn', Carbon::today()->toDateString())
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.timeIn', 'desc')
                                ->distinct()
                                ->paginate(10);
                }
                elseif( $request->filled(['timeFrom', 'timeTo']))
                {
                    $activeEmployee = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->where('users.userType', 'employee')
                                ->whereBetween(DB::raw('TIME(transactions.timeIn)'), [$timeFrom, $timeTo])
                                ->where('transactions.dateIn', Carbon::today()->toDateString())
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.timeIn', 'desc')
                                ->distinct()
                                ->paginate(10);
                }
                elseif( $request->filled(['departmentOffice']))
                {
                    $activeEmployee = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->where('users.userType', 'employee')
                                ->where('transactions.visit_department', $department)
                                ->where('transactions.dateIn', '=', Carbon::today()->toDateString())
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.timeIn', 'desc')
                                ->distinct()
                                ->paginate(10);
                }

            $selected_dept = '';

            if($request->departmentOffice == 'sbaa')
            {
                $selected_dept = 'School of Business Administration and Accountancy';
            }
            elseif($request->departmentOffice == 'scjps')
            {
                $selected_dept = 'School of Criminal Justice and Public Safety';
            }
            elseif($request->departmentOffice == 'sod')
            {
                $selected_dept = 'School of Dentistry';
            }
            elseif($request->departmentOffice == 'sea')
            {
                $selected_dept = 'School of Engineering and Architecture';
            }
            elseif($request->departmentOffice == 'sit')
            {
                $selected_dept = 'School of Information Technology';
            }
            elseif($request->departmentOffice == 'sihtm')
            {
                $selected_dept = 'School of International Hospitality and Tourism Management';
            }
            elseif($request->departmentOffice == 'sol')
            {
                $selected_dept = 'School of Law';
            }
            elseif($request->departmentOffice == 'son')
            {
                $selected_dept = 'School of Nursing';
            }
            elseif($request->departmentOffice == 'sns')
            {
                $selected_dept = 'School of Natural Sciences';
            }
            elseif($request->departmentOffice == 'stela')
            {
                $selected_dept = 'School of Teacher Education and Liberal Arts';
            }
    

                return view('dashboard.show_employee', compact('activeEmployee', 'data', 'userType', 'selected_dept', 'timeFrom', 'timeTo'));
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function indexListVisitor(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType == 'marshall')
        {
            $activeVisitor = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                        ->where('users.userType', 'visitor')
                        ->where('transactions.dateIn', Carbon::today()->toDateString())
                        ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                        ->distinct()
                        ->paginate(10);
            $data = $request->all();   

            $department =  $request->departmentOffice;
            $timeFrom = $request->timeFrom;
            $timeTo = $request->timeTo;
            $userType = 'VISITORS';

           
                if( $request->filled(['departmentOffice', 'timeFrom', 'timeTo']))
                {
                    $activeVisitor = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->where('users.userType', 'visitor')
                                ->whereBetween(DB::raw('TIME(transactions.timeIn)'), [$timeFrom, $timeTo])
                                ->where('transactions.visit_department', $department)
                                ->where('transactions.dateIn', '=', Carbon::today()->toDateString())
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.timeIn', 'desc')
                                ->distinct()
                                ->paginate(10);
                }
                elseif( $request->filled(['timeFrom', 'timeTo']))
                {
                    $activeVisitor = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->where('users.userType', 'visitor')
                                ->whereBetween(DB::raw('TIME(transactions.timeIn)'), [$timeFrom, $timeTo])
                                ->where('transactions.dateIn', '=', Carbon::today()->toDateString())
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.timeIn', 'desc')
                                ->distinct()
                                ->paginate(10);
                }
                elseif( $request->filled(['departmentOffice']))
                {
                    $activeVisitor = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                ->where('users.userType', 'visitor')
                                ->where('transactions.visit_department', $department)
                                ->where('transactions.dateIn', '=', Carbon::today()->toDateString())
                                ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                ->orderBy('transactions.timeIn', 'desc')
                                ->distinct()
                                ->paginate(10);
                }

            $selected_dept = '';

            if($request->departmentOffice == 'sbaa')
            {
                $selected_dept = 'School of Business Administration and Accountancy';
            }
            elseif($request->departmentOffice == 'scjps')
            {
                $selected_dept = 'School of Criminal Justice and Public Safety';
            }
            elseif($request->departmentOffice == 'sod')
            {
                $selected_dept = 'School of Dentistry';
            }
            elseif($request->departmentOffice == 'sea')
            {
                $selected_dept = 'School of Engineering and Architecture';
            }
            elseif($request->departmentOffice == 'sit')
            {
                $selected_dept = 'School of Information Technology';
            }
            elseif($request->departmentOffice == 'sihtm')
            {
                $selected_dept = 'School of International Hospitality and Tourism Management';
            }
            elseif($request->departmentOffice == 'sol')
            {
                $selected_dept = 'School of Law';
            }
            elseif($request->departmentOffice == 'son')
            {
                $selected_dept = 'School of Nursing';
            }
            elseif($request->departmentOffice == 'sns')
            {
                $selected_dept = 'School of Natural Sciences';
            }
            elseif($request->departmentOffice == 'stela')
            {
                $selected_dept = 'School of Teacher Education and Liberal Arts';
            }
                return view('dashboard.show_visitor', compact('activeVisitor', 'data', 'userType', 'selected_dept', 'timeFrom', 'timeTo'));
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function indexListPending(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType == 'marshall')
        {

            $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', Carbon::today()->toDateString())
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
            $data = $request->all();

            $usertype =  $request->usertype;
            $department =  $request->departmentOffice;
            $timeFrom = $request->timeFrom;
            $timeTo = $request->timeTo;
            $userType = 'PENDING';


                    if( $request->filled(['usertype', 'departmentOffice', 'timeFrom', 'timeTo']))
                    {
                        $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->where('users.userType', $usertype)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', Carbon::today()->toDateString())
                                    ->where('transactions.visit_department', $department)
                                    ->whereBetween(DB::raw('TIME(transactions.timeIn)'), [$timeFrom, $timeTo])
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
                    }
                    elseif( $request->filled(['departmentOffice', 'timeFrom', 'timeTo']))
                    {
                        $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', Carbon::today()->toDateString())
                                    ->where('transactions.visit_department', $department)
                                    ->whereBetween(DB::raw('TIME(transactions.timeIn)'), [$timeFrom, $timeTo])
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
                    }
                    elseif( $request->filled(['usertype', 'timeFrom', 'timeTo']))
                    {
                        $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->where('users.userType', $usertype)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', Carbon::today()->toDateString())
                                    ->whereBetween(DB::raw('TIME(transactions.timeIn)'), [$timeFrom, $timeTo])
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
                    }
                    elseif( $request->filled(['usertype', 'departmentOffice']))
                    {
                        $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->where('users.userType', $usertype)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', Carbon::today()->toDateString())
                                    ->where('transactions.visit_department', $department)
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
                    }
                    
                    elseif( $request->filled(['timeFrom', 'timeTo']))
                    {
                        $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', Carbon::today()->toDateString())
                                    ->whereBetween(DB::raw('TIME(transactions.timeIn)'), [$timeFrom, $timeTo])
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
                    }
                    elseif( $request->filled(['departmentOffice']))
                    {
                        $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', Carbon::today()->toDateString())
                                    ->where('transactions.visit_department', $department)
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
                    }
                    elseif( $request->filled(['usertype']))
                    {
                        $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->where('users.userType', $usertype)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', Carbon::today()->toDateString())
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
                    }
                    

                    return view('dashboard.show_pending', compact('pendingData', 'data', 'userType'));
            }
            else
            {
                return redirect()->route('error.page');
            }
    }
    public function indexListPendingHistory(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType == 'marshall')
        {

            $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', '<', Carbon::today()->toDateString())
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
            $data = $request->all();

            $usertype =  $request->usertype;
            $department =  $request->departmentOffice;
            $timeFrom = $request->timeFrom;
            $timeTo = $request->timeTo;
            $userType = 'PENDING';


                    if( $request->filled(['usertype', 'departmentOffice', 'timeFrom', 'timeTo']))
                    {
                        $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->where('users.userType', $usertype)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', '<', Carbon::today()->toDateString())
                                    ->where('transactions.visit_department', $department)
                                    ->whereBetween(DB::raw('TIME(transactions.timeIn)'), [$timeFrom, $timeTo])
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
                    }
                    elseif( $request->filled(['departmentOffice', 'timeFrom', 'timeTo']))
                    {
                        $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', '<', Carbon::today()->toDateString())
                                    ->where('transactions.visit_department', $department)
                                    ->whereBetween(DB::raw('TIME(transactions.timeIn)'), [$timeFrom, $timeTo])
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
                    }
                    elseif( $request->filled(['usertype', 'timeFrom', 'timeTo']))
                    {
                        $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->where('users.userType', $usertype)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', '<', Carbon::today()->toDateString())
                                    ->whereBetween(DB::raw('TIME(transactions.timeIn)'), [$timeFrom, $timeTo])
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
                    }
                    elseif( $request->filled(['usertype', 'departmentOffice']))
                    {
                        $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->where('users.userType', $usertype)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', '<', Carbon::today()->toDateString())
                                    ->where('transactions.visit_department', $department)
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
                    }
                    
                    elseif( $request->filled(['timeFrom', 'timeTo']))
                    {
                        $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', '<', Carbon::today()->toDateString())
                                    ->whereBetween(DB::raw('TIME(transactions.timeIn)'), [$timeFrom, $timeTo])
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
                    }
                    elseif( $request->filled(['departmentOffice']))
                    {
                        $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', '<', Carbon::today()->toDateString())
                                    ->where('transactions.visit_department', $department)
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
                    }
                    elseif( $request->filled(['usertype']))
                    {
                        $pendingData = User::join('transactions', 'users.id', '=', 'transactions.user_id')
                                    ->where('users.userType', $usertype)
                                    ->whereNotNull('transactions.timeIn')
                                    ->whereNull('transactions.timeOut')
                                    ->where('transactions.dateIn', '<', Carbon::today()->toDateString())
                                    ->select('users.*', 'users.id as uID', 'transactions.*', 'transactions.id as transID')
                                    ->orderBy('transactions.dateIn', 'desc')
                                    ->paginate(10);
                    }
                    

                    return view('dashboard.show_pending_history', compact('pendingData', 'data', 'userType'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
