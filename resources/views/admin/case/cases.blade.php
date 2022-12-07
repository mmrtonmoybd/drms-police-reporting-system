<x-admin-header />
<!-- start page title -->
@php 
use Illuminate\Support\Str;
@endphp
                 
                        <x-admin-validation-errors :errors="$errors->all()"/>
<br>
                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        @can('case.add')
                                        <div class="row">
                                            <div class="col-sm-2">
                                            <a href="{{url('admin/case/add')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add case</a>
                                            </div>
                                            @endcan
                                           
                                            
                                        </div>
                                              <div style="text-align: right;margin: 16px;">
                    
                                          
  <!-- <a target="_blank" href="" class="btn btn-success"><i class="fa fa-file-excel"></i> Excel</a> -->
      
											
											</div>
                                        <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 86px">Action</th>
                                                    <th> রেফারেন্স নং </th>
                                                    <th> জেলা</th>
                                                    <th> সার্কেল</th>
                                                    <th> থানা</th>
                                                    <th> CDMS PG ID</th>
                                                    <th> উৎস</th>
                                                    <th> জি আর নং</th>
                                                    <th> মামলা নং</th>
                                                    <th> ধারা</th>
                                                    <th> তারিখ</th>
                                                    <th> মামলার ধরন</th>
                                                    <th> উপধরন</th>
                                                    <th> ঘটনার তারিখ</th>
                                                    <th> মামলার সারসংক্ষেপ</th>
                                                    <th> এজাহার নামীয় আসামির সংখ্যা</th>
                                                    <th> নিস্পত্তি / মুলতবি</th>
                                                    <th> নিস্পত্তির ধরন</th>
                                                    <th> সিএক্স/এফ আর নং</th>
                                                    <th> তারিখ</th>
                                                    <th> পুলিশ রিপোর্ট আসামির সংখ্যা</th>
                                                    <th> গ্রেফতারকৃত আসামির সংখ্যা</th>
                                                    <th> জামিন প্রাপ্ত</th>
                                                    <th> পলাতক</th>
                                                    <th> এজাহার বহির্ভুত তদন্তে প্রাপ্ত</th>
                                                    <th> অব্যহিত প্রাপ্ত</th>
                                                    <th> ১৬১ গ্রহন (পাবলিক)</th>
                                                    <th> ১৬৪ গ্রহন</th>
                                                    <th> তদন্তের মান</th>
                                                    <th> মন্তব্য</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if($cases)
                                            @foreach ($cases as $case)
                                                <tr >
                                                    <td class="table-action">
                                                        @can('case.view')
                                                        <a href="{{url('admin/case/view/'.$case->id)}}"  class="action-icon text-primary">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        @endcan
                                                        @can('case.edit')
                                                        <a href="{{url('admin/case/edit/'.$case->id)}}" class="action-icon text-success">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        @endcan
                                                        @can('case.delete')
                                                        <a href="{{url('admin/case/delete/'.$case->id)}}"  onclick="return confirm('Do you want to delete this slider?')" class="action-icon text-danger"> <i class="mdi mdi-delete"></i></a>
                                                        @endcan
                                                    </td>
                                                    <td > {{$case->id}}</td>
                                                    <td>{{$case->district->bn_name}}</td>
                                                    <td>{{$case->circle->name}}</td>
                                                    <td>{{$case->thana->bn_name}}</td>
                                                    <td>{{$case->cdms_pg_id}}</td>
                                                    <td>{{$case->source_of_info}}</td>
                                                    <td>{{Str::limit($case->gr_no, 15)}}</td>
                                                    <td>{{Str::limit($case->case_no, 10)}}</td>
                                                    <td>{{Str::limit($case->dhara, 10)}}</td>
                                                    <td>@if (!empty($case->case_date)) {{date('d/m/Y', strtotime($case->case_date))}} @endif</td>
                                                    <td>{{$case->casetype->type}}</td>
                                                    <td>@if (!empty($case->casesubtype)) {{$case->casesubtype->type}} @endif</td>
                                                     <td>@if (!empty($case->incident_date_time)) {{date('d/m/Y', strtotime($case->incident_date_time))}} @endif</td>
                                                    <td>{{Str::limit($case->short_dettails, 10)}}</td>
                                                    <td>{{Str::limit($case->azahar_namio_victims, 10)}}</td>
                                                    <td>{{Str::limit($case->nispotti_or_multobi, 10)}}</td>
                                                     <td>{{$case->nispotti_type}}</td>
                                                    <td>{{Str::limit($case->cs_or_fr_no, 10)}}</td>
                                                    <td>@if (!empty($case->nispotti_date)) {{date('d/m/Y', strtotime($case->nispotti_date))}} @endif</td>
                                                    <td>{{Str::limit($case->police_report_victim, 10)}}</td>
                                                     <td>{{Str::limit($case->number_of_accused, 10)}}</td>
                                                    <td>{{Str::limit($case->jamin_prapto, 10)}}</td>
                                                    <td>{{Str::limit($case->polatok, 10)}}</td>
                                                    <td>{{Str::limit($case->azahar_vukto_invistigate, 10)}}</td>
                                                     <td>{{Str::limit($case->ovohoti, 10)}}</td>
                                                    <td>{{Str::limit($case->sixtyone_recive, 10)}}</td>
                                                    <td>{{Str::limit($case->sixtyfour_recive, 10)}}</td>
                                                    <td>{{Str::limit($case->invistigate_rate, 10)}}</td>

                                                     <td>{{Str::limit($case->comment, 10)}}</td>

                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        
                                      
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <input type="hidden" name="shortable_url" id="shortable_url" value="{{url('admin/qrrs/short')}}">

                     
<x-admin-footer/>
