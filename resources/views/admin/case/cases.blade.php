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
                                    <div class="card-body ">
                                        @can('case.add')
                                        <div class="row">
                                            <div class="col-sm-2">
                                            <a href="{{url('admin/case/add')}}" class="btn btn-primary btn-sm mb-2"><i class="uil uil-plus"></i> Add case</a>
                                            </div>
                                            @endcan
                                           
                                            
                                        </div>
                                              <div style="text-align: right;margin: 16px;">
                    
                                          
  <!-- <a target="_blank" href="" class="btn btn-primary"><i class="fa fa-file-download"></i> Download</a> -->
      
											
											</div>
                                        
                                        
                                            {!! $dataTable->table(['class' => 'table table-bordered table-responsive table-responsive table-striped table-centered mb-0'], true) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        @push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endpush              
<x-admin-footer/>
