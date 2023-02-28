@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('success'))
    <div class="alert alert-success" id="flash-msg">
        <button type="button" class="close text-dark" data-dismiss="alert">×</button> 
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" id="flash-msg">
        <button type="button" class="close text-dark" data-dismiss="alert">×</button> 
        {{session('error')}}
    </div>
@endif



<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }


    $(document).ready(function(){
        setTimeout(function(){
            $('#flash-msg').hide('fade');
        },4000);
        $('#linkClose').click(function(){
        $('#flash-msg').hide('fade');
        });
    });
</script>