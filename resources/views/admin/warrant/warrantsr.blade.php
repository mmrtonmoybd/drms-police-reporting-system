<x-admin-header />
	  
	  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>


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
   background: #f42b1c;
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


     <style>

.sidetitle {
    font-weight:bold;
    color:#ffbfa0;
}
</style>    
                        <!-- end page title -->
						
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
   
   
   <div class="col-sm-3 " style=" width: 30%;">
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
         
         
                                                     <h6>@if (auth()->user()->hasRole('Super Admin'))    
                                            {{$dis->bn_name}}
                                            @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            {{$tha->bn_name}}
                                            @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            {{$octhanacol->bn_name}}
                                            @endif মোট রিসিভ</h6>
         
                                   <h2> {{ $trecive[0]['total_sum'] }} </h2>
         
            </div>
         </div>
         
         
         
         
         <div class="col-sm-4" style="padding: 1px;">
            <div class="card redbg">
                       <h6>@if (auth()->user()->hasRole('Super Admin'))    
                                            {{$dis->bn_name}}
                                            @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            {{$tha->bn_name}}
                                            @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            {{$octhanacol->bn_name}}
                                            @endif মোট নিষ্পত্তি
                </h6>

               
               <h2>{{ $tnis[0]['total_sum'] }} </h2>
            </div>
         </div>
         
         
         
         <div class="col-sm-4" style="padding: 1px;">
            <div class="card greenbg">
               <h6> 
               
               
              @if (auth()->user()->hasRole('Super Admin'))    
                                            {{$dis->bn_name}}
                                            @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            {{$tha->bn_name}}
                                            @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            {{$octhanacol->bn_name}}
                                            @endif মোট পেন্ডিং</h3>

                             
               
               </h6>
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

<div class="row">
   <div class="card table-responsive">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        

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

                                            @if($wars)
                                            @foreach ($wars as $war)
                                                <tr>

                                                    <td >@if (auth()->user()->hasRole('Super Admin'))    
                                            {{$dis->bn_name}}
                                            @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            {{$tha->bn_name}}
                                            @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            {{$octhanacol->bn_name}}
                                            @endif</td>
                                                    
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

                                        <br>
                                        <br>
                                        <br>

                                        <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th > রেফারেন্স নং </th>
                                                    <th > জেলা </th>
                                                    <th > থানা </th>
                                                    <th > তারিখ </th>
                                                    <th > জিআর রিসিভ	 </th>
                                                    <th > সিআর রিসিভ </th>
                                                    <th > সাজা জিআর রিসিভ </th>
                                                    <th > সাজা সিআর রিসিভ </th>
                                                    <th > মোট রিসিভ  </th>
                                                    <th > জিআর তামিল</th>
                                                    <th > সিআর তামিল </th>
                                                    <th > সাজা জিআর তামিল </th>
                                                    <th > সাজা সিআর তামিল </th>
                                                    <th > রিকল ও অন্যান্য </th>
                                                    <th > মোট তামিল </th>
                                                    <th > মোট নিষ্পত্তি </th>
                                                    <th > দিনশেষে পেন্ডিং </th>
                                                    <th style="width: 86px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
@php
use App\Models\District;
use App\Models\Thana;
use App\Models\Warrant;

function dayend($id, $dis) {
    $get = Warrant::selectRaw("((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS day_endp")
    ->where('districtID', $dis)
    ->where('id', '<=', $id)->first();
    return intval($get->day_endp);
}

function disna($id) {
    $get = District::find($id);
    return $get->bn_name;
}

function thana($id) {
    $get = Thana::find($id);
    return $get->name;
}


@endphp

                                            @if($wars2)
                                            @foreach ($wars2 as $war)
                                                <tr>
                                                    <td > {{$war->id}}</td>
                                                    <td > @if(null !== disna($war->districtID)) {{disna($war->districtID)}} @endif </td>
                                                    <td > @if(null !== thana($war->thanaID)) {{thana($war->thanaID)}} @endif </td>
                                                    <td > {{date('d-M-Y', strtotime($war->date))}}</td>
                                                    <td > {{$war->gr_recive}}</td>
                                                    <td > {{$war->cr_recive}}</td>
                                                    <td > {{$war->saja_gr_recive}}</td>
                                                    <td > {{$war->saja_cr_recive}}</td>
                                                    <td > {{$war->gr_recive + $war->cr_recive + $war->saja_gr_recive + $war->saja_cr_recive}}</td>
                                                    <td > {{$war->gr_tamil}}</td>
                                                    <td > {{$war->cr_tamil}}</td>
                                                    <td > {{$war->saja_gr_tamil}}</td>
                                                    <td > {{$war->saja_cr_tamil}}</td>
                                                    <td > {{$war->recall_other}}</td>
                                                    <td > {{$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil}}</td>
                                                    <td > {{$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil + $war->recall_other}}</td>
                                                    <td > @if (dayend($war->id, $war->districtID) >= 0) {{dayend($war->id, $war->districtID)}} @else {{0}} @endif</td>
                                                       
                                                    <td class="table-action">
                                                        
                                                        <a href="{{url('admin/warrant/view/'.$war->id)}}"  class="action-icon text-primary">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>

                                                        <a href="{{url('admin/warrant/edit/'.$war->id)}}" class="action-icon text-success">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="{{url('admin/warrant/delete/'.$war->id)}}"  onclick="return confirm('Do you want to delete this slider?')" class="action-icon text-danger"> <i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>

                                        <nav class="mt-3">

                                        <!-- pagination here -->
                                         @if($wars2){{$wars2->appends(request()->input())->links()}} @endif
                                      
                                        </nav>


                                    </div>
                            </div>
                        </div>
                        <!-- end row -->
						
						<script src="{{ asset('my-assets/admin/js/vue.js') }}"></script>
    <script src="{{ asset('my-assets/admin/js/axios.min.js') }}"></script>

	  
	  
	  
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

