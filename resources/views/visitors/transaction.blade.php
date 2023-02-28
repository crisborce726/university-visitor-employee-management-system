@section('title', 'Visitor Transactions | UB-S.E.V.M.S.')
@extends('layouts.app')

@section('main-content')

<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <h2 class="m-0 font-weight-bold" style="text-align: center;">
                        <b style="color:#bb2124"> V I S I T O R </b> <b> T R A N S A C T I O N S</b>
                </h2>
                <hr style="background-color: #bb2124; height:2px;">
            <br>
            
            <div class="row">
                <div class="col-md-8 float-right">
                    <a class="btn btn-primary btn-sm font-weight-bold" href="/visitors"><i class="fas fa-angle-left"></i> BACK</a>
                </div>
            </div>
            
            <div class="mb-4">
                <strong class="mb-4">Full name:</strong> 
                @foreach ($data as $id)
                    @php
                        $get_name =  DB::table('users')->where('id', $id->user_id)->get();
                        foreach($get_name as $key => $get_fullname)
                        {
                            echo $get_fullname->fname .' '. $get_fullname->lname;
                        }
                    @endphp
                @endforeach
            </div>
            
            <table class="table table-hover table-sm">
                    <thead class="rounded-top" style="background-color: #bb2124; color: white;">
                        <tr>
                            <th><b>ID</b></th>
                            <th><b>Date</b></th>
                            <th><b>Time In</b></th>
                            <th><b>Entrance</b></th>
                            <th><b>Time Out</b></th>
                            <th><b>Exit</b></th>

                        <tr>
                    </thead>
                    @foreach ($data as $key => $value)
                    <tbody id="dynamic-row" >
                        
                            <tr>
                                <td><b style="color: #bb2124">{{ $value->id }}</b></td>
                                <td>{{\Carbon\Carbon::parse($value->dateIn)->format('F j, Y')}}</td>
                                <td>{{ $value->timeIn }}</td>
                                <td>{{ $value->entrance }}</td>
                                <td>{{ ucfirst($value->timeOut) }}</td>
                                <td>{{ $value->ext }}</td>
                                
                            </tr>
                        
                    <td colspan="8"></td>
                    </tr>
                    </tbody>
                    @endforeach
            </table>
            <div class="row justify-content-center">
                @if(count($data)== 0)
                    <div>
                        <h5 class="text-center"> No Record Found.</h5>
                    </div>
                @endif
            </div>
        </div> 
    </div>
</div>


@endsection
