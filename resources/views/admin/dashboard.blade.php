<x-admin-header/>
<!-- start page title -->
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"><i class="uil-home-alt"></i> &nbsp;</h4>
      </div>
   </div>
</div>
<!-- end page title --> 
<x-admin-validation-errors :errors="$errors->all()"/>







<form  action="{{url('admin/dashboard/search')}}" method="get">
               
               <div id="app">
                             <div class="row">
                                          @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                    
                                                    
                                                    
                                                    <select name="districtID" id="districtID" class="form-select form-control stylish "  v-model="district_id" @change="getUpozillasAndThana()">
                                                        <option value="">জেলা</option>

                                                        @php 
                                                        if (request()->input('districtID') !== 'খালি') {
                                                         $did = request()->input('districtID');
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
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select form-control stylish" >
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
                                                    <select name="thanaID" id="thanaID" class="form-select form-control stylish" >
                                                      
                                                        <option value="">থানা</option>
                                                        @if($spthanas)

                                                        @foreach($spthanas as $thnsp)
                                                        <option value="{{$thnsp->id}}"  {{ ($thnsp->id == request()->input('thanaID')) ? 'selected' : '' }}>{{$thnsp->bn_name}}</option>
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


               <div class="col-sm-4 " > 
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <div class="input-group" id="timepicker-input-group2">
                     <input type="text" name="form"  value="{{request()->input('form')}}" id="date_time_response" class="form-control searchdatepick  @error('form') is-invalid @enderror"  autocomplete="off" data-date-format="yyyy/mm/dd"  placeholder=" তারিখ শুরু" >
                     <input type="text" name="to"  value="{{request()->input('to')}}" id="date_time_response" class="form-control searchdatepick  @error('to') is-invalid @enderror"  autocomplete="off" data-date-format="yyyy/mm/dd"  placeholder="তারিখ পর্যন্ত" >
                  </div>
               </div>
            </div>
            
            <div class="col-sm-2 " >
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                 <button type="submit" name="submit" class="btn btn-primary" style="width: 100%;"> সার্চ করুন </button>
               </div>
            </div>

                                                      </form>


	</div>
	
	
		
</div>

		    <div class="row">

 <div class="col-sm-6">

   <div class="card" >
      <div class="card-body  ">
        
        <center> 
         <h3 id=""> বরিশাল রেঞ্জ (ডিআরএমএস) সফটওয়্যারে আপনাকে স্বাগতম </h3>
         @php
         use Illuminate\Support\Carbon;
         $now = Carbon::now()->format('l, d M Y');
         @endphp
     <span id="MyDateDisplay"> Today is : {{$now}} </span>
     
         <br>
         <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
         <script>
            function showTime(){
            var date = new Date();
            var h = date.getHours(); // 0 - 23
            var m = date.getMinutes(); // 0 - 59
            var s = date.getSeconds(); // 0 - 59
            var session = "AM";
            
            if(h == 0){
              h = 12;
            }
            
            if(h > 12){
              h = h - 12;
              session = "PM";
            }
            
            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;
            
            var time = h + ": " + m + ": " + s + " " + session;
            document.getElementById("MyClockDisplay").innerText = time;
            document.getElementById("MyClockDisplay").textContent = time;
            
            setTimeout(showTime, 1000);
            
            }
            
            showTime();
            
            
         </script>
         
         
         <img src="{{url('logo-drms.jpg')}}" style="width:230px;margin-top: 20px;">
         <marquee><h3 style="color: blue;">(ডিআরএমএস) সফটওয়্যার সংক্রান্ত কোন সমস্যা পরিলক্ষিত হলে সমস্যার বিস্তারিত বিবরণ স্ক্রীনশটসহ ই-মেইল করুন  <a href="mailto:ictbslrange@gmail.com;">ictbslrange@gmail.com<h3></marquee>
         
         <center>
         
         <center>
      </div>
      <!-- end card-body -->
   </div>
   <!-- end card -->
<br>
	</div>
	




 <div class="col-sm-6">
<style>
.avatar {
  border: 0.3rem solid #100657EB;
  margin-top: -6rem;
  margin-bottom: 1rem;
  max-width: 9rem;
  min-width: 150px;
  height: 150px;

}

.grabg {
background: #092756;
 background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%),-moz-linear-gradient(top, rgba(57,173,219,.25) 0%, rgba(42,60,87,.4) 100%), -moz-linear-gradient(-45deg, #670d10 0%, #092756 100%);
 background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top, rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -webkit-linear-gradient(-45deg, #670d10 0%,#092756 100%);
 background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top, rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -o-linear-gradient(-45deg, #670d10 0%,#092756 100%);
 background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top, rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -ms-linear-gradient(-45deg, #670d10 0%,#092756 100%);
 background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom, rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), linear-gradient(135deg, #670d10 0%,#092756 100%);
 }


</style>
      <div class="card" style="height: calc(100% - 20px);">
        <div class="card-img-top grabg"   style="height: 122px;"> </div>
        <div class="card-body text-center">
          <img class="avatar rounded-circle" src="{{ asset(auth()->user()->picture) }}" alt="Bologna">
          <h4 class="card-title" style="color:blue; font-size:25px;">{{auth()->user()->name}}</h4>
          <style>
.card-body.text-center {
  font-size: 16px;
  color:#000;
}
          .card-subtitle  {
              font-size:16px;
                color:#000;
          }
          
          </style>
          <h6 class="card-subtitle mb-2">পদবি: {{auth()->user()->designation}}</h6>
          <h6 class="card-subtitle mb-2 ">Mobile: {{auth()->user()->mobile}}</h6>
        
		
		          ইমেইল: {{auth()->user()->email}}<br>
   
          বিপি নং: {{auth()->user()->bp_no}}<br>
         @if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
         @php 
         $thana = App\Models\Thana::where('district_id', auth()->user()->districtID)->get();
         @endphp
          জেলা: {{auth()->user()->district->bn_name}}<br>
          থানা: @foreach ($thana as $ff)
         {{$ff->name}},
         @endforeach
         @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
          জেলা: {{auth()->user()->district->bn_name}}<br>
          থানা: {{auth()->user()->thana->name}}
         @endif
         <br>
		<!------
		   Role: {{auth()->user()->type}}<br>  
  ---->
        </div>
      </div>









          <style>
          
          #MyClockDisplay {
  color: red;
  font-weight: bold;
  font-size: 21px;
}


          #MyDateDisplay {
  color: red;
  font-weight: bold;
  font-size: 17px;
}
          </style>
          


	</div>
	
	</div>
	
	
	
	

	
	


<br>



<!--<div class="row">
    
    <div class="col-sm-12">
        

 <div class="card">
                <div class="card-body bg-danger">


<h4 style="color:#fff;" >Report Confirmation Pending: {{$reportconfirmation}}</h4>



</div>
</div>
</div>
</div>
<br>
--->
<div class="row">
    
    <div class="col-sm-12">
        

 <div class="card">
               <div class="card-body">


      <table class="table table-responsive  table-striped table-centered table-bordered " style="width: 100% !important;height:auto;">

<thead>
    <tr>
    @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']) && empty(request()->input('districtID')))
                                                    <th > জেলা </th>
                                                    @elseif (auth()->user()->hasAnyRole(['Super Admin', 'Admin']) && !empty(request()->input('districtID')))
                                                    <th > থানা </th>
                                                  @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                    <th > থানা </th>
                                                    @endif
        <th > Qrr </th>
        <th > Case </th>
        <th > Case nispotti </th>
        <th > Narcotic case </th>
        <th > UD case </th>
        <th > Woman and childern </th>
    </tr>
</thead>
<tbody>
   @foreach ($qrrase as $data)
   <tr>
   <td>{{$data->bn_name}}</td>
   <td>{{$data->qrrcount}}</td>
   <td>{{$data->totalcase}}</td>
   <td>{{$data->casenispotti}}</td>
   <td>{{$data->narcoticcount}}</td>
   <td>{{$data->udcase}}</td>
   <td>{{$data->womancount}}</td>
</tr>
   @endforeach
</tbody>
</table>




    </div> 
    
</div>
    </div> 
    
</div>

























<br>


<div class="row">
    
    <div class="col-sm-6">
        

 <div class="card">
               <div class="card-body">




<span style="background-color: #756bb1;
padding: 3px;
text-align: center;
color: #fff;
display: block;
font-size: 16px;
margin-bottom: 10px;"> 
     
     
     ওয়ারেন্ট  এবং গ্রেফতার  </span>

  <table class="table table-striped table-centered  table-responsive   table-bordered " style="width: 100% !important;height:auto;">
                                            <thead>
                                                <tr>
                                                    @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']) && empty(request()->input('districtID')))
                                                    <th > জেলা </th>
                                                    @elseif (auth()->user()->hasAnyRole(['Super Admin', 'Admin']) && !empty(request()->input('districtID')))
                                                    <th > থানা </th>
                                                  @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                    <th > থানা </th>
                                                    @endif
                                                    <th> পেন্ডিং </th>
                                                    <th >  রিসিভ  </th>
                                                    <th>জিআর রিসিভ</th>
                                                    <th>সিআর রিসিভ</th>
                                                    <th>সাজা জিআর রিসিভ</th>
                                                    <th>সাজা সিআর রিসিভ</th>
                                                    <th >  রিকল ও অন্যান্য </th>
                                                     <th >  নিষ্পত্তি</th>
                                                       <th >  বডি তামিল </th>
                                                         <th >  নিস্পত্তি অনুপাতে বডি তামিল </th>
                                                               <th >  নিয়মিত মামলায় গ্রেফতার  </th>
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

if (request()->is('admin/dashboard')) {

    function districtpending($id) {
$warrec = \App\Models\Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
            ->where('status', 'active')->where('districtID', $id)->get();

$warnis = \App\Models\Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
            ->where('status', 'active')->where('districtID', $id)->get();

            // return (($warrec[0]['total_sum'] - $warnis[0]['total_sum']) >= 0) ? $warrec[0]['total_sum'] - $warnis[0]['total_sum'] : 0;

            return $warrec[0]['total_sum'] - $warnis[0]['total_sum'];

}

function thanapending($id) {
$warrec = \App\Models\Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
            ->where('status', 'active')->where('thanaID', $id)->get();

$warnis = \App\Models\Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
            ->where('status', 'active')->where('thanaID', $id)->get();

            // return (($warrec[0]['total_sum'] - $warnis[0]['total_sum']) >= 0) ? $warrec[0]['total_sum'] - $warnis[0]['total_sum'] : 0;

            return $warrec[0]['total_sum'] - $warnis[0]['total_sum'];

}

} else {

    function districtpending($id) {



if (! empty(request('to'))) {
$tokey = '=';
$tovalue = request('to');

$date = \Illuminate\Support\Carbon::parse($tovalue);
$tovalue = $date->format('Y-m-d').' 23:59:59';
} else {
$tokey = '=';
$tovalue = \Illuminate\Support\Carbon::now()->toDateTimeString();
}


$warrec = \App\Models\Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
->where('status', 'active')->where('districtID', $id)->whereBetween('date', ['1971-01-01 11:45:00', $tovalue])->get();

$warnis = \App\Models\Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
->where('status', 'active')->where('districtID', $id)->whereBetween('date', ['1971-01-01 11:45:00', $tovalue])->get();

// return (($warrec[0]['total_sum'] - $warnis[0]['total_sum']) >= 0) ? $warrec[0]['total_sum'] - $warnis[0]['total_sum'] : 0;

return $warrec[0]['total_sum'] - $warnis[0]['total_sum'];

}

function thanapending($id) {

if (! empty(request('to'))) {
$tokey = '=';
$tovalue = request('to');

$date = \Illuminate\Support\Carbon::parse($tovalue);
$tovalue = $date->format('Y-m-d').' 23:59:59';
} else {
$tokey = '=';
$tovalue = \Illuminate\Support\Carbon::now()->toDateTimeString();
}


$warrec = \App\Models\Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
->where('status', 'active')->where('thanaID', $id)->whereBetween('date', ['1971-01-01 11:45:00', $tovalue])->get();

$warnis = \App\Models\Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
->where('status', 'active')->where('thanaID', $id)->whereBetween('date', ['1971-01-01 11:45:00', $tovalue])->get();

// return (($warrec[0]['total_sum'] - $warnis[0]['total_sum']) >= 0) ? $warrec[0]['total_sum'] - $warnis[0]['total_sum'] : 0;

return $warrec[0]['total_sum'] - $warnis[0]['total_sum'];

}


}
@endphp
                                            @if($warrantarrast)
                                            @foreach ($warrantarrast as $war)
                                                <tr>
                                                <td >@if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']) && empty(request()->input('districtID')))    
                                            {{$war->district->bn_name}}
                                            @elseif (auth()->user()->hasAnyRole(['Super Admin', 'Admin']) && !empty(request()->input('districtID')))
                                            {{$war->thana->bn_name}}
                                            @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            {{$war->thana->bn_name}}
                                            @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            {{$war->thana->bn_name}}
                                            @endif</td>
                                            @if (request()->is('admin/dashboard')) 

                                            @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
                                                    <td @if (districtpending($war->districtID) < 0) bgcolor="red" @endif> @if(null !== disna($war->districtID)) {{districtpending($war->districtID)}} @endif</td>
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) 
                                                    <td @if (thanapending($war->thanaID) < 0) bgcolor="red" @endif> @if(null !== thana($war->thanaID)) {{thanapending($war->thanaID)}} @endif</td>
                                                    @endif
                                            @else 


                                            @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']) && empty(request()->input('districtID')))    
                                           <td @if (districtpending($war->districtID) < 0) bgcolor="red" @endif> {{districtpending($war->districtID)}} </td>
                                            @elseif (auth()->user()->hasAnyRole(['Super Admin', 'Admin']) && !empty(request()->input('districtID')))
                                            <td @if (thanapending($war->thanaID) < 0) bgcolor="red" @endif> {{thanapending($war->thanaID)}} </td>
                                            @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            <td @if (thanapending($war->thanaID) < 0) bgcolor="red" @endif> {{thanapending($war->thanaID)}} </td>
                                            @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            <td @if (thanapending($war->thanaID) < 0) bgcolor="red" @endif> {{thanapending($war->thanaID)}} </td>
                                            @endif
                                            
                                            @endif
                                            
                                                    <td > {{$war->total_recive}}</td>

                                                    <td>{{$war->totalgr_recive}}</td>
                                                    <td>{{$war->totalcr_recive}}</td>
                                                    <td>{{$war->totalsaja_gr_recive}}</td>
                                                    <td>{{$war->totalsaja_cr_recive}}</td>

                                                    
                                                  
                                                   
                                                    <td > {{$war->total_recall}}</td>
                                                    <td > {{$war->total_nispotti}}</td>
                                                    <td > {{$war->total_gr_tamil + $war->total_cr_tamil + $war->total_saja_gr_tamil + $war->total_saja_cr_tamil }}</td>
                                                    
                                                    <?php $totalgrt= $war->total_gr_tamil + $war->total_cr_tamil + $war->total_saja_gr_tamil + $war->total_saja_cr_tamil; 
                                                    
                                                    if($totalgrt==0) {
                                                        $totalcacl= '0';
                                                    } else {
                                                        $totalcacl= $war->total_nispotti/$totalgrt;
                                                    }
                                                    
                                                    ?>
                                                    <td > {{round($totalcacl, 2) }}</td>
                                                    <td > {{$war->sumucase_arrast}}</td>
                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>



                                  


    </div> 
    
</div>
    </div> 
    



    <div class="col-sm-6">
        

 <div class="card">
               <div class="card-body">




                                        <span style="background-color: #756bb1;
padding: 3px;
text-align: center;
color: #fff;
display: block;
font-size: 16px;
margin-bottom: -10px;">   অন্যান্য রিপোর্ট  </span>
                                        
                                        <br>

                                          <table class="table  table-striped  table-responsive   table-centered table-bordered " style="width: 100% !important;height:auto;">
                                            <thead>
                                                <tr>
                                                @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']) && empty(request()->input('districtID')))
                                                    <th > জেলা </th>
                                                    @elseif (auth()->user()->hasAnyRole(['Super Admin', 'Admin']) && !empty(request()->input('districtID')))
                                                    <th > থানা </th>
                                                  @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                    <th > থানা </th>
                                                    @endif
                                              
                                                  
                                                    <th>বিট পুলিশিং</th>
                                                    <th>কমিউনিটি পুলিশিং</th>
                                                    <th>Student কমিউনিটি পুলিশিং</th>
                                                    <th>সিআইএমএস এন্ট্রি</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if($datawarrantother)
                                            @foreach ($datawarrantother as $war)
                                                <tr>

                                                    <td >@if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']) && empty(request()->input('districtID')))    
                                            {{$war->district->bn_name}}
                                            @elseif (auth()->user()->hasAnyRole(['Super Admin', 'Admin']) && !empty(request()->input('districtID')))
                                            {{$war->thana->bn_name}}
                                            @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            {{$war->thana->bn_name}}
                                            @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            {{$war->thana->bn_name}}
                                            @endif</td>
                                                    
                                                   
                                                    
                                                    <td > {{$war->sumbit_police}}</td>
                                                    <td > {{$war->sumcomunity_police}}</td>
                                                    <td > {{$war->sumstudent_comunity_police}}</td>
                                                    <td > {{$war->sumcims}}</td>
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>


    </div> 
    
</div>
    </div> 
    
</div>

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <div style="display:none;">
		
		

         <div class="col-lg-6 col-xl-3">
            <div class="card">
               <div class="card-body  bg-danger text-white">
                  <div class="row align-items-center">
                     <div class="col-6">
                        <h5 style="color:#FFF !important" class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Users</h5>
                        <h3 class="my-2 py-1">1</h3>
                     </div>
                     <div class="col-6">
                        <div class="text-end">
                           <i class="dripicons-user "></i>
                        </div>
                     </div>
                  </div>
                  <!-- end row-->
               </div>
               <!-- end card-body -->
            </div>
            <!-- end card -->
         </div>
         <!-- end col -->
         
         
         <div class="col-lg-6 col-xl-3">
            <div class="card">
               <div class="card-body bg-danger text-white">
                  <div class="row align-items-center">
                     <div class="col-6">
                        <h5  style="color:#FFF !important" class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Loged In</h5>
                        <h3 class="my-2 py-1">1</h3>
                     </div>
                     <div class="col-6">
                        <div class="text-end">
                           <i class="mdi mdi-login
                              "></i>
                        </div>
                     </div>
                  </div>
                  <!-- end row-->
               </div>
               <!-- end card-body -->
            </div>
            <!-- end card -->
         </div>
         <!-- end col -->
         </div>



         @php
 $sdisn = request()->input('districtID');
 $sthan = request()->input('thanaID');
                
                  $division_id = 1;
                if(($sdisn !== 'খালি'))
                    $district_id = $sdisn;
                if(($sthan !== 'খালি'))
                    $thana_id = $sthan;

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
