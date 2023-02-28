@section('title', 'Appointment | UB-S.E.V.M.S.')
@extends('layouts.app')

@section('main-content')
    <div class="container col-md">
        <div class="row">
            <div class="col-md-12">
                <div>
                    
                    <div>

                        <h2 class="m-0 font-weight-bold" style="text-align: center;">
                        A P P R O V E D <b style="color: #bb2124"> A P P O I N T M E N T S</b>
                        </h2>
                        <hr style="background-color: #bb2124; height:2px;">    
                        <br>

                        @include('includes.messages')
                        
                        <div>
                        <table class="table table-hover table-sm">
                        <thead class="" style="background-color: #bb2124; color: white;">
                            <tr>
                                <th><b>ID</b></th>
                                <th><b>Dept./Office</b></th>
                                <th><b>Date</b></th>
                                <th><b>Time</b></th>
                                <th><b>Purpose</b></th>
                                <th><b>Status</b></th>
                                <th><b>Action</b></th>
                            <tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $key => $myAppointment)
                            <tr>
                                <td style="color: #bb2124;"><b>{{ $myAppointment->id }}</b></td>
                                <td>{{ strtoupper($myAppointment->departmentOffice) }}</td>
                                <td>{{\Carbon\Carbon::parse($myAppointment->date)->format('F j, Y')}}</td>
                                <td>{{ $myAppointment->time }}</td>
                                <td>{{ $myAppointment->purpose }}</td>
                                <td>{{ $myAppointment->status }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" data-post_id={{ $myAppointment->id }} data-user_id={{ $myAppointment->user_id }} data-toggle="modal" data-target="#cancel"><i class="fas fa-trash-alt"></i> CANCEL</button>   
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if(count($data) == 0)
                        <h5 class="text-center"> No Record Found.</h5>
                    @endif

                    <span class="text-right">
                        {{$data->links()}}
                    </span>

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal for deletion -->
<div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white" id="exampleModalLabel">Cancel Approved Appointment Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <form action="{{ route('myappointments.cancel' , Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT') 
              <h1 class="text-danger text-center">
                  <i class="fas fa-exclamation-triangle"></i>
                </h1>
                  <p class="text-center">
                      Are you sure you want to cencel your appointment?
                  </p>
                    <input type="hidden" name="post_id" id="post_id">
                  <input type="hidden" name="user_id" id="user_id">
  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">No, Exit</button>
              <button type="submit" class="btn btn-warning">Yes, Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Modal for deletion -->

@endsection

<style>
    .w-5{
        display: none;
    }
</style>