@section('title', 'Pending Lists | UB-SEVMS')
@extends('layouts.app')

@section('main-content')
<div class="">
        <h2 class="m-0 font-weight-bold" style="text-align: center;">
        <b style="color:#bb2124">
                L I S T S
        </b>
        </h2>
        <h4 class="m-0 font-weight-bold" style="text-align: center;">

                <b style="color:#bb2124">
                    P E N D I N G &nbsp T R A N S A C T I O N S</b>
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

        <table>
            <form action="{{ route('indexFilter.listPending') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <tr>
                <input name="page" id="page" class="form-control" value="pendingList" hidden>
            </tr>
            <tr class="ml-2">
                <td>
                    <td>
                        <strong>User type</strong>
                        <select style="color: black; width:99%;" class="form-control" id="usertype" name="usertype">    
                            <option value="" disabled selected>Please Select</option>
                            <option value="student">Student</option>
                            <option value="employee">Employee</option>
                            <option value="visitor">Visitor</option>
                        </select>&nbsp;
                    <td>
                    <strong>Department</strong>
                    <select style="color: black; width:99%;" class="form-control" id="departmentOffice" name="departmentOffice">
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
                  
                </td>
                <td>
                    <strong>Time From</strong>
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
                </td>
                <td>
                    <strong>Time to</strong>
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
                </td>
                <td>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-eye"> </i>F I L T E R</button>
                </td>
                </form>
                <td>
                    <a class="btn btn-primary" href="/pending/lists"><i class="fas fa-redo"></i> <b>R E F R E S H</b></a>
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
                        <th><b>User ID</b></th>
                        <th><b>Last name</b></th>
                        <th><b>First name</b></th>
                        <th><b>User type</b></th>

                    </tr>
                </thead>
                <tbody id="dynamic-row" >
                    @foreach ($pendingData as $key => $value)
                        <tr>
                            <td><b style="color: #bb2124">{{ $value->transID }}</b></td>
                            <td>{{\Carbon\Carbon::parse($value->dateIn)->format('F j, Y')}}</td>
                            <td>{{ $value->timeIn }}</td>
                            <td>{{ $value->entrance }}</td>
                            <td>
                                @php
                                    echo strtoupper($value->visit_department);
                                @endphp
                            </td>
                            <td>{{ $value->uID }}</td>
                            <td>{{ $value->lname }}</td>
                            <td>{{ $value->fname }}</td>
                            <td>@php echo ucfirst($value->userType); @endphp</td>
                        
                        </tr>
                    @endforeach
                    <td colspan="9">
                        {{ $pendingData->appends($data)->links() }}
                    </td>
                    
                </tbody>
            </table>
            @if(count($pendingData) == 0)
            <h5 class="text-center"> No Record Found.</h5>
            @endif
            
            </div>
            
</div>
@endsection