
			<x-admin-header/>
			
			<!-- ============ Body content start ============= -->
			
			
			
			
			
<style>
body {
  overflow-x:hidden;
  }
#mySidenav a {
  position: fixed;
  right: -180px;
  transition: 0.3s;
  padding: 10px 0px 10px 10px;
  width: 250px;

  text-decoration: none;
  font-size: 20px;
  color: white;
  border-radius: 5px 0px 0px 5px;
  z-index: 1000;
}

#about:hover {
      height:230px;
  right: 0px;
  
}

#about {
      height:45px;
  top: 162px;
  background-color: #04AA6D;
  font-size: 14px !important;
}

#content  {
    position: relative;
  right:-80px;
  width:100%;
  margin-top: -40px;
  z-index: 1050;
}

#content:hover {
    position: relative;
  right:0px;
}


</style>





<div id="mySidenav" class="sidenav">
  <a href="#" id="about"><span id="htitile">একনজরে       </span>
  <div id="content" style="width:100%; height: 300px">
<br>
<br>

 <b>নিস্পত্তি এজহার নামীয় আসামীঃ </b> {{$nispottimamlaiazahar}} <br>
  <b>পুলিশ রিপোর্ট প্রাপ্তিঃ </b> {{$policereportprapti}}<br>
   <b> গ্রেফতার সংখ্যাঃ </b>    {{$accusedasami}}</br>
    <b> জামিন সংখ্যাঃ  </b>   {{$jaminprapto}}      </br>
  <b> এজহার বহিঃতদন্তঃ </b>       {{$azaharnewinvistigateprapto}}  </br>

  <b> অব্যহতিপ্রাপ্ত সংখ্যাঃ</b> {{$ovohotiprapto}}     </br>
 
 
  <b>১৬১ গ্রহনঃ</b>  {{$onesixtyrecive}} </br>
  <b>১৬৪ গ্রহনঃ </b> {{$onesixtyfourrecive}}<br>
 
  
  <br>
  
  </div>
   
  </a>
  
</div>


			
			
			
			
			
            <div class="main-content pt-4">
                <div class="selectbox">
                    
                <form action="{{url('/admin/case/dashboard/search')}}" method="GET">
               
               <div class="" id="app">
                                        <div class="row">
                                       @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
                                            <div class="col-sm-1">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                    <select name="districtID" id="districtID" class="droparrow form-select form-control stylish @error('districtID') is-invalid @enderror"  v-model="district_id" @change="getCircles()" >
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
                                                    <label for="circleID" class="form-label"></label>
                                                    <select name="circleID" id="circleID"  v-model="circle_id" class="droparrow form-select form-control stylish @error('circleID') is-invalid @enderror" @change="getUpozillasAndThana()">
                                                        <option value="">সার্কেল</option>
                                                        <option v-for="(circle,key,index) in circles" v-bind:value="circle.id"> @php echo '{{ circle.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-1">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label"></label>
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="droparrow form-select form-control stylish @error('thanaID') is-invalid @enderror">
                                                        <option value="">থানা</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>
                                            @elseif(auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="circleID" class="form-label"></label>
                                                    <select name="circleID" id="circleID"  v-model="circle_id" class="droparrow form-select form-control stylish @error('circleID') is-invalid @enderror" @change="getUpozillasAndThana()">
                                                        <option value="">সার্কেল</option>
                                                        @if($circledbs)

                                                        @foreach($circledbs as $circledb)
                                                        <option value="{{$circledb->id}}">{{$circledb->name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-1">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label"></label>
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="droparrow form-select form-control stylish @error('thanaID') is-invalid @enderror" >
                                                        <option value="">থানা</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>
                                            @else
                                            <div class="col-sm-1">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label"></label>
                                                    <select name="thanaID" id="thanaID" class="droparrow form-select form-control stylish @error('thanaID') is-invalid @enderror">
                                                        
                                                        <option value="{{$thanades->id}}" selected>{{$thanades->bn_name}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="col-sm-1">
                                                <div class="mb-3">
                                                    <label for="caseTypeID" class="form-label "></label>
                                                    <select name="caseTypeID" id="caseTypeID" class="droparrow form-select form-control stylish @error('caseTypeID') is-invalid @enderror"  v-model="casetype_id" @change="getCasesubtypes()" >
                                                        <option value="">ধরন</option>
                                                        @if($caseparenttypes)

                                                        @foreach($caseparenttypes as $ctype)
                                                        <option value="{{$ctype->id}}">{{$ctype->type}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="casesubID" class="form-label"></label>
                                                    <select name="casesubID" id="casesubID"  v-model="casesub_id" class="droparrow form-select stylish form-control @error('casesubID') is-invalid @enderror" @change="">
                                                        <option value="">উপধরন</option>
                                                        <option v-for="(casesubtype,key,index) in casesubtypes" v-bind:value="casesubtype.id"> @php echo '{{ casesubtype.type }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-3 " > 
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <div class="input-group" id="timepicker-input-group2">
                     <input type="text" name="form"  value="{{old('form')}}" id="date_time_response" class="form-control searchdatepick  @error('form') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="Case তারিখ শুরু" >
                     <input type="text" name="to"  value="{{old('to')}}" id="date_time_response" class="form-control searchdatepick  @error('to') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="Case তারিখ পর্যন্ত" >
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
                    
                    
                    
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center">
                                
                                <!------- <i class="i-Add-User"></i>   --------->
                            <a href="{{url('/admin/qrrs/srcs/data')}}">   
								<div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">মোট   মামলা </p>
                                    <p class="text-primary text-24 line-height-1 mb-2"> {{$totalcase}}</p>
                                </div>
								</a>
                            </div>
                        </div>
                    </div>
                    
                          
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><!------- <i class="i-Checked-User"></i>   --------->
                                <div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">এজহার ভুক্ত আসামি</p>
                                    <p class="text-primary text-24 line-height-1 mb-2"> {{$azaharnamioasami}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
					
					
					
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><!------- <i class="i-Financial"></i>   --------->
                                <div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">মোট মামলা নিস্পত্তি</p>
                                    <p class="text-primary text-24 line-height-1 mb-2"> {{$totalendingcase}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @can('case.review.info')

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><!------- <i class="i-Add-User"></i>   --------->
                                <a href="{{url('/admin/case/review')}}">   
								<div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0"> ওসি পেন্ডিং </p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{$reviewpending}}</p>
                                </div>
								</a>
                            </div>
                        </div>
                    </div>

                    @endcan
					

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><!------- <i class="i-Start"></i>   --------->
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

function convert($seconds){
$string = "";

$days = intval(intval($seconds) / (3600*24));

if($days> 0){
    $string .= "$days days ";
}

return $string;
}


@endphp

			
			
              
                    
              
					
					      <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><!------- <i class="i-Sand-watch-2"></i>   --------->
                          
								<div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">গড় নিঃ সময়কাল </p>
                                    <p class="text-primary text-24 line-height-1 mb-2"> {{convert($avgendingcasetime)}}</p>
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

                    <div class="col-lg-4 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title" >মামলার ধরন </div>
                                <div id="chart4_div" style="margin-top: -39px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title" > মামলার উপধরন </div>
                                <div id="chart5_div" style="margin-top: -39px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                    
					 <div class="col-lg-8 col-sm-12">
                        <div class="card mb-4" style="height: 354px;">
                            <div class="card-body">
                                <div class="card-title">শেষ ৩ মাসের রিপোর্ট</div>
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
                        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
                if($request->input('divisionID')) {
                    $division_id = $request->input('divisionID'); 
                }
                if($request->input('circleID')) {
                    $circle_id = $request->input('circleID');
                }
                if($request->input('districtID')) {
                    $district_id = $this->input('districtID');
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






@if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
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

                if(this.casetype_id!=""){
                    this.getCasesubtypes();
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

