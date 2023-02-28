@section('title', 'UB-S.E.V.M.S. | Departments')
@extends('layouts.app')

@section('main-content')
<div class="containers-fluid">
  <h2 class="m-0 font-weight-bold" style="text-align: center;">
          <b style="color:#bb2124"> D E P A R T M E N T </b> <b> L I S T</b>
  </h2>

  <hr style="background-color: #bb2124; height:2px;">

                @if(count($departments) == 0)
                    <a href="{{ route('departments.generate')}}" class="btn btn-danger text-white"><b>GENERATE DEPARTMENT'S ACCOUNTS</b></a><br><br>
                @endif
                
                @include('includes.messages')

                <table class="table table-sm">
                  <thead class="" style="background-color: #bb2124; color: white;">
                      <tr>
                          <th><b>ID</b></th>
                          <th><b>Department</b></th>
                          <th><b>Office</b></th>
                          <th><b>Location</b></th>
                          <th><b>Action</b></th>
                      <tr>
                  </thead>
                  <tbody>
                  @foreach ($departments as $department)
                      <tr>
                          <td style="color: #bb2124;"><b>{{ $department->id }}</b></td>
                          <td>{{ $department->email }}</td>
                          <td>{{ $department->office }}</td>
                          <td>{{ $department->address }}</td>
                          <td>
                              <button class="btn btn-success btn-sm"   data-dept='{{ $department->email }} password?' data-user_id={{ $department->id }} data-toggle="modal" data-target="#reset"><i class="fas fa-key"></i> RESET PASSWORD</button>   
                          </td>
                      </tr>
                  @endforeach
                  <tr>
                      <td colspan="8">{{ $departments->links() }}</td>
                  </tr>
                  </tbody>
                </table>
                @if(count($departments) == 0)
                    <h5 class="text-center"> No Record Found.</h5>
                @endif
</div>


<!-- Modal for Reset Password -->
<div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white" id="exampleModalLabel">Reset Password Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <form action="{{ route('department.resetPassword') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            <h1 class="text-danger text-center">
                <i class="fas fa-exclamation-triangle"></i>
              </h1>
                <p class="text-center">
                    Are you sure you want to reset <input style="border: 0px solid;" type="text" name="dept" id="dept">
                </p>
                <input type="hidden" name="user_id" id="user_id">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">No, Exit</button>
            <button type="submit" class="btn btn-warning">Yes, Reset</button>
          </div>
      </form>
    </div>
  </div>
</div>
<!-- End of Modal for Reset Password -->


@endsection
