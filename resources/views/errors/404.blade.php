<x-admin-header/>
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Errors</a></li>
                                            <li class="breadcrumb-item active">404</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> 404 Error</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row justify-content-center">
                            <div class="col-lg-4">
                                <div class="text-center">
                                    <img src="/my-assets/admin/images/file-searching.svg" alt="File not found Image" height="90">

                                    <h1 class="text-error mt-4">404</h1>
                                    <h4 class="text-uppercase text-danger mt-3">Page Not Found</h4>
                                    <p class="text-muted mt-3">It's looking like you may have taken a wrong turn. Don't worry... it
                                        happens to the best of us. Here's a
                                        little tip that might help you get back on track.</p>

                                    <a class="btn btn-info mt-3" href="{{url('admin/dashboard')}}"><i class="mdi mdi-reply"></i> Return Home</a>
                                </div> <!-- end /.text-center-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->

                     <x-admin-footer/>