<x-admin-header />

<br>
                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        
                                        <div class="row">
                                            <div class="col-sm-2">
                                            <a href="{{url('admin/warrant/add')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add Warrant</a>
                                            </div>

                                           
                                            
                                        </div>
                                        <table class="tablestyle">
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
                                                    <th>নিয়মিত মামলায় গ্রেফতার</th>
                                                    <th>রুজুকৃত মামলা (মাদক ব্যাতিত)</th>
                                                    <th>মামলা নিষ্পত্তি (মাদক ব্যাতিত)</th>
                                                    <th>মাদক মামলা রুজু</th>
                                                    <th>মাদক মালা নিষ্পত্তি</th>
                                                    <th>অপমৃত্যু মামলা</th>
                                                    <th>অপমৃত্যু জিডি</th>
                                                    <th>বিট পুলিশিং</th>
                                                    <th>কমিউনিটি পুলিশিং</th>
                                                    <th>Student কমিউনিটি পুলিশিং</th>
                                                    <th>সিআইএমএস এন্ট্রি</th>
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

                                            @if($wars)
                                            @foreach ($wars as $war)
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
                                                    <td>{{$war->ucase_arrast}}</td>
                                                    <td>{{$war->ruju_case}}</td>
                                                    <td>{{$war->case_nispotti}}</td>
                                                    <td>{{$war->narcotic_case_ruju}}</td>
                                                    <td>{{$war->narcotic_case_nispotti}}</td>
                                                    <td>{{$war->unnatural_death_case}}</td>
                                                    <td>{{$war->unnatural_death_gd}}</td>
                                                    <td>{{$war->bit_police}}</td>
                                                    <td>{{$war->comunity_police}}</td>
                                                    <td>{{$war->student_comunity_police}}</td>
                                                    <td>{{$war->cims}}</td>
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
                                         @if($wars){{$wars->appends(request()->input())->links()}} @endif
                                      
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                     
<x-admin-footer/>
