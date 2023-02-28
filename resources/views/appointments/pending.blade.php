@section('title', 'UB-S.E.V.M.S. | Appointment')
@extends('layouts.app')

@section('main-content')
    <div class="container col-md">
        <div class="row">
            <div class="col-md-12">
                <div>
                    
                    <div>

                        <h2 class="m-0 font-weight-bold" style="text-align: center;">
                        P E N D I N G <b style="color: #bb2124"> A P P O I N T M E N T S</b>
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

<!-- Cancel Modal -->
<div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white" id="exampleModalLabel">Cancel Pending Appointment Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <form action="{{ route('myappointments.cancel') }}" method="POST" enctype="multipart/form-data">
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
<!-- End of Modal -->
<!-- Modal BLOCK -->
<div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white" id="exampleModalLabel">Block Visitor Account Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('visitor.block') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT') 
              
                    <input type="text" name="post_id" id="post_id" hidden>
                  <input type="text" name="user_id" id="user_id" hidden>

                  <div class="form-group row">
                    <label for="oType" class="col-md-3 col-form-label text-md-right">{{ __('Type') }}</label>

                    <div class="col-md-8">
                    <select style="color: black;" class="form-control" id="oType" name="oType" required="">
                                        @if (old('oType') != '')
                                          <option value="{{old('oType')}}" selected>{{old('oType')}}</option>
                                    @else
                                            <option value="" disabled selected>Select from the provided list.</option>
                                            <option value="Bullying">Bullying</option>
                                            <option value="Drug Related">Drug Related</option>
                                            <option value="School Disruption">School Disruption</option>
                                           <option value="School Violence">School Violence</option>
                                           <option value="Theft/Larceny">Theft/Larceny</option>
                                           <option value="Vandalism">Vandalism</option>
                                           <option value="Others">Others</option>
                                           
                                    @endif
                                    
                                </select>

                        @error('oType')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-3 col-form-label text-md-right" >{{ __('Description') }}</label>

                    <div class="col-md-8">
                        <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" rows="5" required autocomplete="description" autofocus></textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bldate" class="col-md-3 col-form-label text-md-right">{{ __('Date') }}</label>

                    <div class="col-md-8">
                        <input id="bldate" type="date" class="form-control @error('bldate') is-invalid @enderror" name="bldate" value="{{ old('bldate') }}" required autocomplete="bldate" autofocus  max="<?php $today= date('Y-m-d');echo $today; ?>">

                        @error('bldate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">No, Exit</button>
              <button type="submit" class="btn btn-warning">Yes, Block</button>
            </div>
        </form>
      </div>
    </div>
</div>
<!-- End of Modal BLOCK -->

@endsection

<style>
    .w-5{
        display: none;
    }
  </style>