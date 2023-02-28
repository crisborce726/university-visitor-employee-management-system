@section('title', 'Visitor Profile | UB-S.E.V.M.S.')
@extends('layouts.app')

@section('main-content')
    <div class="container col-md">
        <div class="row justify-content-center">
            <div class="col-md-12">                  

                <h2 class="m-0 font-weight-bold" style="text-align: center;">
                    <b style="color: #bb2124">V I S I T O R &nbsp P E R S O N A L </b> &nbsp D E T A I L S
                </h2>
                <hr style="background-color: #bb2124; height:2px;">
                    <div>
                        @foreach ($lists as $key => $value)

                            <div class="">

                                <div class="row">
                                    <div class="col-md-8 float-right">
                                        @if($value->userType == 'visitor')
                                            <a class="btn btn-primary btn-sm font-weight-bold" href="/visitors"><i class="fas fa-angle-left"></i> BACK</a>
                                        @elseif($value->userType == 'blocklisted')
                                            <a class="btn btn-primary btn-sm font-weight-bold" href="/blacklists"><i class="fas fa-angle-left"></i> BACK</a>
                                        @endif
                                    </div>
                                </div>

                               @if($value->userType == 'visitor' || $value->userType == 'blocklisted')
                                    <div class="form-group row">
                                        <img  name="identification" id="identification" style="width: 30%; height:10%; margin-left: 35%; border-style: solid; border-color: #333; border-width: 3px;" src="/storage/identification/{{$value->identification}}">
                                    </div>

                                    <div  class="text-center mb-2" id="barcode">
                                        {!!$value->barcode!!}
                                    </div>
                                @endif

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

    #barcode
    {
        margin-left: 45%;
        width: 100%;
    }
</style>