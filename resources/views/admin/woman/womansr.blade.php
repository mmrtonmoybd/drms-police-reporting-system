
			<x-admin-header/>
			
			<!-- ============ Body content start ============= -->
			
			<div class="main-content pt-4">
                <div class="selectbox">
                    
                <form  action="{{url('admin/woman/src')}}" method="get">
               
               <div class="" id="app">
                                                                 <div class="row">
                                          @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                    
                                                    
                                                    
                                                    <select name="districtID" id="districtID" class="form-select form-control stylish "  v-model="district_id" @change="getUpozillasAndThana()">
                                                        <option value="">জেলা</option>

                                                        @php 
                                                        if (request()->input('districtID') !== 'খালি') {
                                                         $did = request()->input('districtID');
                                                        } else {
                                                         $did = 82625;
                                                        }
                                                        @endphp

                                                        @if($districts)

                                                        @foreach($districts as $district)
                                                        <option value="{{$district->id}}" {{ ($district->id == $did) ? 'selected' : '' }} >{{$district->bn_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label"></label>
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select form-control stylish" >
                                                        <option value="">থানা</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>

                                            @endif

                                            @if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label"></label>
                                                    <select name="thanaID" id="thanaID" class="form-select form-control stylish" >
                                                      
                                                        <option value="">থানা</option>
                                                        @if($spthanas)

                                                        @foreach($spthanas as $thnsp)
                                                        <option value="{{$thnsp->id}}"  {{ ($thnsp->id == request()->input('thanaID')) ? 'selected' : '' }}>{{$thnsp->bn_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            @endif

                                             @if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label"></label>
                                                    <select name="thanaID" id="thanaID" class="form-select form-control stylish">
                                                        <option value="">থানা</option>
                                                        @if($octhana)

                                                        <option value="{{$octhana->id}}" selected>{{$octhana->bn_name}}</option>
                                                        
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            @endif


                                    

                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="action_taken" class="form-label"></label>
                                                    <select name="action_taken" id="action_taken" class="droparrow form-select form-control stylish" >
                                                        <option value="">   গৃহীত ব্যবস্থা  </option>
                                                        <option value="অভিযোগ গ্রহণ" {{ request('action_taken') =='অভিযোগ গ্রহণ' ? 'selected' : '' }}>অভিযোগ  গ্রহণ</option>
                                                        <option value="স্থানীয় পর্যায়ে মীমাংসা" {{ request('action_taken') =='স্থানীয় পর্যায়ে মীমাংসা' ? 'selected' : '' }}>স্থানীয়  পর্যায়ে মীমাংসা</option>
                                                        <option value="মামলা" {{ request('action_taken') =='মামলা' ? 'selected' : '' }}>মামলা</option>
                                                        <option value="আইনগত পরামর্শ" {{ request('action_taken') =='আইনগত পরামর্শ' ? 'selected' : '' }}>আইনগত পরামর্শ</option>
                                                        <option value="জিডি" {{ request('action_taken') =='জিডি' ? 'selected' : '' }}>জিডি</option> 
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-4 " > 
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <div class="input-group" id="timepicker-input-group2">
                     <input type="text" name="form"  value="{{request()->input('form')}}" id="date_time_response" class="form-control searchdatepick  @error('form') is-invalid @enderror"  autocomplete="off" data-date-format="yyyy/mm/dd"  placeholder=" তারিখ শুরু" >
                     <input type="text" name="to"  value="{{request()->input('to')}}" id="date_time_response" class="form-control searchdatepick  @error('to') is-invalid @enderror"  autocomplete="off" data-date-format="yyyy/mm/dd"  placeholder="তারিখ পর্যন্ত" >
                  </div>
               </div>
            </div>
            
            <div class="col-sm-2 " >
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                 <button type="submit" name="submit" class="btn" style="width: 100%;"> সার্চ করুন </button>
               </div>
            </div>
         </div>
      </div>
			
			
            <div class="main-content pt-4">
              
                <div class="separator-breadcrumb border-top"></div>
                <div class="row">
                    <!-- ICON BG-->
                     <div class="col-sm-3">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                               <a href="{{url('/admin/woman')}}">   
                            <div class="card-body "><i class="i-Add-User"></i>
                          
								<div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">মোট  অভিযোগ </p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{$totalcomplain}}</p>
                                </div>


                            </div>
                               </a>   
                        </div>
                    </div>


                     @can('woman.review.info')

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            
                               <a href="{{url('/admin/woman/review')}}">   
                            <div class="card-body text-center"><!------- <i class="i-Add-User"></i>   --------->
                               
								<div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0"> ওসি পেন্ডিং </p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{$reviewpending}}</p>
                                </div>
								
                            </div>
                            </a>
                            
                        </div>
                    </div>

                    @endcan
                    
                
                    
                
                    
                    
                    <div class="col-sm-3">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body "><i class="i-Add-User"></i>
                          
								<div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">মোট   নিস্পত্তি </p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{$totalnispotti}}</p>
                                </div>


                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-sm-3">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body "><i class="i-Add-User"></i>
                          
								<div class="content" >
                                    <p class="text-muted mt-2 mb-0"> Total পেন্ডিং </p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{$womanpending . '(' . $pendingpercen . '%)'}}</p>
                                </div>


                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-sm-2">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body ">
                          
								<div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0"> ফিডব্যাক গ্রহণ </p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{$totalfidback}}</p>
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
                    <div class="col-lg-5 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title">অভিযোগ সংখ্যা</div>
                                <div id="chart_div" style="margin-top: -39px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
					
					<div class="col-lg-7 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title" > গৃহীত ব্যবস্থা </div>
                                <div id="piechart" style="margin-top: -39px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>


                    
                      <div class="col-lg-7 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title" > সন্তুষ্টি রিপোর্ট </div>
                                <div id="piechart2" style="margin-top: -39px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                    
                          <div class="col-lg-5 col-sm-12">
                        <div class="card mb-4" style="height: 354px;">
                            <div class="card-body">
                                <div class="card-title">নিস্পত্তি রিপোর্ট</div>
                                <div id="columnchart_values" style="margin-top: -71px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
           





                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body">

                             <table class="table table-bordered table-responsive table-striped table-centered mb-0">
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
                                                    <th > অভিযুক্তের সংখ্যা </th>
                                                    <th>  তদন্তকারী কর্মকর্তার নাম ও পদবি</th>
                                                    <th > তদন্তকারী কর্মকর্তার বিপি নাম্বার </th>
                                                    <th > মোবাইল নং </th>
                                                    <th > জিডি নং </th>
                                                    <th > তারিখ </th>
                                                    <th > মামলা নং </th>
                                                    <th > তারিখ </th>
                                                    <th > ধারা </th>
                                                    <th > অভিযোগ নং </th>
                                                    <th> তারিখ </th>
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
                                                    <td > {{Str::limit($woman->village_word, 10)}}</td>
                                                    <td > @if(!empty($woman->wdate)) {{date('d/m/Y H:i', strtotime($woman->wdate))}} @endif</td>
                                                    <td>  {{$woman->event_type}}</td>
                                                    <td>  {{$woman->begening_of_event}}</td>
                                                    <td>  {{Str::limit($woman->short_dettails, 10)}}</td>
                                                    <td > {{Str::limit($woman->badi_name, 10)}}</td>
                                                    <td > {{$woman->badi_age}}</td>
                                                    <td > {{Str::limit($woman->badi_address, 10)}}</td>
                                                    <td > {{ $woman->badi_phone}}</td>
                                                    <td > {{Str::limit($woman->vbadi_name, 10)}}</td>
                                                    <td > {{Str::limit($woman->vbadi_address, 10)}}</td>
                                                    <td > {{$woman->complaint_reson}}</td>
                                                    <td>  {{Str::limit($woman->investigator_name, 10)}}</td>
                                                    <td>  {{$woman->investigator_title}}</td>
                                                    <td>  {{$woman->mobile_no}}</td>
                                                    <td > {{Str::limit($woman->gd_no, 15)}}</td>
                                                    <td > @if(!empty($woman->gd_date)) {{date('d/m/Y', strtotime($woman->gd_date))}} @endif</td>
                                                    <td > {{Str::limit($woman->mamla_no, 15)}}</td>
                                                    <td > @if(!empty($woman->mamla_date)) {{date('d/m/Y', strtotime($woman->mamla_date))}} @endif</td>
                                                    <td > {{Str::limit($woman->dhara, 10)}}</td>
                                                    <td > {{Str::limit($woman->complaint_no, 15)}}</td>
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
			
			
			

 @php
 $sdisn = request()->input('districtID');
 $sthan = request()->input('thanaID');
                
                  $division_id = 1;
                if(($sdisn !== 'খালি'))
                    $district_id = $sdisn;
                if(($sthan !== 'খালি'))
                    $thana_id = $sthan;

                @endphp
    <script src="{{ asset('my-assets/admin/js/vue.js') }}"></script>
    <script src="{{ asset('my-assets/admin/js/axios.min.js') }}"></script>

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
            
            division_id:'@if(isset($division_id) and $division_id){{$division_id}}@endif',
            district_id:'@if(isset($district_id) and $district_id){{$district_id}}@endif',
            upozilla_id:'@if(isset($upozilla_id) and $upozilla_id){{$upozilla_id}}@endif',
            thana_id:'@if(isset($thana_id) and $thana_id){{$thana_id}}@endif',


          },

            created(){
                
                if(this.division_id!=""){
                    this.getDistricts();
                }
                if(this.district_id!=""){
                    this.getThanas();
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
                        axios.get(this.ajax_url+'/thanas/'+this.district_id)
                        .then(res => {
                            this.thanas = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },
                

            }

        });

    </script>

    
		<x-admin-footer/>

