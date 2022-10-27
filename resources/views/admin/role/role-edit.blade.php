<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/users/role')}}">Roles</a></li>
                                            <li class="breadcrumb-item active">Edit Role</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="uil uil-plus"></i> Edit Role</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">

                            @php
                            use Illuminate\Support\Facades\DB;
                            
                            function getPermi($id, $per) {
                                            $get = DB::table('role_has_permissions AS rhp')->join('permissions AS per', 'rhp.permission_id', '=', 'per.id')->where('rhp.role_id', '=', $id)->where('per.name', '=', $per)->count();
                                            return $get;
                                        }
                            @endphp
                                
                                <form action="{{url('/admin/users/role/edit/'.$role->id)}}" method="POST" >
                                    @csrf
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                

                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label"> Role name </label>
                                                    <input type="text"  value="{{$role->name}}" id="name" class="form-control  " placeholder="   Role name " disabled>
                                                </div>
                                            </div>
                                            <br>
                                            <br>

                                            <div class="col-sm-12">
                                                <label for="name" class="form-label"> <b>QRR permission</b> </label>

                                                <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="qrr.dashboard" {{getPermi($role->id, 'qrr.dashboard') == 1 ? 'checked' : ''}}>QRR Dashboard
                                                   </label>
                                                  </div>


                                                <div class="form-check">
                                           <label class="form-check-label">
                                           <input type="checkbox" name="models[]" class="form-check-input" value="qrr.view" {{getPermi($role->id, 'qrr.view') == 1 ? 'checked' : ''}}>QRR view
                                            </label>
                                                </div>

                                                <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="qrr.add" {{getPermi($role->id, 'qrr.add') == 1 ? 'checked' : ''}}>QRR add
                                                   </label>
                                                  </div>

                                                  <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="qrr.edit" {{getPermi($role->id, 'qrr.edit') == 1 ? 'checked' : ''}}>QRR edit
                                                   </label>
                                                  </div>

                                                  
                                            </div>
                                            <br>

                                            <div class="col-sm-12">
                                                <label for="name" class="form-label"> <b>Warrant permission</b> </label>

                                                <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="warrant.dashboard" {{getPermi($role->id, 'warrant.dashboard') == 1 ? 'checked' : ''}}>Warrant Dashboard
                                                   </label>
                                                  </div>


                                                <div class="form-check">
                                           <label class="form-check-label">
                                           <input type="checkbox" name="models[]" class="form-check-input" value="warrant.view" {{getPermi($role->id, 'warrant.view') == 1 ? 'checked' : ''}}>Warrant view
                                            </label>
                                                </div>

                                                <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="warrant.add" {{getPermi($role->id, 'warrant.add') == 1 ? 'checked' : ''}}>Warrant add
                                                   </label>
                                                  </div>

                                                  <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="warrant.edit" {{getPermi($role->id, 'warrant.edit') == 1 ? 'checked' : ''}}>Warrant edit
                                                   </label>
                                                  </div>

                                                  
                                            </div>

                                            <br>

                                            <div class="col-sm-12">
                                                <label for="name" class="form-label"> <b>Narcotic permission</b> </label>

                                                <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="narcotic.dashboard" {{getPermi($role->id, 'narcotic.dashboard') == 1 ? 'checked' : ''}}>Narcotic Dashboard
                                                   </label>
                                                  </div>


                                                <div class="form-check">
                                           <label class="form-check-label">
                                           <input type="checkbox" name="models[]" class="form-check-input" value="narcotic.view" {{getPermi($role->id, 'narcotic.view') == 1 ? 'checked' : ''}}>Narcotic view
                                            </label>
                                                </div>

                                                <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="narcotic.add" {{getPermi($role->id, 'narcotic.add') == 1 ? 'checked' : ''}}>Narcotic add
                                                   </label>
                                                  </div>

                                                  <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="narcotic.edit" {{getPermi($role->id, 'narcotic.edit') == 1 ? 'checked' : ''}}>Narcotic edit
                                                   </label>
                                                  </div>

                                                  
                                            </div>

                                            <br>



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
