@if (auth()->check())
<!DOCTYPE html>
<html lang="en" dir="">


<!-- 20 Nov 2022 10:10:52 GMT -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
          <title>{{ headertitle() . ' | ' . config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900') }}" rel="stylesheet" />
    <link href="{{ asset('dist-assets/css/themes/lite-purple.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist-assets/css/plugins/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('dist-assets/css/plugins/fontawesome-5.css') }}" />
    <link href="{{ asset('dist-assets/css/plugins/metisMenu.min.css') }}" rel="stylesheet" />
	
	<link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css" integrity="sha512-fXnjLwoVZ01NUqS/7G5kAnhXNXat6v7e3M9PhoMHOTARUMCaf5qNO84r5x9AFf5HDzm3rEZD8sb/n6dZ19SzFA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">


        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	 <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
         <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
      @include('components.qrrg')
      @include('components.warrantg') 
      @include('components.narcoticg')
      @include('components.womang')
      @include('components.caseg')
      @include('components.casescg')



<style>


th {
  position: sticky!important;
  top: -20px!important;
  z-index: 1!important;
  background: #fff!important;
}

body {
	    font-family: 'SolaimanLipi', Arial, sans-serif !important;
}


.breadcrumb.m-0 {
  display: block ruby;
  text-align: right;
}



.card {
  border-radius: 6px;
}

.card-title {
  z-index: 2000;
  position: relative;
  color: #41136f;
}

.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-top {
  z-index: 5000 !important;

  position: relative;
}




   .droparrow {
       background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'><path fill='none' stroke='%231a1669' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/></svg>")!important;
curson:pointer;
background-repeat: no-repeat;
background-color: ;
background-size: 15px !important;
background-position: 90% 9px !important;
}


   .droparrow:hover {
       background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'><path fill='none' stroke='%231a1669' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/></svg>")!important;
curson:pointer;
background-repeat: no-repeat;
background-color: ;
background-size: 15px !important;
background-position: 90% 9px !important;
}



.stylish {
	background-color: transparent;
border: none;
  border-bottom-color: currentcolor;
  border-bottom-style: none;
  border-bottom-width: medium;
border-bottom: 2px solid #1a1669;
border-radius: 0px;
}

.stylish:hover {
	background-color: transparent;
border: none;
  border-bottom-color: currentcolor;
  border-bottom-style: none;
  border-bottom-width: medium;
border-bottom: 2px solid blue;
border-radius: 0px;
}



.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-top {
  z-index: 5000 !important;
  position: absolute!important;
}
</style>


</head>

<body class="text-left">


	    @if (session("sidebar") == 1)
<div class="app-admin-wrap layout-sidebar-vertical show sidebar-compact-onhover sidebar-closed sidebar-compact">
   

      @else 
<div class="app-admin-wrap layout-sidebar-vertical sidebar-full">

      @endif
		




   <x-admin-left-menu />

		
		    @if (session("sidebar") == 1)
<div class="main-content-wrap mobile-menu-content bg-off-white m-0 sidebar-full">
   

      @else 
 <div class="main-content-wrap mobile-menu-content bg-off-white m-0">

      @endif
		

            <header class="main-header bg-white d-flex justify-content-between p-2">
                <div class="header-toggle">
                    <div class="menu-toggle mobile-menu-icon">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
					
					
				<h3>	{{ headertitle() }} </h3>
 				
					
				             </div>
							 
							 
							    @php
                                    $id = auth()->user()->id;
                                    @endphp
						
                <div class="header-part-right">

					
					
					     
	 <a href="{{url('admin/users/edit/'.$id)}}" style="text-decoration:none; color:black;">
                     	<div style="display:inline-block;margin-right: 13px;"><img src="{{ asset(auth()->user()->picture) }}" width="50px" height="50px"></div>
                      
                     	<div style="display:inline-block;margin-right: 16px;">
					  <span style="font-weight:bold; font-size:13px;"> {{auth()->user()->name}} </span> <br>{{auth()->user()->type}}
					  
						    </a>
						   
                  </div>
                     <!-- Full screen toggle--><i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen=""></i>
               
                
				                  
					
					
					
					
                    <!-- Grid menu Dropdown-->
					
             <!------
			 <div class="dropdown dropleft"><i class="i-Safe-Box text-muted header-icon" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <div class="menu-icon-grid"><a href="#">
							<i class="i-Shop-4"></i> Home</a>
							<a href="#"><i class="i-Library"></i> UI Kits</a>
							<a href="#"><i class="i-Drop"></i> Apps</a><a href="#"><i class="i-File-Clipboard-File--Text"></i> Forms</a>
							<a href="#"><i class="i-Checked-User"></i> Sessions</a><a href="#"><i class="i-Ambulance"></i> Support</a>
							</div>
                        </div>
                    </div>
					
					--->
					
                </div>
				
				  </a>
            </header>
			

@endif