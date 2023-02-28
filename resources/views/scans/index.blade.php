@section('title', 'Scan Page | UB-S.E.V.M.S.')
@extends('layouts.app')

@section('main-content')
<div class="containers-fluid text-center">
    <div class="row-md-12">
        <div class="row justify-content-center">
            <h3><b>S C A N &nbsp</b><b style="color: #bb2124">B A R C O D E</b></h3>
        </div>

        <hr style="background-color: #bb2124; height:2px;">

        @include('includes.messages')

        @if(filled($success))
            <div class="alert alert-success" id="flash-msg">
                {{$success}}
            </div>
        @endif

        @if(filled($error))
            <div class="alert alert-danger" id="flash-msg">
                {{$error}}
            </div>
        @endif

        <span class="success" id="success" name="success" style="color:green; margin-top:10px; margin-bottom: 10px;"></span>
        
        <div class="row justify-content-center">
            <div class="col-xs-6">

                    @if($usertype == 'visitor' || $usertype == 'blocklisted')
                        <img  name="identification" id="identification" style="width: 50%; height:40%; border-style: solid; border-color: #333; border-width: 3px;" src="/storage/identification/{{$image}}"><br/>
                    @endif
                    
                    @if(filled($error))
                        <b>NAME: </b><label id="name" name="name" style="color: #bb2124;font-weight: bold">{{$name}}</label><br/>
                        <b>USER ID: </b><label id="results" name="results" style="color: #bb2124;font-weight: bold">{{$id}}</label>
                    @endif
                    @if(filled($success))
                        <b>NAME: </b><label id="name" name="name" style="color: #21ca0b;font-weight: bold">{{$name}}</label><br/>
                        <b>USER ID: </b><label id="results" name="results" style="color: #21ca0b;font-weight: bold">{{$id}}</label>
                    @endif



                    <form action="{{ route('input.userId') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input placeholder="Enter User ID" type="text" name="idNumber" id="idNumber" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control sm my-0 py-1" required autofocus>
                    
                        <button type="submit"  class="btn btn-danger mt-2" >
                            <i class="fas fa-sign-in-alt"></i> L O G I N &nbsp / &nbsp L O G O U T
                        </button>
                    </form>

                <!-- CAMERA -->
                <div class="mt-2" id="camera"></div>

            </div>
        </div>      
    </div>
</div>
<!-- e3cb0dc010acc0f407a312b9625efec4_1629859673.jpg -->
<script src="{{asset('js/quagga.min.js')}}"  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash.throttle@4.1.1/index.js"></script>

<script>

    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.querySelector('#camera')    // Or '#yourElement' (optional)
        },
        decoder: {
            readers: ["code_39_reader"]
        }
    }, function (err) {
        if (err) {
            console.log(err);
            return
        }
        console.log("Initialization finished. Ready to start");
        Quagga.start();
    });

    Quagga.onDetected(function(result) {
        var code = result.codeResult.code;
        document.getElementById('idNumber').value = code;
    });

    Quagga.onDetected(function (data) {

        var idNumber = data.codeResult.code;

        $.ajax({
        url:"{{ route('scan.cam') }}",
        type: "POST",
        data:{idNumber:idNumber,
            _token: '{{csrf_token()}}'
            },
                success:function(response)
                {  
                    console.log(response);
                    if(response)
                    {
                        $('#success').text(response.success);
                    }
                },
        });

    });

    Quagga.offProcessed(onProcessed); 
    Quagga.offDetected(doOnDetected); 
    Quagga.stop();
</script>


    
@endsection
