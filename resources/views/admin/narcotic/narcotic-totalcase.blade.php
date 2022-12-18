<x-admin-header />

<x-admin-validation-errors :errors="$errors->all()"/>

<form target="_blank" action="{{url('admin/narcotic/totalcase/src')}}" method="get">

<div class="col-sm-4 " > 
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"> Date range 1</label>
                  <div class="input-group" id="timepicker-input-group2">
                    
                   <input type="text" name="form1"  value="{{request('form1')}}" id="date_time_response" class="form-control searchdatepick  @error('form1') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder=" তারিখ শুরু" required>
                     <input type="text" name="to1"  value="{{request('to1')}}" id="date_time_response" class="form-control searchdatepick  @error('to1') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="তারিখ পর্যন্ত" required>
                  </div>
               </div>
            </div>
<br><br>

<div class="col-sm-4 " > 
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"> Date range 2</label>
                  <div class="input-group" id="timepicker-input-group2">
                    
                   <input type="text" name="form2"  value="{{request('form2')}}" id="date_time_response" class="form-control searchdatepick  @error('form2') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder=" তারিখ শুরু" required>
                     <input type="text" name="to2"  value="{{request('to2')}}" id="date_time_response" class="form-control searchdatepick  @error('to2') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="তারিখ পর্যন্ত" required>
                  </div>
               </div>
            </div>

            <div class="col-sm-2 " >
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <button type="submit" name="submit" class="btn stylish"> সার্চ করুন </button>
               </div>
            </div>
</form>

<div class="row">
                            <div class="col-sm-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive">

             @if ($request->has('submit'))

             @if (!empty($request->input('form1')) || !empty($request->input('to1')))

             <caption>{{$monnf1}} -- {{$monnt1}} Narcotic case number</caption>

            <table class="table table-bordered table-striped table-centered mb-0">

                                               
                                            <thead>
                                                <tr>
                                                    
                                                     @if (auth()->user()->hasRole('Super Admin'))
                                                    <th > জেলা </th>
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                    <th > থানা </th>
                                                    @endif
                                                    <th > গাঁজা (Kg) </th>
                                                    <th > গাঁজা গাছ (সংখ্যা) </th>
                                                    <th > ইয়াবা (পিচ) </th>
                                                    <th > ইরোইন (গ্রাম) </th>
                                                    <th > ফেনসিডিল (বোতল) </th>
                                                    <th > চোলাই মদ (লিটার) </th>
                                                    <th > বিদেশী মদ (লিটার) </th>
                                                    <th > এলএসডি (মাইক্রোগ্রাম) </th>
                                                    <th > আইস (মাইক্রোগ্রাম) </th>
                                                    <th > আন্যান্য </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if($narcotic1)
                                            @foreach($narcotic1 as $narcotic)
                                                <tr>
                                                    @if (auth()->user()->hasRole('Super Admin'))
                                                    <td >{{$narcotic->district->bn_name}}</td>
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                    <td >{{$narcotic->thana->bn_name}}</td>
                                                    @endif
                                                    <td >{{$narcotic->gazac / 1000}}</td>
                                                    <td >{{$narcotic->gaza_treec}}</td>
                                                    <td >{{$narcotic->yabac}}</td>
                                                    <td >{{$narcotic->heroinec}}</td>
                                                    <td >{{$narcotic->fansdelc}}</td>
                                                    <td >{{$narcotic->cholai_alcoholc}}</td>
                                                    <td >{{$narcotic->bidesh_alcoholc}}</td>
                                                    <td >{{$narcotic->lsdc}}</td>
                                                    <td >{{$narcotic->icec}}</td>
                                                    <td >{{$narcotic->otherdc}}</td>

                                                    
                                                </tr>
                                                @endforeach
                                                 <tr>
                                                    <td >Grand Total</td>
                                                    <td >{{$gtgaza1 / 1000}}</td>
                                                    <td >{{$gtgazatree1}}</td>
                                                    <td >{{$gtyaba1}}</td>
                                                    <td >{{$gtheroine1}}</td>
                                                    <td >{{$gtfansdel1}}</td>
                                                    <td >{{$gtcholai_alcohol1}}</td>
                                                    <td >{{$gtbidesh_alcohol1}}</td>
                                                    <td >{{$gtlsd1}}</td>
                                                    <td >{{$gtice1}}</td>
                                                    <td >{{$gtotherd1}}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        @endif

            @if (!empty($request->input('form2')) || !empty($request->input('to2')))

             <caption>{{$monnf2}} -- {{$monnt2}} Narcotic case number</caption>

            <table class="table table-bordered table-striped table-centered mb-0">

                                               
                                            <thead>
                                                <tr>
                                                    
                                                     @if (auth()->user()->hasRole('Super Admin'))
                                                    <th > জেলা </th>
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                    <th > থানা </th>
                                                    @endif
                                                    <th > গাঁজা (Kg) </th>
                                                    <th > গাঁজা গাছ (সংখ্যা) </th>
                                                    <th > ইয়াবা (পিচ) </th>
                                                    <th > ইরোইন (গ্রাম) </th>
                                                    <th > ফেনসিডিল (বোতল) </th>
                                                    <th > চোলাই মদ (লিটার) </th>
                                                    <th > বিদেশী মদ (লিটার) </th>
                                                    <th > এলএসডি (মাইক্রোগ্রাম) </th>
                                                    <th > আইস (মাইক্রোগ্রাম) </th>
                                                    <th > আন্যান্য </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if ($narcotic2)

                                            @foreach($narcotic2 as $narcotic)
                                                <tr>
                                                    @if (auth()->user()->hasRole('Super Admin'))
                                                    <td >{{$narcotic->district->bn_name}}</td>
                                                    @elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))
                                                    <td >{{$narcotic->thana->bn_name}}</td>
                                                    @endif
                                                    <td >{{$narcotic->gazac / 1000}}</td>
                                                    <td >{{$narcotic->gaza_treec}}</td>
                                                    <td >{{$narcotic->yabac}}</td>
                                                    <td >{{$narcotic->heroinec}}</td>
                                                    <td >{{$narcotic->fansdelc}}</td>
                                                    <td >{{$narcotic->cholai_alcoholc}}</td>
                                                    <td >{{$narcotic->bidesh_alcoholc}}</td>
                                                    <td >{{$narcotic->lsdc}}</td>
                                                    <td >{{$narcotic->icec}}</td>
                                                    <td >{{$narcotic->otherdc}}</td>
                                                </tr>
                                                
                                                @endforeach
                                                 <tr>
                                                    <td >Grand Total</td>
                                                    <td >{{$gtgaza2 / 1000}}</td>
                                                    <td >{{$gtgazatree2}}</td>
                                                    <td >{{$gtyaba2}}</td>
                                                    <td >{{$gtheroine2}}</td>
                                                    <td >{{$gtfansdel2}}</td>
                                                    <td >{{$gtcholai_alcohol2}}</td>
                                                    <td >{{$gtbidesh_alcohol2}}</td>
                                                    <td >{{$gtlsd2}}</td>
                                                    <td >{{$gtice2}}</td>
                                                    <td >{{$gtotherd2}}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        @endif

                                         <table class="table table-bordered table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 86px">Action</th>
                                                    <th > রেফারেন্স নং </th>
                                                    <th > ট্র্যাকিং নং </th>
                                                    <th> ক্রমিক নং </th>
                                                    <th > ফোল্ডার নং </th>
                                                    <th > জেলা </th>
                                                    <th > থানা </th>
                                                    <th > গ্রাম/ওয়ার্ড </th>
                                                    <th > ঘটনার তারিখ </th>
                                                    <th > মামলা নং </th>
                                                    <th > ধারা </th>
                                                    <th > অভিযান পরিচালনাকারী সংস্থা </th>
                                                    <th > অভিযান পরিচালনাকারী অফিসার  </th>
                                                    <th > বিপি নং </th>
                                                    <th > মোবাইল নং </th>
                                                    <th > গাঁজা (Kg) </th>
                                                    <th > গাঁজা গাছ (সংখ্যা) </th>
                                                    <th > ইয়াবা (পিচ) </th>
                                                    <th > ইরোইন (গ্রাম) </th>
                                                    <th > ফেনসিডিল (বোতল) </th>
                                                    <th > চোলাই মদ (লিটার) </th>
                                                    <th > বিদেশী মদ (লিটার) </th>
                                                    <th > এলএসডি (মাইক্রোগ্রাম) </th>
                                                    <th > আইস (মাইক্রোগ্রাম) </th>
                                                    <th > আন্যান্য </th>
                                                    <th > গ্রেফতারকৃত আসামীর সংখ্যা </th>
                                                    <th > অভিযুক্ত </th>
                                                    <th > ছবি তোলা হয়েছে </th>
                                                    <th > জব্দ তালিকা  </th>
                                                    <th > মাদকের রিপোর্ট প্রাপ্তি </th>
                                                    <th > তদন্তের ফলাফল (CS নং) </th>
                                                    <th > তারিখ </th>
                                                    <th > মন্তব্য  </th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @php 

                                            function incon($str) {

                                                return (int) $str;
                                            }
                                            @endphp

                                            @if($narcoticdatas)
                                            @foreach ($narcoticdatas as $nar)
                                                <tr>
                                                    <td class="table-action">
                                                        <a href="{{url('admin/narcotic/view/'.$nar->id)}}"  class="action-icon text-primary">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        @can('narcotic.edit')
                                                        <a href="{{url('admin/narcotic/edit/'.$nar->id)}}" class="action-icon text-success">  <i class="mdi mdi-square-edit-outline"></i></a>
                                                        @endcan
                                                        @can('narcotic.delete')
                                                        <a href="{{url('admin/narcotic/delete/'.$nar->id)}}"  onclick="return confirm('Do you want to delete this slider?')" class="action-icon text-danger"> <i class="mdi mdi-delete"></i></a>
                                                       @endcan
                                                    </td>
                                                    <td > {{$nar->id}}</td>
                                                    <td > {{$nar->trakingID}}</td>
                                                    <td> {{$nar->serial}}</td>
                                                    <td > {{$nar->folder_no}}</td>
                                                    <td > @if(isset($nar->district->name)) {{$nar->district->bn_name}} @endif</td>
                                                    <td > @if(isset($nar->thana->name)) {{$nar->thana->name}} @endif</td>
                                                    <td > {{$nar->village_word}}</td>
                                                    <td > {{date('d/m/Y', strtotime($nar->sdate))}}</td>
                                                    <td > {{$nar->case_no}}</td>
                                                    <td > {{$nar->nopc}}</td>
                                                    <td > {{$nar->name_of_investigator_org}}</td>
                                                    <td > {{$nar->name_of_investigator}}</td>
                                                    <td > {{$nar->bp_no}}</td>
                                                    <td > {{$nar->mobile_no}}</td>
                                                    <td > {{incon($nar->gaza) / 1000 }}</td>
                                                    <td > {{$nar->gaza_tree}}</td>
                                                    <td > {{$nar->yaba}}</td>
                                                    <td > {{$nar->heroine}}</td>
                                                    <td > {{$nar->fansdel}}</td>
                                                    <td > {{$nar->cholai_alcohol}}</td>
                                                    <td > {{$nar->bidesh_alcohol}}</td>
                                                    <td > {{$nar->lsd}}</td>
                                                    <td > {{$nar->ice}}</td>
                                                    <td > {{$nar->otherd}}</td>
                                                    <td > {{$nar->number_of_accused}}</td>
                                                    <td > {{Str::limit($nar->accused)}}</td>
                                                    <td > {{$nar->image_video}}</td>
                                                    <td > {{$nar->jobdo_list}}</td>
                                                    <td > {{$nar->narocotic_test_report}}</td>
                                                    <td > {{$nar->investigate_result}}</td>
                                                    <td > {{date('d/m/Y', strtotime($nar->tdate))}}</td>
                                                    <td > {{Str::limit($nar->comment, 5)}}</td>
                                                    
                                                </tr>

                                            @endforeach
                                            @endif


                                            

                                            </tbody>
                                        </table>
                                        
                                        <nav class="mt-3">

                                        @if($narcoticdatas){{$narcoticdatas->appends(request()->input())->links()}} @endif
                                      
                                        </nav>

                                   

                                        @endif

                                         </div>
                                </div>
                            </div>
                                        </div>

<x-admin-footer/>