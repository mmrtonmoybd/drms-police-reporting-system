<x-admin-header />
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/users')}}">Users</a></li>
                                            <li class="breadcrumb-item active">Edit user</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class=" dripicons-document-edit "></i> Edit User</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <p><b><font color='red'>বিঃদ্রঃ</font> ইউজার এডিট অথবা রোল পরিবর্তন করার সময় নিচের নির্দেশনা মেনে চলুন অন্যথাই <font color='red'> ইউজার সিষ্টেম কাজ করবে নাঃ</font><br>
                                <br>
১.  Super Admin এর জন্য জেলা এবং থানা নির্বাচন করার দরকার নেই।<br>
<br>
২. SP এর জন্য শুধুমাত্র জেলা নির্বাচন করতে হবে।<br>
<br>
৩. SP-Operator 1 এর জন্য শুধুমাত্র জেলা নির্বাচন করতে হবে।<br>
<br>
৪. SP-Operator 2 এর জন্য শুধুমাত্র জেলা নির্বাচন করতে হবে।<br>
<br>
৫. OC এর জন্য জেলা এবং থানা উভয় নির্বাচন করতে হবে।<br>
<br>
৬. OC-Operator 1 এর জন্য জেলা এবং থানা উভয় নির্বাচন করতে হবে।<br>
<br>
৭. OC-Operator 2 এর জন্য জেলা এবং থানা উভয় নির্বাচন করতে হবে।<br>
<br>
৮. OC-Operator 3 এর জন্য জেলা এবং থানা উভয় নির্বাচন করতে হবে।<br></b>
</p>
                                <form action="{{url('admin/users/uedit/'.$user->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body" id="app">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="user_name" class="form-label ">User name</label>
                                                    <input type="text" name="name" id="user_name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="User Name" required >
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">User email</label>
                                                    <input type="email" name="email"  value="{{$user->email}}" id="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="designation" class="form-label">User Designation</label>
                                                    <input type="text" name="designation"  value="{{$user->designation}}" id="designation" class="form-control  @error('designation') is-invalid @enderror" placeholder="Designation" required>
                                                </div>
                                            </div>
                                            
                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="mobile" class="form-label">  Mobile no  </label>
                                                    <input type="text" minlength="11" maxlength="11" name="mobile"  value="{{$user->mobile}}" id="mobile" class="number form-control  @error('mobile') is-invalid @enderror" placeholder=" Mobile no  " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="bp_no" class="form-label">User BP No</label>
                                                    <input type="text" name="bp_no"  value="{{$user->bp_no}}" id="bp_no" class="form-control  @error('bp_no') is-invalid @enderror" placeholder="BP No" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="type" class="form-label "> Role </label>
                                                    <select name="type" id="type" class="form-select form-control" required  >
                                                        <option value="">Select</option>
                                                        

                                                        @foreach($roles as $role)
                                                        <option value="{{$role->name}}"  {{ ($user->hasRole($role->name)) ? 'selected' : '' }} >{{$role->name}}</option>
                                                        @endforeach
                                                
                                                    </select>
                                                </div>
                                            </div>

                                        

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "> জেলা </label>
                                                    <select name="districtID" id="districtID" class="form-select form-control"  v-model="district_id" @change="getUpozillasAndThana()"  >
                                                        <option value="">Select</option>
                                                        @if($districts)

                                                        @foreach($districts as $district)
                                                        <option value="{{$district->id}}"  {{ ( $district->id == $user->districtID) ? 'selected' : '' }} >{{$district->bn_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label">থানা</label>
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select form-control">
                                                        <option value="">Select</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>

                                    
                                        

                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password" >
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="confirm-password" class="form-label">Confirm password</label>
                                                    <input type="password" name="confirm-password" id="confirm-password" class="form-control  @error('password') is-invalid @enderror" placeholder="Confirm Password" >
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
                if($user->divisionID)
                    $division_id = $user->divisionID;
                if($user->districtID)
                    $district_id = $user->districtID;
                if($user->thanaID)
                    $thana_id = $user->thanaID;

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