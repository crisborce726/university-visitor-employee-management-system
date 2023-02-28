<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gates;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use PDF;

use App\Models\Report;
use App\Models\User;

class ReportController extends Controller
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

        if(Auth::user()->userType == 'marshall')
        {
            $dateFrom =  $request->dateFrom;
            $dateTo =  $request->dateTo;

            $myReports = DB::table('reports')
                            ->orderBy('id', 'desc')    
                            ->paginate(10);
            $data = $request->all();

            $button = 0;
                
            if ($request->has('dateFrom') && $request->has('dateTo'))
            {
                $myReports = DB::table('reports')
                                ->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo])
                                ->orderBy('id', 'desc')
                                ->paginate(10);

                if(count($myReports) == 0)
                    $button = 0;
                else
                {
                    $button = 1;
                }

            }

            return view('reports.index', compact('myReports', 'button', 'dateFrom', 'dateTo', 'data'));
        }
        else
        {
            return redirect()->route('error.page');
        }

    }


    public function pdfFilter(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        
        if(Auth::user()->userType == 'marshall')
        {

            $dateFrom =  $request->dateFrom;
            $dateTo =  $request->dateTo;
            $data = $request->all();

            if ($request->filled('dateFrom') && $request->filled('dateTo'))
            {
                $data = DB::table('reports')
                                ->whereBetween(DB::raw('DATE(created_at)'), [$dateFrom, $dateTo])
                                ->orderBy('id', 'desc')
                                ->paginate(10);

            }

            $pdf = PDF::loadView('reports.report', compact('data', 'dateFrom', 'dateTo'))->setPaper('legal','landscape');
            return $pdf->stream(Carbon::parse($dateFrom)->format('F j, Y').'-'.Carbon::parse($dateTo)->format('F j, Y').'.pdf');
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
        
        if(Auth::user()->userType == 'marshall')
        {
            $request->validate([
                'areasOfConcern' => ['required', 'max: 250'],
                'status' => ['required', 'max: 250'],
                'actionTaken' => ['required', 'max: 250'],
                'remarks' => ['required', 'max: 250'],

            ]);

            $report = new Report();
            $report->user_id = auth()->user()->id;
            $report->areasOfConcern = request('areasOfConcern');
            $report->status = request('status');
            $report->actionTaken = request('actionTaken');
            $report->remarks = request('remarks');

            $report->save();
            return redirect('/reports')->with('success', 'Report has been saved.');
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
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');

        if(Auth::user()->userType =='marshall')
        {

            $request->validate([
                'areasOfConcern' => 'required',
                'post_status' => 'required',
                'post_action' => 'required',
                'post_remark' => 'required',
            ]);

            $report = Report::find($request->post_id);
            $report->areasOfConcern = $request->get('areasOfConcern');
            $report->status = $request->get('post_status');
            $report->actionTaken = $request->get('post_action');
            $report->remarks = $request->get('post_remark');
            $report->save();
                
            return redirect('/reports')->with('success', 'Report has been updated.');
        }
        else
        {
            return redirect()->route('error.page');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    
        $report = Report::find($request->post_id);
        $report->delete();

        return redirect('/reports')->with('success', 'Report has been deleted.');
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
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

}
