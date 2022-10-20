<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/hyper/saas/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jul 2021 06:52:05 GMT -->

@php $session_user = Session::get('user');
@endphp
<head>
        <meta charset="utf-8" />
        <title> DARMS | Management</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('my-assets/admin') }}/images/favicon.ico">

        <!-- App css -->
        

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="{{ asset('my-assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('my-assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('my-assets/admin/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
        <link href="{{ asset('my-assets/admin/css/custom.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

        <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['District', 'Recive', { role: 'style' }],
         ['বরগুনা', {{$borgona}}, '#b87333'],            // RGB value
         ['বরিশাল', {{$barisal}}, 'silver'],            // English color name
         ['ভোলা', {{$bhola}}, 'gold'],
         ['ঝালকাঠি', {{$jalokhati}}, 'color: #e5e4e2' ], // CSS-style declaration
         ['পটুয়াখালী', {{$patuakhali}}, 'color: #b87333' ],
         ['পিরোজপুর', {{$pirojpur}}, 'color: Romance' ],
      ]);

        // Set chart options
        var options = {
        title: "Number of Revice",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['নিষ্পত্তি by District wise', 'count'],
          ['বরগুনা', {{$borgonan}}],            // RGB value
          ['বরিশাল', {{$barisaln}}],            // English color name
          ['ভোলা', {{$bholan}}],
          ['ঝালকাঠি', {{$jalokhatin}}], // CSS-style declaration
          ['পটুয়াখালী', {{$patuakhalin}}],
          ['পিরোজপুর', {{$pirojpurn}}]
        ]);

        var options = {
          title: 'নিষ্পত্তি by District wise',
          is3D: true,
          pieSliceText: 'value',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

      

     
    </script>

    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            
            <x-admin-left-menu />

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <div class="navbar-custom">
                        <ul class="list-unstyled topbar-menu float-end mb-0">
                            <li class="dropdown notification-list d-lg-none">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-search noti-icon"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                    <form class="p-3">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    </form>
                                </div>
                            </li>


                            <li class="notification-list">
                                <a class="nav-link end-bar-toggle" href="#">
                                <i class="dripicons-mail  noti-icon"></i>
                                    <span class="noti-icon-badge"></span>
                                </a>
                            </li>

                            <li class="notification-list">
                                <a class="nav-link end-bar-toggle" href="{{url('admin/settings')}}">
                                    <i class="dripicons-gear noti-icon"></i>
                                </a>
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">
                                    <span class="account-user-avatar"> 
                                        <img src="{{ asset('storage/users/'.$session_user['picture']) }}" alt="user-image" class="rounded-circle">
                                    </span>
                                    <span>
                                        <span class="account-user-name">{{$session_user['name']}}</span>
                                        <span class="account-position">{{$session_user['designation']}}</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                    

                                    <!-- item-->
                                    <a href="{{url('admin/users/edit/'.$session_user['id'])}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>My Account</span>
                                    </a>

                                    <!-- item-->
                                    <a href="{{url('admin/settings')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-edit me-1"></i>
                                        <span>Settings</span>
                                    </a>

                                    

                                    <!-- item-->
                                    <a href="{{url('admin/logout')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </li>

                        </ul>
                        <button class="button-menu-mobile open-left">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        
                    </div>
                    <!-- end Topbar -->

                    <!-- Start Content-->
                    <div class="container-fluid">

                    <script>
                        var xhttp = new XMLHttpRequest();
                        xhttp.open("GET", "{{url('admin/updatelogin')}}");
                        xhttp.send();
                        setInterval(function(){
                        xhttp.open("GET", "{{url('admin/updatelogin')}}");
                        xhttp.send();
                        },20000); 
                    </script>

<!-- start page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/warrant')}}">Warrants</a></li>
                                            <li class="breadcrumb-item active">{{$dis->bn_name}} Warrant</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="dripicons-scale"></i>{{$dis->bn_name}} Warrant</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        
                                        <div class="row">
                                            



                                            </div>

                                            <div id="chart_div"></div>
                                            <div id="piechart"></div>
                                            <div id="chart_div2"></div>

                                            <h3>{{$dis->bn_name}} মোট রিসিভ: {{ $trecive[0]['total_sum'] }}</h3>
                                            <h3>{{$dis->bn_name}} মোট নিষ্পত্তি: {{ $tnis[0]['total_sum'] }}</h3>

                                            <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th > জেলা </th>
                                                    <th > মোট রিসিভ  </th>
                                                    <th > মোট নিষ্পত্তি</th>
                                                    <th > মোট জিআর তামিল </th>
                                                    <th > মোট সিআর তামিল </th>
                                                    <th > মোট সাজা জিআর তামিল </th>
                                                    <th > মোট সাজা সিআর তামিল </th>
                                                    <th > মোট রিকল ও অন্যান্য </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if($wars)
                                            @foreach ($wars as $war)
                                                <tr>

                                                    <td > {{$dis->bn_name}}</td>
                                                    
                                                    <td > {{$war->total_recive}}</td>
                                                    <td > {{$war->total_nispotti}}</td>
                                                    <td > {{$war->total_gr_tamil}}</td>
                                                    <td > {{$war->total_cr_tamil}}</td>
                                                    <td > {{$war->total_saja_gr_tamil}}</td>
                                                    <td > {{$war->total_saja_cr_tamil}}</td>
                                                    <td > {{$war->total_recall}}</td>
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                     
<x-admin-footer/>

