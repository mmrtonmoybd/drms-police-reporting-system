
			<x-admin-header/>
			
			<!-- ============ Body content start ============= -->
			
			
			
			
            <div class="main-content pt-4">
                <div class="selectbox">
                    
              
               
               <div class="" id="app">
                   
                   
                   
                      <form target="_blank" action="{{url('admin/narcotic/src')}}" method="get">
                          
                                        <div class="row">
										
                                                       @if (auth()->user()->hasRole('Super Admin'))
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                    <select name="districtID" id="districtID" class="form-select form-control stylish"  v-model="district_id" @change="getUpozillasAndThana()"  >
                                                        <option value="">জেলা</option>
                                                        @if($districts)

                                                        @foreach($districts as $district)
                                                        <option value="{{$district->id}}" {{ ( $district->id == $request->input('districtID')) ? 'selected' : '' }} >{{$district->bn_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
												
												
												
												
												 <div class="col-sm-2">
                                               <div class="mb-3">
                                                    <label for="thanaID" class="form-label"></label>
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select form-control stylish" required>
                                                        <option value="">Select</option>
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
                                                        <option value="{{$thnsp->id}}" {{ ( $thnsp->id == $request->input('thanaID')) ? 'selected' : '' }}>{{$thnsp->bn_name}}</option>
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
												
												
												
												
												            <div class="col-sm-2 ">
               <div class="mb-3">
                  <label for="name_of_investigator_org" class="form-label"></label>
                                                    <select name="name_of_investigator_org" id="name_of_investigator_org" class="form-select form-control stylish" >
                                                        <option value="">সংস্থা</option>
                                                        <option value="থানা পুলিশ" {{ ( 'থানা পুলিশ' == $request->input('name_of_investigator_org')) ? 'selected' : '' }}> থানা পুলিশ </option>
                                                        <option value="ডিবি" {{ ( 'ডিবি' == $request->input('name_of_investigator_org')) ? 'selected' : '' }}>ডিবি</option>
                                                        <option value="র‍্যাব" {{ ( 'র‍্যাব' == $request->input('name_of_investigator_org')) ? 'selected' : '' }}>র‍্যাব</option>
                                                        <option value="এপিবিএন" {{ ( 'এপিবিএন' == $request->input('name_of_investigator_org')) ? 'selected' : '' }}>এপিবিএন</option>
                                                        <option value="মাদকদ্রব্য নিয়ন্ত্রণ অধিদপ্তর" {{ ( 'মাদকদ্রব্য নিয়ন্ত্রণ অধিদপ্তর' == $request->input('name_of_investigator_org')) ? 'selected' : '' }}>মাদকদ্রব্য নিয়ন্ত্রণ অধিদপ্তর</option>
                                                        <option value="কোস্টগার্ড" {{ ( 'কোস্টগার্ড' == $request->input('name_of_investigator_org')) ? 'selected' : '' }}>কোস্টগার্ড</option>
                                                        <option value="অন্যান্য" {{ ( 'অন্যান্য' == $request->input('name_of_investigator_org')) ? 'selected' : '' }}>অন্যান্য</option>
                                                    </select>
               </div>
            </div>
												
												
												
												
												
												<div class="col-sm-4 " > 
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <div class="input-group" id="timepicker-input-group2">
                    
                   <input type="text" name="form"  value="{{old('form')}}" id="date_time_response" class="form-control searchdatepick  @error('form') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder=" তারিখ শুরু" >
                     <input type="text" name="to"  value="{{old('to')}}" id="date_time_response" class="form-control searchdatepick  @error('to') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="তারিখ পর্যন্ত" >
                  </div>
               </div>
            </div>
            
            <div class="col-sm-2 " >
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <button type="submit" name="submit" class="btn" style="width:100%;"> সার্চ করুন </button>
               </div>
            </div>
         </div>
         </form>
    
   
         
      
      </div>
	  

					
                </div>
                <div class="separator-breadcrumb border-top"></div>
             
		
             










    <div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        
                                        

                                   

                                          
                                   <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 86px">Action</th>
                                                    <th > রেফারেন্স নং </th>
                                                    <th > ট্র্যাকিং নং </th>
                                                    <th> ক্রমিক নং </th>
                                                    <th > ফোল্ডার নং </th>
                                                    <th > জেলা </th>
                                                    <th > থানা </th>
                                                    <th > গ্রাম/ওয়ার্ড </th>
                                                    <th > ঘটনার তারিখ </th>
                                                    <th > মামলা নং </th>
                                                    <th > ধারা </th>
                                                    <th > অভিযান পরিচালনাকারী সংস্থা </th>
                                                    <th > অভিযান পরিচালনাকারী অফিসার  </th>
                                                    <th > বিপি নং </th>
                                                    <th > মোবাইল নং </th>
                                                    <th > গাঁজা (গ্রাম) </th>
                                                    <th > গাঁজা গাছ (সংখ্যা) </th>
                                                    <th > ইয়াবা (পিচ) </th>
                                                    <th > ইরোইন (গ্রাম) </th>
                                                    <th > ফেনসিডিল (বোতল) </th>
                                                    <th > চোলাই মদ (লিটার) </th>
                                                    <th > বিদেশী মদ (লিটার) </th>
                                                    <th > এলএসডি (মাইক্রোগ্রাম) </th>
                                                    <th > আইস (মাইক্রোগ্রাম) </th>
                                                    <th > আন্যান্য </th>
                                                    <th > গ্রেফতারকৃত আসামীর সংখ্যা </th>
                                                    <th > অভিযুক্ত </th>
                                                    <th > ছবি তোলা হয়েছে </th>
                                                    <th > জব্দ তালিকা  </th>
                                                    <th > মাদকের রিপোর্ট প্রাপ্তি </th>
                                                    <th > তদন্তের ফলাফল (CS নং) </th>
                                                    <th > তারিখ </th>
                                                    <th > মন্তব্য  </th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if($narcotics2)
                                            @foreach ($narcotics2 as $nar)
                                                <tr>
                                                    <td class="table-action">
                                                        <a href="{{url('admin/narcotic/view/'.$nar->id)}}"  class="action-icon text-primary">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        @can('narcotic.edit')
                                                        <a href="{{url('admin/narcotic/edit/'.$nar->id)}}" class="action-icon text-success">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        @endcan
                                                        @can('narcotic.delete')
                                                        <a href="{{url('admin/narcotic/delete/'.$nar->id)}}"  onclick="return confirm('Do you want to delete this slider?')" class="action-icon text-danger"> <i class="mdi mdi-delete"></i></a>
                                                       @endcan
                                                    </td>
                                                    <td > {{$nar->id}}</td>
                                                    <td > {{$nar->trakingID}}</td>
                                                    <td> {{$nar->serial}}</td>
                                                    <td > {{$nar->folder_no}}</td>
                                                    <td > @if(isset($nar->district->name)) {{$nar->district->bn_name}} @endif</td>
                                                    <td > @if(isset($nar->thana->name)) {{$nar->thana->name}} @endif</td>
                                                    <td > {{$nar->village_word}}</td>
                                                    <td > {{date('d/m/Y', strtotime($nar->sdate))}}</td>
                                                    <td > {{$nar->case_no}}</td>
                                                    <td > {{$nar->nopc}}</td>
                                                    <td > {{$nar->name_of_investigator_org}}</td>
                                                    <td > {{$nar->name_of_investigator}}</td>
                                                    <td > {{$nar->bp_no}}</td>
                                                    <td > {{$nar->mobile_no}}</td>
                                                    <td > {{$nar->gaza}}</td>
                                                    <td > {{$nar->gaza_tree}}</td>
                                                    <td > {{$nar->yaba}}</td>
                                                    <td > {{$nar->heroine}}</td>
                                                    <td > {{$nar->fansdel}}</td>
                                                    <td > {{$nar->cholai_alcohol}}</td>
                                                    <td > {{$nar->bidesh_alcohol}}</td>
                                                    <td > {{$nar->lsd}}</td>
                                                    <td > {{$nar->ice}}</td>
                                                    <td > {{$nar->otherd}}</td>
                                                    <td > {{$nar->number_of_accused}}</td>
                                                    <td > {{Str::limit($nar->accused)}}</td>
                                                    <td > {{$nar->image_video}}</td>
                                                    <td > {{$nar->jobdo_list}}</td>
                                                    <td > {{$nar->narocotic_test_report}}</td>
                                                    <td > {{$nar->investigate_result}}</td>
                                                    <td > @if(!empty($nar->tdate)) {{ date('d/m/Y', strtotime($nar->tdate)) }} @endif</td>
                                                    <td > {{Str::limit($nar->comment, 5)}}</td>
                                                    
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>

                                         <nav class="mt-3">

                                        @if($narcotics2){{$narcotics2->appends(request()->input())->links()}} @endif
                                      
                                        </nav>


                                    </div>
                                </div>
                            </div>
                        </div>












            </div>
			
			
			
            <div class="sidebar-overlay open"></div>
			<!-- Footer Start -->
			
			
			
			
			
			
			
                                        
@php
                if($request->input('divisionID'))
                    $division_id = $request->input('divisionID');
                if($request->input('districtID'))
                    $district_id = $request->input('districtID');
                if($request->input('thanaID'))
                    $thana_id = $request->input('thanaID');


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
                    this.getUpozillas();
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