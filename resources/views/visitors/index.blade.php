@section('title', 'Visitors List | UB-S.E.V.M.S.')
@extends('layouts.app')

@section('main-content')
<div class="containers-fluid">
    <h2 class="m-0 font-weight-bold" style="text-align: center;">
            <b style="color:#bb2124"> V I S I T O R </b> <b> L I S T</b>
    </h2>

    <hr style="background-color: #bb2124; height:2px;">

      <div class="row">
        <div class="col">
            <div class="float-left ml-2">
              <form action="{{ route('visitor.search') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if($name == '')
                    <input style="width:99%;" type="text" name="search" id="search" class="form-control" placeholder="First name or Last name">&nbsp;
                @else
                    <input style="width:99%;" type="text" name="search" id="search" class="form-control" placeholder="First name or Last name" value="{{$name}}">&nbsp;
                @endif
            </div>
            <div class="float-left ml-2">
              <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> <b>S E A R C H</b></button>
            </form>
              <a class="btn btn-primary text-white" href="/visitors"><i class="fas fa-redo"></i> <b>R E F R E S H</b></a>
            </div>
        </div>
      </div>

      <div class="row m-2">
          <table class="table table-hover table-sm">
              <thead class="rounded-top" style="background-color: #bb2124; color: white;">
                  <tr>
                  <th><b>ID #</b></th>
                  <th><b>Full name</b></th>
                  <th><b>Entry Status</b></th>
                  <th><b>Action</b></th>
                  <tr>
              </thead>
              <tbody id="dynamic-row" >
                @foreach ($visitors as $key => $list)
                <tr>
                  <td>
                      <b style="color: #bb2124">{{ $list->id }}</b>
                  </td>
                  <td>
                      @php echo ucfirst($list->fname).' '.ucfirst($list->lname); @endphp
                  </td>
                  <td>
                      @php
                          $today = DB::table('transactions')
                                              ->whereDate('timeIn', \Carbon\Carbon::today())
                                              ->where('user_id', $list->id)
                                              ->get();
                          foreach($today as $check_today)
                          {
                              $check_today_in = $check_today->timeIn;
                              $check_today_out = $check_today->timeOut;
                          }
                          if(!empty($check_today_in) && empty($check_today_out))
                          {
                              echo 'IN';
                          }
                          else
                          {
                              echo 'OUT';
                          }
                      @endphp
                  </td>
                  <td>
                          <a class="btn btn-success btn-sm" href="{{route('visitor.profile', $list->id)}}"><i class="fas fa-info"></i> <b>VIEW INFO</b></a>
                          <a class="btn btn-info btn-sm" href="{{route('visitor.transac', $list->id)}}"><i class="fas fa-info"></i> <b>TRANSACTIONS</b></a>
                          <button class="btn btn-danger btn-sm"  data-post_id={{ $list->id }} data-user_id={{ $list->id }} data-toggle="modal" data-target="#cancel"><i class="fas fa-ban"></i> BLOCK USER </button>
                  </td>
              </tr>
                @endforeach
              </tbody>
          </table>
          
      </div>
      @if(count($visitors) == 0)
              <h5 class="text-center"> No Record Found.</h5>
      @endif

      <span class="text-right">
          {{ $visitors->appends($data)->links() }}
      </span>
</div>
            

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