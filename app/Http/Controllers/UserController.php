<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\User;

class UserController extends Controller
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
    public function index(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $searchForMe = $request->get('findMe');

        if(Auth::user()->userType =='admin')
        {
            $users = User::where('userType', '')
                            ->whereIn('activity', ['enabled', 'disabled'])
                            ->orderBy('id', 'asc')
                            ->paginate(10);
            $data = $request->all();

            if( $request->has(['findMe']) )
            {
                $users = User::whereIn('activity', ['enabled', 'disabled'])
                        ->where('id', 'LIKE', '%'.$request->get('findMe').'%')
                        ->orWhere('fname', 'LIKE', '%'.$request->get('findMe').'%')
                        ->orWhere('lname', 'LIKE', '%'.$request->get('findMe').'%')
                        ->orderBy('id', 'asc')
                        ->paginate(10);
            }

            return view('users.index', compact('users', 'data'));
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function indexMarshall(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $activity = $request->activity;

        if(Auth::user()->userType =='admin')
        {
            $marshalls = User::where('userType', '=', 'marshall')
                ->orderBy('id', 'desc')
                ->paginate(10);
            
            if($request->filled('activity')) {
                if($request->activity == 'enabled') {
                    $marshalls = DB::where('userType', '=', 'marshall')
                        ->where('activity', '=', 'enabled')
                        ->orderBy('id', 'desc')
                        ->paginate(10);
                }
                else {
                    $marshalls = DB::where('userType', '=', 'marshall')
                        ->where('activity', '=', 'disabled')
                        ->orderBy('id', 'desc')
                        ->paginate(10);
                }
            } 

            return view('users.marshall', ['marshalls' => $marshalls]);
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function archive(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='admin')
        {
            $user = User::Find($request['user_id']);
            $user->activity = "archived";
            $user->status = "0";
            $user->save();
            return back()->with('success', 'User Account has been successfully archived.');
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function disable(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='admin')
        {
            $user = User::Find($request['user_id']);
            $user->activity = "disabled";
            $user->save();
            return redirect()->route('marshall.index')->with('success', 'Marshal account has been successfully disabled.');
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function enable(Request $request) 
    {
        date_default_timezone_set ("Asia/Manila");
        
        if(Auth::user()->userType == 'admin') {
            $user = User::Find($request['user_id']);
            $user->activity = "enabled";
            $user->save();
            return redirect()->route('marshall.index')->with('success', 'Marshal account has been succesfully re-enabled.');
        } 
        else {
            return redirect()->route('error.page');
        }
    }

    /* public function marshalFilter(Request $request) {
        date_default_timezone_set ("Asia/Manila");
        
        if(Auth::user()->userType == 'admin') {

        }
    } */

    public function indexArchived()
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='admin')
        {
            $users = User::select(\DB::raw('id, userType, fname, lname, email, contactNo', 'address'))
                        ->where('activity', '=', 'archived')
                        ->paginate(10);
            return view('archives.index', ['users' => $users]);
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
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='admin')
        {
            $userDetails = new User();
            $deptDateTime = Carbon::create(2021, 12, 12, 0);
            $request->validate([
                
                'userType' => ['required'],
                'activity' => ['required'],
                'fname' => ['required'],
                'lname' => ['required'],
                'username' => 'required|string|max:255|unique:users',
                'activity' => ['required'],
            ]);

            $userDetails->userType = request('userType');
            $userDetails->activity = request('activity');
            $userDetails->department_id = 100;
            $userDetails->fname = request('fname');
            $userDetails->lname = request('lname');
            $userDetails->username = $request->input('username');
            $userDetails->email_verified_at = $deptDateTime->toDateTimeString();
            $userDetails->password = Hash::make(strtoupper(request('lname')));
            $userDetails->activity = $request->input('activity');
            $userDetails->remember_token = Str::random(10);
            $userDetails->status = '1';

            $userDetails->save();
            
            return redirect('/marshalls')->with('success', 'New marshall has been created.');
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='admin')
        {
            $user = User::where('id', $id)->get();
            
            return view('users.show', compact('user'));
        }
        else
        {
            return redirect()->route('error.page');
        }
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
        date_default_timezone_set('Asia/Manila');
        
        if(Auth::user()->userType =='admin')
        {
            $users = User::Find($request->user_id);
            $users->activity = 'enabled';
            $users->status = '1';
            $users->save();

            return redirect()->route('user.archived')->with('success', 'User account has been successfully restored.');
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(Auth::user()->userType =='admin')
        {
            
            $user = User::find($request->user_id);
            $user->delete();

            return redirect()->route('user.archived')->with('delete', "User account ". $request->user_id . " has been deleted.");
        }
        else
        {
            return redirect()->route('error.page');
        }
    }
}
