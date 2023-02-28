@section('title', 'Reports | UB-SEVMS')
@extends('layouts.app')

@section('main-content')
<div class="">
    <div class="">
    <h2 class="m-0 font-weight-bold" style="text-align: center;">
        A L L <b style="color: #bb2124">R E P O R T S</b>
    </h2>
        <hr style="background-color: #bb2124; height:2px;">
            
            <div class="container-fluid mb-2">

                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addAward">
                    <b class="fas fa-plus-square"></b> <b>ADD NEW</b>
                </button>

            <h4 style="color: #bb2124"><b>Range Filter</b></h4>
        <div class="row">
            <div class="col-md-10">
            <table>
                <form action="{{ route('reports.index') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <tr>
                    <input name="page" id="page" class="form-control" value="report" hidden>
                </tr>
                <tr class="ml-2">
                    <td>
                        <strong>Date From</strong>
                        
                        @if($dateFrom != '')
                            <input value="{{$dateFrom}}" style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateFrom" id="dateFrom" class="form-control">&nbsp;
                        @else
                            <input style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateFrom" id="dateFrom" class="form-control">&nbsp;
                        @endif
                    </td>
                    <td>
                        <strong>Date To</strong>
                        @if($dateTo != '')
                            <input value="{{$dateTo}}" style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateTo" id="dateTo" class="form-control">&nbsp;
                        @else
                            <input style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateTo" id="dateTo" class="form-control">&nbsp;
                        @endif
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary"><b class="fas fa-search"> </b>
                            <b>{{ __('S E A R C H') }}</b>
                        </button>
                    </td>
                    </form>
                    <td>
                        <a class="btn btn-primary" href="/reports"><i class="fas fa-redo"></i> <b>R E F R E S H</b></a>
                    </td>
                </tr>
            </table>
            </div>
            <div class="col-md-2 text-right">
                @if($button == 1)
                    <form action="{{ route('report.pdf') }}" target="_blank" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input name="dateFrom" id="dateFrom" class="form-control" value="{{$dateFrom}}" hidden>
                        <input name="dateTo" id="dateTo" class="form-control" value="{{$dateTo}}" hidden>
                        <br/>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-file-pdf"></i>
                        <b>{{ __('Download Report') }}</b></button>
                    </form>
                @endif
            </div>
        </div>

            @include('includes.messages')

            <div class="containers-fluid mt-2">
                <table class="table table-hover table-sm mt-2">
                        <thead class="rounded-top" style="background-color: #bb2124; color: white;">
                            <tr>
                                <th><b>ID</b></th>
                                <th><b>Concern</b></th>
                                <th><b>Status</b></th>
                                <th><b>Action Taken</b></th>
                                <th><b>Remarks</b></th>
                                <th><b>Date</b></th>
                                <th><b>By</b></th>
                                <th><b>Action</b></th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row" >
                            @foreach ($myReports as $key => $item)
                                <tr>
                                    <td><b style="color: #bb2124">{{ $item->id }}</b></td>
                                    <td>{{$item->areasOfConcern}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>{{$item->actionTaken}}</td>
                                    <td>{{$item->remarks}}</td>
                                    <td>
                                        {{\Carbon\Carbon::parse($item->created_at)->format('F j, Y')}}
                                    </td>
                                    <td>
                                        @php
                                            $name = DB::table('users')->where('id', $item->user_id)->get();
                                            foreach($name as $get_name)
                                            {
                                                echo $get_name->fname .' '. $get_name->lname;
                                            }
                                        @endphp
                                    </td>
                                    <td>
                                        @if(Auth::user()->id == $item->user_id)
                                            <button data-post_id={{ $item->id }} data-post_status={{ $item->status }} data-post_action={{ $item->actionTaken }} data-post_remark={{ $item->remarks }} data-user_id={{ $item->user_id }} type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editReport"><b class="fas fa-edit"></b> <b>E D I T</b></button>

                                            <button data-post_id={{ $item->id }} data-user_id={{ $item->user_id }} type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete"><b class="fas fa-trash"></b> <b>D E L E T E</b></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="8">
                                
                                        {{ $myReports->appends($data)->links() }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    @if(count($myReports) == 0)
                                            <h5 class="text-center"> No Record Found.</h5>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                </table>
                
            </div>


            
            
</div>
<!-- Add Report Modal -->
<div class="modal fade" id="addAward" tabindex="-1" role="dialog" aria-labelledby="addAwardLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST"  action="{{ route('reports.store') }}">
                @CSRF

                <div class="modal-header" style="background-color: #bb2124;">

                    <h5 class="modal-title text-white" id="addAwardLabel" style="text-align: center"><b>
                        R E P O R T &nbsp D E T A I L S </b>
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>

                </div>


                <div class="modal-body">

                    <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>

                    <div class="form-group row">
                        <label for="areasOfConcern" class="col-md-3 col-form-label text-md-right">{{ __('Areas of Concern') }}</label>

                        <div class="col-md-8">
                            <select style="color: black;" class="form-control" id="areasOfConcern" name="areasOfConcern" required="">
                                    @if (old('areasOfConcern') != '')
                                        <option value="{{old('areasOfConcern')}}" selected>{{old('areasOfConcern')}}</option>
                                    @else
                                        <option value="" disabled selected>Select from the provided list.</option>
                                        <option value="Security Matters">Security Matters</option>
                                        <option value="Safety Matters">Safety Matters</option>
                                        <option value="Other Matters">Other Matters</option>
                                        
                                    @endif
                                
                            </select>

                                @error('areasOfConcern')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="status" class="col-md-3 col-form-label text-md-right">{{ __('Status') }}</label>

                        <div class="col-md-8">
                            <textarea id="status" rows="4" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}"  autocomplete="status"></textarea>

                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="actionTaken" class="col-md-3 col-form-label text-md-right">{{ __('Action Taken') }}</label>

                        <div class="col-md-8">
                            <textarea id="actionTaken" rows="4" type="text" class="form-control @error('actionTaken') is-invalid @enderror" name="actionTaken" value="{{ old('actionTaken') }}"  autocomplete="actionTaken"></textarea>

                            @error('actionTaken')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="remarks" class="col-md-3 col-form-label text-md-right">{{ __('Remarks') }}</label>

                        <div class="col-md-8">
                            <textarea id="remarks" rows="4" type="text" class="form-control @error('remarks') is-invalid @enderror" name="remarks" value="{{ old('remarks') }}"  autocomplete="remarks"></textarea>

                            @error('remarks')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger"><b>S A V E</b></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Report Modal -->

<!-- Edit Report Modal -->
<div class="modal fade" id="editReport" tabindex="-1" role="dialog" aria-labelledby="addAwardLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST"  action="{{ route('reports.update', Auth::user()->id) }}">
                @CSRF
                @method('PUT')

                <div class="modal-header" style="background-color: #bb2124;">

                    <h5 class="modal-title text-white" id="addAwardLabel" style="text-align: center"><b>
                        E D I T &nbsp R E P O R T &nbsp D E T A I L S </b>
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>

                </div>


                <div class="modal-body">
                    <div class="form-group row">
                        <label for="areasOfConcern" class="col-md-3 col-form-label text-md-right">{{ __('Areas of Concern') }}</label>

                        <div class="col-md-8">
                            <select style="color: black;" class="form-control" id="areasOfConcern" name="areasOfConcern" required="">
                                    @if (old('areasOfConcern') != '')
                                        <option value="{{old('areasOfConcern')}}" selected>{{old('areasOfConcern')}}</option>
                                    @else
                                        <option value="" disabled selected>Select from the provided list.</option>
                                        <option value="Security Matters">Security Matters</option>
                                        <option value="Safety Matters">Safety Matters</option>
                                        <option value="Other Matters">Other Matters</option>
                                        
                                    @endif
                                
                            </select>

                                @error('areasOfConcern')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>

                    <input type="text" name="post_id" id="post_id" hidden>
                    <input type="text" name="user_id" id="user_id" hidden>
                    
                    <div class="form-group row">
                        <label for="post_status" class="col-md-3 col-form-label text-md-right">{{ __('Status') }}</label>

                        <div class="col-md-8">
                            <textarea name="post_status" id="post_status" rows="4" type="text" class="form-control @error('status') is-invalid @enderror" value="{{ old('status') }}"  autocomplete="status"></textarea>

                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="post_action" class="col-md-3 col-form-label text-md-right">{{ __('Action Taken') }}</label>

                        <div class="col-md-8">
                            <textarea name="post_action" id="post_action" rows="4" type="text" class="form-control @error('actionTaken') is-invalid @enderror" value="{{ old('actionTaken') }}"  autocomplete="actionTaken"></textarea>

                            @error('actionTaken')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="post_remark" class="col-md-3 col-form-label text-md-right">{{ __('Remarks') }}</label>

                        <div class="col-md-8">
                            <textarea name="post_remark" id="post_remark" rows="4" type="text" class="form-control @error('remarks') is-invalid @enderror" value="{{ old('remarks') }}"  autocomplete="remarks"></textarea>

                            @error('remarks')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger"><b> U P D A T E</b></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Edit Report Modal -->

<!-- Modal for deletion -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white" id="exampleModalLabel">Delete Report Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
            <form action="{{ route('reports.destroy', Auth::user()->id)}}" method="POST">
              @csrf
              @method('DELETE') 
              <h1 class="text-danger text-center">
                  <i class="fas fa-exclamation-triangle"></i>
                </h1>
                  <p class="text-center">
                      Are you sure you want to delete this report?
                  </p>
                    <input type="text" name="post_id" id="post_id" hidden>
                    <input type="text" name="user_id" id="user_id" hidden>
  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
            <button type="submit" class="btn btn-warning">Yes, Delete</button>
        </div>
        </form>
      </div>
    </div>
</div>
<!-- End of Modal for deletion -->
@endsection