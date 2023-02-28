@section('title', 'UB-S.E.V.M.S. | Register')
@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <h3 class="m-0 font-weight-bold" style="text-align: center;">
                            <b style="color: #bb2124">V I S I T O R</b>&nbsp R E G I S T R A T I O N
                            </h3>
                            <hr style="background-color: #bb2124; height:2px;">
                            <br>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
 
                        <input type="text" value="visitor" name="userType" id="userType" hidden>

                        <input type="text" value="enabled" name="activity" id="activity" hidden>
                        <div class="form-group row">
                            <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="name" autofocus>

                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>

                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contactNo" class="col-md-4 col-form-label text-md-right">{{ __('Contact No.') }}</label>

                            <div class="col-md-6">
                                <input id="contactNo" type="number" class="form-control @error('contactNo') is-invalid @enderror" name="contactNo" minlength="11" maxlength="11" value="{{ old('contactNo') }}" required autocomplete="contactNo">

                                @error('contactNo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- <label>Identification <span class="text-danger">(REQUIRED)</span><i class="required-indicator">*</i></label> -->
                            <label for="identification" class="col-md-4 col-form-label text-md-right">{{ __('Identification Card') }}</label>

                            <div class="col-md-6">
                                <span class="text-danger"><b><i>*Your ID will only be used as a way of verifying your identity when entering the university.</b></i></span><br>
                                <input type="file" id="identification" name="identification" accept=".jpg, .jpeg, .png" required><br>
                                <span style="color:gray">-Government Issued IDs, Driver's License, Passport</span>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Choose Security Question') }}</label>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="question" id="question" required>
                                      <option value="" disabled selected>Please Select</option>
                                      <option value="What is your oldest cousin’s first name?">What is your oldest cousin’s first name?</option>
                                      <option value="In what city or town did your mother and father meet?">In what city or town did your mother and father meet?</option>
                                      <option value="What is the name of your favorite pet?">What is the name of your favorite pet?</option>
                                      <option value="What was your first car?">What was your first car?</option>
                                      <option value="What was your favorite food as a child?">What was your favorite food as a child?</option>
                                      <option value="Where did you meet your spouse?">Where did you meet your spouse?</option>
                                      <option value="What is the name of your first school?">What is the name of your first school?</option>  
                                  </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="answer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>

                            <div class="col-md-6">
                                <input id="answer" type="text" class="form-control @error('answer') is-invalid @enderror" name="answer" value="{{ old('answer') }}" required autocomplete="answer">

                                @error('answer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    <b>
                                        {{ __('R E G I S T E R') }}
                                    </b>
                                </button>
                                <br/>
                                <p>
                                    Already registered? <a href="/login"> Login Here</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
                <hr style="background-color: #bb2124; height:2px;">                     
                <br>
    </div>
</div>
@endsection
