
			<x-admin-header/>
			
			<!-- ============ Body content start ============= -->
			
			
			
			
            <div class="main-content pt-4">
                <div class="selectbox">
                    
                <form  action="{{url('admin/qrrs/charts')}}" method="get">
               
               <div class="" id="app">
                                        <div class="row">
                                          @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                    <select name="districtID" id="districtID" class="droparrow form-control stylish"  v-model="district_id" @change="getUpozillasAndThana()"  >
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
                                                    <select name="thanaID" id="thanaID" class="form-control stylish" >
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
                     <input type="text" name="form"  value="{{old('form')}}" id="date_time_response" class="form-control searchdatepick  @error('form') is-invalid @enderror"  autocomplete="off" data-date-format="yyyy/mm/dd"  placeholder=" তারিখ শুরু" >
                     <input type="text" name="to"  value="{{old('to')}}" id="date_time_response" class="form-control searchdatepick  @error('to') is-invalid @enderror"  autocomplete="off" data-date-format="yyyy/mm/dd"  placeholder="তারিখ পর্যন্ত" >
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
	  
	  @php
function hms ($value) {
    $cal = floor($value / 3600 );
    return  str_pad($cal, 2, '0', STR_PAD_LEFT) . gmdate(":i:s", $value % 3600);
}
@endphp
					
                </div>
                <div class="separator-breadcrumb border-top"></div>
                <div class="row">
                    <!-- ICON BG-->
           
                          <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                          
                            <a href="{{url('/admin/qrrs/srcs/data')}}" target="_blank">  
                            <div class="card-body text-center"><i class="i-Add-User"></i>
								<div class="content" style="max-width: 100%;">
                                   <p class="text-muted mt-2 mb-0">মোট রিপোর্ট </p>
                                   <p class="text-primary text-24 line-height-1 mb-2">{{$tin}}</p>
                                </div>
                            </div>
                            
                            </a>
                            
                        </div>
                    </div>

                    @can('qrr.review.info')

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                          
                            <a href="{{url('/admin/qrrs/review')}}" target="_blank">  
                            <div class="card-body text-center"><i class="i-Add-User"></i>
								<div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0"> QRR পেন্ডিং রিভিউ </p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{$reviewpending}}</p>
                                </div>
                            </div>
                            
                            </a>
                            
                        </div>
                    </div>

                    @endcan

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Clock"></i>
                                <div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">গড় সাড়াদানের সময়</p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{hms($avgrespontime)}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
					
					  @if (auth()->user()->hasAnyRole(['Super Admin', 'SP', 'Admin']))
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Clock-Forward"></i>
                                <div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">গড় রিপোর্টে বিলম্ব</p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{hms($avgreportdelay)}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
					@endif
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

              <!---------- <h1>Data render date {{session("agomonthday")}} To {{session("currentday")}}</h1> ---> 
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title">জেলা ভিত্তিক রিপোর্ট </div>
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
					
					
					      <div class="col-lg-4 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title" > গৃহীত ব্যবস্থা </div>
                                <div id="piechart3" style="margin-top: -39px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
              

                    <div class="col-lg-6 col-sm-12">
                        <div class="card mb-4" style="height: 354px;">
                            <div class="card-body">
                                <div class="card-title">ঘটনার সুত্রপাত</div>
                                <div id="chart_div4" style="margin-top: -71px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
             

                <div class="col-lg-6 col-sm-12">
                        <div class="card mb-4" style="height: 354px;">
                            <div class="card-body">
                                <div class="card-title">ঘটনার ধরন</div>
                                <div id="chart_div2" style="margin-top: -71px;height: 300px;"></div>
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

