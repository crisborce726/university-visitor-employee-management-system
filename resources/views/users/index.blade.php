@section('title', 'UB-S.E.V.M.S. | Departments')
@extends('layouts.app')

@section('main-content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="m-0 font-weight-bold" style="text-align: center;">
                        U S E R &nbsp<b style="color:#bb2124">M A N A G E M E N T</b>
            </h2>

                <hr style="background-color: #bb2124; height:2px;">
              
                <div class="">
                    

                <div class="input-group md-form form-sm form-1 pl-0 mb-2">

                    <form action="{{ route('user.search') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                            <div class="row float-left">
                                <div class="col-md-10">
                                    <div class="input-group-prepend" style="color: red">
                                        <input type="text" name="findMe" id="findMe" class="form-control sm my-0 py-1" placeholder="ID Number or Name" aria-label="Search Transactions..." required>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary"><b class="fas fa-search"> </b>
                                        <b>{{ __('SEARCH') }}</b>
                                    </button>
                                </div>
                            </div>
                    </form>

                    
                </div>

                    @include('includes.messages')

                    <table class="table table-hover table-sm">
                      <thead class="rounded-top" style="background-color: #bb2124; color: white;">
                          <tr>
                              <th><b>ID #</b></th>
                              <th><b>Full name</b></th>
                              <th><b>User Type</b></th>
                              <th><b>Status</b></th>
                              <th><b>Action</b></th>
                          <tr>
                      </thead>
                      <tbody>
                          @foreach ($users as $key => $user)
                              <tr>
                                  <td><b style="color: #bb2124">{{ $user->id }} </b></td>
                                  <td>{{ $user->fname }} {{ $user->lname }}</td>
                                  <td><?php echo ucwords($user->userType); ?></td>
                                  <td><?php echo ucwords($user->activity); ?></td>
                                  <td>
                                      <a href="{{ route('users_management.show', $user->id ) }}" class="btn btn-primary btn-sm"><b class="fas fa-address-card"></b> <b>VIEW </b></a>
                                      @if(Auth::user()->id !== $user->id)
                                        <button class="btn btn-warning btn-sm"  data-post_id={{ $user->id }} data-user_id={{ $user->id }} data-toggle="modal" data-target="#cancel"><i class="fas fa-archive"></i> ARCHIVE </button>
                                      @endif
                                  </td>
                              </tr>
                          @endforeach
                          <tr>
                            <td colspan="5">
                              {{ $users->appends($data)->links() }}
                            </td>
                          </tr>
                      </tbody>
                      
                  </table>
                  @if(count($users) == 0)
                        <h5 class="text-center"> No Record Found.</h5>
                  @endif
                </div>
                <br>
        </div> 
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title text-white" id="exampleModalLabel">Archive Account Confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
              <form action="{{ route('user.archive') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT') 
                  <h1 class="text-danger text-center">
                      <i class="fas fa-exclamation-triangle"></i>
                    </h1>
                      <p class="text-center">
                          Are you sure you want to archive this account?
                      </p>
                        <input type="text" name="post_id" id="post_id" hidden>
                      <input type="text" name="user_id" id="user_id" hidden>
      
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">No, Exit</button>
                  <button type="submit" class="btn btn-warning">Yes, Archive</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <!-- End of Modal -->

@endsection
