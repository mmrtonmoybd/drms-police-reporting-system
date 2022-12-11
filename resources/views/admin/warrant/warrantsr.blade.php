
			<x-admin-header/>
			
			<!-- ============ Body content start ============= -->
			
			
			
			
            <div class="main-content pt-4">
                <div class="selectbox">
                    
                <form target="_blank" action="{{url('/admin/warrant/search')}}" method="get">
       <div class="" id="app">
                                          <div class="row">
										
                                                        @if  (auth()->user()->hasRole('Super Admin'))
												<div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "></label>
                                                          <select name="districtID" id="districtID" class="droparrow form-select form-control stylish"  v-model="district_id">
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
                                                    <select name="thanaID" id="thanaID" class="droparrow form-select form-control stylish" >
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
                                                    <select name="thanaID" id="thanaID" class="droparrow form-select form-control stylish" >
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
                    
                    <input type="text" name="form"  value="{{request()->input('form')}}" id="date_time_response" class="form-control searchdatepick  @error('form') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="date start" >
                    <input type="text" name="to"  value="{{request()->input('to')}}" id="date_time_response" class="form-control searchdatepick  @error('to') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="date end" >
                  </div>
               </div>
            </div>
            
            <div class="col-sm-4 " >
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <button type="submit" name="submit" class="btn" style="width:100%;"> সার্চ করুন </button>
               </div>
            </div>
         </div>
      </div>
      
      
      
</form>
					
                </div>
                
                
                
                
                
                <div class="separator-breadcrumb border-top"></div>
                <div class="row">
                    <!-- ICON BG-->
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Add-User"></i>
                        
								<div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">মোট রিসিভ </p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{ $trecive[0]['total_sum'] }}</p>
                                </div>
						
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Financial"></i>
                                <div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">মোট নিষ্পত্তি</p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{ $tnis[0]['total_sum'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
			
			
			    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Money-2"></i>
                                <div class="content" style="max-width: 100%;">
                                    <p class="text-muted mt-2 mb-0">মোট পেন্ডিং</p>
                                    <p class="text-primary text-24 line-height-1 mb-2">@if (($trecive[0]['total_sum'] - $tnis[0]['total_sum']) >= 0) {{$trecive[0]['total_sum'] - $tnis[0]['total_sum']}} @else {{0}} @endif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
					<!--------
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Money-2"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">Expense</p>
                                    <p class="text-primary text-24 line-height-1 mb-2">$1200</p>
                                </div>
                            </div>
                        </div>
                    </div>
					--->
                </div>
				
				
				
				<style>
				.card-title {
					z-index:2000;
					position:relative;
				}
				</style>
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title"> @if (auth()->user()->hasRole('Super Admin'))
                                                    জেলা
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                     থানা 
                                                    @endif রিসিভ সংখ্যা     </div>
                                <div id="chart_div" style="margin-top: -39px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
					
					<div class="col-lg-4 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title" > @if (auth()->user()->hasRole('Super Admin'))
                                                    জেলা
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                     থানা 
                                                    @endif অনুযায়ী নিষ্প উৎস </div>
                                <div id="piechart" style="margin-top: -39px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
					
					
                    <div class="col-lg-4 col-sm-12">
                        <div class="card mb-4" style="height: 354px;">
                            <div class="card-body">
                                <div class="card-title">@if (auth()->user()->hasRole('Super Admin'))
                                                    জেলা
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                     থানা 
                                                    @endif অনুযায়ী পেন্ডিং</div>
                                <div id="chart_div3" style="margin-top: -71px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
           










<div class="row">

                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        

                                            <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    @if (auth()->user()->hasRole('Super Admin'))
                                                    <th > জেলা </th>
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                    <th > থানা </th>
                                                    @endif
                                                    <th > মোট রিসিভ  </th>
                                                    <th > মোট নিষ্পত্তি</th>
                                                    <th > মোট জিআর তামিল </th>
                                                    <th > মোট সিআর তামিল </th>
                                                    <th > মোট সাজা জিআর তামিল </th>
                                                    <th > মোট সাজা সিআর তামিল </th>
                                                    <th > মোট রিকল ও অন্যান্য </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if($wars)
                                            @foreach ($wars as $war)
                                                <tr>

                                                    <td >@if (auth()->user()->hasRole('Super Admin'))    
                                            {{$war->district->bn_name}}
                                            @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            {{$war->thana->bn_name}}
                                            @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            {{$war->thana->bn_name}}
                                            @endif</td>
                                                    
                                                    <td > {{$war->total_recive}}</td>
                                                    <td > {{$war->total_nispotti}}</td>
                                                    <td > {{$war->total_gr_tamil}}</td>
                                                    <td > {{$war->total_cr_tamil}}</td>
                                                    <td > {{$war->total_saja_gr_tamil}}</td>
                                                    <td > {{$war->total_saja_cr_tamil}}</td>
                                                    <td > {{$war->total_recall}}</td>
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>

                                        <br>
                                        <br>
                                        <br>

                                        <table class="table table-bordered table-striped table-centered mb-0">
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
                        </div>
                        
                        
                        </div>

                        <!-- end row -->
						
						<script src="{{ asset('my-assets/admin/js/vue.js') }}"></script>
    <script src="{{ asset('my-assets/admin/js/axios.min.js') }}"></script>


                     
<x-admin-footer/>

