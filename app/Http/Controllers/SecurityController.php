<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gates;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Blocklist;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Transaction;

use Carbon\Carbon;

class SecurityController extends Controller
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
        //
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


    public function post()
    {
        date_default_timezone_set('Asia/Manila');

        if((Auth::user()->userType =='marshall') && (Auth::user()->activity =='enabled'))
        {
            return view('posts.index');
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function postSelect(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='marshall')
        {
            
            $post = User::find(Auth::user()->id);
            $post->post = $request->get('post');
            $post->save();
                
            return redirect()->route('scan.page')->with('success', 'Post successfully saved!');

        }
        else
        {
            return redirect()->route('error.page');
            
        }
    }

    public function scanPage()
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='marshall')
        {
            if(!empty(Auth::user()->post))
            {
                $success = '';
                $error = '';
                $usertype = '';
                $name = '';
                $id = '';
                
                return view('scans.index', compact('success', 'error', 'usertype', 'name', 'id'));
            }
            else
            {
                return redirect()->route('post.index')->with('error', 'Please select or update your assigned post before accessing the "Scan ID" page.');
            }
        }
        else
        {
            return redirect()->route('error.page');
            
        }
    }

    public function indexVisitor(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='marshall')
        { 

            $visitors = User::where('userType', '')
                        ->where('activity', 'enabled')
                        ->orderBY('id', 'asc')
                        ->paginate(10);

            $data = $request->all();

            if( $request->filled(['search']))
            {
                $visitors = User::where('userType', 'visitor')
                            ->where('fname', 'LIKE', '%'.$request->get('search').'%')
                            ->orWhere('lname', 'LIKE', '%'.$request->get('search').'%')
                            ->where('activity', 'enabled')
                            ->orderBy('id', 'asc')
                            ->paginate(1);
            }

            $name = $request->search;
                        
            return view('visitors.index', compact('visitors', 'data', 'name'));
        }
        else
        {
            return redirect()->route('error.page');
            
        }
    }


    public function visitorSearch(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='marshall')
        {
            if( $request->filled(['search']))
            {
                $search = $request->get('search');

                $data = User::where('userType', 'visitor')
                            ->where('fname', 'LIKE', '%'.$search.'%')
                            ->orWhere('lname', 'LIKE', '%'.$search.'%')
                            ->where('activity', 'enabled')
                            ->orderBy('id', 'asc')
                            ->paginate(10);
                            
                return view('visitors.index', compact('data'));
            }
            else
            {
                return view('visitors.index')->with('error', 'No Record Found.');
            }
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function visitorS(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='marshall')
        {

            $lists = User::where('users.userType', '==', 'visitor')
                        ->where('activity', 'enabled')
                        ->where('fname', 'LIKE', '%'.$request->get('search-posts').'%')
                        ->orWhere('lname', 'LIKE', '%'.$request->get('search-posts').'%')
                        ->orderBy('id', 'asc')
                        ->get();

            return view('visitors.result', compact('lists'));
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function visitorView($id)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='marshall')
        {

            $lists = User::where('id', $id)->get();

            return view('visitors.show', compact('lists'));
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function visitorTransac($id)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='marshall')
        {

            $data = Transaction::where('user_id', $id)->get();

            return view('visitors.transaction', compact('data'));
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function visitorBlock(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='marshall')
        {

            $block = User::find($request['user_id']);
            $block->userType = 'blocklisted';
            $block->save();

            $newBlock = new Blocklist();
            $newBlock->oType = $request['oType'];
            $newBlock->description = $request['description'];
            $newBlock->bldate = $request['bldate'];
            $newBlock->user_id = $request['user_id'];
            $newBlock->save();

            return redirect('/visitors')->with('success', 'Visitor has been successfully blocked.');
        }
        else
        {
            return redirect()->route('error.page');
        }
    }


    //SCAN ALTERNATIVE - USER INPUT
    public function input_scan(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='marshall')
        {

            $id1= $request->get('idNumber');
            
            $visitorType = \DB::table('users')
                            ->where('id', $id1)
                            ->value('userType');
            
            if($visitorType == 'blocklisted')
            {
                $get_name = User::find($id1);

                
                $usertype = $get_name->userType;
                $image = $get_name->identification;
                $name = $get_name->fname . ' ' . $get_name->lname;
                $id = $id1;
                $success = '';
                $error = "$name is currently on blacklist.";

                return view('scans.index', compact('success', 'error', 'usertype', 'image', 'name', 'id' ));
            }

            if($visitorType == 'visitor')
            {
                if(Appointment::where('user_id', $id1)->where('status', ['Approved'])->exists())
                {
                    $visitOffice = Appointment::where('user_id', $id1)->where('status', ['Approved'])->first()->get();

                    foreach($visitOffice as $getvisitOffice)
                    {
                        $save_get_office = $getvisitOffice->departmentOffice;
                    }

                }
                else
                {
                    $get_name = User::find($id1);
                            
                    $usertype = $get_name->userType;
                    $image = $get_name->identification;
                    $name = $get_name->fname . ' ' . $get_name->lname;
                    $id = $id1;
                    $success = "";
                    $error = "$name has no Approved Appointment.";

                    return view('scans.index', compact('success', 'error', 'usertype', 'image', 'name', 'id' ));
                }
                
            }
            else
            {
                $user_dept = User::join('departments', 'departments.id', '=', 'users.department_id')
                                    ->where('users.id', $id1)->get();

                foreach($user_dept as $user_dept_value)
                {
                    $save_get_office = $user_dept_value->department_name;
                }

            }



            if (DB::table('users')->where('id', $id1)->exists()) 
            {
                if (DB::table('users')->where('id', $id1)->whereIn('userType', ['student', 'employee', 'visitor'])->exists()) 
                {
                
                    $users = \DB::table('users')
                            ->select(\DB::raw('id', 'userType', 'username', 'fname', 'lname', 'contactNo'))
                            ->where('id', '=', $id1)
                            ->get();


                    //CREATING TRANSACTION FOR SCANNED USER WHEN LOGGING IN IF NO CURRENT DATA EXISTS
                    if(DB::table('transactions')->where('user_id', $id1)->where('dateIn', Carbon::today()->toDateString())->whereNotNull('timeIn')->whereNull('timeOut')->doesntExist())
                    {

                        if($visitorType == 'visitor')
                        {
                            if(Appointment::where('user_id', $id1)->where('date', Carbon::today()->toDateString())->where('status', 'Approved')->exists())
                            {
                                $transaction =  new Transaction();
                                $transaction->user_id = $id1;
                                $transaction->timeIn = Carbon::now();
                                $transaction->dateIn = Carbon::today();
                                $transaction->entrance =Auth::user()->post;
                                $transaction->visit_department = $save_get_office;
                                $transaction->save();

                                $get_name = User::find($id1);

                                $usertype = $get_name->userType;
                                $image = $get_name->identification;
                                $name = $get_name->fname . ' ' . $get_name->lname;
                                $id = $id1;
                                $success = "$name has been logged in successfully.";
                                $error = "";

                                return view('scans.index', compact('success', 'error', 'usertype', 'image', 'name', 'id' ));
                            }
                            else
                            {
                                $get_name = User::find($id1);
                                
                                $usertype = $get_name->userType;
                                $image = $get_name->identification;
                                $name = $get_name->fname . ' ' . $get_name->lname;
                                $id = $id1;
                                $success = "";
                                $error = "$name has no Approved Appointment.";

                                return view('scans.index', compact('success', 'error', 'usertype', 'image', 'name', 'id' ));
                            }
                        }
                        else
                        {
                            $transaction =  new Transaction();
                            $transaction->user_id = $id1;
                            $transaction->timeIn = Carbon::now();
                            $transaction->dateIn = Carbon::today();
                            $transaction->entrance =Auth::user()->post;
                            $transaction->visit_department = $save_get_office;
                            $transaction->save();

                            $get_name = User::find($id1);

                            $usertype = $get_name->userType;
                            $image = $get_name->identification;
                            $name = $get_name->fname . ' ' . $get_name->lname;
                            $id = $id1;
                            $success = "$name has been logged in successfully.";
                            $error = "";

                            return view('scans.index', compact('success', 'error', 'usertype', 'image', 'name', 'id' ));
                        }

                    }
                    elseif(DB::table('transactions')->where('user_id', $id1)->whereNotNull('timeIn')->where('dateIn', Carbon::today()->toDateString())->whereNull('timeOut')->exists())
                    {     
                                        
                        //UPDATE TRANSACTIONS TABLE WHEN SCANNING OUT
                        DB::table('transactions')->where('user_id', $id1)->whereNotNull('timeIn')->where('dateIn', Carbon::today()->toDateString())->whereNull('timeOut')->get();

                        
                        $data1 = \DB::table('transactions')
                        ->select('*')
                        ->where('user_id', $id1)
                        ->where('dateIn', Carbon::today()->toDateString())
                        ->whereNotNull('timeIn')
                        ->whereNull('timeout')
                        ->get();

                        foreach($data1 as $data2)
                        {
                            \DB::table('transactions')
                                ->where('user_id', '=', $id1)
                                ->whereNotNull('timeIn')
                                ->whereNull('timeout')
                                ->update(['timeOut' => Carbon::now(),
                                        'ext' => Auth::user()->post]);
                        }

                        $get_name = User::find($id1);

                        $usertype = $get_name->userType;
                        $image = $get_name->identification;
                        $name = $get_name->fname . ' ' . $get_name->lname;
                        $id = $id1;
                        $success = "$name has been logged out successfully.";
                        $error = "";

                        return view('scans.index', compact('success', 'error', 'usertype', 'image', 'name', 'id' ));

                        
                    }
                }
                else
                {
                    $usertype = '';
                    $image = '';
                    $name = '';
                    $id = '';
                    $success = '';
                    $error = 'ID does not exist.';

                    return redirect()->back()->with('error', 'ID does not exist');  
                }

            } 
            else 
            {
                $response = Http::get('https://aimsdatabase.000webhostapp.com/api/scanUsers/'.$id1.'/authenticate');
                
                $data = json_decode($response,true);
                
                if ($data["data"] === False)
                {
                        
                    if($visitorType == 'visitor')
                    {
                        $usersid = \DB::table('users')
                            ->select('identification')
                            ->where('id', $id1)
                            ->get();
                        foreach($usersid as $pid){
                            $identification = $pid->identification;
                        }
                            
                            return json_encode($identification);
                    }
                    else
                    {
                        
                    return json_encode($msg3);
                    }

                }
                else
                {
                    foreach($data as $data1)
                    {
                        DB::table('users')->insert(
                            array('id' => $data1['id'],
                                    'userType' => $data1['userType'],
                                    'fname' => $data1['fname'],
                                    'lname' => $data1['lname'],
                                    'email' => $data1['email'],
                                    'contactNo' => $data1['contactNo'],
                                    'address' => $data1['address'])
                        );

                        foreach($data as $data1){
                            DB::table('transactions')->insert(
                                array(  'user_id' => $data1['id'],
                                        'timeIn' => Carbon::now(),
                                        'dateIn' => Carbon::today(),
                                        'entrance' => Auth::user()->post,)
                            );
                        }

                        

                        if($visitorType == 'visitor')
                        {
                            $usersid = \DB::table('users')
                                ->select('identification')
                                ->where('id', $id1)
                                ->get();
                            foreach($usersid as $pid){
                                $identification = $pid->identification;
                            }
                                
                                return json_encode($identification);
                        }
                        else
                        {
                            
                        return json_encode($msg4);
                        }
                    }
                }   
            }
        
        }
        else
        {
           return redirect()->route('error.page');
        } 
    }


    //SCAN USING WEBCAM OR MOBILE CAM
    public function scan(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $id1= $request->get('idNumber');

        $visitorType = \DB::table('users')->where('id', $id1)->value('userType');
        
        if($visitorType == 'blocklisted')
        {
            $get_name = User::find($id1);

            
            $usertype = $get_name->userType;
            $image = $get_name->identification;
            $name = $get_name->fname . ' ' . $get_name->lname;
            $id = $id1;
            $success = '';
            $error = "$name is currently on blacklist.";

            return view('scans.index', compact('success', 'error', 'usertype', 'image', 'name', 'id' ));
        }

        if($visitorType == 'visitor')
        {
            $visitOffice = Appointment::where('user_id', $id1)->where('status', ['Approved'])->first()->get();

            foreach($visitOffice as $getvisitOffice)
            {
                $save_get_office = $getvisitOffice->departmentOffice;
            }
        }
        else
        {
            $user_dept = User::join('departments', 'departments.id', '=', 'users.department_id')
                                ->where('users.id', $id1)->get();

            foreach($user_dept as $user_dept_value)
            {
                $save_get_office = $user_dept_value->department_name;
            }

        }
        
        $userMain = \DB::table('users')
                    ->select(\DB::raw('id', 'userType', 'username', 'fname', 'lname', 'contactNo'))
                    ->where('id', '=', $id1)
                    ->get();
                                                                                                
        //DATE TODAY
        $dateToday = Carbon::today();
        $dateToday2 = $dateToday->toDateString();
        //TIME NOW
        $times = Carbon::now();
        $times2 = $times->subSeconds(10);
        $times4 = $times->toTimeString();
        $times3 = $times2->toTimeString(); 
        
        //RETURN THIS DATA TO AJAX
        $users = \DB::table('users')->select(\DB::raw('id', 'userType', 'username', 'fname', 'lname', 'contactNo'))->where('id', '=', $id1)->get();

        if (DB::table('users')->where('id', $id1)->exists())
        {

            $timeOutTest = DB::table('transactions')
                                ->select('timeOut')
                                ->where('dateIn', Carbon::today()->toDateString())
                                ->where('user_id', $id1)
                                ->orderByRaw('id DESC')
                                ->first();
        
            //CREATING TRANSACTION FOR SCANNED USER WHEN LOGGING IN IF NO CURRENT DATA EXISTS
            if(DB::table('transactions')->where('user_id', $id1)->where('dateIn', Carbon::today()->toDateString())->whereNotNull('timeIn')->whereNull('timeOut')->doesntExist())
            {

                if($timeOutTest<$times3)
                {
                    //INSERT TRANSACTION DATA IN DB
                    
                    if($visitorType == 'visitor')
                    {
                        if(Appointment::where('user_id', $id1)->where('date', Carbon::today()->toDateString())->where('status', 'Approved')->exists())
                        {
                            $transaction =  new Transaction();
                            $transaction->user_id = $id1;
                            $transaction->timeIn = Carbon::now();
                            $transaction->dateIn = Carbon::today();
                            $transaction->entrance =Auth::user()->post;
                            $transaction->visit_department = $save_get_office;
                            $transaction->save();

                            $get_name = User::find($id);

                            $usertype = $get_name->userType;
                            $image = $get_name->identification;
                            $name = $get_name->fname . ' ' . $get_name->lname;
                            $id = $id1;
                            $success = "$name has been logged in successfully.";
                            $error = "";

                            return $response = Http::acceptJson()->get(User::find($id));
                            
                        }
                        else
                        {
                            $get_name = User::find($id1);
                            
                            $usertype = $get_name->userType;
                            $image = $get_name->identification;
                            $name = $get_name->fname . ' ' . $get_name->lname;
                            $id = $id1;
                            $success = "";
                            $error = " $name has no Approved Appointment.";

                            session()->flash("success","Success Message");
                            return redirect('/scan_page');
                        }
                    }
                    else
                    {
                        $transaction =  new Transaction();
                        $transaction->user_id = $id1;
                        $transaction->timeIn = Carbon::now();
                        $transaction->dateIn = Carbon::today();
                        $transaction->entrance =Auth::user()->post;
                        $transaction->visit_department = $save_get_office;
                        $transaction->save();

                        $get_name = User::find($id1);

                        $usertype = $get_name->userType;
                        $image = $get_name->identification;
                        $name = $get_name->fname . ' ' . $get_name->lname;
                        $id = $id1;
                        $success = "$name has been logged in successfully.";
                        $error = "";

                        return view('scans.index', compact('success', 'error', 'usertype', 'image', 'name', 'id' ));
                    }
                }

            // UPDATE USER'S TRANSACTION WHEN LOGGING OUT
            }
            elseif(DB::table('transactions')->where('user_id', $id1)->whereNotNull('timeIn')->where('dateIn', Carbon::today()->toDateString())->where('timeIn', '<', $times3)->whereNull('timeOut')->exists())
            {    
                //UPDATE TRANSACTIONS TABLE WHEN SCANNING OUT
                $data1 = \DB::table('transactions')
                    ->select('*')
                    ->where('user_id', $id1)
                    ->where('dateIn', Carbon::today()->toDateString())
                    ->whereNotNull('timeIn')
                    ->whereNull('timeout')
                    ->get();
                //UPDATING USER's TIMEOUT IN TRANSACTIONS TABLE
                foreach($data1 as $data2)
                {
                    \DB::table('transactions')
                        ->where('user_id', '=', $id1)
                        ->whereNotNull('timeIn')
                        ->whereNull('timeout')
                        ->update(['timeOut' => Carbon::now(),
                                'ext' => Auth::user()->post]);
                }

                $get_name = User::find($id1);

                $usertype = $get_name->userType;
                $image = $get_name->identification;
                $name = $get_name->fname . ' ' . $get_name->lname;
                $id = $id1;
                $success = "$name has been logged out successfully.";
                $error = "";

                return view('scans.index', compact('success', 'error', 'usertype', 'image', 'name', 'id' ));
                
            }   
        }
        else
        {
            //RUN UB's API IF USER CREDENTIALS DOESNT EXIST IN DB
            $response = Http::get('https://aimsdatabase.000webhostapp.com/api/scanUsers/'.$id1.'/authenticate');
            
            $data = json_decode($response,true);
            
            if ($data["data"] === False)
            {
                return redirect()->route('securityOfficeHome')->with('danger', 'User ID does not exist.');
            }
            else
            {
                foreach($data as $data1)
                {
                    DB::table('users')->insert(
                        array('id' => $data1['id'],
                                'userType' => $data1['userType'],
                                'fname' => $data1['fname'],
                                'lname' => $data1['lname'],
                                'email' => $data1['email'],
                                'contactNo' => $data1['contactNo'],
                                'address' => $data1['address'],
                                'password' => $data1['password'],
                                'activity' => $data1['activity'],)
                    );

                    foreach($data as $data1)
                    {
                        DB::table('users')->insert(
                            array(  'user_id' => $data1['id'],
                                    'timeIn' => Carbon::now(),
                                    'dateIn' => Carbon::today(),
                                    'entrance' => Auth::user()->post)
                        );
                    }
                    

                    if($visitorType == 'visitor')
                    {
                        $usersid = \DB::table('users')
                            ->select('identification')
                            ->where('id', $id1)
                            ->get();
                        foreach($usersid as $pid)
                        {
                            $identification = $pid->identification;
                        }
                            
                            return json_encode($identification);
                    }
                    else
                    {  
                        return json_encode($msgLoggedIn);
                    }
                    
                }
            }
        }
    }

    //SCAN USING WEBCAM OR MOBILE CAM
    public function scanCopy(Request $request)
    {
            $id1= $request->get('idNumber');
            $msgLoggedIn = "User has been scanned successfully.";
            $msgWarning = "a";
            $visitorType = \DB::table('users')
                            ->where('id', $id1)
                            ->value('userType');
            
            if($visitorType == 'blacklisted'){
                                return json_encode($msgWarning);
                            }
            
            $userMain = \DB::table('users')
                        ->select(\DB::raw('id', 'userType', 'username', 'fname', 'lname', 'contactNo'))
                        ->where('id', '=', $id1)
                        ->get();
                                                                                                   
            //DATE TODAY
            $dateToday = Carbon::today();
            $dateToday2 = $dateToday->toDateString();
            //TIME NOW
            $times = Carbon::now();
            $times2 = $times->subMinutes(10);
            $times4 = $times->toTimeString();
            $times3 = $times2->toTimeString(); 
            
            //RETURN THIS DATA TO AJAX
            $users = \DB::table('users')
                            ->select(\DB::raw('id', 'userType', 'username', 'fname', 'lname', 'contactNo'))
                            ->where('id', '=', $id1)
                            ->get();

            if (DB::table('users')->where('id', $id1)->exists()) {

                $timeOutTest = DB::table('transactions')
                                    ->select('timeOut')
                                    ->where('dateIn', Carbon::today()->toDateString())
                                    ->where('user_id', $id1)
                                    ->orderByRaw('id DESC')
                                    ->first();
            
                //CREATING TRANSACTION FOR SCANNED USER WHEN LOGGING IN IF NO CURRENT DATA EXISTS
                if(DB::table('transactions')
                        ->where('user_id', $id1)
                        ->where('dateIn', Carbon::today()->toDateString())
                        ->whereNotNull('timeIn')
                        ->whereNull('timeOut')
                        ->doesntExist()){

                            if($timeOutTest<$times3){
                                //INSERT TRANSACTION DATA IN DB
                                    foreach($users as $user){
                                        $details = [
                                                [
                                                    'user_id' => $id1,
                                                    'timeIn' => Carbon::now(),
                                                    'dateIn' => Carbon::today(),
                                                    'entrance' => Auth::user()->post,
                                                    'visit_department' =>"true",
                                                ]
                                            ];

                                            DB::table('transactions')->insert($details);


                                            if($visitorType == 'visitor'){
                                                $usersid = \DB::table('users')
                                                    ->select('identification')
                                                    ->where('id', $id1)
                                                    ->get();
                                                foreach($usersid as $pid){
                                                    $identification = $pid->identification;
                                                }
                                                    
                                                    return json_encode($identification);
                                            }else{
                                                
                                            return json_encode($msgLoggedIn);
                                            }
                                            

                                    }
                            }else{
                            }






























                
                    
                    // UPDATE USER'S TRANSACTION WHEN LOGGING OUT
                }else if(DB::table('transactions')
                                ->where('user_id', $id1)
                                ->whereNotNull('timeIn')
                                ->where('dateIn', Carbon::today()->toDateString())
                                ->where('timeIn', '<', $times3)
                                ->whereNull('timeOut')
                                ->exists()){

                                    
                                    
                    //UPDATE TRANSACTIONS TABLE WHEN SCANNING OUT
                    $data1 = \DB::table('transactions')
                        ->select('*')
                        ->where('user_id', $id1)
                        ->where('dateIn', Carbon::today()->toDateString())
                        ->whereNotNull('timeIn')
                        ->whereNull('timeout')
                        ->get();
                    //UPDATING USER's TIMEOUT IN TRANSACTIONS TABLE
                    foreach($data1 as $data2){
                        \DB::table('transactions')
                            ->where('user_id', '=', $id1)
                            ->whereNotNull('timeIn')
                            ->whereNull('timeout')
                            ->update(['timeOut' => Carbon::now(),
                                    'ext' => Auth::user()->post]);
                    }
                    
                    
            
                    if($visitorType == 'visitor'){
                        $usersid = \DB::table('users')
                            ->select('identification')
                            ->where('id', $id1)
                            ->get();
                        foreach($usersid as $pid){
                            $identification = $pid->identification;
                        }
                            
                            return json_encode($identification);
                    }else{
                        
                    return json_encode($msgLoggedIn);
                    }
                    
                }else{
                }       




            } else {
                //RUN UB's API IF USER CREDENTIALS DOESNT EXIST IN DB
                $response = Http::get('https://aimsdatabase.000webhostapp.com/api/scanUsers/'.$id1.'/authenticate');
                
                $data = json_decode($response,true);
                
                if ($data["data"] === False) {
                    
                    return redirect()->route('securityOfficeHome')
                    ->with('danger', 'User ID does not exist.');

                } else {
                    
                    foreach($data as $data1){
                        DB::table('users')->insert(
                            array('id' => $data1['id'],
                                    'userType' => $data1['userType'],
                                    'fname' => $data1['fname'],
                                    'lname' => $data1['lname'],
                                    'email' => $data1['email'],
                                    'contactNo' => $data1['contactNo'],
                                    'address' => $data1['address'],
                                    'password' => $data1['password'],
                                    'activity' => $data1['activity'],)
                        );

                        foreach($data as $data1){
                            DB::table('users')->insert(
                                array(  'user_id' => $data1['id'],
                                        'timeIn' => Carbon::now(),
                                        'dateIn' => Carbon::today(),
                                        'entrance' => Auth::user()->post)
                            );
                        }
                        

                        if($visitorType == 'visitor'){
                            $usersid = \DB::table('users')
                                ->select('identification')
                                ->where('id', $id1)
                                ->get();
                            foreach($usersid as $pid){
                                $identification = $pid->identification;
                            }
                                
                                return json_encode($identification);
                        }else{
                            
                        return json_encode($msgLoggedIn);
                        }
                        
                }
            }
        return view('securityoffice.index');
        }
    }
}
