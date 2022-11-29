<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/users')}}">Users</a></li>
                                            <li class="breadcrumb-item active">Edit profile</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class=" dripicons-document-edit "></i> Edit profile</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/users/edit/'.$user->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="user_name" class="form-label ">User name</label>
                                                    <input type="text" name="name" id="user_name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="User Name" required >
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">User email</label>
                                                    <input type="email"  value="{{$user->email}}" id="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" disabled>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="designation" class="form-label">User Designation</label>
                                                    <input type="text"  value="{{$user->designation}}" id="designation" class="form-control  @error('designation') is-invalid @enderror" placeholder="Designation" disabled>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="bp_no" class="form-label">User BP No</label>
                                                    <input type="text"  value="{{$user->bp_no}}" id="bp_no" class="form-control  @error('bp_no') is-invalid @enderror" placeholder="BP No" disabled>
                                                </div>
                                            </div>

                                            @if (auth()->user()->getRoleNames()[0] !== 'Super Admin')

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">User District</label>
                                                    <input type="email"  value="@if(!empty($user->district->bn_name)) {{$user->district->bn_name}} @endif" id="email" class="form-control" disabled>
                                                </div>
                                            </div>

                                            @if ((auth()->user()->getRoleNames()[0] == 'OC') || (auth()->user()->getRoleNames()[0] == 'OC-Operator 1') || (auth()->user()->getRoleNames()[0] == 'OC-Operator 2') || (auth()->user()->getRoleNames()[0] == 'OC-Operator 3'))

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">User Thana</label>
                                                    <input type="email"  value="@if(!empty($user->thana->bn_name)) {{$user->thana->bn_name}} @endif" id="email" class="form-control" disabled>
                                                </div>
                                            </div>
                                            @endif

                                            @endif
                                        
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="picture" class="form-label">Profile picture <small>(300px X 300px)</small></label>
                                                    <input type="file" name="picture" id="picture" class="form-control" placeholder="Profile picture">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Current Password</label>
                                                    <input type="password" name="current_password" id="password" class="form-control  @error('current_password') is-invalid @enderror" placeholder="Current Password" >
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password" >
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="confirm-password" class="form-label">Confirm password</label>
                                                    <input type="password" name="confirm-password" id="confirm-password" class="form-control  @error('password') is-invalid @enderror" placeholder="Confirm Password" >
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                </form>
                            </div>
                        </div>
                        <!-- end row -->

                     <x-admin-footer/>