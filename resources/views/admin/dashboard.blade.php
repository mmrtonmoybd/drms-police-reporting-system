<x-admin-header/>
<!-- start page title -->
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title"><i class="uil-home-alt"></i> Home</h4>
      </div>
   </div>
</div>
<!-- end page title --> 
<x-admin-validation-errors :errors="$errors->all()"/>
<div class="row">
   <div class="card">
      <div class="card-body  ">
          
          
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
            <center> 
         <h3 id=""> বরিশাল রেঞ্জ (ডিআরএমএস) সফটওয়্যারে আপনাকে স্বাগতম </h3>
     <span id="MyDateDisplay"> Today is : 16 Nov 2022 </span>
     
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
      </div>
      <!-- end card-body -->
   </div>
   <!-- end card -->
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
