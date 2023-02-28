<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Picqer;
use Auth;

use App\Models\Appointment;
use App\Models\BarCode;
use App\Models\Blocklist;
use App\Models\Department;
use App\Models\Notification;
use App\Models\Question;
use App\Models\Report;
use App\Models\Transaction;
use App\Models\User;

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlocklistController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;

class BarCodeController extends Controller
{

    public function __construct()
    {
        //Array portion is for you to except pages.
        //$this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('auth');
    }

    public function makeBarcode()
    {
        date_default_timezone_set('Asia/Manila');
        
        if(Auth::user()->userType == 'visitor')
        {
            if(Auth::user()->id)
            {
                if(!empty(Auth::user()->email_verified_at))
                {
                    if(Auth::user()->userType === 'visitor')
                    {
                        if(empty(Auth::user()->barcode))
                        {
                            $id = auth()->user()->id;
                            $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                            $barcode = $generator->getBarcode($id, $generator::TYPE_CODE_39E);

                            //SAVE BARCODE TO STORAGE
                            //file_put_contents("'$id'.jpg", $barcode_generator->getBarcode($label, $barcode_generator::TYPE_CODE_39E));

                            $user = User::find(Auth::user()->id);
                            $user->barcode = $barcode;
                            $user->save();

                            $data = DB::table('users')
                                            ->where('id', auth()->user()->id)
                                            ->get();
                            return view('barcodes.index')->with('data', $data);

                        }
                        else
                        {
                            $data = DB::table('users')
                                            ->where('id', auth()->user()->id)
                                            ->get();
                            $user = User::find(Auth::user()->id);
                            return view('barcodes.index')->with('data', $data);

                        }
                    }
                    else
                    {
                        // Instantiate other controller class in this controller's method
                        $redirect = new HomeController;
                        // Use other controller's method in this controller's method
                        return $redirect->index();
                    }
                }
                else
                {
                    return redirect('/email/verify');
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
}
