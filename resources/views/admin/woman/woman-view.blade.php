<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/woman')}}">Women and children Dashboard</a></li>
                                            <li class="breadcrumb-item active">View Women and children Dashboard</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="mdi mdi-eye"></i> View Women and children Dashboard #{{$woman->id}}</h4>
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
                                                        <td> <b>রেফারেন্স নং : </b> {{$woman->reference_no}}</td>
                                                        <td> <b>জেলা : </b> @if(isset($woman->district->name)){{$woman->district->bn_name}}@endif</td>
                                                        <td> <b>থানা : </b> @if(isset($woman->thana->name)){{$woman->thana->name}}@endif</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> গ্রাম/ওয়ার্ড : </b> {{$woman->village_word}}</td>
                                                        <td> <b>আগমনের তারিখ ও সময় : </b> @if($woman->wdate) {{date('d/m/Y h:i A', strtotime($woman->wdate))}} @endif</td>
                                                        <td> <b>বাদীর নাম : </b> {{$woman->badi_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> বাদীর বয়স  : </b> {{$woman->badi_age}}
                                                        </td>
                                                        <td> <b>বাদীর ঠিকানা : </b> {{$woman->badi_address}}
                                                        </td>
                                                        <td> <b>বাদীর মোবাইল নং : </b> {{$woman->badi_phone}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>বিবাদীর নাম: </b>{{$woman->vbadi_name}}</td>
                                                        <td> <b>বিবাদীর ঠিকানা: </b> {{$woman->vbadi_address}}</td>
                                                        <td>  <b>অভিযোগের কারন:</b> {{$woman->complaint_reson}}  </td>
                                                        <td>  <b>তদন্তকারী কর্মকর্তার নাম:</b> {{$woman->investigator_name}}  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> তদন্তকারী কর্মকর্তার পদবী: </b>{{$woman->investigator_title}}</td>
                                                        <td> <b>মোবাইল নং: </b> {{$woman->mobile_no}}</td>
                                                        <td>  <b> জিডি নং :</b> {{$woman->gd_no}}  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> তারিখ: </b> @if($woman->gd_date) {{date('d/m/Y', strtotime($woman->gd_date))}} @endif</td>
                                                        <td> <b>মামলা নং: </b> {{$woman->mamla_no}}</td>
                                                        <td>  <b>তারিখ : @if($woman->mamla_date) {{date('d/m/Y', strtotime($woman->mamla_date))}} @endif</b>  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>  ধারা: </b> {{$woman->dhara}}</td>
                                                        <td> <b> অভিযোগ নং: </b>  {{$woman->complaint_no}}</td>
                                                        <td>  <b>  সমস্যা সমাধান হয়েছে কিনা:</b> {{$woman->problem_fix}}  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>   গৃহীত ব্যবস্থা: </b>{{$woman->action_taken}}</td>
                                                        <td> <b>  নিষ্পত্তি রিপোর্ট: </b> {{$woman->nreport}}</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                        <b>   মন্তব্য: </b>  {{$woman->comment}}
                                                        </td>
                                                    </tr>
                                                </table>
                                                <a target="_blank" href="{{url('admin/woman/pview/'.$woman->id)}}" class="btn btn-success"><i class="uil uil-print"></i> Print</a>
                                            </div>
                                           
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        <!-- end row -->

                        

                     <x-admin-footer/>