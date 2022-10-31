<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/hyper/saas/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jul 2021 06:52:05 GMT -->

<head>
        <meta charset="utf-8" />
        <title> DRMS | Management</title>
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
<style>
        .hidden {
    display: none;
    }
    
    .button-menu-mobile.open-left {
  color: #fff;
}

.navbar-custom .topbar-menu .nav-link {
  padding: 0;
  color: #98a6ad;
  min-width: 32px;
  display: block;
  text-align: center;
  margin: 0 10px;
  position: relative;
}


.side-nav-link.nav-link.active {
    color: #fff !important;
background: #6d7fcc2e;
border-left: 3px solid #0ACF97!important;
}


.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-top {
  z-index: 2000 !important;
}
                   
                        
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- chart JS -->

            <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    @if (str_contains(url()->current(), '/admin/qrrs/srcs') || str_contains(url()->current(), '/admin/qrrs/charts'))
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      @if (auth()->user()->hasRole('Super Admin'))

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['District', 'Incident', { role: 'style' }, {role: 'annotation', type: 'string'}],
         ['বরগুনা', {{session('borgona')}}, '#26a49a', '{{session("borgona")}}'],            // RGB value
         ['বরিশাল', {{session('barisal')}}, '#e94236', '{{session("barisal")}}'],         // English color name
         ['পিরোজপুর', {{session('pirojpur')}}, 'color: #37761d', '{{session("pirojpur")}}' ],
         ['পটুয়াখালী', {{session('patuakhali')}}, 'color: #9b0001', '{{session("patuakhali")}}' ],
         ['ভোলা', {{session('bhola')}}, '#0c5295', '{{session("bhola")}}'],
         ['ঝালকাঠি', {{session('jalokhati')}}, 'color: #731b47',  '{{session("jalokhati")}}' ], // CSS-style declaration
        
       
      ]);

        // Set chart options
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
        
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      @endif

      @if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['District', 'Incident', { role: 'style' }, {role: 'annotation', type: 'string'}],
         
         @foreach(session("spthana") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}, 'color: #9b0001', '{{$value[0]}}' ],

         @endforeach
        
       
      ]);

        // Set chart options
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
        
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      @endif

      @if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['District', 'Incident', { role: 'style' }, {role: 'annotation', type: 'string'}],

         ['{{session("octhananame")}}', {{session('octhanavalue')}}, '#26a49a', '{{session("octhanavalue")}}'],

      ]);

        // Set chart options
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
        
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      @endif

      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['Information source', 'count'],
          ['এলাকা', {{session('insala')}}],
          ['কোর্ট',  {{session('inscou')}}],
          ['থানা',  {{session('instha')}}],
          ['৯৯৯', {{session('ins99')}}]
        ]);

        var options = {
          title: '',
          is3D: true,
        width: "98%",
        height: "172",
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

       // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart3);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart3() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Crime Type', 'Incident', { role: 'style' }, {role: 'annotation', type: 'string'}],
          ['মারামারি', {{session('etmara')}}, '#26a59a', '{{session("etmara")}}'],            // RGB value
         ['খুন', {{session('etkun')}}, '#26a59a', '{{session("etkun")}}'],            // English color name
         ['চুরি', {{session('etchori')}}, '#26a59a', '{{session("etchori")}}'],
         ['ডাকাতি', {{session('etdakati')}}, 'color: #26a59a', '{{session("etdakati")}}' ], // CSS-style declaration
         ['বিরোধ', {{session('etsompds')}}, '#26a59a', '{{session("etsompds")}}' ],
         ['নিখোঁজ', {{session('etnikoj')}}, '#26a59a', '{{session("etnikoj")}}' ],
         ['দস্যুতা', {{session('etdusht')}}, '#26a59a', '{{session("etdusht")}}' ],
         ['জুয়া', {{session('etjua')}}, '#26a59a', '{{session("etjua")}}' ],
         ['সড়ক দুর্ঘটনা', {{session('etsorokd')}}, '#26a59a', '{{session("etsorokd")}}' ],
         ['নারী ও শিশু', {{session('etnarios')}}, '#26a59a', '{{session("etnarios")}}' ],
         ['অগ্নিকান্ড', {{session('etagun')}}, '#26a59a', '{{session("etagun")}}' ],
         ['মাদক', {{session('etmadok')}}, '#26a59a', '{{session("etmadok")}}' ],
         ['সাইবার', {{session('etcyber')}}, '#26a59a', '{{session("etcyber")}}' ],
         ['প্রতারণা', {{session('etprota')}}, '#26a59a', '{{session("etprota")}}' ],
         ['দুর্ঘটনা', {{session('etrajnoi')}}, '#26a59a', '{{session("etrajnoi")}}' ],
         ['অন্যান্য', {{session('etonno')}}, '#26a59a', '{{session("etonno")}}' ],
      ]);

        // Set chart options
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }

      </script>

      @endif

      @if (str_contains(url()->current(), '/warrant/dashboard') || str_contains(url()->current(), '/warrant/search'))
           <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      @if (auth()->user()->hasRole('Super Admin'))

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['District', 'Recive', { role: 'style' }],
         ['বরগুনা', {{session('borgona')}}, '#b87333'],            // RGB value
         ['বরিশাল', {{session('barisal')}}, 'silver'],            // English color name
         ['ভোলা', {{session('bhola')}}, 'gold'],
         ['ঝালকাঠি', {{session('jalokhati')}}, 'color: #e5e4e2' ], // CSS-style declaration
         ['পটুয়াখালী', {{session('patuakhali')}}, 'color: #b87333' ],
         ['পিরোজপুর', {{session('pirojpur')}}, 'color: Romance' ],
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
          ['বরগুনা', {{session('borgonan')}}],            // RGB value
          ['বরিশাল', {{session('barisaln')}}],            // English color name
          ['ভোলা', {{session('bholan')}}],
          ['ঝালকাঠি', {{session('jalokhatin')}}], // CSS-style declaration
          ['পটুয়াখালী', {{session('patuakhalin')}}],
          ['পিরোজপুর', {{session('pirojpurn')}}]
        ]);

        var options = {
          title: 'নিষ্পত্তি by District wise',
          is3D: true,
          pieSliceText: 'value',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

       // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart3);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart3() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['District', 'পেন্ডিং', { role: 'style' }],
         ['বরগুনা', {{session('borgonap')}}, '#b87333'],            // RGB value
         ['বরিশাল', {{session('barisalp')}}, 'silver'],            // English color name
         ['ভোলা', {{session('bholap')}}, 'gold'],
         ['ঝালকাঠি', {{session('jalokhatip')}}, 'color: #e5e4e2' ], // CSS-style declaration
         ['পটুয়াখালী', {{session('patuakhalip')}}, 'color: #b87333' ],
         ['পিরোজপুর', {{session('pirojpurp')}}, 'color: Romance' ],
      ]);

        // Set chart options
        var options = {
        title: "District wise পেন্ডিং",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
      }

      @endif


      @if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Thana', 'Recive', { role: 'style' }],
         @foreach(session("spthana") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}, 'color: #9b0001'],

         @endforeach
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
          ['নিষ্পত্তি by Thana wise', 'count'],
          @foreach(session("spthanan") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}],

         @endforeach
        ]);

        var options = {
          title: 'নিষ্পত্তি by Thana wise',
          is3D: true,
          pieSliceText: 'value',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

       // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart3);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart3() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Thana', 'পেন্ডিং', { role: 'style' }],
         @foreach(session("spthanap") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}, 'color: #9b0001'],

         @endforeach
      ]);

        // Set chart options
        var options = {
        title: "District wise পেন্ডিং",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
      }

      @endif


      @if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Thana', 'Recive', { role: 'style' }],
         ['{{session("octhana")[1]}}', {{session('octhana')[0]}}, '#b87333']
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
          ['নিষ্পত্তি by Thana wise', 'count'],
         ['{{session("octhanan")[1]}}', {{session('octhanan')[0]}}]
        ]);

        var options = {
          title: 'নিষ্পত্তি by Thana wise',
          is3D: true,
          pieSliceText: 'value',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

       // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart3);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart3() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Thana', 'পেন্ডিং', { role: 'style' }],
         ['{{session("octhanap")[1]}}', {{session('octhanap')[0]}}, '#b87333']
      ]);

        // Set chart options
        var options = {
        title: "District wise পেন্ডিং",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
      }

      @endif

      

     
    </script>
      @endif

       <!-- chart JS -->

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
                                        <img src="{{ asset('storage/users'.auth()->user()->picture) }}" alt="user-image" class="rounded-circle">
                                    </span>
                                    <span>
                                        <span class="account-user-name">{{auth()->user()->name}}</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                    

                                    <!-- item-->
                                    @php
                                    $id = auth()->user()->id;
                                    @endphp
                                    <a href="{{url('admin/users/edit/'.$id)}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>My Account</span>
                                    </a>

                                    @can('setting.view')

                                    <!-- item-->
                                    <a href="{{url('admin/settings')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-edit me-1"></i>
                                        <span>Settings</span>
                                    </a>

                                    @endcan

                                    

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