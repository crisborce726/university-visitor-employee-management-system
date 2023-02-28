  @section('title', 'Monitoring Page | UB-SEVMS')
  @extends('layouts.app')

  @section('main-content')

  <div id="refresh">
    <div id="time">
      <section class="bk-focus">
        <span id="ct" class="h1">
          @php
            date_default_timezone_set('Asia/Manila');
            echo date("h:i:s a")
          @endphp
        </span> 
        <span>PHST</span>
        <p> <span id="ctdat"> @php echo date("F d, Y, l") @endphp</span> </p>
    </section>
    </div>
  </div>

  <h2 class="m-0 font-weight-bold" style="text-align: center;">
    S C H O O L &nbsp D E P A R T M E N T S
  </h2>
  
  <hr style="background-color: #bb2124; height:2px;">

<!-- refreshDiv -->
<div id="refreshDiv">
  <div id="dashDiv">

    <!-- ROW  -->
    <div class="row justify-content-center my-2">
        
      <!-- STUDENTS -->
      <div class="col-md-3">
          <div class="card bg-warning text-center card-info">
              <div class="card-block">
                  <h4 class="card-title text-white">STUDENTS</h4>
              </div>
              <div class="row m-2 no-gutters rounded">
                <div class="col">
                    <div class="card card-block text-info">
                      <h3><i class="fas fa-users fa-2x"></i></h3>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-block text-info pb-1">
                      @if($students == '0')
                        <h3>{{$students}}</h3>
                      @else
                        <h3><b><a class="text-red">{{$students}}</a></b></h3>
                      @endif
                      <span class="small text-uppercase">total</span>
                    </div>
                </div>
              </div>
              <div class="card-footer">
                  <a class="text-black text-center" href="{{route('index.listStudent')}}">View <i class="fas fa-list-ol"></i></a>
              </div>
          </div>
      </div>
      <!-- END STUDENTS -->

      <!-- EMPLOYEES -->
      <div class="col-md-3">
        <div class="card bg-warning text-center card-info">
            <div class="card-block">
                <h4 class="card-title text-white">EMPLOYEES</h4>
            </div>
            <div class="row m-2 no-gutters rounded">
              <div class="col">
                <div class="card card-block text-info">
                  <h3><i class="fas fa-users fa-2x"></i></h3>
                </div>
            </div>
            <div class="col">
                <div class="card card-block text-info pb-1">
                  @if($employees == '0')
                    <h3>{{$employees}}</h3>
                  @else
                    <h3><b><a class="text-red">{{$employees}}</a></b></h3>
                  @endif
                  <span class="small text-uppercase">total</span>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a class="text-black text-center" href="{{route('index.listEmployee')}}">View <i class="fas fa-list-ol"></i></a>
            </div>
        </div>
      </div>
      <!-- END EMPLOYEES -->

      <!-- VISITORS -->
      <div class="col-md-3">
        <div class="card bg-warning text-center card-info">
            <div class="card-block">
                <h4 class="card-title text-white">VISITORS</h4>
            </div>
            <div class="row m-2 no-gutters rounded">
              <div class="col">
                <div class="card card-block text-info">
                  <h3><i class="fas fa-users fa-2x"></i></h3>
                </div>
              </div>
              <div class="col">
                <div class="card card-block text-info pb-1">
                  @if($visitors == '0')
                    <h3>{{$visitors}}</h3>
                  @else
                    <h3><b><a class="text-red">{{$visitors}}</a></b></h3>
                  @endif
                  <span class="small text-uppercase">total</span>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a class="text-black text-center" href="{{route('index.listVisitor')}}">View <i class="fas fa-list-ol"></i></a>
            </div>
        </div>
      </div>
      <!-- END VISITORS -->

      <!-- PENDING -->
      <div class="col-md-3">
        <div class="card bg-warning text-center card-info">
            <div class="card-block">
                <h4 class="card-title text-white">PENDING</h4>
            </div>
            <div class="row m-2 no-gutters rounded">
                <div class="col">
                  <div class="card card-block text-info pb-1">
                    @if($pending == '0')
                      <h3>{{$pending}}</h3>
                    @else
                      <h3><b><a class="text-red">{{$pending}}</a></b></h3>
                    @endif
                    <span class="small text-uppercase">total</span>
                  </div>
                </div>
                <div class="col">
                  <div class="card card-block text-info">
                    <h3><i class="fas fa-users fa-2x"></i></h3>
                  </div>
                </div>
                <div class="col">
                <div class="card card-block text-info pb-1">
                  @if($pendingToday == '0')
                    <h3>{{$pendingToday}}</h3>
                  @else
                    <h3><b><a class="text-red">{{$pendingToday}}</a></b></h3>
                  @endif
                  <span class="small text-uppercase">total</span>
                </div>
                </div>
              </div>
              <div class="card-footer">
                
                <a class="text-black float-left" href="{{route('index.listPendingHistory')}}"><i class="fas fa-history"></i> History</a>
              
                <a class="text-black float-right" href="{{route('index.listPending')}}">View <i class="fas fa-list-ol"></i></a>
              </div>
        </div>
      </div>
      <!-- END PENDING -->
        
    </div>
    <!--  ROW END -->

    <hr style="background-color: #bb2124; height:1px;">

    <!-- 1 ROW DEPT -->
    <div class="row justify-content-center my-2">
      
      <!-- SBAA -->
      <div class="col-md-3">
          <div class="card bg-warning text-center card-info">
              <div class="card-block">
                  <h4 class="card-title text-white">SBAA</h4>
                  <h4><i class="fas fa-university fa-2x"></i></h4>
              </div>
              <div class="row m-2 no-gutters rounded">
                  <div class="col">
                      <div class="card card-block text-info rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                        @if($sbaaIN == '0')
                          {{$sbaaIN}}
                        @else
                          <b><a class="text-red">{{$sbaaIN}}</a></b>
                        @endif
                          <span class="small text-uppercase">in</span>
                      </div>
                  </div>
                  <div class="col">
                      <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                        @if($sbaaOUT == '0')
                          {{$sbaaOUT}}
                        @else
                          <b><a class="text-red">{{$sbaaOUT}}</a></b>
                        @endif
                          <span class="small text-uppercase">out</span>
                      </div>
                  </div>
                  <div class="col">
                    <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                      @if($sbaaPEN == '0')
                        {{$sbaaPEN}}
                      @else
                        <b><a class="text-red">{{$sbaaPEN}}</a></b>
                      @endif
                        <span class="small text-uppercase">pending</span>
                    </div>
                </div>
              </div>
            <div class="card-footer">

              <a class="text-black float-left" href="{{route('history.list', 'sbaa')}}"><i class="fas fa-history"></i> History</a>
              
              <a class="text-black float-right" href="{{route('active.list', 'sbaa')}}">View <i class="fas fa-list-ol"></i></a>
            </div>
          </div>
      </div>

      <!-- SCJPS -->
      <div class="col-md-3">
        <div class="card bg-warning text-center card-info">
            <div class="card-block">
                <h4 class="card-title text-white">SCJPS</h4>
                <h4><i class="fas fa-building fa-2x"></i></h4>
            </div>
            <div class="row m-2 no-gutters rounded">
              <div class="col">
                  <div class="card card-block text-info rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                    @if($scjpsIN == '0')
                      {{$scjpsIN}}
                    @else
                      <b><a class="text-red">{{$scjpsIN}}</a></b>
                    @endif
                      <span class="small text-uppercase">in</span>
                  </div>
              </div>
              <div class="col">
                  <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                    @if($scjpsOUT == '0')
                      {{$scjpsOUT}}
                    @else
                      <b><a class="text-red">{{$scjpsOUT}}</a></b>
                    @endif
                      <span class="small text-uppercase">out</span>
                  </div>
              </div>
              <div class="col">
                <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                    @if($scjpsPEN == '0')
                      {{$scjpsPEN}}
                    @else
                      <b><a class="text-red">{{$scjpsPEN}}</a></b>
                    @endif
                    <span class="small text-uppercase">pending</span>
                </div>
            </div>
          </div>
          <div class="card-footer">
            <a class="text-black float-left" href="{{route('history.list', 'scjps')}}"><i class="fas fa-history"></i> History</a>
            <a class="text-black float-right" href="{{route('active.list', 'scjps')}}">View <i class="fas fa-list-ol"></i></a>
          </div>
        </div>
      </div>

      <!-- SEA -->
      <div class="col-md-3">
        <div class="card bg-warning text-center card-info">
            <div class="card-block">
                <h4 class="card-title text-white">SEA</h4>
                <h4><i class="fas fa-landmark fa-2x"></i></h4>
            </div>
            <div class="row m-2 no-gutters rounded">
              <div class="col">
                  <div class="card card-block text-info rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                    @if($seaIN == '0')
                      {{$seaIN}}
                    @else
                      <b><a class="text-red">{{$seaIN}}</a></b>
                    @endif
                      <span class="small text-uppercase">in</span>
                  </div>
              </div>
              <div class="col">
                  <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                    @if($seaOUT == '0')
                      {{$seaOUT}}
                    @else
                      <b><a class="text-red">{{$seaOUT}}</a></b>
                    @endif
                      <span class="small text-uppercase">out</span>
                  </div>
              </div>
              <div class="col">
                <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                    @if($seaPEN == '0')
                      {{$seaPEN}}
                    @else
                      <b><a class="text-red">{{$seaPEN}}</a></b>
                    @endif
                    <span class="small text-uppercase">pending</span>
                </div>
            </div>
          </div>
          <div class="card-footer">
            <a class="text-black float-left" href="{{route('history.list', 'sea')}}"><i class="fas fa-history"></i> History</a>
            <a class="text-black float-right" href="{{route('active.list', 'sea')}}">View <i class="fas fa-list-ol"></i></a>
          </div>
        </div>
      </div>

      <!-- SIHTM -->
      <div class="col-md-3">
        <div class="card bg-warning text-center card-info">
          <div class="card-block">
              <h4 class="card-title text-white">SIHTM</h4>
              <h4><i class="fas fa-hotel fa-2x"></i></h4>
          </div>
          <div class="row m-2 no-gutters rounded">
            <div class="col">
                <div class="card card-block text-info rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                    @if($sihtmIN == '0')
                      {{$sihtmIN}}
                    @else
                      <b><a class="text-red">{{$sihtmIN}}</a></b>
                    @endif
                      <span class="small text-uppercase">in</span>
                  </div>
              </div>
              <div class="col">
                  <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                    @if($sihtmOUT == '0')
                      {{$sihtmOUT}}
                    @else
                      <b><a class="text-red">{{$sihtmOUT}}</a></b>
                    @endif
                    <span class="small text-uppercase">out</span>
                </div>
            </div>
            <div class="col">
              <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                    @if($sihtmPEN == '0')
                      {{$sihtmPEN}}
                    @else
                      <b><a class="text-red">{{$sihtmPEN}}</a></b>
                    @endif
                  <span class="small text-uppercase">pending</span>
              </div>
          </div>
        </div>
        <div class="card-footer">
          <a class="text-black float-left" href="{{route('history.list', 'sihtm')}}"><i class="fas fa-history"></i> History</a>
          <a class="text-black float-right" href="{{route('active.list', 'sihtm')}}">View <i class="fas fa-list-ol"></i></a>
        </div>
        </div>
      </div>
        
    </div>
    <!-- 1 ROW DEPT END -->


    <!-- 2 ROW DEPT -->
    <div class="row justify-content-center my-2">
      
      <!-- SIT -->
      <div class="col-md-3">
          <div class="card bg-warning text-center card-info">
              <div class="card-block">
                  <h4 class="card-title text-white">SIT</h4>
                  <h4><i class="fas fa-building fa-2x"></i></h4>
              </div>
              <div class="row m-2 no-gutters rounded">
                  <div class="col">
                      <div class="card card-block text-info rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                        @if($sitIN == '0')
                          {{$sitIN}}
                        @else
                          <b><a class="text-red">{{$sitIN}}</a></b>
                        @endif
                        <span class="small text-uppercase">in</span>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                        @if($sitOUT == '0')
                          {{$sitOUT}}
                        @else
                          <b><a class="text-red">{{$sitOUT}}</a></b>
                        @endif
                          <span class="small text-uppercase">out</span>
                      </div>
                  </div>
                  <div class="col">
                    <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                      @if($sitPEN == '0')
                        {{$sitPEN}}
                      @else
                        <b><a class="text-red">{{$sitPEN}}</a></b>
                      @endif
                        <span class="small text-uppercase">pending</span>
                    </div>
                </div>
              </div>
              <div class="card-footer">
                <a class="text-black float-left" href="{{route('history.list', 'sit')}}"><i class="fas fa-history"></i> History</a>
                <a class="text-black float-right" href="{{route('active.list', 'sit')}}">View <i class="fas fa-list-ol"></i></a>
              </div>
          </div>
      </div>

      <!-- SoD -->
      <div class="col-md-3">
        <div class="card bg-warning text-center card-info">
            <div class="card-block">
                <h4 class="card-title text-white">SoD</h4>
                <h4><i class="fas fa-school fa-2x"></i></h4>
            </div>
            <div class="row m-2 no-gutters rounded">
              <div class="col">
                  <div class="card card-block text-info rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                      @if($sodIN == '0')
                        {{$sodIN}}
                      @else
                        <b><a class="text-red">{{$sodIN}}</a></b>
                      @endif
                      <span class="small text-uppercase">in</span>
                  </div>
              </div>
              <div class="col">
                  <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                      @if($sodOUT == '0')
                        {{$sodOUT}}
                      @else
                        <b><a class="text-red">{{$sodOUT}}</a></b>
                      @endif
                      <span class="small text-uppercase">out</span>
                  </div>
              </div>
              <div class="col">
                <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                      @if($sodPEN == '0')
                        {{$sodPEN}}
                      @else
                        <b><a class="text-red">{{$sodPEN}}</a></b>
                      @endif
                    <span class="small text-uppercase">pending</span>
                </div>
            </div>
          </div>
          <div class="card-footer">
            <a class="text-black float-left" href="{{route('history.list', 'sod')}}"><i class="fas fa-history"></i> History</a>
            <a class="text-black float-right" href="{{route('active.list', 'sod')}}">View <i class="fas fa-list-ol"></i></a>
          </div>
        </div>
      </div>

      <!-- SoL -->
      <div class="col-md-3">
        <div class="card bg-warning text-center card-info">
            <div class="card-block">
                <h4 class="card-title text-white">SoL</h4>
                <h4><i class="fas fa-clinic-medical fa-2x"></i></h4>
            </div>
            <div class="row m-2 no-gutters rounded">
              <div class="col">
                  <div class="card card-block text-info rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                      @if($solIN == '0')
                        {{$solIN}}
                      @else
                        <b><a class="text-red">{{$solIN}}</a></b>
                      @endif
                      <span class="small text-uppercase">in</span>
                  </div>
              </div>
              <div class="col">
                  <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                      @if($solOUT == '0')
                        {{$solOUT}}
                      @else
                        <b><a class="text-red">{{$solOUT}}</a></b>
                      @endif
                      <span class="small text-uppercase">out</span>
                  </div>
              </div>
              <div class="col">
                <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                      @if($solPEN == '0')
                        {{$solPEN}}
                      @else
                        <b><a class="text-red">{{$solPEN}}</a></b>
                      @endif
                    <span class="small text-uppercase">pending</span>
                </div>
            </div>
          </div>
          <div class="card-footer">
            <a class="text-black float-left" href="{{route('history.list', 'sol')}}"><i class="fas fa-history"></i> History</a>
            <a class="text-black float-right" href="{{route('active.list', 'sol')}}">View <i class="fas fa-list-ol"></i></a>
          </div>
        </div>
      </div>

      <!-- SoN -->
      <div class="col-md-3">
        <div class="card bg-warning text-center card-info">
          <div class="card-block">
              <h4 class="card-title text-white">SoN</h4>
              <h4><i class="fas fa-hospital fa-2x"></i></h4>
          </div>
          <div class="row m-2 no-gutters rounded">
            <div class="col">
                <div class="card card-block text-info rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                      @if($sonIN == '0')
                        {{$sonIN}}
                      @else
                        <b><a class="text-red">{{$sonIN}}</a></b>
                      @endif
                      <span class="small text-uppercase">in</span>
                  </div>
              </div>
              <div class="col">
                  <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                      @if($sonOUT == '0')
                        {{$sonOUT}}
                      @else
                        <b><a class="text-red">{{$sonOUT}}</a></b>
                      @endif
                    <span class="small text-uppercase">out</span>
                </div>
            </div>
            <div class="col">
              <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                      @if($sonPEN == '0')
                        {{$sonPEN}}
                      @else
                        <b><a class="text-red">{{$sonPEN}}</a></b>
                      @endif
                  <span class="small text-uppercase">pending</span>
              </div>
          </div>
        </div>
        <div class="card-footer">
          <a class="text-black float-left" href="{{route('history.list', 'son')}}"><i class="fas fa-history"></i> History</a>
          <a class="text-black float-right" href="{{route('active.list', 'son')}}">View <i class="fas fa-list-ol"></i></a>
        </div>
        </div>
      </div>
        
    </div>
    <!-- 2 ROW DEPT END -->

    <!-- 3 ROW DEPT -->
    <div class="row justify-content-center my-2">
      
      <!-- SNS -->
      <div class="col-md-3">
          <div class="card bg-warning text-center card-info">
              <div class="card-block">
                  <h4 class="card-title text-white">SNS</h4>
                  <h4><i class="fas fa-hospital fa-2x"></i></h4>
              </div>
              <div class="row m-2 no-gutters rounded">
                  <div class="col">
                      <div class="card card-block text-info rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                        @if($snsIN == '0')
                          {{$snsIN}}
                        @else
                          <b><a class="text-red">{{$snsIN}}</a></b>
                        @endif
                      <span class="small text-uppercase">in</span>
                  </div>
              </div>
              <div class="col">
                  <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                        @if($snsOUT == '0')
                          {{$snsOUT}}
                        @else
                          <b><a class="text-red">{{$snsOUT}}</a></b>
                        @endif
                          <span class="small text-uppercase">out</span>
                      </div>
                  </div>
                  <div class="col">
                    <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                        @if($snsPEN == '0')
                          {{$snsPEN}}
                        @else
                          <b><a class="text-red">{{$snsPEN}}</a></b>
                        @endif
                        <span class="small text-uppercase">pending</span>
                    </div>
                </div>
              </div>
              <div class="card-footer">
                <a class="text-black float-left" href="{{route('history.list', 'sns')}}"><i class="fas fa-history"></i> History</a>
                <a class="text-black float-right" href="{{route('active.list', 'sns')}}">View <i class="fas fa-list-ol"></i></a>
              </div>
          </div>
      </div>

      <!-- STELA -->
      <div class="col-md-3">
        <div class="card bg-warning text-center card-info">
            <div class="card-block">
                <h4 class="card-title text-white">STELA</h4>
                <h4><i class="fas fa-building fa-2x"></i></h4>
            </div>
            <div class="row m-2 no-gutters rounded">
              <div class="col">
                  <div class="card card-block text-info rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                        @if($stelaIN == '0')
                          {{$stelaIN}}
                        @else
                          <b><a class="text-red">{{$stelaIN}}</a></b>
                        @endif
                      <span class="small text-uppercase">in</span>
                  </div>
              </div>
              <div class="col">
                  <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                        @if($stelaOUT == '0')
                          {{$stelaOUT}}
                        @else
                          <b><a class="text-red">{{$stelaOUT}}</a></b>
                        @endif
                      <span class="small text-uppercase">out</span>
                  </div>
              </div>
              <div class="col">
                <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                        @if($stelaPEN == '0')
                          {{$stelaPEN}}
                        @else
                          <b><a class="text-red">{{$stelaPEN}}</a></b>
                        @endif
                    <span class="small text-uppercase">pending</span>
                </div>
            </div>
          </div>
          <div class="card-footer">
            <a class="text-black float-left" href="{{route('history.list', 'stela')}}"><i class="fas fa-history"></i> History</a>
            <a class="text-black float-right" href="{{route('active.list', 'stela')}}">View <i class="fas fa-list-ol"></i></a>
          </div>
        </div>
      </div>
        
    </div>
    <!-- 3 ROW DEPT END -->

  </div>
</div>
<!-- refreshDiv END -->



  @endsection
  <script src="{{asset('js/jquery.min.js')}}" ></script>

  <script type="text/javascript">
    setInterval("my_function();",1000); 
    setInterval("div();",1000); 
    function my_function(){
      $('#refresh').load(location.href + ' #time');
    }

    function div(){
      $('#refreshDiv').load(location.href + ' #dashDiv');
    }

  </script>