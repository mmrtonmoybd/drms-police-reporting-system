<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Print!</title>
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
    

  <div class="container" style="margin-top:170px">
  <div class="row">
                            <div class="col-sm-12 pt-3">
                                
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-12"> 
                                            <table class="table table-bordered">
                                                    <tr>
                                                        <td> <b>রেফারেন্স নং : </b> {{$qrr->id}}</td>
                                                        <td> <b>জেলা : </b> @if(isset($qrr->district->name)){{$qrr->district->bn_name}}@endif</td>
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
                                            </div>
                                          
                                        </div>
                                    </div>
                                
                            </div>
                        </div>

                        <div class="row no-print">
                            <div class="col-sm-12 py-3">
                                <a target="_blank" onclick="window.print();" class="btn btn-success"> <i class="mdi mdi-square-edit-outline"></i>  Print</a>
                            </div>
                        </div>
                        <!-- end row -->

                        <style>
                            .table > :not(caption) > * > *{padding:5px !important}
@media print {
  .no-print{
    display:none;
  }
}
                        </style>
  </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>

window.onload = function() { window.print(); }
    </script>

  </body>
</html>
