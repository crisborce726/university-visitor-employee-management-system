<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ErrorController extends Controller
{
    public function __construct()
    {
        //Array portion is for you to except pages.
        //$this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('auth');
    }

    public function error()
    {
        if(Auth::user()->activity != 'disabled')
        {
            return view('includes.error');
        }
        else
        {
            return redirect()->route('disabled.page');
        }
    }

    public function disabled()
    {
        if(Auth::user()->activity != 'disabled')
        {
            return redirect('/');
        }
        else
        {
            return view('includes.disabled');
        }
    }

    public function block()
    {
        if(Auth::user()->userType != 'blocklisted')
        {
            return redirect('/');
        }
        else
        {
            return view('includes.block');
        }
    }
}
