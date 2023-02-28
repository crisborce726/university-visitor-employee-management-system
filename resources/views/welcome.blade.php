<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UB-SEVMS</title> 

    <!-- Scripts -->
    <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"  crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"  crossorigin="anonymous"></script>
    <script src="{{asset('js/popper.min.js')}}"  crossorigin="anonymous"></script>

    <script src="{{asset('js/dataTables.bootstrap.min')}}"  crossorigin="anonymous"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"  crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}"  crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"  crossorigin="anonymous">

    <!-- Fontawesome -->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">

    <script src="{{asset('js/all.js')}}"  crossorigin="anonymous"></script>
    <script src="{{asset('js/all.min.js')}}"  crossorigin="anonymous"></script>

    <!-- Logo -->
    <link rel="icon" href="{{ asset('images/ub_logo.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ asset('images/ub_logo.png') }}" />

    <!-- Sidebar CSS CSS -->
    <link rel="stylesheet" href="{{ asset('css/sidenav.css') }}">



</head>
<!-- Styles -->
<!-- . for class and # for id's-->
<style>
    html, body {
        background-color: black;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    /* .content {
        text-align: center;
    } */

    .title {
        font-size: 84px;
        color:black;
        text-align: center;
        font-family: sans-serif;
    }

    .links > a {
        /* color: #636b6f; */
        color:black;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
        text-align:left;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
    
</style>
<body style="background-image: url('{{ asset('images/bg1.jpg')}}'); background-size: cover">
    <div id="app">
        <div class="main-wrapper">
            <div class="flex-center position-ref full-height">


                <div class="content" style="text-align: center">
                    <div class="title m-b-md sevms">
                        <b>
                            <i class="fas fa-shield-alt"></i> S.E.V.M.S.
                        </b>
                    </div>
        
                    <div class="links">
                        <b class="fas fa-sign-in-alt" style="color: black;"></b><a style="font-size:20px; color: black;" href="{{ route('login') }}">LOGIN</a>
                    </div>
                    <div class="links">
                        <b class="fas fa-user-plus" style="color: black;"></b><a style="font-size:20px; color: black;" href="{{ route('register') }}">SIGN UP</a>
                    </div>
                </div>
        
        
            </div>
        </div>
    </div>
</body>
<footer>
    @guest
        @include('includes.footer')
    @endguest   
</footer>
</html>

<script src="{{asset('js/app.js')}}"></script>

<script>
  
  $('#edit').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 
var archive = button.data('archive')
var modal = $(this)

modal.find('.modal-body #archive').val(archive);
})

$('#editS').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 
var archive = button.data('archive')
var modal = $(this)

modal.find('.modal-body #archive').val(archive);
})

$('#restoref').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 
var archive = button.data('restore')
var modal = $(this)

modal.find('.modal-body #restore').val(archive);
})

$('#restores').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 
var archive = button.data('restore')
var modal = $(this)

modal.find('.modal-body #restore').val(archive);
})


$('#delete').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 

var post_id = button.data('post_id') 
var user_id = button.data('user_id') 
var modal = $(this)

modal.find('.modal-body #post_id').val(post_id);
modal.find('.modal-body #user_id').val(user_id);
})

function displayMessage(message) {
    toastr.success(message, 'Event');            
}




$('#advisoryClass').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 
var archive = button.data('archive')
var modal = $(this)

modal.find('.modal-body #archive').val(archive);
})


</script>

{{-- Style Calendar --}}
<link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">



{{-- Scripts --}}
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/fullcalendar.min.js')}}"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>

