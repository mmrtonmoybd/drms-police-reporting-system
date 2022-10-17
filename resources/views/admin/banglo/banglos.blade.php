<x-admin-header/>
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/banglos')}}"> Banglos</a></li>
                                            <li class="breadcrumb-item active">All banglos</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="mdi mdi-home-city-outline"></i> Banglos</h4>
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
                                            <a href="{{url('admin/banglos/add')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add banglos</a>
                                            </div>
                                            
                                        </div>
                                        <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th ><i class="dripicons-photo-group"></i></th>
                                                    <th >Title</th>
                                                    <th >Sub Title</th>
                                                    <th >Total Room</th>
                                                    <th >Address</th>
                                                    <th style="width: 86px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="sortable">
                                            @if($banglos)
                                            @foreach ($banglos as $banglo)
                                                <tr id="{{$banglo->id}}" class="ui-state-default" style="cursor:move">
                                                    <td  class=""> 
                                                        <img src="{{ asset('storage/banglos/'.$banglo->image) }}" alt="table-user" class="me-2 " style="max-width:100px">

                                                    
                                                    </td>
                              
                                                    <td > {{$banglo->title}}</td>
                                                    <td > {{$banglo->sub_title}}</td>
                                                    <td > {{$banglo->total_room}}</td>
                                                    <td > {{$banglo->address}}</td>
                                                       
                                                    <td class="table-action">
                                                        <a href="{{url('admin/banglos/edit/'.$banglo->id)}}" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="{{url('admin/banglos/delete/'.$banglo->id)}}"  onclick="return confirm('Do you want to delete this banglo?')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        @if($banglos){{$banglos->appends(request()->input())->links()}} @endif
                                      
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <input type="hidden" name="shortable_url" id="shortable_url" value="{{url('admin/banglos/short')}}">

                     
<x-admin-footer/>