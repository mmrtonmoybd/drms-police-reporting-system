<x-admin-header />

<!-- start page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/qrrs')}}">Qrrs</a></li>
                                            <li class="breadcrumb-item active">All Qrrs</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="dripicons-scale"></i> Qrrs</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">

                            <form action="{{url('admin/qrrs/charts')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body" id="app">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "> জেলা </label>
                                                    <select name="districtID" id="districtID" class="form-select"  v-model="district_id" @change="getUpozillasAndThana()"  >
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
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select" >
                                                        <option value="">Select</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="source_of_info" class="form-label"> উৎস </label>
                                                    <select name="source_of_info" id="source_of_info" class="form-select">
                                                        <option value="">Select</option>
                                                        <option value="এলাকা"> এলাকা </option>
                                                        <option value="কোর্ট">কোর্ট</option>
                                                        <option value="থানা">থানা</option>
                                                        <option value="৯৯৯">৯৯৯</option>
                                                    </select>
                                                </div>
                                            </div>

                                            


                                            <div class="input-group" id="timepicker-input-group2">
                                                <label for="source_of_info" class="form-label"> Date </label>
                                                        <input type="text" name="form"  value="{{old('form')}}" id="date_time_response" class="form-control datepicker  @error('form') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="date start" >
                                                        <input type="text" name="to"  value="{{old('to')}}" id="date_time_response" class="form-control datepicker  @error('to') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="date end" >

                                        
                                                    </div>
                                            
                                            
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                
                                </form>
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        
                            
                                               
                                            

                                            <div id="chart_div"></div>
                                            <div id="piechart"></div>
                                            <div id="chart_div2"></div>
                                            <div class="btn-group" role="group" aria-label="...">
  <a href="{{url('admin/qrrs/report/মারামারি')}}" class="btn btn-danger">মারামারি</a>
  <a href="{{url('admin/qrrs/report/খুন')}}" class="btn btn-danger">খুন</a>
  <a href="{{url('admin/qrrs/report/চুরি')}}" class="btn btn-danger">চুরি</a>
  <a href="{{url('admin/qrrs/report/ডাকাতি')}}" class="btn btn-danger">ডাকাতি</a>
  <a href="{{url('admin/qrrs/report/সম্পত্তি সংক্রান্ত')}}" class="btn btn-danger">সম্পত্তি সংক্রান্ত</a>
  <a href="{{url('admin/qrrs/report/সড়ক দুর্ঘটনা')}}" class="btn btn-danger">সড়ক দুর্ঘটনা</a>
  <a href="{{url('admin/qrrs/report/নারী ও শিশু')}}" class="btn btn-danger">নারী ও শিশু</a>
  <a href="{{url('admin/qrrs/report/অগ্নিকান্ড')}}" class="btn btn-danger">অগ্নিকান্ড</a>
  <a href="{{url('admin/qrrs/report/মাদক')}}" class="btn btn-danger">মাদক</a>
  <a href="{{url('admin/qrrs/report/সাইবার')}}" class="btn btn-danger">সাইবার</a>
  <a href="{{url('admin/qrrs/report/প্রতারণা')}}" class="btn btn-danger">প্রতারণা</a>
  <a href="{{url('admin/qrrs/report/রাজনৈতিক')}}" class="btn btn-danger">রাজনৈতিক</a>
  <a href="{{url('admin/qrrs/report/অন্যান্য')}}" class="btn btn-danger">অন্যান্য</a>
</div>

                                            <h3>Total incident: {{$tin}}</h3>
                                            <h3>Total case taken: {{$tcat}}</h3>

                                            <nav class="mt-3">

                            
                                      
                                        </nav>
                                    </div>
                                </div>
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

