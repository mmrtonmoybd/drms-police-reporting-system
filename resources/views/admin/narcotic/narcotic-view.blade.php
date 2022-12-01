<x-admin-header />
                        
                  <br>

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                               
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td> <b>রেফারেন্স নং : </b> {{$nar->id}}</td>
                                                        <td> <b>ট্র্যাকিং নং : </b> {{$nar->trakingID}}</td>
                                                    
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td> <b>ফোল্ডার নং : </b> {{$nar->folder_no}}</td>
                                                        <td> <b>জেলা : </b> @if(isset($nar->district->name)){{$nar->district->bn_name}}@endif</td>
                                                        <td> <b>থানা : </b> @if(isset($nar->thana->name)){{$nar->thana->name}}@endif</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> গ্রাম/ওয়ার্ড : </b> {{$nar->village_word}}</td>
                                                        <td> <b>ঘটনার তারিখ : </b> @if($nar->sdate) {{date('d/m/Y', strtotime($nar->sdate))}} @endif</td>
                                                        <td> <b>মামলা নং : </b> {{$nar->case_no}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> ধারা  : </b> {{$nar->nopc}}</td>
                                                        <td> <b>অভিযান পরিচালনাকারী সংস্থা : </b> {{$nar->name_of_investigator_org}} </td>
                                                        <td> <b>অভিযান পরিচালনাকারী অফিসার : </b> {{$nar->name_of_investigator}} </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>বিপি নং: </b>{{$nar->bp_no}}</td>
                                                        <td> <b>মোবাইল নং: </b> {{$nar->mobile_no}}</td>
                                                        <td>  <b>গাঁজা (গ্রাম): </b> {{$nar->gaza}}  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> গাঁজা গাছ (সংখ্যা): </b>{{$nar->gaza_tree}}</td>
                                                        <td> <b>ইয়াবা (পিচ): </b> {{$nar->yaba}}</td>
                                                        <td>  <b> ইরোইন (গ্রাম) : </b>  {{$nar->heroine}} </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> ফেনসিডিল (বোতল): </b> {{$nar->fansdel}}</td>
                                                        <td> <b>চোলাই মদ (লিটার): </b> {{$nar->cholai_alcohol}}</td>
                                                        <td>  <b>  বিদেশী মদ (লিটার) : {{$nar->bidesh_alcohol}}</b>  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>  এলএসডি (মাইক্রোগ্রাম): </b> {{$nar->lsd}}</td>
                                                        <td> <b> ভিকটিমের সংখ্যা: </b>  {{$nar->ice}}</td>
                                                        <td>  <b>  আইস (মাইক্রোগ্রাম): </b> {{$nar->otherd}} </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>   আন্যান্য: </b> {{$nar->number_of_accused}}</td>
                                                        <td> <b>  গ্রেফতারকৃত আসামীর সংখ্যা: </b>  {{$nar->accused}}</td>
                                                        <td>  <b>   অভিযুক্ত:</b> {{$nar->village_word}}  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>  ছবি তোলা হয়েছে: </b> {{$nar->image_video}}</td>
                                                        <td> <b>   জব্দ তালিকা: </b>  {{$nar->jobdo_list}}</td>
                                                        <td>  <b>   মাদকের রিপোর্ট প্রাপ্তি:</b> {{$nar->narocotic_test_report}}  </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>  <b>   তদন্তের ফলাফল (CS নং):</b> {{$nar->investigate_result}}  </td>
                                                        <td>  <b>   তারিখ:</b> {{$nar->tdate}}  </td>
                                                        <td colspan="3">
                                                        <b>   মন্তব্য: </b>  {{$nar->comment}}
                                                        </td>
                                                    </tr>
                                                </table>
                                                <a target="_blank" href="{{url('admin/narcotic/print-details/'.$nar->id)}}" class="btn btn-success"><i class="uil uil-print"></i> Print</a>
                                            </div>
                                           
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        <!-- end row -->

                        

                     <x-admin-footer/>