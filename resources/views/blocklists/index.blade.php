@section('title', 'Blocked List | UB-S.E.V.M.S.')
@extends('layouts.app')

@section('main-content')

<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <h2 class="m-0 font-weight-bold" style="text-align: center;">
                        <b style="color:#bb2124"> B L O C K L I S T</b>
                </h2>
                <hr style="background-color: #bb2124; height:2px;">

                <h4 style="color: #bb2124"><b>Range Filter</b></h4>

            <table>
                <form action="{{ route('block.search') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <tr class="ml-2">
                    <td>
                        <strong>Type of Offense</strong>
                        @if($offenseType == '')
                            <select style="color: black; width:99%;" class="form-control" id="offenseType" name="offenseType">    
                                <option value="" disabled selected>Please Select</option>
                                <option value="Bullying">Bullying</option>
                                <option value="Drug Related">Drug Related</option>
                                <option value="School Disruption">School Disruption</option>
                                <option value="School Violence">School Violence</option>
                                <option value="Theft/Larceny">Theft/Larceny</option>
                                <option value="Vandalism">Vandalism</option>
                                <option value="Other">Other</option>
                            </select>&nbsp;
                        @else
                            <select style="color: black; width:99%;" class="form-control" id="offenseType" name="offenseType">  
                                <option value="" disabled selected>{{$offenseType}}</option>
                                <option value="" disabled>Please Select</option>
                                <option value="Bullying">Bullying</option>
                                <option value="Drug Related">Drug Related</option>
                                <option value="School Disruption">School Disruption</option>
                                <option value="School Violence">School Violence</option>
                                <option value="Theft/Larceny">Theft/Larceny</option>
                                <option value="Vandalism">Vandalism</option>
                                <option value="Other">Other</option>
                            </select>&nbsp;
                        @endif
                    <td>
                        <strong>Date From</strong>
                        @if(($dateFrom == '') && ($dateTo == ''))
                            <input style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateFrom" id="dateFrom" class="form-control">&nbsp;
                        @else
                            <input value="{{$dateFrom}}" style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateFrom" id="dateFrom" class="form-control">&nbsp;
                        @endif
                    </td>
                    <td>
                        <strong>Date To</strong>
                        @if(($dateFrom == '') && ($dateTo == ''))
                            <input  style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateTo" id="dateTo" class="form-control">&nbsp;
                        @else
                            <input value="{{$dateTo}}" style="width:99%;" max="@php echo date('Y-m-d'); @endphp" type="date" name="dateTo" id="dateTo" class="form-control">&nbsp;
                        @endif
                    </td>
                    <td>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary"><b class="fas fa-eye"> </b>
                                <b>{{ __('F I L T E R') }}</b>
                            </button>
                    </td>
                    </form>
                    <td>
                        <a class="btn btn-primary" href="/blacklists"><i class="fas fa-redo"></i> <b>R E F R E S H</b></a>
                    </td>
                </tr>
            </table>

                <table class="table table-hover table-sm">
                    <thead class="rounded-top" style="background-color: #bb2124; color: white;">
                        <tr>
                            <th><b>ID #</b></th>
                            <th><b>Full Name</b></th>
                            <th><b>Type of Offense</b></th>
                            <th><b>Date</b></th>
                            <th><b>Action</b></th>
                        <tr>
                    </thead>
                    <tbody id="dynamic-row">
                        @foreach ($blocklists as $blocklist)
                            <tr>
                                <td><b style="color: #bb2124">{{ $blocklist->userID }}</b></td>
                                <td>@php echo ucfirst($blocklist->fname) .' '. ucfirst($blocklist->lname); @endphp</td>
                                <td>{{$blocklist->oType}}</td>
                                <td>
                                    {{\Carbon\Carbon::parse($blocklist->bldate)->format('F j, Y')}}
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{route('visitor.profile', $blocklist->userID)}}"><i class="fas fa-info"></i> <b>VIEW USER INFO</b></a>
                                    <button class="btn btn-danger btn-sm" data-post_id={{ $blocklist->id }} data-user_offense={{ $blocklist->oType }} data-user_desc={{ $blocklist->description }} data-user_bl={{ $blocklist->bldate }} data-toggle="modal" data-target="#details"><i class="fas fa-info"></i> VIEW BLOCK DETAILS</button>   
                                </td>
                            </tr>
                        @endforeach
                    <tr>
                    <td colspan="5">
                        {{ $blocklists->appends($data)->links() }}
                    </td>
                    </tr>
                    </tbody>
                </table>
                @if(count($blocklists) == 0)
                        <h5 class="text-center"> No Record Found.</h5>
                @endif
        </div> 
    </div>
</div>



<!-- Modal BLOCK -->
<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
            <h5 class="modal-title text-white" id="exampleModalLabel">Visitor Offense Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('visitor.block') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 
                
                    <input type="hidden" name="post_id" id="post_id">
                    <input type="hidden" name="user_id" id="user_id">

                    <div class="form-group row">
                        <label for="oType" class="col-md-3 col-form-label text-md-right">{{ __('Type of Offense') }}</label>

                        <div class="col-md-8">
                        <input name="user_offense" id="user_offense" type="text" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-3 col-form-label text-md-right" >{{ __('Description') }}</label>

                        <div class="col-md-8">
                            <textarea name="user_desc" id="user_desc" type="text" class="form-control" rows="5"  readonly></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bldate" class="col-md-3 col-form-label text-md-right">{{ __('Date') }}</label>

                        <div class="col-md-8">
                            <input name="user_bl" id="user_bl" type="text" class="form-control" readonly>
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
