<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Blocklist;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gates;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDF;

class BlocklistController extends Controller
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
    public function index(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $blocklists = DB::table('users')
                        ->join('blocklists', 'blocklists.user_id', '=', 'users.id')
                        ->where('userType', '=', 'blocklisted')
                        ->select('users.*', 'users.id as userID', 'blocklists.*', 'blocklists.id as bID')
                        ->paginate(10);

        $data = $request->all();

        $offenseType = $request->offenseType;
        $dateFrom =  $request->dateFrom;
        $dateTo =  $request->dateTo;

            
            if( $request->filled(['offenseType']) )
            {
                $blocklists = \DB::table('users')
                            ->join('blocklists', 'blocklists.user_id', '=', 'users.id')
                            ->where('userType', '=', 'blocklisted')
                            ->where('blocklists.oType', 'LIKE', '%'.$request->get('offenseType').'%')
                            ->select('users.*', 'users.id as userID', 'blocklists.*', 'blocklists.id as bID')
                            ->paginate(10);
            }
            if( $request->filled(['dateFrom', 'dateTo']) )
            {
                $blocklists =\DB::table('users')
                                ->join('blocklists', 'blocklists.user_id', '=', 'users.id')
                                ->where('userType', '=', 'blocklisted')
                                ->whereBetween(DB::raw('DATE(blocklists.bldate)'), [$dateFrom, $dateTo])
                                ->select('users.*', 'users.id as userID', 'blocklists.*', 'blocklists.id as bID')
                                ->paginate(10);
            }
            if( $request->filled(['offenseType', 'dateFrom', 'dateTo']) )
            {
                $blocklists =\DB::table('users')
                                ->join('blocklists', 'blocklists.user_id', '=', 'users.id')
                                ->where('userType', '=', 'blocklisted')
                                ->where('blocklists.oType', 'LIKE', '%'.$request->get('offenseType').'%')
                                ->whereBetween(DB::raw('DATE(blocklists.bldate)'), [$dateFrom, $dateTo])
                                ->select('users.*', 'users.id as userID', 'blocklists.*', 'blocklists.id as bID')
                                ->paginate(10);
            }

        return view('blocklists.index', compact('blocklists', 'data', 'offenseType', 'dateFrom', 'dateTo'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blocklist  $blocklist
     * @return \Illuminate\Http\Response
     */
    public function show(Blocklist $blocklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blocklist  $blocklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Blocklist $blocklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blocklist  $blocklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blocklist $blocklist)
    {
        date_default_timezone_set('Asia/Manila');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blocklist  $blocklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blocklist $blocklist)
    {
        //
    }
}
