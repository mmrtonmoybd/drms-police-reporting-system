<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <style>
@import url('https://fonts.maateen.me/solaiman-lipi/font.css');
*{
    font-size:13px
}
body{
	font-family: Nunito, 'SolaimanLipi', sans-serif;
}
    </style>

    </head>
    <body>

    <!-- Unique name for pdf exampla . itz prase like 544g2vf.pdf

{{$pdfname}}-->
<table >
                                                    <tr>
                                                        <td> রেফারেন্স নং :  {{$qrr->id}}</td>
                                                        <td> জেলা :  @if(isset($qrr->district->name)){{$qrr->district->bn_name}}@endif</td>
                                                        <td> <b>থানা : </b> @if(isset($qrr->thana->name)){{$qrr->thana->name}}@endif</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> গ্রাম/ওয়ার্ড : </b> {{$qrr->village_word}}</td>
                                                        <td> <b>তথ্য প্রাপ্তির উৎস : </b> {{$qrr->source_of_info}}</td>
                                                        <td> <b>ঘটনার তারিখ ও সময় : </b> @if($qrr->date_time_of_incident) {{date('d/m/Y h:i A', strtotime($qrr->date_time_of_incident))}} @endif</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> পুলিশের সংবাদ প্রাপ্তির তারিখ ও সময়  : </b> @if($qrr->date_time_of_police_news) {{date('d/m/Y h:i A', strtotime($qrr->date_time_of_police_news))}} @endif
                                                        </td>
                                                        <td> <b>রেসপন্সের তারিখ ও সময় : </b> @if($qrr->date_time_response) {{date('d/m/Y h:i A', strtotime($qrr->date_time_response))}} @endif
                                                        </td>
                                                        <td> <b>রেসপন্সে বিলম্ব : </b> 
                                                        @php

                                                        $minutes = $qrr->delay_in_response;
                                                        $hours = intdiv($minutes, 60).':'. ($minutes % 60);
                                                        $minutes = $qrr->delay_in_response;
                                                        $hours = floor($minutes / 60).':'.($minutes - floor($minutes / 60) * 60).':00';

                                                        @endphp

                                                        {{$hours}} 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>মূল ঘটনা: </b>{{$qrr->main_event}}</td>
                                                        <td> <b>ঘটনার ধরণ: </b> {{$qrr->event_type}}</td>
                                                        <td>  <b>ঘটনার সূত্রপাত: {{$qrr->begening_of_event}}</b>  </td>
                                                        <td>  <b>ঘটনার সংক্ষিপ্ত বিবরন: {{$qrr->short_dettails}}</b>  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> জিডি নং: </b>{{$qrr->gd_no}}</td>
                                                        <td> <b>তারিখ: </b> @if($qrr->gd_date) {{date('d/m/Y', strtotime($qrr->gd_date))}} @endif</td>
                                                        <td>  <b> মামলা নং : {{$qrr->case_no}}</b>  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> তারিখ: </b> @if($qrr->case_date) {{date('d/m/Y', strtotime($qrr->case_date))}} @endif</td>
                                                        <td> <b>ধারা: </b> {{$qrr->clause}}</td>
                                                        <td>  <b>  বাদীর/ সংবাদদাতার নাম : {{$qrr->nopc}}</b>  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>  বাদীর মোবাইল নং: </b> {{$qrr->plaintiff_mobile}}</td>
                                                        <td> <b> ভিকটিমের সংখ্যা: </b>  {{$qrr->number_of_victims}}</td>
                                                        <td>  <b>  এজাহারভুক্ত আসামীর সংখ্যা: {{$qrr->number_of_accused}}</b>  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>   রেসপন্সকারী/ তদন্তকারী কর্মকর্তার নাম: </b> {{$qrr->name_of_investigator}}</td>
                                                        <td> <b>  বিপি নং: </b>  {{$qrr->bp_no}}</td>
                                                        <td>  <b>   মোবাইল নং: {{$qrr->mobile_no}}</b>  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>  ছবি/ভিডিও প্রাপ্তি: </b> {{$qrr->image_video}}</td>
                                                        <td colspan="2"> <b>   সন্তুষ্টির মান: </b>  {{$qrr->media_quality}}</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                        <b>   মন্তব্য: </b>  {{$qrr->commetns}}
                                                        </td>
                                                    </tr>
                                                </table>
    </body>
   
</html>