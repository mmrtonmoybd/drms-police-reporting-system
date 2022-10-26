<div class="leftside-menu">
    
                <!-- LOGO -->
                <a href="{{url('admin/dashboard')}}" class="logo text-center logo-light" style="color: #FFF;text-decoration:none;">
                    <span class="logo-lg" style="color:#FFF">
                        <h1>DARMS</h1>
                        <p></p>
                    </span>
                    <span class="logo-sm" style="color:#FFF">
                        <h1>DB</h1>
                    </span>
                </a>

              
    
                <div class="h-100" id="leftside-menu-container" data-simplebar>

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title side-nav-item">Navigation</li>
                        <li class="side-nav-item">
                            <a href="{{ url('admin/dashboard') }}" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>


                        <li class="side-nav-item">
                            <a href="{{url('admin/cases')}}" class="side-nav-link">
                            <i class="mdi mdi-home-city-outline"></i>
                                <span> CASE DATA </span>
                            </a>
                        </li>
                        
                        <li class="side-nav-item">
                            <a href="{{url('admin/pros')}}" class="side-nav-link">
                            <i class="mdi mdi-home-city-outline"></i>
                                <span> PRO </span>
                            </a>
                        </li>

                        <li class="side-nav-item ">
                            <a href="{{url('admin/qrrs/srcs')}}" class="side-nav-link  ">
                            <i class="mdi mdi-home-city-outline"></i>
                                <span> QRR Dashboard</span>
                            </a>
                        </li>
                        
                        <li class="side-nav-item">
                            <a href="{{url('admin/undeaths')}}" class="side-nav-link">
                            <i class="mdi mdi-home-city-outline"></i>
                                <span> Unnatural Death </span>
                            </a>
                        </li>
                        
                        <li class="side-nav-item">
                            <a href="{{url('admin/narcotic')}}" class="side-nav-link">
                            <i class="mdi mdi-home-city-outline"></i>
                                <span> Narcotics </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{url('admin/women_and_childrens')}}" class="side-nav-link">
                            <i class="mdi mdi-home-city-outline"></i>
                                <span> Women and children </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{url('admin/warrant/dashboard')}}" class="side-nav-link">
                            <i class="mdi mdi-home-city-outline"></i>
                                <span> Warrant Dashboard</span>
                            </a>
                        </li>
                        
                        <li class="side-nav-item">
                            <a href="{{url('admin/warrant')}}" class="side-nav-link">
                            <i class="mdi mdi-home-city-outline"></i>
                                <span> Warrant </span>
                            </a>
                        </li>

                        
                    
                        @if(auth()->user()->type =='Admin')
                        
                        <li class="side-nav-item">
                            <a href="{{url('admin/settings')}}" class="side-nav-link">
                            <i class="dripicons-gear noti-icon"></i>
                                <span> Settings </span>
                            </a>
                        </li>
                        
                        
                        <li class="side-nav-item">
                            <a href="{{url('admin/users')}}" class="side-nav-link">
                                <i class=" dripicons-user-group
                                "></i>
                                <span> Users manager </span>
                            </a>
                        </li>
                        @endif
                        
                       

                        <li class="side-nav-item">
                            <a href="{{url('admin/logout')}}" class="side-nav-link text-warning">
                                <i class="mdi mdi-logout me-1"></i>
                                <span> Logout </span>
                            </a>
                        </li>
                        

                    </ul>


                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
            
            

            
        