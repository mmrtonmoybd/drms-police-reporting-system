<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/bookings')}}">Bookings</a></li>
                                            <li class="breadcrumb-item active">Edit booking</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class=" dripicons-document-edit "></i> Edit booking</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        
                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table style="width:100%">
                                            <tr>
                                                <td>
                                                    <img style="max-width:250px" src="{{$settings['header_logo']}}" alt="" class="img-fluid">
                                                </td>
                                                <td class="text-end"><h1>INVOICE #[{{$booking->id}}]</h1></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr >
                                                <td>
                                                    @if(isset($booking->banglo->title)) <p> <b>Banglo:- </b> {{$booking->banglo->title}}</p>  @endif
                                                    @if(isset($booking->banglo->title)) <p> <b>Address:- </b>{{$booking->banglo->address}}</p>  @endif
                                                    @if(isset($booking->banglo->title)) <p> <b>Phone:- </b>{{$booking->banglo->phone}}</p>  @endif
                                                    @if(isset($booking->banglo->title)) <p> <b>Email:- </b>{{$booking->banglo->email}}</p>  @endif
                                                </td>
                                                <td style="text-align:right">
                                                @if(isset($booking->user->name)) <p> <b>Name:- </b> {{$booking->user->name}}</p>  @endif
                                                @if(isset($booking->user->name)) <p> <b>Address:- </b> {{$booking->user->address}}</p>  @endif
                                                @if(isset($booking->user->name)) <p> <b>Phone:- </b> {{$booking->user->phone}}</p>  @endif
                                                @if(isset($booking->user->name)) <p> <b>Email:- </b> {{$booking->user->email}}</p>  @endif
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Room</td>
                                                <th style="text-align:right">@if($booking->room->title){{$booking->room->title}}@endif</th>
                                            </tr>
                                            <tr>
                                                <td>Check In Date</td>
                                                <th style="text-align:right">{{date('d/m/Y', strtotime($booking->check_in))}}</th>
                                            </tr>
                                            <tr>
                                                <td>Check Out Date</td>
                                                <th style="text-align:right">{{date('d/m/Y', strtotime($booking->check_out))}}</th>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <th style="text-align:right">
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
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>Rent</td>
                                                <th style="text-align:right">{{$booking->price}}TK</th>
                                            </tr>
                                            <tr>
                                                <td>Payment Status</td>
                                                <th style="text-align:right">

                                                @if($booking->payment_status=='due') 
                                                        <span style="text-transform:uppercase" class="badge bg-danger">    
                                                            {{$booking->payment_status}}
                                                        </span>
                                                    @elseif($booking->payment_status=='paid') 
                                                        <span style="text-transform:uppercase" class="badge bg-success">             
                                                            {{$booking->payment_status}}
                                                        </span>
                                                
                                                    @endif 
                                                </th>
                                            </tr>
                                        </table>
                                        
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a target="_blank" href="{{url('admin/bookings/print/'.$booking->id)}}" class="btn btn-success"><i class="dripicons-print"></i> Print</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/bookings/edit/'.$booking->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body">
                                        <div class="row">
                                            
                                            
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="book_status" class="form-label">Status</label>
                                                    <select name="book_status" id="book_status" class="form-select" required>
                                                        <option value="">Status </option>
                                                        <option @if($booking->status=='requested') selected @endif value="requested">Requested</option>
                                                        <option @if($booking->status=='confirmed') selected @endif value="confirmed">Confirmed</option>
                                                        <option @if($booking->status=='checkout') selected @endif value="checkout">Checkout</option>
                                                        <option @if($booking->status=='cancel') selected @endif value="cancel">Cancel</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="payment_status" class="form-label">Payment Status</label>
                                                    <select name="payment_status" id="payment_status" class="form-select" required>
                                                        <option value="">Payment Status </option>
                                                        <option @if($booking->payment_status=='due') selected @endif value="due">Due</option>
                                                        <option @if($booking->payment_status=='paid') selected @endif value="paid">Paid</option>
                                                    </select>
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