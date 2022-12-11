<x-admin-header />
       

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                               
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td> <b>রেফারেন্স নং : </b> {{$case->id}}</td>
                                                        <td> <b>জেলা : </b> @if(isset($case->district->name)){{$case->district->bn_name}}@endif</td>
                                                        <td> <b>সার্কেল : </b> @if(isset($case->circle->name)){{$case->circle->name}}@endif</td>
                                                        <td> <b>থানা : </b> @if(isset($case->thana->name)){{$case->thana->bn_name}}@endif</td>
                                                        
                                                    </tr>

                                                    <tr>
                                                    <td><b>CDMS PG ID :</b>{{$case->cdms_pg_id}}</td>
                                                    <td><b>উৎস :</b>{{$case->source_of_info}}</td>
                                                    <td><b>জি আর নং :</b>{{$case->gr_no}}</td>
                                                    <td><b>মামলা নং :</b>{{$case->case_no}}</td>
                                                    </tr>

                                                    <tr>
                                                    <td><b>ধারা :</b>{{$case->dhara}}</td>
                                                    <td><b>মামলা তারিখ :</b>@if (!empty($case->case_date)) {{date('d/m/Y', strtotime($case->case_date))}} @endif</td>
                                                    <td><b>মামলার ধরন :</b>{{$case->casetype->type}}</td>
                                                    <td><b>উপধরন :</b>{{$case->casesubtype->type}}</td>
                                                    </tr>

                                                    <tr>
                                                    <td><b>ঘটনার তারিখ :</b>@if (!empty($case->incident_date_time)) {{date('d/m/Y', strtotime($case->incident_date_time))}} @endif</td>
                                                    <td><b>মামলার সারসংক্ষেপ :</b>{{$case->short_dettails}}</td>
                                                    <td><b>এজাহার নামীয় আসামির সংখ্যা :</b>{{$case->azahar_namio_victims}}</td>
                                                    <td><b>নিস্পত্তি / মুলতবি :</b>{{$case->nispotti_or_multobi}}</td>
                                                    </tr>

                                                    <tr>
                                                    <td><b>নিস্পত্তির ধরন :</b>@if ($case->nispotti_type != 0) {{$case->nispotti_type}} @endif</td>
                                                    <td><b>সিএক্স/এফ আর নং :</b>{{$case->cs_or_fr_no}}</td>
                                                    <td><b>তারিখ :</b>@if (!empty($case->nispotti_date)) {{date('d/m/Y', strtotime($case->nispotti_date))}} @endif</td>
                                                    <td><b>পুলিশ রিপোর্ট আসামির সংখ্যা :</b>{{$case->police_report_victim}}</td>
                                                    </tr>

                                                    <tr>
                                                    <td><b>গ্রেফতারকৃত আসামির সংখ্যা :</b>{{$case->number_of_accused}}</td>
                                                    <td><b>জামিন প্রাপ্ত :</b>{{$case->jamin_prapto}}</td>
                                                    <td><b>পলাতক :</b>{{$case->polatok}}</td>
                                                    <td><b>এজাহার বহির্ভুত তদন্তে প্রাপ্ত :</b>{{$case->azahar_vukto_invistigate}}</td>
                                                    </tr>

                                                    <tr>
                                                    <td><b>অব্যহিত প্রাপ্ত :</b>{{$case->ovohoti}}</td>
                                                    <td><b>১৬১ গ্রহন (পাবলিক) :</b>{{$case->sixtyone_recive}}</td>
                                                    <td><b>১৬৪ গ্রহন :</b>{{$case->sixtyfour_recive}}</td>
                                                    <td><b>তদন্তের মান :</b>{{$case->invistigate_rate}}</td>
                                                    </tr>
                                                    

                                                    <tr>
                                                          
                                                        <td colspan="3">
                                                        <b>   মন্তব্য: </b>  {{$case->comment}}
                                                        </td>
                                                        
                                                    </tr>
                                                </table>
                                                <a target="_blank" href="{{url('admin/case/view/print/'.$case->id)}}" class="btn btn-success"><i class="uil uil-print"></i> Print</a>
                                            </div>
                                           
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        <!-- end row -->

                        

                     <x-admin-footer/>