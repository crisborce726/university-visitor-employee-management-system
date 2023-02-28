@section('title', 'UB-S.E.V.M.S. | Change Password')
@extends('layouts.app')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h3 class="m-0 font-weight-bold" style="text-align: center;">
                C H A N G E &nbsp <b style="color: #bb2124">P A S S W O R D </b>
            </h3>
            <hr style="background-color: #bb2124; height:2px;">

            @include('includes.messages')

            <form action="{{ route('passwords.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">

                <div class="form-group row">
                    <label for="oldpassword" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                    <div class="col-md-6">
                        <input id="oldpassword" type="password" class="form-control @error('oldpassword') is-invalid @enderror" name="oldpassword" value="{{ old('oldpassword') }}" required autocomplete="oldpassword" autofocus>

                        @error('oldpassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>
                    

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror" name="password-confirm" value="{{ old('password-confirm') }}" required autocomplete="password-confirm" autofocus>

                        @error('password-confirm')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-danger">
                            <b>{{ __('S A V E') }}</b>
                        </button>
                    </div>
                </div>

                <hr style="background-color: #bb2124; height:1px;">

            </form>



        </div>
    </div>
</div>
@endsection

<script>
    function showHidePassword(){
        var x = document.getElementById("new_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        
        var x = document.getElementById("new_password_confirmation");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        $("#icon").toggleClass("fa-eye fa-eye-slash");
    }
</script>

