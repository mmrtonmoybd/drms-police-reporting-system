<x-admin-header />
<!-- start page title -->
@php 
use Illuminate\Support\Str;
@endphp


                        
                                     
                            
                            <br>
                        
                        <!-- end page title -->

                        <x-admin-validation-errors :errors="$errors->all()"/>






                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        
                                        <div class="row">
                                            <div class="col-sm-2">
                                            <a href="{{url('admin/qrrs/add')}}" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add Qrrs</a>
                                            </div>

                                           
                                            
                                        </div>
                                        <div style="text-align: right;margin: 16px;">
                    
                                          
  <a target="_blank" href="{{url('admin/qrrs/excel')}}" class="btn btn-success"><i class="fa fa-file-excel"></i> Excel</a>
      
											
											</div>
                                        <table class="tablestyle table-bordered table-striped table-centered yajra-datatable">

                                            <thead>
                                                <tr>
                                                    <th style="width: 86px">Action</th>
                                                    <th > রেফারেন্স নং </th>
                                                    <th > জেলা </th>
                                                    <th > থানা </th>
                                                    <th > গ্রাম/ওয়ার্ড </th>
                                                    <th > তথ্য প্রাপ্তির উৎস </th>
                                                    <th > ঘটনার তারিখ ও সময় </th>
                                                    <th > পুলিশের সংবাদ প্রাপ্তির তারিখ ও সময় </th>
                                                    <th > রেসপন্সের তারিখ ও সময় </th>
                                                    <th > রেসপন্সে বিলম্ব  </th>
                                                    <!-------------
                                                    <th > মূল ঘটনা</th>
                                                    -->
                                                    <th > ঘটনার ধরণ </th>
                                                    <th > ঘটনার সূত্রপাত </th>
                                                    <th>  ঘটনার সংক্ষিপ্ত বিবরন</th>
                                                    <th>  গৃহীত ব্যবস্থা</th>
                                                    <th > জিডি নং </th>
                                                    <th > তারিখ </th>
                                                    <th > মামলা নং </th>
                                                    <th > তারিখ </th>
                                                    <th style="width:100px;"> ধারা </th>
                                                    <th > বাদীর/ সংবাদদাতার নাম </th>
                                                    <th > বাদীর মোবাইল নং </th>
                                                    <th > ভিকটিমের সংখ্যা </th>
                                                    <th > এজাহারভুক্ত আসামীর সংখ্যা </th>
                                                    <th > রেসপন্সকারী/ তদন্তকারী কর্মকর্তার নাম </th>
                                                    <th > বিপি নং </th>
                                                    <th > মোবাইল নং </th>
                                                    <th > ছবি/ভিডিও প্রাপ্তি  </th>
                                                    <th > সন্তুষ্টির মান </th>
                                                    <th > মন্তব্য </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                             


                                            

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        


@push('scripts')

<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        order: [ [1, 'desc'] ],
        processing: true,
        serverSide: true,
        ajax: "{!! url('/admin/qrrs/index/ajax') !!}",
        columns: [
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false
            },
            {data: 'id', orderable: true},
            {defaultContent: '', data: 'district.bn_name', searchable: true, orderable: false},
            {defaultContent: '', data: 'thana.name', searchable: true, orderable: false},
            {defaultContent: '', data: 'village_word', searchable: true, orderable: false},
            {defaultContent: '', data: 'source_of_info', searchable: true, orderable: false},
            {defaultContent: '', data: 'date_time_of_incident', searchable: true, orderable: true},
            {defaultContent: '', data: 'date_time_of_police_news', searchable: true, orderable: true},
            {defaultContent: '', data: 'date_time_response', searchable: true, orderable: true},
            {defaultContent: '', data: 'delay_in_response', searchable: true, orderable: true},
            
          //  {defaultContent: '', data: 'main_event', searchable: true, orderable: false},
            
            {defaultContent: '', data: 'event_type', searchable: true, orderable: false},
            {defaultContent: '', data: 'begening_of_event', searchable: true, orderable: false},
            {defaultContent: '', data: 'short_dettails', searchable: false, orderable: false},
            {defaultContent: '', data: 'action_taken', searchable: true, orderable: false},
            {defaultContent: '', data: 'gd_no', searchable: true, orderable: true},
            {defaultContent: '', data: 'gd_date', searchable: true, orderable: true},
            {defaultContent: '', data: 'case_no', searchable: true, orderable: true},
            {defaultContent: '', data: 'case_date', searchable: true, orderable: true},
            {defaultContent: '', data: 'clause', searchable: true, orderable: false},
            {defaultContent: '', data: 'nopc', searchable: true, orderable: false},
            {defaultContent: '', data: 'plaintiff_mobile', searchable: true, orderable: false},
            {defaultContent: '', data: 'number_of_victims', searchable: true, orderable: true},
            {defaultContent: '', data: 'number_of_accused', searchable: true, orderable: true},
            {defaultContent: '', data: 'name_of_investigator', searchable: true, orderable: false},
            {defaultContent: '', data: 'bp_no', searchable: true, orderable: true},
            {defaultContent: '', data: 'mobile_no', searchable: true, orderable: false},
            {defaultContent: '', data: 'image_video', searchable: false, orderable: false},
            {defaultContent: '', data: 'media_quality', searchable: false, orderable: false},
            {defaultContent: '', data: 'comments', searchable: false, orderable: false},
        ]
    });
    
  });
</script>

@endpush   

                     
<x-admin-footer/>
