<x-admin-header />
                          <script src="https://code.jquery.com/jquery-latest.min.js"></script>
                     
                                      
                 
<style>

body {
	overflow:auto!important;
}




#errmsg{
background: #ff5757;
color: #fff;
padding: 4px;
display: none;
width: 250px;
position: fixed;
z-index: 100;
right: 10px;
  
}

#errdate{
background: #ff5757;
color: #fff;
padding: 4px;
display: none;
width: 250px;
position: fixed;
z-index: 100;
right: 10px;
  
}



.clockpicker-display-column {
  float: left;
  top: -3px;
  position: absolute;
  right: 57px;
}
.picker__footer button {
    background: #639;
border: 1px solid #5d0eac;
margin: 0px 5px!important;
padding: 5px 10px;
color: #fff;
border-radius: 5px;
}

.picker__footer {
  text-align: right;
}


.clockpicker-display-column button {
  float: left;
  top: -3px;
  position: absolute;
  right: 57px;
}


.clockpicker.picker.picker--opened {
  position: absolute;
  z-index: 1000;
  top: 50px;
  box-shadow: 0px 1px 8px -1px #7265c885;
  padding: 10px;
  background: #fff;
}
.button-label {
  display: inline-block;
padding:5px 10px;
width:;
  margin: 0.5em;
  cursor: pointer;
  color: #292929;
  border-radius: 0.25em;
  background: #efefef;
  border: 1px solid #ddd;
  transition: 0.3s;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}
.button-label h1 {
  font-size: 14px;
  text-align: center;

}
.button-label:hover {
  background: #d6d6d6;
  color: #101010;
  border: 1px solid #147fdd;
 
}
.button-label:active {
  transform: translateY(2px);
 
}
@media (max-width: 40em) {
  .button-label {
    padding: 0em 1em 3px;
    margin: 0.25em;
  }
}



#myCheckovi:checked + .button-label {
  background: #0C2DB0;
  color: #efefef;
}
#myCheckovi:checked + .button-label:hover {
  background: #0C2DB0;
  color: #e2e2e2;
}




#myCheckgd:checked + .button-label {
  background: #0C2DB0;
  color: #efefef;
}
#myCheckgd:checked + .button-label:hover {
  background: #0C2DB0;
  color: #e2e2e2;
}






#myCheck:checked + .button-label {
  background: #0C2DB0;
  color: #efefef;
}
#myCheck:checked + .button-label:hover {
  background: #0C2DB0;
  color: #e2e2e2;
}




#myCheckmim:checked + .button-label {
  background: #0C2DB0;
  color: #efefef;
}
#myCheckmim:checked + .button-label:hover {
  background: #0C2DB0;
  color: #e2e2e2;
}







#myCheckain:checked + .button-label {
  background: #0C2DB0;
  color: #efefef;
}
#myCheckain:checked + .button-label:hover {
  background: #0C2DB0;
  color: #e2e2e2;
}

input:checked + .button-label h1{
  color: #fff;
}


#nogd:checked + .button-label {
  background: #D91E18;
  color: #efefef;
}
#nogd:checked + .button-label:hover {
  background: #c21b15;
  color: #e2e2e2;
}



#no:checked + .button-label {
  background: #D91E18;
  color: #fff;
}
#no:checked + .button-label:hover {
  background: #c21b15;
  color: #e2e2e2;
}


#maybe-button:checked + .button-label {
  background: #4183D7;
  color: #efefef;
}
#maybe-button:checked + .button-label:hover {
  background: #2c75d2;
  color: #e2e2e2;
}


.hidden {
  display: none;
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


#errdateneg2{
background: #ff5757;
color: #fff;
padding: 4px;
display: none;
width: 250px;
position: fixed;
z-index: 100;
right: 10px;
top:30px;
  
  
}

.redbdr {
    border:1px solid red;
}
</style>

    <!-- start page title -->
<br>

  <div id="errmsg"></div>
<div id="errdate"></div>
              
     
                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                               
                                <form action="{{url('admin/warrant/add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body" id="app">
                                        
                                        
                                        
                                                                              
<div style="background: #663399;
width: 100%;
border-radius: 10px;
height: 25px;
box-sizing: unset;
color: #fff;
font-weight: bold;
text-align: center;
margin-bottom: 18px;
padding: 4px 4px 13px 4px;
box-shadow: 1px 2px 3px 1px #b7aea3;
font-size: 21px;"> ওয়ারেন্ট সংক্রান্ত তথ্যাদি ইনপুট ফরম </div>                             
                                        
                                        
                                        
                                        
                                        
                                        
                                        <div class="row">
                                            @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
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
                                                    <input type="number"  min="0" name="gr_recive"  value="" id="gr_recive" class="number form-control  " placeholder="   জিআর রিসিভ " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  সিআর রিসিভ  </label>
                                                    <input type="number"  min="0" name="cr_recive"  value="" id="cr_recive" class="number form-control  " placeholder="   সিআর রিসিভ " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> সাজা জিআর রিসিভ  </label>
                                                    <inputtype="number"  min="0" name="saja_gr_recive"  value="" id="saja_gr_recive" class="number form-control  " placeholder="   সাজা জিআর রিসিভ " required>
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> সাজা সিআর রিসিভ  </label>
                                                    <input type="number"  min="0" name="saja_cr_recive"  value="" id="saja_cr_recive" class="number form-control  " placeholder="   সাজা সিআর রিসিভ " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  জিআর তামিল  </label>
                                                    <input type="number"  min="0" name="gr_tamil"  value="" id="gr_tamil" class="number form-control  " placeholder="   জিআর তামিল " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  সিআর তামিল  </label>
                                                    <input type="number"  min="0" name="cr_tamil"  value="" id="cr_tamil" class="number form-control  " placeholder="   সিআর তামিল " required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> সাজা জিআর তামিল  </label>
                                                    <input type="number"  min="0" name="saja_gr_tamil"  value="" id="saja_gr_tamil" class="number form-control  " placeholder="   সাজা জিআর তামিল " required>
                                                </div>
                                            </div>

                                             <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> সাজা সিআর তামিল  </label>
                                                    <input type="number"  min="0" name="saja_cr_tamil"  value="" id="saja_cr_tamil" class="number form-control  " placeholder="   সাজা সিআর তামিল " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> রিকল ও অন্যান্য  </label>
                                                    <input type="number"  min="0" name="recall_other"  value="" id="recall_other" class="number form-control  " placeholder="   রিকল ও অন্যান্য " required>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> নিয়মিত মামলায় গ্রেফতার  </label>
                                                    <input type="number"  min="0"  name="ucase_arrast"  value="" id="ucase_arrast" class="number form-control  " placeholder="   নিয়মিত মামলায় গ্রেফতার " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  রুজুকৃত মামলা (মাদক ব্যাতিত) </label>
                                                    <input type="number"  min="0" name="ruju_case"  value="" id="ruju_case" class="number  form-control  " placeholder="   রুজুকৃত মামলা (মাদক ব্যাতিত) " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> মামলা নিষ্পত্তি (মাদক ব্যাতিত)  </label>
                                                    <input type="number"  min="0" name="case_nispotti"  value="" id="case_nispotti" class="number form-control  " placeholder="  মামলা নিষ্পত্তি (মাদক ব্যাতিত)  " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> মাদক মামলা রুজু </label>
                                                    <input type="number"  min="0" name="narcotic_case_ruju"  value="" id="narcotic_case_ruju" class="number form-control  " placeholder="  মাদক মামলা রুজু  " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  মাদক মালা নিষ্পত্তি </label>
                                                    <input type="number"  min="0" name="narcotic_case_nispotti"  value="" id="narcotic_case_nispotti" class="number form-control  " placeholder="  মাদক মামলা নিষ্পত্তি  " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> অপমৃত্যু মামলা  </label>
                                                    <input type="number"  min="0" name="unnatural_death_case"  value="" id="unnatural_death_case" class="number form-control  " placeholder="   অপমৃত্যু মামলা " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  অপমৃত্যু জিডি </label>
                                                    <input type="number"  min="0" name="unnatural_death_gd"  value="" id="unnatural_death_gd" class="number form-control  " placeholder=" অপমৃত্যু জিডি   " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label"> বিট পুলিশিং  </label>
                                                    <input type="number"  min="0" name="bit_police"  value="" id="bit_police" class="number form-control  " placeholder="  বিট পুলিশিং  " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  কমিউনিটি পুলিশিং </label>
                                                    <input type="number"  min="0" name="comunity_police"  value="" id="comunity_police" class="number form-control  " placeholder="  কমিউনিটি পুলিশিং  " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  Student কমিউনিটি পুলিশিং </label>
                                                    <input type="number"  min="0" name="student_comunity_police"  value="" id="student_comunity_police" class="number form-control  " placeholder="  Student কমিউনিটি পুলিশিং  " >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="gr_recive" class="form-label">  সিআইএমএস এন্ট্রি </label>
                                                    <input type="number"  min="0" name="cims"  value="" id="cims" class="number form-control  " placeholder="  সিআইএমএস এন্ট্রি  " >
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

<script>
// var inputBox = document.getElementById("inputnumber");
var invalidChars = [
  "1",
  "2",
  "3",
  "4",
  "5",
  "6",
  "7",
  "8",
  "9",
  "0",
  "০",
  "১",
  "২",
  "৩",
  "৪",
  "৫",
  "৬",
  "৭",
  "৮",
  "৯",
   "",
 
];



   $(".number").keypress(function (e) {
           if(invalidChars.includes(e.key) || e.which == 8 || event.key === 'Delete' || event.key === 'Enter' || event.key === 'Tab' || event.key === 'ArrowDown' || event.key === 'ArrowLeft' || event.key === 'ArrowRight' || event.key === 'ArrowUp' || event.key === 'Home' || event.key === 'End') {
   }
   

  
  else {
   e.preventDefault();
   
         $("#errmsg").html("Number Only").stop().show().fadeOut("slow");
      return false;
      
      
  }
});

</script>

                     <x-admin-footer/>
