@section('title', 'UB-S.E.V.M.S. | My Profile')
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
                        <form  action="{{ route('profiles.edit', $value->id) }}">
                            @CSRF

                            <div class="text-right">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-user-edit"></i> <b>E D I T</b></button>
                            </div>


                            <div class="">

                                @if(Auth::user()->userType == 'visitor')
                                    <div class="form-group row">
                                        <img  name="identification" id="identification" style="width: 30%; height:10%; margin-left: 35%; border-style: solid; border-color: #333; border-width: 3px;" src="/storage/identification/{{$value->identification}}">
                                    </div>
                                @endif

                                @include('includes.messages')

                                <input type="text" name="user_id" value="{{ $value->id }}" hidden>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <strong>First name</strong>
                                        <input type="text" name="firstname" class="form-control" value="{{$value->fname}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Last name</strong>
                                        <input type="text" name="lastname" class="form-control" value="{{$value->lname}}" readonly>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <strong>Address</strong>
                                        <input type="text" name="firstname" class="form-control" value="{{$value->address}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Contact Number</strong>
                                        <input type="text" name="contactNo" class="form-control" value="{{$value->contactNo}}" readonly>
                                    </div>
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