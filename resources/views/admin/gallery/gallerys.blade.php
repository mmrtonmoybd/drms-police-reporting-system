<x-admin-header/>
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/gallerys')}}">Galleries</a></li>
                                            <li class="breadcrumb-item active">All gallerys</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="dripicons-photo-group"></i>Galleries</h4>
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
                                            <a href="{{url('admin/gallerys/add')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add gallery</a>
                                            </div>
                                            
                                        </div>
                                        <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th ><i class="dripicons-photo-group"></i></th>
                                                    <th >Title</th>
                                                    <th style="width: 86px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody  id="sortable">
                                            @if($gallerys)
                                            @foreach ($gallerys as $gallery)
                                                <tr  id="{{$gallery->id}}" class="ui-state-default" style="cursor:move">
                                                    <td  class=""> 
                                                        <img src="{{ asset('storage/gallerys/'.$gallery->image) }}" alt="table-user" class="me-2 " style="max-width:100px">

                                                    
                                                    </td>
                              
                                                    <td > {{$gallery->title}}</td>
                                                       
                                                    <td class="table-action">
                                                        <a href="{{url('admin/gallerys/edit/'.$gallery->id)}}" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="{{url('admin/gallerys/delete/'.$gallery->id)}}"  onclick="return confirm('Do you want to delete this gallery?')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        @if($gallerys){{$gallerys->appends(request()->input())->links()}} @endif
                                      
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <input type="hidden" name="shortable_url" id="shortable_url" value="{{url('admin/gallerys/short')}}">

                     
<x-admin-footer/>