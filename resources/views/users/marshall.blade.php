@section('title', 'UB-S.E.V.M.S. | Active Marshall')
@extends('layouts.app')

@section('main-content')

<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <h2 class="m-0 font-weight-bold" style="text-align: center;">
                        M A R S H A L L &nbsp; <b style="color:#bb2124"> A C C O U N T S</b>
                </h2>
                <hr style="background-color: #bb2124; height:2px;">
        
            <a class="btn btn-success btn-sm text-white" for="ïnline" data-toggle="modal" data-target="#exampleModalCenter"><b class="fas fa-plus"></b> &nbsp;<b>NEW MARSHALL</b></a>
            <!-- <a class="btn btn-success btn-sm" href="#" for="ïnline"><b class="fas fa-file-download"></b> &nbsp;<b>EXPORT PDF</b></a> -->
        <br><br>
        
        <!-- <div class="container-fluid">
          <div class="row">
            <h4 style="color: #bb2124"><b>Account Activity Filter</b></h4>
          </div>
          <form action="{{ route('marshall.index') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-15">
                <table>
                  <tr>
                    <td>
                      <strong>Status</strong>
                        <select style="color: black; width:100%;" class="form-control" id="activity" name="activity">    
                          <option value="" disabled selected>Enabled/Disabled</option>
                          <option value="enabled">Enabled</option>
                          <option value="disabled">Disabled</option>
                        </select>&nbsp;
                    </td>

                    <td>
                      <button type="submit" class="btn btn-primary"><b class="fas fa-filter"> </b>
                        <b>{{ __('FILTER') }}</b>
                      </button>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </form>
        </div> -->

        <!-- <div class="container-fluid">
          <div class="row">
            <h4 style="color: #bb2124"><b>Account Activity Filter</b></h4>
          </div>
            <form action="{{ route('marshall.index') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

            </form>
          <div class="row">
            <div class="col-md-12">
              
            </div>
          </div> -->
  

            @include('includes.messages')
            
                <table class="table table-hover table-sm">
                    <thead class="rounded-top" style="background-color: #bb2124; color: white;">
                        <tr>
                            <th><b>ID #</b></th>
                            <th><b>First name</b></th>
                            <th><b>Last name</b></th>
                            <th><b>Activity</b></th>
                            <th><b>Action</b></th>
                        <tr>
                    </thead>
                    <tbody id="dynamic-row">
                        @foreach ($marshalls as $marshall)
                            <tr>
                                <td><b style="color: #bb2124">{{ $marshall->id }} </b></td>
                                <td><?php echo ucfirst($marshall->fname); ?></td>
                                <td><?php echo ucwords($marshall->lname); ?></td>
                                <td><?php echo ucwords($marshall->activity); ?></td>
                                <td>
                                @if($marshall->activity == 'disabled')
                                    <button class="btn btn-success btn-sm" data-post_id={{ $marshall->id }} data-user_id={{ $marshall->id }} data-toggle="modal" data-target="#enable"><i class="fas fa-user"></i>&nbsp; &nbsp;ENABLE ACCOUNT</button>
                                    <!-- <a href="{{ route('user.enable')}}" class="btn btn-success btn-sm text-white">ENABLE ACCOUNT</a> -->
                                @elseif($marshall->activity == 'enabled')
                                    <button class="btn btn-danger btn-sm" data-post_id={{ $marshall->id }} data-user_id={{ $marshall->id }} data-toggle="modal" data-target="#cancel"><i class="fas fa-user-slash"></i> DISABLE ACCOUNT</button>
                                    @endif  
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(count($marshalls) == 0)
                    <h5 class="text-center"> No Record Found.</h5>
                @endif

                <span class="text-left">
                    {{$marshalls->links()}}
                </span>
        </div> 
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white" id="exampleModalLabel">Disable Account Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <form action="{{ route('user.disable') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT') 
              <h1 class="text-danger text-center">
                  <i class="fas fa-exclamation-triangle"></i>
                </h1>
                  <p class="text-center">
                      Are you sure you want to disable this account?
                  </p>
                    <input type="text" name="post_id" id="post_id" hidden>
                  <input type="text" name="user_id" id="user_id" hidden>
  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-warning">Disable</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Modal -->

  <!-- Modal for enabling marshal accounts -->
<div class="modal fade" id="enable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white" id="exampleModalLabel">Enable Marshall Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <form action="{{ route('user.enable', Auth::user()->id) }}" method="POST">
              @csrf
              @method('PUT') 
              <h1 class="text-danger text-center">
                  <i class="fas fa-exclamation-triangle"></i>
                </h1>
                  <p class="text-center">
                      Are you sure you want to enable this Marshal account?
                  </p>
                    <input type="text" name="post_id" id="post_id" hidden>
                  <input type="text" name="user_id" id="user_id" hidden>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Enable</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Modal for enablement -->

  <!-- Add Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white" id="exampleModalLabel">Marshall Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('users_management.store') }}" enctype="multipart/form-data">
                @csrf
   
                <input type="text" value="marshall" name="userType" id="userType" hidden>

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
                    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                    <div class="col-md-6">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>      
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><b class="fas fa-save"></b><b> SAVE</b></button>
        </div>
        </form>
      </div>
    </div>
</div>
<!-- End of Add Modal -->



@endsection
