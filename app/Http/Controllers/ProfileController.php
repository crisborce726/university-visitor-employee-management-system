<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class ProfileController extends Controller
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
        date_default_timezone_set('Asia/Manila');

        if((Auth::user()->userType == 'visitor') || (Auth::user()->userType == 'marshall') || (Auth::user()->userType == 'admin'))
        {
            if(Auth::user()->id == $id)
            {
                if(Auth::check())
                {
                    $data = DB::table('users')
                                ->where('id', auth()->user()->id)
                                ->get();
                    return view('profiles.show')->with('data', $data);
                }
                else
                {
                    return redirect()->route('error.page');
                }
            }
            else
            {
                return redirect()->route('error.page');
            }
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
        date_default_timezone_set('Asia/Manila');

        if((Auth::user()->userType == 'visitor') || (Auth::user()->userType == 'marshall') || (Auth::user()->userType == 'admin'))
        {
            if(Auth::user()->id == $id)
            {
                if(Auth::check())
                {
                    $data = DB::table('users')
                                ->where('id', auth()->user()->id)
                                ->get();
                    return view('profiles.edit')->with('data', $data);
                }
                else
                {
                    return redirect()->route('error.page');
                }
            }
            else
            {
                return redirect()->route('error.page');
            }
        }
        else
        {
            return redirect()->route('error.page');
        }
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
        
        if(Auth::user()->userType == 'visitor')
        {
            if(Auth::user()->id == $id)
            {
                $data_question = DB::table('questions')
                                ->where('user_id', auth()->user()->id)
                                ->get();
                                
                foreach($data_question as $value)
                {
                    $confirm_answer = $value->answer;
                }

                if($confirm_answer == $request['verify_answer'])
                {
                    $user = User::find(Auth::user()->id);
                    $user->contactNo = $request['contactNo'];
                    $user->save();
                    return redirect()->route('profiles.show', auth()->user()->id)->with('success', 'You have successfully updated you profile.');
                }
                else
                {   
                    return redirect()->route('profiles.edit', auth()->user()->id)->with('error', 'There were some problems with your input.');
                }
            }
            else
            {
                return redirect()->route('error.page');
            }
        }
        elseif ((Auth::user()->userType == 'marshall') || (Auth::user()->userType == 'admin'))
        {
            if(Hash::check($request->input('verify_password'), auth()->user()->password))
            {
                $user = User::find(Auth::user()->id);
                $user->address = $request['address'];
                $user->contactNo = $request['contactNo'];
                $user->save();
                return redirect()->route('profiles.show', auth()->user()->id)->with('success', 'You have successfully updated your profile.');
            }
            else
            {
                return redirect()->route('profiles.edit', auth()->user()->id)->with('error', 'There were some problems with your input.');
            }
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
    public function destroy($id)
    {
        //
    }
}
