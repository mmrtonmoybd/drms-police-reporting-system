a<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="https://animexdev.com/modpos/admin/lib/@fortawesome/fontawesome-free/font-awesomekit.js" crossorigin="anonymous"></script>  
    
    
<style type="text/css">

body {
    color:black!important;
}

   .droparrow {
       background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'><path fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/></svg>")!important;
curson:pointer;
}


   .droparrow:hover {
       background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'><path fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/></svg>")!important;
curson:pointer;
}



.page-title-box .page-title {
  font-size: 18px;
  margin: 0;
  line-height: 75px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  color: inherit;
  text-align: center!important;
}



.tablestyle {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.tablestyle td, .tablestyle th {
  border: 1px solid #ddd;
  padding: 8px;
}

.tablestyle tr:nth-child(even){background-color: #f2f2f2;}

.tablestyle tr:hover {background-color: #ddd;}

.tablestyle th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}





/* Breadcumb */

/* Breadcumb */

/* Breadcumb */

.page-title-box {
    /* border: 1px solid #ddd; */
    padding: 0px 25px;
    margin: 10px 0px;
    background: #fff;
    box-shadow: 1px 2px 4px 1px #e2deff;
    color: #fff;
    background: #810099;
    border-radius: 19px;
}

.breadcrumb-item.active {
    color: #ffffff;
}

li.breadcrumb-item a {
    color: lime;
    font-weight: 800;
}



/* Breadcumb */

/* Breadcumb */


i.fa-solid.fa-angle-down {
    font-size: 12px;
    padding: 0px 0px 5px 0px;
    position: relative;
 
}


a.side-nav-link.nav-link:hover {
  background: #ffffff30;
    background-size: 10px 80px;
}


.side-nav-link.nav-link {
  background: transparent;
}

.sidebar li .submenu{ 
	list-style: none; 
	margin: 0; 
	padding: 0; 
	padding-left: 1rem; 
	padding-right: 1rem;
}

.sidebar .nav-link {
    font-weight: 500;
    color: #fff;
}
.sidebar .nav-link:hover {
    color: #ddd;
}

.leftside-menu {
  position: fixed;
  overflow: auto;
}


.side-nav-link.nav-link {
  padding-right: 0px;
}

</style>


<script type="text/javascript">

	document.addEventListener("DOMContentLoaded", function(){

		document.querySelectorAll('.sidebar .nav-link').forEach(function(element){

			element.addEventListener('click', function (e) {

				let nextEl = element.nextElementSibling;
				let parentEl  = element.parentElement;	

				if(nextEl) {
					e.preventDefault();	
					let mycollapse = new bootstrap.Collapse(nextEl);

			  		if(nextEl.classList.contains('show')){
			  			mycollapse.hide();
			  		} else {
			  			mycollapse.show();
			  			// find other submenus with class=show
			  			var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
			  			// if it exists, then close all of them
						if(opened_submenu){
							new bootstrap.Collapse(opened_submenu);
						}

			  		}
		  		}

			});
		})

	}); 
	// DOMContentLoaded  end
</script>



<div class="leftside-menu">
    <nav class="sidebar">
    
                <!-- LOGO -->
                <a href="{{url('admin/dashboard')}}" class="logo text-center logo-light" style="color: #FFF;text-decoration:none;z-index: 1000;">
                    <span class="logo-lg" style="color:#FFF">
                        <h1>DRMS</h1>
                        <p></p>
                    </span>
                    <span class="logo-sm" style="color:#FFF">
                        <h1>DB</h1>
                    </span>
                </a>

              
    
                <div class="" id="leftside-menu-container " data-simplebar>

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title side-nav-item nav-item">Navigation</li>
                        <li class="side-nav-item nav-item">
                            <a href="{{ url('admin/dashboard') }}" class="side-nav-link nav-link">
                               <i class="fa-solid fa-gauge"></i>
                                <span> Home </span>
                            </a>
                        </li>

<!--------
                        <li class="side-nav-item nav-item">
                            <a href="{{url('admin/cases')}}" class="side-nav-link nav-link">
                         <i class="fa-sharp fa-solid fa-database"></i>
                                <span> Case Data </span>
                            </a>
                        </li>
---->
                        
                        @canany(['qrr.dashboard', 'qrr.add', 'qrr.view'])

                        <li class="side-nav-item nav-item has-submenu">
		<a class="side-nav-link nav-link" href="#">  <i class="fa-solid fa-tachograph-digital"></i>  QRR <i class="fa-solid fa-angle-down"></i> </a>
		<ul class="submenu collapse @if(request()->is('admin/qrrs/*') || request()->is('admin/qrrs')) show @endif"> 
            @can('qrr.dashboard')
			<li>         <a href="{{url('admin/qrrs/srcs')}}" class="side-nav-link nav-link  ">
                           <i class="fa-solid fa-chart-line"></i>
                                <span> QRR Dashboard</span>
                            </a>
            </li>

            @endcan
            
            @can('qrr.add')
            	<li>         <a href="{{url('admin/qrrs/add')}}" class="side-nav-link nav-link  ">
                           <i class="fa-solid fa-plus"></i>
                                <span> Add QRR</span>
                            </a>
            </li>
            @endcan
            
            
            
            @can('qrr.view')
		    <li>
		      <a href="{{url('admin/qrrs')}}" class="side-nav-link nav-link ">
                          <i class="fa-solid fa-list-ul"></i>
                                <span> QRR List </span>
                            </a>
		    </li>
            @endcan
		   
		</ul>
	</li>
    @endcanany
	
	
                      <!--------  
                        <li class="side-nav-item nav-item">
                            <a href="{{url('admin/pros')}}" class="side-nav-link nav-link">
                            <i class="mdi mdi-home-city-outline"></i>
                                <span> PRO </span>
                            </a>
                        </li>

---->

<!--------
                        <li class="side-nav-item nav-item ">
                            <a href="{{url('admin/qrrs/srcs')}}" class="side-nav-link nav-link  ">
                            <i class="mdi mdi-home-city-outline"></i>
                                <span> QRR Dashboard</span>
                            </a>
                        </li>

                        <li class="side-nav-item nav-item ">
                            <a href="{{url('admin/qrrs')}}" class="side-nav-link nav-link ">
                            <i class="mdi mdi-home-city-outline"></i>
                                <span> QRR </span>
                            </a>
                        </li>
                        
                        --->
                        
                        <!--------
                        <li class="side-nav-item nav-item">
                            <a href="{{url('admin/undeaths')}}" class="side-nav-link nav-link">
                            <i class="fa-solid fa-person-falling-burst"></i>
                                <span> Unnatural Death </span>
                            </a>
                        </li>
                    -->

                         @canany(['narcotic.add', 'narcotic.dashboard', 'narcotic.view'])

                        <li class="side-nav-item nav-item has-submenu">
		<a class="side-nav-link nav-link" href="#">  <i class="fa-solid fa-tablets"></i>  Narcotics <i class="fa-solid fa-angle-down"></i> </a>
		<ul class="submenu collapse @if(request()->is('admin/narcotic/*') || request()->is('admin/narcotic')) show @endif"> 
            @can('narcotic.dashboard')
			<li>         <a href="{{url('admin/narcotic/dashboard')}}" class="side-nav-link nav-link  ">
                           <i class="fa-solid fa-chart-line"></i>
                                <span> Narcotics Dashboard</span>
                            </a>
            </li>

            <li>         <a href="{{url('admin/narcotic/totalcase')}}" class="side-nav-link nav-link  ">
                           <i class="fa-solid fa-chart-line"></i>
                                <span> Narcotics case number</span>
                            </a>
            </li>

            <li>         <a href="{{url('admin/narcotic/recover')}}" class="side-nav-link nav-link  ">
                           <i class="fa-solid fa-chart-line"></i>
                                <span> Narcotics recover</span>
                            </a>
            </li>

            @endcan
            
            @can('narcotic.add')
            	<li>         <a href="{{url('admin/narcotic/add')}}" class="side-nav-link nav-link  ">
                           <i class="fa-solid fa-plus"></i>
                                <span> Add Narcotic</span>
                            </a>
            </li>
            @endcan
            
            
            
            @can('narcotic.view')
		    <li>
		      <a href="{{url('admin/narcotic')}}" class="side-nav-link nav-link ">
                          <i class="fa-solid fa-list-ul"></i>
                                <span> Narcotics List </span>
                            </a>
		    </li>
            @endcan
		   
		</ul>
	</li>
    @endcanany


        
                     @canany(['woman.dashboard', 'woman.add', 'woman.view'])

                        <li class="side-nav-item nav-item has-submenu">
		<a class="side-nav-link nav-link" href="#">  <i class="fa-solid fa-children"></i>  Women and children <i class="fa-solid fa-angle-down"></i> </a>
		<ul class="submenu collapse @if(request()->is('admin/woman/*') || request()->is('admin/woman')) show @endif"> 
            @can('woman.dashboard')
			<li>         <a href="{{url('admin/woman/dashboard')}}" class="side-nav-link nav-link  ">
                           <i class="fa-solid fa-chart-line"></i>
                                <span> Women and children Dashboard</span>
                            </a>
            </li>

            @endcan
            
            @can('woman.add')
            	<li>         <a href="{{url('admin/woman/add')}}" class="side-nav-link nav-link  ">
                           <i class="fa-solid fa-plus"></i>
                                <span> Add Women and children</span>
                            </a>
            </li>
            @endcan
            
            
            
            @can('woman.view')
		    <li>
		      <a href="{{url('admin/woman')}}" class="side-nav-link nav-link ">
                          <i class="fa-solid fa-list-ul"></i>
                                <span> Women and children List </span>
                            </a>
		    </li>
            @endcan
		   
		</ul>
	</li>
    @endcanany

                        @canany(['warrant.dashboard', 'warrant.add', 'warrant.view'])

                        <li class="side-nav-item nav-item has-submenu">
		<a class="side-nav-link nav-link" href="#">  <i class="fa-solid fa-handcuffs"></i>  Warrant <i class="fa-solid fa-angle-down"></i> </a>
		<ul class="submenu collapse @if(request()->is('admin/warrant/*') || request()->is('admin/warrant')) show @endif"> 
            @can('warrant.dashboard')
			<li>         <a href="{{url('admin/warrant/dashboard')}}" class="side-nav-link nav-link  ">
                           <i class="fa-solid fa-chart-line"></i>
                                <span> Warrant Dashboard</span>
                            </a>
            </li>

            @endcan
            
            @can('warrant.add')
            	<li>         <a href="{{url('admin/warrant/add')}}" class="side-nav-link nav-link  ">
                           <i class="fa-solid fa-plus"></i>
                                <span> Add Warrant</span>
                            </a>
            </li>
            @endcan
            
            
            
            @can('warrant.view')
		    <li>
		      <a href="{{url('admin/warrant')}}" class="side-nav-link nav-link ">
                          <i class="fa-solid fa-list-ul"></i>
                                <span> Warrant List </span>
                            </a>
		    </li>
            @endcan
		   
		</ul>
	</li>
    @endcanany


<!-------
                        @can('setting.view')
                    
                         <li class="side-nav-item nav-item">
                            <a href="{{url('admin/settings')}}" class="side-nav-link nav-link">
                            <i class="dripicons-gear noti-icon"></i>
                                <span> Settings </span>
                            </a>
                        </li>
                        @endcan
-------->
                        @canany(['role.view', 'user.view'])

                        <li class="side-nav-item nav-item has-submenu ">
		<a class="side-nav-link nav-link" href="#">  <i class="fa-solid dripicons-user-group"></i>  Users manager <i class="fa-solid fa-angle-down"></i> </a>
		<ul class="submenu collapse @if(request()->is('admin/users/*') || request()->is('admin/users')) show @endif">
            @can('role.view')
        <li>         <a href="{{url('admin/users/role')}}" class="side-nav-link nav-link  ">
                           <i class="fa-solid fa-users"></i>
                                <span> Role</span>
                            </a>
            </li>
            @endcan
            @can('user.view')
			<li>         <a href="{{url('admin/users')}}" class="side-nav-link nav-link  ">
                           <i class="fa-solid fa-list-ul"></i>
                                <span> User list</span>
                            </a>
            </li>
            @endcan
            
            
            	
            
		   
		</ul>
	</li>
    @endcanany
                        
                       

                        <li class="side-nav-item nav-item">
                            <a href="{{url('admin/logout')}}" class="side-nav-link nav-link text-warning">
                               <i class="fa-solid fa-right-from-bracket"></i>
                                <span> Logout </span>
                            </a>
                        </li>
                        

                    </ul>


                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->
</nav>
            </div>
            <!-- Left Sidebar End -->
            
            

            
        