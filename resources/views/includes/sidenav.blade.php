<div class="sidebar-container">
    
  <div class="sidebar-logo text-center">
    @if (Auth::user()->userType == 'admin')
    <div class="sidebar-heading"><b class="fas fa-user-tie"></b><b>&nbsp ADMINISTRATOR</b><b><sup><i>&nbsp M.I.S.</i></sup> </b></div>
    @endif

    @if (Auth::user()->userType == 'marshall')
    <div class="sidebar-heading"><b class="fas fa-user-tie"></b><b>&nbsp MARSHALL</b><b><sup><i>&nbsp U.B.S.D.</i></sup> </b></div>
    @endif

    @if (Auth::user()->userType == 'department')
    <div class="sidebar-heading"><b class="fas fa-sitemap"></b><b>&nbsp {{ strtoupper(Auth::user()->email) }} <sup><i>DEPARTMENT</i></sup> </b></div>
    @endif

    @if (Auth::user()->userType == 'visitor')
    <div class="sidebar-heading"><b class="fas fa-user-tie"></b><b>&nbsp VISITOR</b><b><sup><i>&nbsp M.I.S.</i></sup> </b></div>
    @endif
    
  </div>
  <nav class="sidebar">
  <ul class="sidebar-navigation">
    <li class="header">Navigation</li>
    @if (Auth::user()->userType == 'admin')
    <li>
      <a href="/users_management">
        <i class="fas fa-users"></i> User Management
      </a>
    </li>
    <li>
      <a href="/departments">
        <i class="fas fa-home"></i> Departments
      </a>
    </li>
    <li>
      <a href="/marshalls">
        <i class="fas fa-user-cog"></i> Marshalls
      </a>
    </li>
    <li>
      <a href="/user_archived">
        <i class="fas fa-user-times"></i> Archived Users
      </a>
    </li>
    @endif

    @if (Auth::user()->userType == 'marshall')
    <li>
      <a href="/dashboard">
        <i class="fas fa-chart-area"></i> Monitoring Page
      </a>
    </li>
    <li>
      <a href="/post_index">
        <i class="fas fa-dungeon"></i> Post Selection
      </a>
    </li>
    <li>
      <a href="/scan_page">
        <i class="fas fa-id-card"></i> Scan ID
      </a>
    </li>
    <li>
      <a href="/transactions">
        <i class="fas fa-clipboard"></i> Transactions 
      </a>
    </li>
    <li>
      <a href="/visitors">
        <i class="fas fa-users"></i> Visitors
      </a>
    </li>
    <li>
      <a href="/reports">
        <i class="fas fa-newspaper"></i> Reports
      </a>
    </li>
    <li>
      <a href="/blacklists">
        <i class="fas fa-ban"></i> Blocklist
      </a>
    </li>
    @endif


    @if (Auth::user()->userType == 'department')
    <li>
      <a href="/upcoming_appointments">
        <i class="fas fa-calendar-check"></i> Upcoming Appointments
      </a>
    </li>
    <li>
      <a href="/pending_appointments">
        <i class="fas fa-calendar-alt"></i> Pending Appointments
      </a>
    </li>
    <li>
      <a href="/history_appointments">
        <i class="fas fa-history"></i> Appointments History
      </a>
    </li>
    @endif




    @if (Auth::user()->userType == 'visitor')
    <li>
      <a href="{{route('barcode.generate')}}">
        <i class="fas fa-barcode"></i> My Barcode
      </a>
    </li>
    <li>
      <a href="/appointments/create">
        <i class="fas fa-calendar-plus"></i> New Appointment
      </a>
    </li>
    <li>
      <a href="/appointments">
        <i class="fas fa-list-ol"></i> My Appointment
      </a>
    </li>
    <li>
      <a href="/approved_myappointments">
        <i class="fas fa-calendar-check"></i> Approved Appointment
      </a>
    </li>
    <li>
      <a href="/pending_myappointments">
        <i class="fas fa-calendar-minus"></i> Pending Appointment
      </a>
    </li>
    <li>
      <a href="/denied_myappointments">
        <i class="fas fa-calendar-times"></i> Denied Appointment
      </a>
    </li>
    <li>
      <a href="/canceled_myappointments">
        <i class="fas fa-folder-minus"></i> Cancelled Appointment
      </a>
    </li>
    @endif       
  </ul>
</nav>
</div>