@section('title', 'UB-S.E.V.M.S. | Verification Link')
@extends('layouts.app')

@section('email-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Email Verification') }}</div>

                <div class="card-body">

                    <div class="alert alert-danger">
                        <strong>Your email is not verified!</strong>
                        <br>
                        Please verify your email address.
                    </div>

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert" id="flash-msg">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                <a class="btn btn-link p-0 m-0 align-baseline">{{ __('Resend Verification Link.') }}</a>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }


    $(document).ready(function(){
        setTimeout(function(){
            $('#flash-msg').hide('fade');
        },4000);
        $('#linkClose').click(function(){
        $('#flash-msg').hide('fade');
        });
    });
</script>

