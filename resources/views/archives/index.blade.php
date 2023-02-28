@section('title', 'Archived | UB-S.E.V.M.S.')
@extends('layouts.app')

@section('main-content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="m-0 font-weight-bold" style="text-align: center;">
                        <b style="color:#bb2124">A R C H I V E D </b>&nbsp U S E R S
            </h2>
            <hr style="background-color: #bb2124; height:2px;">    

            @include('includes.messages')

                <table class="table table-hover table-sm">
                    <thead class="rounded-top" style="background-color: #bb2124; color: white;">
                        <tr>
                            <th><b>ID #</b></th>
                            <th><b>First Name</b></th>
                            <th><b>Last Name</b></th>
                            <th><b>User Type</b></th>
                            <th><b>Contact Number</b></th>
                            <th><b>Action</b></th>
                        <tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td><b  style="color: #bb2124">{{ $user->id }} </b></td>
                                <td>{{ $user->fname }}</td>
                                <td>{{ $user->lname }}</td>
                                <td><?php echo ucwords($user->userType); ?></td>
                                <td><?php echo '0'.$user->contactNo; ?></td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-post_id={{ $user->id }} data-user_id={{ $user->id }} data-toggle="modal" data-target="#delete"><i class="fas fa-undo-alt"></i> RESTORE</button>   
                                </td>
                            </tr>
                        @endforeach
                    <tr>
                    
                    </tr>
                    </tbody>
                </table>

                @if(count($users) == 0)
                    <h5 class="text-center"> No Record Found.</h5>
                @endif

                <span class="text-right">
                    {{$users->links()}}
                </span>
        </div> 
    </div>
</div>


<!-- Modal for deletion -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white" id="exampleModalLabel">Restore User Account Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <form action="{{ route('users_management.update', Auth::user()->id) }}" method="POST">
              @csrf
              @method('PUT') 
              <h1 class="text-danger text-center">
                  <i class="fas fa-exclamation-triangle"></i>
                </h1>
                  <p class="text-center">
                      Are you sure you want to Restore this User Account?
                  </p>
                    <input type="text" name="post_id" id="post_id" hidden>
                  <input type="text" name="user_id" id="user_id" hidden>
  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
              <button type="submit" class="btn btn-warning">Yes, Restore</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Modal for deletion -->

@endsection
