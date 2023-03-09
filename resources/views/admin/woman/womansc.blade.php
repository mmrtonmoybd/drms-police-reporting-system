
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
                                                    <select name="districtID" id="districtID" class="droparrow form-select form-control stylish"  v-model="district_id" @change="getUpozillasAndThana()"  >
                                                        <option value="">জেলা</option>
                                                        @if($districts)

                                                        @foreach($districts as $district)
                                                        <option value="{{$district->id}}">{{$district->bn_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label"></label>
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="droparrow form-select form-control stylish" >
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
                                                    <select name="thanaID" id="thanaID" class="droparrow form-select form-control stylish" >
                                                        <option value="">থানা</option>
                                                        @if($spthanas)

                                                        @foreach($spthanas as $thnsp)
                                                        <option value="{{$thnsp->id}}">{{$thnsp->bn_name}}</option>
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
                                                    <select name="thanaID" id="thanaID" class="droparrow form-select form-control stylish" >
                                                        <option value="" disabled >থানা</option>
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
                                                        <option value="অভিযোগ গ্রহণ">অভিযোগ  গ্রহণ</option>
                                                        <option value="স্থানীয় পর্যায়ে মীমাংসা">স্থানীয়  পর্যায়ে মীমাংসা</option>
                                                        <option value="মামলা">মামলা</option>
                                                        <option value="জিডি">জিডি</option> 
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-4 " > 
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <div class="input-group" id="timepicker-input-group2">
                     <input type="text" name="form"  value="{{old('form')}}" id="date_time_response" class="form-control searchdatepick  @error('form') is-invalid @enderror"  autocomplete="off" data-date-format="yyyy/mm/dd"  placeholder=" তারিখ শুরু" >
                     <input type="text" name="to"  value="{{old('to')}}" id="date_time_response" class="form-control searchdatepick  @error('to') is-invalid @enderror"  autocomplete="off" data-date-format="yyyy/mm/dd"  placeholder="তারিখ পর্যন্ত" >
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
	  

					
                </div>
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
                                    <p class="text-muted mt-2 mb-0">মোট নিস্পত্তি </p>
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
           


            </div>
			
			
			
            <div class="sidebar-overlay open"></div>
			<!-- Footer Start -->
			
			
			
			

 <!-- end row -->
                        @php
                if($request->input('divisionID'))
                    $division_id = $request->input('divisionID');
                if($request->input('districtID'))
                    $district_id = $this->input('districtID');
                if($request->input('upazilaID'))
                    $upozilla_id = $request->input('upazilaID');
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
