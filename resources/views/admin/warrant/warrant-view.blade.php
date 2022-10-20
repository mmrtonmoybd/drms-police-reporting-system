<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/warrant')}}">Warrants</a></li>
                                            <li class="breadcrumb-item active">View warrant</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="mdi mdi-eye"></i> View warrant #{{$war->id}}</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                               
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td> <b>রেফারেন্স নং : </b> {{$war->id}}</td>
                                                        <td> <b>জেলা : </b> @if(isset($war->district->name)){{$war->district->bn_name}}@endif</td>
                                                        <td> <b>থানা : </b> @if(isset($war->thana->name)){{$war->thana->name}}@endif</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> তারিখ : </b> {{date('d-M-Y', strtotime($war->date))}}</td>
                                                        <td> <b>জিআর রিসিভ : </b> {{$war->gr_recive}}</td>
                                                        <td> <b>সিআর রিসিভ : </b> {{$war->cr_recive}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> সাজা জিআর রিসিভ  : </b> {{$war->saja_gr_recive}}
                                                        </td>
                                                        <td> <b>সাজা সিআর রিসিভ : </b> {{$war->saja_cr_recive}}
                                                        </td>
                                                        <td> <b>মোট রিসিভ : </b> {{$war->gr_recive + $war->cr_recive + $war->saja_gr_recive + $war->saja_cr_recive}} 
                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>জিআর তামিল: </b> {{$war->gr_tamil}}</td>
                                                        <td> <b>সিআর তামিল: </b> {{$war->cr_tamil}}</td>
                                                        <td>  <b>সাজা জিআর তামিল: </b>  {{$war->saja_gr_tamil}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> সাজা সিআর তামিল: </b> {{$war->saja_cr_tamil}}</td>
                                                        <td> <b>রিকল ও অন্যান্য: </b>  {{$war->recall_other}}</td>
                                                        <td>  <b> মোট তামিল :  </b>  {{$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> মোট নিষ্পত্তি: </b>  {{$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil + $war->recall_other}}</td>
                                                        <td> <b>দিনশেষে পেন্ডিং: fun kra lgba</b> </td>
                                                    </tr>
                                                </table>
                                                <a target="_blank" href="{{url('admin/warrant/print-details/'.$war->id)}}" class="btn btn-success"><i class="uil uil-print"></i> Print</a>
                                            </div>
                                           
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        <!-- end row -->

                        

                     <x-admin-footer/>