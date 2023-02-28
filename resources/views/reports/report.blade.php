<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Monthly Report Compilation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <div style="text-align: center">
        <img src="{{ public_path('images/LogoUB.png')}}" style="width: 22%">
        <p><b>SECURITY OFFICE</b></p>
        <p>General Luna Road, Baguio City Philippines 2600</p>
        <hr style="background-color: black">
        <small><b>Telefax No.:(074) 442-3071  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Website: www.ubaguio.edu &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  E-mail Address: ub@ubaguio.edu</b></small>
    </div>



    <p><b>DATE &nbsp; &nbsp; &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo DATE("F d, Y")?></b></p>
    <p><b>TO &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ATTY. ROMMEL P. AYSON</b></p>
    <p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; VP for Administration</p>
    <p><b>SUBJECT :</b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Accomplishment Report for the Month of {{\Carbon\Carbon::parse($dateFrom)->format('F j, Y')}} - {{\Carbon\Carbon::parse($dateTo)->format('F j, Y')}}</p>

    
    <table class="table table-bordered">
    <thead style="background-color: #add8e6">
      <tr>
        <th><b>NO.</b></th>
        <th>AREAS OF CONCERN</th>
        <th>STATUS</th>
        <th>ACTION TAKEN</th>
        <th>DATE</th>
        <th>BY</th>
        <th>REMARKS</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($data as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->areasOfConcern }}</td>
            <td>{{ $row->status }}</td>
            <td>{{ $row->actionTaken }}</td>
            <td>
              {{\Carbon\Carbon::parse($row->created_at)->format('F j, Y')}}
            </td>
            <td>
                @php
                    $name = DB::table('users')->where('id', $row->user_id)->get();
                    foreach($name as $get_name)
                    {
                        echo $get_name->fname .' '. $get_name->lname;
                    }
                @endphp
            </td>
            <td>{{ $row->remarks }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>