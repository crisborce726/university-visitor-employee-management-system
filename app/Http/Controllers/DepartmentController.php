<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\User;

class DepartmentController extends Controller
{

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
        if(Auth::user()->userType =='admin'){
            $departments = DB::table('users')
                        ->select(DB::raw('id, email, office, address'))
                        ->where('userType', 'department')
                        ->paginate(10);
            return view('departments.index', ['departments' => $departments]);
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function generateDepartments()
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='admin')
        {
            $result = User::where('userType', 'department')->count(); 

            if($result == '0')
            {

                $this->createDepartment();

                DB::table('users')->insert([
                    'userType' => 'department',
                    'department_id' => 1,
                    'email' => 'SBAA',
                    'username' => 'SBAA',
                    'office' => 'Office 1',
                    'address' => 'Centennial Building',
                    'email_verified_at' => now(),
                    'password' => Hash::make('SBAADEPARTMENT'),
                    'created_at'=> now(),
                    'updated_at'=> now()
                ]);
                DB::table('users')->insert([
                    'userType' => 'department',
                    'department_id' => 6,
                    'email' => 'SCJPS',
                    'username' => 'SCJPS',
                    'office' => 'Office 2',
                    'address' => 'A Building',
                    'email_verified_at' => now(),
                    'password' => Hash::make('SCJPSDEPARTMENT'),
                    'created_at'=> now(),
                    'updated_at'=> now()
                ]);
                DB::table('users')->insert([
                    'userType' => 'department',
                    'email' => 'SEA',
                    'username' => 'SEA',
                    'department_id' => 11,
                    'office' => 'Office 4',
                    'address' => 'Centennial Building',
                    'email_verified_at' => now(),
                    'password' => Hash::make('SEADEPARTMENT'),
                    'created_at'=> now(),
                    'updated_at'=> now()
                ]);
                DB::table('users')->insert([
                    'userType' => 'department',
                    'department_id' => 17,
                    'email' => 'SIHTM',
                    'username' => 'SIHTM',
                    'office' => 'Office 6',
                    'address' => 'B Building',
                    'email_verified_at' => now(),
                    'password' => Hash::make('SIHTMDEPARTMENT'),
                    'created_at'=> now(),
                    'updated_at'=> now()
                ]);
                DB::table('users')->insert([
                    'userType' => 'department',
                    'department_id' => 21,
                    'email' => 'SIT',
                    'username' => 'SIT',
                    'office' => 'Office 5',
                    'address' => 'F Building',
                    'email_verified_at' => now(),
                    'password' => Hash::make('SITDEPARTMENT'),
                    'created_at'=> now(),
                    'updated_at'=> now()
                ]);
                DB::table('users')->insert([
                    'userType' => 'department',
                    'email' => 'SOD',
                    'username' => 'SOD',
                    'department_id' => 9,
                    'office' => 'Office 3',
                    'address' => 'B Building',
                    'email_verified_at' => now(),
                    'password' => Hash::make('SODDEPARTMENT'),
                    'created_at'=> now(),
                    'updated_at'=> now()
                ]);
                DB::table('users')->insert([
                    'userType' => 'department',
                    'department_id' => 43,
                    'email' => 'SOL',
                    'username' => 'SOL',
                    'office' => 'Office 7',
                    'address' => 'F Building',
                    'email_verified_at' => now(),
                    'password' => Hash::make('SOLDEPARTMENT'),
                    'created_at'=> now(),
                    'updated_at'=> now()
                ]);
                DB::table('users')->insert([
                    'userType' => 'department',
                    'department_id' => 28,
                    'email' => 'SON',
                    'username' => 'SON',
                    'office' => 'Office 8',
                    'address' => 'B Building',
                    'email_verified_at' => now(),
                    'password' => Hash::make('SONDEPARTMENT'),
                    'created_at'=> now(),
                    'updated_at'=> now()
                ]);
                DB::table('users')->insert([
                    'userType' => 'department',
                    'department_id' => 25,
                    'email' => 'SNS',
                    'username' => 'SNS',
                    'office' => 'Office 9',
                    'address' => 'B Building',
                    'email_verified_at' => now(),
                    'password' => Hash::make('SNSDEPARTMENT'),
                    'created_at'=> now(),
                    'updated_at'=> now()
                ]);
                DB::table('users')->insert([
                    'userType' => 'department',
                    'department_id' => 30,
                    'email' => 'STELA',
                    'username' => 'STELA',
                    'office' => 'Office 10',
                    'address' => 'Centennial Building',
                    'email_verified_at' => now(),
                    'password' => Hash::make('STELADEPARTMENT'),
                    'created_at'=> now(),
                    'updated_at'=> now()
                ]);

                return redirect('/departments')->with('success', 'Department accounts have been generated.');
            }
            else
            {
                return redirect('/departments');
            }
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function createDepartment()
    {
        $result = Department::count(); 

        if($result == '0')
        {
            //=============================SBAA-5
            DB::table('departments')->insert([
                'department_name' => 'sbaa',
                'course' => 'FACULTY',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sbaa',
                'course' => 'BSA',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sbaa',
                'course' => 'BSBA',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sbaa',
                'course' => 'DBA',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sbaa',
                'course' => 'MBA',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);


            //=============================SCJPS-3
            DB::table('departments')->insert([
                'department_name' => 'scjps',
                'course' => 'FACULTY',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'scjps',
                'course' => 'BFSC',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'scjps',
                'course' => 'BSCRIM',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);


            //=============================SOD-2
            DB::table('departments')->insert([
                'department_name' => 'sod',
                'course' => 'FACULTY',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sod',
                'course' => 'DMD',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);


            //=============================SEA-6
            DB::table('departments')->insert([
                'department_name' => 'sea',
                'course' => 'FACULTY',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sea',
                'course' => 'BET-MECHA',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sea',
                'course' => 'BSARCH',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sea',
                'course' => 'BSCE',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sea',
                'course' => 'BSECE',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sea',
                'course' => 'BSESE',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);


            //=============================SIHTM-4
            DB::table('departments')->insert([
                'department_name' => 'sihtm',
                'course' => 'FACULTY',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sihtm',
                'course' => 'BSHM-IHBO',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sihtm',
                'course' => 'BSHM-PCA',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sihtm',
                'course' => 'BSTM-IT',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);

            //=============================SIT-4
            DB::table('departments')->insert([
                'department_name' => 'sit',
                'course' => 'FACULTY',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sit',
                'course' => 'BSCE',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sit',
                'course' => 'BSCS',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sit',
                'course' => 'BSIT',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);


            //=============================SNS-3
            DB::table('departments')->insert([
                'department_name' => 'sns',
                'course' => 'FACULTY',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sns',
                'course' => 'BSMLS',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'sns',
                'course' => 'BSPT',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);


            //=============================SON-3
            DB::table('departments')->insert([
                'department_name' => 'son',
                'course' => 'FACULTY',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'son',
                'course' => 'BSN',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);

            //=============================STELA-13
            DB::table('departments')->insert([
                'department_name' => 'stela',
                'course' => 'FACULTY',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'stela',
                'course' => 'BAC',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'stela',
                'course' => 'BAEL',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'stela',
                'course' => 'BAM',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'stela',
                'course' => 'BAPS',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'stela',
                'course' => 'BEED',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'stela',
                'course' => 'BPE',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'stela',
                'course' => 'BSPSYCH',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'stela',
                'course' => 'BSED',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'stela',
                'course' => 'DPDE',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'stela',
                'course' => 'MPA',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'stela',
                'course' => 'MAED',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
            DB::table('departments')->insert([
                'department_name' => 'stela',
                'course' => 'MAENG',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);

            DB::table('departments')->insert([
                'department_name' => 'NONE',
                'course' => 'NONE',
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
        }
    }

    public function resetPassword(Request $request)
    {
        //return $request->input('dept');
        //return $request->input('user_id');

        if(Auth::user()->userType =='admin')
        {

            $arr = explode(' ',trim($request->input('dept')));

            if($arr[0] == 'SBAA')
            {
                $newPassword = $arr[0] . 'DEPARTMENT';
                $department = User::find($request->input('user_id'));
                $department->password = bcrypt($newPassword);
                $department->save();

            }
            elseif($arr[0] == 'SCJPS')
            {
                $newPassword = $arr[0] . 'DEPARTMENT';
                $department = User::find($request->input('user_id'));
                $department->password = bcrypt($newPassword);
                $department->save();
            }
            elseif($arr[0] == 'SOD')
            {
                $newPassword = $arr[0] . 'DEPARTMENT';
                $department = User::find($request->input('user_id'));
                $department->password = bcrypt($newPassword);
                $department->save();
                
            }
            elseif($arr[0] == 'SEA')
            {
                $newPassword = $arr[0] . 'DEPARTMENT';
                $department = User::find($request->input('user_id'));
                $department->password = bcrypt($newPassword);
                $department->save();
                
            }
            elseif($arr[0] == 'SIT')
            {
                $newPassword = $arr[0] . 'DEPARTMENT';
                $department = User::find($request->input('user_id'));
                $department->password = bcrypt($newPassword);
                $department->save();
            }
            elseif($arr[0] == 'SIHTM')
            {
                $newPassword = $arr[0] . 'DEPARTMENT';
                $department = User::find($request->input('user_id'));
                $department->password = bcrypt($newPassword);
                $department->save();
            }
            elseif($arr[0] == 'SOL')
            {
                $newPassword = $arr[0] . 'DEPARTMENT';
                $department = User::find($request->input('user_id'));
                $department->password = bcrypt($newPassword);
                $department->save();
            }
            elseif($arr[0] == 'SON')
            {
                $newPassword = $arr[0] . 'DEPARTMENT';
                $department = User::find($request->input('user_id'));
                $department->password = bcrypt($newPassword);
                $department->save();
            }
            elseif($arr[0] == 'SNS')
            {
                $newPassword = $arr[0] . 'DEPARTMENT';
                $department = User::find($request->input('user_id'));
                $department->password = bcrypt($newPassword);
                $department->save();
            }
            elseif($arr[0] == 'STELA')
            {
                $newPassword = $arr[0] . 'DEPARTMENT';
                $department = User::find($request->input('user_id'));
                $department->password = bcrypt($newPassword);
                $department->save();
            }
            return redirect('/departments')->with('success', $arr[0] ." department's password has been reset.");
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
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }

    //By Department Function
    public function indexUpcoming()
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='department'){
            $myAppointments = \DB::table('appointments')
                            ->where('departmentOffice', '=', Auth::user()->email)
                            ->where('status', '=', 'Approved')
                            ->paginate(10);
                return view('department.index', ['myAppointments' => $myAppointments]);
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function indexAppointmentPending()
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='department'){
            $myAppointments = \DB::table('appointments')
                            ->where('departmentOffice', '=', Auth::user()->email)
                            ->where('status', '=', 'Pending')
                            ->paginate(10);
                return view('department.pending', ['myAppointments' => $myAppointments]);
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function indexAppointmentHistory()
    {
        date_default_timezone_set('Asia/Manila');
        
        if(Auth::user()->userType =='department')
        {
            $myAppointments = \DB::table('appointments')
                            ->where('departmentOffice', '=', Auth::user()->email)
                            ->whereIn('status', ['Concluded', 'Canceled', 'Denied', 'Failed'])
                            ->paginate(10);
                return view('department.history', ['myAppointments' => $myAppointments]);
        }
        else
        {
            return redirect()->route('error.page');
        }
    }
}
