@if(auth()->check())
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
@else

<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>404 Error Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>


    <body>
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="text-center">
                <h1 class="display-1 fw-bold">404</h1>
                <p class="fs-3"> <span class="text-danger">Opps!</span> Page not found.</p>
                <p class="lead">
                    The page you’re looking for doesn’t exist.
                  </p>
                <a href="{{url('/admin')}}" class="btn btn-primary">Go Home</a>
            </div>
        </div>
    </body>


</html>

@endif