@section('title', 'UB-S.E.V.M.S. | Login')
@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div><br>
                <h3 class="m-0 font-weight-bold" style="text-align: center;">
                    <b style="color: #bb2124">L O G I N</b>
                </h3>
                    <hr style="background-color: #bb2124; height:2px;">

                <div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email address') }}</label>

                            <div class="col-md-6">
                                <input id="login" type="text" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="login" value="{{ old('username') ?: old('email') }}" required autofocus>

                                @if ($errors->has('username') || $errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        </div>
                
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                    
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                    
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary"><b class="fas fa-sign-in-alt"> </b>
                                    <b>{{ __('L O G I N') }}</b>
                                </button>

                                <p>
                                    No registration yet? <a href="/register"> Sign up</a>
                                </p>
                            </div>
                        </div>
                    </form>
                    <hr style="background-color: #bb2124; height:2px;">
                <br>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
    $("#submitbuttonreview").on("click", function(event) {
        event.preventDefault();
    
        var validateElements = document.getElementsByClassName("validate");
        var inputs = Array.prototype.filter.call(validateElements,function(element){
          return element.nodeName === 'INPUT';
        });
        var val_input_error = 0;
        for(var i=0; i < inputs.length; i ++ ){
            var input = inputs[i];
            if(input.value.length == 0){
                input.classList.add("err");
                input.focus();
                val_input_error++;
            }
        }
        if ($('input[name=gender]:checked').length <= 0) {
            val_input_error++;          
            $("#gender-error").show();
            $("#rathernot").focus();
        }
        else {          
            $("#gender-error").hide();
        }
        
        check_phone();
    
        var password_check_same = $('#password').val();
        var confirm_password_check_same = $('#confirm-password').val();
        if(password_check_same != confirm_password_check_same){
          Swal.fire('Error!','Please enter the same password!' ,'error');
          $('#submitbutton').prop('disabled', true);
          return false;
        }
    
    
        if(val_input_error == 0){
          $('#reviewmodal').modal('show');
          $('#mr-phone').text($('#confirm-phone').val());
          $('#mr-pass').val($('#password').val());
          $('#mr-fname').text($('#first_name').val());
          $('#mr-lname').text($('#last_name').val());
          $('#mr-mname').text($('#middle_name').val());
          $('#mr-suffix').text($('#suffix').val());
          $('#mr-sex').text($('[name="gender"]:checked').val());
          $('#mr-email').text($('#email').val());
          $('#mr-age').text($('#age').val());
          $('#mr-client').text($('#occupation').val());
          var mrregion = $( "#region option:selected" ).text();
          var mrprovince = $( "#province option:selected" ).text();
          var mrcity = $( "#muncity option:selected" ).text();
          var mrbrg = $('#brgy_line').val(); 
          $('#mr-add').text(mrregion+' '+mrprovince+' '+mrcity+' '+mrbrg);
        }
    
    });
    </script>
    
