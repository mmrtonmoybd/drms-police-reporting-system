<x-admin-header/>
                        
        
      <br>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body" style="padding: 15px 10px 7px 10px;">
            <div class="row">
               <div class="col-sm-6">
                  <h4 class="page-title"><i class="dripicons-scale"></i>Users</h4>
               </div>
               <div class="col-sm-6">
                  <div class="page-title-box">
                     <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="{{url('admin/users')}}">Users</a></li>
                           <li class="breadcrumb-item active">All Users</li>
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<br>
 <!-- start page title -->
 
 
                        
                        
                        
                        

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        
                                        <div class="row">
                                            <div class="col-sm-12">
                                                
                                          
                                         <div class="dropdown" style="margin-bottom: 16px;text-align: right;">
                                                    <button class="btn btn-primary dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                       Add User

                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 34px, 0px);">
                                            <a href="{{url('admin/users/add/superadmin')}}" class="dropdown-item"><i class="uil uil-plus"></i> Add Super Admin</a>
                                            <a href="{{url('admin/users/add/admin')}}" class="dropdown-item"><i class="uil uil-plus"></i> Add Admin</a>
                                            <a href="{{url('admin/users/add/sp')}}" class="dropdown-item"><i class="uil uil-plus"></i> Add SP</a>
                                            <a href="{{url('admin/users/add/sp/op1')}}" class="dropdown-item"><i class="uil uil-plus"></i> Add SP-Operator 1</a>
                                            <a href="{{url('admin/users/add/sp/op2')}}" class="dropdown-item"><i class="uil uil-plus"></i> Add SP-Operator 2</a>
                                            <a href="{{url('admin/users/add/oc')}}" class="dropdown-item"><i class="uil uil-plus"></i> Add OC</a>
                                            <a href="{{url('admin/users/add/oc/op1')}}" class="dropdown-item"><i class="uil uil-plus"></i> Add OC-Operator 1 </a>
                                            <a href="{{url('admin/users/add/oc/op2')}}" class="dropdown-item"><i class="uil uil-plus"></i> Add OC-Operator 2</a>
                                            <a href="{{url('admin/users/add/oc/op3')}}" class="dropdown-item"><i class="uil uil-plus"></i> Add OC-Operator 3</a>
                                                </div>
                                                      <br>
                                                
                                                  </div>
                                        
                                            </div>
                                          <!-- end col-->
                                        </div>
                                        <table class="table table-bordered table-striped table-centered mb-0 yajra-datatable">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Designation</th>
                                                    <th> Mobile no</th>
                                                    <th>BP No</th>
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
            {defaultContent: '', data: 'picture', className: 'table-user', searchable: false, orderable: false},
            {defaultContent: '', data: 'name', searchable: true, orderable: true},
            {defaultContent: '', data: 'email', searchable: true, orderable: true},
            {defaultContent: '', data: 'designation', searchable: true, orderable: true},
            {defaultContent: '', data: 'mobile', searchable: true, orderable: true},
            {defaultContent: '', data: 'bp_no', searchable: true, orderable: true},
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