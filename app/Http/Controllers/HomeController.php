<?php

namespace App\Http\Controllers;

use Picqer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gates;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BarCodeController;
use App\Http\Controllers\BlocklistController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user())
        {
            if (Auth::user()->userType == "admin")
            {
                return redirect('users_management');
            }
            if (Auth::user()->userType == "marshall")
            {
                if(Auth::user()->activity =='enabled')
                {
                    return redirect()->route('post.index');
                }
                else
                {
                    return redirect()->route('disabled.page');
                }
            }
            if (Auth::user()->userType == "department")
            {
                return redirect()->route('appointment.upcoming');
            }
            if (Auth::user()->userType == "visitor")
            {
                return redirect()->route('barcode.generate');
            }
            if (Auth::user()->userType == "blocklisted")
            {
                return redirect()->route('block.page');
            }
        }
        else
        {
            return redirect()->route('login');
        }
    }

    public function welcome()
    {
        if(auth()->guest())
        {
            return view('welcome');
        } 
        else
        {
            if (Auth::user()->userType == "admin")
            {
                return redirect('users_management');
            }
            if (Auth::user()->userType == "marshall")
            {
                if(Auth::user()->activity =='enabled')
                {
                    return redirect()->route('post.index');
                }
                else
                {
                    return redirect()->route('disabled.page');
                }
                
            }
            if (Auth::user()->userType == "department")
            {
                return redirect()->route('appointment.upcoming');
            }
            if (Auth::user()->userType == "visitor")
            {
                return redirect()->route('barcode.generate');
            }
            if (Auth::user()->userType == "blocklisted")
            {
                return redirect()->route('block.page');
            }
        }

    }
}
