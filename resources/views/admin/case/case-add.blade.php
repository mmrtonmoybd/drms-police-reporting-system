<x-admin-header />

<script src="https://code.jquery.com/jquery-latest.min.js"></script>

  <link rel='stylesheet' href='https://cdn.rawgit.com/chingyawhao/materialize-clockpicker/master/dist/css/materialize.clockpicker.css'>



<style>

body {
	overflow:auto!important;
}


.redbdr {
    border:1px solid red;
}
#errdateneg{
background: #ff5757;
color: #fff;
padding: 4px;
display: none;
width: 250px;
position: fixed;
z-index: 100;
right: 10px;
  
}
</style>

    <!-- start page title -->
<br>

 <!-- start page title -->
 

                    
                        <x-admin-validation-errors :errors="$errors->all()"/>


<span id="errdateneg">মামলার তারিখ ঘটনার তারিখের থেকে পরে হতে পারবে না </span>
                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/case/add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body" id="app">
                                        <div class="row">

                                      @if (auth()->user()->hasRole('Super Admin'))
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "> জেলা </label>
                                                    <select name="districtID" id="districtID" class="form-select form-control @error('districtID') is-invalid @enderror"  v-model="district_id" @change="getCircles()"  required>
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
                                                    <label for="circleID" class="form-label">সার্কেল</label>
                                                    <select name="circleID" id="circleID"  v-model="circle_id" class="form-select form-control @error('circleID') is-invalid @enderror" @change="getUpozillasAndThana()" required>
                                                        <option value="">Select</option>
                                                        <option v-for="(circle,key,index) in circles" v-bind:value="circle.id"> @php echo '{{ circle.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label">থানা</label>
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select form-control @error('thanaID') is-invalid @enderror" required>
                                                        <option value="">Select</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>
                                            @elseif(auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="circleID" class="form-label">সার্কেল</label>
                                                    <select name="circleID" id="circleID"  v-model="circle_id" class="form-select form-control @error('circleID') is-invalid @enderror" @change="getUpozillasAndThana()" required>
                                                        <option value="">Select</option>
                                                        @if($circledbs)

                                                        @foreach($circledbs as $circledb)
                                                        <option value="{{$circledb->id}}">{{$circledb->name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label">থানা</label>
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select form-control @error('thanaID') is-invalid @enderror" required>
                                                        <option value="">Select</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>
                                            @else
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label">থানা</label>
                                                    <select name="thanaID" id="thanaID" class="form-select form-control @error('thanaID') is-invalid @enderror" required>
                                                        
                                                        <option value="{{$thanades->id}}" selected>{{$thanades->bn_name}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @endif


                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="cdms_pg_id" class="form-label"> মামলার কোড (CDMS) </label>
                                                    <input type="text" name="cdms_pg_id"  value="{{old('cdms_pg_id')}}" id="cdms_pg_id" class="form-control  @error('cdms_pg_id') is-invalid @enderror" placeholder="মামলার কোড (CDMS)">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="source_of_info" class="form-label">  তথ্য প্রাপ্তির উৎস </label>
                                                    <select name="source_of_info" id="source_of_info" class="form-select form-control">
                                                        <option value="">Select</option>
                                                        <option value="কোর্ট">কোর্ট</option>
                                                        <option value="থানা">থানা</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_no" class="form-label"> জি আর নং </label>
                                                    <input type="text" name="gr_no"  value="{{old('gr_no')}}" id="gr_no" class="form-control  @error('gr_no') is-invalid @enderror" placeholder="জি আর নং">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="case_no" class="form-label"> মামলা নং </label>
                                                    <input type="text" name="case_no"  value="{{old('case_no')}}" id="case_no" class="form-control  @error('case_no') is-invalid @enderror" placeholder="মামলা নং" >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="dhara" class="form-label"> ধারা </label>
                                                    <input type="text" name="dhara"  value="{{old('dhara')}}" id="" class="form-control  @error('dhara') is-invalid @enderror" placeholder="ধারা" >
                                                </div>
                                            </div>

                                            <div class="col-sm-4"> 
                                                <div class="mb-3">
                                                    <label for="case_date" class="form-label"> মামলার  তারিখ  </label>
                                           
                                                    <input type="text" name="case_date" value="{{old('case_date')}}" id="case_date" class="form-control datepicker  @error('case_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ" >
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="caseTypeID" class="form-label "> মামলার ধরন </label>
                                                    <select name="caseTypeID" id="caseTypeID"  onchange="myFunction2()" class="form-select form-control @error('caseTypeID') is-invalid @enderror"  v-model="casetype_id" @change="getCasesubtypes()" >
                                                        <option value="">Select</option>
                                                        @if($caseparenttypes)

                                                        @foreach($caseparenttypes as $ctype)
                                                        <option value="{{$ctype->id}}">{{$ctype->type}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-4" id="hidecs">
                                                <div class="mb-3">
                                                    <label for="casesubID" class="form-label">মামলার উপধরন</label>
                                                    <select name="casesubID" id="casesubID"  v-model="casesub_id" class="form-select form-control @error('casesubID') is-invalid @enderror" @change="">
                                                        <option value="">Select</option>
                                                        <option v-for="(casesubtype,key,index) in casesubtypes" v-bind:value="casesubtype.id"> @php echo '{{ casesubtype.type }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4"> 
                                                <div class="mb-3">
                                                    <label for="incident_date_time" class="form-label"> ঘটনার তারিখ  </label>
                                           
                                                    <input type="text" name="incident_date_time"   value="{{old('incident_date_time')}}" id="incident_date_time" class="form-control datepicker  @error('incident_date_time') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="ঘটনার তারিখ" >
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                                   <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="azahar_namio_victims" class="form-label"> এজাহার নামীয় আসামির সংখ্যা </label>
                                                    <input type="number" name="azahar_namio_victims"  value="{{old('azahar_namio_victims')}}" id="azahar_namio_victims" class="form-control  @error('azahar_namio_victims') is-invalid @enderror" placeholder="এজাহার নামীয় আসামির সংখ্যা">
                                                </div>
                                            </div>





                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="short_dettails" class="form-label"> মামলার সারসংক্ষেপ </label>
                                                    <textarea type="text" name="short_dettails"  id="short_dettails" class="form-control  @error('short_dettails') is-invalid @enderror" placeholder="মামলার সারসংক্ষেপ">{{old('short_dettails')}} </textarea>
                                              
                                              
                                                </div>
                                            </div>

                                     

                                            <div class="col-sm-12">
                                                <div>
                                                       <button type="submit" id="sbbtn" name="submit" class="btn btn-primary"> Submit </button>
                                                </div>
                                                
                                            </div>

                                  
                                        </div>
                                    </div>
     
                                </form>
                                
                                
                                
                            </div>
                        </div>
                        
                        
                        
                        
              
              
              
              

<script>





function myFunction2() {
    
  var caseTypeID = document.getElementById("caseTypeID").value;
  var hidecs = document.getElementById("hidecs");

//alert(caseTypeID);
   if (caseTypeID == '2'){
      hidecs.style.display = "block";
  } else if (caseTypeID == '4') {
     hidecs.style.display = "block";
  } else if (caseTypeID == '5') {
     hidecs.style.display = "block";
  } else if (caseTypeID == '6') {
     hidecs.style.display = "block";
  } else {
      hidecs.style.display = "none";
  }
  
  
}
var myInterval = setInterval(myFunction2, 500);



</script>


              
              
              
              
<script>



function datecheckmax(){ 
 


     var sbbtn = document.getElementById("sbbtn");
      var dix = document.getElementById("incident_date_time").value;
      var diy = document.getElementById("case_date").value;
      
         var dixx = document.getElementById("incident_date_time");
         var diyx = document.getElementById("case_date");
// const dix = '24/09/2022';
// const diy = '21/09/2022';


var [day, month, year] = dix.split('/');
var resultd1 = [year, month, day].join('/');




var [dayy, monthy, yeary] = diy.split('/');
var resultd2 = [yeary, monthy, dayy].join('/');


 


var d1 = new Date(resultd1);   
var d2 = new Date(resultd2);   



var diff = d2.getTime() - d1.getTime();   
    
var daydiff = diff / (1000 * 60 * 60 * 24);   

  

if (daydiff<0) {
    sbbtn.disabled = true;
    $('#errdateneg').show();
//alert('Value is negetive')
 dixx.classList.add("redbdr");
 diyx.classList.add("redbdr");

}else {
        sbbtn.disabled = false;
    $('#errdateneg').hide();
         dixx.classList.remove("redbdr");
 diyx.classList.remove("redbdr");
   
}




  
};
var myInterval = setInterval(datecheckmax, 500);






</script>  

                        
                        
                        
                        <!-- end row -->
                        @php
                        if (auth()->user()->hasRole('Super Admin')) {
                if($request->input('divisionID')) {
                    $division_id = $request->input('divisionID'); 
                }
                if($request->input('circleID')) {
                    $circle_id = $request->input('circleID');
                }
                if($request->input('districtID')) {
                    $district_id = $this->input('districtID');
                }
                if($request->input('upazilaID')) {
                    $upozilla_id = $request->input('upazilaID');
                }
                if($request->input('thanaID')) {
                    $thana_id = $request->input('thanaID'); 
                }
                if($request->input('caseTypeID')) { 
                    $casetype_id = $request->input('caseTypeID'); 
                }
                if($request->input('casesubID')) {
                    $casesub_id = $request->input('casesubID'); 
                }

            } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
                
                if($request->input('circleID')) {
                    $circle_id = $request->input('circleID');
                }
                if($request->input('thanaID')) {
                    $thana_id = $request->input('thanaID'); 
                }
                if($request->input('caseTypeID')) { 
                    $casetype_id = $request->input('caseTypeID'); 
                }
                if($request->input('casesubID')) {
                    $casesub_id = $request->input('casesubID'); 
                }
            } else {
               
                if($request->input('caseTypeID')) { 
                    $casetype_id = $request->input('caseTypeID'); 
                }
                if($request->input('casesubID')) {
                    $casesub_id = $request->input('casesubID'); 
                } 
            }

                @endphp
    <script src="{{ asset('my-assets/admin/js/vue.js') }}"></script>
    <script src="{{ asset('my-assets/admin/js/axios.min.js') }}"></script>






@if (auth()->user()->hasRole('Super Admin'))
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
            circles:null,
            casesubtypes:null,
            
            division_id:'@if(isset($division_id) and $division_id){{$division_id}}@endif',
            district_id:'@if(isset($district_id) and $district_id){{$district_id}}@endif',
            upozilla_id:'@if(isset($upozilla_id) and $upozilla_id){{$upozilla_id}}@endif',
            thana_id:'@if(isset($thana_id) and $thana_id){{$thana_id}}@endif',
            circle_id:'@if(isset($circle_id) and $circle_id){{$circle_id}}@endif',
            casetype_id:'@if(isset($casetype_id) and $casetype_id){{$casetype_id}}@endif',
            casesub_id:'@if(isset($casesub_id) and $casesub_id){{$casesub_id}}@endif',

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
                        axios.get(this.ajax_url+'/circles/thanas/'+this.circle_id)
                        .then(res => {
                            this.thanas = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },


                getCircles(){
                    if(this.district_id==""){
                   }else{
                        axios.get(this.ajax_url+'/circles/'+this.district_id)
                        .then(res => {
                            this.circles = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },

                getCasesubtypes(){
                    if(this.casetype_id==""){
                   }else{
                        axios.get(this.ajax_url+'/casesub/type/'+this.casetype_id)
                        .then(res => {
                            this.casesubtypes = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },
                

            }

        });

    </script>
@elseif(auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))

<script>
    var app = new Vue({
          el: '#app',
          data: {
            message: 'Hello Vue!',
            ajax_url: '<?php echo url('admin'); ?>',
           
            thanas:null,
            circles:null,
            casesubtypes:null,
            
            thana_id:'@if(isset($thana_id) and $thana_id){{$thana_id}}@endif',
            circle_id:'@if(isset($circle_id) and $circle_id){{$circle_id}}@endif',
            casetype_id:'@if(isset($casetype_id) and $casetype_id){{$casetype_id}}@endif',
            casesub_id:'@if(isset($casesub_id) and $casesub_id){{$casesub_id}}@endif',

          },

            created(){
                
                if(this.circle_id!=""){
                    this.getUpozillasAndThana();
                }
                if(this.casetype_id!=""){
                    this.getCasesubtypes();
                }
                
            },


            methods:{


                getUpozillasAndThana(){
                    //this.getUpozillas();
                    this.getThanas();
                },

                
                //this method for get medicals
                getThanas(){
                    if(this.circle_id==""){
                   }else{
                        axios.get(this.ajax_url+'/circles/thanas/'+this.circle_id)
                        .then(res => {
                            this.thanas = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },


                getCasesubtypes(){
                    if(this.casetype_id==""){
                   }else{
                        axios.get(this.ajax_url+'/casesub/type/'+this.casetype_id)
                        .then(res => {
                            this.casesubtypes = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },
                

            }

        });

    </script>

@else

<script>
    var app = new Vue({
          el: '#app',
          data: {
            message: 'Hello Vue!',
            ajax_url: '<?php echo url('admin'); ?>',
           
            
            casesubtypes:null,
            
        
            casetype_id:'@if(isset($casetype_id) and $casetype_id){{$casetype_id}}@endif',
            casesub_id:'@if(isset($casesub_id) and $casesub_id){{$casesub_id}}@endif',

          },

            created(){
                
                if(this.casetype_id!=""){
                    this.getCasesubtypes();
                }
                
            },


            methods:{


                getCasesubtypes(){
                    if(this.casetype_id==""){
                   }else{
                        axios.get(this.ajax_url+'/casesub/type/'+this.casetype_id)
                        .then(res => {
                            this.casesubtypes = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },
                

            }

        });

    </script>

@endif
<x-admin-footer/>

