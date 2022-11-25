<x-admin-header />
<!-- start page title -->
@php 
use Illuminate\Support\Str;
@endphp
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/qrrs')}}">Qrrs report</a></li>
                                            <li class="breadcrumb-item active"> Qrrs report</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="dripicons-scale"></i> Qrrs</h4>
                                 </div>
                                </div>
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
                                            <a href="https://onlinebdshop.com/admin/qrrs/add" class="btn btn-success btn-sm mb-2"><i class="uil uil-plus"></i> Add Qrrs</a>
                                            </div>

                                           
                                            
                                        </div>
                                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="DataTables_Table_0"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="tablestyle table-bordered table-striped table-centered yajra-datatable dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 2629px;">

                                            <thead>
                                                <tr role="row"><th style="width: 41px;" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Action">Action</th><th class="sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 48px;" aria-sort="descending" aria-label=" রেফারেন্স নং : activate to sort column ascending"> রেফারেন্স নং </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 33px;" aria-label=" জেলা "> জেলা </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 33px;" aria-label=" থানা "> থানা </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 55px;" aria-label=" গ্রাম/ওয়ার্ড "> গ্রাম/ওয়ার্ড </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 32px;" aria-label=" তথ্য প্রাপ্তির উৎস "> তথ্য প্রাপ্তির উৎস </th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 40px;" aria-label=" ঘটনার তারিখ ও সময় : activate to sort column ascending"> ঘটনার তারিখ ও সময় </th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 42px;" aria-label=" পুলিশের সংবাদ প্রাপ্তির তারিখ ও সময় : activate to sort column ascending"> পুলিশের সংবাদ প্রাপ্তির তারিখ ও সময় </th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 53px;" aria-label=" রেসপন্সের তারিখ ও সময় : activate to sort column ascending"> রেসপন্সের তারিখ ও সময় </th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 63px;" aria-label=" রেসপন্সে বিলম্ব  : activate to sort column ascending"> রেসপন্সে বিলম্ব  </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 147px;" aria-label=" মূল ঘটনা"> মূল ঘটনা</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 34px;" aria-label=" ঘটনার ধরণ "> ঘটনার ধরণ </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 39px;" aria-label=" ঘটনার সূত্রপাত "> ঘটনার সূত্রপাত </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 36px;" aria-label="  ঘটনার সংক্ষিপ্ত বিবরন">  ঘটনার সংক্ষিপ্ত বিবরন</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 33px;" aria-label=" জিডি নং : activate to sort column ascending"> জিডি নং </th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 40px;" aria-label=" তারিখ : activate to sort column ascending"> তারিখ </th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 32px;" aria-label=" মামলা নং : activate to sort column ascending"> মামলা নং </th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 40px;" aria-label=" তারিখ : activate to sort column ascending"> তারিখ </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 22px;" aria-label=" ধারা "> ধারা </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 64px;" aria-label=" বাদীর/ সংবাদদাতার নাম "> বাদীর/ সংবাদদাতার নাম </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 67px;" aria-label=" বাদীর মোবাইল নং "> বাদীর মোবাইল নং </th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 53px;" aria-label=" ভিকটিমের সংখ্যা : activate to sort column ascending"> ভিকটিমের সংখ্যা </th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 62px;" aria-label=" এজাহারভুক্ত আসামীর সংখ্যা : activate to sort column ascending"> এজাহারভুক্ত আসামীর সংখ্যা </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 68px;" aria-label=" রেসপন্সকারী/ তদন্তকারী কর্মকর্তার নাম "> রেসপন্সকারী/ তদন্তকারী কর্মকর্তার নাম </th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 48px;" aria-label=" বিপি নং : activate to sort column ascending"> বিপি নং </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 67px;" aria-label=" মোবাইল নং "> মোবাইল নং </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 57px;" aria-label=" ছবি/ভিডিও প্রাপ্তি  "> ছবি/ভিডিও প্রাপ্তি  </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 35px;" aria-label=" সন্তুষ্টির মান "> সন্তুষ্টির মান </th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 28px;" aria-label=" মন্তব্য "> মন্তব্য </th></tr>
                                            </thead>
                                            <tbody>

                                            


                                            

                                            <tr id="19" role="row" class="odd"><td><a href="https://onlinebdshop.com/admin/qrrs/details/19" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/edit/19" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/delete/19" onclick="return confirm(" do="" you="" want="" to="" delete="" this="" qrr?")"="" class="action-icon"> <i class="mdi mdi-delete"></i></a></td><td class="sorting_1">19</td><td>পটুয়াখালী</td><td>পটুয়াখালী সদর
</td><td>দশকাহনিয়া</td><td>এলাকা</td><td>01/10/2022 01:00 PM</td><td>23/11/2022 01:00 PM</td><td>14/11/2022 01:00 PM</td><td>216:0:00</td><td>ভ চভ চভ</td><td>সাইবার</td><td>জমিজমা</td><td>ঘ্যহি...</td><td></td><td>01/01/1970</td><td></td><td>01/01/1970</td><td></td><td>হভচ হগচভ</td><td>01710000000</td><td>0</td><td>0</td><td>চভ চ</td><td>ভ চ চ চ</td><td>01710000000</td><td>না</td><td>সন্তুষ্ট</td><td>ভ ব ব...</td></tr><tr id="18" role="row" class="even"><td><a href="https://onlinebdshop.com/admin/qrrs/details/18" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/edit/18" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/delete/18" onclick="return confirm(" do="" you="" want="" to="" delete="" this="" qrr?")"="" class="action-icon"> <i class="mdi mdi-delete"></i></a></td><td class="sorting_1">18</td><td>ঝালকাঠি</td><td>নলছিটি</td><td>ঝাতুকাঠী</td><td>থানা</td><td>15/11/2022 11:00 AM</td><td>15/11/2022 11:00 AM</td><td>20/01/0202 11:00 AM</td><td>15960984:0:00</td><td>12332</td><td>রাজনৈতিক</td><td>অন্যান্য</td><td></td><td>112</td><td>13/11/2022</td><td>12</td><td>17/11/2022</td><td>23232</td><td></td><td></td><td></td><td></td><td>নাঈম</td><td></td><td>01710000000</td><td>হ্যা</td><td></td><td></td></tr><tr id="17" role="row" class="odd"><td><a href="https://onlinebdshop.com/admin/qrrs/details/17" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/edit/17" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/delete/17" onclick="return confirm(" do="" you="" want="" to="" delete="" this="" qrr?")"="" class="action-icon"> <i class="mdi mdi-delete"></i></a></td><td class="sorting_1">17</td><td>বরগুনা</td><td>বেতাগী</td><td>কলাপাড়া</td><td>কোর্ট</td><td>15/11/2022 11:00 AM</td><td>14/11/2022 11:00 AM</td><td>19/10/2022 11:00 AM</td><td>624:0:00</td><td>123</td><td>বিরোধ</td><td>জমিজমা</td><td>AvwAv</td><td></td><td>01/01/1970</td><td></td><td>01/01/1970</td><td></td><td>কালাম</td><td></td><td></td><td></td><td>এসআই সাগর সাহা</td><td>789979899</td><td>01710000000</td><td></td><td></td><td></td></tr><tr id="16" role="row" class="even"><td><a href="https://onlinebdshop.com/admin/qrrs/details/16" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/edit/16" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/delete/16" onclick="return confirm(" do="" you="" want="" to="" delete="" this="" qrr?")"="" class="action-icon"> <i class="mdi mdi-delete"></i></a></td><td class="sorting_1">16</td><td>ভোলা</td><td>ভোলা সদর</td><td>উত্তর গাজীপুর</td><td>এলাকা</td><td>15/11/2022 11:00 AM</td><td>15/11/2022 11:00 AM</td><td>15/11/2022 11:00 AM</td><td>0:0:00</td><td>yjhtd</td><td>দস্যুতা</td><td>রাজনৈতিক</td><td></td><td></td><td>01/01/1970</td><td></td><td>01/01/1970</td><td></td><td></td><td></td><td></td><td>4</td><td>এসআই শরীফ আব্দুল মান্নান</td><td></td><td>01710000000</td><td></td><td></td><td></td></tr><tr id="15" role="row" class="odd"><td><a href="https://onlinebdshop.com/admin/qrrs/details/15" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/edit/15" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/delete/15" onclick="return confirm(" do="" you="" want="" to="" delete="" this="" qrr?")"="" class="action-icon"> <i class="mdi mdi-delete"></i></a></td><td class="sorting_1">15</td><td>বরিশাল</td><td>বাবুগঞ্জ</td><td>উত্তর গাজীপুর</td><td>কোর্ট</td><td>09/11/2022 10:00 AM</td><td>09/11/2022 10:00 AM</td><td>08/11/2022 10:00 AM</td><td>24:0:00</td><td>gv</td><td>মারামারি</td><td>রাজনৈতিক</td><td></td><td></td><td>07/11/1990</td><td></td><td>01/01/1970</td><td></td><td>ছত্তার</td><td>0174200000</td><td>1</td><td>6</td><td>ঝরোয়ার</td><td>7808125664</td><td>01710000000</td><td>না</td><td></td><td></td></tr><tr id="14" role="row" class="even"><td><a href="https://onlinebdshop.com/admin/qrrs/details/14" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/edit/14" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/delete/14" onclick="return confirm(" do="" you="" want="" to="" delete="" this="" qrr?")"="" class="action-icon"> <i class="mdi mdi-delete"></i></a></td><td class="sorting_1">14</td><td>বরিশাল</td><td>বাকেরগঞ্জ</td><td>গ্রাম</td><td>এলাকা</td><td>01/11/2022 11:00 AM</td><td>02/11/2022 11:00 AM</td><td>02/11/2022 11:00 AM</td><td>0:0:00</td><td>dddddddddddddddddddd...</td><td>মারামারি</td><td>তুচ্ছ কারণ</td><td></td><td></td><td>01/01/1970</td><td></td><td>01/01/1970</td><td></td><td>Mkdk ddd</td><td>01925664477</td><td>4</td><td></td><td>Moshiur Rahman</td><td>1111</td><td>01925664477</td><td>হ্যা</td><td>সন্তুষ্ট</td><td>ddddd...</td></tr><tr id="13" role="row" class="odd"><td><a href="https://onlinebdshop.com/admin/qrrs/details/13" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/edit/13" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/delete/13" onclick="return confirm(" do="" you="" want="" to="" delete="" this="" qrr?")"="" class="action-icon"> <i class="mdi mdi-delete"></i></a></td><td class="sorting_1">13</td><td>বরিশাল</td><td>বাকেরগঞ্জ</td><td>গ্রাম</td><td>এলাকা</td><td>30/10/2022 09:00 PM</td><td>30/10/2022 09:00 PM</td><td>30/10/2022 09:00 PM</td><td>0:0:00</td><td>gggggggggggggggggggg...</td><td>মারামারি</td><td>জমিজমা</td><td>jjjjj...</td><td>55555555</td><td>30/10/2022</td><td>666666</td><td>30/10/2022</td><td>12</td><td>12</td><td>01111111111</td><td></td><td></td><td>dddddddddd ddddddddddddd</td><td>122</td><td>01925664477</td><td></td><td></td><td>ggggg...</td></tr><tr id="12" role="row" class="even"><td><a href="https://onlinebdshop.com/admin/qrrs/details/12" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/edit/12" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/delete/12" onclick="return confirm(" do="" you="" want="" to="" delete="" this="" qrr?")"="" class="action-icon"> <i class="mdi mdi-delete"></i></a></td><td class="sorting_1">12</td><td>বরিশাল</td><td>বাকেরগঞ্জ</td><td>গ্রাম</td><td>এলাকা</td><td>26/10/2022 08:00 AM</td><td>26/10/2022 08:00 AM</td><td>27/10/2022 08:00 AM</td><td>24:0:00</td><td>dddddddddddddddddddd...</td><td>সড়ক দুর্ঘটনা</td><td>অসতর্কতা</td><td>jjjjj...</td><td>525242</td><td>26/10/2022</td><td>25233</td><td>27/10/2022</td><td>12</td><td>hhhhhhh</td><td>01111111111</td><td>17</td><td>14</td><td>dddddddddd ddddddddddddd</td><td>1111</td><td>01925664477</td><td>হ্যা</td><td>সন্তুষ্ট</td><td>ddddd...</td></tr><tr id="11" role="row" class="odd"><td><a href="https://onlinebdshop.com/admin/qrrs/details/11" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/edit/11" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/delete/11" onclick="return confirm(" do="" you="" want="" to="" delete="" this="" qrr?")"="" class="action-icon"> <i class="mdi mdi-delete"></i></a></td><td class="sorting_1">11</td><td>বরিশাল</td><td>বাকেরগঞ্জ</td><td>গ্রাম</td><td>এলাকা</td><td>18/10/2022 10:30 AM</td><td>24/10/2022 10:30 AM</td><td>19/10/2022 10:30 AM</td><td>120:0:00</td><td>ffffffffffffffffffff</td><td>সাইবার</td><td>ঘটনার সূত্রপাত</td><td></td><td>12345</td><td>26/10/2022</td><td>12345</td><td>27/10/2022</td><td>12</td><td>hhhhhhh</td><td>01925664477</td><td>16</td><td>17</td><td>ccccccccccc</td><td>1111</td><td>01925664477</td><td>হ্যা</td><td>সন্তুষ্ট</td><td>fffff...</td></tr><tr id="10" role="row" class="even"><td><a href="https://onlinebdshop.com/admin/qrrs/details/10" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/edit/10" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> <a href="https://onlinebdshop.com/admin/qrrs/delete/10" onclick="return confirm(" do="" you="" want="" to="" delete="" this="" qrr?")"="" class="action-icon"> <i class="mdi mdi-delete"></i></a></td><td class="sorting_1">10</td><td>বরিশাল</td><td>বাবুগঞ্জ</td><td>গ্রাম</td><td>এলাকা</td><td>18/10/2022 03:00 AM</td><td>19/10/2022 03:00 AM</td><td>19/10/2022 03:00 AM</td><td>0:0:00</td><td>মূল রিপোর্ট
মূল রিপ...</td><td>মারামারি</td><td>ঘটনার সূত্রপাত</td><td></td><td>12345</td><td>19/10/2022</td><td>12345</td><td>19/10/2022</td><td>12</td><td>SM Kamrul</td><td>01925398052</td><td>13</td><td>13</td><td>Moshiur Rahman</td><td>1111</td><td>01619601357</td><td>হ্যা</td><td>সন্তুষ্ট</td><td>মন্তব...</td></tr></tbody>
                                        </table><div id="DataTables_Table_0_processing" class="dataTables_processing card" style="display: none;">Processing...</div></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 10 of 13 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
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
                                                    <th > মূল ঘটনা</th>
                                                    <th > ঘটনার ধরণ </th>
                                                    <th > ঘটনার সূত্রপাত </th>
                                                    <th>  ঘটনার সংক্ষিপ্ত বিবরন</th>
                                                    <th>  গৃহীত ব্যবস্থা</th>
                                                    <th > জিডি নং </th>
                                                    <th > তারিখ </th>
                                                    <th > মামলা নং </th>
                                                    <th > তারিখ </th>
                                                    <th > ধারা </th>
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

                                            @php
function hms ($value) {
    $cal = floor($value / 3600 );
    return  str_pad($cal, 2, '0', STR_PAD_LEFT) . gmdate(":i:s", $value % 3600);
}
@endphp

                                            @if($qrrs)
                                            @foreach ($qrrs as $qrr)
                                               <tr>
                                                    <td class="table-action">
                                                        @can('qrr.view')
                                                        <a href="{{url('admin/qrrs/details/'.$qrr->id)}}"  class="action-icon text-primary">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        @endcan
                                                        @can('qrr.edit')
                                                        <a href="{{url('admin/qrrs/edit/'.$qrr->id)}}" class="action-icon text-success">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        @endcan
                                                        @can('qrr.delete')
                                                        <a href="{{url('admin/qrrs/delete/'.$qrr->id)}}"  onclick="return confirm('Do you want to delete this slider?')" class="action-icon text-danger"> <i class="mdi mdi-delete"></i></a>
                                                        @endcan
                                                    </td>
                                                    <td > {{$qrr->id}}</td>
                                                    <td > @if(isset($qrr->district->name)) {{$qrr->district->bn_name}} @endif</td>
                                                    <td > @if(isset($qrr->thana->name)) {{$qrr->thana->name}} @endif</td>
                                                    <td > {{$qrr->village_word}}</td>
                                                    <td > {{$qrr->source_of_info}}</td>
                                                    <td > @if(!empty($qrr->date_time_of_incident)) {{date('d/m/Y H:i:s', strtotime($qrr->date_time_of_incident))}} @endif</td>
                                                    <td > @if(!empty($qrr->date_time_of_police_news)) {{date('d/m/Y H:i:s', strtotime($qrr->date_time_of_police_news))}} @endif</td>
                                                    <td > @if(!empty($qrr->date_time_response)) {{date('d/m/Y H:i:s', strtotime($qrr->date_time_response))}} @endif</td>
                                                    <td >{{hms($qrr->delay_in_response)}} </td>
                                                    <td > {{ Str::limit($qrr->main_event, 20)}}</td>
                                                    <td > {{$qrr->event_type}}</td>
                                                    <td > {{$qrr->begening_of_event}}</td>
                                                    <td > {{Str::limit($qrr->short_dettails, 5)}}</td>
                                                    <td > {{$qrr->action_taken}}</td>
                                                    <td > {{$qrr->gd_no}}</td>
                                                    <td > @if(!empty($qrr->gd_date)) {{date('d/m/Y', strtotime($qrr->gd_date))}} @endif</td>
                                                    <td > {{$qrr->case_no}}</td>
                                                    <td > @if(!empty($qrr->case_date)) {{date('d/m/Y', strtotime($qrr->case_date))}} @endif</td>
                                                    <td > {{$qrr->clause}}</td>
                                                    <td > {{$qrr->nopc}}</td>
                                                    <td > {{$qrr->plaintiff_mobile}}</td>
                                                    <td > {{$qrr->number_of_victims}}</td>
                                                    <td > {{$qrr->number_of_accused}}</td>
                                                    <td > {{$qrr->name_of_investigator}}</td>
                                                    <td > {{$qrr->bp_no}}</td>
                                                    <td > {{$qrr->mobile_no}}</td>
                                                    <td > {{$qrr->image_video}}</td>
                                                    <td > {{$qrr->media_quality}}</td>
                                                    <td > {{Str::limit($qrr->comments, 5)}}</td>
                                                       
                                                    
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        @if($qrrs){{$qrrs->appends(request()->input())->links()}} @endif
                                      
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <input type="hidden" name="shortable_url" id="shortable_url" value="{{url('admin/qrrs/short')}}">

                     
<x-admin-footer/>