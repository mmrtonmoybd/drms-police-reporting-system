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

.redbdr {
    border:1px solid red;
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
</style>



    <!-- start page title -->
<br>
  <div id="errmsg"></div>
<div id="errdate"></div>
 <!-- start page title -->
 

                    
                        <x-admin-validation-errors :errors="$errors->all()"/>



<span id="errdateneg">মামলার তারিখ ঘটনার তারিখের থেকে পরে হতে পারবে না </span>
<span id="errdateneg2">নিস্পত্তির তারিখ মামলার তারিখের থেকে পরে হতে পারবে না </span>


                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/case/edit/'.$case->id)}}" method="POST" enctype="multipart/form-data">
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
font-size: 21px;"> মামলা সংক্রান্ত তথ্যাদি এডিট ফরম </div>


                                        <div class="row">

                                       @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "> জেলা </label>
                                                    <select name="districtID" id="districtID" class="form-select form-control @error('districtID') is-invalid @enderror"  v-model="district_id" @change="getCircles()"  required>
                                                        <option value="">Select</option>
                                                        @if($districts)

                                                        @foreach($districts as $district)
                                                        <option value="{{$district->id}}" {{ ( $district->id == $case->districtID) ? 'selected' : '' }}>{{$district->bn_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="circleID" class="form-label">সার্কেল</label>
                                                    <select name="circleID" id="circleID"  v-model="circle_id" class="form-select form-control @error('circleID') is-invalid @enderror" @change="getUpozillasAndThana()" required>
                                                        <option value="">Select</option>
                                                        <option v-for="(circle,key,index) in circles" v-bind:value="circle.id"> @php echo '{{ circle.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label">থানা</label>
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select form-control @error('thanaID') is-invalid @enderror" required>
                                                        <option value="">Select</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>

                                            @elseif(auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="circleID" class="form-label">সার্কেল</label>
                                                    <select name="circleID" id="circleID"  v-model="circle_id" class="form-select form-control @error('circleID') is-invalid @enderror" @change="getUpozillasAndThana()" required>
                                                        <option value="">Select</option>
                                                        @if($circledbs)

                                                        @foreach($circledbs as $circledb)
                                                        <option value="{{$circledb->id}}" {{ ( $circledb->id == $case->circleID) ? 'selected' : '' }}>{{$circledb->name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label">থানা</label>
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select form-control @error('thanaID') is-invalid @enderror" required>
                                                        <option value="">Select</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>

                                            @else 

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label">থানা</label>
                                                    <select name="thanaID" id="thanaID" class="form-select form-control @error('thanaID') is-invalid @enderror" required>
                                                        
                                                        <option value="{{$thanades->id}}" selected>{{$thanades->bn_name}}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            @endif


                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="cdms_pg_id" class="form-label">  মামলার কোড (CDMS)  </label>
                                                    <input type="text" name="cdms_pg_id"  value="{{$case->cdms_pg_id}}" id="cdms_pg_id" class="form-control  @error('cdms_pg_id') is-invalid @enderror" placeholder=" মামলার কোড (CDMS) ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="source_of_info" class="form-label">  তথ্য প্রাপ্তির উৎস </label>
                                                    <select name="source_of_info" id="source_of_info" class="form-select form-control">
                                                        <option value="">Select</option>
                                                        <option value="কোর্ট" {{ ( $case->source_of_info == 'কোর্ট') ? 'selected' : '' }}>কোর্ট</option>
                                                        <option value="থানা" {{ ( $case->source_of_info == 'থানা') ? 'selected' : '' }}>থানা</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_no" class="form-label"> জি আর নং </label>
                                                    <input type="text" name="gr_no"  value="{{$case->gr_no}}" id="gr_no" class="form-control  @error('gr_no') is-invalid @enderror" placeholder="জি আর নং">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="case_no" class="form-label"> মামলা নং </label>
                                                    <input type="text" name="case_no"  value="{{$case->case_no}}" id="case_no" class="form-control  @error('case_no') is-invalid @enderror" placeholder="মামলা নং" >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="dhara" class="form-label"> ধারা </label>
                                                    <input type="text" name="dhara"  value="{{$case->dhara}}" id="" class="form-control  @error('dhara') is-invalid @enderror" placeholder="ধারা" >
                                                </div>
                                            </div>

                                            <div class="col-sm-4"> 
                                                <div class="mb-3">
                                                    <label for="case_date" class="form-label"> মামলার  তারিখ  </label>
                                           
                                                    <input type="text" name="case_date"   value="@if (!empty($case->case_date)) {{date('d/m/Y', strtotime($case->case_date))}} @endif" id="case_date" class="form-control datepicker  @error('case_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ" >
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="caseTypeID" class="form-label "> মামলার ধরন </label>
                                                    <select name="caseTypeID" id="caseTypeID"  onchange="myFunction2()" class="form-select form-control @error('caseTypeID') is-invalid @enderror"  v-model="casetype_id" @change="getCasesubtypes()" >
                                                        <option value="">Select</option>
                                                        @if($caseparenttypes)

                                                        @foreach($caseparenttypes as $ctype)
                                                        <option value="{{$ctype->id}}" {{ ( $ctype->id == $case->caseTypeID) ? 'selected' : '' }}>{{$ctype->type}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-4" id="hidecs">
                                                <div class="mb-3">
                                                    <label for="casesubID" class="form-label">মামলার উপধরন</label>
                                                    <select name="casesubID" id="casesubID"  v-model="casesub_id" class="form-select form-control @error('casesubID') is-invalid @enderror" @change="">
                                                        <option value="">Select</option>
                                                        <option v-for="(casesubtype,key,index) in casesubtypes" v-bind:value="casesubtype.id"> @php echo '{{ casesubtype.type }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4"> 
                                                <div class="mb-3">
                                                    <label for="incident_date_time" class="form-label"> ঘটনার তারিখ  </label>
                                           
                                                    <input type="text" name="incident_date_time"   value="@if (!empty($case->incident_date_time)) {{date('d/m/Y', strtotime($case->incident_date_time))}} @endif" id="incident_date_time" class="form-control datepicker  @error('incident_date_time') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="ঘটনার তারিখ" >
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="azahar_namio_victims" class="form-label"> এজাহার নামীয় আসামির সংখ্যা </label>
                                                    <input type="number"  min="0" name="azahar_namio_victims"  value="{{$case->azahar_namio_victims}}" id="azahar_namio_victims" class="number form-control  @error('azahar_namio_victims') is-invalid @enderror" placeholder="এজাহার নামীয় আসামির সংখ্যা">
                                                </div>
                                            </div>




                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="short_dettails" class="form-label"> মামলার সারসংক্ষেপ </label>
                                                    <textarea type="text" name="short_dettails"   id="short_dettails" class="form-control  @error('short_dettails') is-invalid @enderror" placeholder="মামলার সারসংক্ষেপ"> {{$case->short_dettails}} </textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="nispotti_or_multobi" class="form-label">  নিস্পত্তি / মুলতবি </label>
                                                    <select name="nispotti_or_multobi" id="nispotti_or_multobi"  onchange="myFunction()" class="form-select form-control @error('nispotti_or_multobi') is-invalid @enderror">
                                                        <option value="">Select</option>
                                                        <option value="নিস্পত্তি" {{ ( $case->nispotti_or_multobi == 'নিস্পত্তি') ? 'selected' : '' }}>নিস্পত্তি</option>
                                                        <option value="মুলতবি" {{ ( $case->nispotti_or_multobi == 'মুলতবি') ? 'selected' : '' }}>মুলতবি</option>
                                                    </select>
                                                </div>
                                            </div>


                                  
                                  
                                  
                                  <hr>
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  

                                            <div class="col-sm-4" id="hide1">
                                                <div class="mb-3">
                                                    <label for="nispotti_type" class="form-label">  নিস্পত্তির ধরন </label>
                                                    <select name="nispotti_type" id="nispotti_type" class="form-select form-control @error('nispotti_type') is-invalid @enderror">
                                                        <option value="">Select</option>
                                                        <option value="সিএস" {{ ( $case->nispotti_type == 'সিএস') ? 'selected' : '' }}>সিএস</option>
                                                        <option value="এফআর" {{ ( $case->nispotti_type == 'এফআর') ? 'selected' : '' }}>এফআর</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="hide2"> 
                                                <div class="mb-3">
                                                    <label for="cs_or_fr_no" class="form-label"> সিএস/এফ আর নং </label>
                                                    <input type="text" name="cs_or_fr_no"  value="{{$case->cs_or_fr_no}}" id="cs_or_fr_no" class="form-control  @error('cs_or_fr_no') is-invalid @enderror" placeholder="সিএস/এফ আর নং">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="hide3"> 
                                                <div class="mb-3">
                                                    <label for="nispotti_date" class="form-label"> নিস্পত্তির তারিখ  </label>
                                           
                                                    <input type="text" name="nispotti_date"   value="@if (!empty($case->nispotti_date)) {{date('d/m/Y', strtotime($case->nispotti_date))}} @endif" id="nispotti_date" class="form-control datepicker  @error('nispotti_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="নিস্পত্তির তারিখ" >
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="hide4"> 
                                                <div class="mb-3">
                                                    <label for="police_report_victim" class="form-label"> পুলিশ রিপোর্ট আসামির সংখ্যা </label>
                                                    <input type="number"  min="0"  name="police_report_victim"  value="{{$case->police_report_victim}}" id="police_report_victim" class="number form-control  @error('police_report_victim') is-invalid @enderror" placeholder="পুলিশ রিপোর্ট আসামির সংখ্যা">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="hide5">
                                                <div class="mb-3">
                                                    <label for="number_of_accused" class="form-label"> গ্রেফতারকৃত আসামির সংখ্যা </label>
                                                    <input type="number"  min="0"  name="number_of_accused"  value="{{$case->number_of_accused}}" id="number_of_accused" class="number form-control  @error('number_of_accused') is-invalid @enderror" placeholder="গ্রেফতারকৃত আসামির সংখ্যা">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="hide6">
                                                <div class="mb-3">
                                                    <label for="jamin_prapto" class="form-label"> জামিন প্রাপ্ত </label>
                                                    <input type="number"  min="0"  name="jamin_prapto"  value="{{$case->jamin_prapto}}" id="jamin_prapto" class="number form-control  @error('jamin_prapto') is-invalid @enderror" placeholder="জামিন প্রাপ্ত">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="hide7">
                                                <div class="mb-3">
                                                    <label for="polatok" class="form-label"> পলাতক </label>
                                                    <input type="number"  min="0"  name="polatok"  value="{{$case->polatok}}" id="polatok" class="number form-control  @error('polatok') is-invalid @enderror" placeholder="পলাতক">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="hide8">
                                                <div class="mb-3">
                                                    <label for="azahar_vukto_invistigate" class="form-label"> এজাহার বহির্ভুত তদন্তে প্রাপ্ত </label>
                                                    <input type="number"  min="0"  name="azahar_vukto_invistigate"  value="{{$case->azahar_vukto_invistigate}}" id="azahar_vukto_invistigate" class="number form-control  @error('azahar_vukto_invistigate') is-invalid @enderror" placeholder="এজাহার বহির্ভুত তদন্তে প্রাপ্ত">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="hide9">
                                                <div class="mb-3">
                                                    <label for="ovohoti" class="form-label"> অব্যহিত প্রাপ্ত </label>
                                                    <input type="number"  min="0"  name="ovohoti"  value="{{$case->ovohoti}}" id="ovohoti" class="number form-control  @error('ovohoti') is-invalid @enderror" placeholder="অব্যহিত প্রাপ্ত">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="hide10">
                                                <div class="mb-3">
                                                    <label for="sixtyone_recive" class="form-label"> ১৬১ গ্রহন (পাবলিক) </label>
                                                    <input type="number"  min="0"  name="sixtyone_recive"  value="{{$case->sixtyone_recive}}" id="sixtyone_recive" class="number form-control  @error('sixtyone_recive') is-invalid @enderror" placeholder="১৬১ গ্রহন (পাবলিক)">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="hide11">
                                                <div class="mb-3">
                                                    <label for="sixtyfour_recive" class="form-label"> ১৬৪ গ্রহন </label>
                                                    <input type="number"  min="0"  name="sixtyfour_recive"  value="{{$case->sixtyfour_recive}}" id="sixtyfour_recive" class="number form-control  @error('sixtyfour_recive') is-invalid @enderror" placeholder="১৬৪ গ্রহন">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="hide12">
                                                <div class="mb-3">
                                                    <label for="invistigate_rate" class="form-label">  তদন্তের মান </label>
                                                    <select name="invistigate_rate" id="invistigate_rate" class="form-select form-control @error('invistigate_rate') is-invalid @enderror">
                                                        <option value="">Select</option>
                                                        <option value="অতি উত্তম" {{ ( $case->invistigate_rate == 'অতি উত্তম') ? 'selected' : '' }}>অতি উত্তম</option>
                                                        <option value="উত্তম" {{ ( $case->invistigate_rate == 'উত্তম') ? 'selected' : '' }}>উত্তম</option>
                                                        <option value="চলতিমান" {{ ( $case->invistigate_rate == 'চলতিমান') ? 'selected' : '' }}>চলতিমান</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12" id="hide13">
                                                <div class="mb-3">
                                                    <label for="comment" class="form-label">মন্তব্য</label>
                                                    <textarea name="comment"  class="form-control  @error('comment') is-invalid @enderror" id="comment" rows="2" placeholder="মন্তব্য">{{$case->comment}}</textarea>
                                                </div>
                                            </div>

                             







<script>




  var nispotti_or_multobi = document.getElementById("nispotti_or_multobi").value;
  
      var hide1 = document.getElementById("hide1");
      var hide2 = document.getElementById("hide2");
      var hide3 = document.getElementById("hide3");
      var hide4 = document.getElementById("hide4");
      var hide5 = document.getElementById("hide5");
      var hide6 = document.getElementById("hide6");
      var hide7 = document.getElementById("hide7");
      var hide8 = document.getElementById("hide8");
      var hide9 = document.getElementById("hide9");
      var hide10 = document.getElementById("hide10");
      var hide11 = document.getElementById("hide11");
      var hide12 = document.getElementById("hide12");
      var hide13 = document.getElementById("hide13");
	 
	 
     
   if (nispotti_or_multobi == 'নিস্পত্তি'){
      hide1.style.display = "block";
      hide2.style.display = "block";
      hide3.style.display = "block";
      hide4.style.display = "block";
      hide5.style.display = "block";
      hide6.style.display = "block";
      hide7.style.display = "block";
      hide8.style.display = "block";
      hide9.style.display = "block";
      hide10.style.display = "block";
      hide11.style.display = "block";
      hide12.style.display = "block";
      hide13.style.display = "block";

  
  } else {
      hide1.style.display = "none";
      hide2.style.display = "none";
      hide3.style.display = "none";
      hide4.style.display = "none";
      hide5.style.display = "none";
      hide6.style.display = "none";
      hide7.style.display = "none";
      hide8.style.display = "none";
      hide9.style.display = "none";
      hide10.style.display = "none";
      hide11.style.display = "none";
      hide12.style.display = "none";
      hide13.style.display = "none";
   
         
     
  }
  



function myFunction() {
    
    
  var nispotti_or_multobi = document.getElementById("nispotti_or_multobi").value;
  
      var hide1 = document.getElementById("hide1");
      var hide2 = document.getElementById("hide2");
      var hide3 = document.getElementById("hide3");
      var hide4 = document.getElementById("hide4");
      var hide5 = document.getElementById("hide5");
      var hide6 = document.getElementById("hide6");
      var hide7 = document.getElementById("hide7");
      var hide8 = document.getElementById("hide8");
      var hide9 = document.getElementById("hide9");
      var hide10 = document.getElementById("hide10");
      var hide11 = document.getElementById("hide11");
      var hide12 = document.getElementById("hide12");
      var hide13 = document.getElementById("hide13");
	 
	 
     
   if (nispotti_or_multobi == 'নিস্পত্তি'){
      hide1.style.display = "block";
      hide2.style.display = "block";
      hide3.style.display = "block";
      hide4.style.display = "block";
      hide5.style.display = "block";
      hide6.style.display = "block";
      hide7.style.display = "block";
      hide8.style.display = "block";
      hide9.style.display = "block";
      hide10.style.display = "block";
      hide11.style.display = "block";
      hide12.style.display = "block";
      hide13.style.display = "block";

  
  } else {
      hide1.style.display = "none";
      hide2.style.display = "none";
      hide3.style.display = "none";
      hide4.style.display = "none";
      hide5.style.display = "none";
      hide6.style.display = "none";
      hide7.style.display = "none";
      hide8.style.display = "none";
      hide9.style.display = "none";
      hide10.style.display = "none";
      hide11.style.display = "none";
      hide12.style.display = "none";
      hide13.style.display = "none";
   
         
     
  }
  

  
}



</script>


  
  
              

<script>






function myFunction2() {
    
  var caseTypeID = document.getElementById("caseTypeID").value;
  var hidecs = document.getElementById("hidecs");



//alert(caseTypeID);
   if (caseTypeID == '2'){
      hidecs.style.display = "block";
  } else if (caseTypeID == '4') {
     hidecs.style.display = "block";
  } else if (caseTypeID == '5') {
     hidecs.style.display = "block";
  } else if (caseTypeID == '6') {
     hidecs.style.display = "block";
  } else {
      hidecs.style.display = "none";
  }
  
  
}
var myInterval = setInterval(myFunction2, 500);


</script>



<script>
function datecheckmax(){ 
 
     var sbbtn = document.getElementById("sbbtn");
     
     
      var dix = document.getElementById("incident_date_time").value;
      var diy = document.getElementById("case_date").value;
      var diz = document.getElementById("nispotti_date").value;
      
      
      var dixx = document.getElementById("incident_date_time");
      var diyx = document.getElementById("case_date");
      var dizx = document.getElementById("nispotti_date");

        
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
                        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
                if($case->divisionID) {
                    $division_id = $case->divisionID; 
                }
                if($case->circleID) {
                    $circle_id = $case->circleID;
                }
                if($case->districtID) {
                    $district_id = $case->districtID;
                }
                if($request->input('upazilaID')) {
                    $upozilla_id = $request->input('upazilaID');
                }
                if($case->thanaID) {
                    $thana_id = $case->thanaID; 
                }
                if($case->case_type) { 
                    $casetype_id = $case->case_type; 
                }
                if($case->casesub_type) {
                    $casesub_id = $case->casesub_type; 
                }

            } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
                
                if($case->circleID) {
                    $circle_id = $case->circleID;
                }
                if($case->thanaID) {
                    $thana_id = $case->thanaID; 
                }
                if($case->case_type) { 
                    $casetype_id = $case->case_type; 
                }
                if($case->casesub_type) {
                    $casesub_id = $case->casesub_type; 
                }
            } else {
                if($case->case_type) { 
                    $casetype_id = $case->case_type; 
                }
                if($case->casesub_type) {
                    $casesub_id = $case->casesub_type; 
                } 
            }

                @endphp
    <script src="{{ asset('my-assets/admin/js/vue.js') }}"></script>
    <script src="{{ asset('my-assets/admin/js/axios.min.js') }}"></script>






@if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
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
            circles:null,
            casesubtypes:null,
            
            division_id:'@if(isset($division_id) and $division_id){{$division_id}}@endif',
            district_id:'@if(isset($district_id) and $district_id){{$district_id}}@endif',
            upozilla_id:'@if(isset($upozilla_id) and $upozilla_id){{$upozilla_id}}@endif',
            thana_id:'@if(isset($thana_id) and $thana_id){{$thana_id}}@endif',
            circle_id:'@if(isset($circle_id) and $circle_id){{$circle_id}}@endif',
            casetype_id:'@if(isset($casetype_id) and $casetype_id){{$casetype_id}}@endif',
            casesub_id:'@if(isset($casesub_id) and $casesub_id){{$casesub_id}}@endif',

          },

            created(){
                
                if(this.division_id!=""){
                    this.getDistricts();
                }
                if(this.district_id!=""){
                    this.getUpozillas();
                }
                if(this.circle_id!=""){
                    this.getCircles();
                }
                if(this.casetype_id!=""){
                    this.getCasesubtypes();
                }
                if(this.thana_id!=""){
                    this.getUpozillasAndThana();
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
                        axios.get(this.ajax_url+'/circles/thanas/'+this.circle_id)
                        .then(res => {
                            this.thanas = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },


                getCircles(){
                    if(this.district_id==""){
                   }else{
                        axios.get(this.ajax_url+'/circles/'+this.district_id)
                        .then(res => {
                            this.circles = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },

                getCasesubtypes(){
                    if(this.casetype_id==""){
                   }else{
                        axios.get(this.ajax_url+'/casesub/type/'+this.casetype_id)
                        .then(res => {
                            this.casesubtypes = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },
                

            }

        });

    </script>
@elseif(auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))

<script>
    var app = new Vue({
          el: '#app',
          data: {
            message: 'Hello Vue!',
            ajax_url: '<?php echo url('admin'); ?>',
           
            thanas:null,
            circles:null,
            casesubtypes:null,
            
            thana_id:'@if(isset($thana_id) and $thana_id){{$thana_id}}@endif',
            circle_id:'@if(isset($circle_id) and $circle_id){{$circle_id}}@endif',
            casetype_id:'@if(isset($casetype_id) and $casetype_id){{$casetype_id}}@endif',
            casesub_id:'@if(isset($casesub_id) and $casesub_id){{$casesub_id}}@endif',

          },

            created(){
                
                if(this.circle_id!=""){
                    this.getUpozillasAndThana();
                }
                if(this.casetype_id!=""){
                    this.getCasesubtypes();
                }
                
            },


            methods:{


                getUpozillasAndThana(){
                    //this.getUpozillas();
                    this.getThanas();
                },

                
                //this method for get medicals
                getThanas(){
                    if(this.circle_id==""){
                   }else{
                        axios.get(this.ajax_url+'/circles/thanas/'+this.circle_id)
                        .then(res => {
                            this.thanas = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },


                getCasesubtypes(){
                    if(this.casetype_id==""){
                   }else{
                        axios.get(this.ajax_url+'/casesub/type/'+this.casetype_id)
                        .then(res => {
                            this.casesubtypes = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },
                

            }

        });

    </script>
@else

<script>
    var app = new Vue({
          el: '#app',
          data: {
            message: 'Hello Vue!',
            ajax_url: '<?php echo url('admin'); ?>',
           
            
            casesubtypes:null,
            
        
            casetype_id:'@if(isset($casetype_id) and $casetype_id){{$casetype_id}}@endif',
            casesub_id:'@if(isset($casesub_id) and $casesub_id){{$casesub_id}}@endif',

          },

            created(){
                
                if(this.casetype_id!=""){
                    this.getCasesubtypes();
                }
                
            },


            methods:{


                getCasesubtypes(){
                    if(this.casetype_id==""){
                   }else{
                        axios.get(this.ajax_url+'/casesub/type/'+this.casetype_id)
                        .then(res => {
                            this.casesubtypes = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },
                

            }

        });

    </script>


@endif






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


<x-admin-footer/>

