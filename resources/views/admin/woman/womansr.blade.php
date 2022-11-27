<x-admin-header />
<!-- start page title -

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/warrant')}}">Warrants</a></li>
                                            <li class="breadcrumb-item active">All Warrants</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="dripicons-scale"></i> Warrants</h4>
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
   background-color: #f42b1c;
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
   


   
   .stylish:hover {
   background-color: #ff0000e3;
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
   background:#ff3054; 
   color:white;
   height:120px;
   }
   .datepicker {
   border: 1px solid #ff0000e3;
   color:#ff0000e3;
   border-radius:20px;
   }
   input#date_time_response {
   height: 33px;
   border: 1px solid #ff0000e3;
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
   font-size:20px!important;
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


#chart_div2 {
position: relative;
margin-top: -39px;
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
               <h1> Women & Child Dashboard </h1>
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

   


   
          @can('woman.add')
   <a href="add" class="float2 silverhover">
    
<i class="dripicons-plus  plus my-float"></i>
</a>
@endcan
@can('woman.view')
<a href="../woman" class="float silverhover" style="padding: 7px;">
<i style="font-size: 20px;" class="dripicons-view-list my-float"></i>
</a>
@endcan











<div class="row">
   
   
   <div class="col-sm-3 " style="padding: 0px 10px 0px 0px; width: 30%;">
      <div class="card">
         <h5 class="chart-header-main">অভিযোগ সংখ্যা</h5>
         <div id="chart_div"></div>
      </div>
   </div>
   
    
   <div class="col-sm-5 " style="padding: 0px 0px 0px 13px; width:36.667%!important;">
      <div class="row">
          
         
              <div class="col-sm-12" style="padding: 1px;">
            <div class="card purplebg">
               <h3>মোট  অভিযোগ</h3>
               <h2> {{$totalcomplain}} </h2>
            </div>
         </div>
         

         
      
   
      </div>
      <div class="row">
         <div class="card" style="height: 213px;">
            <h5 class="chart-header-main">-----</h5>
            <div id="piechart"></div>
         </div>
      </div>
   </div>
   <!------2nd----->
   <div class="col-sm-4 " style="padding: 0px 0px 0px 0px;">
      <div class="card" >
         <h5 class="chart-header-main"> Disposal Report </h5>
         <div id="columnchart_values"></div>
      </div>
   </div>
   <!------2nd----->
</div>
<!-- end row -->



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






<x-admin-footer/>
