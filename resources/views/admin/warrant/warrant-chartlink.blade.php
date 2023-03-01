<x-admin-header />
	  

<x-admin-validation-errors :errors="$errors->all()"/>
<!------------secondery hedaer----------->





<form target="_blank" action="{{url('/admin/warrant/search')}}" method="get">
                                                    
                                                    <div class="" id="app">
                                        <div class="row">
										
                                                        @if  (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
												<div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                          <select name="districtID" id="districtID" class="form-select form-control "  v-model="district_id">
                                                        <option value="">জেলা</option>
                                                        @if($districts)

                                                        @foreach($districts as $district)
                                                        <option value="{{$district->id}}" {{ ( $district->id == request()->input('districtID')) ? 'selected' : '' }}>{{$district->bn_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
												</div>
                                                @endif

                                                @if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
												 <div class="col-sm-4">
                                                 <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                    <select name="thanaID" id="thanaID" class="form-select form-control " >
                                                        <option value="">থানা</option>
                                                        @if($spthanas)

                                                        @foreach($spthanas as $thnsp)
                                                        <option value="{{$thnsp->id}}" {{ ( $thnsp->id == request()->input('thanaID')) ? 'selected' : '' }}>{{$thnsp->bn_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
												</div>
                                                @endif

                                                @if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
												<div class="col-sm-4">
                                                 <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                    <select name="thanaID" id="thanaID" class="form-select form-control " >
                                                        <option value="">থানা</option>
                                                        @if($octhanacol)

                                                        <option value="{{$octhanacol->id}}" selected>{{$octhanacol->bn_name}}</option>
                                                        
                                                        @endif
                                                    </select>
                                                </div>
                                    </div>
                                                @endif
												
												
												<div class="col-sm-4 " > 
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <div class="input-group" id="timepicker-input-group2">
                    
                    <input type="text" name="form"  value="{{request()->input('form')}}" id="date_time_response" class="form-control searchdatepick  @error('form') is-invalid @enderror"  autocomplete="off" data-date-format="yyyy/mm/dd"  placeholder="শুরুর তারিখ" >
                    <input type="text" name="to"  value="{{request()->input('to')}}" id="date_time_response" class="form-control searchdatepick  @error('to') is-invalid @enderror"  autocomplete="off" data-date-format="yyyy/mm/dd"  placeholder="শেষ তারিখ" >
                  </div>
               </div>
            </div>
            
            <div class="col-sm-4 " >
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <button type="submit" name="submit" class="btn " style="width:100%;"> সার্চ করুন </button>
               </div>
            </div>
         </div>
      </div>

</form>
                        <!-- end page title -->
						
@can('warrant.add')
   <a href="add" class="float2 silverhover">
    
<i class="dripicons-plus  plus my-float"></i>
</a>
@endcan
@can('warrant.view')
<a href="../warrant" class="float silverhover" style="padding: 7px;">
<i style="font-size: 20px;" class="dripicons-view-list my-float"></i>
</a>
@endcan


<div class="row">

                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body">

                                        <table class="table table-bordered table-responsive table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th > রেফারেন্স নং </th>
                                                    <th > জেলা </th>
                                                    <th > থানা </th>
                                                    <th > তারিখ </th>
                                                    <th > জিআর রিসিভ	 </th>
                                                    <th > সিআর রিসিভ </th>
                                                    <th > সাজা জিআর রিসিভ </th>
                                                    <th > সাজা সিআর রিসিভ </th>
                                                    <th > মোট রিসিভ  </th>
                                                    <th > জিআর তামিল</th>
                                                    <th > সিআর তামিল </th>
                                                    <th > সাজা জিআর তামিল </th>
                                                    <th > সাজা সিআর তামিল </th>
                                                    <th > রিকল ও অন্যান্য </th>
                                                    <th > মোট তামিল </th>
                                                    <th > মোট নিষ্পত্তি </th>
                                                    <th > দিনশেষে পেন্ডিং </th>
                                                    <th style="width: 86px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
@php
use App\Models\District;
use App\Models\Thana;
use App\Models\Warrant;

function dayend($id, $dis) {
    $get = Warrant::selectRaw("((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS day_endp")
    ->where('districtID', $dis)
    ->where('id', '<=', $id)->first();
    return intval($get->day_endp);
}

function disna($id) {
    $get = District::find($id);
    return $get->bn_name;
}

function thana($id) {
    $get = Thana::find($id);
    return $get->name;
}


@endphp

                                            @if($wars2)
                                            @foreach ($wars2 as $war)
                                                <tr>
                                                    <td > {{$war->id}}</td>
                                                    <td > @if(null !== disna($war->districtID)) {{disna($war->districtID)}} @endif </td>
                                                    <td > @if(null !== thana($war->thanaID)) {{thana($war->thanaID)}} @endif </td>
                                                    <td > {{date('d-M-Y', strtotime($war->date))}}</td>
                                                    <td > {{$war->gr_recive}}</td>
                                                    <td > {{$war->cr_recive}}</td>
                                                    <td > {{$war->saja_gr_recive}}</td>
                                                    <td > {{$war->saja_cr_recive}}</td>
                                                    <td > {{$war->gr_recive + $war->cr_recive + $war->saja_gr_recive + $war->saja_cr_recive}}</td>
                                                    <td > {{$war->gr_tamil}}</td>
                                                    <td > {{$war->cr_tamil}}</td>
                                                    <td > {{$war->saja_gr_tamil}}</td>
                                                    <td > {{$war->saja_cr_tamil}}</td>
                                                    <td > {{$war->recall_other}}</td>
                                                    <td > {{$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil}}</td>
                                                    <td > {{$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil + $war->recall_other}}</td>
                                                    <td > @if (dayend($war->id, $war->districtID) >= 0) {{dayend($war->id, $war->districtID)}} @else {{0}} @endif</td>
                                                       
                                                    <td class="table-action">
                                                        
                                                        <a href="{{url('admin/warrant/view/'.$war->id)}}"  class="action-icon text-primary">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>

                                                        <a href="{{url('admin/warrant/edit/'.$war->id)}}" class="action-icon text-success">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="{{url('admin/warrant/delete/'.$war->id)}}"  onclick="return confirm('Do you want to delete this slider?')" class="action-icon text-danger"> <i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>

                                        <nav class="mt-3">

                                        <!-- pagination here -->
                                         @if($wars2){{$wars2->appends(request()->input())->links()}} @endif
                                      
                                        </nav>


                                    </div>
                            </div>

                        <!-- end row -->
						
						<script src="{{ asset('my-assets/admin/js/vue.js') }}"></script>
    <script src="{{ asset('my-assets/admin/js/axios.min.js') }}"></script>

	  
	  
	  
<script type="text/javascript" language="javascript" >
 $(document).ready(function(){

  $('#customer_data').DataTable({
   "processing" : true,
   "serverSide" : true,
   "ajax" : {
    url:"fetching/alldata.php",
    type:"POST"
   },
   dom: 'lBfrtip',
   buttons: [
    'excel', 'csv', 'pdf', 'copy'
   ],
   "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
  });
  
 });
 
</script>

                     
<x-admin-footer/>

