<x-admin-header/>
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/users')}}">Users</a></li>
                                            <li class="breadcrumb-item active">All Users</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class=" dripicons-user-group"></i> Users</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        
                                        <div class="row">
                                            <div class="col-sm-3">
                                            <a href="{{url('admin/users/add/superadmin')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add Super admin</a>
                                            <a href="{{url('admin/users/add/sp')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add SP</a>
                                            <a href="{{url('admin/users/add/oc')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add OC</a>
                                            <a href="{{url('admin/users/add/op1')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add operator 1</a>
                                            <a href="{{url('admin/users/add/op2')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add operator 2</a>
                                            <a href="{{url('admin/users/add/op3')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add operator 3</a>
                                            </div>
                                          <!-- end col-->
                                        </div>
                                        <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th >Name</th>
                                                    <th>District</th>
                                                    <th>Thana</th>
                                                    <th >Type</th>
                                                    <th >Email</th>
                                                    <th style="width: 86px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if($users)
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td  class="table-user"> 
                                                        <img src="{{ asset('storage/users/'.$user->picture) }}" alt="table-user" class="me-2 rounded-circle">

                                                        <span style="color:#0acf97 !important"><i class="mdi mdi-account-circle"></i></span>

                                                        {{$user->name}} 
                                                    
                                                    </td>
                                                    <td>@if (!empty($user->district->bn_name)) {{$user->district->bn_name}} @endif</td>
                                                    <td>@if (!empty($user->thana->bn_name)) {{$user->thana->bn_name}} @endif</td>
                                                    <td >
                                                        
                                                            <span class="badge bg-success">{{$user->type}}</span>
                                                        
                                                    </td>
                                                        
                                                    <td >{{$user->email}}</td>
                                                    
                                                    <td class="table-action">
                                                        @if (auth()->user()->id !== $user->id)
                                                        <a href="{{url('admin/users/uedit/'.$user->id)}}" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="{{url('admin/users/delete/'.$user->id)}}"  onclick="return confirm('Do you want to delete this user?')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        @if($users){{$users->appends(request()->input())->links()}} @endif
                                      
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                     
<x-admin-footer/>