<x-admin-header />
                       
                 <script src="https://code.jquery.com/jquery-latest.min.js"></script>
<style>

body {
	overflow:auto!important;
}




#errmsg{
background: #ff5757;
color: #fff;
padding: 4px;
display: none;
width: 250px;
position: fixed;
z-index: 100;
right: 10px;
  
}

#errdate{
background: #ff5757;
color: #fff;
padding: 4px;
display: none;
width: 250px;
position: fixed;
z-index: 100;
right: 10px;
  
}



.clockpicker-display-column {
  float: left;
  top: -3px;
  position: absolute;
  right: 57px;
}
.picker__footer button {
    background: #639;
border: 1px solid #5d0eac;
margin: 0px 5px!important;
padding: 5px 10px;
color: #fff;
border-radius: 5px;
}

.picker__footer {
  text-align: right;
}


.clockpicker-display-column button {
  float: left;
  top: -3px;
  position: absolute;
  right: 57px;
}


.clockpicker.picker.picker--opened {
  position: absolute;
  z-index: 1000;
  top: 50px;
  box-shadow: 0px 1px 8px -1px #7265c885;
  padding: 10px;
  background: #fff;
}
.button-label {
  display: inline-block;
padding:5px 10px;
width:;
  margin: 0.5em;
  cursor: pointer;
  color: #292929;
  border-radius: 0.25em;
  background: #efefef;
  border: 1px solid #ddd;
  transition: 0.3s;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}
.button-label h1 {
  font-size: 14px;
  text-align: center;

}
.button-label:hover {
  background: #d6d6d6;
  color: #101010;
  border: 1px solid #147fdd;
 
}
.button-label:active {
  transform: translateY(2px);
 
}
@media (max-width: 40em) {
  .button-label {
    padding: 0em 1em 3px;
    margin: 0.25em;
  }
}



#myCheckovi:checked + .button-label {
  background: #0C2DB0;
  color: #efefef;
}
#myCheckovi:checked + .button-label:hover {
  background: #0C2DB0;
  color: #e2e2e2;
}




#myCheckgd:checked + .button-label {
  background: #0C2DB0;
  color: #efefef;
}
#myCheckgd:checked + .button-label:hover {
  background: #0C2DB0;
  color: #e2e2e2;
}






#myCheck:checked + .button-label {
  background: #0C2DB0;
  color: #efefef;
}
#myCheck:checked + .button-label:hover {
  background: #0C2DB0;
  color: #e2e2e2;
}




#myCheckmim:checked + .button-label {
  background: #0C2DB0;
  color: #efefef;
}
#myCheckmim:checked + .button-label:hover {
  background: #0C2DB0;
  color: #e2e2e2;
}







#myCheckain:checked + .button-label {
  background: #0C2DB0;
  color: #efefef;
}
#myCheckain:checked + .button-label:hover {
  background: #0C2DB0;
  color: #e2e2e2;
}

input:checked + .button-label h1{
  color: #fff;
}


#nogd:checked + .button-label {
  background: #D91E18;
  color: #efefef;
}
#nogd:checked + .button-label:hover {
  background: #c21b15;
  color: #e2e2e2;
}



#no:checked + .button-label {
  background: #D91E18;
  color: #fff;
}
#no:checked + .button-label:hover {
  background: #c21b15;
  color: #e2e2e2;
}


#maybe-button:checked + .button-label {
  background: #4183D7;
  color: #efefef;
}
#maybe-button:checked + .button-label:hover {
  background: #2c75d2;
  color: #e2e2e2;
}


.hidden {
  display: none;
}

#errdateneg{
background: #ff5757;
color: #fff;
padding: 4px;
display: none;
width: 250px;
position: fixed;
z-index: 100;
right: 10px;
  
}


#errdateneg2{
background: #ff5757;
color: #fff;
padding: 4px;
display: none;
width: 250px;
position: fixed;
z-index: 100;
right: 10px;
top:30px;
  
  
}

.redbdr {
    border:1px solid red;
}
</style>

    <!-- start page title -->
<br>


  <div id="errmsg"></div>
<div id="errdate"></div>
              

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/narcotic/add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body" id="app">
                                        
                                        
                                        
                                                                                                                        
<div style="background: #663399;
width: 100%;
border-radius: 10px;
height: 25px;
box-sizing: unset;
color: #fff;
font-weight: bold;
text-align: center;
margin-bottom: 18px;
padding: 4px 4px 13px 4px;
box-shadow: 1px 2px 3px 1px #b7aea3;
font-size: 21px;"> মাদক সংক্রান্ত তথ্যাদি ইনপুট ফরম </div>
                                        
                                        
                                        
                                        <div class="row">

                                        <div class="col-sm-4" style="display:none;">
                                                <div class="mb-3">
                                                    <label for="serial" class="form-label">  ক্রমিক নং   </label>
                                                    <input type="number"  min="0"  name="serial"  value="{{old('serial')}}" id="serial" class="number form-control  @error('serial') is-invalid @enderror" placeholder="  ক্রমিক নং  ">
                                                </div>
                                            </div> 

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="folder_no" class="form-label">  ফোল্ডার নং   </label>
                                                    <input   name="folder_no"  value="{{old('folder_no')}}" id="folder_no" class="form-control  @error('folder_no') is-invalid @enderror" placeholder=" ফোল্ডার নং  " required>
                                                </div>
                                            </div> 

                                            @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "> জেলা </label>
                                                    <select name="districtID" id="districtID" class="form-select form-control"  v-model="district_id" @change="getUpozillasAndThana()"  required>
                                                        <option value="">Select</option>
                                                        @if($districts)

                                                        @foreach($districts as $district)
                                                        <option value="{{$district->id}}">{{$district->bn_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label">থানা</label>
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select form-control" required>
                                                        <option value="">Select</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>
                                            @endif

                                            @if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label">থানা</label>
                                                    <select name="thanaID" id="thanaID" class="form-select form-control" required>
                                                        <option value="">Select</option>
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
                                                    <label for="thanaID" class="form-label">থানা</label>
                                                    <select name="thanaID" id="thanaID" class="form-select form-control" required>
                                                        <option value="" disabled >Select</option>
                                                        @if($octhana)

                                                        <option value="{{$octhana->id}}" selected>{{$octhana->bn_name}}</option>
                                                        
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="village_word" class="form-label"> গ্রাম/ওয়ার্ড </label>
                                                    <input type="text" name="village_word"  value="{{old('village_word')}}" id="village_word" class="form-control  @error('village_word') is-invalid @enderror" placeholder="গ্রাম/ওয়ার্ড" required>
                                                </div>
                                            </div>

                                            
                                            
                                                 <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="case_no" class="form-label">  মামলা নং   </label>
                                                    <input type="number"  min="0"  name="case_no"  value="{{old('case_no')}}" id="case_no" class="number form-control  @error('case_no') is-invalid @enderror" placeholder="   মামলা নং " required>
                                                </div>
                                            </div>
      
      
      
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="sdate" class="form-label">  তারিখ  </label>
                                                   
                                                    <div class="input-group" id="timepicker-input-group1">
                                                        <input type="text" name="sdate"  value="{{old('sdate')}}" id="sdate" class="form-control datepicker  @error('sdate') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ  " required>
                                                    </div>
                                                        
                                                </div>
                                              
                                            </div>

                                       
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="nopc" class="form-label">ধারা </label>
                                                    <input type="text" name="nopc"  value="{{old('nopc')}}" id="nopc" class="form-control  @error('nopc') is-invalid @enderror" placeholder=" ধারা" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="name_of_investigator_org" class="form-label">   অভিযান পরিচালনাকারী সংস্থা     </label>
                                                    <select name="name_of_investigator_org" id="name_of_investigator_org" class="form-select form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="থানা পুলিশ"> থানা পুলিশ </option>
                                                        <option value="ডিবি">ডিবি</option>
                                                        <option value="র‍্যাব">র‍্যাব</option>
                                                        <option value="এপিবিএন">এপিবিএন</option>
                                                        <option value="মাদকদ্রব্য নিয়ন্ত্রণ অধিদপ্তর">মাদকদ্রব্য নিয়ন্ত্রণ অধিদপ্তর</option>
                                                        <option value="কোস্টগার্ড">কোস্টগার্ড</option>
                                                        <option value="অন্যান্য">অন্যান্য</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="name_of_investigator" class="form-label">অভিযান পরিচালনাকারী অফিসার   </label>
                                                    <input type="text" name="name_of_investigator"  value="{{old('name_of_investigator')}}" id="name_of_investigator" class="form-control  @error('name_of_investigator') is-invalid @enderror" placeholder=" অভিযান পরিচালনাকারী অফিসার " required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="bp_no" class="form-label"> বিপি নং   </label>
                                                    <input type="number"  min="0"  name="bp_no"  value="{{old('bp_no')}}" id="bp_no" class="number form-control  @error('bp_no') is-invalid @enderror" placeholder="  বিপি নং " required>
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="mobile_no" class="form-label">  মোবাইল নং  </label>
                                                    <input type="number"  min="0"  minlength="11" maxlength="11" name="mobile_no"  value="{{old('mobile_no')}}" id="mobile_no" class="number form-control  @error('mobile_no') is-invalid @enderror" placeholder=" মোবাইল নং  " required>
                                                </div>
                                            </div>
      
                                            
                                                                                        <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="accused" class="form-label">  অভিযুক্তের নাম </label>
                                                    <input type="text" name="accused"  value="{{old('accused')}}" id="accused" class="form-control  @error('accused') is-invalid @enderror" placeholder=" অভিযুক্ত " required>
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="number_of_include" class="form-label">  অভিযুক্তের সংখ্যা   </label>
                                                    <input type="number"  min="0"  name="number_of_include" id="number_of_include" class="number form-select form-control" required>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                        <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="number_of_accused" class="form-label">  গ্রেফতারকৃত আসামীর সংখ্যা   </label>
                                                    <input type="number"  min="0"  name="number_of_accused" id="number_of_accused" class="number form-select form-control" required>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                  
                                            
                                                    <div class="col-sm-12" >
                                             <hr>
												
                                            </div>
                                            
                                            
                                            
                                         
                                            
                                                <div class="col-sm-12">
                                                <div class="mb-3">
                                               উদ্ধারকৃত মাদকঃ
                                               &nbsp; &nbsp;
                                               
                                               
                                               
       <input class="hidden radio-label" type="checkbox" name="action_taken" id="myCheckovi" value="গাজা" onclick="myFunction()" >
    <label class="button-label" for="myCheckovi">
      <h1>গাজা</h1>
	   </label>
	   
	   
                                               
  <input class="hidden radio-label" type="checkbox" name="action_taken" id="myCheckgd" value="ইয়াবা" onclick="myFunction()">
    <label class="button-label" for="myCheckgd">
      <h1>ইয়াবা</h1>
    </label>
	
	
    <input class="hidden radio-label" type="checkbox" name="action_taken" id="myCheck" value="মামলা" onclick="myFunction()" >
    <label class="button-label" for="myCheck">
      <h1>হিরোইন/ফেনসিডিল</h1>
	   </label>
	  
	     <input class="hidden radio-label" type="checkbox" name="action_taken" value="স্থানীয় পর্যায়ে মীমাংসা" id="myCheckmim" onclick="myFunction()" >
    <label class="button-label" for="myCheckmim">
      <h1>মদ</h1>
	   </label>
	   
	       <input class="hidden radio-label" type="checkbox" name="action_taken" id="myCheckain" value="আইনগত পরামর্শ" onclick="myFunction()"     >
    <label class="button-label" for="myCheckain">
      <h1>এলএসডি/ আইস</h1>
    </label>   

                                               
                                               
                                                </div>
                                            </div>
                                            
											
											
											
				

<script>


function myFunction() {
    
var checkBoxovi = document.getElementById("myCheckovi");
  var checkBoxgd = document.getElementById("myCheckgd");
    var checkBox = document.getElementById("myCheck");
  var checkBoxmim = document.getElementById("myCheckmim");
  var checkBoxain = document.getElementById("myCheckain");
  
      var gd1 = document.getElementById("gd1");
     
     var mam = document.getElementById("mam");
     var mam2 = document.getElementById("mam2");
     
     
	 
       var mim = document.getElementById("mim");
       var mim2 = document.getElementById("mim2");
     
       var ain = document.getElementById("ain");
	 var ain2 = document.getElementById("ain2");
	 
	   var ovi1 = document.getElementById("ovi1");
	   var ovi2 = document.getElementById("ovi2");
       var ovi3 = document.getElementById("ovi3");
     
     
     
   if (checkBoxovi.checked == true){
  
      
      ovi1.style.display = "block";
      ovi2.style.display = "block";
	 
  } else {

         
         ovi1.style.display = "none";
         ovi2.style.display = "none";
      
		 
  }
  
  
     
     
     
   if (checkBox.checked == true){
      mam.style.display = "block";
      mam2.style.display = "block";
 
  
  } else {
         mam.style.display = "none";
         mam2.style.display = "none";
      
         
     
  }
  
  
  
    if (checkBoxgd.checked == true){
  
      
      gd1.style.display = "block";
 
  } else {

         
         gd1.style.display = "none";
      
		 
  }
  
  
  
  
    
    if (checkBoxmim.checked == true){
  
      
      mim.style.display = "block";
       mim2.style.display = "block";
 
  } else {

         mim.style.display = "none";
         mim2.style.display = "none";
      
		 
  }
  
      
    if (checkBoxain.checked == true){
  
      
      ain.style.display = "block";
       ain2.style.display = "block";
 
  } else {

           ain.style.display = "none";
         ain2.style.display = "none";
      
		 
  }
  
  
  
  
}



</script>
                          
                                            
                                            
                                            
                                            
                                            
                                            
                                     <div class="col-sm-4" id="ovi1" style="display:none">
                                                <div class="mb-3">
                                                    <label for="gaza"  class="form-label">  গাঁজা (গ্রাম)  </label>
                                                    <input type="number"  min="0"  name="gaza"  value="{{old('gaza')}}" id="gaza" class="number form-control  @error('gaza') is-invalid @enderror" placeholder=" গাঁজা (গ্রাম) ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="ovi2" style="display:none">
                                                <div class="mb-3">
                                                    <label for="gaza_tree" class="form-label">  গাঁজা গাছ (সংখ্যা)  </label>
                                                    <input type="number"  min="0"  name="gaza_tree"  value="{{old('gaza_tree')}}" id="gaza_tree" class="number form-control  @error('gaza_tree') is-invalid @enderror" placeholder=" গাঁজা গাছ (সংখ্যা) ">
                                                </div>
                                            </div>



											
                                       <div class="col-sm-4" id="gd1"  style="display:none">
                                             <div class="mb-3">
                                                    <label for="yaba" class="form-label">  ইয়াবা (পিচ)  </label>
                                                    <input type="number"  min="0"  name="yaba"  value="{{old('yaba')}}" id="yaba" class="number form-control  @error('gaza_tree') is-invalid @enderror" placeholder=" ইয়াবা (পিচ) ">
                                                </div>
                                            </div>
      
                                
								
								
					                          
                                
                                            <div class="col-sm-4" id="mam"  style="display:none">
                                               <div class="mb-3">
                                                    <label for="heroine" class="form-label">  হিরোইন (গ্রাম)  </label>
                                                    <input type="number"  min="0"  name="heroine"  value="{{old('heroine')}}" id="heroine" class="number form-control  @error('heroine') is-invalid @enderror" placeholder=" ইরোইন (গ্রাম) ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4" id="mam2"  style="display:none">
                                                 <div class="mb-3">
                                                    <label for="fansdel" class="form-label">  ফেনসিডিল (বোতল)  </label>
                                                    <input type="number"  min="0" name="fansdel"  value="{{old('fansdel')}}" id="fansdel" class="number form-control  @error('fansdel') is-invalid @enderror" placeholder=" ফেনসিডিল (বোতল) ">
                                                </div>
                                            </div>
      
      
                                   





                                   

                                         
                                             <div class="col-sm-4" id="mim" style="display:none">
                                                <div class="mb-3">
                                                    <label for="cholai_alcohol" class="form-label"> চোলাই মদ (লিটার)   </label>
                                                    <input type="number"  min="0"  name="cholai_alcohol"  value="{{old('cholai_alcohol')}}" id="cholai_alcohol" class="number form-control  @error('cholai_alcohol') is-invalid @enderror" placeholder=" চোলাই মদ (লিটার) ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4" id="mim2" style="display:none">
                                                <div class="mb-3">
                                                    <label for="bidesh_alcohol" class="form-label"> বিদেশী মদ (লিটার)   </label>
                                                    <input type="number"  min="0"  name="bidesh_alcohol"  value="{{old('bidesh_alcohol')}}" id="bidesh_alcohol" class="number form-control  @error('bidesh_alcohol') is-invalid @enderror" placeholder=" বিদেশী মদ (লিটার) ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4" id="ain" style="display:none">
                                                <div class="mb-3">
                                                    <label for="lsd" class="form-label">  এলএসডি (মাইক্রোগ্রাম)  </label>
                                                    <input type="number"  min="0"  name="lsd"  value="{{old('lsd')}}" id="lsd" class="number form-control  @error('lsd') is-invalid @enderror" placeholder=" এলএসডি (মাইক্রোগ্রাম) ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4" id="ain2" style="display:none">
                                                <div class="mb-3">
                                                    <label for="ice" class="form-label">  আইস (মাইক্রোগ্রাম)  </label>
                                                    <input type="number"  min="0"  name="ice"  value="{{old('ice')}}" id="ice" class="number form-control  @error('ice') is-invalid @enderror" placeholder=" আইস (মাইক্রোগ্রাম) ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4" >
                                                <div class="mb-3">
                                                    <label for="otherd" class="form-label"> আন্যান্য   </label>
                                                    <input type="text" name="otherd"  value="{{old('otherd')}}" id="otherd" class="form-control  @error('otherd') is-invalid @enderror" placeholder=" আন্যান্য ">
                                                </div>
                                            </div>





      
      
          <div class="col-sm-12" >
                                             <hr>
												
                                            </div>                
                                            
                                            
                                            
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                            
                                            
                                            
                                    



                                            <div class="col-sm-4" style="display:none;">
                                                <div class="mb-3">
                                                    <label for="image_video" class="form-label">   ছবি প্রাপ্তি </label>
                                                    <select name="image_video" id="image_video" class="form-select form-control">
                                                        <option value="">Select</option>
                                                        <option value="হ্যা">হ্যা</option>
                                                        <option value="না">না</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                             <div class="col-sm-4" style="display:none;">
                                                <div class="mb-3">
                                                    <label for="jobdo_list" class="form-label"> জব্দ তালিকা  </label>
                                                    <select name="jobdo_list" id="jobdo_list" class="form-select form-control">
                                                        <option value="">Select</option>
                                                        <option value="হ্যা">হ্যা</option>
                                                        <option value="না">না</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-4" style="display:none;">
                                                <div class="mb-3">
                                                    <label for="narocotic_test_report" class="form-label">  মাদকের রিপোর্ট প্রাপ্তি ( <font color='red'> নিষ্পত্তি হয়ে থাকলে</font> ) </label>
                                                    <input type="text" name="narocotic_test_report"  value="{{old('narocotic_test_report')}}" id="narocotic_test_report" class="form-control  @error('narocotic_test_report') is-invalid @enderror" placeholder=" মাদকের রিপোর্ট প্রাপ্তি ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" style="display:none;">
                                                <div class="mb-3">
                                                    <label for="investigate_result" class="form-label">  তদন্তের ফলাফল (CS নং) ( <font color='red'> নিষ্পত্তি হয়ে থাকলে</font> )  </label>
                                                    <input type="text" name="investigate_result"  value="{{old('investigate_result')}}" id="investigate_result" class="form-control  @error('investigate_result') is-invalid @enderror" placeholder=" তদন্তের ফলাফল (CS নং) ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" style="display:none;">
                                                <div class="mb-3">
                                                    <label for="tdate" class="form-label">  তারিখ ( <font color='red'> নিষ্পত্তি হয়ে থাকলে</font> ) </label>
                                                   
                                                    <div class="input-group" id="timepicker-input-group1">
                                                        <input type="text" name="tdate"  value="{{old('tdate')}}" id="tdate" class="form-control datepicker  @error('tdate') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ  " >
                                                    </div>
                                                        
                                                </div>
                                              
                                            </div>

                                            <div class="col-sm-12" style="display:none;">
                                                <div class="mb-3">
                                                    <label for="comment" class="form-label">মন্তব্য ( <font color='red'> নিষ্পত্তি হয়ে থাকলে</font> ) </label>
                                                    <textarea name="comment"  class="form-control  @error('comment') is-invalid @enderror" id="address" rows="2" placeholder="মন্তব্য">{{old('comment')}}</textarea>
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="submit" id="sbbtn" name="submit" class="btn btn-primary"> Submit </button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                
                                </form>
                            </div>
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
    

<script>
// var inputBox = document.getElementById("inputnumber");
var invalidChars = [
  "1",
  "2",
  "3",
  "4",
  "5",
  "6",
  "7",
  "8",
  "9",
  "0",
  "০",
  "১",
  "২",
  "৩",
  "৪",
  "৫",
  "৬",
  "৭",
  "৮",
  "৯",
   "",
 
];



   $(".number").keypress(function (e) {
           if(invalidChars.includes(e.key) || e.which == 8 || event.key === 'Delete' || event.key === 'Enter' || event.key === 'Tab' || event.key === 'ArrowDown' || event.key === 'ArrowLeft' || event.key === 'ArrowRight' || event.key === 'ArrowUp' || event.key === 'Home' || event.key === 'End') {
   }
   

  
  else {
   e.preventDefault();
   
         $("#errmsg").html("Number Only").stop().show().fadeOut("slow");
      return false;
      
      
  }
});

</script>

    
    

                     <x-admin-footer/>
