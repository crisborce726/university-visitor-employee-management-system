<div class="navbar-container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid" id="nav-container">
            @guest
                <a class="navbar-brand"  style="color: #bb2124;"  href="{{ url('/') }}">
                    <b>
                        <i class="fas fa-shield-alt" aria-hidden="true"></i> S.E.V.M.S.
                    </b>
                </a>  
            @endguest
            @if ( (session('verify')) || (session('resent')) )
                @if(empty(Auth::user()->email_verified_at))
                    <a class="navbar-brand"  style="color: #bb2124;"  href="{{ url('/') }}">
                        <b>
                            <i class="fas fa-shield-alt" aria-hidden="true"></i> S.E.V.M.S.
                        </b>
                    </a>  
                @endif
            @endif
        
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                                              
                    </li>
                </ul>
    
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto float-right">
                    <!-- Authentication Links -->
                    @if(!empty(Auth::user()->email_verified_at))
                    <li class="nav-item dropdown">
                        @if(Auth::user()->userType == 'department')
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #cc0000">
                                <b>{{Auth::user()->email}} DEPARTMENT</b>
                            </a>
                        @else
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #cc0000">
                                <b><?php echo ucfirst(strtolower(Auth::user()->fname)) ." ". ucwords(strtolower(Auth::user()->lname)); ?></b>
                            </a>
                        @endif

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if((Auth::user()->userType == 'visitor') || (Auth::user()->userType == 'marshall') || (Auth::user()->userType == 'admin'))
                                <a class="dropdown-item" href="{{ route('profiles.show', Auth::user()->id )}}">
                                    <i class="fas fa-user"></i> My Profile
                                </a>
                            @endif

                            @if(Auth::user()->userType != 'blocklisted')
                                <a class="dropdown-item" href="{{ route('passwords.edit', Auth::user()->id )}}">
                                    <i class="fas fa-key"></i> {{ __('Change Password') }}
                                </a>
                            @endif

                            <div class="dropdown-divider"></div>
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>

    
    <style>
        .dropdown-item:hover{
            background-color: #2574A9;
            width: 100%;
            color: aliceblue;
            box-shadow: 3px 3px 5px 6px rgb(189, 186, 186);
        }
    </style>