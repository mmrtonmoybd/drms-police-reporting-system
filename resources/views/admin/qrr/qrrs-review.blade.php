
			<x-admin-header/>
			
			<!-- ============ Body content start ============= -->
				<style>
				.card-title {
					z-index:2000;
					position:relative;
				}
				</style>


<div class="row">
  <div class="card card-body table-responsive">

  <!--- 
      <div style="text-align: right;margin: 16px;">
                    
                                         
  <a target="_blank" href="{{url('admin/qrrs/srcs/excel')}}" class="btn btn-success"><i class="fa fa-file-excel"></i> Excel</a>
  <a target="_blank" href="{{url('admin/qrrs/srcs/pdf')}}" class="btn btn-success"><i class="fa fa-file-pdf"></i> PDF</a>
      
											
											</div>

            -->
    
   
                                <table id="customer_data" class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 86px">Action</th>
                                                    <th > রেফারেন্স নং </th>
                                                    <th > জেলা </th>
                                                    <th > থানা </th>
                                                    <th > গ্রাম/ওয়ার্ড </th>
                                                    <th > তথ্য প্রাপ্তির উৎস </th>
                                                    <th > ঘটনার তারিখ ও সময় </th>
                                                    <th > পুলিশের সংবাদ প্রাপ্তির তারিখ ও সময় </th>
                                                    <th > রেসপন্সের তারিখ ও সময় </th>
                                                    <th > রেসপন্সে বিলম্ব  </th>
                                                    <!---------------
                                                    <th > মূল ঘটনা</th>
                                                    -------->
                                                    
                                                    <th > ঘটনার ধরণ </th>
                                                    <th > ঘটনার সূত্রপাত </th>
                                                    <th>  ঘটনার সংক্ষিপ্ত বিবরন</th>
                                                    <th>  গৃহীত ব্যবস্থা</th>
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
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @php
function hms ($value) {
    $cal = floor($value / 3600 );
    return  str_pad($cal, 2, '0', STR_PAD_LEFT) . gmdate(":i:s", $value % 3600);
}
@endphp

                                            @if($qrrs->isNotEmpty())
                                            
                                            @foreach ($qrrs as $qrr)
                                                <tr>
                                                    <td class="table-action">
                                                        @can('qrr.view')
                                                        <a href="{{url('admin/qrrs/details/'.$qrr->id)}}"  class="action-icon text-primary">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        @endcan
                                                        @can('qrr.edit')
                                                        <a href="{{url('admin/qrrs/edit/'.$qrr->id)}}" class="action-icon text-success">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        @endcan
                                                        @can('qrr.review')
                                                        <a href="{{url('admin/qrrs/review/update/'.$qrr->id)}}" class="action-icon text-success">  <i class="fas fa-unlock-alt"></i></a>
                                                        @endcan
                                                        @can('qrr.delete')
                                                        <a href="{{url('admin/qrrs/delete/'.$qrr->id)}}"  onclick="return confirm('Do you want to delete this slider?')" class="action-icon text-danger"> <i class="mdi mdi-delete"></i></a>
                                                        @endcan
                                                    </td>
                                                    <td > {{$qrr->id}}</td>
                                                    <td > @if(isset($qrr->district->name)) {{$qrr->district->bn_name}} @endif</td>
                                                    <td > @if(isset($qrr->thana->name)) {{$qrr->thana->name}} @endif</td>
                                                    <td > {{$qrr->village_word}}</td>
                                                    <td > {{$qrr->source_of_info}}</td>
                                                    <td > @if(!empty($qrr->date_time_of_incident)) {{date('d/m/Y H:i:s', strtotime($qrr->date_time_of_incident))}} @endif</td>
                                                    <td > @if(!empty($qrr->date_time_of_police_news)) {{date('d/m/Y H:i:s', strtotime($qrr->date_time_of_police_news))}} @endif</td>
                                                    <td > @if(!empty($qrr->date_time_response)) {{date('d/m/Y H:i:s', strtotime($qrr->date_time_response))}} @endif</td>
                                                    <td >{{hms($qrr->delay_in_response)}} </td>
                                                    
                                                    <!--------
                                                    <td > {{ Str::limit($qrr->main_event, 20)}}</td>
                                                    
                                                    ----------->
                                                    
                                                    <td > {{$qrr->event_type}}</td>
                                                    <td > {{$qrr->begening_of_event}}</td>
                                                    <td > {{Str::limit($qrr->short_dettails, 5)}}</td>
                                                    <td > {{$qrr->action_taken}}</td>
                                                    <td > {{$qrr->gd_no}}</td>
                                                    <td > @if(!empty($qrr->gd_date)) {{date('d/m/Y', strtotime($qrr->gd_date))}} @endif</td>
                                                    <td > {{$qrr->case_no}}</td>
                                                    <td > @if(!empty($qrr->case_date)) {{date('d/m/Y', strtotime($qrr->case_date))}} @endif</td>
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
			
			
			
            <div class="sidebar-overlay open"></div>
			<!-- Footer Start -->
	  
<x-admin-footer/>
