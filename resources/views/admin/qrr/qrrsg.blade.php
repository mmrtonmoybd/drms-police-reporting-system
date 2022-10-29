	  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>




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
   background: #26a59a;
   color: #fff;
   border-radius: 20px;
   display: block;
   width: 100%;
   padding: 5px 7px 5px 5px;
   font-size: .9rem;
   font-weight: 400;
   line-height: 1.5;
   text-align: center;
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

.float3 {
  position: fixed;
  width: 65px;
  height: 130px;
  bottom: 50%;
  right: 0px;
  background-color: #9d1b95;
  color: #FFF;
  border-radius: 7px 0px 0px 7px;
  text-align: center;
  box-shadow: 2px 2px 3px #999;
  z-index: 1000;
  text-decoration: none;
  transition: transform .2s;
}

.float:hover{
transform: scale(1.1);
}


.float2:hover{
transform: scale(1.1);
}



.my-float3{
	margin-top:0;
	font-size:14px;
	padding:10px;
	text-decoration:none;
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
               <h1> Quick Response </h1>
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



   
<div class="row">
   <div class="card">
                <form action="{{url('admin/qrrs/charts')}}" method="POST">
               @csrf
               <div class="" id="app">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                    <select name="districtID" id="districtID" class="form-select stylish"  v-model="district_id" @change="getUpozillasAndThana()"  required>
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
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select stylish" required>
                                                        <option value="">থানা</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>
            <div class="col-sm-2 ">
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <select name="source_of_info" id="source_of_info" class="form-select stylish">
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
            @csrf
            <div class="col-sm-2 " >
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <button type="submit" name="submit" class="btn stylish"> সার্চ করুন </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>




<style>

.sidetitle {
    font-weight:bold;
    color:#ffbfa0;
}
</style>
<dib class="float3">
    
<span class="sidetitle">জেলা </span> <br>
 
 <span class="sidetext">বরিশাল </span>
 
 <span class="sidetitle">উপজেলা </span>
 
  <span class="sidetext">উজিরপুর </span>

 <span class="sidetitle">উৎস </span>
 <br>
  <span class="sidetext">৯৯৯ </span>





</dib>







<a href="add" class="float2 silverhover">
    
<i class="dripicons-plus  plus my-float"></i>
</a>


<a href="../qrrs" class="float silverhover" style="padding: 7px;">
<i style="font-size: 20px;" class="dripicons-view-list my-float"></i>
</a>




<div class="row">
   
   
   <div class="col-sm-3 " style="padding: 0px 10px 0px 0px; width: 30%;">
      <div class="card">
         <h5 class="chart-header-main">Number of Incident </h5>
         <div id="chart_div"></div>
      </div>
   </div>
   
     <!---
   <div class="col-sm-2 ">
      <div class="row">
         <div class="card" style="height: 157px;">
            <h3 class="chart-header xtrm">Total Incident</h3>
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
               <h6> Total Incident</h6>
               <h2>{{$tin}}</h2>
            </div>
         </div>
         
         
         
         <div class="col-sm-4" style="padding: 1px;">
            <div class="card redbg">
               <h6> Average Response Time</h6>
               <h2>0:32:59</h2>
            </div>
         </div>
         <div class="col-sm-4" style="padding: 1px;">
            <div class="card greenbg">
               <h6> Average Reporting Delay</h6>
               <h2>5:42:50</h2>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="card" style="height: 213px;">
            <h5 class="chart-header-main">Source of information</h5>
            <div id="piechart"></div>
         </div>
      </div>
   </div>
   <!------2nd----->
   <div class="col-sm-4 " style="padding: 0px 0px 0px 0px;">
      <div class="card" >
         <h5 class="chart-header-main"> Type of incident </h5>
         <div id="chart_div2"></div>
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
                   <h3 style="color:green;">Total Incident</h3>
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
               <h3> Average Response Time</h3>
              <h2>0:32:59</h2>
            </div>
            </div>
            
            
            <div class="col-sm-6">
            <div class="card greenbg">
              <h3> Average Reporting Delay</h3>
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
<div class="row">
   <div class="card table-responsive">
      <!----
         <div id="chart_div"></div>
         <div id="piechart"></div>
         <div id="chart_div2"></div>
         --->
      <div class="btn-group" role="group" aria-label="...">
         <a href="{{url('admin/qrrs/report/মারামারি')}}" class="btn btn-danger">মারামারি</a>
         <a href="{{url('admin/qrrs/report/খুন')}}" class="btn btn-danger">খুন</a>
         <a href="{{url('admin/qrrs/report/চুরি')}}" class="btn btn-danger">চুরি</a>
         <a href="{{url('admin/qrrs/report/ডাকাতি')}}" class="btn btn-danger">ডাকাতি</a>
         <a href="{{url('admin/qrrs/report/সম্পত্তি সংক্রান্ত')}}" class="btn btn-danger">সম্পত্তি সংক্রান্ত</a>
         <a href="{{url('admin/qrrs/report/সড়ক দুর্ঘটনা')}}" class="btn btn-danger">সড়ক দুর্ঘটনা</a>
         <a href="{{url('admin/qrrs/report/নারী ও শিশু')}}" class="btn btn-danger">নারী ও শিশু</a>
         <a href="{{url('admin/qrrs/report/অগ্নিকান্ড')}}" class="btn btn-danger">অগ্নিকান্ড</a>
         <a href="{{url('admin/qrrs/report/মাদক')}}" class="btn btn-danger">মাদক</a>
         <a href="{{url('admin/qrrs/report/সাইবার')}}" class="btn btn-danger">সাইবার</a>
         <a href="{{url('admin/qrrs/report/প্রতারণা')}}" class="btn btn-danger">প্রতারণা</a>
         <a href="{{url('admin/qrrs/report/রাজনৈতিক')}}" class="btn btn-danger">রাজনৈতিক</a>
         <a href="{{url('admin/qrrs/report/অন্যান্য')}}" class="btn btn-danger">অন্যান্য</a>
      </div>
      
      <!-----
      <h3>Total incident: {{$tin}}</h3>
      <h3>Total case taken: {{$tcat}}</h3>
      <nav class="mt-3">
      </nav>
      ---->
      
      
      
      
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
                                                    <th > মূল ঘটনা</th>
                                                    <th > ঘটনার ধরণ </th>
                                                    <th > ঘটনার সূত্রপাত </th>
                                                    <th>  ঘটনার সংক্ষিপ্ত বিবরন</th>
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

                                            @if($qrrs)
                                            @foreach ($qrrs as $qrr)
                                                <tr>
                                                    <td class="table-action">
                                                        
                                                        <a href="{{url('admin/qrrs/details/'.$qrr->id)}}"  class="action-icon text-primary">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>

                                                        <a href="{{url('admin/qrrs/edit/'.$qrr->id)}}" class="action-icon text-success">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="{{url('admin/qrrs/delete/'.$qrr->id)}}"  onclick="return confirm('Do you want to delete this slider?')" class="action-icon text-danger"> <i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                    <td > {{$qrr->id}}</td>
                                                    <td > @if(isset($qrr->district->name)) {{$qrr->district->bn_name}} @endif</td>
                                                    <td > @if(isset($qrr->thana->name)) {{$qrr->thana->name}} @endif</td>
                                                    <td > {{$qrr->village_word}}</td>
                                                    <td > {{$qrr->source_of_info}}</td>
                                                    <td > @if($qrr->date_time_of_incident) {{date('d/m/Y h:i A', strtotime($qrr->date_time_of_incident))}} @endif</td>
                                                    <td > @if($qrr->date_time_of_police_news) {{date('d/m/Y h:i A', strtotime($qrr->date_time_of_police_news))}} @endif</td>
                                                    <td > @if($qrr->date_time_response) {{date('d/m/Y h:i A', strtotime($qrr->date_time_response))}} @endif</td>
                                                    <td >
                                                        
                                                    @php

                                                    $minutes = $qrr->delay_in_response;
                                                    $hours = intdiv($minutes, 60).':'. ($minutes % 60);
                                                    $minutes = $qrr->delay_in_response;
                                                    $hours = floor($minutes / 60).':'.($minutes - floor($minutes / 60) * 60).':00';

                                                    @endphp
                                                    
                                                    {{$hours}} 
                                                
                                                
                                                    </td>
                                                    <td > {{ Str::limit($qrr->main_event, 20)}}</td>
                                                    <td > {{$qrr->event_type}}</td>
                                                    <td > {{$qrr->begening_of_event}}</td>
                                                    <td > {{Str::limit($qrr->short_dettails, 5)}}</td>
                                                    <td > {{$qrr->gd_no}}</td>
                                                    <td > @if($qrr->gd_date) {{date('d/m/Y', strtotime($qrr->gd_date))}} @endif</td>
                                                    <td > {{$qrr->case_no}}</td>
                                                    <td > @if($qrr->case_date) {{date('d/m/Y', strtotime($qrr->case_date))}} @endif</td>
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
      
      
      
      
      
   </div>
</div>
</div>
<!-- end row -->

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
    
    
    
	  
	  
	  
<script type="text/javascript" language="javascript" >
 $(document).ready(function(){

  $('#customer_data').DataTable({
   "processing" : true,
   "serverSide" : true,
   "ajax" : {
    url:"fetching/alldata.php",
    type:"POST"
   },
   dom: 'lBfrtip',
   buttons: [
    'excel', 'csv', 'pdf', 'copy'
   ],
   "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
  });
  
 });
 
</script>
	  
<x-admin-footer/>
