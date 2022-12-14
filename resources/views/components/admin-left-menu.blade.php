   
<style>

.card-body.table-responsive {
  overflow: auto;
  height: 90vh;
}



.item-name a:hover {
  background: aliceblue;
}

.item-name.active {
  background: #d3eaff;
}
</style>

   <div class="sidebar-panel">
       
            <div class="gull-brand pr-3 text-center mt-4 mb-2 d-flex justify-content-center align-items-center"><img class="pl-3" src="{{url('logo-drms.jpg')}}" alt="alt" /><span class="item-name" style="color: #1b1769;font-size: 33px;font-weight: bold;">DRMS</span>
     
	 <!--  <span class=" item-name text-20 text-primary font-weight-700">GULL</span> -->
   
	    @if (session("sidebar") == 1)
  <a href="{{ url('admin/adminsidebarcollapase?sidebar=0') }}"> 
   
      @else 
         <a href="{{ url('admin/adminsidebarcollapase?sidebar=1') }}">   

      @endif
		
            
            <div class="sidebar-compact-switch ml-auto"><span></span></div> </a>
            </div>
            <!--  user -->
            <div class="scroll-nav ps ps--active-y" data-perfect-scrollbar="data-perfect-scrollbar" data-suppress-scroll-x="true">
                <div class="side-nav">
                    <div class="main-menu">
                        <ul class="metismenu" id="menu">
						
						
						  <li class="Ul_li--hover"><a href="{{ url('admin/dashboard') }}"><i class="fa-solid fa-home text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Home</span></a></li>
						  
						  <!------
						  
						  <li class="Ul_li--hover"><a href="{{url('admin/cases')}}"><i class="fa-sharp fa-solid fa-database text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Case Data</span></a></li>
						-->
						

            @canany(['case.dashboard', 'case.add', 'case.view'])
							<li class="Ul_li--hover">@if (session("sidebar") == 1) <a class="has-arrow without-after-element" href="#"> @else <a class="has-arrow" href="#"> @endif<i class="fa-solid fa-tachograph-digital text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Case</span></a>
                                <ul class="mm-collapse @if(request()->is('admin/case/*') || request()->is('admin/case')) mm-show @endif">
                                  @can('case.dashboard')
									 <li class="item-name "><a href="{{url('admin/case/dashboard')}}"><i class="fa-solid fa-chart-line mr-2 text-muted"></i><span class="text-muted">Dashboard</span></a></li>
                                  @endcan
								  
								    @can('case.add')
								   <li class="item-name"><a href="{{url('admin/case/add')}}"><i class="fa-solid fa-plus mr-2 text-muted"></i><span class="text-muted">New</span></a></li>
                                   @endcan
								   
								    @can('case.view')
								  <li class="item-name"><a href="{{url('admin/case')}}"><i class="fa-solid fa-list-ul mr-2 text-muted"></i><span class="text-muted">Database</span></a></li>
									@endcan
                                </ul>
                            </li> 
					    @endcanany
						
						
					   @canany(['qrr.dashboard', 'qrr.add', 'qrr.view', 'qrr.review'])
							<li class="Ul_li--hover">@if (session("sidebar") == 1) <a class="has-arrow without-after-element" href="#"> @else <a class="has-arrow" href="#"> @endif<i class="fa-solid fa-tachograph-digital text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Qrr</span></a>
                                <ul class="mm-collapse @if(request()->is('admin/qrrs/*') || request()->is('admin/qrrs')) mm-show @endif">
                                  @can('qrr.dashboard')
									<li class="item-name "><a href="{{url('admin/qrrs/srcs')}}"><i class="fa-solid fa-chart-line mr-2 text-muted"></i><span class="text-muted">Dashboard</span></a></li>
                                  @endcan
								  
								    @can('qrr.add')
								   <li class="item-name"><a href="{{url('admin/qrrs/add')}}"><i class="fa-solid fa-plus mr-2 text-muted"></i><span class="text-muted">New</span></a></li>
                                   @endcan
								   
								    @can('qrr.view')
								  <li class="item-name"><a href="{{url('admin/qrrs')}}"><i class="fa-solid fa-list-ul mr-2 text-muted"></i><span class="text-muted">Database</span></a></li>
									@endcan

                  @can('qrr.review')
								  <li class="item-name"><a href="{{url('admin/qrrs/review')}}"><i class="fa-solid fa-list-ul mr-2 text-muted"></i><span class="text-muted">Database inactive</span></a></li>
									@endcan
                                </ul>
                            </li> 
					    @endcanany
							
							
							
						
						@canany(['narcotic.add', 'narcotic.dashboard', 'narcotic.view'])
						
						
						
					
      
						<!-----has-arrow without-after-element------->
							<li class="Ul_li--hover">@if (session("sidebar") == 1) <a class="has-arrow without-after-element" href="#"> @else <a class="has-arrow" href="#"> @endif<i class="fa-solid fa-tablets text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Narcotics</span></a>
                                <ul class="mm-collapse @if(request()->is('admin/narcotic/*') || request()->is('admin/narcotic')) mm-show @endif">
                                  @can('narcotic.dashboard')
								  
								  <li class="item-name"><a href="{{url('admin/narcotic/dashboard')}}"><i class="fa-solid fa-chart-line mr-2 text-muted"></i><span class="text-muted">Dashboard</span></a></li>

								  <li class="item-name"><a href="{{url('admin/narcotic/totalcase')}}"><i class="fa-solid fa-chart-line mr-2 text-muted"></i><span class="text-muted">Case number </span></a></li>
								  <li class="item-name"><a href="{{url('admin/narcotic/recover')}}"><i class="fa-solid fa-chart-line mr-2 text-muted"></i><span class="text-muted">Recover</span></a></li>
									 @endcan
									 
								@can('narcotic.add')
								  <li class="item-name"><a href="{{url('admin/narcotic/add')}}"><i class="fa-solid fa-plus mr-2 text-muted"></i><span class="text-muted">New</span></a></li>
							    @endcan
								   
								@can('narcotic.view')
								 <li class="item-name"><a href="{{url('admin/narcotic')}}"><i class="fa-solid fa-list-ul mr-2 text-muted"></i><span class="text-muted">Database</span></a></li>
							    @endcan
									 
									 
                                </ul>
                            </li> 
				
						  @endcanany							





  @canany(['woman.dashboard', 'woman.add', 'woman.view'])
							<li class="Ul_li--hover">@if (session("sidebar") == 1) <a class="has-arrow without-after-element" href="#"> @else <a class="has-arrow" href="#"> @endif<i class="fa-solid fa-children text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Women & child</span></a>
                                <ul class="mm-collapse @if(request()->is('admin/woman/*') || request()->is('admin/woman')) mm-show @endif">
                                  @can('woman.dashboard')
									<li class="item-name "><a href="{{url('admin/woman/dashboard')}}"><i class="fa-solid fa-chart-line mr-2 text-muted"></i><span class="text-muted">Dashboard</span></a></li>
                                  @endcan
								  
								    @can('woman.add')
								   <li class="item-name"><a href="{{url('admin/woman/add')}}"><i class="fa-solid fa-plus mr-2 text-muted"></i><span class="text-muted">New</span></a></li>
                                   @endcan
								   
								    @can('woman.view')
								  <li class="item-name"><a href="{{url('admin/woman')}}"><i class="fa-solid fa-list-ul mr-2 text-muted"></i><span class="text-muted">Database</span></a></li>
									@endcan
                                </ul>
                            </li> 
					    @endcanany
							

                          
						  
						  
						  
  @canany(['warrant.dashboard', 'warrant.add', 'warrant.view'])
  
							<li class="Ul_li--hover">@if (session("sidebar") == 1) <a class="has-arrow without-after-element" href="#"> @else <a class="has-arrow" href="#"> @endif<i class="fa-solid fa-handcuffs text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Warrant</span></a>
                                <ul class="mm-collapse @if(request()->is('admin/warrant/*') || request()->is('admin/warrant')) mm-show @endif">
                                  @can('warrant.dashboard')
									<li class="item-name "><a href="{{url('admin/warrant/dashboard')}}"><i class="fa-solid fa-chart-line mr-2 text-muted"></i><span class="text-muted">Dashboard</span></a></li>
                                  @endcan
								  
								    @can('warrant.add')
								   <li class="item-name"><a href="{{url('admin/warrant/add')}}"><i class="fa-solid fa-plus mr-2 text-muted"></i><span class="text-muted">Add warrant </span></a></li>
                                   @endcan
								   
								    @can('warrant.view')
								  <li class="item-name"><a href="{{url('admin/warrant')}}"><i class="fa-solid fa-list-ul mr-2 text-muted"></i><span class="text-muted">Warrant List</span></a></li>
									@endcan
                                </ul>
                            </li> 
                            
                            
					    @endcanany
						
						
						
						
						 @canany(['role.view', 'user.view'])
							<li class="Ul_li--hover">@if (session("sidebar") == 1) <a class="has-arrow without-after-element" href="#"> @else <a class="has-arrow" href="#"> @endif<i class="fa-solid fa-user-group text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">User Manage</span></a>
                                <ul class="mm-collapse @if(request()->is('admin/role/*') || request()->is('admin/role')) mm-show @endif">
                                  @can('role.view')
									<li class="item-name"><a  href="{{url('admin/users/role')}}"><i class="fa-solid fa-chart-line mr-2 text-muted"></i><span class="text-muted">Role</span></a></li>
                                  @endcan
								  
								  
								   @can('user.view')
									<li class="item-name"><a href="{{url('admin/users')}}" ><i class="fa-solid fa-chart-line mr-2 text-muted"></i><span class="text-muted">User List</span></a></li>
                                  @endcan
								  
								  
								
                                </ul>
                            </li> 
					    @endcanany
						
						
						   <li class="Ul_li--hover"><a href="{{url('admin/logout')}}"><i class="fa-solid fa-right-from-bracket text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Logout</span></a></li>


                                  </ul>
                    </div>
                </div>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
                </div>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
                </div>
            </div>
            <!--  side-nav-close -->
        </div>
		
		
