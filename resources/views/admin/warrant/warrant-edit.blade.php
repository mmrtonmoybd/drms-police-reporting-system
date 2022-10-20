<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/warrant')}}">Warrants</a></li>
                                            <li class="breadcrumb-item active">Edit Warrant</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class=" dripicons-document-edit "></i> Edit Warrant</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="d-flex justify-content-between align-items-center breaking-news bg-white">
                <div class="d-flex flex-row flex-grow-1 flex-fill justify-content-center bg-danger py-2 text-white px-1 news"><span class="d-flex align-items-center">Danger Warning</span></div>
                <marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();"> <span class="dot"><font color='red'><h2> All Input Must Be English Character</h2></font></span>
                </marquee>
            </div>
                                <form action="{{url('admin/warrant/edit/'.$war->id)}}" method="POST" enctype="multipart/form-data">
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
                                                        <option value="{{$district->id}}"  {{ ( $district->id == $war->districtID) ? 'selected' : '' }} >{{$district->bn_name}}</option>
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
                                                    <label for="date" class="form-label">  তারিখ   </label>
                                                    
                                                    <input type="text" name="date"  value="{{date('d/m/Y', strtotime($war->date))}}" id="date" class="form-control datepicker @error('date') is-invalid @enderror  "  data-date-format="dd/mm/yyyy"  placeholder="তারিখ" required>

                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  জিআর রিসিভ  </label>
                                                    <input type="text" name="gr_recive"  value="{{$war->gr_recive}}" id="gr_recive" class="form-control  @error('gr_recive') is-invalid @enderror" placeholder="   জিআর রিসিভ " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  সিআর রিসিভ  </label>
                                                    <input type="text" name="cr_recive"  value="{{$war->cr_recive}}" id="cr_recive" class="form-control  @error('cr_recive') is-invalid @enderror" placeholder="   সিআর রিসিভ " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> সাজা জিআর রিসিভ  </label>
                                                    <input type="text" name="saja_gr_recive"  value="{{$war->saja_gr_recive}}" id="saja_gr_recive" class="form-control  @error('saja_gr_recive') is-invalid @enderror" placeholder="   সাজা জিআর রিসিভ " required>
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> সাজা সিআর রিসিভ  </label>
                                                    <input type="text" name="saja_cr_recive"  value="{{$war->saja_cr_recive}}" id="saja_cr_recive" class="form-control  @error('saja_cr_recive') is-invalid @enderror" placeholder="   সাজা সিআর রিসিভ " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  জিআর তামিল  </label>
                                                    <input type="text" name="gr_tamil"  value="{{$war->gr_tamil}}" id="gr_tamil" class="form-control  @error('gr_tamil') is-invalid @enderror" placeholder="   জিআর তামিল " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">   সিআর তামিল  </label>
                                                    <input type="text" name="cr_tamil"  value="{{$war->cr_tamil}}" id="cr_tamil" class="form-control  @error('cr_tamil') is-invalid @enderror" placeholder="   সিআর তামিল " required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> সাজা জিআর তামিল  </label>
                                                    <input type="text" name="saja_gr_tamil"  value="{{$war->saja_gr_tamil}}" id="saja_gr_tamil" class="form-control  @error('saja_gr_tamil') is-invalid @enderror" placeholder="  সাজা জিআর তামিল " required>
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> সাজা সিআর তামিল  </label>
                                                    <input type="text" name="saja_cr_tamil"  value="{{$war->saja_cr_tamil}}" id="saja_cr_tamil" class="form-control  @error('saja_cr_tamil') is-invalid @enderror" placeholder="   সাজা সিআর তামিল " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> রিকল ও অন্যান্য  </label>
                                                    <input type="text" name="recall_other"  value="{{$war->recall_other}}" id="recall_other" class="form-control  @error('recall_other') is-invalid @enderror" placeholder="   রিকল ও অন্যান্য " required>
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
                if($war->divisionID)
                    $division_id = $war->divisionID;
                if($war->districtID)
                    $district_id = $war->districtID;
                if($war->thanaID)
                    $thana_id = $war->thanaID;

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