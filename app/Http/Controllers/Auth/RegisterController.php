<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;


use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'contactNo' => ['required', 'string', 'max:11', 'min:11'],
            'department_id' => ['nullable'],
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $request = request();
            
        //Handle File Upload

        //How to get a  file name with the Extension
        $filenameWihtExt = $request->file('identification')->getClientOriginalName();
        //Get just the filename
        $filename  = pathinfo($filenameWihtExt, PATHINFO_FILENAME);
        //Get just the extension
        $extension = $request->file('identification')->getClientOriginalExtension();
        //Filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //Upload  the image
        $path = $request->file('identification')->storeAs('public/identification', $fileNameToStore);
        //Storage::disk('public')->putFileAs('identification',$request->file('identification'), $fileNameToStore);

        //Storage::disk('public')->put('identification', $request->file('identification'));
        //php artisan storage:link to link the storage directory into public directoryphp

        $question = $data['question'];
        $answer = ucfirst(strtolower($data['answer']));


       $data = User::create([
            'userType' => 'visitor',
            'fname' => ucfirst(strtolower($data['fname'])),
            'lname' => ucfirst(strtolower($data['lname'])),
            'email' => $data['email'],
            'department_id' => 100,
            'contactNo' => $data['contactNo'],
            'address' => ucfirst(strtolower($data['address'])),
            'password' => Hash::make($data['password']),
            'activity' => 'enabled',
            'status'=> '1',
            'identification' => $fileNameToStore,
            'department_id'=> '43',
        ]);

        Question::create([
            'question' => $question,
            'answer' => $answer,
            'user_id' => $data->id,
        ]);        

        return;
    }
}
