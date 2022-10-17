<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Document</title>
    <link rel="shortcut icon" href="{{ asset('my-assets/admin') }}/images/favicon.ico">
    <!-- App css -->
    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('my-assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('my-assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('my-assets/admin/css/app-light.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <link href="{{ asset('my-assets/admin/css/custom.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-sm-12 ">
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
                    
            
        </div>
    </div>
    </div>
</body>
<script>
     setTimeout(function () { window.print(); }, 500);
        window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
</script>
</html>