@section('title', 'UB-S.E.V.M.S. | Barcode')
@extends('layouts.app')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <img name="identification" id="identification" style="width: 30%; margin-left: 35%" src="/storage/identification/{{Auth::user()->identification}}">
                <div  class="text-center" style="margin-left: 20%; margin-right: 20%">
                    <h2 class="m-0 font-weight-bold" style="text-align: center;">
                        M Y <b style="color: #bb2124">B A R C O D E</b>
                    </h2>

                    <hr style="background-color: #bb2124; height:2px;">
                    <div class="center">
                        
                            @foreach ($data as $key => $value)
                            <div  class="text-center" id="barcode">
                                {!!$value->barcode!!}
                            </div>
                            @endforeach
                            <h4>{!!$value->id!!}<h4>
                        
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

<style>
    #barcode
    {
        margin-left: 42%;
        width: 100%;
    }
</style>