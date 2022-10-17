<x-admin-header/>
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/bookings')}}"> Bookings</a></li>
                                            <li class="breadcrumb-item active"> All bookings</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="dripicons-calendar"></i> Bookings</h4>
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
                                            <a href="{{url('admin/bookings/add')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add booking</a>
                                            </div>
                                            
                                        </div>
                                        <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th ><i class="dripicons-photo-group"></i></th>
                                                    <th >Name</th>
                                                    <th >Date</th>
                                                    <th >Rent</th>
                                                    <th > Adult</th>
                                                    <th > Child</th>
                                                    <th > Status</th>
                                                    <th > Payment</th>
                                                    <th >Room</th>
                                                    <th >Banglo</th>
                                                    <th style="width: 86px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                            @if($bookings)
                                            @foreach ($bookings as $booking)
                                                <tr >
                                                    <td    class="table-user"> 
                                                        @if(isset($booking->user->name))
                                                        <img src="{{ asset('storage/users/'.$booking->user->picture) }}" alt="Image" class="me-2 rounded-circle" style="max-width:100px">
                                                        @endif

                                                    
                                                    </td>
                              
                                                    <td > @if(isset($booking->user->name)) {{$booking->user->name}} @endif </td>
                                                    <td > {{date('d/m/Y', strtotime($booking->check_in))}} - {{date('d/m/Y', strtotime($booking->check_out))}}</td>
                                                    <td > {{$booking->price}}</td>
                                                    <td > {{$booking->adult}}</td>
                                                    <td > {{$booking->child}}</td>
                                                    <td > 
                                                        @if($booking->status=='requested') 
                                                            <span style="text-transform:uppercase" class="badge bg-danger">    
                                                                {{$booking->status}}
                                                            </span>
                                                        @elseif($booking->status=='confirmed') 
                                                            <span style="text-transform:uppercase" class="badge bg-warning">             
                                                                {{$booking->status}}
                                                            </span>
                                                        @elseif($booking->status=='checkout') 
                                                            <span style="text-transform:uppercase" class="badge bg-success">             
                                                                {{$booking->status}}
                                                            </span>
                                                        @elseif($booking->status=='cancel') 
                                                            <span style="text-transform:uppercase" class="badge bg-danger">             
                                                                {{$booking->status}}
                                                            </span>
                                                        @endif 
                                                    </td>
                                                    <td > 

                                                    @if($booking->payment_status=='due') 
                                                            <span style="text-transform:uppercase" class="badge bg-danger">    
                                                                {{$booking->payment_status}}
                                                            </span>
                                                        @elseif($booking->payment_status=='paid') 
                                                            <span style="text-transform:uppercase" class="badge bg-success">             
                                                                {{$booking->payment_status}}
                                                            </span>
                                                       
                                                        @endif 
                                                    </td>
                                                    <td > @if(isset($booking->room->title)){{$booking->room->title}} @endif</td>
                                                    <td > @if(isset($booking->banglo->title)){{$booking->banglo->title}} @endif</td>
                                                       
                                                    <td class="table-action">
                                                        <a href="{{url('admin/bookings/edit/'.$booking->id)}}" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="{{url('admin/bookings/delete/'.$booking->id)}}"  onclick="return confirm('Do you want to delete this booking?')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        @if($bookings){{$bookings->appends(request()->input())->links()}} @endif
                                      
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <input type="hidden" name="shortable_url" id="shortable_url" value="{{url('admin/bookings/short')}}">

                     
<x-admin-footer/>