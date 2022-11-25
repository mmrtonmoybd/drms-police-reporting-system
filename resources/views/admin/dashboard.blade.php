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
