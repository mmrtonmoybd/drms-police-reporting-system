
<x-admin-header />
<!-- start page title -
   <div class="row">
      <div class="col-12">
         <div class="page-title-box">
            <div class="page-title-right">
               <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{url('admin/qrrs')}}">Qrrs</a></li>
                  <li class="breadcrumb-item active">All Qrrs</li>
               </ol>
            </div>
            <h4 class="page-title"><i class="dripicons-scale"></i> Qrrs</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->
<x-admin-validation-errors :errors="$errors->all()"/>
<!------------secondery hedaer----------->


<style>
   .row {
   width:100%;
   overflow:none;
   }
   text {
   font-family: Nunito, 'SolaimanLipi', sans-serif;
   font-size: 11px;
   }
   
   
 
   
   .stylish {
   background-color: #26a59a;
   color: #fff;
   border-radius: 20px;
   display: block;
   width: 100%;
   padding: 5px 7px 5px 5px;
   font-size: .9rem;
   font-weight: 400;
   line-height: 1.5;
   text-align: center;
   cursor:pointer;
   
   }
   .stylish option {
   text-align: center;
   }
   

   
   
   

   
   
   
   
   
   
   
   
   .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, {
   padding: 7px!important;
   }
   .sheader {
   background:#26a59a; 
   color:white;
   height:120px;
   }
   .datepicker {
   border: 1px solid #26a59a;
   color:#26a59a;
   border-radius:20px;
   }
   input#date_time_response {
   height: 33px;
   }
   .redbg {
   background:red; 
   color:white;
   height:120px;
   text-align:center;
     margin-bottom: 5px!important;
   }
   
   
      .purplebg {
   background:purple; 
   color:white;
   height:120px;
   text-align:center;
   margin-bottom: 5px!important;
   }
   
   
   .greenbg {
   background:green; 
   color:white;
   height:120px;
   text-align:center;
   margin-bottom: 5px!important;
   }
   .centerimg {
   text-align:center;
   width:100%;
   }
   .sheader h1 {
   color:white;
   }
   .inliner {
   display:inline-block;
   }
   .leftimg, .rightimg, .centerimg {
   display:inline-block;
   }
   .leftimg {
   float: left;
   position: absolute;
   }
   .rightimg {
   float: right;
   position: absolute;
   right: 17px;
   }

   
   .chart-header-main {
  color: #a05078;

  font-size: 17px;
  position: relative;
  top: 25px;
  z-index: 10;
  left: 20px;
    }
       .chart-header {
   color:#a05078;
   margin: 21px 0px 0px 10px;
   font-size: 17px;
   }
   .card {
   border-radius: 0px;
   border: 1px solid #ddd;
   }
   .xtrm {
   margin-top:25px;
   }
   .button-menu-mobile { color:#fff!important;  }
   
   
   
.float{
	position:fixed;
	width:50px;
	height:50px;
	bottom:40px;
	right:40px;
	background-color:#04c;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;
	z-index:1000;
	transition: transform .2s;
}


.float2{
	position:fixed;
	width:50px;
	height:50px;
	bottom:100px;
	right:40px;
	background-color:#f44336;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;
	z-index:1000;
	text-decoration:none;
		transition: transform .2s;
}

.float:hover{
transform: scale(1.1);
}


.float2:hover{
transform: scale(1.1);
}






.my-float{
	margin-top:22px;
	font-size:30px;
	text-decoration:none;
}

.my-float:hover {
  color: #ddd;
}
   
   .silverhover:hover {
  color: #ddd;
}

   
</style>
<div class="row ">
   <div class="col-sm-12 " style="padding: 5px 0px 0px 0px;">
      <div class="card sheader">
         <div class="card-body inliner">
            <div class="leftimg">
               <img src="https://www.pinclipart.com/picdir/middle/400-4008891_final-police-logo-blue-police-week-2019-bangladesh.png" width="80px'">
            </div>
            <div class="centerimg">
               <h1> Quick Response & Report </h1>
               <h3> Barisal Range, Barisal </h3>
               <br>
            </div>
            <div class="rightimg">
               <img src="https://www.pinclipart.com/picdir/middle/400-4008891_final-police-logo-blue-police-week-2019-bangladesh.png" width="80px'">
            </div>
         </div>
      </div>
   </div>
</div>
<!--------------
   <div id="chart_div"></div>
                                              <div id="piechart"></div>
                                              <div id="chart_div2"></div>
   ----------->
   
   
   
   
   
   
<div class="row">
   <div class="card">
                <form target="_blank" action="{{url('admin/qrrs/charts')}}" method="get">
               
               <div class="" id="app">
                                        <div class="row">
                                          @if (auth()->user()->hasRole('Super Admin'))
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                    <select name="districtID" id="districtID" class="droparrow form-select stylish"  v-model="district_id" @change="getUpozillasAndThana()"  >
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
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="droparrow form-select stylish" >
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
                                                    <select name="thanaID" id="thanaID" class="form-select stylish" >
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
                                                    <select name="thanaID" id="thanaID" class="droparrow form-select stylish">
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
                  <label for="source_of_info" class="form-label"></label>
                  <select name="source_of_info" id="source_of_info" class="droparrow form-select stylish">
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
                  <button type="submit" name="submit" class="btn stylish"> সার্চ করুন </button>
               </div>
            </div>
         </div>
      </div>
      <!----
         <div id="chart_div"></div>
         <div id="piechart"></div>
         <div id="chart_div2"></div>
         --->


   </div>
</div>



@can('qrr.add')
<a href="add" class="float2 silverhover">
    
<i class="dripicons-plus  plus my-float"></i>
</a>
@endcan

@can('qrr.view')

<a href="../qrrs" class="float silverhover" style="padding: 7px;">
<i style="font-size: 20px;" class="dripicons-view-list my-float"></i>
</a>
@endcan




<div class="row">
   
   
   <div class="col-sm-3 " style="padding: 0px 10px 0px 0px; width: 30%;">
      <div class="card">
         <h5 class="chart-header-main">জেলা ভিত্তিক রিপোর্ট  </h5>
         <div id="chart_div"></div>
      </div>
   </div>
   
     <!---
   <div class="col-sm-2 ">
      <div class="row">
         <div class="card" style="height: 157px;">
            <h3 class="chart-header xtrm"> মোট রিপোর্ট </h3>
            <h1 style="color:red;">{{$tin}}</h1>
         </div>
      </div>
      <div class="row">
         <div class="card" style="height: 158px;">
            <br>
            <h3 class="chart-header xtrm">Case Taken</h3>
            <h1 style="color:green;">{{$tcat}}</h1>
         </div>
      </div>
   </div>
 ---2nd----->
   <div class="col-sm-5 " style="padding: 0px 0px 0px 13px; width:36.667%!important;">
      <div class="row">
          
          
          
            <div class="col-sm-4" style="padding: 1px;">
            <div class="card purplebg">
               <h6>   মোট রিপোর্ট   </h6>
               <h2><a href="{{url('/admin/qrrs/srcs/data')}}">{{$tin}}</a></h2>
            </div>
         </div>
         
         
         
         <div class="col-sm-4" style="padding: 1px;">
            <div class="card redbg">
               <h6> গড় সাড়াদানের সময় </h6>
               <h2>{{$avgrest[0]}}</h2>
            </div>
         </div>
         @if (auth()->user()->hasAnyRole(['Super Admin', 'SP']))
         <div class="col-sm-4" style="padding: 1px;">
            <div class="card greenbg">
               <h6> গড় রিপোর্টে বিলম্ব</h6>
               <h2>{{$avgreport[0]}}</h2>
            </div>
         </div>
         @endif
      </div>
      <div class="row">
         <div class="card" style="height: 213px;">
            <h5 class="chart-header-main"> তথ্য প্রাপ্তির উৎস </h5>
            <div id="piechart"></div>
         </div>
      </div>
   </div>
   <!------2nd----->
   <div class="col-sm-4 " style="padding: 0px 0px 0px 0px;">
      <div class="card" >
         <h5 class="chart-header-main"> ঘটনার ধরন </h5>
         <div id="chart_div2" style="margin-top: -39px;"></div>
      </div>
   </div>
   <!------2nd----->
</div>
<!-- end row -->



<!------------
   <div class="row">
      <div class="col-sm-3 ">
         <div class="row">
                <div class="card">
                   <h3 style="color:green;"> মোট রিপোর্ট </h3>
                   <h1>{{$tin}}</h1>
                </div>
         </div>
         
           <div class="row">
                <div class="card">
                    <h3 style="color:red;">Case Taken</h3>
                     <h1>{{$tcat}}</h1>
                </div>
         </div>
         
         
      </div>
      <div class="col-sm-9 ">
          
          
         <div class="row">
             <div class="col-sm-6">
            <div class="card redbg">
               <h3> গড় সাড়াদানের সময় </h3>
              <h2>0:32:59</h2>
            </div>
            </div>
            
            
            <div class="col-sm-6">
            <div class="card greenbg">
              <h3> গড় রিপোর্টে বিলম্ব  </h3>
              <h2>5:42:50</h2>
            </div>
            </div>
            
         </div>
         
         <div class="row">
            <div class="card">
               <div id="piechart"></div>
            </div>
         </div>
      </div>
     
   </div>
   <!-- end row -->

</div>
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
