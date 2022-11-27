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
                                                        <td> <b>রেফারেন্স নং : </b> {{$woman->reference_no}}</td>
                                                        <td> <b>জেলা : </b> @if(isset($woman->district->name)){{$woman->district->bn_name}}@endif</td>
                                                        <td> <b>থানা : </b> @if(isset($woman->thana->name)){{$woman->thana->name}}@endif</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> গ্রাম/ওয়ার্ড : </b> {{$woman->village_word}}</td>
                                                        <td> <b>আগমনের তারিখ ও সময় : </b> @if(!empty($woman->wdate)) {{date('d/m/Y H:i', strtotime($woman->wdate))}} @endif</td>
                                                        <td> <b>ঘটনার ধরণ: </b> {{$woman->event_type}}</td>
                                                        <td>  <b>ঘটনার সূত্রপাত: {{$woman->begening_of_event}}</b>  </td>
                                                        <td>  <b>ঘটনার সংক্ষিপ্ত বিবরন: {{$woman->short_dettails}}</b>  </td>
                                                        <td> <b>বাদীর নাম : </b> {{$woman->badi_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> বাদীর বয়স  : </b> {{$woman->badi_age}}
                                                        </td>
                                                        <td> <b>বাদীর ঠিকানা : </b> {{$woman->badi_address}}
                                                        </td>
                                                        <td> <b>বাদীর মোবাইল নং : </b> {{$woman->badi_phone}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>বিবাদীর নাম: </b>{{$woman->vbadi_name}}</td>
                                                        <td> <b>বিবাদীর ঠিকানা: </b> {{$woman->vbadi_address}}</td>
                                                        <td>  <b>অভিযোগের কারন:</b> {{$woman->complaint_reson}}  </td>
                                                        <td>  <b>তদন্তকারী কর্মকর্তার নাম:</b> {{$woman->investigator_name}}  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> তদন্তকারী কর্মকর্তার পদবী: </b>{{$woman->investigator_title}}</td>
                                                        <td> <b>মোবাইল নং: </b> {{$woman->mobile_no}}</td>
                                                        <td>  <b> জিডি নং :</b> {{$woman->gd_no}}  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> তারিখ: </b> @if(!empty($woman->gd_date)) {{date('d/m/Y', strtotime($woman->gd_date))}} @endif</td>
                                                        <td> <b>মামলা নং: </b> {{$woman->mamla_no}}</td>
                                                        <td>  <b>তারিখ : @if(!empty($woman->mamla_date)) {{date('d/m/Y', strtotime($woman->mamla_date))}} @endif</b>  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>  ধারা: </b> {{$woman->dhara}}</td>
                                                        <td> <b> অভিযোগ নং: </b>  {{$woman->complaint_no}}</td>
                                                        <td>  <b>  সমস্যা সমাধান হয়েছে কিনা:</b> {{$woman->problem_fix}}  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>   গৃহীত ব্যবস্থা: </b>{{$woman->action_taken}}</td>
                                                        <td> <b>  নিষ্পত্তি রিপোর্ট: </b> {{$woman->nreport}}</td>
                                                        <td colspan="2"> <b>   সন্তুষ্টির মান: </b>  {{$woman->satisfy_rate}}</td>
                                                        
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3">
                                                        <b>   মন্তব্য: </b>  {{$woman->comment}}
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
