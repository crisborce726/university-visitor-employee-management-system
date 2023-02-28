@section('title', 'Transactions | UB-SEVMS')
@extends('layouts.app')

@section('main-content')
<div class="">
    <div class="">
    <h2 class="m-0 font-weight-bold" style="text-align: center;">
        A L L <b style="color: #bb2124">T R A N S A C T I O N S</b>
    </h2>
        <hr style="background-color: #bb2124; height:2px;">
            
            <div class="container-fluid">

            <h4 style="color: #bb2124"><b>Range Filter</b></h4>
            
            <form action="{{ route('transaction.filter') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="row">
                <div class="col-md-10">
                        <strong>Department</strong>
                        @if($by_deptartment == '')
                            <select style="color: black; width:92%;" class="form-control" id="departmentOffice" name="departmentOffice">
                            @if (old('departmentOffice') != '')
                                <option value="{{old('departmentOffice')}}" selected>{{old('departmentOffice')}}</option>
                            @else
                                <option value="" disabled="" selected="">Select from the provided list.</option>
                            @endif
                                <option value="" disabled>----------School Departments----------</option>
                                <option value="sbaa">School of Business Administration and Accountancy</option>
                                <option value="scjps">School of Criminal Justice and Public Safety</option>
                                <option value="sod">School of Dentistry</option>
                                <option value="sea">School of Engineering and Architecture</option>
                                <option value="sit">School of Information Technology</option>
                                <option value="sihtm">School of International Hospitality and Tourism Management</option>
                                <option value="sol">School of Law</option>
                                <option value="son">School of Nursing</option>
                                <option value="sns">School of Natural Sciences</option>
                                <option value="stela">School of Teacher Education and Liberal Arts</option>
                            </select>&nbsp;
                        @else
                            <select style="color: black; width:92%;" class="form-control" id="departmentOffice" name="departmentOffice">
                                <option selected disabled>{{$by_deptartment}}</option>
                                <option value="" disabled>----------School Departments----------</option>
                                <option value="sbaa">School of Business Administration and Accountancy</option>
                                <option value="scjps">School of Criminal Justice and Public Safety</option>
                                <option value="sod">School of Dentistry</option>
                                <option value="sea">School of Engineering and Architecture</option>
                                <option value="sit">School of Information Technology</option>
                                <option value="sihtm">School of International Hospitality and Tourism Management</option>
                                <option value="sol">School of Law</option>
                                <option value="son">School of Nursing</option>
                                <option value="sns">School of Natural Sciences</option>
                                <option value="stela">School of Teacher Education and Liberal Arts</option>
                            </select>&nbsp;
                        @endif
                </div>
            </div>
            <table>
                <tr class="ml-2">
                    <td>
                        <strong>Date From</strong>
                        @if(($dateFrom == '') && ($dateTo == ''))
                            <input style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateFrom" id="dateFrom" class="form-control">&nbsp;
                        @else
                            <input value="{{$dateFrom}}" style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateFrom" id="dateFrom" class="form-control">&nbsp;
                        @endif
                    </td>
                    <td>
                        <strong>Date To</strong>
                        @if(($dateFrom == '') && ($dateTo == ''))
                            <input  style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateTo" id="dateTo" class="form-control">&nbsp;
                        @else
                            <input value="{{$dateTo}}" style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateTo" id="dateTo" class="form-control">&nbsp;
                        @endif
                    </td>
                    <td>
                        <strong>Time From</strong>
                        @if($timeFrom == '')
                            <select style="width:99%;" class="form-control" name="timeFrom" id="timeFrom">
                                
                                    <option value="" disabled selected>Please Select</option>
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
                                <option selected value="{{$timeFrom}}" disabled>{{$timeFrom}}</option>
                                <option value="" disabled>Please Select</option>
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
                                    <option value="" disabled selected>Please Select</option>
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
                                <option value="{{$timeTo}}" selected disabled>{{$timeTo}}</option>
                                    <option value="" disabled>Please Select</option>
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
                        <strong>Status</strong>
                        @if($status == '')
                            <select style="color: black; width:99%;" class="form-control" id="status" name="status">
                                
                                <option value="" disabled selected>In  / Out</option>
                                <option value="in">In</option>
                                <option value="out">Out</option>
                                
                            </select>&nbsp;
                        @else
                            <select style="color: black; width:99%;" class="form-control" id="status" name="status">
                                <option value="" disabled>In  / Out</option>
                                <option value="{{$status}}" selected>@php echo ucfirst($status); @endphp</option>
                                @if($status == 'in')
                                    <option value="out">Out</option>
                                @else
                                    <option value="out">In</option>
                                @endif

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
                        <a class="btn btn-primary" href="/transactions"><i class="fas fa-redo"></i> <b>R E F R E S H</b></a>
                    </td>
                </tr>
            </table>

            <div class="containers-fluid mt-2">
                <table class="table table-hover table-sm mt-2">
                        <thead class="rounded-top" style="background-color: #bb2124; color: white;">
                            <tr>
                                <th><b>Trans. ID</b></th>
                                <th><b>Date</b></th>
                                <th><b>Time In</b></th>
                                <th><b>Entrance</b></th>
                                <th><b>Department</b></th>
                                <th><b>Time Out</b></th>
                                <th><b>Exit</b></th>
                                <th><b>User ID</b></th>
                                <th><b>Last name</b></th>
                                <th><b>First name</b></th>
                                <th><b>User Type</b></th>
    
                            </tr>
                        </thead>
                        <tbody id="dynamic-row" >
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td><b style="color: #bb2124">{{ $transaction->transID }}</b></td>
                                    <td>{{\Carbon\Carbon::parse($transaction->dateIn)->format('F j, Y')}}</td>
                                    <td>{{ $transaction->timeIn }}</td>
                                    <td>{{ $transaction->entrance }}</td>
                                    <td>
                                        @php
                                            echo strtoupper($transaction->visit_department);
                                        @endphp
                                    </td>
                                    <td>{{ ucfirst($transaction->timeOut) }}</td>
                                    <td>{{ $transaction->ext }}</td>
                                    <td>{{ $transaction->user_id }}</td>
                                    
                                        @php
                                            $full = DB::table('users')->where('id', $transaction->uID)->get();
                                            foreach($full as $name)
                                            {
                                                echo '<td>'.$name->lname.'</td>';
                                                echo '<td>'.$name->fname.'</td>';
                                            }
                                        @endphp
                                    <td>@php echo ucfirst($transaction->userType); @endphp</td>
                                </tr>
                            @endforeach
                            <td colspan="11">{{ $transactions->appends($data)->links() }}</td>
                        </tr>
                        </tbody>
                </table>
                @if(count($transactions) == 0)
                    <h5 class="text-center"> No Record Found.</h5>
                @endif
            </div>
            
</div>
@endsection
            