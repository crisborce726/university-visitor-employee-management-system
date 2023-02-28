@section('title', 'UB-S.E.V.M.S. | User Profile')
@extends('layouts.app')

@section('main-content')
@foreach($user as $key => $value)
    <div class="container">
        <div class="row">
            <div class="col-md-12">                  

                <h2 class="m-0 font-weight-bold" style="text-align: center;">
                    @if($value->userType == 'visitor')
                        <b style="color: #bb2124">V I S I T O R</b> &nbsp D E T A I L S
                    @endif
                    @if($value->userType == 'employee')
                        <b style="color: #bb2124">E M P L O Y E E</b> &nbsp D E T A I L S
                    @endif
                    @if($value->userType == 'marshall')
                        <b style="color: #bb2124">M A R S H A L L</b> &nbsp D E T A I L S
                    @endif
                    @if($value->userType == 'student')
                        <b style="color: #bb2124">S T U D E N T</b> &nbsp D E T A I L S
                    @endif
                </h2>
                <hr style="background-color: #bb2124; height:2px;">
                    <div>
                        
                        <form  action="#">
                            @CSRF

                            <div class="row">
                                <div class="col-md-4">
                                     <a class="btn btn-primary btn-sm font-weight-bold" href="/users_management"><i class="fas fa-angle-left"></i> BACK</a>
                                </div>
                                <div class="col-md-8">
                                    <div class="float-right">
                                        <!-- @if($value->userType == 'visitor')
                                            <a class="btn btn-info btn-sm font-weight-bold" href="#"><b class="fas fa-history"> </b> View Appointment History</a>
                                        @endif -->
                                    </div>
                                </div>
                            </div>

                            <div class="">

                                
                                <div class="form-group row">
                                    @if($value->userType == 'visitor')
                                        <img class="mb-2"name="identification" id="identification" style="width: 30%; margin-left: 35%" src="/storage/identification/{{$value->identification}}">

                                        <div  class="text-center mb-2" id="barcode">
                                            {!!$value->barcode!!}
                                        </div>
                                    @endif
                                </div>

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

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <strong>Email Address</strong>
                                        <input type="text" name="firstname" class="form-control" value="{{$value->email}}" readonly>
                                    </div>
                                </div>

                                @if($value->userType == 'marshall')
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <strong>Activiy</strong>
                                        <input type="text" name="firstname" class="form-control" value="@php echo ucfirst($value->activity) @endphp" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>last Post</strong>
                                        <input type="text" name="contactNo" class="form-control" value="{{$value->past}}" readonly>
                                    </div>
                                </div>
                                @endif

                               
                            </div>

                        </form>
                        
                    </div>
            </div>
        </div>
    </div>
@endforeach
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

<style>
    #barcode
    {
        margin-left: 45%;
        width: 100%;
    }
</style>