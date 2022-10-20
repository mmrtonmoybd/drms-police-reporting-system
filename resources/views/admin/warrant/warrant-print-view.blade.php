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
                                                        <td> <b>রেফারেন্স নং : </b> {{$war->id}}</td>
                                                        <td> <b>জেলা : </b> @if(isset($war->district->name)){{$war->district->bn_name}}@endif</td>
                                                        <td> <b>থানা : </b> @if(isset($war->thana->name)){{$war->thana->name}}@endif</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> তারিখ : </b> {{date('d-M-Y', strtotime($war->date))}}</td>
                                                        <td> <b>জিআর রিসিভ : </b> {{$war->gr_recive}}</td>
                                                        <td> <b>সিআর রিসিভ : </b> {{$war->cr_recive}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> সাজা জিআর রিসিভ  : </b> {{$war->saja_gr_recive}}
                                                        </td>
                                                        <td> <b>সাজা সিআর রিসিভ : </b> {{$war->saja_cr_recive}}
                                                        </td>
                                                        <td> <b>মোট রিসিভ : </b> {{$war->gr_recive + $war->cr_recive + $war->saja_gr_recive + $war->saja_cr_recive}} 
                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b>জিআর তামিল: </b> {{$war->gr_tamil}}</td>
                                                        <td> <b>সিআর তামিল: </b> {{$war->cr_tamil}}</td>
                                                        <td>  <b>সাজা জিআর তামিল: </b>  {{$war->saja_gr_tamil}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> সাজা সিআর তামিল: </b> {{$war->saja_cr_tamil}}</td>
                                                        <td> <b>রিকল ও অন্যান্য: </b>  {{$war->recall_other}}</td>
                                                        <td>  <b> মোট তামিল :  </b>  {{$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <b> মোট নিষ্পত্তি: </b>  {{$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil + $war->recall_other}}</td>
                                                        <td> <b>দিনশেষে পেন্ডিং: fun kra lgba</b> </td>
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
