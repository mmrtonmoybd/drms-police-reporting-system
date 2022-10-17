<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/hyper/saas/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jul 2021 06:52:31 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Log In </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('my-assets/admin') }}/images/favicon.ico">
        

        <link href="{{ asset('my-assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('my-assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('my-assets/admin/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
        <link href="{{ asset('my-assets/admin/css/custom.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header pt-4 pb-4 text-center bg-primary">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold text-white">Digital Automated Reporting and Monitoring System</h4>
                            </div>

                            <div class="card-body p-4">
                                
                            <div class="col">
                                <x-admin-validation-errors :errors="$errors->all()"/>
                            </div>
                                

                                <form action="{{url('admin/login')}}" method="POST">

                                    <div class="mb-3">
                                        <!-- <label for="emailaddress" class="form-label">Email address</label> -->
                                        @csrf
                                        <input class="form-control" name="email" type="email" value="{{old('email')}}" id="emailaddress" placeholder="Enter your email"  >
                                    </div>

                                    <div class="mb-3">
                                        
                                        <!-- <label for="password" class="form-label">Password</label> -->
                                        <div class="input-group input-group-merge">
                                            <input type="password" value="{{old('password')}}" name="password" id="password" class="form-control" placeholder="Enter your password" >
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 mb-0 text-center">
                                        <button class="btn btn-primary" type="submit"> Log In </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->


                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- <footer class="footer footer-alt">
            2018 - 2021 © Hyper - Coderthemes.com
        </footer> -->

        <!-- bundle -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script src="{{ asset('my-assets/admin/js/vendor.min.js') }}"></script>
        <script src="{{ asset('my-assets/admin/js/app.min.js') }}"></script>
        
    </body>

<!-- Mirrored from coderthemes.com/hyper/saas/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jul 2021 06:52:31 GMT -->
</html>
