<x-admin-header />
       

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
                                                        <td> <b>আগমনের তারিখ ও সময় : </b> @if(!empty($woman->wdate)) {{date('d/m/Y H:i', strtotime($woman->wdate))}} @endif</td>
                                                        <td> <b>ঘটনার ধরণ: </b> {{$woman->event_type}}</td>
                                                        <td>  <b>ঘটনার সূত্রপাত:</b> {{$woman->begening_of_event}}  </td>
                                                        <td>  <b>ঘটনার সংক্ষিপ্ত বিবরন:</b> {{$woman->short_dettails}}  </td>
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
                                                        <td>  <b>অভিযুক্তের সংখ্যা:</b> {{$woman->complaint_reson}}  </td>
                                                        <td>  <b>তদন্তকারী কর্মকর্তার নাম ও পদবি:</b> {{$woman->investigator_name}}  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> তদন্তকারী কর্মকর্তার বিপি নাম্বার: </b>{{$woman->investigator_title}}</td>
                                                        <td> <b>মোবাইল নং: </b> {{$woman->mobile_no}}</td>
                                                        <td>  <b> জিডি নং :</b> {{$woman->gd_no}}  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> তারিখ: </b> @if(!empty($woman->gd_date)) {{date('d/m/Y', strtotime($woman->gd_date))}} @endif</td>
                                                        <td> <b>মামলা নং: </b> {{$woman->mamla_no}}</td>
                                                        <td>  <b>তারিখ :</b> @if(!empty($woman->mamla_date)) {{date('d/m/Y', strtotime($woman->mamla_date))}} @endif  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>  ধারা: </b> {{$woman->dhara}}</td>
                                                        <td> <b> অভিযোগ নং: </b>  {{$woman->complaint_no}}</td>
                                                         <td> <b> অভিযোগ  তারিখ: </b>  @if(!empty($woman->complaint_date)) {{date('d/m/Y', strtotime($woman->complaint_date))}} @endif</td>
                                                      
                                                    </tr>
                                                    <tr>
                                                        <td> <b>   গৃহীত ব্যবস্থা: </b>{{$woman->action_taken}}</td>
                                                        <td> <b>  নিষ্পত্তি রিপোর্ট: </b> {{$woman->nreport}}</td>
                                                        <td colspan="2"> <b>   সন্তুষ্টির মান: </b>  {{$woman->satisfy_rate}}</td>
                                                        
                                                    </tr>

                                                    <tr>
                                                          <td>  <b>  সমস্যা সমাধান হয়েছে কিনা:</b> {{$woman->problem_fix}}  </td>
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