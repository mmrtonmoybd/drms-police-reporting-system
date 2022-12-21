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



#myCheckovi:checked + .button-label {
  background: #2ECC71;
  color: #efefef;
}
#myCheckovi:checked + .button-label:hover {
  background: #29b765;
  color: #e2e2e2;
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
</style>


                        <x-admin-validation-errors :errors="$errors->all()"/>

<br>

  <div id="errmsg"></div>
<div id="errdate"></div>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/woman/edit/'.$woman->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body" id="app">
                                        <div class="row">

                                        <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="reference_no" class="form-label"> থানা রেজিস্টার নং </label>
                                                    <input type="text" name="reference_no"  value="{{$woman->reference_no}}" id="reference_no" class="number form-control  @error('reference_no') is-invalid @enderror" placeholder="থানা রেজিস্টার নং">
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
                                                        <option value="{{$district->id}}"  {{ ( $district->id == $woman->districtID) ? 'selected' : '' }} >{{$district->bn_name}}</option>
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
                                                        <option value="{{$thnsp->id}}" {{ ( $thnsp->id == $woman->thanaID) ? 'selected' : '' }}>{{$thnsp->bn_name}}</option>
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
                                                    <input type="text" name="village_word"  value="{{$woman->village_word}}" id="village_word" class="form-control  @error('village_word') is-invalid @enderror" placeholder="গ্রাম/ওয়ার্ড">
                                                </div>
                                            </div>

                                            
                

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="wdate" class="form-label">   আগমনের তারিখ ও সময়  </label>
                                                   
                                                    <div class="input-group" id="timepicker-input-group1">
                                                        <input type="text" name="wdate"  value="@if (!empty($woman->wdate)) {{date('d/m/Y', strtotime($woman->wdate))}} @endif" id="wdate" class="form-control datepicker  @error('wdate') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="আগমনের তারিখ ও সময়  " required>

                                                        <!-- Date dime -->
                                                        <input name="incident_time" id="timepicker" type="text" value="@if (!empty($woman->wdate)) {{date('H:i', strtotime($woman->wdate))}} @endif" onchange="validateHhMm(this);" class="form-control timepicker" data-provide="timepicker" required>
                                                    </div>
                                                        
                                                </div>
                                              
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="event_type" class="form-label">   ঘটনার ধরণ     </label>
                                                    <select name="event_type" id="event_type" class="form-select form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="মারামারি" {{$woman->event_type=='মারামারি' ? 'selected' : ''}}> মারামারি </option>
                                                        <option value="খুন" {{$woman->event_type=='খুন' ? 'selected' : ''}}>খুন</option>
                                                        <option value="চুরি" {{$woman->event_type=='চুরি' ? 'selected' : ''}}>চুরি</option>
                                                        <option value="ডাকাতি" {{$woman->event_type=='ডাকাতি' ? 'selected' : ''}}>ডাকাতি</option>
                                                        <option value="বিরোধ" {{$woman->event_type=='বিরোধ' ? 'selected' : ''}}>বিরোধ</option>
                                                        <option value="নিখোঁজ-অপহরণ" {{$woman->event_type=='নিখোঁজ-অপহরণ' ? 'selected' : ''}}>নিখোঁজ/ অপহরণ</option>
                                                        <option value="দস্যুতা" {{$woman->event_type=='দস্যুতা' ? 'selected' : ''}}>দস্যুতা</option>
                                                        <option value="জুয়া" {{$woman->event_type=='জুয়া' ? 'selected' : ''}}>জুয়া</option>
                                                        <option value="সড়ক দুর্ঘটনা" {{$woman->event_type=='সড়ক দুর্ঘটনা' ? 'selected' : ''}}>সড়ক দুর্ঘটনা</option>
                                                        <option value="নারী ও শিশু" {{$woman->event_type=='নারী ও শিশু' ? 'selected' : ''}}>নারী ও শিশু</option>
                                                        <option value="অগ্নিকান্ড" {{$woman->event_type=='অগ্নিকান্ড' ? 'selected' : ''}}>অগ্নিকান্ড</option>
                                                        <option value="মাদক" {{$woman->event_type=='মাদক' ? 'selected' : ''}}>মাদক</option>
                                                        <option value="সাইবার" {{$woman->event_type=='সাইবার' ? 'selected' : ''}}>সাইবার</option>
                                                        <option value="প্রতারণা" {{$woman->event_type=='প্রতারণা' ? 'selected' : ''}}>প্রতারণা</option>
                                                        <option value="দুর্ঘটনা" {{$woman->event_type=='দুর্ঘটনা' ? 'selected' : ''}}>দুর্ঘটনা</option>
                                                        <option value="অন্যান্য" {{$woman->event_type=='অন্যান্য' ? 'selected' : ''}}>অন্যান্য</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="begening_of_event" class="form-label">  ঘটনার সূত্রপাত  </label>
                                                    <select name="begening_of_event" id="begening_of_event" class="form-select form-control">
                                                        <option value="">Select</option>
                                                        <option value="জমিজমা" {{$woman->begening_of_event=='জমিজমা' ? 'selected' : ''}}> জমিজমা </option>
                                                        <option value="রাজনৈতিক" {{$woman->begening_of_event=='রাজনৈতিক' ? 'selected' : ''}}>রাজনৈতিক</option>
                                                        <option value="পারিবারিক" {{$woman->begening_of_event=='পারিবারিক' ? 'selected' : ''}}>পারিবারিক</option>
                                                        <option value="তুচ্ছ কারণ" {{$woman->begening_of_event=='তুচ্ছ কারণ' ? 'selected' : ''}}>তুচ্ছ কারণ</option>
                                                        <option value="প্রেম ঘটিত" {{$woman->begening_of_event=='প্রেম ঘটিত' ? 'selected' : ''}}>প্রেম ঘটিত</option>
                                                        <option value="লেনদেন সংক্রান্ত" {{$woman->begening_of_event=='লেনদেন সংক্রান্ত' ? 'selected' : ''}}>লেনদেন সংক্রান্ত</option>
                                                        <option value="অসতর্কতা" {{$woman->begening_of_event=='অসতর্কতা' ? 'selected' : ''}}>অসতর্কতা</option>
                                                        <option value="অন্যান্য" {{$woman->begening_of_event=='অন্যান্য' ? 'selected' : ''}}>অন্যান্য</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="short_dettails" class="form-label">  ঘটনার সংক্ষিপ্ত বিবরন   </label>
                                                    <input type="text" name="short_dettails"  value="{{$woman->short_dettails}}" id="short_dettails" class="form-control  @error('short_dettails') is-invalid @enderror" placeholder="  ঘটনার সংক্ষিপ্ত বিবরন  ">
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="badi_name" class="form-label">  বাদীর নাম   </label>
                                                    <input type="text" name="badi_name"  value="{{$woman->badi_name}}" id="badi_name" class="form-control  @error('badi_name') is-invalid @enderror" placeholder="  বাদীর নাম  ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="victim_type" class="form-label">   ভিকটিমের ধরন   </label>
                                                    <select name="victim_type" id="victim_type" class="form-select form-control" >
                                                        
                                                        <option value="নারী" {{$woman->victim_type=='নারী' ? 'selected' : ''}}> নারী </option>
                                                        <option value="শিশু" {{$woman->victim_type=='শিশু' ? 'selected' : ''}}>শিশু</option>
                                                        <option value="বয়স্ক" {{$woman->victim_type=='বয়স্ক' ? 'selected' : ''}}>বয়স্ক</option>
                                                        <option value="প্রতিবন্ধী" {{$woman->victim_type=='প্রতিবন্ধী' ? 'selected' : ''}}>প্রতিবন্ধী</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-4" >
                                                <div class="mb-3">
                                                    <label for="badi_age" class="form-label">  বাদীর বয়স   </label>
                                                    <input type="text" name="badi_age"  value="{{$woman->badi_age}}" id="badi_age" class="form-control  @error('badi_age') is-invalid @enderror" placeholder="  বাদীর বয়স  ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" >
                                                <div class="mb-3">
                                                    <label for="badi_address" class="form-label">  বাদীর ঠিকানা   </label>
                                                    <input type="text" name="badi_address"  value="{{$woman->badi_address}}" id="badi_address" class="form-control  @error('badi_address') is-invalid @enderror" placeholder="  বাদীর ঠিকানা  ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="badi_phone" class="form-label">  বাদীর মোবাইল নং  </label>
                                                    <input type="text" minlength="11" maxlength="11" name="badi_phone"  value="{{$woman->badi_phone}}" id="badi_phone" class="number form-control  @error('badi_phone') is-invalid @enderror" placeholder=" বাদীর মোবাইল নং  " >
                                                </div>
                                            </div>

                                             <div class="col-sm-4" >
                                                <div class="mb-3">
                                                    <label for="vbadi_name" class="form-label">  বিবাদীর নাম   </label>
                                                    <input type="text" name="vbadi_name"  value="{{$woman->vbadi_name}}" id="vbadi_name" class="form-control  @error('vbadi_name') is-invalid @enderror" placeholder="   বিবাদীর নাম  ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" >
                                                <div class="mb-3">
                                                    <label for="vbadi_address" class="form-label">  বিবাদীর ঠিকানা   </label>
                                                    <input type="text" name="vbadi_address"  value="{{$woman->vbadi_address}}" id="vbadi_address" class="form-control  @error('vbadi_address') is-invalid @enderror" placeholder="   বিবাদীর ঠিকানা  ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" >
                                                <div class="mb-3">
                                                    <label for="complaint_reson" class="form-label">  অভিযুক্তের সংখ্যা   </label>
                                                    <input type="text" name="complaint_reson"  value="{{$woman->complaint_reson}}" id="complaint_reson" class="form-control  @error('complaint_reson') is-invalid @enderror" placeholder="   অভিযুক্তের সংখ্যা  ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4" >
                                                <div class="mb-3">
                                                      <label for="investigator_name" class="form-label">  তদন্তকারী কর্মকর্তার নাম ও পদবি  </label>
                                                    <input type="text" name="investigator_name"  value="{{$woman->investigator_name}}" id="investigator_name" class="form-control  @error('investigator_name') is-invalid @enderror" placeholder="  তদন্তকারী কর্মকর্তার নাম  ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4" >
                                                <div class="mb-3">
                                                  <label for="investigator_title" class="form-label">  তদন্তকারী কর্মকর্তার বিপি নাম্বার  </label>
                                                    <input type="text" name="investigator_title"  value="{{$woman->investigator_title}}" id="investigator_title" class="number form-control  @error('investigator_title') is-invalid @enderror" placeholder="   তদন্তকারী কর্মকর্তার পদবী  ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="mobile_no" class="form-label"> মোবাইল নং  </label>
                                                    <input type="text" minlength="11" maxlength="11" name="mobile_no"  value="{{$woman->mobile_no}}" id="mobile_no" class="number form-control  @error('mobile_no') is-invalid @enderror" placeholder=" মোবাইল নং  " >
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                                      <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="nreport" class="form-label">   নিষ্পত্তি রিপোর্ট    </label>
                                                    <select name="nreport" id="nreport"  onchange="myFunctionxxc()" class="form-select form-control" >
                                                        <option value="">Select</option>
                                                        <option value="নিষ্পত্তি" {{$woman->nreport == 'নিষ্পত্তি' ? 'selected' : ''}}>নিষ্পত্তি</option>
                                    
                                                        <option value="মূলতবি" {{$woman->nreport == 'মূলতবি' ? 'selected' : ''}}>মূলতবি</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            
                                                       
                                                       
                                                       
                                                       
                                                       
                                                       
                      
                                                       
                                                       
                                                       
                                                       
                                                       
                                                       
                                                       
                                                       
                                                       
                                                                                
                                            
                                                    <div class="col-sm-12" id="hide1" >
                                             <hr>
												
                                            </div>
                                            
                                            
                                            
                                            
                                            
                                            
                                         
                                            
                                                <div class="col-sm-12" id="hide2" >
                                                <div class="mb-3">
                                               গৃহীত ব্যবস্থাঃ
                                               &nbsp; &nbsp;
                                               
                                               
                                               
       <input class="hidden radio-label" type="radio" name="action_taken" id="myCheckovi" value="অভিযোগ গ্রহণ" onclick="myFunction()" {{$woman->action_taken=='অভিযোগ গ্রহণ' ? 'checked' : ''}}>
    <label class="button-label" for="myCheckovi">
      <h1>অভিযোগ গ্রহণ</h1>
	   </label>
	   
	   
                                               
  <input class="hidden radio-label" type="radio" name="action_taken" id="myCheckgd" value="জিডি" onclick="myFunction()" {{$woman->action_taken=='জিডি' ? 'checked' : ''}} >
    <label class="button-label" for="myCheckgd">
      <h1>জিডি</h1>
    </label>
	
	
    <input class="hidden radio-label" type="radio" name="action_taken" id="myCheck" value="মামলা" onclick="myFunction()" {{$woman->action_taken=='মামলা' ? 'checked' : ''}}  >
    <label class="button-label" for="myCheck">
      <h1>মামলা</h1>
	   </label>
	  
	     <input class="hidden radio-label" type="radio" name="action_taken" value="স্থানীয় পর্যায়ে মীমাংসা" id="myCheckmim" onclick="myFunction()" {{$woman->action_taken=='স্থানীয় পর্যায়ে মীমাংসা' ? 'checked' : ''}}>
    <label class="button-label" for="myCheckmim">
      <h1>স্থানীয় পর্যায়ে মীমাংসা</h1>
	   </label>
	   
	       <input class="hidden radio-label" type="radio" name="action_taken" id="myCheckain" value="আইনগত পরামর্শ" onclick="myFunction()"     {{$woman->action_taken=='আইনগত পরামর্শ' ? 'checked' : ''}}>
    <label class="button-label" for="myCheckain">
      <h1>আইনগত পরামর্শ</h1>
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
      var gd2 = document.getElementById("gd2");
	   var gd3 = document.getElementById("gd3");
   
     var mam = document.getElementById("mam");
     var mam2 = document.getElementById("mam2");
     var mam3 = document.getElementById("mam3");
     
	 
       var mim = document.getElementById("mim");
       var ain = document.getElementById("ain");
	 
	 
	   var ovi1 = document.getElementById("ovi1");
	   var ovi2 = document.getElementById("ovi2");
       var ovi3 = document.getElementById("ovi3");
     
     
     
   if (checkBoxovi.checked == true){
  
      
      ovi1.style.display = "block";
      ovi2.style.display = "block";
	   ovi3.style.display = "block";
  } else {

         
         ovi1.style.display = "none";
         ovi2.style.display = "none";
         ovi3.style.display = "none";
		 
  }
  
  
     
     
     
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

                                    
                                    
                                    
                                    
                                                                 
                                                       
                                                       
                                                       
                 

<script>




  var nispotti_or_multobi = document.getElementById("nreport").value;
  
      var hide1 = document.getElementById("hide1");
      var hide2 = document.getElementById("hide2");

	 
	 
     
   if (nispotti_or_multobi == 'নিষ্পত্তি'){
      hide1.style.display = "block";
      hide2.style.display = "block";


  
  } else {
      hide1.style.display = "none";
      hide2.style.display = "none";

   
         
     
  }
  



function myFunctionxxc() {
    
    
  var nispotti_or_multobi = document.getElementById("nreport").value;
  
      var hide1 = document.getElementById("hide1");
      var hide2 = document.getElementById("hide2");


	 
     
   if (nispotti_or_multobi == 'নিষ্পত্তি'){
      hide1.style.display = "block";
      hide2.style.display = "block";


  
  } else {
      hide1.style.display = "none";
      hide2.style.display = "none";

   
         
     
  }
  

  
}



</script>

                                      
                                                       
                                                       
                                                       
                                                       
                                                           
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                                              

                                             <div class="col-sm-4" id="ovi1"  {{$woman->action_taken=='অভিযোগ গ্রহণ' ? '' : 'style=display:none'}} >
                                                <div class="mb-3">
                                                    <label for="complaint_no" class="form-label">অভিযোগ নং </label>
                                                    <input type="text" name="complaint_no" value="{{$woman->complaint_no}}"  id="complaint_no" class="number form-control  @error('complaint_no') is-invalid @enderror" placeholder=" অভিযোগ নং">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="ovi2"  {{$woman->action_taken=='অভিযোগ গ্রহণ' ? '' : 'style=display:none'}}  >
                                                <div class="mb-3">
                                                    <label for="complaint_no" class="form-label">অভিযোগ  তারিখ </label>
                                                 <input type="text" name="complaint_date"  value="@if (!empty($woman->complaint_date)) {{date('d/m/Y', strtotime($woman->complaint_date))}} @endif" id="complaint_date" class="form-control datepicker  @error('complaint_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="অভিযোগের তারিখ" >
                                                
                                            
                                              </div>
                                            </div>


                                             <div class="col-sm-4" id="ovi3" style="display:none">
                                              
                                            </div>
											
											
											
                                       <div class="col-sm-4" id="gd1"   {{$woman->action_taken=='জিডি' ? '' : 'style=display:none'}}  >
                                                <div class="mb-3">
                                                    <label for="gd_no" class="form-label">  জিডি নং   </label>
                                                    <input type="text" name="gd_no"  value="{{$woman->gd_no}}"  id="gd_no" class="number form-control  @error('gd_no') is-invalid @enderror" placeholder="  জিডি নং  ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4" id="gd2"   {{$woman->action_taken=='জিডি' ? '' : 'style=display:none'}}  >
                                                <div class="mb-3">
                                                    <label for="gd_date" class="form-label">  তারিখ   </label>
                                                    
                                                    <input type="text" name="gd_date"  value="@if (!empty($woman->gd_date)) {{date('d/m/Y', strtotime($woman->gd_date))}} @endif"  id="gd_date" class="form-control datepicker  @error('gd_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ">

                                                </div>
                                            </div>
                                            
      
                                     
											
											   <div class="col-sm-4" id="gd3" style="display:none">
                                              
                                            </div>
											
								
								
								
					                          
                                
                                            <div class="col-sm-4" id="mam"   {{$woman->action_taken=='মামলা' ? '' : 'style=display:none'}}  >
                                                <div class="mb-3">
                                                    <label for="mamla_no" class="form-label">  মামলা নং   </label>
                                                    <input type="text" name="mamla_no"  value="{{$woman->mamla_no}}" id="mamla_no" class="number form-control  @error('mamla_no') is-invalid @enderror" placeholder="   মামলা নং ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4" id="mam2"   {{$woman->action_taken=='মামলা' ? '' : 'style=display:none'}}  >
                                                <div class="mb-3">
                                                    <label for="mamla_date" class="form-label">  তারিখ  </label>
                                           
                                                    <input type="text" name="mamla_date"  value="@if (!empty($woman->mamla_date)) {{date('d/m/Y', strtotime($woman->mamla_date))}} @endif"  id="mamla_date" class="form-control datepicker  @error('mamla_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ" >
                                                </div>
                                            </div>
      
      
                                             
                                            <div class="col-sm-4" id="mam3"  {{$woman->action_taken=='মামলা' ? '' : 'style=display:none'}}  >
                                                <div class="mb-3">
                                                    <label for="dhara" class="form-label">ধারা </label>
                                                    <input type="text" name="dhara"   value="{{$woman->dhara}}" id="dhara" class="form-control  @error('dhara') is-invalid @enderror" placeholder=" ধারা">
                                                </div>
                                            </div>

      
      
          <div class="col-sm-12" >
                                             <hr>
												
                                            </div>
                                            
                                            
                
                                      



                                            <div class="col-sm-4" style="display:none;">>
                                                <div class="mb-3">
                                                    <label for="problem_fix" class="form-label">   সমস্যা সমাধান হয়েছে কিনা    </label>
                                                    <select name="problem_fix" id="problem_fix" class="form-select form-control" >
                                                        <option value="">Select</option>
                                                        <option value="হ্যা" {{$woman->problem_fix=='হ্যা' ? 'selected' : ''}}>হ্যা</option>
                                                        <option value="না" {{$woman->problem_fix=='না' ? 'selected' : ''}}>না</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                        

                                  

                                             <div class="col-sm-4" >
                                                <div class="mb-3">
                                                    <label for="satisfy_rate" class="form-label">   সন্তুষ্টির মান   </label>
                                                    <select name="satisfy_rate" id="satisfy_rate" class="form-select form-control" >
                                                        <option value="">Select</option>
                                                        <option value="সন্তুষ্ট"  {{$woman->satisfy_rate=='সন্তুষ্ট' ? 'selected' : ''}}> সন্তুষ্ট </option>
                                                        <option value="মোটামুটি সন্তুষ্ট" {{$woman->satisfy_rate=='মোটামুটি সন্তুষ্ট' ? 'selected' : ''}}>মোটামুটি সন্তুষ্ট</option>
                                                        <option value="অসন্তুষ্ট" {{$woman->satisfy_rate=='অসন্তুষ্ট' ? 'selected' : ''}}>অসন্তুষ্ট</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>


                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="comment" class="form-label">মন্তব্য</label>
                                                    <textarea name="comment"  class="form-control  @error('comment') is-invalid @enderror" id="comment" rows="2" placeholder="মন্তব্য">{{$woman->comment}}</textarea>
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
                if($woman->divisionID)
                    $division_id = $woman->divisionID;
                if($woman->districtID)
                    $district_id = $woman->districtID;
                if($woman->thanaID)
                    $thana_id = $woman->thanaID;

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

<script>

$(function() {
  $('#datetimepicker1').datetimepicker({
            format: 'HH:mm'
  });
  
  $('#datetimepicker2').datetimepicker({
            format: 'MM/DD/YYYY HH:mm'
  });
  $('#datetimepicker3').datetimepicker({
      format: 'hh:mm A',
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
/*
$(function(){
   $(".number").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errmsg").html("Number Only").stop().show().fadeOut("slow");
      return false;
    }
   });
});
*/
</script>





<script>


var inputBox = document.getElementById("inputnumber");
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
