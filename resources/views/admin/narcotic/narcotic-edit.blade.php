<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/narcotic')}}">Narcotic</a></li>
                                            <li class="breadcrumb-item active">Edit narcotic</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class=" dripicons-document-edit "></i> Edit narcotic</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/narcotic/edit/'.$nar->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body" id="app">
                                        <div class="row">
                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="serial" class="form-label">  ক্রমিক নং </label>
                                                    <input type="text" name="serial"  value="{{$nar->serial}}" id="serial" class="form-control  @error('serial') is-invalid @enderror" placeholder="  ক্রমিক নং  " required>
                                                </div>
                                            </div> 

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="folder_no" class="form-label">  ফোল্ডার নং   </label>
                                                    <input type="text" name="folder_no"  value="{{$nar->folder_no}}" id="folder_no" class="form-control  @error('folder_no') is-invalid @enderror" placeholder=" ফোল্ডার নং  " required>
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
                                                        <option value="{{$district->id}}"  {{ ( $district->id == $nar->districtID) ? 'selected' : '' }} >{{$district->bn_name}}</option>
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
                                                    <select name="thanaID" id="thanaID" class="form-select form-control" required>
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
                                                    <input type="text" name="village_word"  value="{{$nar->village_word}}" id="village_word" class="form-control  @error('village_word') is-invalid @enderror" placeholder="গ্রাম/ওয়ার্ড" required>
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="sdate" class="form-label">   ঘটনার তারিখ  </label>
                                                   
                                                    <div class="input-group" id="timepicker-input-group1">
                                                        <input type="text" name="sdate"  value="{{date('d/m/Y', strtotime($nar->sdate))}}" id="sdate" class="form-control datepicker  @error('sdate') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="ঘটনার তারিখ  " required>
                                                    </div>
                                                        
                                                </div>
                                              
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="case_no" class="form-label">  মামলা নং   </label>
                                                    <input type="text" name="case_no"  value="{{$nar->case_no}}" id="case_no" class="form-control  @error('case_no') is-invalid @enderror" placeholder="   মামলা নং " required>
                                                </div>
                                            </div>
      
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="nopc" class="form-label">ধারা </label>
                                                    <input type="text" name="nopc"  value="{{$nar->nopc}}" id="nopc" class="form-control  @error('nopc') is-invalid @enderror" placeholder=" ধারা" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="name_of_investigator_org" class="form-label">   অভিযান পরিচালনাকারী সংস্থা     </label>
                                                    <select name="name_of_investigator_org" id="name_of_investigator_org" class="form-select form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="থানা পুলিশ" {{$nar->name_of_investigator_org=='থানা পুলিশ' ? 'selected' : '' }}> থানা পুলিশ </option>
                                                        <option value="ডিবি" {{$nar->name_of_investigator_org=='ডিবি' ? 'selected' : '' }}>ডিবি</option>
                                                        <option value="র‍্যাব" {{$nar->name_of_investigator_org=='র‍্যাব' ? 'selected' : '' }}>র‍্যাব</option>
                                                        <option value="এপিবিএন" {{$nar->name_of_investigator_org=='এপিবিএন' ? 'selected' : '' }}>এপিবিএন</option>
                                                        <option value="মাদকদ্রব্য নিয়ন্ত্রণ অধিদপ্তর" {{$nar->name_of_investigator_org=='মাদকদ্রব্য নিয়ন্ত্রণ অধিদপ্তর' ? 'selected' : '' }}>মাদকদ্রব্য নিয়ন্ত্রণ অধিদপ্তর</option>
                                                        <option value="কোস্টগার্ড" {{$nar->name_of_investigator_org=='কোস্টগার্ড' ? 'selected' : '' }}>কোস্টগার্ড</option>
                                                        <option value="অন্যান্য" {{$nar->name_of_investigator_org=='অন্যান্য' ? 'selected' : '' }}>অন্যান্য</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="name_of_investigator" class="form-label">অভিযান পরিচালনাকারী অফিসার   </label>
                                                    <input type="text" name="name_of_investigator"  value="{{$nar->name_of_investigator}}" id="name_of_investigator" class="form-control  @error('name_of_investigator') is-invalid @enderror" placeholder=" অভিযান পরিচালনাকারী অফিসার " required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="bp_no" class="form-label"> বিপি নং   </label>
                                                    <input type="text" name="bp_no"  value="{{$nar->bp_no}}" id="bp_no" class="form-control  @error('bp_no') is-invalid @enderror" placeholder="  বিপি নং " required>
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="mobile_no" class="form-label">  মোবাইল নং  </label>
                                                    <input type="text" minlength="11" maxlength="11" name="mobile_no"  value="{{$nar->mobile_no}}" id="mobile_no" class="form-control  @error('mobile_no') is-invalid @enderror" placeholder=" মোবাইল নং  " required>
                                                </div>
                                            </div>
      
                                            
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gaza" class="form-label">  গাঁজা (গ্রাম)  </label>
                                                    <input type="text" name="gaza"  value="{{$nar->gaza}}" id="gaza" class="form-control  @error('gaza') is-invalid @enderror" placeholder=" গাঁজা (গ্রাম) ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gaza_tree" class="form-label">  গাঁজা গাছ (সংখ্যা)  </label>
                                                    <input type="text" name="gaza_tree"  value="{{$nar->gaza_tree}}" id="gaza_tree" class="form-control  @error('gaza_tree') is-invalid @enderror" placeholder=" গাঁজা গাছ (সংখ্যা) ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="yaba" class="form-label">  ইয়াবা (পিচ)  </label>
                                                    <input type="text" name="yaba"  value="{{$nar->yaba}}" id="yaba" class="form-control  @error('gaza_tree') is-invalid @enderror" placeholder=" ইয়াবা (পিচ) ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="heroine" class="form-label">  ইরোইন (গ্রাম)  </label>
                                                    <input type="text" name="heroine"  value="{{$nar->heroine}}" id="heroine" class="form-control  @error('heroine') is-invalid @enderror" placeholder=" ইরোইন (গ্রাম) ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="fansdel" class="form-label">  ফেনসিডিল (বোতল)  </label>
                                                    <input type="text" name="fansdel"  value="{{$nar->fansdel}}" id="fansdel" class="form-control  @error('fansdel') is-invalid @enderror" placeholder=" ফেনসিডিল (বোতল) ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="cholai_alcohol" class="form-label"> চোলাই মদ (লিটার)   </label>
                                                    <input type="text" name="cholai_alcohol"  value="{{$nar->cholai_alcohol}}" id="cholai_alcohol" class="form-control  @error('cholai_alcohol') is-invalid @enderror" placeholder=" চোলাই মদ (লিটার) ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="bidesh_alcohol" class="form-label"> বিদেশী মদ (লিটার)   </label>
                                                    <input type="text" name="bidesh_alcohol"  value="{{$nar->bidesh_alcohol}}" id="bidesh_alcohol" class="form-control  @error('bidesh_alcohol') is-invalid @enderror" placeholder=" বিদেশী মদ (লিটার) ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="lsd" class="form-label">  এলএসডি (মাইক্রোগ্রাম)  </label>
                                                    <input type="text" name="lsd"  value="{{$nar->lsd}}" id="lsd" class="form-control  @error('lsd') is-invalid @enderror" placeholder=" এলএসডি (মাইক্রোগ্রাম) ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="ice" class="form-label">  আইস (মাইক্রোগ্রাম)  </label>
                                                    <input type="text" name="ice"  value="{{$nar->ice}}" id="ice" class="form-control  @error('ice') is-invalid @enderror" placeholder=" আইস (মাইক্রোগ্রাম) ">
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="otherd" class="form-label"> আন্যান্য   </label>
                                                    <input type="text" name="otherd"  value="{{$nar->otherd}}" id="otherd" class="form-control  @error('otherd') is-invalid @enderror" placeholder=" আন্যান্য ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="number_of_accused" class="form-label">  গ্রেফতারকৃত আসামীর সংখ্যা   </label>
                                                    <select name="number_of_accused" id="number_of_accused" class="form-select form-control" required>
                                                        <option value="">Select</option>
                                                        @for($i=1; $i<=50; $i++)
                                                        <option value="{{$i}}" {{$nar->number_of_accused==$i ? 'selected' : ''}}>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="accused" class="form-label">  অভিযুক্ত  </label>
                                                    <input type="text" name="accused"  value="{{$nar->accused}}" id="accused" class="form-control  @error('accused') is-invalid @enderror" placeholder=" অভিযুক্ত " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="image_video" class="form-label">   ছবি তোলা হয়েছে </label>
                                                    <select name="image_video" id="image_video" class="form-select form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="হ্যা" {{$nar->image_video=='হ্যা' ? 'selected' : '' }}>হ্যা</option>
                                                        <option value="না" {{$nar->image_video=='না' ? 'selected' : '' }}>না</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="jobdo_list" class="form-label"> জব্দ তালিকা  </label>
                                                    <select name="jobdo_list" id="jobdo_list" class="form-select form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="হ্যা" {{$nar->jobdo_list=='হ্যা' ? 'selected' : '' }}>হ্যা</option>
                                                        <option value="না" {{$nar->jobdo_list=='না' ? 'selected' : '' }}>না</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="narocotic_test_report" class="form-label">  মাদকের রিপোর্ট প্রাপ্তি ( <font color='red'> নিষ্পত্তি হয়ে থাকলে</font> ) </label>
                                                    <input type="text" name="narocotic_test_report"  value="{{$nar->narocotic_test_report}}" id="narocotic_test_report" class="form-control  @error('narocotic_test_report') is-invalid @enderror" placeholder=" মাদকের রিপোর্ট প্রাপ্তি ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="investigate_result" class="form-label">  তদন্তের ফলাফল (CS নং) ( <font color='red'> নিষ্পত্তি হয়ে থাকলে</font> )  </label>
                                                    <input type="text" name="investigate_result"  value="{{$nar->investigate_result}}" id="investigate_result" class="form-control  @error('investigate_result') is-invalid @enderror" placeholder=" তদন্তের ফলাফল (CS নং) ">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="tdate" class="form-label">  তারিখ ( <font color='red'> নিষ্পত্তি হয়ে থাকলে</font> ) </label>
                                                   
                                                    <div class="input-group" id="timepicker-input-group1">
                                                        <input type="text" name="tdate"  value="@if (!empty($nar->tdate)) {{date('d/m/Y', strtotime($nar->tdate)) }} @endif" id="tdate" class="form-control datepicker  @error('tdate') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ  " >
                                                    </div>
                                                        
                                                </div>
                                              
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="comment" class="form-label">মন্তব্য ( <font color='red'> নিষ্পত্তি হয়ে থাকলে</font> ) </label>
                                                    <textarea name="comment"  class="form-control  @error('comment') is-invalid @enderror" id="address" rows="2" placeholder="মন্তব্য">{{$nar->comment}}</textarea>
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
                if($nar->divisionID)
                    $division_id = $nar->divisionID;
                if($nar->districtID)
                    $district_id = $nar->districtID;
                if($nar->thanaID)
                    $thana_id = $nar->thanaID;

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