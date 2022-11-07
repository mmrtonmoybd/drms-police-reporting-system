<x-admin-header />

<form target="_blank" action="{{url('admin/narcotic/totalcase/src')}}" method="get">

<div class="col-sm-4 " > 
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"> Date range 1</label>
                  <div class="input-group" id="timepicker-input-group2">
                    
                   <input type="text" name="form1"  value="{{request('form1')}}" id="date_time_response" class="form-control datepicker  @error('form1') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder=" তারিখ শুরু" >
                     <input type="text" name="to1"  value="{{request('to1')}}" id="date_time_response" class="form-control datepicker  @error('to1') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="তারিখ পর্যন্ত" >
                  </div>
               </div>
            </div>
<br><br>

<div class="col-sm-4 " > 
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"> Date range 2</label>
                  <div class="input-group" id="timepicker-input-group2">
                    
                   <input type="text" name="form2"  value="{{request('form2')}}" id="date_time_response" class="form-control datepicker  @error('form2') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder=" তারিখ শুরু" >
                     <input type="text" name="to2"  value="{{request('to2')}}" id="date_time_response" class="form-control datepicker  @error('to2') is-invalid @enderror"  data-date-format="yyyy/mm/dd"  placeholder="তারিখ পর্যন্ত" >
                  </div>
               </div>
            </div>

            <div class="col-sm-2 " >
               <div class="mb-3">
                  <label for="source_of_info" class="form-label"></label>
                  <button type="submit" name="submit" class="btn stylish"> সার্চ করুন </button>
               </div>
            </div>

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
                                            </tbody>
                                        </table>

                                        @endif

                                        @endif

<x-admin-footer/>