
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta charset="utf-8"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
      
  
  <title> Case - {{$case->id}} </title>
      <style type="text/css">
         /*! 
         * Base CSS for pdf2htmlEX
         * Copyright 2012,2013 Lu Wang <coolwanglu@gmail.com> 
         * https://github.com/coolwanglu/pdf2htmlEX/blob/master/share/LICENSE
         */#sidebar{position:absolute;top:0;left:0;bottom:0;width:250px;padding:0;margin:0;overflow:auto}#page-container{position:absolute;top:0;left:0;margin:0;padding:0;border:0}@media screen{#sidebar.opened+#page-container{left:250px}#page-container{bottom:0;right:0;overflow:auto}.loading-indicator{display:none}.loading-indicator.active{display:block;position:absolute;width:64px;height:64px;top:50%;left:50%;margin-top:-32px;margin-left:-32px}.loading-indicator img{position:absolute;top:0;left:0;bottom:0;right:0}}@media print{@page{margin:0}html{margin:0}body{margin:0;-webkit-print-color-adjust:exact}#sidebar{display:none}#page-container{width:auto;height:auto;overflow:visible;background-color:transparent}.d{display:none}}.pf{position:relative;background-color:white;overflow:hidden;margin:0;border:0}.pc{position:absolute;border:0;padding:0;margin:0;top:0;left:0;width:100%;height:100%;overflow:hidden;display:block;transform-origin:0 0;-ms-transform-origin:0 0;-webkit-transform-origin:0 0}.pc.opened{display:block}.bf{position:absolute;border:0;margin:0;top:0;bottom:0;width:100%;height:100%;-ms-user-select:none;-moz-user-select:none;-webkit-user-select:none;user-select:none}.bi{position:absolute;border:0;margin:0;-ms-user-select:none;-moz-user-select:none;-webkit-user-select:none;user-select:none}@media print{.pf{margin:0;box-shadow:none;page-break-after:always;page-break-inside:avoid}@-moz-document url-prefix(){.pf{overflow:visible;border:1px solid #fff}.pc{overflow:visible}}}.c{position:absolute;border:0;padding:0;margin:0;overflow:hidden;display:block}.t{position:absolute;white-space:pre;font-size:1px;transform-origin:0 100%;-ms-transform-origin:0 100%;-webkit-transform-origin:0 100%;unicode-bidi:bidi-override;-moz-font-feature-settings:"liga" 0}.t:after{content:''}.t:before{content:'';display:inline-block}.t span{position:relative;unicode-bidi:bidi-override}._{display:inline-block;color:transparent;z-index:-1}::selection{background:rgba(255,255,0,1.0)}::-moz-selection{background:rgba(255,255,0,1.0)}.pi{display:none}.d{position:absolute;transform-origin:0 100%;-ms-transform-origin:0 100%;-webkit-transform-origin:0 100%}.it{border:0;background-color:rgba(255,255,255,0.0)}.ir:hover{cursor:pointer}
      </style>
      <style type="text/css">
         /*! 
         * Fancy styles for pdf2htmlEX
         * Copyright 2012,2013 Lu Wang <coolwanglu@gmail.com> 
         * https://github.com/coolwanglu/pdf2htmlEX/blob/master/share/LICENSE
         */@keyframes fadein{from{opacity:0}to{opacity:1}}@-webkit-keyframes fadein{from{opacity:0}to{opacity:1}}@keyframes swing{0{transform:rotate(0)}10%{transform:rotate(0)}90%{transform:rotate(720deg)}100%{transform:rotate(720deg)}}@-webkit-keyframes swing{0{-webkit-transform:rotate(0)}10%{-webkit-transform:rotate(0)}90%{-webkit-transform:rotate(720deg)}100%{-webkit-transform:rotate(720deg)}}@media screen{#sidebar{background-color:#000;background-image:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjNDAzYzNmIj48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDBMNCA0Wk00IDBMMCA0WiIgc3Ryb2tlLXdpZHRoPSIxIiBzdHJva2U9IiMxZTI5MmQiPjwvcGF0aD4KPC9zdmc+")}#outline{font-family:Georgia,Times,"Times New Roman",serif;font-size:13px;margin:2em 1em}#outline ul{padding:0}#outline li{list-style-type:none;margin:1em 0}#outline li>ul{margin-left:1em}#outline a,#outline a:visited,#outline a:hover,#outline a:active{line-height:1.2;color:#000;text-overflow:ellipsis;white-space:nowrap;text-decoration:none;display:block;overflow:hidden;outline:0}#outline a:hover{color:#0cf}#page-container{background-color:#ffffff;-webkit-transition:left 500ms;transition:left 500ms}.pf{margin:13px auto;box-shadow:1px 1px 3px 1px #cccccc;border-collapse:separate}.pc.opened{-webkit-animation:fadein 100ms;animation:fadein 100ms}.loading-indicator.active{-webkit-animation:swing 1.5s ease-in-out .01s infinite alternate none;animation:swing 1.5s ease-in-out .01s infinite alternate none}.checked{background:no-repeat url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3goQDSYgDiGofgAAAslJREFUOMvtlM9LFGEYx7/vvOPM6ywuuyPFihWFBUsdNnA6KLIh+QPx4KWExULdHQ/9A9EfUodYmATDYg/iRewQzklFWxcEBcGgEplDkDtI6sw4PzrIbrOuedBb9MALD7zv+3m+z4/3Bf7bZS2bzQIAcrmcMDExcTeXy10DAFVVAQDksgFUVZ1ljD3yfd+0LOuFpmnvVVW9GHhkZAQcxwkNDQ2FSCQyRMgJxnVdy7KstKZpn7nwha6urqqfTqfPBAJAuVymlNLXoigOhfd5nmeiKL5TVTV+lmIKwAOA7u5u6Lped2BsbOwjY6yf4zgQQkAIAcedaPR9H67r3uYBQFEUFItFtLe332lpaVkUBOHK3t5eRtf1DwAwODiIubk5DA8PM8bYW1EU+wEgCIJqsCAIQAiB7/u253k2BQDDMJBKpa4mEon5eDx+UxAESJL0uK2t7XosFlvSdf0QAEmlUnlRFJ9Waho2Qghc1/U9z3uWz+eX+Wr+lL6SZfleEAQIggA8z6OpqSknimIvYyybSCReMsZ6TislhCAIAti2Dc/zejVNWwCAavN8339j27YbTg0AGGM3WltbP4WhlRWq6Q/btrs1TVsYHx+vNgqKoqBUKn2NRqPFxsbGJzzP05puUlpt0ukyOI6z7zjOwNTU1OLo6CgmJyf/gA3DgKIoWF1d/cIY24/FYgOU0pp0z/Ityzo8Pj5OTk9PbwHA+vp6zWghDC+VSiuRSOQgGo32UErJ38CO42wdHR09LBQK3zKZDDY2NupmFmF4R0cHVlZWlmRZ/iVJUn9FeWWcCCE4ODjYtG27Z2Zm5juAOmgdGAB2d3cBADs7O8uSJN2SZfl+WKlpmpumaT6Yn58vn/fs6XmbhmHMNjc3tzDGFI7jYJrm5vb29sDa2trPC/9aiqJUy5pOp4f6+vqeJ5PJBAB0dnZe/t8NBajx/z37Df5OGX8d13xzAAAAAElFTkSuQmCC)}}
      </style>
      <style type="text/css">
         @import url('https://fonts.maateen.me/solaiman-lipi/font.css');
         body {
         font-family: 'SolaimanLipi', Arial, sans-serif !important;
         }
         .ff0{visibility:hidden;}
         .m0{transform:matrix(0.300000,0.000000,0.000000,0.300000,0,0);-ms-transform:matrix(0.300000,0.000000,0.000000,0.300000,0,0);-webkit-transform:matrix(0.300000,0.000000,0.000000,0.300000,0,0);}
         .v0{vertical-align:0.000000px;}
         .ls0{letter-spacing:0.000000px;}
         .sc_{text-shadow:none;}
         .sc0{text-shadow:-0.015em 0 transparent,0 0.015em transparent,0.015em 0 transparent,0 -0.015em  transparent;}
         @media screen and (-webkit-min-device-pixel-ratio:0){
         .sc_{-webkit-text-stroke:0px transparent;}
         .sc0{-webkit-text-stroke:0.015em transparent;text-shadow:none;}
         }
         .ws0{word-spacing:0.000000px;}
         ._0{margin-left:-1.351514px;}
         ._1{width:1.405610px;}
         ._2{width:20.633620px;}
         ._6{width:36.377202px;}
         ._3{width:126.864728px;}
         ._7{width:134.133783px;}
         ._4{width:650.964806px;}
         ._5{width:692.254840px;}
         .fs5{font-size:35.931900px;}
         .fs0{font-size:44.076300px;}
         .fs4{font-size:51.741897px;}
         .fs2{font-size:59.886303px;}
         .fs3{font-size:63.719100px;}
         .fs1{font-size:103.962606px;}
         .y11{bottom:5.039978px;}
         .yc{bottom:5.040005px;}
         .y1e{bottom:5.040032px;}
         .y2{bottom:46.800000px;}
         .y25{bottom:25.735980px;}
         .y24{bottom:318.239978px;}
         .y23{bottom:344.880011px;}
         .y0{bottom:357.000000px;}
         .y22{bottom:358.272015px;}
         .y21{bottom:363.311994px;}
         .y20{bottom:387.935980px;}
         .y1f{bottom:392.976013px;}
         .y1d{bottom:417.311994px;}
         .y1c{bottom:422.352026px;}
         .y1b{bottom:448.560022px;}
         .y1a{bottom:453.600000px;}
         .y19{bottom:480.384009px;}
         .y18{bottom:485.423986px;}
         .y17{bottom:509.040005px;}
         .y16{bottom:514.080011px;}
         .y15{bottom:537.551999px;}
         .y14{bottom:542.592004px;}
         .y13{bottom:568.655996px;}
         .y12{bottom:573.696002px;}
         .y10{bottom:606.384009px;}
         .yf{bottom:611.423986px;}
         .ye{bottom:641.519989px;}
         .yd{bottom:646.5599200px;}
         .yb{bottom:671.471988px;}
         .ya{bottom:676.511994px;}
         .y9{bottom:705.455996px;}
         .y8{bottom:731.520003px;}
         .y7{bottom:757.440005px;}
         .y6{bottom:783.503998px;}
         .y5{bottom:808.848001px;}
         .y4{bottom:833.327998px;}
         .y3{bottom:864.144004px;}
         .y1{bottom:894.672002px;}
         .ha{height:18.575959px;}
         .h9{height:18.575986px;}
         .h8{height:18.576013px;}
         .hc{height:26.264675px;}
         .hb{height:28.410156px;}
         .h7{height:42.635323px;}
         .h2{height:43.839562px;}
         .h4{height:47.350104px;}
         .h5{height:50.380568px;}
         .h6{height:52.504538px;}
         .h3{height:85.665187px;}
         .h1{height:534.600000px;}
         .h0{height:950.400000px;}
         .w5{width:2.1599200px;}
         .w3{width:6.479983px;}
         .w2{width:6.480011px;}
         .w4{width:6.623987px;}
         .w1{width:640.600000px;}
         .w0{width:734.400000px;}
         .x3{left:0.000000px;}
         .x0{left:69.600000px;}
         .xa{left:72.288000px;}
         .x13{left:147.168004px;}
         .xf{left:157.824001px;}
         .xd{left:159.696002px;}
         .x16{left:167.903998px;}
         .x8{left:185.183996px;}
         .x1{left:195.983996px;}
         .x19{left:198.720003px;}
         .x12{left:203.616005px;}
         .x2{left:230.111994px;}
         .xb{left:234.432010px;}
         .x10{left:243.071988px;}
         .x4{left:365.184009px;}
         .x1a{left:367.344004px;}
         .xe{left:379.007996px;}
         .x15{left:407.232010px;}
         .x17{left:427.392005px;}
         .x14{left:436.319989px;}
         .x5{left:467.568018px;}
         .x18{left:487.584009px;}
         .xc{left:495.647974px;}
         .x9{left:496.800000px;}
         .x6{left:521.711994px;}
         .x11{left:534.815991px;}
         .x7{left:665.423987px;}
         .copied {
         position: absolute;
         background: #1266ae;
         color: #fff;
         font-weight: bold;
         z-index: 99;
         width: 100%;
         top: 0;
         text-align: center;
         padding: 15px;
         display: none;
         font-size: 18px;
         }
         @media print {
         .noprint {
         display:none;
         
         }
         
         .h0{height:1900.400000px;}
         
         .printfixed {
             position:fixed;
          
    width: 640.6px;
    height: 534.6px;
    bottom: inherit;
    top: 52px;
}
         .printfixed2 {
             position:fixed;
          
    width: 640.6px;

    bottom: inherit;
    top: -4px;
}
         .printfixed3 {
             position:fixed;
          
    width: 640.6px;

    bottom: inherit;
    top: 68px;
}
         .printfixed4 {
             position:fixed;
          
    width: 640.6px;

    bottom: inherit;
    top: 95px;
}


         .y25 {
    bottom: -80px;
    position:fixed;
}
         }
         
         .y25 {
    bottom: 80px;
}

         }
      </style>
      <script>
         try{
         pdf2htmlEX.defaultViewer = new pdf2htmlEX.Viewer({});
         }catch(e){}
      </script>
      <title></title>
   </head>
   <body>
      <div id="sidebar">
         <div id="outline"></div>
      </div>
      <div id="page-container">
         <div class='copied'></div>
         <div id="pf1" class="pf w0 h0" data-page-no="1">
            <div class="pc pc1 w0 h0">
                
             
               <img class="printfixed bi x0 y0 w1 h1 " alt="" src="{{url('printbg.png')}}" >
               <div class=" t m0 x0 h2 y1 ff1 fs0 fc0 sc0 ls0 ws0"> </div>
               <div class=" t m0 x0 h2 y2 ff1 fs0 fc0 sc0 ls0 ws0"> </div>
               <div class="printfixed2 t m0 x0 h3 y3 ff2 fs1 fc1 sc0 ls0 ws0">মামলা সংক্রান্ত রিপোর্ট</div>
               <div class="printfixed3 t m0 x0 h4 y4 ff3 fs2 fc2 sc0 ls0 ws0">বরিশাল রেঞ্জ, বরিশাল</div>
               <div class="printfixed4 t m0 x0 h4 y5 ff3 fs2 fc2 sc0 ls0 ws0">রেফারেন্স নম্বরঃ  {{$case->id}}</div>
               <div class="t m0 x0 h5 y6 ff3 fs3 fc0 sc0 ls0 ws0"> </div>
            
               
               
               
            <div class="t m0 x0 h6 ff2 fs3 fc1 sc0 ls0 ws0" style=" top: 133px; left: 122px; ">জেলাঃ  @if(isset($case->district->name)){{$case->district->bn_name}}@endif<span class="_ _1">  </span>                        <span class="_ _1"></span>                     <span class="_ _1"></span>   থানাঃ  @if(isset($case->thana->name)){{$case->thana->name}}@endif <span class="_ _2"> </span> </div>
               <div class="t m0 x0 h6 y8 ff2 fs3 fc1 sc0 ls0 ws0"> <span class="_ _3"> </span> <span class="_ _3"> </span> </div>
               <div class="t m0 x0 h6 y9 ff2 fs3 fc1 sc0 ls0 ws0"> <span class="_ _3"> </span> <span class="_ _3"> </span> <span class="_ _3"> </span> <span class="_ _3"> </span> <span class="_ _3"> </span> <span class="_ _3"> </span> <span class="_ _3"> </span> <span class="_ _3"> </span> </div>
               <style>
                  tr { 
                  height: 38px !important;
                  font-size: 14px;
                  }
               </style>
               <button class="noprint"  style="
                  position: absolute;
                  right: 60px;
                  top: 20px;
                  background: #0c0faa;
                  color: #fff;
                  border: none;
                  padding: 10px;
                  border-radius: 10px;
                  cursor: pointer;
                  " 
                  onclick="copyDivToClipboard()">Copy Data </button>
               <button class="noprint"  style="
                  position: absolute;
                  right: 3px;
                  top: 20px;
                  background: green;
                  color: #fff;
                  border: none;
                  padding: 10px;
                  border-radius: 10px;
                  cursor: pointer;
                  " 
                  onclick="window.print()">Print </button>
              
               <div  id="a" class="noprint" style="visibility:; position:absolute; left:2000px;"  > 
           
     					                           রেফারেন্স নং :  {{$case->id}}   <br>   
                                                   জেলা :  @if(isset($case->district->name)){{$case->district->bn_name}}@endif <br>
                                                   সার্কেল :  @if(isset($case->circle->name)){{$case->circle->name}}@endif <br>
                                                   থানা :  @if(isset($case->thana->name)){{$case->thana->bn_name}}@endif <br>
                                                   মামলার কোড (CDMS) :{{$case->cdms_pg_id}}   <br>
                                                   উৎস :{{$case->source_of_info}}   <br>
                                                   জি আর নং :{{$case->gr_no}}   <br>
                                                   মামলা নং :{{$case->case_no}}   <br>
                                                   ধারা :{{$case->dhara}}   <br>
                                                   মামলা তারিখ :@if (!empty($case->case_date)) {{date('d/m/Y', strtotime($case->case_date))}}@endif <br>
                                                   মামলার ধরন :{{$case->casetype->type}}   <br>
                                                   উপধরন :      @if($case->casesubtype != '') {{$case->casesubtype->type}}@endif <br>
				                                   ঘটনার তারিখ :@if (!empty($case->incident_date_time)) {{date('d/m/Y', strtotime($case->incident_date_time))}}@endif <br>
                                                   মামলার সারসংক্ষেপ :{{$case->short_dettails}}   <br>
                                                   এজাহার নামীয় আসামির সংখ্যা :{{$case->azahar_namio_victims}}   <br>
                                                   নিস্পত্তি / মুলতবি :{{$case->nispotti_or_multobi}}   <br>                                
                                                   নিস্পত্তির ধরন :@if ($case->nispotti_type != 0) {{$case->nispotti_type}}@endif <br>
                                                   সিএস/এফ আর নং :{{$case->cs_or_fr_no}}   <br>
                                                   তারিখ :@if (!empty($case->nispotti_date)) {{date('d/m/Y', strtotime($case->nispotti_date))}}@endif <br>
                                                   পুলিশ রিপোর্ট আসামির সংখ্যা :{{$case->police_report_victim}}   <br>                           
                                                   গ্রেফতারকৃত আসামির সংখ্যা :{{$case->number_of_accused}}   <br>
                                                   জামিন প্রাপ্ত :{{$case->jamin_prapto}}   <br>
                                                   পলাতক :{{$case->polatok}}   <br>
                                                   এজাহার বহির্ভুত তদন্তে প্রাপ্ত :{{$case->azahar_vukto_invistigate}}   <br>                                 
                                                   অব্যহিত প্রাপ্ত :{{$case->ovohoti}}   <br>
                                                   ১৬১ গ্রহন (পাবলিক) :{{$case->sixtyone_recive}}   <br>
                                                   ১৬৪ গ্রহন :{{$case->sixtyfour_recive}}   <br>
                                                   তদন্তের মান :{{$case->invistigate_rate}}   <br>
                                                   মন্তব্য:   {{$case->comment}}   <br>
 
                 </div>
   
   
   
               <style>
                  .col-sm-3 {
                  width: 24%;
                  display: inline-table;
                  margin-bottom: 10px;
                  margin-right: 3px;
                  }
               </style>
               <div class="row" style="z-index: 100000;position: absolute;margin: 226px 45px; width:88%; " >
                  <div class="col-sm-12">





														<div class="col-sm-3" style="text-align:right;"> <b>রেফারেন্স নং : </b></div>         <div class="col-sm-3" style=""> {{$case->id}}</div>
                                                        <div class="col-sm-3" style="text-align:right;"> <b>জেলা : </b></div>         <div class="col-sm-3" style=""> @if(isset($case->district->name)){{$case->district->bn_name}}@endif</div>
                                                        <div class="col-sm-3" style="text-align:right;"> <b>সার্কেল : </b></div>         <div class="col-sm-3" style=""> @if(isset($case->circle->name)){{$case->circle->name}}@endif</div>
                                                        <div class="col-sm-3" style="text-align:right;"> <b>থানা : </b></div>         <div class="col-sm-3" style=""> @if(isset($case->thana->name)){{$case->thana->bn_name}}@endif</div>
                                                        
                                                    

                                                    
                                                    <div class="col-sm-3" style="text-align:right;"><b>মামলার কোড(CDMS) :</b></div>         <div class="col-sm-3" style="">{{$case->cdms_pg_id}}</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>উৎস :</b></div>         <div class="col-sm-3" style="">{{$case->source_of_info}}</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>জি আর নং :</b></div>         <div class="col-sm-3" style="">{{$case->gr_no}}</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>মামলা নং :</b></div>         <div class="col-sm-3" style="">{{$case->case_no}}</div>
                                                    

                                                    
                                                    <div class="col-sm-3" style="text-align:right;"><b>ধারা :</b></div>         <div class="col-sm-3" style="">{{$case->dhara}}</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>মামলা তারিখ :</b></div>         <div class="col-sm-3" style="">@if (!empty($case->case_date)) {{date('d/m/Y', strtotime($case->case_date))}} @endif</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>মামলার ধরন :</b></div>         <div class="col-sm-3" style="">{{$case->casetype->type}}</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>উপধরন :</b></div>         <div class="col-sm-3" style="">   @if($case->casesubtype != '') {{$case->casesubtype->type}} @endif   </div>
      

                                                    
                                                    <div class="col-sm-3" style="text-align:right;"><b>ঘটনার তারিখ :</b></div>         <div class="col-sm-3" style="">@if (!empty($case->incident_date_time)) {{date('d/m/Y', strtotime($case->incident_date_time))}} @endif</div>
                                                   <div class="col-sm-3" style="text-align:right;"><b>এজাহার নামীয় আসামির সংখ্যা :</b></div>         <div class="col-sm-3" style="">{{$case->azahar_namio_victims}}</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>মামলার সারসংক্ষেপ :</b></div>       
                                                    
                                                    <div class="col-sm-3" style="width: 72%;">{{$case->short_dettails}}</div>
                                                 
                                                    <div class="col-sm-3" style="text-align:right;"><b>নিস্পত্তি / মুলতবি :</b></div>         <div class="col-sm-3" style="">{{$case->nispotti_or_multobi}}</div>
                                                    

                                                    
                                                    <div class="col-sm-3" style="text-align:right;"><b>নিস্পত্তির ধরন :</b></div>         <div class="col-sm-3" style="">@if ($case->nispotti_type != 0) {{$case->nispotti_type}} @endif</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>সিএস/এফ আর নং :</b></div>         <div class="col-sm-3" style="">{{$case->cs_or_fr_no}}</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>তারিখ :</b></div>         <div class="col-sm-3" style="">@if (!empty($case->nispotti_date)) {{date('d/m/Y', strtotime($case->nispotti_date))}} @endif</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>পুলিশ রিপোর্ট আসামির সংখ্যা :</b></div>         <div class="col-sm-3" style="">{{$case->police_report_victim}}</div>
                                                    

                                                    
                                                    <div class="col-sm-3" style="text-align:right;"><b>গ্রেফতারকৃত আসামির সংখ্যা :</b></div>         <div class="col-sm-3" style="">{{$case->number_of_accused}}</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>জামিন প্রাপ্ত :</b></div>         <div class="col-sm-3" style="">{{$case->jamin_prapto}}</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>পলাতক :</b></div>         <div class="col-sm-3" style="">{{$case->polatok}}</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>এজাহার বহির্ভুত তদন্তে প্রাপ্ত :</b></div>         <div class="col-sm-3" style="">{{$case->azahar_vukto_invistigate}}</div>
                                                    

                                                    
                                                    <div class="col-sm-3" style="text-align:right;"><b>অব্যহিত প্রাপ্ত :</b></div>         <div class="col-sm-3" style="">{{$case->ovohoti}}</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>১৬১ গ্রহন (পাবলিক) :</b></div>         <div class="col-sm-3" style="">{{$case->sixtyone_recive}}</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>১৬৪ গ্রহন :</b></div>         <div class="col-sm-3" style="">{{$case->sixtyfour_recive}}</div>
                                                    <div class="col-sm-3" style="text-align:right;"><b>তদন্তের মান :</b></div>         <div class="col-sm-3" style="">{{$case->invistigate_rate}}</div>

                                                    <div class="col-sm-3" style="text-align:right;"><b>মন্তব্য  :</b></div>         <div class="col-sm-3" style="">{{$case->invistigate_rate}}</div>
												    <div class="col-sm-3" style="text-align:right;"><b> {{$case->comment}}</b></div>         <div class="col-sm-3" style="">{{$case->invistigate_rate}}</div>
                                                 



                     
                     
                     
                  </div>
               </div>
               <script>
                  function copyDivToClipboard() {
                   var range = document.createRange();
                  range.selectNode(document.getElementById("a"));
                   window.getSelection().removeAllRanges(); // clear current selection
                   window.getSelection().addRange(range); // to select text
                   document.execCommand("copy");
                   
                   window.getSelection().removeAllRanges();// to deselect
                   
                    $(".copied").text("Copied to clipboard").show().fadeOut(1200);
                  }
                  
                  
                  
               </script>
               <div class="t m0 x0 hc y25 ff4 fs5 fc3 sc0 ls0 ws0">Report Print: <?php echo date('d/m/Y H:i', time()); ?><span class="_ _0"></span> <span class="_ _6"> </span> <span class="_ _7"> </span> <span class="_ _7"> </span> <span class="_ _7"> </span> <span class="_ _7"> </span> <span class="_ _7"> </span> <span class="_ _7"> </span>       ICT Barishal Range, Barishal </div>
            </div>
            <div class="pi" data-data='{"ctm":[1.200000,0.000000,0.000000,1.200000,0.000000,0.000000]}'></div>
         </div>
      </div>
      <div class="loading-indicator">
         <img alt="" src="data:image/png;base64,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"/>
      </div>
   </body>
</html>












