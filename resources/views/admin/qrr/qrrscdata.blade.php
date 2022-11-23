
			<x-admin-header/>
			
			<!-- ============ Body content start ============= -->
			
			
			
			
            <div class="main-content pt-4">
                <div class="selectbox">
                    
                <form target="_blank" action="{{url('admin/qrrs/charts')}}" method="get">
               
               <div class="" id="app">
                                        <div class="row">
                                          @if (auth()->user()->hasRole('Super Admin'))
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                    
                                                           @php 
                                                        if ($sdisn !== 'খালি') {
                                                         $col = 'purplecol';
                                                        } else {
                                                         $col ='';
                                                        }
                                                        
                                                   
                                                        
                                                        
                                                        
                                                        @endphp
                                                    
                                                   
                                                    
                                                    
                                                    <select name="districtID" id="districtID" class="droparrow form-control stylish  @php echo $col; @endphp "  v-model="district_id" @change="getUpozillasAndThana()">
                                                        <option value="">জেলা</option>

                                                        @php 
                                                        if ($sdisn !== 'খালি') {
                                                         $did = $sdisn->id;
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
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="droparrow form-control stylish" >
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
                                                    <select name="thanaID" id="thanaID" class="droparrow form-control stylish" >
                                                       @php 
                                                        if ($sthan !== 'খালি') {
                                                         $did = $sthan->id;

                                                         //dd($did);
                                                        } else {
                                                         $did = 82625;
                                                        }
                                                        @endphp
                                                        <option value="">থানা</option>
                                                        @if($spthanas)

                                                        @foreach($spthanas as $thnsp)
                                                        <option value="{{$thnsp->id}}"  {{ ($thnsp->id === $did) ? 'selected' : '' }}>{{$thnsp->bn_name}}</option>
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
                                                    <select name="thanaID" id="thanaID" class="droparrow form-control stylish">
                                                        <option value="">থানা</option>
                                                        @if($octhana)

                                                        <option value="{{$octhana->id}}" selected>{{$octhana->bn_name}}</option>
                                                        
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            @endif


</form>


                                    
            <div class="col-sm-2 ">
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <select name="source_of_info" id="source_of_info" class="droparrow form-control stylish">
                     <option value="">উৎস</option>
                     <option value="এলাকা"> এলাকা </option>
                     <option value="কোর্ট">কোর্ট</option>
                     <option value="থানা">থানা</option>
                     <option value="৯৯৯">৯৯৯</option>
                  </select>
               </div>
            </div>
            <div class="col-sm-4 " > 
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <div class="input-group" id="timepicker-input-group2">
                     <input type="text" name="form"  value="{{old('form')}}" id="date_time_response" class="form-control datepicker  @error('form') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder=" তারিখ শুরু" >
                     <input type="text" name="to"  value="{{old('to')}}" id="date_time_response" class="form-control datepicker  @error('to') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="তারিখ পর্যন্ত" >
                  </div>
               </div>
            </div>
            
            <div class="col-sm-2 " >
               <div class="mb-3">
			           <label for="source_of_info" class="form-label"></label>
                  <label for="source_of_info" class="form-label"></label>
                  <button type="submit" name="submit" class="btn" style="width:100%;"> সার্চ করুন </button>
               </div>
            </div>
         </div>
      </div>
	  
	  
					
                </div>
                <div class="separator-breadcrumb border-top"></div>
              


				
				
				<style>
				.card-title {
					z-index:2000;
					position:relative;
				}
				</style>














<div class="row">
  <div class="card card-body table-responsive">

      <div style="text-align: right;margin: 16px;">
                    
                                          
  <a target="_blank" href="{{url('admin/qrrs/srcs/excel')}}" class="btn btn-success"><i class="fa fa-file-excel"></i> Excel</a>
  <a target="_blank" href="{{url('admin/qrrs/srcs/pdf')}}" class="btn btn-success"><i class="fa fa-file-pdf"></i> PDF</a>
      
											
											</div>
    
   
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
                                                    <td >
                                                        
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
			
			
			
			
			
	
<!-- end row -->

     @php
                
                  $division_id = 1;
                if(($sdisn !== 'খালি'))
                    $district_id = $sdisn->id;
                if(($sthan !== 'খালি'))
                    $thana_id = $sthan->id;

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
