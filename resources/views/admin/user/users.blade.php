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
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="text-sm-end">
                                                    <form action="{{url('admin/users')}}" method="get">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="mb-3">
                                                                <input type="text" name="name"  id="name" class="form-control form-control-sm" placeholder=" Name" value="{{ $request->get('name') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="mb-3">
                                                                <input type="text" name="email"  id="email" value="{{$request->get('email')}}" class="form-control form-control-sm" placeholder=" Email">
                                                            </div>
                                                        </div>



                                                        <div class="col-sm-2">
                                                            <div class="mb-3">
                                                                <div class="d-grid">
                                                                    <button class="btn btn-primary  btn-sm btn-block" name="submit" value="submit"> 
                                                                        <i class="uil uil-search-alt"></i> 
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                                        <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th >Name</th>
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
                                                    <td >
                                                        
                                                            <span class="badge bg-success">{{$user->type}}</span>
                                                        
                                                    </td>
                                                        
                                                    <td >{{$user->email}}</td>
                                                    
                                                    <td class="table-action">
                                                        <a href="{{url('admin/users/edit/'.$user->id)}}" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="{{url('admin/users/delete/'.$user->id)}}"  onclick="return confirm('Do you want to delete this user?')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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