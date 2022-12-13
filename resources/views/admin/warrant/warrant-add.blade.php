<x-admin-header />
                        
                     
<br>
     
                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                               
                                <form action="{{url('admin/warrant/add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body" id="app">
                                        <div class="row">
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
                                                    <label for="date" class="form-label">  তারিখ   </label>
                                                    
                                                    <input type="text" name="date"  value="" id="date" class="form-control datepicker  "  data-date-format="dd/mm/yyyy"  placeholder="তারিখ" required>

                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  জিআর রিসিভ  </label>
                                                    <input type="text" name="gr_recive"  value="" id="gr_recive" class="form-control  " placeholder="   জিআর রিসিভ " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  সিআর রিসিভ  </label>
                                                    <input type="text" name="cr_recive"  value="" id="cr_recive" class="form-control  " placeholder="   সিআর রিসিভ " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> সাজা জিআর রিসিভ  </label>
                                                    <input type="text" name="saja_gr_recive"  value="" id="saja_gr_recive" class="form-control  " placeholder="   সাজা জিআর রিসিভ " required>
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> সাজা সিআর রিসিভ  </label>
                                                    <input type="text" name="saja_cr_recive"  value="" id="saja_cr_recive" class="form-control  " placeholder="   সাজা সিআর রিসিভ " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  জিআর তামিল  </label>
                                                    <input type="text" name="gr_tamil"  value="" id="gr_tamil" class="form-control  " placeholder="   জিআর তামিল " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  সিআর তামিল  </label>
                                                    <input type="text" name="cr_tamil"  value="" id="cr_tamil" class="form-control  " placeholder="   সিআর তামিল " required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> সাজা জিআর তামিল  </label>
                                                    <input type="text" name="saja_gr_tamil"  value="" id="saja_gr_tamil" class="form-control  " placeholder="   সাজা জিআর তামিল " required>
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> সাজা সিআর তামিল  </label>
                                                    <input type="text" name="saja_cr_tamil"  value="" id="saja_cr_tamil" class="form-control  " placeholder="   সাজা সিআর তামিল " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> রিকল ও অন্যান্য  </label>
                                                    <input type="text" name="recall_other"  value="" id="recall_other" class="form-control  " placeholder="   রিকল ও অন্যান্য " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> নিয়মিত মামলায় গ্রেফতার  </label>
                                                    <input type="number" name="ucase_arrast"  value="" id="ucase_arrast" class="form-control  " placeholder="   নিয়মিত মামলায় গ্রেফতার " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  রুজুকৃত মামলা (মাদক ব্যাতিত) </label>
                                                    <input type="number" name="ruju_case"  value="" id="ruju_case" class="form-control  " placeholder="   রুজুকৃত মামলা (মাদক ব্যাতিত) " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> মামলা নিষ্পত্তি (মাদক ব্যাতিত)  </label>
                                                    <input type="number" name="case_nispotti"  value="" id="case_nispotti" class="form-control  " placeholder="  মামলা নিষ্পত্তি (মাদক ব্যাতিত)  " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> মাদক মামলা রুজু </label>
                                                    <input type="number" name="narcotic_case_ruju"  value="" id="narcotic_case_ruju" class="form-control  " placeholder="  মাদক মামলা রুজু  " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  মাদক মালা নিষ্পত্তি </label>
                                                    <input type="number" name="narcotic_case_nispotti"  value="" id="narcotic_case_nispotti" class="form-control  " placeholder="  মাদক মামলা নিষ্পত্তি  " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> অপমৃত্যু মামলা  </label>
                                                    <input type="number" name="unnatural_death_case"  value="" id="unnatural_death_case" class="form-control  " placeholder="   অপমৃত্যু মামলা " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  অপমৃত্যু জিডি </label>
                                                    <input type="number" name="unnatural_death_gd"  value="" id="unnatural_death_gd" class="form-control  " placeholder=" অপমৃত্যু জিডি   " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> বিট পুলিশিং  </label>
                                                    <input type="number" name="bit_police"  value="" id="bit_police" class="form-control  " placeholder="  বিট পুলিশিং  " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  কমিউনিটি পুলিশিং </label>
                                                    <input type="number" name="comunity_police"  value="" id="comunity_police" class="form-control  " placeholder="  কমিউনিটি পুলিশিং  " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  Student কমিউনিটি পুলিশিং </label>
                                                    <input type="number" name="student_comunity_police"  value="" id="student_comunity_police" class="form-control  " placeholder="  Student কমিউনিটি পুলিশিং  " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  সিআইএমএস এন্ট্রি </label>
                                                    <input type="number" name="cims"  value="" id="cims" class="form-control  " placeholder="  সিআইএমএস এন্ট্রি  " >
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
