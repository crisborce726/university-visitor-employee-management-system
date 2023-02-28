@section('title', 'History | UB-SEVMS')
@extends('layouts.app')

@section('main-content')
<div class="">
        <h2 class="m-0 font-weight-bold" style="text-align: center;">
        <b style="color:#bb2124">
           @php echo strtoupper($department); @endphp
        </b>
        </h2>
        <h4 class="m-0 font-weight-bold" style="text-align: center;">
                <b style="color:#bb2124">H I S T O R Y</b>
        </h4>
        <hr style="background-color: #bb2124; height:2px;">

        <div class="row m-2">
            <div class="col">
                <div class="row">
                    <div class="float-left"> 
                        <a class="btn btn-primary btn-sm font-weight-bold" href="/dashboard"><i class="fas fa-angle-left"></i> BACK</a>
                    </div>
                </div>

                <div class="row">
                    <section class="bk-focus">
                        <span id="ct" class="h1">
                            @php
                            date_default_timezone_set('Asia/Manila');
                            echo date("h:i a")
                            @endphp
                        </span> 
                        <span>PHST</span>
                        <p> <span id="ctdat"> @php echo date("F d, Y, l") @endphp</span> </p>
                    </section>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-10">
                <table>
                    <form action="{{ route('history.filter', $department) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <tr class="ml-2">
                        <td>
                            <strong>User Type</strong>
                            @if($usertype == '')
                                <select style="color: black; width:99%;" class="form-control" id="usertype" name="usertype">    
                                    <option value="" disabled selected>Select user type</option>
                                    <option value="student">Students</option>
                                    <option value="employee">Employees</option>
                                    <option value="visitor">Visitors</option>
                                </select>&nbsp;
                            @else
                                <select style="color: black; width:99%;" class="form-control" id="usertype" name="usertype"> 
                                    <option value="" disabled selected>@php echo ucwords($usertype).'s'; @endphp</option>   
                                    <option value="" disabled>Select user type</option>
                                    <option value="student">Students</option>
                                    <option value="employee">Employees</option>
                                    <option value="visitor">Visitors</option>
                                </select>&nbsp;
                            @endif
                        </td>
                        <td>
                            <strong>Date From</strong>
                            @if($dateFrom == '')
                                <input style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateFrom" id="dateFrom" class="form-control">&nbsp;
                            @else
                                <input value="{{$dateFrom}}" style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateFrom" id="dateFrom" class="form-control">&nbsp;
                            @endif
                        </td>
                        <td>
                            <strong>Date To</strong>
                            @if($dateTo == '')
                                <input style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateTo" id="dateTo" class="form-control">&nbsp;
                            @else
                                <input value="{{$dateTo}}" style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateTo" id="dateTo" class="form-control">&nbsp;
                            @endif
                        </td>
                        <td>
                            <strong>Time From</strong>
                            @if($timeFrom == '')
                                <select style="width:99%;" class="form-control" name="timeFrom" id="timeFrom">
                                    <option value="" disabled selected>Please Time</option>
                                        @php
                                            $a = 1;
                                            while($a<=24){
                                                if($a <= 11)
                                                {
                                                    echo '<option value="'.$a.':00:00">' .$a.':00 am</option>';
                                                }
                                                elseif($a <= 24) {
                                                    echo '<option value="'.$a.':00:00">' .$a.':00 pm</option>';
                                                }
                                                
                                            $a++;
                                            }
                                        @endphp
                                </select>&nbsp;
                            @else
                                <select style="width:99%;" class="form-control" name="timeFrom" id="timeFrom">
                                    <option value="" disabled selected>{{$timeFrom}}</option>
                                    <option value="" disabled>Please Time</option>
                                        @php
                                            $a = 1;
                                            while($a<=24){
                                                if($a <= 11)
                                                {
                                                    echo '<option value="'.$a.':00:00">' .$a.':00 am</option>';
                                                }
                                                elseif($a <= 24) {
                                                    echo '<option value="'.$a.':00:00">' .$a.':00 pm</option>';
                                                }
                                                
                                            $a++;
                                            }
                                        @endphp
                                </select>&nbsp;
                            @endif
                        </td>
                        <td>
                            <strong>Time to</strong>
                            @if($timeTo == '')
                                <select style="width:99%;" class="form-control" name="timeTo" id="timeTo">
                                    <option value="" disabled selected>Please Time</option>
                                        @php
                                            $a = 1;
                                            while($a<=24){
                                                if($a <= 11)
                                                {
                                                    echo '<option value="'.$a.':00:00">' .$a.':00 am</option>';
                                                }
                                                elseif($a <= 24) {
                                                    echo '<option value="'.$a.':00:00">' .$a.':00 pm</option>';
                                                }
                                                
                                            $a++;
                                            }
                                        @endphp
                                </select>&nbsp;
                            @else
                                <select style="width:99%;" class="form-control" name="timeTo" id="timeTo">
                                    <option value="" disabled selected>{{$timeTo}}</option>
                                    <option value="" disabled>Please Time</option>
                                        @php
                                            $a = 1;
                                            while($a<=24){
                                                if($a <= 11)
                                                {
                                                    echo '<option value="'.$a.':00:00">' .$a.':00 am</option>';
                                                }
                                                elseif($a <= 24) {
                                                    echo '<option value="'.$a.':00:00">' .$a.':00 pm</option>';
                                                }
                                                
                                            $a++;
                                            }
                                        @endphp
                                </select>&nbsp;
                            @endif
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary"><b class="fas fa-filter"> </b>
                                <b>{{ __('F I L T E R') }}</b>
                            </button>
                        </td>
                        </form>
                        <td>
                            <a class="btn btn-primary" href="/history_list/{{$department}}"><i class="fas fa-redo"></i> <b>R E F R E S H</b></a>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-2 text-right">
                @if($button == 1)
                    <form action="{{ route('history.pdf', $department) }}" target="_blank" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input name="usertype" id="usertype" class="form-control" value="{{$usertype}}" hidden>
                        <input name="dateFrom" id="dateFrom" class="form-control" value="{{$dateFrom}}" hidden>
                        <input name="dateTo" id="dateTo" class="form-control" value="{{$dateTo}}" hidden>
                        <input name="timeFrom" id="timeFrom" class="form-control" value="{{$timeFrom}}" hidden>
                        <input name="timeTo" id="timeTo" class="form-control" value="{{$timeTo}}" hidden>
                        <br/>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-file-pdf"></i>
                        <b>{{ __('Download') }}</b></button>
                    </form>
                @endif
            </div>
        </div>

        <div class="containers-fluid mt-2">
            <table class="table table-hover table-sm mt-2">
                <thead class="rounded-top" style="background-color: #bb2124; color: white;">
                    <tr>
                        <th><b>Trans. ID</b></th>
                        <th><b>Date</b></th>
                        <th><b>Time In</b></th>
                        <th><b>Entrance</b></th>
                        <th><b>Time Out</b></th>
                        <th><b>Exit</b></th>
                        <th><b>User ID</b></th>
                        <th><b>Last name</b></th>
                        <th><b>First name</b></th>
                        <th><b>User type</b></th>
                    </tr>
                </thead>
                <tbody id="dynamic-row" >
                    @foreach ($dataHistory as $key => $value)
                    
                    <tr>
                        <td><b style="color: #bb2124">{{ $value->transID }}</b></td>
                        <td>{{\Carbon\Carbon::parse($value->dateIn)->format('F j, Y')}}</td>
                        <td>{{ $value->timeIn }}</td>
                        <td>{{ $value->entrance }}</td>
                        <td>{{ $value->timeOut }}</td>
                        <td>{{ $value->ext }}</td>
                        <td>{{ $value->user_id }}</td>
                        
                            @php
                                $full = DB::table('users')->where('id', $value->uID)->get();
                                foreach($full as $name)
                                {
                                    echo '<td>'.$name->lname.'</td>';
                                    echo '<td>'.$name->fname.'</td>';
                                }
                            @endphp
                        <td>@php echo ucfirst($value->userType); @endphp</td>
                    </tr>
                    @endforeach
                    
                    
                    <td colspan="10">
                        {{ $dataHistory->appends($data)->links() }}
                    </td>
                </tbody>
            </table>
            @if(count($dataHistory) == 0)
                    <h5 class="text-center"> No Record Found.</h5>
            @endif
        </div>
            
</div>
@endsection