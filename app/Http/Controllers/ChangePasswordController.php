<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordController extends Controller
{

    public function __construct()
    {
        //Array portion is for you to except pages.
        //$this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('auth');
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
        
        if(auth()->user()->id != $id)
        {
            return redirect()->route('error.page');
        }
        else
        {
            $data = DB::table('users')
                        ->where('users.id', '=', [$id])
                        ->select('users.id', 'users.password')
                        ->get();
                
            return view('passwords.edit')->with('data', $data);
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

        if(auth()->user()->id != $id)
        {
            return redirect()->route('error.page');
        }
        else
        {
            if(auth()->user()->id == $request['user_id'])
            {
                if(Hash::check($request->input('oldpassword'), auth()->user()->password))
                {

                    if($request['password'] == $request['password-confirm'])
                    {
                        $user = User::find($id);
                        $user->password = Hash::make($request['password']);
                        $user->save();
                        
                        return redirect()->route('passwords.edit',auth()->user()->id)->with('success', 'Password Successfully Changed.');
                    }
                    else
                    {
                        return redirect()->route('passwords.edit',auth()->user()->id)->with('error', 'There were some problems with your input.');
                    }
                }
                else
                {
                    return redirect()->route('passwords.edit',auth()->user()->id)->with('error', 'There were some problems with your input.');
                }
            }
        }
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
    public function show(User $user)
    {
        
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
