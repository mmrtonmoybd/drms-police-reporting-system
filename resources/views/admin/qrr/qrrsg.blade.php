<x-admin-header />
<!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/qrrs')}}">Qrrs</a></li>
                                            <li class="breadcrumb-item active">Qrrs graph charts</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="dripicons-scale"></i> Qrrs</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

        

                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">

                                    <!-- chart  -->

                                            <div id="chart_div"></div>
                                            <div id="piechart"></div>
                                            <div id="chart_div2"></div>
                                    <!-- chart -->

                                            <div class="btn-group" role="group" aria-label="...">
  <a href="{{url('admin/qrrs/report/মারামারি')}}" class="btn btn-danger">মারামারি</a>
  <a href="{{url('admin/qrrs/report/খুন')}}" class="btn btn-danger">খুন</a>
  <a href="{{url('admin/qrrs/report/চুরি')}}" class="btn btn-danger">চুরি</a>
  <a href="{{url('admin/qrrs/report/ডাকাতি')}}" class="btn btn-danger">ডাকাতি</a>
  <a href="{{url('admin/qrrs/report/সম্পত্তি সংক্রান্ত')}}" class="btn btn-danger">সম্পত্তি সংক্রান্ত</a>
  <a href="{{url('admin/qrrs/report/সড়ক দুর্ঘটনা')}}" class="btn btn-danger">সড়ক দুর্ঘটনা</a>
  <a href="{{url('admin/qrrs/report/নারী ও শিশু')}}" class="btn btn-danger">নারী ও শিশু</a>
  <a href="{{url('admin/qrrs/report/অগ্নিকান্ড')}}" class="btn btn-danger">অগ্নিকান্ড</a>
  <a href="{{url('admin/qrrs/report/মাদক')}}" class="btn btn-danger">মাদক</a>
  <a href="{{url('admin/qrrs/report/সাইবার')}}" class="btn btn-danger">সাইবার</a>
  <a href="{{url('admin/qrrs/report/প্রতারণা')}}" class="btn btn-danger">প্রতারণা</a>
  <a href="{{url('admin/qrrs/report/রাজনৈতিক')}}" class="btn btn-danger">রাজনৈতিক</a>
  <a href="{{url('admin/qrrs/report/অন্যান্য')}}" class="btn btn-danger">অন্যান্য</a>
</div>

                                            <h3>Total incident: {{$tin}}</h3>
                                            <h3>Total case taken: {{$tcat}}</h3>

                                            <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th > রেফারেন্স নং </th>
                                                    <th > জেলা </th>
                                                    <th > থানা </th>
                                                    <th > গ্রাম/ওয়ার্ড </th>
                                                    <th > তথ্য প্রাপ্তির উৎস </th>
                                                    <th > ঘটনার তারিখ ও সময় </th>
                                                    <th > পুলিশের সংবাদ প্রাপ্তির তারিখ ও সময় </th>
                                                    <th > রেসপন্সের তারিখ ও সময় </th>
                                                    <th > রেসপন্সে বিলম্ব  </th>
                                                    <th > মূল ঘটনা</th>
                                                    <th > ঘটনার ধরণ </th>
                                                    <th > ঘটনার সূত্রপাত </th>
                                                    <th > জিডি নং </th>
                                                    <th > তারিখ </th>
                                                    <th > মামলা নং </th>
                                                    <th > তারিখ </th>
                                                    <th > ধারা </th>
                                                    <th > বাদীর/ সংবাদদাতার নাম </th>
                                                    <th > বাদীর মোবাইল নং </th>
                                                    <th > ভিকটিমের সংখ্যা </th>
                                                    <th > এজাহারভুক্ত আসামীর সংখ্যা </th>
                                                    <th > রেসপন্সকারী/ তদন্তকারী কর্মকর্তার নাম </th>
                                                    <th > বিপি নং </th>
                                                    <th > মোবাইল নং </th>
                                                    <th > ছবি/ভিডিও প্রাপ্তি  </th>
                                                    <th > সন্তুষ্টির মান </th>
                                                    <th > মন্তব্য </th>
                                                    <th style="width: 86px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if($qrrs)
                                            @foreach ($qrrs as $qrr)
                                                <tr>
                                                    <td > {{$qrr->id}}</td>
                                                    <td > @if(isset($qrr->district->name)) {{$qrr->district->bn_name}} @endif</td>
                                                    <td > @if(isset($qrr->thana->name)) {{$qrr->thana->name}} @endif</td>
                                                    <td > {{$qrr->village_word}}</td>
                                                    <td > {{$qrr->source_of_info}}</td>
                                                    <td > @if($qrr->date_time_of_incident) {{date('d/m/Y h:i A', strtotime($qrr->date_time_of_incident))}} @endif</td>
                                                    <td > @if($qrr->date_time_of_police_news) {{date('d/m/Y h:i A', strtotime($qrr->date_time_of_police_news))}} @endif</td>
                                                    <td > @if($qrr->date_time_response) {{date('d/m/Y h:i A', strtotime($qrr->date_time_response))}} @endif</td>
                                                    <td >
                                                        
                                                    @php

                                                    $minutes = $qrr->delay_in_response;
                                                    $hours = intdiv($minutes, 60).':'. ($minutes % 60);
                                                    $minutes = $qrr->delay_in_response;
                                                    $hours = floor($minutes / 60).':'.($minutes - floor($minutes / 60) * 60).':00';

                                                    @endphp
                                                    
                                                    {{$hours}} 
                                                
                                                
                                                    </td>
                                                    <td > {{ Str::limit($qrr->main_event, 20)}}</td>
                                                    <td > {{$qrr->event_type}}</td>
                                                    <td > {{Str::limit($qrr->begening_of_event, 5)}}</td>
                                                    <td > {{$qrr->gd_no}}</td>
                                                    <td > @if($qrr->gd_date) {{date('d/m/Y', strtotime($qrr->gd_date))}} @endif</td>
                                                    <td > {{$qrr->case_no}}</td>
                                                    <td > @if($qrr->case_date) {{date('d/m/Y', strtotime($qrr->case_date))}} @endif</td>
                                                    <td > {{$qrr->clause}}</td>
                                                    <td > {{$qrr->nopc}}</td>
                                                    <td > {{$qrr->plaintiff_mobile}}</td>
                                                    <td > {{$qrr->number_of_victims}}</td>
                                                    <td > {{$qrr->number_of_accused}}</td>
                                                    <td > {{$qrr->name_of_investigator}}</td>
                                                    <td > {{$qrr->bp_no}}</td>
                                                    <td > {{$qrr->mobile_no}}</td>
                                                    <td > {{$qrr->image_video}}</td>
                                                    <td > {{$qrr->media_quality}}</td>
                                                    <td > {{Str::limit($qrr->comments, 5)}}</td>
                                                       
                                                    <td class="table-action">
                                                        
                                                        <a href="{{url('admin/qrrs/details/'.$qrr->id)}}"  class="action-icon text-primary">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>

                                                        <a href="{{url('admin/qrrs/edit/'.$qrr->id)}}" class="action-icon text-success">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="{{url('admin/qrrs/delete/'.$qrr->id)}}"  onclick="return confirm('Do you want to delete this slider?')" class="action-icon text-danger"> <i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        @if($qrrs){{$qrrs->appends(request()->input())->links()}} @endif
                                      
                                        </nav>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                     
<x-admin-footer/>
