<x-admin-header />
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                 <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/woman')}}">Women and children</a></li>
                                           
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="uil uil-plus"></i> Women and children Dashboard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                
                                
                                <h3>Total complain: {{$totalcomplain}}</h3>
                                
                            </div>

                            <!-- chart -->
                            <div id="chart_div"></div>
                             <div id="piechart"></div>
                             <div id="columnchart_values"></div>

                        </div>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">

                             <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 86px">Action</th>
                                                    <th>ID</th>
                                                    <th > রেফারেন্স নং </th>
                                                    <th > জেলা </th>
                                                    <th > থানা </th>
                                                    <th > গ্রাম/ওয়ার্ড </th>
                                                    <th > আগমনের তারিখ ও সময় </th>
                                                    <th > বাদীর নাম </th>
                                                    <th > বাদীর বয়স </th>
                                                    <th > বাদীর ঠিকানা </th>
                                                    <th > বাদীর মোবাইল নং  </th>
                                                    <th > বিবাদীর নাম</th>
                                                    <th > বিবাদীর ঠিকানা </th>
                                                    <th > অভিযোগের কারন </th>
                                                    <th>  তদন্তকারী কর্মকর্তার নাম</th>
                                                    <th > তদন্তকারী কর্মকর্তার পদবী </th>
                                                    <th > মোবাইল নং </th>
                                                    <th > জিডি নং </th>
                                                    <th > তারিখ </th>
                                                    <th > মামলা নং </th>
                                                    <th > তারিখ </th>
                                                    <th > ধারা </th>
                                                    <th > অভিযোগ নং </th>
                                                    <th > সমস্যা সমাধান হয়েছে কিনা </th>
                                                    <th > গৃহীত ব্যবস্থা </th>
                                                    <th > নিষ্পত্তি রিপোর্ট </th>
                                                    <th > মন্তব্য </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if($womans)
                                            @foreach ($womans as $woman)
                                                <tr>
                                                    <td class="table-action">
                                                       @can('woman.view')
                                                        <a href="{{url('admin/woman/view/'.$woman->id)}}"  class="action-icon text-primary">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        @endcan
                                                        @can('woman.edit')
                                                        <a href="{{url('admin/woman/edit/'.$woman->id)}}" class="action-icon text-success">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        @endcan
                                                        @can('woman.delete')
                                                        <a href="{{url('admin/woman/delete/'.$woman->id)}}"  onclick="return confirm('Do you want to delete this slider?')" class="action-icon text-danger"> <i class="mdi mdi-delete"></i></a>
                                                        @endcan
                                                    </td>
                                                    <td > {{$woman->id}}</td>
                                                    <td > {{$woman->reference_no}}</td>
                                                    <td > @if(isset($woman->district->name)) {{$woman->district->bn_name}} @endif</td>
                                                    <td > @if(isset($woman->thana->name)) {{$woman->thana->name}} @endif</td>
                                                    <td > {{$woman->village_word}}</td>
                                                    <td > @if($woman->wdate) {{date('d/m/Y h:i A', strtotime($woman->wdate))}} @endif</td>
                                                    <td > {{$woman->badi_name}}</td>
                                                    <td > {{$woman->badi_age}}</td>
                                                    <td > {{Str::limit($woman->badi_address, 10)}}</td>
                                                    <td > {{ $woman->badi_phone}}</td>
                                                    <td > {{$woman->vbadi_name}}</td>
                                                    <td > {{$woman->vbadi_address}}</td>
                                                    <td > {{Str::limit($woman->complaint_reson, 5)}}</td>
                                                    <td>  {{$woman->investigator_name}}</td>
                                                    <td>  {{$woman->investigator_title}}</td>
                                                    <td>  {{$woman->mobile_no}}</td>
                                                    <td > {{$woman->gd_no}}</td>
                                                    <td > @if($woman->gd_date) {{date('d/m/Y', strtotime($woman->gd_date))}} @endif</td>
                                                    <td > {{$woman->mamla_no}}</td>
                                                    <td > @if($woman->mamla_date) {{date('d/m/Y', strtotime($woman->mamla_date))}} @endif</td>
                                                    <td > {{$woman->dhara}}</td>
                                                    <td > {{$woman->complaint_no}}</td>
                                                    <td > {{$woman->problem_fix}}</td>
                                                    <td > {{$woman->action_taken}}</td>
                                                    <td > {{$woman->nreport}}</td>
                                                    <td > {{Str::limit($woman->comment, 5)}}</td>
                                                       
                                                    
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        @if($womans){{$womans->appends(request()->input())->links()}} @endif
                                      
                                        </nav>

                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <!-- end row -->
                       
<x-admin-footer/>
