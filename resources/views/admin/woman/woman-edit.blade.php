<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/woman')}}">Women and children Dashboard</a></li>
                                            <li class="breadcrumb-item active">Edit Women and children Dashboard</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class=" dripicons-document-edit "></i> Edit Women and children Dashboard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/woman/edit/'.$woman->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body" id="app">
                                        <div class="row">

                                        <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="reference_no" class="form-label"> রেফারেন্স নং </label>
                                                    <input type="text" name="reference_no"  value="{{$woman->reference_no}}" id="reference_no" class="form-control  @error('reference_no') is-invalid @enderror" placeholder="রেফারেন্স নং">
                                                </div>
                                            </div>

                                        @if (auth()->user()->hasRole('Super Admin'))
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "> জেলা </label>
                                                    <select name="districtID" id="districtID" class="form-select"  v-model="district_id" @change="getUpozillasAndThana()"  required>
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
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select" required>
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
                                                    <select name="thanaID" id="thanaID" class="form-select" required>
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
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select" required>
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
                                                        <input type="text" name="wdate"  value="{{date('d/m/Y', strtotime($woman->wdate))}}" id="wdate" class="form-control datepicker  @error('wdate') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="আগমনের তারিখ ও সময়  " required>

                                                        <!-- Date dime -->
                                                        <input name="incident_time" id="timepicker" type="text" value="{{date('h:i A', strtotime($woman->wdate))}}" class="form-control timepicker" data-provide="timepicker" required>
                                                    </div>
                                                        
                                                </div>
                                              
                                            </div>

                                            <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="badi_name" class="form-label">  বাদীর নাম   </label>
                                                    <input type="text" name="badi_name"  value="{{$woman->badi_name}}" id="badi_name" class="form-control  @error('badi_name') is-invalid @enderror" placeholder="  বাদীর নাম  ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="badi_age" class="form-label">  বাদীর বয়স   </label>
                                                    <input type="text" name="badi_age"  value="{{$woman->badi_age}}" id="badi_age" class="form-control  @error('badi_age') is-invalid @enderror" placeholder="  বাদীর বয়স  ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="badi_address" class="form-label">  বাদীর ঠিকানা   </label>
                                                    <input type="text" name="badi_address"  value="{{$woman->badi_address}}" id="badi_address" class="form-control  @error('badi_address') is-invalid @enderror" placeholder="  বাদীর ঠিকানা  ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="badi_phone" class="form-label">  বাদীর মোবাইল নং  </label>
                                                    <input type="text" minlength="11" maxlength="11" name="badi_phone"  value="{{$woman->badi_phone}}" id="badi_phone" class="form-control  @error('badi_phone') is-invalid @enderror" placeholder=" বাদীর মোবাইল নং  " >
                                                </div>
                                            </div>

                                             <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="vbadi_name" class="form-label">  বিবাদীর নাম   </label>
                                                    <input type="text" name="vbadi_name"  value="{{$woman->vbadi_name}}" id="vbadi_name" class="form-control  @error('vbadi_name') is-invalid @enderror" placeholder="   বিবাদীর নাম  ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="vbadi_address" class="form-label">  বিবাদীর ঠিকানা   </label>
                                                    <input type="text" name="vbadi_address"  value="{{$woman->vbadi_address}}" id="vbadi_address" class="form-control  @error('vbadi_address') is-invalid @enderror" placeholder="   বিবাদীর ঠিকানা  ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="complaint_reson" class="form-label">  অভিযোগের কারন   </label>
                                                    <input type="text" name="complaint_reson"  value="{{$woman->complaint_reson}}" id="complaint_reson" class="form-control  @error('complaint_reson') is-invalid @enderror" placeholder="   অভিযোগের কারন  ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="investigator_name" class="form-label">  তদন্তকারী কর্মকর্তার নাম   </label>
                                                    <input type="text" name="investigator_name"  value="{{$woman->investigator_name}}" id="investigator_name" class="form-control  @error('investigator_name') is-invalid @enderror" placeholder="  তদন্তকারী কর্মকর্তার নাম  ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="investigator_title" class="form-label">  তদন্তকারী কর্মকর্তার পদবী  </label>
                                                    <input type="text" name="investigator_title"  value="{{$woman->investigator_title}}" id="investigator_title" class="form-control  @error('investigator_title') is-invalid @enderror" placeholder="   তদন্তকারী কর্মকর্তার পদবী  ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="mobile_no" class="form-label"> মোবাইল নং  </label>
                                                    <input type="text" minlength="11" maxlength="11" name="mobile_no"  value="{{$woman->mobile_no}}" id="mobile_no" class="form-control  @error('mobile_no') is-invalid @enderror" placeholder=" মোবাইল নং  " >
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-sm-4" id="gd1" >
                                                <div class="mb-3">
                                                    <label for="gd_no" class="form-label">  জিডি নং   </label>
                                                    <input type="text" name="gd_no"  value="{{$woman->gd_no}}" id="gd_no" class="form-control  @error('gd_no') is-invalid @enderror" placeholder="  জিডি নং  ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4" id="gd2" >
                                                <div class="mb-3">
                                                    <label for="gd_date" class="form-label">  তারিখ   </label>
                                                    
                                                    <input type="text" name="gd_date"  value="{{date('d/m/Y', strtotime($woman->gd_date))}}" id="gd_date" class="form-control datepicker  @error('gd_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ">

                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                
                                            <div class="col-sm-4" id="mam" >
                                                <div class="mb-3">
                                                    <label for="mamla_no" class="form-label">  মামলা নং   </label>
                                                    <input type="text" name="mamla_no"  value="{{$woman->mamla_no}}" id="mamla_no" class="form-control  @error('mamla_no') is-invalid @enderror" placeholder="   মামলা নং ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4" id="mam2" >
                                                <div class="mb-3">
                                                    <label for="mamla_date" class="form-label">  তারিখ  </label>
                                           
                                                    <input type="text" name="mamla_date"  value="{{date('d/m/Y', strtotime($woman->mamla_date))}}" id="mamla_date" class="form-control datepicker  @error('mamla_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ" >
                                                </div>
                                            </div>
      
      
                                             
                                            <div class="col-sm-4" id="mam3">
                                                <div class="mb-3">
                                                    <label for="dhara" class="form-label">ধারা </label>
                                                    <input type="text" name="dhara"  value="{{$woman->dhara}}" id="dhara" class="form-control  @error('dhara') is-invalid @enderror" placeholder=" ধারা">
                                                </div>
                                            </div>


                                             <div class="col-sm-4" id="mam3">
                                                <div class="mb-3">
                                                    <label for="complaint_no" class="form-label">অভিযোগ নং </label>
                                                    <input type="text" name="complaint_no"  value="{{$woman->complaint_no}}" id="complaint_no" class="form-control  @error('complaint_no') is-invalid @enderror" placeholder=" অভিযোগ নং">
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="problem_fix" class="form-label">   সমস্যা সমাধান হয়েছে কিনা    </label>
                                                    <select name="problem_fix" id="problem_fix" class="form-select" >
                                                        <option value="">Select</option>
                                                        <option value="হ্যা" {{$woman->problem_fix=='হ্যা' ? 'selected' : ''}}>হ্যা</option>
                                                        <option value="না" {{$woman->problem_fix=='না' ? 'selected' : ''}}>না</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="action_taken" class="form-label">   গৃহীত ব্যবস্থা    </label>
                                                    <select name="action_taken" id="action_taken" class="form-select" >
                                                        <option value="">Select</option>
                                                        <option value="অভিযোগ গ্রহন" {{$woman->action_taken=='অভিযোগ গ্রহন' ? 'selected' : ''}}>অভিযোগ গ্রহন</option>
                                                        <option value="স্থানীয় মীমাংসা" {{$woman->action_taken=='স্থানীয় মীমাংসা' ? 'selected' : ''}}>স্থানীয় মীমাংসা</option>
                                                        <option value="মামলা" {{$woman->action_taken=='মামলা' ? 'selected' : ''}}>মামলা</option>
                                                        <option value="জিডি" {{$woman->action_taken=='জিডি' ? 'selected' : ''}}>জিডি</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="nreport" class="form-label">   নিষ্পত্তি রিপোর্ট    </label>
                                                    <select name="nreport" id="nreport" class="form-select" >
                                                        <option value="">Select</option>
                                                        <option value="নিষ্পত্তি" {{$woman->nreport == 'নিষ্পত্তি' ? 'selected' : ''}}>নিষ্পত্তি</option>
                                                        <option value="মামলা" {{$woman->nreport == 'মামলা' ? 'selected' : ''}}>মামলা</option>
                                                        <option value="মূলতবি" {{$woman->nreport == 'মূলতবি' ? 'selected' : ''}}>মূলতবি</option>
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


                     <x-admin-footer/>