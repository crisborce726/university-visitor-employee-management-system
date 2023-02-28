@section('title', 'UB-S.E.V.M.S. | Add Appointment')
@extends('layouts.app')

@section('main-content')
<div class="alert alert-success alert-block" id="dateWarning" style="display: none">
    <button type="button" onclick="hideAlert()"   class="close"><b class="fas fa-times-circle" style="color:red"></b></button>
    <strong>Please select a different date. No appointments are held on weekends.</strong>
</div>
<div class="container col-md-12">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div>
                
                <div>
                    <h2 class="m-0 font-weight-bold" style="text-align: center;">
                    <b style="color: #bb2124">A P P O I N T M E N T</b> D E T A I L S
                    </h2>
                    <hr style="background-color: #bb2124; height:2px;">
                        <form method="POST" action="{{ route('appointments.store') }}">
                            @csrf

                            @include('includes.messages')

                            <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                            <div class="form-group row">
                                <label for="departmentOffice" class="col-md-4 col-form-label text-md-right">{{ __('Department/Office') }}</label>

                                <div class="col-md-6">
                                    <select style="color: black;" class="form-control" id="departmentOffice" name="departmentOffice" required="">
                                                    @if (old('departmentOffice') != '')
                                                    <option value="{{old('departmentOffice')}}" selected>{{old('departmentOffice')}}</option>
                                                @else
                                                    <option value="" disabled="" selected="">Select from the provided list.</option>
                                                @endif
                                                    <option value="" disabled>----------School Departments----------</option>
                                                    <option value="sbaa">School of Business Administration and Accountancy</option>
                                                    <option value="scjps">School of Criminal Justice and Public Safety</option>
                                                    <option value="sod">School of Dentistry</option>
                                                    <option value="sea">School of Engineering and Architecture</option>
                                                    <option value="sit">School of Information Technology</option>
                                                    <option value="sihtm">School of International Hospitality and Tourism Management</option>
                                                    <option value="sol">School of Law</option>
                                                    <option value="son">School of Nursing</option>
                                                    <option value="sns">School of Natural Sciences</option>
                                                    <option value="stela">School of Teacher Education and Liberal Arts</option>
                                                    
                                    </select>

                                    @error('departmentOffice')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            
                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Appointment Date') }}</label>

                                <div class="col-md-6">
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" min="<?php $today= date('Y-m-d');echo $today; ?>" max="" required autocomplete="date" onchange="compareDate()">

                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Time') }}</label>

                                <div class="col-md-6">
                                <select style="color: black;" class="form-control" id="time" name="time" required="">
                                                    @if (old('time') != '')
                                                    <option value="{{old('departmentOffice')}}" selected>{{old('time')}}</option>
                                                    @else
                                                        <option value="" disabled="" selected="">Select from the provided list.</option>
                                                    @endif
                                                    
                                                    
                                    </select>

                                    @error('time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="purpose" class="col-md-4 col-form-label text-md-right">{{ __('Purpose') }}</label>

                                <div class="col-md-6">
                                    <textarea id="purpose" rows="5" type="text" class="form-control @error('purpose') is-invalid @enderror" name="purpose" value="{{ old('purpose') }}"  autocomplete="purpose"></textarea>

                                    @error('purpose')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn font-weight-bold btn-danger">
                                        {{ __('Send for Approval') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function hideAlert(){
            document.getElementById("dateWarning").style.display = "none";
        }

const picker = document.getElementById('date');
picker.addEventListener('input', function(e){
  var day = new Date(this.value).getUTCDay();
  if([6,0].includes(day)){
    e.preventDefault();
    this.value = '';
    document.getElementById("dateWarning").style.display = "block";
  }
});
function compareDate(){
    
    var date = document.getElementById('date').value;
            var optionArray;
            var inpDate = new Date(date);
            var currDate = new Date();
              
            if(inpDate.setHours(0, 0, 0, 0) == currDate.setHours(0, 0, 0, 0)){

                let current = new Date();
                let cTime = current.getHours();
                var x = document.getElementById("time");
                var option = document.createElement("option");
                

                if(cTime <= 8){
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    var options =
                                    [
                                    {
                                        "text"  : "08:00 - 08:59 AM",
                                        "value" : "08:00 - 08:59 AM"
                                    },
                                    {
                                        "text"     : "09:00 - 09:59 AM",
                                        "value"    : "09:00 - 09:59 AM",
                                    },
                                    {
                                        "text"  : "10:00 - 10:59 AM",
                                        "value" : "10:00 - 10:59 AM"
                                    },
                                    {
                                        "text"     : "11:00 - 11:59 AM",
                                        "value"    : "11:00 - 11:59 AM",
                                    },
                                    {
                                        "text"  : "01:00 - 01:59 PM",
                                        "value" : "01:00 - 01:59 PM"
                                    },
                                    {
                                        "text"     : "02:00 - 02:59 PM",
                                        "value"    : "02:00 - 02:59 PM",
                                    },
                                    {
                                        "text"  : "03:00 - 03:59 PM",
                                        "value" : "03:00 - 03:59 PM"
                                    },
                                    {
                                        "text"  : "04:00 - 04:59 PM",
                                        "value" : "04:00 - 04:59 PM"
                                    }
                                    ];

                                    var selectBox = document.getElementById('time');

                                    for(var i = 0, l = options.length; i < l; i++){
                                    var option = options[i];
                                    selectBox.options.add( new Option(option.text, option.value, option.selected) );
                                    }


                }else if(cTime == 9){
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    var options =
                                    [
                                    {
                                        "text"     : "09:00 - 09:59 AM",
                                        "value"    : "09:00 - 09:59 AM",
                                    },
                                    {
                                        "text"  : "10:00 - 10:59 AM",
                                        "value" : "10:00 - 10:59 AM"
                                    },
                                    {
                                        "text"     : "11:00 - 11:59 AM",
                                        "value"    : "11:00 - 11:59 AM",
                                    },
                                    {
                                        "text"  : "01:00 - 01:59 PM",
                                        "value" : "01:00 - 01:59 PM"
                                    },
                                    {
                                        "text"     : "02:00 - 02:59 PM",
                                        "value"    : "02:00 - 02:59 PM",
                                    },
                                    {
                                        "text"  : "03:00 - 03:59 PM",
                                        "value" : "03:00 - 03:59 PM"
                                    },
                                    {
                                        "text"  : "04:00 - 04:59 PM",
                                        "value" : "04:00 - 04:59 PM"
                                    }
                                    ];

                                    var selectBox = document.getElementById('time');

                                    for(var i = 0, l = options.length; i < l; i++){
                                    var option = options[i];
                                    selectBox.options.add( new Option(option.text, option.value, option.selected) );
                                    }


                }else if(cTime <= 10){
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    var options =
                                    [
                                    {
                                        "text"  : "10:00 - 10:59 AM",
                                        "value" : "10:00 - 10:59 AM"
                                    },
                                    {
                                        "text"     : "11:00 - 11:59 AM",
                                        "value"    : "11:00 - 11:59 AM",
                                    },
                                    {
                                        "text"  : "01:00 - 01:59 PM",
                                        "value" : "01:00 - 01:59 PM"
                                    },
                                    {
                                        "text"     : "02:00 - 02:59 PM",
                                        "value"    : "02:00 - 02:59 PM",
                                    },
                                    {
                                        "text"  : "03:00 - 03:59 PM",
                                        "value" : "03:00 - 03:59 PM"
                                    },
                                    {
                                        "text"  : "04:00 - 04:59 PM",
                                        "value" : "04:00 - 04:59 PM"
                                    }
                                    ];

                                    var selectBox = document.getElementById('time');

                                    for(var i = 0, l = options.length; i < l; i++){
                                    var option = options[i];
                                    selectBox.options.add( new Option(option.text, option.value, option.selected) );
                                    }
                }else if(cTime <= 11){
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    var options =
                                    [
                                    {
                                        "text"     : "11:00 - 11:59 AM",
                                        "value"    : "11:00 - 11:59 AM",
                                    },
                                    {
                                        "text"  : "01:00 - 01:59 PM",
                                        "value" : "01:00 - 01:59 PM"
                                    },
                                    {
                                        "text"     : "02:00 - 02:59 PM",
                                        "value"    : "02:00 - 02:59 PM",
                                    },
                                    {
                                        "text"  : "03:00 - 03:59 PM",
                                        "value" : "03:00 - 03:59 PM"
                                    },
                                    {
                                        "text"  : "04:00 - 04:59 PM",
                                        "value" : "04:00 - 04:59 PM"
                                    }
                                    ];

                                    var selectBox = document.getElementById('time');

                                    for(var i = 0, l = options.length; i < l; i++){
                                    var option = options[i];
                                    selectBox.options.add( new Option(option.text, option.value, option.selected) );
                                    }
                }else if(cTime <= 13){
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    var options =
                                    [
                                    {
                                        "text"  : "01:00 - 01:59 PM",
                                        "value" : "01:00 - 01:59 PM"
                                    },
                                    {
                                        "text"     : "02:00 - 02:59 PM",
                                        "value"    : "02:00 - 02:59 PM",
                                    },
                                    {
                                        "text"  : "03:00 - 03:59 PM",
                                        "value" : "03:00 - 03:59 PM"
                                    },
                                    {
                                        "text"  : "04:00 - 04:59 PM",
                                        "value" : "04:00 - 04:59 PM"
                                    }
                                    ];

                                    var selectBox = document.getElementById('time');

                                    for(var i = 0, l = options.length; i < l; i++){
                                    var option = options[i];
                                    selectBox.options.add( new Option(option.text, option.value, option.selected) );
                                    }
                }else if(cTime <= 14){
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    var options =
                                    [
                                    {
                                        "text"     : "02:00 - 02:59 PM",
                                        "value"    : "02:00 - 02:59 PM",
                                    },
                                    {
                                        "text"  : "03:00 - 03:59 PM",
                                        "value" : "03:00 - 03:59 PM"
                                    },
                                    {
                                        "text"  : "04:00 - 04:59 PM",
                                        "value" : "04:00 - 04:59 PM"
                                    }
                                    ];

                                    var selectBox = document.getElementById('time');

                                    for(var i = 0, l = options.length; i < l; i++){
                                    var option = options[i];
                                    selectBox.options.add( new Option(option.text, option.value, option.selected) );
                                    }
                }else if(cTime <= 15){
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    var options =
                                    [
                                    {
                                        "text"  : "03:00 - 03:59 PM",
                                        "value" : "03:00 - 03:59 PM"
                                    },
                                    {
                                        "text"  : "04:00 - 04:59 PM",
                                        "value" : "04:00 - 04:59 PM"
                                    }
                                    ];

                                    var selectBox = document.getElementById('time');

                                    for(var i = 0, l = options.length; i < l; i++){
                                    var option = options[i];
                                    selectBox.options.add( new Option(option.text, option.value, option.selected) );
                                    }
                }else if(cTime <= 16){
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    var options =
                                    [
                                    {
                                        "text"  : "04:00 - 04:59 PM",
                                        "value" : "04:00 - 04:59 PM"
                                    }
                                    ];

                                    var selectBox = document.getElementById('time');

                                    for(var i = 0, l = options.length; i < l; i++){
                                    var option = options[i];
                                    selectBox.options.add( new Option(option.text, option.value, option.selected) );
                                    }
                }else if(cTime >= 15){
                }else{

                }
                
            }else{
                var x = document.getElementById("time");
                var option = document.createElement("option"); 
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                    x.options.remove(1);
                var options =
                                    [
                                    {
                                        "text"  : "08:00 - 08:59 AM",
                                        "value" : "08:00 - 08:59 AM"
                                    },
                                    {
                                        "text"     : "09:00 - 09:59 AM",
                                        "value"    : "09:00 - 09:59 AM",
                                    },
                                    {
                                        "text"  : "10:00 - 10:59 AM",
                                        "value" : "10:00 - 10:59 AM"
                                    },
                                    {
                                        "text"     : "11:00 - 11:59 AM",
                                        "value"    : "11:00 - 11:59 AM",
                                    },
                                    {
                                        "text"  : "01:00 - 01:59 PM",
                                        "value" : "01:00 - 01:59 PM"
                                    },
                                    {
                                        "text"     : "02:00 - 02:59 PM",
                                        "value"    : "02:00 - 02:59 PM",
                                    },
                                    {
                                        "text"  : "03:00 - 03:59 PM",
                                        "value" : "03:00 - 03:59 PM"
                                    },
                                    {
                                        "text"  : "04:00 - 04:59 PM",
                                        "value" : "04:00 - 04:59 PM"
                                    }
                                    ];

                                    var selectBox = document.getElementById('time');

                                    for(var i = 0, l = options.length; i < l; i++){
                                    var option = options[i];
                                    selectBox.options.add( new Option(option.text, option.value, option.selected) );
                                    }
            }
}

</script>
@endsection
