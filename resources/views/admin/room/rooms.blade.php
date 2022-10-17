<x-admin-header/>
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/rooms')}}"> Rooms</a></li>
                                            <li class="breadcrumb-item active"> All Rooms</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="dripicons-home"></i> Rooms</h4>
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
                                            <a href="{{url('admin/rooms/add')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add room</a>
                                            </div>
                                            
                                        </div>
                                        <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th ><i class="dripicons-photo-group"></i></th>
                                                    <th >Title</th>
                                                    <th >Rent</th>
                                                    <th >Max Adult</th>
                                                    <th >Max Children</th>
                                                    <th >Total Bad</th>
                                                    <th >Category</th>
                                                    <th >Banglo</th>
                                                    <th style="width: 86px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody  id="sortable">
                                            @if($rooms)
                                            @foreach ($rooms as $room)
                                                <tr  id="{{$room->id}}" class="ui-state-default" style="cursor:move">
                                                    <td  class=""> 
                                                        <img src="{{ asset('storage/rooms/'.$room->big_picture) }}" alt="Image" class="me-2 " style="max-width:100px">
                                                        

                                                    
                                                    </td>
                              
                                                    <td > {{$room->title}}</td>
                                                    <td > {{$room->rent}}</td>
                                                    <td > {{$room->max_adult}}</td>
                                                    <td > {{$room->max_children}}</td>
                                                    <td > {{$room->bed_count}}</td>
                                                    <td > @if(isset($room->room_category->title)){{$room->room_category->title}} @endif</td>
                                                    <td > @if(isset($room->banglo->title)){{$room->banglo->title}} @endif</td>
                                                       
                                                    <td class="table-action">
                                                        <a href="{{url('admin/rooms/edit/'.$room->id)}}" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="{{url('admin/rooms/delete/'.$room->id)}}"  onclick="return confirm('Do you want to delete this room?')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        @if($rooms){{$rooms->appends(request()->input())->links()}} @endif
                                      
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <input type="hidden" name="shortable_url" id="shortable_url" value="{{url('admin/rooms/short')}}">

                     
<x-admin-footer/>