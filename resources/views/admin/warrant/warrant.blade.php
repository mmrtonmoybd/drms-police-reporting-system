<x-admin-header />
<!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/qrrs')}}">Warrant</a></li>
                                            <li class="breadcrumb-item active">All Warrant</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="dripicons-scale"></i> Warrants</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

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
                                        <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th > রেফারেন্স নং </th>
                                                    <th > জেলা </th>
                                                    <th > থানা </th>
                                                    <th > তারিখ </th>
                                                    <th > GR Recive </th>
                                                    <th > CR Recive </th>
                                                    <th > Saja GR Recive </th>
                                                    <th > Saja CR Recive </th>
                                                    <th > Total Recive  </th>
                                                    <th > GR Tamil</th>
                                                    <th > CR Tamil </th>
                                                    <th > Saja GR Tamil </th>
                                                    <th > Saja CR Tamil </th>
                                                    <th > Recall and Other </th>
                                                    <th > Total Tamil </th>
                                                    <th > Total Nispotti </th>
                                                    <th > Day end pending </th>
                                                    <th style="width: 86px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if($wars)
                                            @foreach ($wars as $war)
                                                <tr>
                                                    <td > {{$war->id}}</td>
                                                    <td > @if(isset($war->district->name)) {{$war->district->bn_name}} @endif</td>
                                                    <td > @if(isset($war->thana->name)) {{$war->thana->name}} @endif</td>
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
                                                    <td > Day end pending need fun</td>
                                                       
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
