
			<x-admin-header/>
			
			<!-- ============ Body content start ============= -->
			
			
			
			
            <div class="main-content pt-4">
              
                <div class="separator-breadcrumb border-top"></div>
                <div class="row">
                    <!-- ICON BG-->
                    <div class="col-sm-12">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body "><i class="i-Add-User"></i>
                          
								<div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">মোট  অভিযোগ</ </p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{$totalcomplain}}</p>
                                </div>
							
                            </div>
                        </div>
                    </div>
         
		
		
                </div>
				
				
				
				<style>
				.card-title {
					z-index:2000;
					position:relative;
				}
				</style>
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title">অভিযোগ সংখ্যা</div>
                                <div id="chart_div" style="margin-top: -39px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
					
					<div class="col-lg-4 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title" > তথ্য প্রাপ্তির উৎস </div>
                                <div id="piechart" style="margin-top: -39px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
					
					
                    <div class="col-lg-4 col-sm-12">
                        <div class="card mb-4" style="height: 354px;">
                            <div class="card-body">
                                <div class="card-title">ঘটনার ধরন</div>
                                <div id="columnchart_values" style="margin-top: -71px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
           





                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">

                             <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 86px">Action</th>
                                                    <th>ID</th>
                                                    <th > রেফারেন্স নং </th>
                                                    <th > জেলা </th>
                                                    <th > থানা </th>
                                                    <th > গ্রাম/ওয়ার্ড </th>
                                                    <th > আগমনের তারিখ ও সময় </th>
                                                    <th>ঘটনার ধরণ</th>
                                                    <th>ঘটনার সূত্রপাত</th>
                                                    <th>ঘটনার সংক্ষিপ্ত বিবরন</th>
                                                    <th > বাদীর নাম </th>
                                                    <th > বাদীর বয়স </th>
                                                    <th > বাদীর ঠিকানা </th>
                                                    <th > বাদীর মোবাইল নং  </th>
                                                    <th > বিবাদীর নাম</th>
                                                    <th > বিবাদীর ঠিকানা </th>
                                                    <th > অভিযোগের কারন </th>
                                                    <th>  তদন্তকারী কর্মকর্তার নাম</th>
                                                    <th > তদন্তকারী কর্মকর্তার পদবী </th>
                                                    <th > মোবাইল নং </th>
                                                    <th > জিডি নং </th>
                                                    <th > তারিখ </th>
                                                    <th > মামলা নং </th>
                                                    <th > তারিখ </th>
                                                    <th > ধারা </th>
                                                    <th > অভিযোগ নং </th>
                                                    <th > তারিখ </th>
                                                    <th > সমস্যা সমাধান হয়েছে কিনা </th>
                                                    <th > গৃহীত ব্যবস্থা </th>
                                                    <th > নিষ্পত্তি রিপোর্ট </th>
                                                    <th>সন্তুষ্টির মান</th>
                                                    <th > মন্তব্য </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if($womans)
                                            @foreach ($womans as $woman)
                                                <tr>
                                                    <td class="table-action">
                                                       @can('woman.view')
                                                        <a href="{{url('admin/woman/view/'.$woman->id)}}"  class="action-icon text-primary">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        @endcan
                                                        @can('woman.edit')
                                                        <a href="{{url('admin/woman/edit/'.$woman->id)}}" class="action-icon text-success">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        @endcan
                                                        @can('woman.delete')
                                                        <a href="{{url('admin/woman/delete/'.$woman->id)}}"  onclick="return confirm('Do you want to delete this slider?')" class="action-icon text-danger"> <i class="mdi mdi-delete"></i></a>
                                                        @endcan
                                                    </td>
                                                   <td > {{$woman->id}}</td>
                                                    <td > {{$woman->reference_no}}</td>
                                                    <td > @if(isset($woman->district->name)) {{$woman->district->bn_name}} @endif</td>
                                                    <td > @if(isset($woman->thana->name)) {{$woman->thana->name}} @endif</td>
                                                    <td > {{$woman->village_word}}</td>
                                                    <td > @if(!empty($woman->wdate)) {{date('d/m/Y H:i', strtotime($woman->wdate))}} @endif</td>
                                                    <td>  {{$woman->event_type}}</td>
                                                    <td>  {{$woman->begening_of_event}}</td>
                                                    <td>  {{Str::limit($woman->short_dettails, 10)}}</td>
                                                    <td > {{$woman->badi_name}}</td>
                                                    <td > {{$woman->badi_age}}</td>
                                                    <td > {{Str::limit($woman->badi_address, 10)}}</td>
                                                    <td > {{ $woman->badi_phone}}</td>
                                                    <td > {{$woman->vbadi_name}}</td>
                                                    <td > {{$woman->vbadi_address}}</td>
                                                    <td > {{Str::limit($woman->complaint_reson, 5)}}</td>
                                                    <td>  {{$woman->investigator_name}}</td>
                                                    <td>  {{$woman->investigator_title}}</td>
                                                    <td>  {{$woman->mobile_no}}</td>
                                                    <td > {{$woman->gd_no}}</td>
                                                    <td > @if($woman->gd_date) {{date('d/m/Y', strtotime($woman->gd_date))}} @endif</td>
                                                    <td > {{$woman->mamla_no}}</td>
                                                    <td > @if($woman->mamla_date) {{date('d/m/Y', strtotime($woman->mamla_date))}} @endif</td>
                                                    <td > {{$woman->dhara}}</td>
                                                    <td > {{$woman->complaint_no}}</td>
                                                    <td>  @if(!empty($woman->complaint_date)) {{date('d/m/Y', strtotime($woman->complaint_date))}} @endif</td>
                                                    <td > {{$woman->problem_fix}}</td>
                                                    <td > {{$woman->action_taken}}</td>
                                                    <td > {{$woman->nreport}}</td>
                                                    <td>  {{$woman->satisfy_rate}}</td>
                                                    <td > {{Str::limit($woman->comment, 5)}}</td>
                                                       
                                                    
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        @if($womans){{$womans->appends(request()->input())->links()}} @endif
                                      
                                        </nav>

                                    </div>
                                </div>
                            </div>
                        </div>








            </div>
			
			
			
            <div class="sidebar-overlay open"></div>
			<!-- Footer Start -->
			
			
			


		<x-admin-footer/>

