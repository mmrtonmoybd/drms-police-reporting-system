<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/users/role')}}">Roles</a></li>
                                            <li class="breadcrumb-item active">Add Role</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="uil uil-plus"></i> Add Role</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                
                                <form action="{{url('/admin/users/role/add')}}" method="POST" >
                                    @csrf
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                

                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label"> Role name </label>
                                                    <input type="text" name="name"  value="" id="name" class="form-control  " placeholder="   Role name " required>
                                                </div>
                                            </div>
                                            <br>
                                            <br>

                                            <div class="col-sm-12">
                                                <label for="name" class="form-label"> <b>QRR permission</b> </label>

                                                <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="qrr.dashboard">QRR Dashboard
                                                   </label>
                                                  </div>


                                                <div class="form-check">
                                           <label class="form-check-label">
                                           <input type="checkbox" name="models[]" class="form-check-input" value="qrr.view">QRR view
                                            </label>
                                                </div>

                                                <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="qrr.add">QRR add
                                                   </label>
                                                  </div>

                                                  <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="qrr.edit">QRR edit
                                                   </label>
                                                  </div>

                                                  
                                            </div>
                                            <br>

                                            <div class="col-sm-12">
                                                <label for="name" class="form-label"> <b>Warrant permission</b> </label>

                                                <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="warrant.dashboard">Warrant Dashboard
                                                   </label>
                                                  </div>


                                                <div class="form-check">
                                           <label class="form-check-label">
                                           <input type="checkbox" name="models[]" class="form-check-input" value="warrant.view">Warrant view
                                            </label>
                                                </div>

                                                <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="warrant.add">Warrant add
                                                   </label>
                                                  </div>

                                                  <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="warrant.edit">Warrant edit
                                                   </label>
                                                  </div>

                                                  
                                            </div>

                                            <br>

                                            <div class="col-sm-12">
                                                <label for="name" class="form-label"> <b>Narcotic permission</b> </label>

                                                <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="narcotic.dashboard">Narcotic Dashboard
                                                   </label>
                                                  </div>


                                                <div class="form-check">
                                           <label class="form-check-label">
                                           <input type="checkbox" name="models[]" class="form-check-input" value="narcotic.view">Narcotic view
                                            </label>
                                                </div>

                                                <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="narcotic.add">Narcotic add
                                                   </label>
                                                  </div>

                                                  <div class="form-check">
                                                <label class="form-check-label">
                                                 <input type="checkbox" name="models[]" class="form-check-input" value="narcotic.edit">Narcotic edit
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
