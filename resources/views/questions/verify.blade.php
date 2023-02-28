@section('title', 'UB-S.E.V.M.S. | Security Question')
@extends('layouts.app')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <h5>
                            {{ __('Security Question') }}
                        </h5>
                    </strong>
                </div>

                <div class="card-body">

                    <div class="alert alert-danger">
                        <strong>Please enter your answer to verify!</strong>
                        <br>
                    </div>

                    @include('includes.messages')
                    
                    <form class="d-inline" method="POST" action="{{ route('profiles.update', Auth::user()->id) }}">
                        @csrf
                        @method('PUT') 

                        
                        <?php
                        $QnA = DB::table('questions')->where('user_id', Auth::user()->id)->get();
                        foreach($QnA as $question)
                        {
                            echo $question->question;
                        }
                        echo '<input type="hidden" name="contactNo" id="contactNo" value="'. $_GET['contactNo'] .'">';
                        ?>
                        

                        <input type="text" name="verify_answer" id="verify_answer" class="form-control mt-2 mb-2" value="" required>

                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-danger">
                                <a class="btn btn-link p-0 m-0 align-baseline">{{ __('Confirm Answer.') }}</a>
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

