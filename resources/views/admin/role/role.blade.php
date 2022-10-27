<x-admin-header />
<!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/users/role')}}">Roles</a></li>
                                            <li class="breadcrumb-item active">All Roles</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="dripicons-scale"></i> Roles</h4>
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
                                            <div class="col-sm-2">
                                            <a href="{{url('admin/users/role/add')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add Role</a>
                                            </div>

                                           
                                            
                                        </div>
                                        <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th > রেফারেন্স নং </th>
                                                    <th > Name </th>
                                                    <th > Total permissions </th>
                                                    <th > Total User in role </th>
                                                    <th style="width: 86px">Action</th>
                                                </tr>
                                            </thead>

                                        @php
                                        use Illuminate\Support\Facades\DB;

                                        function getTotalp($id) {
                                            $get = DB::table('role_has_permissions')->where('role_id', '=', $id)->count();
                                            return $get;
                                        }

                                        function getTotalu($id) {
                                            $get = DB::table('model_has_roles')->where('role_id', '=', $id)->count();
                                            return $get;
                                        }
                                        @endphp                                            
                                        <tbody>
                                            @if($roles)
                                            @foreach ($roles as $role)
                                                <tr>
                                                    <td > {{$role->id}}</td>
                                                    <td>{{$role->name}}</td>
                                                    <td>{{getTotalp($role->id)}}</td>
                                                    <td>{{getTotalu($role->id)}}</td>
                                                    
                                                    <td class="table-action">
                                                        
                                                        <a href="{{url('/admin/users/role/show/'.$role->id)}}"  class="action-icon text-primary">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>

                                                        <a href="{{url('/admin/users/role/edit/'.$role->id)}}" class="action-icon text-success">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="{{url('/admin/users/role/show/'.$role->id)}}"  onclick="return confirm('Do you want to delete this slider?')" class="action-icon text-danger"> <i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        <!-- pagination here -->
                                         @if($roles){{$roles->appends(request()->input())->links()}} @endif
                                      
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                     
<x-admin-footer/>
