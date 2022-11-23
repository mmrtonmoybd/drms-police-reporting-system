<x-admin-header />
                        
   
                        
                            <!-- start page title -->
<br>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body" style="padding: 15px 10px 7px 10px;">
            <div class="row">
               <div class="col-sm-6">
                  <h4 class="page-title"><i class="dripicons-scale"></i>View qrr #{{$qrr->id}}</h4>
               </div>
               <div class="col-sm-6">
                  <div class="page-title-box">
                     <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="{{url('admin/qrrs')}}">QRR</a></li>
                           <li class="breadcrumb-item active">View QRR</li>
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<br>
 <!-- start page title -->
 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                               
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td> <b>রেফারেন্স নং : </b> {{$qrr->id}}</td>
                                                        <td> <b>জেলা : </b> @if(isset($qrr->district->name)){{$qrr->district->bn_name}}@endif</td>
                                                        <td> <b>থানা : </b> @if(isset($qrr->thana->name)){{$qrr->thana->name}}@endif</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> গ্রাম/ওয়ার্ড : </b> {{$qrr->village_word}}</td>
                                                        <td> <b>তথ্য প্রাপ্তির উৎস : </b> {{$qrr->source_of_info}}</td>
                                                        <td> <b>ঘটনার তারিখ ও সময় : </b> @if(!empty($qrr->date_time_of_incident)) {{date('d/m/Y H:i:s', strtotime($qrr->date_time_of_incident))}} @endif</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> পুলিশের সংবাদ প্রাপ্তির তারিখ ও সময়  : </b> @if(!empty($qrr->date_time_of_police_news)) {{date('d/m/Y H:i:s', strtotime($qrr->date_time_of_police_news))}} @endif
                                                        </td>
                                                        <td> <b>রেসপন্সের তারিখ ও সময় : </b> @if(!empty($qrr->date_time_response)) {{date('d/m/Y H:i:s', strtotime($qrr->date_time_response))}} @endif
                                                        </td>
                                                        <td> <b>রেসপন্সে বিলম্ব : </b> 
                                                        @php

                                                        $minutes = $qrr->delay_in_response;
                                                        $hours = intdiv($minutes, 60).':'. ($minutes % 60);
                                                        $minutes = $qrr->delay_in_response;
                                                        $hour1 = floor($minutes / 60);
                                                        $minutes2 = ($minutes - floor($minutes / 60) * 60);
                                                        $isohour = sprintf("%02d:%02d", $hour1, $minutes2);
                                                        $hours = $isohour.':00';

                                                        @endphp

                                                        {{$hours}} 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>মূল ঘটনা: </b>{{$qrr->main_event}}</td>
                                                        <td> <b>ঘটনার ধরণ: </b> {{$qrr->event_type}}</td>
                                                        <td>  <b>ঘটনার সূত্রপাত: {{$qrr->begening_of_event}}</b>  </td>
                                                        <td>  <b>ঘটনার সংক্ষিপ্ত বিবরন: {{$qrr->short_dettails}}</b>  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> গৃহীত ব্যবস্থা: </b>{{$qrr->action_taken}}</td>
                                                        <td> <b> জিডি নং: </b>{{$qrr->gd_no}}</td>
                                                        <td> <b>তারিখ: </b> @if(!empty($qrr->gd_date)) {{date('d/m/Y', strtotime($qrr->gd_date))}} @endif</td>
                                                        <td>  <b> মামলা নং : {{$qrr->case_no}}</b>  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> তারিখ: </b> @if(!empty($qrr->case_date)) {{date('d/m/Y', strtotime($qrr->case_date))}} @endif</td>
                                                        <td> <b>ধারা: </b> {{$qrr->clause}}</td>
                                                        <td>  <b>  বাদীর/ সংবাদদাতার নাম : {{$qrr->nopc}}</b>  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>  বাদীর মোবাইল নং: </b> {{$qrr->plaintiff_mobile}}</td>
                                                        <td> <b> ভিকটিমের সংখ্যা: </b>  {{$qrr->number_of_victims}}</td>
                                                        <td>  <b>  এজাহারভুক্ত আসামীর সংখ্যা: {{$qrr->number_of_accused}}</b>  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>   রেসপন্সকারী/ তদন্তকারী কর্মকর্তার নাম: </b> {{$qrr->name_of_investigator}}</td>
                                                        <td> <b>  বিপি নং: </b>  {{$qrr->bp_no}}</td>
                                                        <td>  <b>   মোবাইল নং: {{$qrr->mobile_no}}</b>  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>  ছবি/ভিডিও প্রাপ্তি: </b> {{$qrr->image_video}}</td>
                                                        <td colspan="2"> <b>   সন্তুষ্টির মান: </b>  {{$qrr->media_quality}}</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                        <b>   মন্তব্য: </b>  {{$qrr->comments}}
                                                        </td>
                                                    </tr>
                                                </table>
                                                <a target="_blank" href="{{url('admin/qrrs/excel-details/'.$qrr->id)}}" class="btn btn-success"><i class="uil fa-file-excel-o"></i> Excel</a>
                                                <a target="_blank" href="{{url('admin/qrrs/pdf-details/'.$qrr->id)}}" class="btn btn-success"><i class="uil fa-file-excel-o"></i> pdf</a>
                                                <a target="_blank" href="{{url('admin/qrrs/print-details/'.$qrr->id)}}" class="btn btn-success"><i class="uil uil-print"></i> Print</a>
                                            </div>
                                           
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        <!-- end row -->

                        

                     <x-admin-footer/>