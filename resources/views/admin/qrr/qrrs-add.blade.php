<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/qrrs')}}">QRR</a></li>
                                            <li class="breadcrumb-item active">Add QRR</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="uil uil-plus"></i> Add QRR</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/qrrs/add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body" id="app">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "> জেলা </label>
                                                    <select name="districtID" id="districtID" class="form-select"  v-model="district_id" @change="getUpozillasAndThana()"  required>
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
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select" required>
                                                        <option value="">Select</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="village_word" class="form-label"> গ্রাম/ওয়ার্ড </label>
                                                    <input type="text" name="village_word"  value="{{old('village_word')}}" id="village_word" class="form-control  @error('village_word') is-invalid @enderror" placeholder="গ্রাম/ওয়ার্ড" required>
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="source_of_info" class="form-label">  তথ্য প্রাপ্তির উৎস </label>
                                                    <select name="source_of_info" id="source_of_info" class="form-select" required>
                                                        <option value="">Select</option>
                                                        <option value="এলাকা"> এলাকা </option>
                                                        <option value="কোর্ট">কোর্ট</option>
                                                        <option value="থানা">থানা</option>
                                                        <option value="৯৯৯">৯৯৯</option>
                                                    </select>
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="date_time_of_incident" class="form-label">   ঘটনার তারিখ ও সময়  </label>
                                                   
                                                    <div class="input-group" id="timepicker-input-group1">
                                                        <input type="text" name="date_time_of_incident"  value="{{old('date_time_of_incident')}}" id="date_time_of_incident" class="form-control datepicker  @error('date_time_of_incident') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="ঘটনার তারিখ ও সময়  " required>

                                                        <!-- Date dime -->
                                                        <input name="incident_time" id="timepicker" type="text" class="form-control timepicker" data-provide="timepicker">
                                                    </div>
                                                        
                                                </div>
                                              
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="date_time_of_police_news" class="form-label">  পুলিশের সংবাদ প্রাপ্তির তারিখ ও সময় </label>
                                                    <div class="input-group" id="timepicker-input-group2">
                                                        <input type="text" name="date_time_of_police_news"  value="{{old('date_time_of_police_news')}}" id="date_time_of_police_news" class="form-control datepicker  @error('date_time_of_police_news') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="সংবাদ প্রাপ্তির তারিখ ও সময়" required>

                                                        <!-- Date dime -->
                                                        <input name="police_news_time" type="text" class="form-control timepicker" data-provide="timepicker" required>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="date_time_response" class="form-label">  রেসপন্সের তারিখ ও সময় </label>
                                                    <div class="input-group" id="timepicker-input-group2">
                                                        <input type="text" name="date_time_response"  value="{{old('date_time_response')}}" id="date_time_response" class="form-control datepicker  @error('date_time_response') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="রেসপন্সের তারিখ ও সময়" required>

                                                        <!-- Date dime -->
                                                        <input name="response_time" type="text" class="form-control timepicker" data-provide="timepicker" required>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="main_event" class="form-label"> মূল ঘটনা  </label>
                                                    
                                                    <textarea name="comments"  class="form-control  @error('main_event') is-invalid @enderror" id="main_event" rows="2" placeholder="মূল ঘটনা" required>{{old('main_event')}}</textarea>
                                                </div>
                                            </div>

                                            
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="event_type" class="form-label">   ঘটনার ধরণ     </label>
                                                    <select name="event_type" id="event_type" class="form-select" required>
                                                        <option value="">Select</option>
                                                        <option value="মারামারি"> মারামারি </option>
                                                        <option value="খুন">খুন</option>
                                                        <option value="চুরি">চুরি</option>
                                                        <option value="ডাকাতি">ডাকাতি</option>
                                                        <option value="সম্পত্তি সংক্রান্ত">সম্পত্তি সংক্রান্ত</option>
                                                        <option value="সড়ক দুর্ঘটনা">সড়ক দুর্ঘটনা</option>
                                                        <option value="নারী ও শিশু">নারী ও শিশু</option>
                                                        <option value="অগ্নিকান্ড">অগ্নিকান্ড</option>
                                                        <option value="মাদক">মাদক</option>
                                                        <option value="সাইবার">সাইবার</option>
                                                        <option value="প্রতারণা">প্রতারণা</option>
                                                        <option value="রাজনৈতিক">রাজনৈতিক</option>
                                                        <option value="অন্যান্য">অন্যান্য</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
      
                                            
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="begening_of_event" class="form-label">  ঘটনার সূত্রপাত  </label>
                                                    <input type="text" name="begening_of_event"  value="{{old('begening_of_event')}}" id="begening_of_event" class="form-control  @error('begening_of_event') is-invalid @enderror" placeholder=" ঘটনার সূত্রপাত " required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gd_no" class="form-label">  জিডি নং   </label>
                                                    <input type="number" name="gd_no"  value="{{old('gd_no')}}" id="gd_no" class="form-control  @error('gd_no') is-invalid @enderror" placeholder="  জিডি নং  ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gd_date" class="form-label">  তারিখ   </label>
                                                    
                                                    <input type="text" name="gd_date"  value="{{old('gd_date')}}" id="gd_date" class="form-control datepicker  @error('gd_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ">

                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="case_no" class="form-label">  মামলা নং   </label>
                                                    <input type="number" name="case_no"  value="{{old('case_no')}}" id="case_no" class="form-control  @error('case_no') is-invalid @enderror" placeholder="   মামলা নং ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="case_date" class="form-label">  তারিখ  </label>
                                           
                                                    <input type="text" name="case_date"  value="{{old('case_date')}}" id="case_date" class="form-control datepicker  @error('case_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ" >
                                                </div>
                                            </div>
      
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="clause" class="form-label">ধারা </label>
                                                    <input type="text" name="clause"  value="{{old('clause')}}" id="clause" class="form-control  @error('clause') is-invalid @enderror" placeholder=" ধারা">
                                                </div>
                                            </div>
      
      
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="nopc" class="form-label"> বাদীর/ সংবাদদাতার নাম </label>
                                                    <input type="text" name="nopc"  value="{{old('nopc')}}" id="nopc" class="form-control  @error('nopc') is-invalid @enderror" placeholder="বাদীর/ সংবাদদাতার নাম " required>
                                                </div>
                                            </div>
      
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="plaintiff_mobile" class="form-label">  বাদীর মোবাইল নং  </label>
                                                    <input type="text" minlength="11" maxlength="11" name="plaintiff_mobile"  value="{{old('plaintiff_mobile')}}" id="plaintiff_mobile" class="form-control  @error('plaintiff_mobile') is-invalid @enderror" placeholder=" বাদীর মোবাইল নং  " required>
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="number_of_victims" class="form-label">   ভিকটিমের সংখ্যা   </label>
                                                    <select name="number_of_victims" id="number_of_victims" class="form-select" required>
                                                        <option value="">Select</option>
                                                        @for($i=1; $i<=50; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="number_of_accused" class="form-label">   এজাহারভুক্ত আসামীর সংখ্যা   </label>
                                                    <select name="number_of_accused" id="number_of_accused" class="form-select" required>
                                                        <option value="">Select</option>
                                                        @for($i=1; $i<=50; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="name_of_investigator" class="form-label">রেসপন্সকারী/ তদন্তকারী কর্মকর্তার নাম   </label>
                                                    <input type="text" name="name_of_investigator"  value="{{old('name_of_investigator')}}" id="name_of_investigator" class="form-control  @error('name_of_investigator') is-invalid @enderror" placeholder=" রেসপন্সকারী/ তদন্তকারী কর্মকর্তার নাম " required>
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="bp_no" class="form-label"> বিপি নং   </label>
                                                    <input type="text" name="bp_no"  value="{{old('bp_no')}}" id="bp_no" class="form-control  @error('bp_no') is-invalid @enderror" placeholder="  বিপি নং " required>
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="mobile_no" class="form-label">  মোবাইল নং    </label>
                                                    <input type="text"   minlength="11" maxlength="11" name="mobile_no"  value="{{old('mobile_no')}}" id="mobile_no" class="form-control  @error('mobile_no') is-invalid @enderror" placeholder=" মোবাইল নং" required>
                                                </div>
                                            </div>
      
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="image_video" class="form-label">   ছবি/ভিডিও প্রাপ্তি    </label>
                                                    <select name="image_video" id="image_video" class="form-select" required>
                                                        <option value="">Select</option>
                                                        <option value="হ্যা">হ্যা</option>
                                                        <option value="না">না</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
      
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="media_quality" class="form-label">   সন্তুষ্টির মান   </label>
                                                    <select name="media_quality" id="media_quality" class="form-select" required>
                                                        <option value="">Select</option>
                                                        <option value="সন্তুষ্ট"> সন্তুষ্ট </option>
                                                        <option value="মোটামুটি সন্তুষ্ট">মোটামুটি সন্তুষ্ট</option>
                                                        <option value="অসন্তুষ্ট">অসন্তুষ্ট</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
      
                                            
                                            
      
      
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="comments" class="form-label">মন্তব্য</label>
                                                    <textarea name="comments"  class="form-control  @error('comments') is-invalid @enderror" id="address" rows="2" placeholder="মন্তব্য">{{old('comments')}}</textarea>
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