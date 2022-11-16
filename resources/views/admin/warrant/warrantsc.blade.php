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
   


   
   .stylish-color:hover {
   background: #ff0000e3;
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
   background:#930cc4; 
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
               <h1> Warrant Dashboard </h1>
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
   
                                                <form target="_blank" action="{{url('/admin/warrant/search')}}" method="get">
                                                    
                                                    <div class="" id="app">
                                        <div class="row">
										
                                                        @if  (auth()->user()->hasRole('Super Admin'))
												<div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                          <select name="districtID" id="districtID" class="droparrow form-select stylish"  v-model="district_id">
                                                        <option value="">জেলা</option>
                                                        @if($districts)

                                                        @foreach($districts as $district)
                                                        <option value="{{$district->id}}">{{$district->bn_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
												</div>
                                                @endif

                                                @if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
												 <div class="col-sm-4">
                                                 <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                    <select name="thanaID" id="thanaID" class="droparrow form-select stylish" >
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
												<div class="col-sm-4">
                                                 <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                    <select name="thanaID" id="thanaID" class="droparrow form-select stylish" >
                                                        <option value="">থানা</option>
                                                        @if($octhanacol)

                                                        <option value="{{$octhanacol->id}}" selected>{{$octhanacol->bn_name}}</option>
                                                        
                                                        @endif
                                                    </select>
                                                </div>
                                    </div>
                                                @endif
												
												
												<div class="col-sm-4 " > 
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <div class="input-group" id="timepicker-input-group2">
                    
                    <input type="text" name="form"  value="{{old('form')}}" id="date_time_response" class="form-control datepicker  @error('form') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="date start" >
                                                        <input type="text" name="to"  value="{{old('to')}}" id="date_time_response" class="form-control datepicker  @error('to') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="date end" >
                  </div>
               </div>
            </div>
            
            <div class="col-sm-4 " >
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
   @can('warrant.add')
   <a href="add" class="float2 silverhover">
    
<i class="dripicons-plus  plus my-float"></i>
</a>
@endcan
@can('warrant.view')
<a href="../warrant" class="float silverhover" style="padding: 7px;">
<i style="font-size: 20px;" class="dripicons-view-list my-float"></i>
</a>
@endcan




<div class="row">
   
   
   <div class="col-sm-3 " style="padding: 0px 10px 0px 0px; width: 30%;">
      <div class="card">
         <h5 class="chart-header-main"> @if (auth()->user()->hasRole('Super Admin'))
                                                    জেলা
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                     থানা 
                                                    @endif রিসিভ সংখ্যা </h5>
         <div id="chart_div"></div>
      </div>
   </div>
   
    
   <div class="col-sm-5 " style="padding: 0px 0px 0px 13px; width:36.667%!important;">
      <div class="row">
          
          
              <div class="col-sm-4" style="padding: 1px;">
            <div class="card purplebg">
               <h6>মোট রিসিভ</h6>
               <h2>{{ $trecive[0]['total_sum'] }} </h2>
            </div>
         </div>
         
         
    
         
         
         
         <div class="col-sm-4" style="padding: 1px;">
            <div class="card redbg">
               <h6>মোট নিষ্পত্তি</h6>
               <h2>{{ $tnis[0]['total_sum'] }} </h2>
            </div>
         </div>
         <div class="col-sm-4" style="padding: 1px;">
            <div class="card greenbg">
               <h6> মোট পেন্ডিং</h6>
               <h2> @if (($trecive[0]['total_sum'] - $tnis[0]['total_sum']) >= 0) {{$trecive[0]['total_sum'] - $tnis[0]['total_sum']}} @else {{0}} @endif</h2>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="card" style="height: 213px;">
            <h5 class="chart-header-main">@if (auth()->user()->hasRole('Super Admin'))
                                                    জেলা
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                     থানা 
                                                    @endif অনুযায়ী নিষ্পত্তি</h5>
            <div id="piechart"></div>
         </div>
      </div>
   </div>
   <!------2nd----->
   <div class="col-sm-4 " style="padding: 0px 0px 0px 0px;">
      <div class="card" >
         <h5 class="chart-header-main">@if (auth()->user()->hasRole('Super Admin'))
                                                    জেলা
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                     থানা 
                                                    @endif অনুযায়ী পেন্ডিং </h5>
         <div id="chart_div3"></div>
      </div>
   </div>
   <!------2nd----->
</div>
<!-- end row -->


<div class="row">
   <div class="card table-responsive">

                                            <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    @if (auth()->user()->hasRole('Super Admin'))
                                                    <th > জেলা </th>
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                    <th > থানা </th>
                                                    @endif
                                                    <th > মোট রিসিভ  </th>
                                                    <th > মোট নিষ্পত্তি</th>
                                                    <th > মোট জিআর তামিল </th>
                                                    <th > মোট সিআর তামিল </th>
                                                    <th > মোট সাজা জিআর তামিল </th>
                                                    <th > মোট সাজা সিআর তামিল </th>
                                                    <th > মোট রিকল ও অন্যান্য </th>
                                                </tr>
                                            </thead>
                                            <tbody>
@php
use App\Models\District;
use App\Models\Thana;

function disna($id) {
    $get = District::find($id);
    return $get->bn_name;
}

function thana($id) {
    $get = Thana::find($id);
    return $get->bn_name;
}
@endphp
                                            @if($wars)
                                            @foreach ($wars as $war)
                                                <tr>
                                                    @if (auth()->user()->hasRole('Super Admin'))
                                                    <td > @if(null !== disna($war->districtID)) {{disna($war->districtID)}} @endif</td>
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) 
                                                    <td > @if(null !== thana($war->thanaID)) {{thana($war->thanaID)}} @endif</td>
                                                    @endif
                                                    <td > {{$war->total_recive}}</td>
                                                    <td > {{$war->total_nispotti}}</td>
                                                    <td > {{$war->total_gr_tamil}}</td>
                                                    <td > {{$war->total_cr_tamil}}</td>
                                                    <td > {{$war->total_saja_gr_tamil}}</td>
                                                    <td > {{$war->total_saja_cr_tamil}}</td>
                                                    <td > {{$war->total_recall}}</td>
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
						
	<script src="{{ asset('my-assets/admin/js/vue.js') }}"></script>
    <script src="{{ asset('my-assets/admin/js/axios.min.js') }}"></script>

                     
<x-admin-footer/>

