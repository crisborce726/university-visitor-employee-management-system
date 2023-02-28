@section('title', 'UB-S.E.V.M.S. | Edit Profile')
@extends('layouts.app')

@section('main-content')
    <div class="container col-md">
        <div class="row justify-content-center">
            <div class="col-md-12">                  

                <h2 class="m-0 font-weight-bold" style="text-align: center;">
                    <b style="color: #bb2124">P E R S O N A L </b> &nbsp D E T A I L S
                </h2>
                <hr style="background-color: #bb2124; height:2px;">
                    <div>
                        @foreach ($data as $key => $value)
                        @if(Auth::user()->userType == 'visitor')
                            <form action="{{ route('question.verify', $value->id) }}" method="GET" enctype="multipart/form-data">
                        @else
                            <form action="{{ route('password.verify', $value->id) }}" method="GET" enctype="multipart/form-data">
                        @endif
                        @CSRF
                            <div class="">

                                @include('includes.messages')
                                
                                @if(Auth::user()->userType == 'visitor')
                                    <div class="form-group row">
                                        <img  name="identification" id="identification" style="width: 30%; height:10%; margin-left: 35%; border-style: solid; border-color: #333; border-width: 3px;" src="/storage/identification/{{$value->identification}}">
                                    </div>
                                @endif

                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <strong>First name</strong>
                                        <input type="text" name="firstname" class="form-control" value="{{$value->fname}}" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Last name</strong>
                                        <input type="text" name="lastname" class="form-control" value="{{$value->lname}}" readonly>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <strong>Address</strong>
                                        @if(Auth::user()->userType == 'visitor')
                                            <input type="text" name="address" class="form-control" value="{{$value->address}}" readonly>
                                        @elseif((Auth::user()->userType == 'marshall') || (Auth::user()->userType == 'admin'))
                                            <input type="text" name="address" class="form-control" value="{{$value->address}}">
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Contact Number</strong>
                                        <input type="text" name="contactNo" class="form-control" value="{{$value->contactNo}}">
                                    </div>
                                </div>
                               
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-danger offset-6 btn-sm"><b class="fas fa-save"> </b> <b>U P D A T E</b></button>
                                </div>
                            </div>

                        </form>
                        @endforeach  
                    </div>
            </div>
        </div>
    </div>
@endsection

<style type="text/css">

input[type=text] {
    border-bottom: 2px solid rgb(0, 0, 0);
    box-shadow: none;
    border: none;
    border-bottom: 1px solid #ced4da;
    -webkit-border-radius: 0;
    border-radius: 0;
    background-color: transparent;
    background-color: white;
}

input[type=text]:read-only {
    border-bottom: 2px solid rgb(0, 0, 0);
    box-shadow: none;
    border: none;
    border-bottom: 1px solid #ced4da;
    border-radius: 10px;
    background-color: transparent;
    background-color: #f0f3f3;
    cursor: not-allowed; /* Cursor change to disabled state*/
  }
</style>