<x-admin-header />

<script src="https://code.jquery.com/jquery-latest.min.js"></script>

  <link rel='stylesheet' href='https://cdn.rawgit.com/chingyawhao/materialize-clockpicker/master/dist/css/materialize.clockpicker.css'>


 
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
  box-shadow:  inset 0 -3px 0 rgba(0, 0, 0, 0.22);
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
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2), inset 0 -3px 0 rgba(0, 0, 0, 0.32);
}
.button-label:active {
  transform: translateY(2px);
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2), inset 0px -1px 0 rgba(0, 0, 0, 0.22);
}
@media (max-width: 40em) {
  .button-label {
    padding: 0em 1em 3px;
    margin: 0.25em;
  }
}

#myCheckgd:checked + .button-label {
  background: #2ECC71;
  color: #efefef;
}
#myCheckgd:checked + .button-label:hover {
  background: #29b765;
  color: #e2e2e2;
}






#myCheck:checked + .button-label {
  background: #2ECC71;
  color: #efefef;
}
#myCheck:checked + .button-label:hover {
  background: #29b765;
  color: #e2e2e2;
}




#myCheckmim:checked + .button-label {
  background: #2ECC71;
  color: #efefef;
}
#myCheckmim:checked + .button-label:hover {
  background: #29b765;
  color: #e2e2e2;
}





#myCheckain:checked + .button-label {
  background: #2ECC71;
  color: #efefef;
}
#myCheckain:checked + .button-label:hover {
  background: #29b765;
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




<br>
  <div id="errmsg"></div>
<div id="errdate"></div>

 <!-- start page title -->
 
 
 

                        <x-admin-validation-errors :errors="$errors->all()"/>


<span id="errdateneg">ঘটনার তারিখ সংবাদ প্রাপ্তির তারিখের থেকে পরে হতে পারবে না </span>
<span id="errdateneg2">সংবাদ প্রাপ্তির তারিখ রেসপন্স তারিখের থেকে পরে হতে পারবে না </span>


                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/qrrs/edit/'.$qrr->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body" id="app">
                                        
                                        
                                        
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
font-size: 21px;"> QRR সংক্রান্ত তথ্যাদি ইডিট ফরম </div>


                                        
                                        
                                        
                                        <div class="row">

                                        @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "> জেলা </label>
                                                    <select name="districtID" id="districtID" class="form-select form-control"  v-model="district_id" @change="getUpozillasAndThana()"  required>
                                                        <option value="">Select</option>
                                                        @if($districts)

                                                        @foreach($districts as $district)
                                                        <option value="{{$district->id}}"  {{ ( $district->id == $qrr->districtID) ? 'selected' : '' }} >{{$district->bn_name}}</option>
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
                                                        <option value="{{$thnsp->id}}" {{ ( $thnsp->id == $qrr->thanaID) ? 'selected' : '' }}>{{$thnsp->bn_name}}</option>
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
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select form-control" required>
                                                        <option value="">থানা</option>
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
                                                    <input type="text" name="village_word"  value="{{$qrr->village_word}}" id="village_word" class="form-control  @error('village_word') is-invalid @enderror" placeholder="গ্রাম/ওয়ার্ড">
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="source_of_info" class="form-label">  তথ্য প্রাপ্তির উৎস </label>
                                                    <select name="source_of_info" id="source_of_info" class="form-select form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="এলাকা" {{$qrr->source_of_info=='এলাকা' ? 'selected' : '' }}> এলাকা </option>
                                                        <option value="কোর্ট" {{$qrr->source_of_info=='কোর্ট' ? 'selected' : '' }}>কোর্ট</option>
                                                        <option value="থানা" {{$qrr->source_of_info=='থানা' ? 'selected' : '' }}>থানা</option>
                                                        <option value="৯৯৯" {{$qrr->source_of_info=='৯৯৯' ? 'selected' : '' }}>৯৯৯</option>
                                                    </select>
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="date_time_of_incident" class="form-label">   ঘটনার তারিখ ও সময়  </label>
                                                   
                                                    <div class="input-group" id="timepicker-input-group1">
                                                        <input type="text" name="date_time_of_incident"  value="@if (!empty($qrr->date_time_of_incident)) {{date('d/m/Y', strtotime($qrr->date_time_of_incident))}} @endif" id="date_time_of_incident" class="form-control datepicker  @error('date_time_of_incident') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="ঘটনার তারিখ ও সময়  " required>

                                                        <!-- Date dime -->
                                                            <input  name="incident_time"   id="timepicker_ampm_dark"  onchange="validateHhMm(this);" value="@if (!empty($qrr->date_time_of_incident)) {{date('H:i',strtotime($qrr->date_time_of_incident))}} @endif" class="form-control timepicker" type="text" required>
                                                 
                                                </div>
                                                        
                                                </div>
                                              
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="date_time_of_police_news" class="form-label">  পুলিশের সংবাদ প্রাপ্তির তারিখ ও সময় </label>
                                                    <div class="input-group" id="timepicker-input-group2">
                                                        <input type="text" name="date_time_of_police_news"  value="@if (!empty($qrr->date_time_of_police_news)) {{date('d/m/Y', strtotime($qrr->date_time_of_police_news))}} @endif" id="date_time_of_police_news" class="form-control datepicker  @error('date_time_of_police_news') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="সংবাদ প্রাপ্তির তারিখ ও সময়" required>

                                                        <!-- Date dime -->
                                                   <input  name="police_news_time"   id="timepicker_ampm_dark"  onchange="validateHhMm(this);" value="@if (!empty($qrr->date_time_of_police_news)) {{date('H:i', strtotime($qrr->date_time_of_police_news))}} @endif" class="form-control timepicker" type="text" required>
                                                    
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="date_time_response" class="form-label">  রেসপন্সের তারিখ ও সময় </label>
                                                    <div class="input-group" id="timepicker-input-group2">
                                                        <input type="text" name="date_time_response"  value="@if (!empty($qrr->date_time_response)) {{date('d/m/Y', strtotime($qrr->date_time_response))}} @endif" id="date_time_response" class="form-control datepicker  @error('date_time_response') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="রেসপন্সের তারিখ ও সময়" >

                                                        <!-- Date dime -->
                                             
                                                     <input  name="response_time"  id="timepicker_ampm_dark"  onchange="validateHhMm(this);" value="@if (!empty($qrr->date_time_response)) {{date('H:i', strtotime($qrr->date_time_response))}} @endif"  class="form-control timepicker" type="text">
                                                    </div>
                                                </div>
                                            </div>

                                            
      
                                            
                                            

                     
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="event_type" class="form-label">   ঘটনার ধরণ     </label>
                                                    <select name="event_type" id="event_type" class="form-select form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="মারামারি" {{$qrr->event_type=='মারামারি' ? 'selected' : ''}}> মারামারি </option>
                                                        <option value="খুন" {{$qrr->event_type=='খুন' ? 'selected' : ''}}>খুন</option>
                                                        <option value="চুরি" {{$qrr->event_type=='চুরি' ? 'selected' : ''}}>চুরি</option>
                                                        <option value="ডাকাতি" {{$qrr->event_type=='ডাকাতি' ? 'selected' : ''}}>ডাকাতি</option>
                                                        <option value="বিরোধ" {{$qrr->event_type=='বিরোধ' ? 'selected' : ''}}>বিরোধ</option>
                                                        <option value="নিখোঁজ-অপহরণ" {{$qrr->event_type=='নিখোঁজ-অপহরণ' ? 'selected' : ''}}>নিখোঁজ/ অপহরণ</option>
                                                        <option value="দস্যুতা" {{$qrr->event_type=='দস্যুতা' ? 'selected' : ''}}>দস্যুতা</option>
                                                        <option value="জুয়া" {{$qrr->event_type=='জুয়া' ? 'selected' : ''}}>জুয়া</option>
                                                        <option value="সড়ক দুর্ঘটনা" {{$qrr->event_type=='সড়ক দুর্ঘটনা' ? 'selected' : ''}}>সড়ক দুর্ঘটনা</option>
                                                        <option value="নারী ও শিশু" {{$qrr->event_type=='নারী ও শিশু' ? 'selected' : ''}}>নারী ও শিশু</option>
                                                        <option value="অগ্নিকান্ড" {{$qrr->event_type=='অগ্নিকান্ড' ? 'selected' : ''}}>অগ্নিকান্ড</option>
                                                        <option value="মাদক" {{$qrr->event_type=='মাদক' ? 'selected' : ''}}>মাদক</option>
                                                        <option value="সাইবার" {{$qrr->event_type=='সাইবার' ? 'selected' : ''}}>সাইবার</option>
                                                        <option value="প্রতারণা" {{$qrr->event_type=='প্রতারণা' ? 'selected' : ''}}>প্রতারণা</option>
                                                        <option value="দুর্ঘটনা" {{$qrr->event_type=='দুর্ঘটনা' ? 'selected' : ''}}>দুর্ঘটনা</option>
                                                        <option value="অন্যান্য" {{$qrr->event_type=='অন্যান্য' ? 'selected' : ''}}>অন্যান্য</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
      
                                            
                                            
                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="begening_of_event" class="form-label">  ঘটনার সূত্রপাত  </label>
                                                    <select name="begening_of_event" id="begening_of_event" class="form-select form-control">
                                                        <option value="">Select</option>
                                                        <option value="জমিজমা" {{$qrr->begening_of_event=='জমিজমা' ? 'selected' : ''}}> জমিজমা </option>
                                                        <option value="রাজনৈতিক" {{$qrr->begening_of_event=='রাজনৈতিক' ? 'selected' : ''}}>রাজনৈতিক</option>
                                                        <option value="পারিবারিক" {{$qrr->begening_of_event=='পারিবারিক' ? 'selected' : ''}}>পারিবারিক</option>
                                                        <option value="তুচ্ছ কারণ" {{$qrr->begening_of_event=='তুচ্ছ কারণ' ? 'selected' : ''}}>তুচ্ছ কারণ</option>
                                                        <option value="প্রেম ঘটিত" {{$qrr->begening_of_event=='প্রেম ঘটিত' ? 'selected' : ''}}>প্রেম ঘটিত</option>
                                                        <option value="লেনদেন সংক্রান্ত" {{$qrr->begening_of_event=='লেনদেন সংক্রান্ত' ? 'selected' : ''}}>লেনদেন সংক্রান্ত</option>
                                                        <option value="অসতর্কতা" {{$qrr->begening_of_event=='অসতর্কতা' ? 'selected' : ''}}>অসতর্কতা</option>
                                                        <option value="অন্যান্য" {{$qrr->begening_of_event=='অন্যান্য' ? 'selected' : ''}}>অন্যান্য</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="short_dettails" class="form-label">  ঘটনার সংক্ষিপ্ত বিবরন   </label>
                                                    <textarea type="text" name="short_dettails" id="short_dettails" class="form-control  @error('short_dettails') is-invalid @enderror" placeholder="  ঘটনার সংক্ষিপ্ত বিবরন  ">{{$qrr->short_dettails}}</textarea>
                                                </div>
                                            </div>

                                             <div class="col-sm-12" >
                                             <hr>
												
                                            </div>

      
                        
                                            
                                                <div class="col-sm-12">
                                                <div class="mb-3">
                                               গৃহীত ব্যবস্থাঃ
                                               &nbsp; &nbsp;
  <input class="hidden radio-label" type="radio" name="action_taken" id="myCheckgd" value="জিডি" onclick="myFunction()" {{$qrr->action_taken=='জিডি' ? 'checked' : ''}}>
    <label class="button-label" for="myCheckgd">
      <h1>জিডি</h1>
    </label>
	
	
    <input class="hidden radio-label" type="radio" name="action_taken" id="myCheck" value="মামলা" onclick="myFunction()" {{$qrr->action_taken=='মামলা' ? 'checked' : ''}}>
    <label class="button-label" for="myCheck">
      <h1>মামলা</h1>
	   </label>
	  
	     <input class="hidden radio-label" type="radio" name="action_taken" value="স্থানীয় পর্যায়ে মীমাংসা" id="myCheckmim" onclick="myFunction()" {{$qrr->action_taken=='স্থানীয় পর্যায়ে মীমাংসা' ? 'checked' : ''}}>
    <label class="button-label" for="myCheckmim">
      <h1>স্থানীয় পর্যায়ে মীমাংসা</h1>
	   </label>
	   
	       <input class="hidden radio-label" type="radio" name="action_taken" id="myCheckain" value="আইনগত পরামর্শ" onclick="myFunction()" {{$qrr->action_taken=='আইনগত পরামর্শ' ? 'checked' : ''}}>
    <label class="button-label" for="myCheckain">
      <h1>আইনগত পরামর্শ</h1>
    </label>   

                                               
                                               
                                                </div>
                                            </div>
                                            
											
											
											
				

<script>


function myFunction() {

  var checkBoxgd = document.getElementById("myCheckgd");
    var checkBox = document.getElementById("myCheck");
  var checkBoxmim = document.getElementById("myCheckmim");
  var checkBoxain = document.getElementById("myCheckain");
  
      var gd1 = document.getElementById("gd1");
      var gd2 = document.getElementById("gd2");
	   var gd3 = document.getElementById("gd3");
   
     var mam = document.getElementById("mam");
     var mam2 = document.getElementById("mam2");
     var mam3 = document.getElementById("mam3");
     
	 
	var mim = document.getElementById("mim");
     var ain = document.getElementById("ain");
	 
	 
     
   if (checkBox.checked == true){
      mam.style.display = "block";
      mam2.style.display = "block";
      mam3.style.display = "block";
  
  } else {
         mam.style.display = "none";
         mam2.style.display = "none";
         mam3.style.display = "none";
         
     
  }
  
  
  
    if (checkBoxgd.checked == true){
  
      
      gd1.style.display = "block";
      gd2.style.display = "block";
	   gd3.style.display = "block";
  } else {

         
         gd1.style.display = "none";
         gd2.style.display = "none";
         gd3.style.display = "none";
		 
  }
  
  
  
  
  
  
}



</script>

                                            
                                            
                                
								                               <div class="col-sm-4" id="gd1" style="display:none">
                                                <div class="mb-3">
                                                    <label for="gd_no" class="form-label">  জিডি নং   </label>
                                                    <input type="text" name="gd_no"  value="{{$qrr->gd_no}}" id="gd_no" class="form-control  @error('gd_no') is-invalid @enderror" placeholder="  জিডি নং  ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4" id="gd2" style="display:none">
                                                <div class="mb-3">
                                                    <label for="gd_date" class="form-label">  জিডির তারিখ   </label>
                                                    
                                                    <input type="text" name="gd_date"  value="@if (!empty($qrr->gd_date)) {{date('d/m/Y', strtotime($qrr->gd_date))}} @endif" id="gd_date" class="form-control datepicker  @error('gd_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ">

                                                </div>
                                            </div>
											
											   <div class="col-sm-4" id="gd3" style="display:none">
                                              
                                            </div>
											
								
								
								
								
                                            <div class="col-sm-4" id="mam" style="display:none">
                                                <div class="mb-3">
                                                    <label for="case_no" class="form-label">  মামলা নং   </label>
                                                    <input type="text" name="case_no"  value="{{$qrr->case_no}}" id="case_no" class="form-control  @error('case_no') is-invalid @enderror" placeholder="   মামলা নং ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4" id="mam2" style="display:none"> 
                                                <div class="mb-3">
                                                    <label for="case_date" class="form-label"> মামলার  তারিখ  </label>
                                           
                                                    <input type="text" name="case_date"  value="@if (!empty($qrr->case_date)) {{date('d/m/Y', strtotime($qrr->case_date))}} @endif" id="case_date" class="form-control datepicker  @error('case_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ" >
                                                </div>
                                            </div>
      
      
                                             
                                            <div class="col-sm-4" id="mam3" style="display:none">
                                                <div class="mb-3">
                                                    <label for="clause" class="form-label">মামলার ধারা </label>
                                                    <input type="text" name="clause"  value="{{$qrr->clause}}" id="clause" class="form-control  @error('clause') is-invalid @enderror" placeholder=" ধারা">
                                                </div>
												
                                            </div>


                                            
                        
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="nopc" class="form-label"> বাদীর/ সংবাদদাতার নাম </label>
                                                    <input type="text" name="nopc"  value="{{$qrr->nopc}}" id="nopc" class="form-control  @error('nopc') is-invalid @enderror" placeholder="বাদীর/ সংবাদদাতার নাম " >
                                                </div>
                                            </div>
      
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="plaintiff_mobile" class="form-label">  বাদীর মোবাইল নং  </label>
                                                    <input type="text" minlength="11" maxlength="11" name="plaintiff_mobile"  value="{{$qrr->plaintiff_mobile}}" id="plaintiff_mobile" class="form-control  @error('plaintiff_mobile') is-invalid @enderror" placeholder=" বাদীর মোবাইল নং  " >
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="number_of_victims" class="form-label">   ভিকটিমের সংখ্যা   </label>
                                                    <select name="number_of_victims" id="number_of_victims" class="number form-select form-control" >
                                                        <option value="">Select</option>
                                                        @for($i=1; $i<=50; $i++)
                                                        <option value="{{$i}}" {{$qrr->number_of_victims==$i ? 'selected' : ''}}>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="number_of_accused" class="form-label">   এজাহারভুক্ত আসামীর সংখ্যা   </label>
                                                    <select name="number_of_accused" id="number_of_accused" class="number form-select form-control" >
                                                        <option value="">Select</option>
                                                        @for($i=1; $i<=50; $i++)
                                                        <option value="{{$i}}" {{$qrr->number_of_accused==$i ? 'selected' : ''}}>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="name_of_investigator" class="form-label">রেসপন্সকারী/ তদন্তকারী কর্মকর্তার নাম   </label>
                                                    <input type="text" name="name_of_investigator"  value="{{$qrr->name_of_investigator}}" id="name_of_investigator" class="form-control  @error('name_of_investigator') is-invalid @enderror" placeholder=" রেসপন্সকারী/ তদন্তকারী কর্মকর্তার নাম " required>
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="bp_no" class="form-label"> বিপি নং   </label>
                                                    <input type="text" name="bp_no"  value="{{$qrr->bp_no}}" id="bp_no" class="number form-control  @error('bp_no') is-invalid @enderror" placeholder="  বিপি নং " >
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="mobile_no" class="form-label">  মোবাইল নং    </label>
                                                    <input type="text" name="mobile_no" minlength="11" maxlength="11"  value="{{$qrr->mobile_no}}" id="mobile_no" class="number form-control  @error('mobile_no') is-invalid @enderror" placeholder=" মোবাইল নং" required>
                                                </div>
                                            </div>
      
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="image_video" class="form-label">   ছবি/ভিডিও প্রাপ্তি    </label>
                                                    <select name="image_video" id="image_video" class="form-select form-control" >
                                                        <option value="">Select</option>
                                                        <option value="হ্যা"  {{$qrr->image_video=='হ্যা' ? 'selected' : ''}}>হ্যা</option>
                                                        <option value="না"  {{$qrr->image_video=='না' ? 'selected' : ''}}>না</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
      
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="media_quality" class="form-label">   সন্তুষ্টির মান   </label>
                                                    <select name="media_quality" id="media_quality" class="form-select form-control" >
                                                        <option value="">Select</option>
                                                        <option value="সন্তুষ্ট"  {{$qrr->media_quality=='সন্তুষ্ট' ? 'selected' : ''}}> সন্তুষ্ট </option>
                                                        <option value="মোটামুটি সন্তুষ্ট" {{$qrr->media_quality=='মোটামুটি সন্তুষ্ট' ? 'selected' : ''}}>মোটামুটি সন্তুষ্ট</option>
                                                        <option value="অসন্তুষ্ট" {{$qrr->media_quality=='অসন্তুষ্ট' ? 'selected' : ''}}>অসন্তুষ্ট</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
      
                                            
                                            
      
      
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="comments" class="form-label">মন্তব্য</label>
                                                    <textarea name="comments"  class="form-control  @error('comments') is-invalid @enderror" id="address" rows="2" placeholder="মন্তব্য">{{$qrr->comments}}</textarea>
                                                </div>
                                            </div>

                                             <div class="col-sm-12" style="display:none;">
                                                <div class="mb-3">
                                                    <label for="comments" class="form-label">মূল ঘটনা</label>
                                                    <textarea name="main_event"  class="form-control  @error('main_event') is-invalid @enderror" id="address" rows="2" placeholder="Mul gotona">{{$qrr->main_event}}</textarea>
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
                if($qrr->divisionID)
                    $division_id = $qrr->divisionID;
                if($qrr->districtID)
                    $district_id = $qrr->districtID;
                if($qrr->thanaID)
                    $thana_id = $qrr->thanaID;

                @endphp
    <script src="{{ asset('my-assets/admin/js/vue.js') }}"></script>
    <script src="{{ asset('my-assets/admin/js/axios.min.js') }}"></script>





<script>
function datecheckmax(){ 
 
     var sbbtn = document.getElementById("sbbtn");
     
     
      var dix = document.getElementById("date_time_of_incident").value;
      var diy = document.getElementById("date_time_of_police_news").value;
      var diz = document.getElementById("date_time_response").value;
      
      
      var dixx = document.getElementById("date_time_of_incident");
      var diyx = document.getElementById("date_time_of_police_news");
      var dizx = document.getElementById("date_time_response");

        
// const dix = '24/09/2022';
// const diy = '21/09/2022';


var [day, month, year] = dix.split('/');
var resultd1 = [year, month, day].join('/');

var [dayy, monthy, yeary] = diy.split('/');
var resultd2 = [yeary, monthy, dayy].join('/');

var [dayz, monthz, yearz] = diz.split('/');
var resultd3 = [yearz, monthz, dayz].join('/');

var d1 = new Date(resultd1);   
var d2 = new Date(resultd2);   
var d3 = new Date(resultd3);   

var diff = d2.getTime() - d1.getTime();   
var diff2 = d3.getTime() - d2.getTime();   
    
var daydiff = diff / (1000 * 60 * 60 * 24);   
var daydiff2 = diff2 / (1000 * 60 * 60 * 24);   

  
//alert(d3)
if (daydiff<0) {
    sbbtn.disabled = true;
    $('#errdateneg').show();
//alert('Value is negetive')
 dixx.classList.add("redbdr");
 diyx.classList.add("redbdr");


} else {
        sbbtn.disabled = false;
    $('#errdateneg').hide();
     dixx.classList.remove("redbdr");
 diyx.classList.remove("redbdr");

}

if (daydiff2<0) {
    sbbtn.disabled = true;
    $('#errdateneg2').show();
//alert('Value is negetive')
 dizx.classList.add("redbdr");
 diyx.classList.add("redbdr");


} else {
        sbbtn.disabled = false;
    $('#errdateneg2').hide();
     dizx.classList.remove("redbdr");
 diyz.classList.remove("redbdr");

}




  
};
var myInterval = setInterval(datecheckmax, 500);
</script>  











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


<script>
$( document ).ready(function() {
    
    var checkboxes = $("input[type='checkbox']"),
    actions = $("#actions");

    checkboxes.click(function() {
    
       actions.attr("hidden", !checkboxes.is(":checked"));
      
    });
      
});
</script>  


  <script src='https://cdn.rawgit.com/chingyawhao/materialize-clockpicker/master/dist/js/materialize.clockpicker.js'></script>


  <script>
$('.timepicker').keyup(function() {

  var foo = $(this).val().split(" ").join(""); // remove hyphens

  if (foo.length < 3) {
    foo = foo.replace(/^(.{2})(.*)$/, "$1:");
  } 

  $(this).val(foo);
});

</script>


  <script>
  
  
  //Using: https://github.com/chingyawhao/materialize-clockpicker/

//Time Picker:
$('.timepickerx').pickatime({
    default: 'now',
    twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
    donetext: 'OK',
  autoclose: true,
  vibrate: true // vibrate the device when dragging clock hand
});
  </script>
  
                     <x-admin-footer/>



<script>
$(function(){
   $(".number").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errmsg").html("Number Only").stop().show().fadeOut("slow");
      return false;
    }
   });
});
</script>


<script>

function validateHhMm(inputField) {
    var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(inputField.value);


  var sbbtn = document.getElementById("sbbtn");
  
    if (isValid) {
      inputField.style.backgroundColor = '#bfa';
      sbbtn.disabled = false;
       $("#errdate").html("Date format is invalid").stop().hide();
     
    } else {
      inputField.style.backgroundColor = '#fba';
        sbbtn.disabled = true;
         $("#errdate").html("Date format is invalid<br> Use 10:05 format").stop().show();
      return false;
    }

    return isValid;
  }
  
  
</script>
