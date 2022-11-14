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
                                            <a href="{{url('admin/users/add/superadmin')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add Super Admin</a>
                                            <a href="{{url('admin/users/add/sp')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add SP</a>
                                            <a href="{{url('admin/users/add/sp/op1')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add SP-Operator 1</a>
                                            <a href="{{url('admin/users/add/sp/op2')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add SP-Operator 2</a>
                                            <a href="{{url('admin/users/add/oc')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add OC</a>
                                            <a href="{{url('admin/users/add/oc/op1')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add OC-Operator 1 </a>
                                            <a href="{{url('admin/users/add/oc/op2')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add OC-Operator 2</a>
                                            <a href="{{url('admin/users/add/oc/op3')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add OC-Operator 3</a>
                                            </div>
                                          <!-- end col-->
                                        </div>
                                        <table class="table table-bordered table-striped table-centered mb-0 yajra-datatable">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th >Name</th>
                                                    <th >Email</th>
                                                    <th>District</th>
                                                    <th>Thana</th>
                                                    <th>Role</th>
                                                    <th style="width: 86px">action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        
                                      
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

        @push('scripts')
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! url('/admin/users/getdata') !!}",
        columns: [
            {data: 'id', name: 'id', orderable: true},
            {defaultContent: '', data: 'name', searchable: true, orderable: true},
            {defaultContent: '', data: 'email', searchable: true, orderable: true},
            {defaultContent: '', data: 'district.bn_name', searchable: true, orderable: true},
            {defaultContent: '', data: 'thana.name', searchable: true, orderable: true},
            {defaultContent: '', data: 'type', searchable: true, orderable: true},
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false
            },
        ]
    });
    
  });
</script>
        @endpush             
<x-admin-footer/>