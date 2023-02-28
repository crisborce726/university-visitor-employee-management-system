<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title> 

    <!-- Scripts -->
    <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"  crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"  crossorigin="anonymous"></script>
    <script src="{{asset('js/popper.min.js')}}"  crossorigin="anonymous"></script>
    <script src="{{asset('js/popper.min.js')}}"  crossorigin="anonymous"></script>

    <script src="{{asset('js/dataTables.bootstrap.min')}}"  crossorigin="anonymous"></script>
    <script src="{{asset('js/jquery.min.js')}}"  crossorigin="anonymous"></script>

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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            
            @include('includes.navbar')

            
            <div class="wrapper">
                @if(Auth::guest())
                    @yield('main')
                @endif
                @guest
                    @yield('error')
                @endguest

            @if(Auth::user())
                <div class="sidebar-wrapper">
                    @if(!empty(Auth::user()->email_verified_at))
                        @if(Auth::user()->userType != 'blocklisted')
                            @include('includes.sidenav')
                        @endif
                    @endif
                </div>
                <div class="email-content-container mt-2">
                    <div class="container-fluid">
                        <!-- Main component for a primary marketing message or call to action -->
                        
                            @yield('email-content')
                        
                    </div>
                </div>
                <div class="content-container">
                    <div class="container-fluid">
                        <!-- Main component for a primary marketing message or call to action -->
                        
                            @yield('main-content')
                        
                    </div>
                </div>
                <div class="content-container blockPage">
                    <div class="container-fluid">
                        <!-- Main component for a primary marketing message or call to action -->
                        
                            @yield('block')
                        
                    </div>
                </div>
            </div>
            @endif
            
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

    window.history.forward();
    function noBack()
    {
        window.history.forward();
    }
  



$('#QnA').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 

var post_id = button.data('post_id') 
var user_id = button.data('user_id') 
var modal = $(this)

modal.find('.modal-body #post_id').val(post_id);
modal.find('.modal-body #user_id').val(user_id);
})

$('#enable').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 

var post_id = button.data('post_id') 
var user_id = button.data('user_id') 
var modal = $(this)

modal.find('.modal-body #post_id').val(post_id);
modal.find('.modal-body #user_id').val(user_id);
})

$('#delete').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 

var post_id = button.data('post_id') 
var user_id = button.data('user_id') 
var modal = $(this)

modal.find('.modal-body #post_id').val(post_id);
modal.find('.modal-body #user_id').val(user_id);
})

$('#cancel').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 

var post_id = button.data('post_id') 
var user_id = button.data('user_id') 
var modal = $(this)

modal.find('.modal-body #post_id').val(post_id);
modal.find('.modal-body #user_id').val(user_id);
})

$('#reset').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 

var dept = button.data('dept') 
var user_id = button.data('user_id') 
var modal = $(this)

modal.find('.modal-body #dept').val(dept);
modal.find('.modal-body #user_id').val(user_id);
})

function displayMessage(message) {
    toastr.success(message, 'Event');            
}

$('#approve').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 

var post_id = button.data('post_id') 
var user_id = button.data('user_id') 
var modal = $(this)

modal.find('.modal-body #post_id').val(post_id);
modal.find('.modal-body #user_id').val(user_id);
})


$('#editReport').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 

var post_id = button.data('post_id') 
var post_status = button.data('post_status') 
var post_action = button.data('post_action') 
var post_remark = button.data('post_remark') 
var user_id = button.data('user_id') 
var modal = $(this)

modal.find('.modal-body #post_id').val(post_id);
modal.find('.modal-body #post_status').val(post_status);
modal.find('.modal-body #post_action').val(post_action);
modal.find('.modal-body #post_remark').val(post_remark);
modal.find('.modal-body #user_id').val(user_id);
})



$('#details').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 

var post_id = button.data('post_id') 
var user_offense = button.data('user_offense') 
var user_desc = button.data('user_desc') 
var user_bl = button.data('user_bl')  
var modal = $(this)

modal.find('.modal-body #post_id').val(post_id);
modal.find('.modal-body #user_offense').val(user_offense);
modal.find('.modal-body #user_desc').val(user_desc);
modal.find('.modal-body #user_bl').val(user_bl);
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
