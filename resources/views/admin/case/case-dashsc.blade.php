
			<x-admin-header/>
			
			<!-- ============ Body content start ============= -->
			
			
			
			
            <div class="main-content pt-4">
                <div class="selectbox">
                    
                <form action="{{url('/admin/case/dashboard/search')}}" method="GET">
               
               <div class="" id="app">
                                        <div class="row">
                                                                         @if (auth()->user()->hasRole('Super Admin'))
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                    <select name="districtID" id="districtID" class="droparrow form-select form-control stylish @error('districtID') is-invalid @enderror"  v-model="district_id" @change="getCircles()" >
                                                        <option value="">জেলা</option>
                                                        @if($districts)

                                                        @foreach($districts as $district)
                                                        <option value="{{$district->id}}" {{ ( $district->id == $request->input('districtID')) ? 'selected' : '' }}>{{$district->bn_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="circleID" class="form-label"></label>
                                                    <select name="circleID" id="circleID"  v-model="circle_id" class="droparrow form-select form-control stylish @error('circleID') is-invalid @enderror" @change="getUpozillasAndThana()">
                                                        <option value="">সার্কেল</option>
                                                        <option v-for="(circle,key,index) in circles" v-bind:value="circle.id"> @php echo '{{ circle.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label"></label>
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="droparrow form-select form-control  stylish @error('thanaID') is-invalid @enderror">
                                                        <option value="">থানা</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>
                                            @elseif(auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="circleID" class="form-label"></label>
                                                    <select name="circleID" id="circleID"  v-model="circle_id" class="droparrow form-select form-control stylish  @error('circleID') is-invalid @enderror" @change="getUpozillasAndThana()">
                                                        <option value="">সার্কেল</option>
                                                        @if($circledbs)

                                                        @foreach($circledbs as $circledb)
                                                        <option value="{{$circledb->id}}" {{ ( $circledb->id == $request->input('circleID')) ? 'selected' : '' }}>{{$circledb->name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label"></label>
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="droparrow form-select form-control stylish  @error('thanaID') is-invalid @enderror" >
                                                        <option value="">থানা</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>
                                            @else
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label"></label>
                                                    <select name="thanaID" id="thanaID" class="droparrow form-select form-control stylish @error('thanaID') is-invalid @enderror">
                                                        
                                                        <option value="{{$thanades->id}}" selected>{{$thanades->bn_name}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="col-sm-4 " > 
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <div class="input-group" id="timepicker-input-group2">
                     <input type="text" name="form"  value="{{request()->input('form')}}" id="date_time_response" class="form-control searchdatepick  @error('form') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="Case তারিখ শুরু" >
                     <input type="text" name="to"  value="{{request()->input('to')}}" id="date_time_response" class="form-control searchdatepick  @error('to') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="Case তারিখ পর্যন্ত" >
                  </div>
               </div>
            </div>



                           <div class="col-sm-2 " > 
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <div class="input-group" id="timepicker-input-group2">
                     <button type="submit" name="submit" class="btn btn-primary" style="width:100%;"> সার্চ করুন </button>
                  </div>
               </div>
            </div>
                                          


         </div>
      </div>
	  

					
                </div>
                <div class="separator-breadcrumb border-top"></div>
                <div class="row">
                    <!-- ICON BG-->
                    
                    
                    
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Add-User"></i>
                            <a href="{{url('/admin/qrrs/srcs/data')}}">   
								<div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">মোট  কেস </p>
                                    <p class="text-primary text-24 line-height-1 mb-2"> {{$totalcase}}</p>
                                </div>
								</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Financial"></i>
                                <div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">মোট কেস নিস্পত্তি</p>
                                    <p class="text-primary text-24 line-height-1 mb-2"> {{$totalendingcase}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
					

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Checkout-Basket"></i>
                                <div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">মোট মুলতবি</p>
                                    <p class="text-primary text-24 line-height-1 mb-2"> {{$totalmultobicase}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
			
			
			
			@php
function hms ($value) {
    $cal = floor($value / 3600 );
    return  str_pad($cal, 2, '0', STR_PAD_LEFT) . gmdate(":i:s", $value % 3600);
}
@endphp

			
			
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Add-User"></i>
                            <a href="{{url('/admin/qrrs/srcs/data')}}">   
								<div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">গড় নিস্পত্তি সময় </p>
                                    <p class="text-primary text-24 line-height-1 mb-2"> {{hms($avgendingcasetime)}}</p>
                                </div>
								</a>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Financial"></i>
                                <div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">এজহার ভুক্ত আসামি</p>
                                    <p class="text-primary text-24 line-height-1 mb-2"> {{$azaharnamioasami}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
					

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Checkout-Basket"></i>
                                <div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">আটক সংখ্যা</p>
                                    <p class="text-primary text-24 line-height-1 mb-2"> {{$accusedasami}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
			
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Checkout-Basket"></i>
                                <div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">জামিন সংখ্যা</p>
                                    <p class="text-primary text-24 line-height-1 mb-2"> {{$jaminprapto}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
			
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Checkout-Basket"></i>
                                <div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">অব্যহতিপ্রাপ্ত সংখ্যা</p>
                                    <p class="text-primary text-24 line-height-1 mb-2"> {{$ovohotiprapto}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
			
			
			      <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Checkout-Basket"></i>
                                <div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">এজহার তদন্ত</p>
                                    <p class="text-primary text-24 line-height-1 mb-2"> {{$azaharnewinvistigateprapto}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
			
			
					<!--------
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Money-2"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">Expense</p>
                                    <p class="text-primary text-24 line-height-1 mb-2">$1200</p>
                                </div>
                            </div>
                        </div>
                    </div>
					--->
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
                                <div class="card-title">মোট কেস </div>
                                <div id="chart_div" style="margin-top: -39px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
		
                    
                    
                    			
					<div class="col-lg-4 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title" >নিস্পত্তির ধরন </div>
                                <div id="piechart" style="margin-top: -39px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
					
					
                </div>
           












<div class="row">
   <div class="card card-body table-responsive">

      <div style="text-align: right;margin: 16px;">
                    

      
											
											</div>
    
   
   <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 86px">Action</th>
                                                    <th> রেফারেন্স নং </th>
                                                    <th> জেলা</th>
                                                    <th> সার্কেল</th>
                                                    <th> থানা</th>
                                                    <th> মামলার কোড (CDMS)</th>
                                                    <th> উৎস</th>
                                                    <th> জি আর নং</th>
                                                    <th> মামলা নং</th>
                                                    <th> ধারা</th>
                                                    <th> তারিখ</th>
                                                    <th> মামলার ধরন</th>
                                                    <th> উপধরন</th>
                                                    <th> ঘটনার তারিখ</th>
                                                    <th> মামলার সারসংক্ষেপ</th>
                                                    <th> এজাহার নামীয় আসামির সংখ্যা</th>
                                                    <th> নিস্পত্তি / মুলতবি</th>
                                                    <th> নিস্পত্তির ধরন</th>
                                                    <th> সিএক্স/এফ আর নং</th>
                                                    <th> তারিখ</th>
                                                    <th> পুলিশ রিপোর্ট আসামির সংখ্যা</th>
                                                    <th> গ্রেফতারকৃত আসামির সংখ্যা</th>
                                                    <th> জামিন প্রাপ্ত</th>
                                                    <th> পলাতক</th>
                                                    <th> এজাহার বহির্ভুত তদন্তে প্রাপ্ত</th>
                                                    <th> অব্যহিত প্রাপ্ত</th>
                                                    <th> ১৬১ গ্রহন (পাবলিক)</th>
                                                    <th> ১৬৪ গ্রহন</th>
                                                    <th> তদন্তের মান</th>
                                                    <th> মন্তব্য</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if($cases)
                                            @foreach ($cases as $case)
                                                <tr >
                                                    <td class="table-action">
                                                        @can('case.view')
                                                        <a href="{{url('admin/case/view/'.$case->id)}}"  class="action-icon text-primary">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        @endcan
                                                        @can('case.edit')
                                                        <a href="{{url('admin/case/edit/'.$case->id)}}" class="action-icon text-success">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        @endcan
                                                        @can('case.delete')
                                                        <a href="{{url('admin/case/delete/'.$case->id)}}"  onclick="return confirm('Do you want to delete this slider?')" class="action-icon text-danger"> <i class="mdi mdi-delete"></i></a>
                                                        @endcan
                                                    </td>
                                                    <td > {{$case->id}}</td>
                                                    <td>{{$case->district->bn_name}}</td>
                                                    <td>{{$case->circle->name}}</td>
                                                    <td>{{$case->thana->bn_name}}</td>
                                                    <td>{{$case->cdms_pg_id}}</td>
                                                    <td>{{$case->source_of_info}}</td>
                                                    <td>{{Str::limit($case->gr_no, 15)}}</td>
                                                    <td>{{Str::limit($case->case_no, 10)}}</td>
                                                    <td>{{Str::limit($case->dhara, 10)}}</td>
                                                    <td>@if (!empty($case->case_date)) {{date('d/m/Y', strtotime($case->case_date))}} @endif</td>
                                                    <td>{{$case->casetype->type}}</td>
                                                    <td>@if (!empty($case->casesubtype)) {{$case->casesubtype->type}} @endif</td>
                                                     <td>@if (!empty($case->incident_date_time)) {{date('d/m/Y', strtotime($case->incident_date_time))}} @endif</td>
                                                    <td>{{Str::limit($case->short_dettails, 10)}}</td>
                                                    <td>{{Str::limit($case->azahar_namio_victims, 10)}}</td>
                                                    <td>{{Str::limit($case->nispotti_or_multobi, 10)}}</td>
                                                     <td>@if ($case->nispotti_type != 0) {{$case->nispotti_type}} @endif</td>
                                                    <td>{{Str::limit($case->cs_or_fr_no, 10)}}</td>
                                                    <td>@if (!empty($case->nispotti_date)) {{date('d/m/Y', strtotime($case->nispotti_date))}} @endif</td>
                                                    <td>{{Str::limit($case->police_report_victim, 10)}}</td>
                                                     <td>{{Str::limit($case->number_of_accused, 10)}}</td>
                                                    <td>{{Str::limit($case->jamin_prapto, 10)}}</td>
                                                    <td>{{Str::limit($case->polatok, 10)}}</td>
                                                    <td>{{Str::limit($case->azahar_vukto_invistigate, 10)}}</td>
                                                     <td>{{Str::limit($case->ovohoti, 10)}}</td>
                                                    <td>{{Str::limit($case->sixtyone_recive, 10)}}</td>
                                                    <td>{{Str::limit($case->sixtyfour_recive, 10)}}</td>
                                                    <td>{{Str::limit($case->invistigate_rate, 10)}}</td>

                                                     <td>{{Str::limit($case->comment, 10)}}</td>

                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        @if($cases){{$cases->appends(request()->input())->links()}} @endif
                                      
                                      
                                        </nav>
      
      
      
      
   </div>
</div>






            </div>
			
			
			
            <div class="sidebar-overlay open"></div>
			<!-- Footer Start -->
			
			
			
			
			
			
			
                        <!-- end row -->
                        @php
                        if (auth()->user()->hasRole('Super Admin')) {
                if($request->input('divisionID')) {
                    $division_id = $request->input('divisionID'); 
                }
                if($request->input('circleID')) {
                    $circle_id = $request->input('circleID');
                }
                if($request->input('districtID')) {
                    $district_id = $request->input('districtID');
                }
                if($request->input('upazilaID')) {
                    $upozilla_id = $request->input('upazilaID');
                }
                if($request->input('thanaID')) {
                    $thana_id = $request->input('thanaID'); 
                }
                if($request->input('caseTypeID')) { 
                    $casetype_id = $request->input('caseTypeID'); 
                }
                if($request->input('casesubID')) {
                    $casesub_id = $request->input('casesubID'); 
                }

            } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
                
                if($request->input('circleID')) {
                    $circle_id = $request->input('circleID');
                }
                if($request->input('thanaID')) {
                    $thana_id = $request->input('thanaID'); 
                }
                if($request->input('caseTypeID')) { 
                    $casetype_id = $request->input('caseTypeID'); 
                }
                if($request->input('casesubID')) {
                    $casesub_id = $request->input('casesubID'); 
                }
            } else {
               
                if($request->input('caseTypeID')) { 
                    $casetype_id = $request->input('caseTypeID'); 
                }
                if($request->input('casesubID')) {
                    $casesub_id = $request->input('casesubID'); 
                } 
            }

                @endphp
    <script src="{{ asset('my-assets/admin/js/vue.js') }}"></script>
    <script src="{{ asset('my-assets/admin/js/axios.min.js') }}"></script>






@if (auth()->user()->hasRole('Super Admin'))
  <script>
    var app = new Vue({
          el: '#app',
          data: {
            message: 'Hello Vue!',
            ajax_url: '<?php echo url('admin'); ?>',
           
              
            divisions:null,
            districts:null,
            upozillas:null,
            thanas:null,
            circles:null,
            casesubtypes:null,
            
            division_id:'@if(isset($division_id) and $division_id){{$division_id}}@endif',
            district_id:'@if(isset($district_id) and $district_id){{$district_id}}@endif',
            upozilla_id:'@if(isset($upozilla_id) and $upozilla_id){{$upozilla_id}}@endif',
            thana_id:'@if(isset($thana_id) and $thana_id){{$thana_id}}@endif',
            circle_id:'@if(isset($circle_id) and $circle_id){{$circle_id}}@endif',
            casetype_id:'@if(isset($casetype_id) and $casetype_id){{$casetype_id}}@endif',
            casesub_id:'@if(isset($casesub_id) and $casesub_id){{$casesub_id}}@endif',

          },

            created(){
                
                if(this.division_id!=""){
                    this.getDistricts();
                }
                if(this.district_id!=""){
                    this.getCircles();
                    this.getUpozillasAndThana();
                }

                if(this.circle_id!=""){
                    
                    this.getCircles();
                    this.getUpozillasAndThana();
                }
                 if(this.thana_id!=""){
                    
                    this.getUpozillasAndThana();

                }
                
                
            },


            methods:{

                
                // send message to account customer
                getDivisions(){
                     axios.get(this.ajax_url+'/divisions')
                    .then(res => {
                        this.divisions = res.data;
                    })
                    .catch(err => {console.log(err); });
                    
                },
                
                
                //this method for get districts
                getDistricts(){
                    if(this.division_id==""){
                   }else{
                        axios.get(this.ajax_url+'/districts/'+this.division_id)
                        .then(res => {
                            this.districts = res.data;
                        })
                        .catch(err => {console.log(err); });
                      
                   }
                    
                },

                getUpozillasAndThana(){
                    //this.getUpozillas();
                    this.getThanas();
                },
                
                //this method for get medicals
                getUpozillas(){
                    if(this.district_id==""){
                   }else{
                        axios.get(this.ajax_url+'/upazilas/'+this.district_id)
                        .then(res => {
                            this.upozillas = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },

                
                //this method for get medicals
                getThanas(){
                    if(this.district_id==""){
                   }else{
                        axios.get(this.ajax_url+'/circles/thanas/'+this.circle_id)
                        .then(res => {
                            this.thanas = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },


                getCircles(){
                    if(this.district_id==""){
                   }else{
                        axios.get(this.ajax_url+'/circles/'+this.district_id)
                        .then(res => {
                            this.circles = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },

                getCasesubtypes(){
                    if(this.casetype_id==""){
                   }else{
                        axios.get(this.ajax_url+'/casesub/type/'+this.casetype_id)
                        .then(res => {
                            this.casesubtypes = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },
                

            }

        });

    </script>
@elseif(auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))

<script>
    var app = new Vue({
          el: '#app',
          data: {
            message: 'Hello Vue!',
            ajax_url: '<?php echo url('admin'); ?>',
           
            thanas:null,
            circles:null,
            casesubtypes:null,
            
            thana_id:'@if(isset($thana_id) and $thana_id){{$thana_id}}@endif',
            circle_id:'@if(isset($circle_id) and $circle_id){{$circle_id}}@endif',
            casetype_id:'@if(isset($casetype_id) and $casetype_id){{$casetype_id}}@endif',
            casesub_id:'@if(isset($casesub_id) and $casesub_id){{$casesub_id}}@endif',

          },

            created(){
                
                if(this.circle_id!=""){
                    this.getUpozillasAndThana();
                }
                if(this.casetype_id!=""){
                    this.getCasesubtypes();
                }
                
            },


            methods:{


                getUpozillasAndThana(){
                    //this.getUpozillas();
                    this.getThanas();
                },

                
                //this method for get medicals
                getThanas(){
                    if(this.circle_id==""){
                   }else{
                        axios.get(this.ajax_url+'/circles/thanas/'+this.circle_id)
                        .then(res => {
                            this.thanas = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },


                getCasesubtypes(){
                    if(this.casetype_id==""){
                   }else{
                        axios.get(this.ajax_url+'/casesub/type/'+this.casetype_id)
                        .then(res => {
                            this.casesubtypes = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },
                

            }

        });

    </script>

@else

<script>
    var app = new Vue({
          el: '#app',
          data: {
            message: 'Hello Vue!',
            ajax_url: '<?php echo url('admin'); ?>',
           
            
            casesubtypes:null,
            
        
            casetype_id:'@if(isset($casetype_id) and $casetype_id){{$casetype_id}}@endif',
            casesub_id:'@if(isset($casesub_id) and $casesub_id){{$casesub_id}}@endif',

          },

            created(){
                
                if(this.casetype_id!=""){
                    this.getCasesubtypes();
                }
                
            },


            methods:{


                getCasesubtypes(){
                    if(this.casetype_id==""){
                   }else{
                        axios.get(this.ajax_url+'/casesub/type/'+this.casetype_id)
                        .then(res => {
                            this.casesubtypes = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },
                

            }

        });

    </script>

@endif
<x-admin-footer/>

