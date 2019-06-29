
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Electronic Patients Medical Record System</title>
  
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="/css/fSelect.css">
  {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> --}}  
  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item">
           
        </li>        
      </ul>           
     
    </nav>
    <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="images/logo.png" alt="EMR Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">EMR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="images/doctor.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->title ." ".  Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  
          <li class="nav-item">
            <router-link to="/patients" class="nav-link">
              <i class="nav-icon fas fa-procedures"></i>
              <p>
                All Patients             
              </p>
            </router-link>
          </li>

          {{-- Condition to show for admin --}} 
          @if (Auth::user()->role == "admin")                                
          <li class="nav-item">
            <router-link to="/add-biodata" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Add Patient Biodata             
              </p>
            </router-link>
          </li>         
          <li class="nav-item">
            <router-link to="/vitals" class="nav-link">
              <i class="nav-icon fas fa-heartbeat"></i>
              <p>
                Patient Vitals             
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/add-vital" class="nav-link">
              <i class="nav-icon fas fa-heartbeat"></i>
              <p>
                Add Patient Vitals             
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/hospital" class="nav-link">
              <i class="nav-icon fas fa-hospital-symbol"></i>
              <p>
                Hospital History            
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/add-hospital" class="nav-link">
              <i class="nav-icon fas fa-hospital-symbol"></i>
              <p>
                Add Hospital History            
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/add-surgery" class="nav-link">
              <i class="nav-icon fas fa-user-md"></i>
              <p>
                Add Surgery History            
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/surgery" class="nav-link">
              <i class="nav-icon fas fa-user-md"></i>
              <p>
                Surgery History            
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/give-injection" class="nav-link">
              <i class="nav-icon fas fa-syringe"></i>
              <p>
                Give Injection
              </p>
            </router-link>
          </li>         
          <li class="nav-item">
            <router-link to="/complain" class="nav-link">
              <i class="nav-icon fas fa-diagnoses"></i>
              <p>
                Fill Patient Diagnosis             
              </p>
            </router-link>
          </li>        
          <li class="nav-item">
            <router-link to="/diagnosed" class="nav-link">
              <i class="nav-icon fas fa-vials"></i>
              <p>
                Diagnosed Patient
              </p>
            </router-link>
          </li>                           
          <li class="nav-item">
            <router-link to="/appointment" class="nav-link">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>
                Schedule Appointment
              </p>
            </router-link>
          </li>     
           <li class="nav-item">
            <router-link to="/lab-test" class="nav-link">
              <i class="nav-icon fas fa-vial"></i>
              <p>
                Refered Details from Doctor
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/labresult" class="nav-link">
              <i class="nav-icon fas fa-vial"></i>
              <p>
               Lab Result
              </p>
            </router-link>
          </li>                        
          <li class="nav-item">
            <router-link to="/pham-test" class="nav-link">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>
                  Get Refered Details             
              </p>
            </router-link>
          </li>         
          <li class="nav-item">
            <router-link to="/medication" class="nav-link">
              <i class="nav-icon fas fa-comment-medical"></i>
              <p>
                  Patients on medication
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/billing" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Billing
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/staff" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Add Staff
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/all-staffs" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                All Staffs
              </p>
            </router-link>
          </li>
          @endif
          {{-- End Condition to show for admin --}}


          {{-- Condition to show for receptionist --}} 
          @if (Auth::user()->role == "recept" )                                
          <li class="nav-item">
            <router-link to="/add-biodata" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Add Patient Biodata             
              </p>
            </router-link>
          </li>
          @endif 
          {{-- End Condition to show for receptionist --}}

          {{-- Condition to show for nurse --}}
          @if (Auth::user()->role == "nurse" )          
          <li class="nav-item">
            <router-link to="/vitals" class="nav-link">
              <i class="nav-icon fas fa-heartbeat"></i>
              <p>
                Patient Vitals             
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/add-vital" class="nav-link">
              <i class="nav-icon fas fa-heartbeat"></i>
              <p>
                Add Patient Vitals             
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/hospital" class="nav-link">
              <i class="nav-icon fas fa-hospital-symbol"></i>
              <p>
                Hospital History            
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/add-hospital" class="nav-link">
              <i class="nav-icon fas fa-hospital-symbol"></i>
              <p>
                Add Hospital History            
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/add-surgery" class="nav-link">
              <i class="nav-icon fas fa-user-md"></i>
              <p>
                Add Surgery History            
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/surgery" class="nav-link">
              <i class="nav-icon fas fa-user-md"></i>
              <p>
                Surgery History            
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/give-injection" class="nav-link">
              <i class="nav-icon fas fa-syringe"></i>
              <p>
                Give Injection
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/billing" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Billing
              </p>
            </router-link>
          </li>
          @endif
          {{-- End Condition to show for nurse --}}

          {{-- Condition to show for doctor --}}
          @if (Auth::user()->role == "doc"  )                    
          <li class="nav-item">
              <router-link to="/vitals" class="nav-link">
                <i class="nav-icon fas fa-heartbeat"></i>
                <p>
                  Patient Vitals             
                </p>
              </router-link>
            </li>        
            <li class="nav-item">
              <router-link to="/hospital" class="nav-link">
                <i class="nav-icon fas fa-hospital-symbol"></i>
                <p>
                  Hospital History            
                </p>
              </router-link>
            </li>            
            <li class="nav-item">
              <router-link to="/surgery" class="nav-link">
                <i class="nav-icon fas fa-user-md"></i>
                <p>
                  Surgery History            
                </p>
              </router-link>
            </li>   
            <li class="nav-item">
                <router-link to="/complain" class="nav-link">
                  <i class="nav-icon fas fa-diagnoses"></i>
                  <p>
                    Fill Patient Diagnosis             
                  </p>
                </router-link>
              </li>     
          <li class="nav-item">
            <router-link to="/diagnosed" class="nav-link">
              <i class="nav-icon fas fa-vials"></i>
              <p>
                Diagnosed Patient
              </p>
            </router-link>
          </li>                           
          <li class="nav-item">
            <router-link to="/appointment" class="nav-link">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>
                Schedule Appointment
              </p>
            </router-link>
          </li>
          <li class="nav-item">
              <router-link to="/labresult" class="nav-link">
                <i class="nav-icon fas fa-vial"></i>
                <p>
                 Lab Result
                </p>
              </router-link>
            </li>
          <li class="nav-item">
            <router-link to="/billing" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Billing
              </p>
            </router-link>
          </li>
          @endif
          {{-- End Condition to show for doctor --}}

           {{-- Condition to show for lab --}}  
           @if (Auth::user()->role == "lab" )        
           <li class="nav-item">
            <router-link to="/lab-test" class="nav-link">
              <i class="nav-icon fas fa-vial"></i>
              <p>
                Refered Details from Doctor
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/labresult" class="nav-link">
              <i class="nav-icon fas fa-vial"></i>
              <p>
               Lab Result
              </p>
            </router-link>
          </li>         
          <li class="nav-item">
            <router-link to="/billing" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Billing
              </p>
            </router-link>
          </li>
          @endif
          {{-- End Condition to show for lab --}}

          {{-- Condition to show for pharmacy --}}
          @if (Auth::user()->role == "pharm" )          
          <li class="nav-item">
            <router-link to="/pham-test" class="nav-link">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>
                  Get Refered Details             
              </p>
            </router-link>
          </li>         
          <li class="nav-item">
            <router-link to="/medication" class="nav-link">
              <i class="nav-icon fas fa-comment-medical"></i>
              <p>
                  Patients on medication
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/billing" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Billing
              </p>
            </router-link>
          </li>
          @endif
          {{-- End Condition to show for pharmacy --}}


          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
               Profile Details             
              </p>
            </router-link>
          </li>
          <li class="nav-item">            
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">       
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          <router-view></router-view>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --> 

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Electronic Patients Medical Record System
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">EMR</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<script src="/js/app.js"></script>
<script src="/js/fSelect.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"> </script>  
{{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script> --}}
{{-- <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}
{{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}


<script>
 
  </script>
</body>
</html>
