<x-admin-header />
<!-- start page title -->
@php 
use Illuminate\Support\Str;
@endphp
          <br>
                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body ">
                                        
                                        <div class="row">
                                            @can('narcotic.add')
                                            <div class="col-sm-2">
                                            <a href="{{url('admin/narcotic/add')}}" class="btn btn-primary btn-sm mb-2"><i class="uil uil-plus"></i> Add Narcotic</a>
                                            </div>
                                            @endcan
                                           
                                        
                                        </div>
                                        <div style="text-align: right;margin: 16px;">
                    <!---------
                   <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Download
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 34px, 0px);">
                                                    <a target="_blank" href="{{url('admin/narcotic/excel')}}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Excel</a>
                                                  
                                                  <!-- <a target="_blank" href="{{url('admin/narcotic/excel')}}" class="btn btn-primary"><i class="fa fa-file-excel"></i> PDF</a>
                                                    <a  href="#" onclick="window.print()" class="btn btn-primary"><i class="fa fa-file-excel"></i> Print</a>
                                         
                                                </div>
                                            </div>                       
---->
                                                      <!-- <a target="_blank" href="{{url('admin/narcotic/excel')}}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Excel</a> -->
                                                  
											
											</div>

                                            {!! $dataTable->table(['class' => 'table table-responsive table-bordered table-striped table-centered mb-0'], true) !!}


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <input type="hidden" name="shortable_url" id="shortable_url" value="{{url('admin/qrrs/short')}}">

            @push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endpush         
<x-admin-footer/>
