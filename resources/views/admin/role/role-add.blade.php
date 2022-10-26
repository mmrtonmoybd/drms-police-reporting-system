<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/warrant')}}">Warrants</a></li>
                                            <li class="breadcrumb-item active">Add Warrant</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="uil uil-plus"></i> Add Warrant</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                
                                <form action="{{url('admin/warrant/add')}}" method="POST" >
                                    @csrf
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> Role name </label>
                                                    <input type="text" name="recall_other"  value="" id="recall_other" class="form-control  " placeholder="   রিকল ও অন্যান্য " required>
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
