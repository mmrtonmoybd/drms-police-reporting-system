<x-admin-header />
<!-- start page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/warrant')}}">Warrants</a></li>
                                            <li class="breadcrumb-item active">
                                            @if (auth()->user()->hasRole('Super Admin'))    
                                            {{$dis->bn_name}} Warrant
                                            @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            {{$tha->bn_name}} Warrant
                                            @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            {{$octhanacol->bn_name}} Warrant
                                            @endif
                                        </li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="dripicons-scale"></i>@if (auth()->user()->hasRole('Super Admin'))    
                                            {{$dis->bn_name}} Warrant
                                            @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            {{$tha->bn_name}} Warrant
                                            @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            {{$octhanacol->bn_name}} Warrant
                                            @endif</h4>
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
                                            



                                            </div>

                                            <!-- chart  -->
                                            <div id="chart_div3"></div>
                                            <div id="chart_div"></div>
                                            <div id="piechart"></div>
                                            <!-- chart  -->
                                            

                                            <h3>@if (auth()->user()->hasRole('Super Admin'))    
                                            {{$dis->bn_name}} Warrant
                                            @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            {{$tha->bn_name}} Warrant
                                            @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            {{$octhanacol->bn_name}} Warrant
                                            @endif মোট রিসিভ: {{ $trecive[0]['total_sum'] }}</h3>


                                            <h3>@if (auth()->user()->hasRole('Super Admin'))    
                                            {{$dis->bn_name}} Warrant
                                            @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            {{$tha->bn_name}} Warrant
                                            @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            {{$octhanacol->bn_name}} Warrant
                                            @endif মোট নিষ্পত্তি: {{ $tnis[0]['total_sum'] }}</h3>

                                            <h3>@if (auth()->user()->hasRole('Super Admin'))    
                                            {{$dis->bn_name}}
                                            @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            {{$tha->bn_name}}
                                            @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            {{$octhanacol->bn_name}}
                                            @endif মোট পেন্ডিং: @if (($trecive[0]['total_sum'] - $tnis[0]['total_sum']) >= 0) {{$trecive[0]['total_sum'] - $tnis[0]['total_sum']}} @else {{0}} @endif</h3>

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
                                            {{$dis->bn_name}}
                                            @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            {{$tha->bn_name}}
                                            @elseif(auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            {{$octhanacol->bn_name}}
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                     
<x-admin-footer/>

