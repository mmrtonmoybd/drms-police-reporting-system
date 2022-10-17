<x-admin-header />

<style>
                         
#sms-counter {
	display: block;
	overflow: hidden;
	margin: 0;
	padding: 0;
	list-style: none;
	float: right;
}
#sms-counter li {
	float: right;
	color: #00a65a;
	margin-left: 10px;
	border: 1px solid #DDD;
	padding: 5px;
	margin-bottom: 5px;
}
</style>   
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/sms')}}">Sms Sender</a></li>
                                            <li class="breadcrumb-item active">Send</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="uil uil-plus"></i> Send sms ( Total:- {{$total}} )</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        
                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row" id="app">
                            <div class="col-sm-12">
                                <div class="card card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-sm-end">
                                                <form action="{{url('admin/sms')}}" method="get">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="mb-3">
                                                        <select @change="getBatches()" class="form-select" v-model="course_id" name="course_id" id="course_id">
                                                            <option value="">Select Course</option>
                                                            @if($courses)
                                                            @foreach($courses as $course)
                                                            <option value="{{$course->id}}">{{$course->title}}</option>
                                                            @endforeach
                                                                @endif

                                                        </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="mb-3">
                                                            <select class="form-select" name="batch_id" v-model="batch_id" id="batch_id">
                                                            <option value="">Select Batche</option>
                                                            <option v-for="(batch,key,index) in batches" v-bind:value="batch.id"> @php echo '{{ batch.name }} ( {{ batch.batch_number }} )'; @endphp </option>
                                                            
                                                        </select>
                                                        </div>
                                                    </div>
                                            

                                                    <div class="col-sm-2">
                                                        <div class="mb-3">
                                                            <div class="d-grid">
                                                                <button class="btn btn-primary btn-block" name="submit" value="submit"> 
                                                                    <i class="uil uil-search-alt"></i> 
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div><!-- end col-->
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 ">
                                
                                @php $query = http_build_query($_GET); @endphp
                                <form action="{{url('admin/sms/send?'.$query)}}" method="POST">
                                @csrf
                                    <div class="card card-body">
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="your_phone" class="form-label">Your Phone</label>
                                                    <input type="text" name="your_phone" value="{{old('your_phone')}}" id="your_phone" class="form-control" placeholder="Your phone">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="message" class="form-label">Message</label>
                                                    <ul id="sms-counter">
                                                        <li>Length: <span class="length"></span></li>
                                                        <li>Messages: <span class="messages"></span></li>

                                                    </ul>
                                                    <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Type your text here" required >{{old('message')}}</textarea>
                                                    
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
                if($request->get('course_id'))
                    $course_id = $request->get('course_id');
                if($request->get('batch_id'))
                    $batch_id = $request->get('batch_id');

                @endphp
                
    <script src="{{ asset('my-assets/admin/js/vue.js') }}"></script>
    <script src="{{ asset('my-assets/admin/js/axios.min.js') }}"></script>

  <script>
    var app = new Vue({
          el: '#app',
          data: {
            message: 'Hello Vue!',
            ajax_url: '<?php echo url('admin'); ?>',
           
            batches:null,
            course: [],
            
            course_id:'@if(isset($course_id) and $course_id){{$course_id}}@endif',
            batch_id:'@if(isset($batch_id) and $batch_id){{$batch_id}}@endif',


          },

            created(){
                
                if(this.course_id!=""){
                    this.getBatches();
                }
            },


            methods:{

                
                // send message to account customer
                getBatches(){
                     axios.get(this.ajax_url+'/enrolleds/batches/'+this.course_id)
                    .then(res => {
                        this.batches = res.data.batches;
                        this.course = res.data.course;
                        
                    })
                    .catch(err => {console.log(err); });
                    
                },



            }

        });

    </script>




                     <x-admin-footer />

                     