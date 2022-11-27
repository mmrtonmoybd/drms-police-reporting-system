<x-admin-header />
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/woman/add')}}">Women and children Dashboard</a></li>
                                            <li class="breadcrumb-item active">Add Women and children Dashboard</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="uil uil-plus"></i> Add Women and children Dashboard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/woman/add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body" id="app">
                                        <div class="row">

                                        <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="reference_no" class="form-label"> রেফারেন্স নং </label>
                                                    <input type="text" name="reference_no"  value="{{old('reference_no')}}" id="reference_no" class="form-control  @error('reference_no') is-invalid @enderror" placeholder="রেফারেন্স নং">
                                                </div>
                                            </div>

                                        @if (auth()->user()->hasRole('Super Admin'))
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
                                                    <input type="text" name="village_word"  value="{{old('village_word')}}" id="village_word" class="form-control  @error('village_word') is-invalid @enderror" placeholder="গ্রাম/ওয়ার্ড">
                                                </div>
                                            </div>

                                            
                

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="wdate" class="form-label">   আগমনের তারিখ ও সময়  </label>
                                                   
                                                    <div class="input-group" id="timepicker-input-group1">
                                                        <input type="text" name="wdate"  value="{{old('wdate')}}" id="wdate" class="form-control datepicker  @error('wdate') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="আগমনের তারিখ ও সময়  " required>

                                                    

                                                        <!-- Date dime -->
                                                                <input  name="incident_time"  id="timepicker" value="00:00"  class="form-control timepicker" type="text" required>
                                                    </div>
                                                        
                                                </div>
                                              
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="event_type" class="form-label">   ঘটনার ধরণ     </label>
                                                    <select name="event_type" id="event_type" class="form-select form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="মারামারি"> মারামারি </option>
                                                        <option value="খুন">খুন</option>
                                                        <option value="চুরি">চুরি</option>
                                                        <option value="ডাকাতি">ডাকাতি</option>
                                                        <option value="বিরোধ">বিরোধ</option>
                                                        <option value="দস্যুতা">দস্যুতা</option>
                                                        <option value="নিখোঁজ-অপহরণ">নিখোঁজ/ অপহরণ</option>
                                                        <option value="জুয়া">জুয়া</option>
                                                        <option value="সড়ক দুর্ঘটনা">সড়ক দুর্ঘটনা</option>
                                                        <option value="নারী ও শিশু">নারী ও শিশু</option>
                                                        <option value="অগ্নিকান্ড">অগ্নিকান্ড</option>
                                                        <option value="মাদক">মাদক</option>
                                                        <option value="সাইবার">সাইবার</option>
                                                        <option value="প্রতারণা">প্রতারণা</option>
                                                        <option value="রাজনৈতিক">দুর্ঘটনা</option>
                                                        <option value="অন্যান্য">অন্যান্য</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="begening_of_event" class="form-label">  ঘটনার সূত্রপাত  </label>
                                                    <select name="begening_of_event" id="begening_of_event" class="form-select form-control">
                                                        <option value="">Select</option>
                                                        <option value="জমিজমা"> জমিজমা </option>
                                                        <option value="রাজনৈতিক">রাজনৈতিক</option>
                                                        <option value="পারিবারিক">পারিবারিক</option>
                                                        <option value="তুচ্ছ কারণ">তুচ্ছ কারণ</option>
                                                        <option value="প্রেম ঘটিত">প্রেম ঘটিত</option>
                                                        <option value="লেনদেন সংক্রান্ত">লেনদেন সংক্রান্ত</option>
                                                        <option value="অসতর্কতা">অসতর্কতা</option>
                                                        <option value="অন্যান্য">অন্যান্য</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="short_dettails" class="form-label">  ঘটনার সংক্ষিপ্ত বিবরন   </label>
                                                    <textarea type="text" name="short_dettails"  value="" id="short_dettails" class="form-control  " placeholder="  ঘটনার সংক্ষিপ্ত বিবরন  "> </textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="badi_name" class="form-label">  বাদীর নাম   </label>
                                                    <input type="text" name="badi_name"  value="{{old('badi_name')}}" id="badi_name" class="form-control  @error('badi_name') is-invalid @enderror" placeholder="  বাদীর নাম  ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="badi_age" class="form-label">  বাদীর বয়স   </label>
                                                    <input type="text" name="badi_age"  value="{{old('badi_age')}}" id="badi_age" class="form-control  @error('badi_age') is-invalid @enderror" placeholder="  বাদীর বয়স  ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="badi_address" class="form-label">  বাদীর ঠিকানা   </label>
                                                    <input type="text" name="badi_address"  value="{{old('badi_address')}}" id="badi_address" class="form-control  @error('badi_address') is-invalid @enderror" placeholder="  বাদীর ঠিকানা  ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="badi_phone" class="form-label">  বাদীর মোবাইল নং  </label>
                                                    <input type="text" minlength="11" maxlength="11" name="badi_phone"  value="{{old('badi_phone')}}" id="badi_phone" class="form-control  @error('badi_phone') is-invalid @enderror" placeholder=" বাদীর মোবাইল নং  " >
                                                </div>
                                            </div>

                                             <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="vbadi_name" class="form-label">  বিবাদীর নাম   </label>
                                                    <input type="text" name="vbadi_name"  value="{{old('vbadi_name')}}" id="vbadi_name" class="form-control  @error('vbadi_name') is-invalid @enderror" placeholder="   বিবাদীর নাম  ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="vbadi_address" class="form-label">  বিবাদীর ঠিকানা   </label>
                                                    <input type="text" name="vbadi_address"  value="{{old('vbadi_address')}}" id="vbadi_address" class="form-control  @error('vbadi_address') is-invalid @enderror" placeholder="   বিবাদীর ঠিকানা  ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="complaint_reson" class="form-label">  অভিযোগের কারন   </label>
                                                    <input type="text" name="complaint_reson"  value="{{old('complaint_reson')}}" id="complaint_reson" class="form-control  @error('complaint_reson') is-invalid @enderror" placeholder="   অভিযোগের কারন  ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="investigator_name" class="form-label">  তদন্তকারী কর্মকর্তার নাম   </label>
                                                    <input type="text" name="investigator_name"  value="{{old('investigator_name')}}" id="investigator_name" class="form-control  @error('investigator_name') is-invalid @enderror" placeholder="  তদন্তকারী কর্মকর্তার নাম  ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="investigator_title" class="form-label">  তদন্তকারী কর্মকর্তার পদবী  </label>
                                                    <input type="text" name="investigator_title"  value="{{old('investigator_title')}}" id="investigator_title" class="form-control  @error('investigator_title') is-invalid @enderror" placeholder="   তদন্তকারী কর্মকর্তার পদবী  ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="mobile_no" class="form-label"> মোবাইল নং  </label>
                                                    <input type="text" minlength="11" maxlength="11" name="mobile_no"  value="{{old('mobile_no')}}" id="mobile_no" class="form-control  @error('mobile_no') is-invalid @enderror" placeholder=" মোবাইল নং  " >
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="gd_no" class="form-label">  জিডি নং   </label>
                                                    <input type="text" name="gd_no"  value="{{old('gd_no')}}" id="gd_no" class="form-control  @error('gd_no') is-invalid @enderror" placeholder="  জিডি নং  ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4" id="gd2" >
                                                <div class="mb-3">
                                                    <label for="gd_date" class="form-label">  তারিখ   </label>
                                                    
                                                    <input type="text" name="gd_date"  value="{{old('gd_date')}}" id="gd_date" class="form-control datepicker  @error('gd_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ">

                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                
                                            <div class="col-sm-4" id="mam" >
                                                <div class="mb-3">
                                                    <label for="mamla_no" class="form-label">  মামলা নং   </label>
                                                    <input type="text" name="mamla_no"  value="{{old('mamla_no')}}" id="mamla_no" class="form-control  @error('mamla_no') is-invalid @enderror" placeholder="   মামলা নং ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4" id="mam2" >
                                                <div class="mb-3">
                                                    <label for="mamla_date" class="form-label">  তারিখ  </label>
                                           
                                                    <input type="text" name="mamla_date"  value="{{old('mamla_date')}}" id="mamla_date" class="form-control datepicker  @error('mamla_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ" >
                                                </div>
                                            </div>
      
      
                                             
                                            <div class="col-sm-4" id="mam3">
                                                <div class="mb-3">
                                                    <label for="dhara" class="form-label">ধারা </label>
                                                    <input type="text" name="dhara"  value="{{old('dhara')}}" id="dhara" class="form-control  @error('dhara') is-invalid @enderror" placeholder=" ধারা">
                                                </div>
                                            </div>


                                             <div class="col-sm-4" id="mam3">
                                                <div class="mb-3">
                                                    <label for="complaint_no" class="form-label">অভিযোগ নং </label>
                                                    <input type="text" name="complaint_no"  value="{{old('complaint_no')}}" id="complaint_no" class="form-control  @error('complaint_no') is-invalid @enderror" placeholder=" অভিযোগ নং">
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="problem_fix" class="form-label">   সমস্যা সমাধান হয়েছে কিনা    </label>
                                                    <select name="problem_fix" id="problem_fix" class="form-select form-control" >
                                                        <option value="">Select</option>
                                                        <option value="হ্যা">হ্যা</option>
                                                        <option value="না">না</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="action_taken" class="form-label">   গৃহীত ব্যবস্থা    </label>
                                                    <select name="action_taken" id="action_taken" class="form-select form-control" >
                                                        <option value="">Select</option>
                                                        <option value="অভিযোগ গ্রহন">অভিযোগ গ্রহন</option>
                                                        <option value="স্থানীয় মীমাংসা">স্থানীয় মীমাংসা</option>
                                                        <option value="মামলা">মামলা</option>
                                                        <option value="জিডি">জিডি</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="nreport" class="form-label">   নিষ্পত্তি রিপোর্ট    </label>
                                                    <select name="nreport" id="nreport" class="form-select form-control" >
                                                        <option value="">Select</option>
                                                        <option value="নিষ্পত্তি">নিষ্পত্তি</option>
                                                        <option value="মামলা">মামলা</option>
                                                        <option value="মূলতবি">মূলতবি</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="satisfy_rate" class="form-label">   সন্তুষ্টির মান   </label>
                                                    <select name="satisfy_rate" id="satisfy_rate" class="form-select form-control" >
                                                        <option value="">Select</option>
                                                        <option value="সন্তুষ্ট"> সন্তুষ্ট </option>
                                                        <option value="মোটামুটি সন্তুষ্ট">মোটামুটি সন্তুষ্ট</option>
                                                        <option value="অসন্তুষ্ট">অসন্তুষ্ট</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>


                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="comment" class="form-label">মন্তব্য</label>
                                                    <textarea name="comment"  class="form-control  @error('comment') is-invalid @enderror" id="comment" rows="2" placeholder="মন্তব্য">{{old('comment')}}</textarea>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
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


function myFunction() {
  var checkBox = document.getElementById("myCheck");
  
  var checkBoxgd = document.getElementById("myCheckgd");
  
      var gd1 = document.getElementById("gd1");
      var gd2 = document.getElementById("gd2");
   
     var mam = document.getElementById("mam");
     var mam2 = document.getElementById("mam2");
     var mam3 = document.getElementById("mam3");
     
     
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
  } else {

         
         gd1.style.display = "none";
         gd2.style.display = "none";
  }
  
  
  
  
  
  
}



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


<x-admin-footer/>
