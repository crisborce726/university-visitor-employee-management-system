@section('title', 'Active | UB-SEVMS')
@extends('layouts.app')

@section('main-content')
<div class="">
        <h2 class="m-0 font-weight-bold" style="text-align: center;">
        <b style="color:#bb2124">
           @php echo strtoupper($userType); @endphp
        </b>
        </h2>
        <h4 class="m-0 font-weight-bold" style="text-align: center;">
                <b style="color:#bb2124">A C T I V E &nbsp T R A N S A C T I O N S</b>
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

        <div class="containers-fluid mt-2">
            <table class="table table-hover table-sm mt-2">
                <thead class="rounded-top" style="background-color: #bb2124; color: white;">
                    <tr>
                        <th><b>Trans. ID</b></th>
                        <th><b>Time In</b></th>
                        <th><b>Entrance</b></th>
                        <th><b>User ID</b></th>
                        <th><b>Last name</b></th>
                        <th><b>First name</b></th>
                        <th><b>User type</b></th>

                    </tr>
                </thead>
                <tbody id="dynamic-row" >
                    
                    @foreach ($data as $key => $value)
                        <tr>
                            <td><b style="color: #bb2124">{{ $value->transID }}</b></td>
                            <td>{{ $value->timeIn }}</td>
                            <td>{{ $value->entrance }}</td>
                            <td>{{ $value->uID }}</td>
                            <td>{{ $value->lname }}</td>
                            <td>{{ $value->fname }}</td>
                            <td>@php echo ucfirst($value->userType); @endphp</td>
                        
                        </tr> 
                    @endforeach
                    
                </tbody>
            </table>
            @if(count($data) == 0)
                    <h5 class="text-center"> No Record Found.</h5>
            @endif
            {{ $data->links() }}
        </div>
            
</div>
@endsection
