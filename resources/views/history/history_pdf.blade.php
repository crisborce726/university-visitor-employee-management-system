<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inactive Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <div style="text-align: center">
        <img src="{{ public_path('images/LogoUB.png')}}" style="width: 22%">
        <p style="font-size: 16px"><b>SECURITY OFFICE</b></p>
        <p style="font-size: 12px">General Luna Road, Baguio City Philippines 2600</p>
        <hr style="background-color: black">
        <p style="font-size: 10px"><b>Telefax No.:(074) 442-3071 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Website: www.ubaguio.edu &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   E-mail Address: ub@ubaguio.edu</b></p>
    </div>
    <br><br>
    <p style="font-size: 12px; text-align: center"><b>List of Past Transactions for Employees, Students, and Visitors - @php echo strtoupper($department); @endphp<b></p>
        <p style="font-size: 12px; text-align: center">
            @if(!empty($dateFrom) && !empty($dateTo))
                {{\Carbon\Carbon::parse($dateFrom)->format('F j, Y')}} to {{\Carbon\Carbon::parse($dateTo)->format('F j, Y')}}
            @endif
        </p>
        <br>
        
        <div>
            <table class="table table-bordered">
                    <thead style="background-color: #add8e6">
                       
                    <tbody style="font-size: 11px">
                        <tr>
                            <td colspan="10"style="background-color:#add8e6; text-align: center" ><b>LISTS</b></td>
                        </tr>
                        <tr>
                            <th><b>Trans. ID</b></th>
                            <th><b>Date</b></th>
                            <th><b>Time In</b></th>
                            <th><b>Entrance</b></th>
                            <th><b>Time Out</b></th>
                            <th><b>Exit</b></th>
                            <th><b>User ID</b></th>
                            <th><b>Last name</b></th>
                            <th><b>First name</b></th>
                            <th><b>User Type</b></th>
                        </tr>
                        @foreach ($dataHistory as $key => $value)
                        <tr>
                            <td><b style="color: #bb2124">{{ $value->transID }}</b></td>
                            <td>{{\Carbon\Carbon::parse($value->dateIn)->format('F j, Y')}}</td>
                            <td>{{ $value->timeIn }}</td>
                            <td>{{ $value->entrance }}</td>
                            <td>{{ $value->timeOut }}</td>
                            <td>{{ $value->ext }}</td>
                            <td>{{ $value->user_id }}</td>
                            
                                @php
                                    $full = DB::table('users')->where('id', $value->uID)->get();
                                    foreach($full as $name)
                                    {
                                        echo '<td>'.$name->lname.'</td>';
                                        echo '<td>'.$name->fname.'</td>';
                                    }
                                @endphp
                            <td>@php echo ucfirst($value->userType); @endphp</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br><br>
    <div style="font-size: 12px">
        <p><b>Noted by:</b></p>
        <p>Lardizabal M. Lupadit</p>
        <p>Chief Security Officer</p>
    </div>

  </body>
</html>