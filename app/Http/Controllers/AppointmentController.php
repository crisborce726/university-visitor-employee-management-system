<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
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
        if(Auth::user()->userType == 'visitor')
        {
            $data = Appointment::where('user_id', auth()->user()->id)
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10);
            return view('appointments.index')->with('data', $data);

            
        }
        else
        {
            return redirect()->route('error.page');
        }

    }

    public function indexApproved()
    {
        if(Auth::user()->userType == 'visitor')
        {
            $data = Appointment::where('status', 'Approved')
                                        ->where('user_id', auth()->user()->id)
                                        ->orderBy('id', 'DESC')
                                        ->paginate(10);
            return view('appointments.approved')->with('data', $data);
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function indexPending()
    {
        if(Auth::user()->userType == 'visitor')
        {
            $data = Appointment::where('status', 'Pending')
                                    ->where('user_id', auth()->user()->id)
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10);
            return view('appointments.pending')->with('data', $data); 
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function indexDenied()
    {
        if(Auth::user()->userType == 'visitor')
        {
            $data = Appointment::where('status', 'Denied')
                                    ->where('user_id', auth()->user()->id)
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10);
            return view('appointments.denied')->with('data', $data); 
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function indexCanceled()
    {
        if(Auth::user()->userType == 'visitor')
        {
            $data = Appointment::where('status', 'Canceled')
                                    ->where('user_id', auth()->user()->id)
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10);
            return view('appointments.canceled')->with('data', $data);   
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    public function cancel(Request $request)
    {
        if(Auth::user()->userType == 'visitor')
        {
            $data = Appointment::find($request->post_id);    

            if($data->status == 'Approved')
            {   
                $data->status = "Canceled";
                $data->save();
                return redirect()->route('myappointments.approved')->with('success', 'Approved Appointment has been successfully cancelled.');
            }

            if($data->status == 'Pending')
            {
                $data->status = "Canceled";
                $data->save();
                return redirect()->route('myappointments.pending')->with('success', 'Pending Appointment has been successfully cancelled.');
            }
            
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
        if(Auth::user()->userType == 'visitor')
        {
            return view('appointments.create');
        }
        else
        {
            return redirect()->route('error.page');
        }
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

        if(Auth::user()->userType == 'visitor')
        {

            $request->validate([
                'user_id' => ['required'],
                'departmentOffice' => ['required'],
                'date' => ['required'],
                'time' => ['required'],
                'purpose' => ['required', 'min:4', 'max: 250'],

            ]);
            $check_appointment = Appointment::where('user_id', auth()->user()->id)->where('status' ,'==', 'Pending')->get();
            foreach($check_appointment as $value)
            {
                $check_appointment_status = $value->status;
            }
            if(Appointment::where('user_id', auth()->user()->id)->where('status', 'Pending')->exists())
            {
                return redirect()->route('appointments.create')
                                    ->with('error', 'Please wait your current application to be approved.');

            }

            elseif(Appointment::where('user_id', auth()->user()->id)->where('status', 'Approved')->exists())
            {
                return redirect()->route('appointments.create')
                                    ->with('error', 'Please wait for the conclusion of your last approved appointment from the respective department');

            }
            else
            {
                $new_appointment = new Appointment();
                $fullName = Auth::user()->fname.' '.Auth::user()->lname;
                $new_appointment->user_id = auth()->user()->id;
                $new_appointment->departmentOffice = request('departmentOffice');
                $new_appointment->date = request('date');
                $new_appointment->time = request('time');
                $new_appointment->purpose = request('purpose');
                $new_appointment->visitant = $fullName;
                $new_appointment->status = 'Pending';
                $new_appointment->save();

                $getDept = Department::where('department_name', request('departmentOffice'))->where('course', 'FACULTY')->get();

                foreach($getDept as $id_dept)
                {
                    $get_id_dept = $id_dept->id;
                }

                $user = User::find(auth()->user()->id);
                $user->department_id = $get_id_dept ;
                $user->save();
                
                return redirect()->route('appointments.create')
                                    ->with('success', 'Appointment has been sent for approval.');
            }

            

        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $appointment = Appointment::find($request->post_id);

        //Check for correct user
        if(auth()->user()->id != $id){
            return redirect()->route('error.page');
        }

        $appointment->delete();

        return redirect('/appointments')->with('success', 'Aappointment successfully delete.');
        
    }

    public function delete(Request $request)
    {
        $appointment = Appointment::find($request->post_id);

        //Check for correct user
        if(auth()->user()->id != $request->user_id){
            return redirect()->route('error.page');
        }

        if($appointment->status == 'Denied')
        {
            $appointment->delete();
            return redirect()->route('myappointments.denied')->with('success', 'Denied Appointment has been successfully deleted.');
        }
        elseif($appointment->status == 'Canceled')
        {
            $appointment->delete();
            return redirect()->route('myappointments.canceled')->with('success', 'Canceled Appointment has been successfully deleted.');
        }
    }


    //====================
    //DEPARTMENT Function
    //====================
    //REJECT APPROVED APPOINTMENT >> DEPARTMENT ACCOUNT SIDE
    public function rejectAppointment(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='department')
        {
            $appointment = Appointment::find($request->post_id);
            $appointment->status = 'Denied';
            $appointment->save();
                
            return redirect()->route('appointment.pending')->with("success", "Appointment has been denied.");
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    //APPROVE APPOINTMENT >> DEPARTMENT ACCOUNT SIDE
    public function approveAppointment(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='department')
        {
            $appointment = Appointment::find($request->post_id);
            $appointment->status = 'Approved';
            $appointment->save();
                
            return redirect()->route('appointment.pending')->with("success", "Appointment has been approved.");
        }
        else
        {
            return redirect()->route('error.page');
        }
    }


    //FAIL APPOINTMENT >> DEPARTMENT ACCOUNT SIDE
    public function failAppointment(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='department')
        {
            $appointment = Appointment::find($request->post_id);
            $appointment->status = 'Failed';
            $appointment->save();
                
            return redirect()->route('appointment.upcoming')->with("success", "Success! Appointment moved to Appointments History.");
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    //CONCLUDE APPOINTMENT >> DEPARTMENT ACCOUNT SIDE
    public function concludeAppointment(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        
        if(Auth::user()->userType =='department')
        {
            $appointment = Appointment::find($request->post_id);
            $appointment->status = 'Concluded';
            $appointment->save();

            $user = User::find($request->user_id);
            $user->department_id = '43';
            $user->save();

            return redirect()->route('appointment.upcoming')->with("success", "Appointment has been concluded");
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

//FOR DELETING APPOINTMENT >> DEPARTMENT ACCOUNT SIDE
    public function remove(Request $request)
    {
        $appointment = Appointment::find($request->post_id);

        if(auth()->user()->email == mb_strtoupper($appointment->departmentOffice))
        {
            if($appointment->status == 'Denied')
            {
                $appointment->delete();
                return redirect()->route('appointment.history')->with('success', 'Denied Appointment has been successfully deleted.');
            }
            elseif($appointment->status == 'Canceled')
            {
                $appointment->delete();
                return redirect()->route('appointment.history')->with('success', 'Canceled Appointment has been successfully deleted.');
            }
        }
        else
        {
            return redirect()->route('error.page');
        }
    }
}
