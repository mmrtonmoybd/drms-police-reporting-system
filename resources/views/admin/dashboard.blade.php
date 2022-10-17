
<x-admin-header/>
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title"><i class="uil-home-alt"></i> Dashboard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body  bg-danger text-white">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5 style="color:#FFF !important" class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Users</h5>
                                                <h3 class="my-2 py-1">{{$total_user}}</h3>
                                     
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <i class="dripicons-user "></i>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                            
                            

                            <div class="col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body bg-danger text-white">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5  style="color:#FFF !important" class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Loged In</h5>
                                                <h3 class="my-2 py-1">{{$total_logedin}}</h3>
                                     
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <i class="mdi mdi-login
                                                    "></i>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
        
                        </div>
                        <!-- end row -->


                        <x-admin-footer/>