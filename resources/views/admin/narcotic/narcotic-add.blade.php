<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/narcotic')}}">Narcotic</a></li>
                                            <li class="breadcrumb-item active">Add Narcotic</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="uil uil-plus"></i> Add Narcotic</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/narcotic/add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body" id="app">
                                        <div class="row">

                                        <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="serial" class="form-label">  ক্রমিক নং   </label>
                                                    <input type="text" name="serial"  value="{{old('serial')}}" id="serial" class="form-control  @error('serial') is-invalid @enderror" placeholder="  ক্রমিক নং  " required>
                                                </div>
                                            </div> 

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="folder_no" class="form-label">  ফোল্ডার নং   </label>
                                                    <input type="text" name="folder_no"  value="{{old('folder_no')}}" id="folder_no" class="form-control  @error('folder_no') is-invalid @enderror" placeholder=" ফোল্ডার নং  " required>
                                                </div>
                                            </div> 

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
                                                    <label for="sdate" class="form-label">   ঘটনার তারিখ  </label>
                                                   
                                                    <div class="input-group" id="timepicker-input-group1">
                                                        <input type="text" name="sdate"  value="{{old('sdate')}}" id="sdate" class="form-control datepicker  @error('sdate') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="ঘটনার তারিখ  " required>
                                                    </div>
                                                        
                                                </div>
                                              
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="case_no" class="form-label">  মামলা নং   </label>
                                                    <input type="text" name="case_no"  value="{{old('case_no')}}" id="case_no" class="form-control  @error('case_no') is-invalid @enderror" placeholder="   মামলা নং " required>
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
                                                    <select name="name_of_investigator_org" id="name_of_investigator_org" class="form-select" required>
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
                                                    <input type="text" name="bp_no"  value="{{old('bp_no')}}" id="bp_no" class="form-control  @error('bp_no') is-invalid @enderror" placeholder="  বিপি নং " required>
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="mobile_no" class="form-label">  মোবাইল নং  </label>
                                                    <input type="text" minlength="11" maxlength="11" name="mobile_no"  value="{{old('mobile_no')}}" id="mobile_no" class="form-control  @error('mobile_no') is-invalid @enderror" placeholder=" মোবাইল নং  " required>
                                                </div>
                                            </div>
      
                                            
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gaza" class="form-label">  গাঁজা (গ্রাম)  </label>
                                                    <input type="text" name="gaza"  value="{{old('gaza')}}" id="gaza" class="form-control  @error('gaza') is-invalid @enderror" placeholder=" গাঁজা (গ্রাম) ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gaza_tree" class="form-label">  গাঁজা গাছ (সংখ্যা)  </label>
                                                    <input type="text" name="gaza_tree"  value="{{old('gaza_tree')}}" id="gaza_tree" class="form-control  @error('gaza_tree') is-invalid @enderror" placeholder=" গাঁজা গাছ (সংখ্যা) ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="yaba" class="form-label">  ইয়াবা (পিচ)  </label>
                                                    <input type="text" name="yaba"  value="{{old('yaba')}}" id="yaba" class="form-control  @error('gaza_tree') is-invalid @enderror" placeholder=" ইয়াবা (পিচ) ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="heroine" class="form-label">  ইরোইন (গ্রাম)  </label>
                                                    <input type="text" name="heroine"  value="{{old('heroine')}}" id="heroine" class="form-control  @error('heroine') is-invalid @enderror" placeholder=" ইরোইন (গ্রাম) ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="fansdel" class="form-label">  ফেনসিডিল (বোতল)  </label>
                                                    <input type="text" name="fansdel"  value="{{old('fansdel')}}" id="fansdel" class="form-control  @error('fansdel') is-invalid @enderror" placeholder=" ফেনসিডিল (বোতল) ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="cholai_alcohol" class="form-label"> চোলাই মদ (লিটার)   </label>
                                                    <input type="text" name="cholai_alcohol"  value="{{old('cholai_alcohol')}}" id="cholai_alcohol" class="form-control  @error('cholai_alcohol') is-invalid @enderror" placeholder=" চোলাই মদ (লিটার) ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="bidesh_alcohol" class="form-label"> বিদেশী মদ (লিটার)   </label>
                                                    <input type="text" name="bidesh_alcohol"  value="{{old('bidesh_alcohol')}}" id="bidesh_alcohol" class="form-control  @error('bidesh_alcohol') is-invalid @enderror" placeholder=" বিদেশী মদ (লিটার) ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="lsd" class="form-label">  এলএসডি (মাইক্রোগ্রাম)  </label>
                                                    <input type="text" name="lsd"  value="{{old('lsd')}}" id="lsd" class="form-control  @error('lsd') is-invalid @enderror" placeholder=" এলএসডি (মাইক্রোগ্রাম) ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="ice" class="form-label">  আইস (মাইক্রোগ্রাম)  </label>
                                                    <input type="text" name="ice"  value="{{old('ice')}}" id="ice" class="form-control  @error('ice') is-invalid @enderror" placeholder=" আইস (মাইক্রোগ্রাম) ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="otherd" class="form-label"> আন্যান্য   </label>
                                                    <input type="text" name="otherd"  value="{{old('otherd')}}" id="otherd" class="form-control  @error('otherd') is-invalid @enderror" placeholder=" আন্যান্য ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="number_of_accused" class="form-label">  গ্রেফতারকৃত আসামীর সংখ্যা   </label>
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
                                                    <label for="accused" class="form-label">  অভিযুক্ত  </label>
                                                    <input type="text" name="accused"  value="{{old('accused')}}" id="accused" class="form-control  @error('accused') is-invalid @enderror" placeholder=" অভিযুক্ত " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="image_video" class="form-label">   ছবি তোলা হয়েছে </label>
                                                    <select name="image_video" id="image_video" class="form-select" required>
                                                        <option value="">Select</option>
                                                        <option value="হ্যা">হ্যা</option>
                                                        <option value="না">না</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="jobdo_list" class="form-label"> জব্দ তালিকা  </label>
                                                    <select name="jobdo_list" id="jobdo_list" class="form-select" required>
                                                        <option value="">Select</option>
                                                        <option value="হ্যা">হ্যা</option>
                                                        <option value="না">না</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="narocotic_test_report" class="form-label">  মাদকের রিপোর্ট প্রাপ্তি ( <font color='red'> নিষ্পত্তি হয়ে থাকলে</font> ) </label>
                                                    <input type="text" name="narocotic_test_report"  value="{{old('narocotic_test_report')}}" id="narocotic_test_report" class="form-control  @error('narocotic_test_report') is-invalid @enderror" placeholder=" মাদকের রিপোর্ট প্রাপ্তি ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="investigate_result" class="form-label">  তদন্তের ফলাফল (CS নং) ( <font color='red'> নিষ্পত্তি হয়ে থাকলে</font> )  </label>
                                                    <input type="text" name="investigate_result"  value="{{old('investigate_result')}}" id="investigate_result" class="form-control  @error('investigate_result') is-invalid @enderror" placeholder=" তদন্তের ফলাফল (CS নং) ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="tdate" class="form-label">  তারিখ ( <font color='red'> নিষ্পত্তি হয়ে থাকলে</font> ) </label>
                                                   
                                                    <div class="input-group" id="timepicker-input-group1">
                                                        <input type="text" name="tdate"  value="{{old('tdate')}}" id="tdate" class="form-control datepicker  @error('tdate') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ  " >
                                                    </div>
                                                        
                                                </div>
                                              
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="comment" class="form-label">মন্তব্য ( <font color='red'> নিষ্পত্তি হয়ে থাকলে</font> ) </label>
                                                    <textarea name="comment"  class="form-control  @error('comment') is-invalid @enderror" id="address" rows="2" placeholder="মন্তব্য">{{old('comment')}}</textarea>
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
