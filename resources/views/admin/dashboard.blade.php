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






<div class="row">

<h2>Report confirmation: {{$reportconfirmation}}</h2>
	
 <div class="col-sm-6">

   <div class="card">
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

      <div class="card">
        <div class="card-img-top grabg"   style="height: 122px;"> </div>
        <div class="card-body text-center">
          <img class="avatar rounded-circle" src="{{ asset(auth()->user()->picture) }}" alt="Bologna">
          <h4 class="card-title">{{auth()->user()->name}}</h4>
          <h6 class="card-subtitle mb-2 text-muted">পদবি: {{auth()->user()->designation}}</h6>
          <h6 class="card-subtitle mb-2 text-muted">Mobile: {{auth()->user()->mobile}}</h6>
        
		
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
		
		   Role: {{auth()->user()->type}}<br>  
  
        </div>
      </div>

      <table class="table table-bordered table-responsive table-responsive table-striped table-centered mb-0 yajra-datatable" style="width: 100% !important;">

<thead>
    <tr>
    @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
                                                    <th > জেলা </th>
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


<span style="background-color: #756bb1;
padding: 3px;
text-align: center;
color: #fff;
display: block;
font-size: 16px;
margin-bottom: -10px;"> 
     
     
     ওয়ারেন্ট  এবং গ্রেফতার  </span>

<table class="table table-bordered table-responsive table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
                                                    <th > জেলা </th>
                                                  @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                    <th > থানা </th>
                                                    @endif
                                                    <th >  রিসিভ  </th>
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
@endphp
                                            @if($warrantarrast)
                                            @foreach ($warrantarrast as $war)
                                                <tr>
                                                    @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
                                                    <td > @if(null !== disna($war->districtID)) {{disna($war->districtID)}} @endif</td>
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) 
                                                    <td > @if(null !== thana($war->thanaID)) {{thana($war->thanaID)}} @endif</td>
                                                    @endif
                                                    <td > {{$war->total_recive}}</td>
                                                  
                                                   
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



                                        <span style="background-color: #756bb1;
padding: 3px;
text-align: center;
color: #fff;
display: block;
font-size: 16px;
margin-bottom: -10px;">   অন্যান্য রিপোর্ট  </span>
                                        
                                        <br>

                                        <table class="table table-bordered table-responsive table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
                                                    <th > জেলা </th>
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

<x-admin-footer/>
