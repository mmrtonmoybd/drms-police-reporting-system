<!DOCTYPE html>
<html lang="en" >
   

   <head> 
     <meta http-equiv="content-type" content="text/html;charset=utf-8" />
      <meta http-equiv="x-ua-compatible" content="IE=edge" />
      <meta charset="utf-8">
      <title>LOGIN</title>
      

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" integrity="sha512-QKC1UZ/ZHNgFzVKSAhV5v5j73eeL9EEN289eKAEFaAjgAiobVAnVv/AGuPbXsKl1dNoel3kNr6PYnSiTzVVBCw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css'>



<link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('i/app_ui/css/Core.min9ee3.css?v=5.1.0.00.45') }}" type="text/css" />
      <link rel="stylesheet" href="{{ asset('i/app_ui/css/Theme-Standard.min9ee3.css?v=5.1.0.00.45') }}" type="text/css" />
      <link rel="stylesheet" href="{{ asset('i/libraries/jquery-ui/1.10.4/themes/base/jquery-ui.min9ee3.css?v=5.1.0.00.45') }}" type="text/css" />

      <link rel="stylesheet" href="{{ asset('i/themes/theme_42/1.1/css/Core.minify.css?v=5.1.0.00.45') }}" type="text/css" />
      <link rel="stylesheet" href="{{ asset('r/webcdms/100/files/theme/42/v66/3475952646620645525.css_%3b%20%20filename_%3dutf-8%27%273475952646620645525.css') }}" type="text/css" />
     
     
      <style type="text/css">
      
      body {
          
          font-family:Arial;
background: rgb(105,155,200);
background: -moz-radial-gradient(top left, ellipse cover, rgba(105,155,200,1) 0%, rgba(181,197,216,1) 57%);
 background: -webkit-gradient(radial, top left, 0px, top left, 100%, color-stop(0%,rgba(105,155,200,1)), color-stop(57%,rgba(181,197,216,1)));
 background: -webkit-radial-gradient(top left, ellipse cover, rgba(105,155,200,1) 0%,rgba(181,197,216,1) 57%);
 background: -o-radial-gradient(top left, ellipse cover, rgba(105,155,200,1) 0%,rgba(181,197,216,1) 57%);
 background: -ms-radial-gradient(top left, ellipse cover, rgba(105,155,200,1) 0%,rgba(181,197,216,1) 57%);
 background: radial-gradient(ellipse at top left, rgba(105,155,200,1) 0%,rgba(181,197,216,1) 57%);
 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#699bc8', endColorstr='#b5c5d8',GradientType=1 );
}
      
      
      
      .t-Cards .t-Cards-item .t-Card {
  margin: 7px;
  border-radius: 9px;
  border-color: #8be3c5;
  border-style: inset;
  border: #610b23 solid 2px;
}


      
      .t-Form-inputContainer input[type="text"], .t-Form-inputContainer input.text_field, .t-Form-inputContainer input.password, .t-Form-inputContainer textarea.textarea, .t-Form-inputContainer input.datepicker, .t-Form-inputContainer span.display_only, .t-Form-inputContainer input.popup_lov, .t-Form-inputContainer select, .u-TF-item--text, .u-TF-item--textarea, .u-TF-item--datepicker, .u-TF-item--select {
	border-radius: 2px;
	color: #393939;
	background-color: #6549ec30;
	border-color: #dfdfdf3b;
}


.t-Form-inputContainer input[type="text"]:hover, .t-Form-inputContainer input.text_field:hover, .t-Form-inputContainer input.password:hover, .t-Form-inputContainer textarea.textarea:hover, .t-Form-inputContainer input.datepicker:hover, .t-Form-inputContainer span.display_only:hover, .t-Form-inputContainer input.popup_lov:hover, .t-Form-inputContainer select:hover, .u-TF-item--text:hover, .u-TF-item--textarea:hover, .u-TF-item--datepicker:hover, .u-TF-item--select:hover {
	background-color: #0d00a475;
}


.t-Form-inputContainer input[type="text"]:hover, .t-Form-inputContainer input.text_field:hover, .t-Form-inputContainer input.password:hover, .t-Form-inputContainer textarea.textarea:hover, .t-Form-inputContainer input.datepicker:hover, .t-Form-inputContainer span.display_only:hover, .t-Form-inputContainer input.popup_lov:hover, .t-Form-inputContainer select:hover, .u-TF-item--text:hover, .u-TF-item--textarea:hover, .u-TF-item--datepicker:hover, .u-TF-item--select:focus {
	background-color: #0d00a475;
}


      
      .t-Cards--featured .t-Card .t-Card-wrap, .t-Card--featured .t-Card-wrap {
	background-color: #fff0;
}

.t-Cards .t-Cards-item .t-Card {
	margin: 7px;
	border-radius: 8px;
	/* border-color: #8be3c5; */
	/* border-style: inset; */
	border: #610b23 solid 2px;
}
      
      .t-Login-region {
  background-color: #ffffff36;
}

         ::-webkit-scrollbar {
         display: none;
         }
         .t-Body-contentInner {
         margin: 0 auto;
         max-width: 100%;
         align-items: center;
         display: flex;
         justify-content: center;
         }
         .t-Cards--featured .t-Card .t-Card-titleWrap {
         display: block;
         padding: 15px 0px 0px 13px;
         }
         .t-Cards--featured .t-Card .t-Card-body {
         border-top: 0px solid rgba(0,0,0,.05);
         padding: 0px 20px;
         }
         .t-Cards-item {
         position: relative;
         float: none;
         display: contents;
         }
         .t-Cards .t-Cards-item .t-Card {
         margin: 7px;
         border-radius: 30px;
         /* border-color: #8be3c5; */
         /* border-style: inset; */
         border: #610b23 solid 2px;
         }
         .t-Card-info {
         font-size: 1.1rem;
         line-height: 1.6rem;
         margin-top: 0px;
         }
         span.t-Login-logo { 
         background-image: url({{ asset('drms-trp.png') }});
         background-size: cover;
         background-color: transparent;
         width: 200px;
         height :200px;
         }
         #pass-status.fa.field-icon {
         top: 12px;
         }
         .t-Login-header {
         padding: 2px;
         }
         #t_Header {
         display: none;
         }
         #t_Body_content_offset {
         display: none;
         }
         #t_Body_title {
         display: none;
         }
         .t-Footer{
         display: none;
         }
         #.t-Body-alert {
         margin: 0;
         display: none;
         }
         .t-Header-nav {
         display: none;
         }
         .t-NavigationBar {
         display: none;
         }
         #for .t-Form-fieldContainer--radioButtonGroup .apex-item-radio input+label {
         color: #383838;
         background-color: #040962;
         }
         .field-icon {
         right : 5px;
         top : 4px;
         margin-left: -25px;
         position: relative;
         z-index: 2;
         color: #000000
         }
         #mtrl .t-Region-headerItems--title { 
         font-size:25px;
         text-align: center !important;
         background-color: #356ea3;
         }
         #notice {
         height : 400px !important;
         }
         #caps_lock_on {
         font-size: 12px;
         font-weight: 700;
         margin: -10px 0 0 0;
         color: #c0392b;
         display: none;
         }
      </style>
      <link rel="icon" href="{{ asset('b-range.png') }}" type="image/jpeg">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
   </head>
   <body class="t-PageBody t-PageBody--hideLeft t-PageBody--hideActions no-anim   apex-top-nav apex-icons-fontapex"   id="t_PageBody">
       
       
       
      <form method="POST" action="{{ route('login') }}">
        @csrf
       
         <input type="hidden" name="p_flow_id" value="100" id="pFlowId" /><input type="hidden" name="p_flow_step_id" value="101" id="pFlowStepId" /><input type="hidden" name="p_instance" value="33225448512930" id="pInstance" /><input type="hidden" name="p_page_submission_id" value="56845988240724690763368884521231759906" id="pPageSubmissionId" /><input type="hidden" name="p_request" value="" id="pRequest" /><input type="hidden" name="p_reload_on_submit" value="A" id="pReloadOnSubmit" /><input type="hidden" value="56845988240724690763368884521231759906" id="pSalt" />
         <header class="t-Header" id="t_Header">
            <div class="t-Header-branding">
               <div class="t-Header-controls">
                  <button class="t-Button t-Button--icon t-Button--header t-Button--headerTree" title="Expand / Collapse Navigation" id="t_Button_navControl" type="button"><span class="t-Icon fa fa-bars" aria-hidden="true"></span></button>
               </div>


            </div>

         </header>
         <div class="container">
            <div class="row">
               <div class="col col-12 " >
                  <script type="text/javascript" src="r/webcdms/100/files/static/v28Y/SweetAlert2.js_%3b%20%20filename_%3dutf-8%27%27SweetAlert2.js"></script>
                  <script src="../../unpkg.com/sweetalert%402.1.2/dist/sweetalert.min.js"></script>
                  <script type="text/javascript">
                     function global_red_blank (p_page) {
                     
                         var myurl = "f?p=100:"+p_page+":33225448512930::NO:"+p_page+"::";
                         window.open(myurl);
                         
                     }
                         
                     function global_red_url (p_url) {
                     
                         var myurl = p_url;
                         window.open(myurl);
                         
                     }
                         
                     function sweet_alert( p_msg, 
                                           p_text,
                                           p_type, 
                                           p_req_fnc_nm, 
                                           p_fnc_param1, 
                                           p_fnc_param2, 
                                           p_fnc_param3, 
                                           p_fnc_param4, 
                                           p_fnc_param5, 
                                           p_fnc_param6, 
                                           p_fnc_param7, 
                                           p_fnc_param8, 
                                           p_fnc_param9, 
                                           p_fnc_param10) {
                         Swal.fire({
                             title: '<span style="color:red; font-size:30px;">' + p_msg + '</span>',
                             text: p_text,
                             icon: "warning",
                             showDenyButton: true,
                             showCancelButton: true,
                             confirmButtonText: 'Confirm',
                             denyButtonText: `Don't Confirm`,
                         }).then((result) => {
                             if (result.isConfirmed) {
                                 if (p_type == "request") {
                                     apex.submit(p_req_fnc_nm);
                                 } 
                                 else if (p_type == "function") {
                                     p_req_fnc_nm(p_fnc_param1, 
                                               p_fnc_param2, 
                                               p_fnc_param3, 
                                               p_fnc_param4, 
                                               p_fnc_param5, 
                                               p_fnc_param6, 
                                               p_fnc_param7, 
                                               p_fnc_param8, 
                                               p_fnc_param9, 
                                               p_fnc_param10);
                                 }
                             } else if (result.isDenied) {
                                 Swal.fire('Changes are not saved', '', 'info')
                             }
                         });
                     }
                         
                     function getbangla(obj)
                     {
                     	var eng = obj.value;
                     	var tmp = "";
                     	var bng = "";
                       	for (var i = 0; i < eng.length; i++) 
                             {
                     	    tmp = eng.substr(i,1);
                     		
                     	    switch(tmp)
                     	    {
                     	    case "0":
                     	      bng += "০";
                     	      break;
                     	    case "1":
                     	      bng += "১";
                     	      break;
                     	    case "2":
                     	      bng += "২";
                     	      break;
                     	    case "3":
                     	      bng += "৩";
                     	      break;
                     	    case "4":
                     	      bng += "৪";
                     	      break;
                     	    case "5":
                     	      bng += "৫";
                     	      break;
                     	    case "6":
                     	      bng += "৬";
                     	      break;
                     	    case "7":
                     	      bng += "৭";
                     	      break;
                     	    case "8":
                     	      bng += "৮";
                     	      break;
                     	    case "9":
                     	      bng += "৯";
                     	      break;
                     	    case "/":
                     	      bng += "/";
                     	      break;
                     	    case "-":
                     	      bng += "/";
                     	      break;
                     	    case "(":
                     	      bng += "(";
                     	      break;
                     	    case ")":
                     	      bng += ")";
                     	      break;
                     	    default:
                     	      bng += tmp;
                     	    }
                     	}
                     
                     	obj.value = bng;
                     }
                     
                     
                     function getbanglatoenglish(obj)
                     {
                     	var eng = obj.value;
                     	var tmp = "";
                     	var bng = "";
                       	for (var i = 0; i < eng.length; i++) 
                             {
                     	    tmp = eng.substr(i,1);
                     		
                     	    switch(tmp)
                     	    {
                     	    case "০":
                     	      bng += "0";
                     	      break;
                     	    case "১":
                     	      bng += "1";
                     	      break;
                     	    case "২":
                     	      bng += "2";
                     	      break;
                     	    case "৩":
                     	      bng += "3";
                     	      break;
                     	    case "৪":
                     	      bng += "4";
                     	      break;
                     	    case "৫":
                     	      bng += "5";
                     	      break;
                     	    case "৬":
                     	      bng += "6";
                     	      break;
                     	    case "৭":
                     	      bng += "7";
                     	      break;
                     	    case "৮":
                     	      bng += "8";
                     	      break;
                     	    case "৯":
                     	      bng += "9";
                     	      break;
                     	    case "/":
                     	      bng += "/";
                     	      break;
                     	    case "-":
                     	      bng += "-";
                     	      break;
                     	    case "(":
                     	      bng += "(";
                     	      break;
                     	    case ")":
                     	      bng += ")";
                     	      break;
                     	    default:
                     	      bng += tmp;
                     	    }
                     	}
                     
                     	obj.value = bng;
                     }
                  </script><!--<link type="text/css" href="r/webcdms/files/static/v5Y/cdmsstyle.css" rel="stylesheet">-->
                  <style>
                     .button6 {
                     background-color: white;
                     color: black;
                     border: 2px solid #c9c6c5;
                     border-radius: 12px;
                     font-size: 14px;
                     padding: 2px 8px 2px 8px;
                     width: 100%;
                     }
                     .a-IRR .a-IRR-pagination-label {
                     color: #36a75e;
                     }
                     .a-IRR-pagination-label {
                     font-size: 18px;
                     }
                     body .ui-dialog--notification.ui-dialog .ui-dialog-titlebar, body .ui-dialog--notificationLarge.ui-dialog .ui-dialog-titlebar {
                     border-width: 0;
                     height: 37px;
                     }
                     body .ui-widget.ui-dialog {
                     border-width: 0;
                     border-radius: 8px;
                     }
                     body .ui-dialog .ui-dialog-buttonpane {
                     border-top-color: #ebebeb;
                     height: 46px;
                     }
                     .button6:hover {
                     background-color: #2b3887;
                     color: white;
                     }
                     body{
                     font-family:SolaimanLipi,Times New Roman;
                     }
                     .ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br {
                     border-bottom-right-radius: 10px !important;
                     }
                     .ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {
                     border-bottom-left-radius: 10px !important;
                     }
                     .borderless-region a {
                     text-decoration: none !important;
                     }
                     .UID_view{
                     font-size:8px;
                     color:#a9a9a9;
                     }
                     div.tSC {
                     /*background-color: #F0F0F0;
                     border-left: 1px solid #999999;
                     border-right: 1px solid #999999;
                     padding: 4px 10px 0;*/
                     text-align: center;
                     }
                     .rpt_report_logid {
                     font-family: arial;
                     font-size: 10px;
                     padding: 3px;
                     text-align: right;
                     }
                     .rpt_goponio {
                     color:#333333;
                     }
                     .rpt_report_head {
                     font-size: 20px;
                     font-weight:bold;
                     text-align:center;
                     }
                     .rpt_police_date {
                     text-align: left;
                     }
                     table{
                     width:100%;
                     border-collapse: collapse;
                     }
                     #superlov-fetch-results .superlov-table .ui-widget .ui-widget-content .ui-corner-all
                     {
                     width:1000px;
                     font-family: SolaimanLipi;
                     }
                     table.superlov-table  {
                     font-family: SolaimanLipi;
                     }
                     .apexir_WORKSHEET_DATA td {
                     border-bottom: 1px solid #AAAAAA;
                     border-right: 1px solid #AAAAAA;
                     font: 14px/16px SolaimanLipi,Times New Roman;
                     padding:5px;
                     font-family:SolaimanLipi,Times New Roman;
                     }
                     .report-standard td.data {
                     border-right: 1px solid #DDDDDD;
                     font: 14px/16px SolaimanLipi,Times New Roman;
                     }
                     input[type="text"]{
                     font-size: 16px;
                     padding:3px;
                     font-family:SolaimanLipi,Times New Roman;
                     text-align:left;
                     width: 242px;
                     color:#003399;
                     }
                     input[type="password"]{
                     font-size: 16px;
                     padding:3px;
                     font-family:SolaimanLipi,Times New Roman;
                     text-align:left !important;
                     width: 242px;
                     color:#003399;
                     }
                     textarea{
                     font-size: 16px;
                     padding:3px;
                     font-family:SolaimanLipi,Times New Roman;
                     width: 242px;
                     color:#003399;
                     }
                     select{
                     font-size: 16px;
                     padding:3px;
                     font-family:SolaimanLipi,Times New Roman;
                     text-align:left !important;
                     width: 250px;
                     color:#003399;
                     }
                     .borderless-region .bl-body {
                     font: 16px/16px SolaimanLipi,Arial,sans-serif;
                     }
                     div#breadcrumb_container ul li a {
                     color: #338888;
                     }
                     .ui-accordion-icons .ui-accordion-header a {
                     font-family: SolaimanLipi;
                     font-size: 16px;
                     }
                     a {
                     text-decoration:none;
                     color: #338888;
                     }
                     a.optional-w-help, a.required-w-help {
                     font-size: 16px;
                     font-family:SolaimanLipi,Times New Roman;
                     font-weight: normal;
                     white-space: wrap;
                     }
                     div#breadcrumb_container ul li a {
                     font-family:SolaimanLipi,Times New Roman;
                     font-size:16px;
                     }
                     .optional-w-help {
                     white-space: wrap;
                     }
                     .vertical-sidebar-list .active a, .vertical-sidebar-list .active a:hover {
                     font-size: 16px;
                     font: bold 16px/16px SolaimanLipi,Times New Roman !important;
                     }
                     .vertical-sidebar-list a {
                     font-size: 16px;
                     font-family:SolaimanLipi,Times New Roman;
                     }
                     .t1PopupBody a {
                     border-bottom: 1px solid #EE88EE;
                     display: block;
                     font: 16px/18px SolaimanLipi,Times New Roman;
                     }
                     .ui-widget {
                     font-family:SolaimanLipi, Arial,sans-serif;
                     font-size:16px;
                     }
                     .borderless-region .bl-title {
                     font-family:SolaimanLipi,Arial,sans-serif;
                     font-size:16px;
                     font-weight:bold;
                     }
                     #apexir_CONTROL_PANEL {
                     width: auto;
                     }
                     .apexir_WORKSHEET_DATA th div {
                     font: bold 14px/16px SolaimanLipi,Times New Roman;
                     font-size: 16px;
                     }
                     .worksheet_detail th, .worksheet_detail td {
                     font-family:SolaimanLipi,Times New Roman;
                     font-size: 16px;
                     }
                     .worksheet_detail th {
                     width:35%;
                     }
                     td.data {
                     text-align: left;
                     }
                     .rounded-corner-region-wizard {
                     float: left;
                     max-width: 600px;
                     min-width: 330px;
                     }
                     ul.dhtmlTree li {
                     font-family:SolaimanLipi,Times New Roman;
                     font-size: 16px;
                     }
                     .rounded-corner-region .rc-title, .rounded-corner-region-alt .rc-title, .rounded-corner-region-wizard .rc-title {
                     font-family:SolaimanLipi,Times New Roman;
                     font-size: 18px;
                     }
                     .rounded-corner-region .rc-body .rc-body-r, .rounded-corner-region-wizard .rc-body .rc-body-r, .rounded-corner-region-blank-white .rc-body .rc-body-r {
                     font-size: 14px;
                     }
                     .report-standard th.header, .report-borderless th.header {
                     background: none repeat scroll 0 0 transparent;
                     font: bold 16px/16px SolaimanLipi,Times New Roman;
                     }
                     .t1PopupBody a {
                     border-bottom: 1px solid #999999;
                     color: #005500;
                     font: 16px/18px SolaimanLipi,Times New Roman;
                     }
                     /*.t-Body-contentInner {
                     background-color: azure;
                     }
                     .t-Breadcrumb-label {  
                     display: none;  
                     }
                     */
                     .t-Region-headerItems--title {
                     text-align: center;
                     padding: 0.6rem 1.2rem;
                     }
                     .t-Report-colHead {
                     padding: 5px;
                     }
                     .t-Report-cell {
                     padding: 3px 10px;
                     }
                     body .ui-dialog .ui-dialog-titlebar {
                     background-color: #2b3887;
                     }
                     body .ui-dialog .ui-dialog-title {
                     color: #ffffff;
                     text-align: center;
                     padding-left: 50px;
                     }
                     .ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {
                     border-bottom-left-radius: 1px !important;
                     border-bottom-right-radius: 1px !important;
                     background-color: aliceblue;
                     }
                     body .ui-dialog--notification.ui-dialog .ui-dialog-content, body .ui-dialog--notificationLarge.ui-dialog .ui-dialog-content {
                     min-height: auto!important;
                     padding: 0 32px 36px;
                     color: #000;
                     font-size: medium;
                     }
                     .t-Region-title {
                     font-weight: 700;
                     }
                     .t-Region .t-Button--small {
                     border-radius: 8px;
                     }
                     .t-Region--accent5:not(.t-Region--textContent)>.t-Region-header {
                     background-color: #2b3887;
                     color: #fff;
                     border-radius: 15px 0px;
                     }
                     /*
                     .a-Button--hot {
                     background-color: #4aaa2ce6;
                     }
                     .t-Header-branding {
                     background-color: #449430 !important;
                     }
                     .t-Header-nav-list {
                     background-color: #449430 !important;
                     }
                     .a-MenuBar-label {
                     background-color: #449430 !important;
                     }
                     */
                  </style>
                  <style>
                     @-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
                     @-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
                     @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
                     .fade-in {
                     opacity:0;  /* make things invisible upon start */
                     -webkit-animation:fadeIn ease-in 1;  /* call our keyframe named fadeIn, use animattion ease-in and repeat it only 1 time */
                     -moz-animation:fadeIn ease-in 1;
                     animation:fadeIn ease-in 1;
                     -webkit-animation-fill-mode:forwards;  /* this makes sure that after animation is done we remain at the last keyframe value (opacity: 1)*/
                     -moz-animation-fill-mode:forwards;
                     animation-fill-mode:forwards;
                     -webkit-animation-duration:1s;
                     -moz-animation-duration:1s;
                     animation-duration:1s;
                     }
                     .fade-in.login {
                     -webkit-animation-delay: 0.2s;
                     -moz-animation-delay: 0.2s;
                     animation-delay: 0.2s;
                     }
                     .fade-in.login2 {
                     -webkit-animation-delay: 0.4s;
                     -moz-animation-delay: 0.4s;
                     animation-delay: 0.4s;
                     }
                     .fade-in.login3 {
                     -webkit-animation-delay: 0.6s;
                     -moz-animation-delay: 0.6s;
                     animation-delay: 0.6s;
                     }
                  </style>
                  <script>
                     function getbangla2(obj)
                     {
                     	var eng = obj.value;
                     	var tmp = "";
                     	var bng = "";
                       	for (var i = 0; i < eng.length; i++) 
                             {
                     	    tmp = eng.substr(i,1);
                     		
                     	    switch(tmp)
                     	    {
                     	    case "0":
                     	      bng += "০";
                     	      break;
                     	    case "1":
                     	      bng += "১";
                     	      break;
                     	    case "2":
                     	      bng += "২";
                     	      break;
                     	    case "3":
                     	      bng += "৩";
                     	      break;
                     	    case "4":
                     	      bng += "৪";
                     	      break;
                     	    case "5":
                     	      bng += "৫";
                     	      break;
                     	    case "6":
                     	      bng += "৬";
                     	      break;
                     	    case "7":
                     	      bng += "৭";
                     	      break;
                     	    case "8":
                     	      bng += "৮";
                     	      break;
                     	    case "9":
                     	      bng += "৯";
                     	      break;
                     	    case "/":
                     	      bng += "http://cdmstraining.police.gov.bd:8080/";
                     	      break;
                     	    case "-":
                     	      bng += "http://cdmstraining.police.gov.bd:8080/";
                     	      break;
                     	    case "(":
                     	      bng += "(";
                     	      break;
                     	    case ")":
                     	      bng += ")";
                     	      break;
                     	    default:
                     	      bng += tmp;
                     	    }
                     	}
                     
                     obj.value = bng;
                     }
                  </script>
               </div>
            </div>
            <div class="row"></div>
         </div>
         <div class="t-Body">
            <div class="t-Body-main">
               <div class="t-Body-title" id="t_Body_title">
               </div>
               <div class="t-Body-content" id="t_Body_content">
                  <span id="APEX_SUCCESS_MESSAGE" data-template-id="451172163602761461_S" class="apex-page-success u-hidden"></span><span id="APEX_ERROR_MESSAGE" data-template-id="451172163602761461_E" class="apex-page-error u-hidden"></span>
                  <div class="t-Body-contentInner">
                     <div class="container">
                        <div class="row">
                           <div class="col col-12 " >
                              <div class="t-Region t-Region--noPadding t-Region--removeHeader t-Region--noUI t-Region--scrollBody" id="mast_reg" >
                                  
                                  
                                 <div class="t-Region-header">
                                     
                                    <div class="t-Region-headerItems t-Region-headerItems--title">
                                       <h2 class="t-Region-title" id="mast_reg_heading">master</h2>
                                    </div>
                                    <div class="t-Region-headerItems t-Region-headerItems--buttons"><span class="js-maximizeButtonContainer"></span></div>
                                 </div>
                                 <div class="t-Region-bodyWrap">
                                     
                                 
                                    <div class="t-Region-buttons t-Region-buttons--top">
                                       <div class="t-Region-buttons-left"></div>
                                       <div class="t-Region-buttons-right"></div>
                                    </div>
                                    <div class="t-Region-body">
                                       <div class="container">
                                          <div class="row">
                                             <div class="col col-4 " >
                                                 
                                                <div class="t-Login-region t-Form--stretchInputs t-Form--labelsAbove " id="R7854174581880351124" >
                                                 
                                                     <h1 class="t-Login-title" id="R7854174581880351124_heading">
                                                        <span style="font-weight:bold;color:#081a83;">DRMS</span>
                                                      </h1>
                                                 
                                                 
                                                   <div class="t-Login-header">
                                                      <span class="t-Login-logo "></span>
                                            
                                                      
                                                      
                                           
                                  


                                                   </div>
                                                   <br>
                                                   <div class="t-Login-body">
                                             
                                                 
                                                 <!---------->
                                                      <div class="t-Form-fieldContainer t-Form-fieldContainer--hiddenLabel rel-col " id="P101_PASSWORD_CONTAINER">
                                                         <div class="t-Form-labelContainer t-Form-labelContainer--hiddenLabel col col-null">
                                                            <label for="P101_PASSWORD" id="P101_PASSWORD_LABEL" class="t-Form-label u-VisuallyHidden">BP No</label>
                                                         </div>
                                                         <div class="t-Form-inputContainer col col-null">
                                                            <div class="t-Form-itemWrapper">
                                                                <input type="number" name="bp_no"   id="P101_USERNAME" placeholder="BP No" class="password&#x20;apex-item-text&#x20;apex-item-has-icon" autofocus/><span class="apex-item-icon fa&#x20;fa-key" aria-hidden="true"></span><span class="t-Form-itemText t-Form-itemText--post"></span></div>
                                                            @error('bp_no')<span id="P101_PASSWORD_error_placeholder" class="a-Form-error" data-template-id="451245492123761504_ET"><h5 style="color:red;">{{ $message }}</h5></span>@enderror
                                                         </div>
                                                      </div>
                                                 
                                                 
                                                      <div class="t-Form-fieldContainer t-Form-fieldContainer--hiddenLabel rel-col " id="P101_PASSWORD_CONTAINER">
                                                         <div class="t-Form-labelContainer t-Form-labelContainer--hiddenLabel col col-null">
                                                            <label for="P101_PASSWORD" id="P101_PASSWORD_LABEL" class="t-Form-label u-VisuallyHidden">Password</label>
                                                         </div>
                                                         <div class="t-Form-inputContainer col col-null">
                                                            <div class="t-Form-itemWrapper"><input type="password" name="password" size="40" maxlength="100" value=""  id="P101_PASSWORD" placeholder="Password" class="password&#x20;apex-item-text&#x20;apex-item-has-icon"  onkeypress="return apex.submit({request:'P101_PASSWORD',submitIfEnter:event})"  /><span class="apex-item-icon fa&#x20;fa-key" aria-hidden="true"></span><span class="t-Form-itemText t-Form-itemText--post"><i id="pass-status" class="fa fa-eye field-icon" aria-hidden="true" onClick="viewPassword()"></i></span></div>
                                                            @error('password') <span id="P101_PASSWORD_error_placeholder" class="a-Form-error" data-template-id="451245492123761504_ET"><h5 style="color:red;">{{ $message }}</h5></span> @enderror
                                                         </div>
                                                      </div>
                                            
                                            
                                     
                                                               <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
         
                                                                
                                             
                                                      <button class="t-Button t-Button--icon t-Button--large&#x20;t-Button--iconRight&#x20;t-Button--stretch t-Button--hot" type="submit" id="P101_LOGIN"><span class="t-Icon t-Icon--left fa&#x20;fa-key" aria-hidden="true"></span><span class="t-Button-label">LOGIN</span><span class="t-Icon t-Icon--right fa&#x20;fa-key" aria-hidden="true"></span></button>
                                                      <button class="t-Button t-Button--icon t-Button--large&#x20;t-Button--iconRight&#x20;t-Button--stretch t-Button--hot"  onclick="apex.navigation.redirect(&#x27;{{ route('password.request') }}&#x27;);" type="button" id="P101_LOGIN"><span class="t-Icon t-Icon--left fa&#x20;fa-key" aria-hidden="true"></span><span class="t-Button-label">Forgot Password</span><span class="t-Icon t-Icon--right fa&#x20;fa-key" aria-hidden="true"></span></button><span id='caps_lock_on'>Note: Your Caps Lock key is currently turned on</span>
                                                   </div>
                                                   <div class="t-Login-buttons">
                                                   </div>
                                                   <div class="t-Login-links">
                                                   </div>
                                                
                                                </div>
                                             </div>
                                             <div class="col col-8 " >
                                                <div id="R7580005258803013485"  class="fade-in login">
                                                   <style>
                                                      #main_tab {
                                                      height:50px;
                                                 
                                                      width:200%;
                                                      color:BLUE;
                                                      }
                                                      #main_tab {
                                                      height: 100px;
                                      
                                                  
                                                      }
                                                      #main_tab2 {
                                                      width: 100%;
                                                      }
                                                   </style>
                                                   <div align="center">
                                                      <table id="main_tab">
                                                         <tr>
                                                            <td><a href="#"><img src="{{ asset('police-logo.png') }}" style="height: 80px;" /></a></td>
                                                            <td align="center">
                                                           <b>    <span style="font-size:30px;color:#252072;">Welcome To</span> </b> <br>
                                                               <span style="font-size:16px;color:#252072;">Digital Reporting and Monitoring System</span><br>
                                                                 <span style="font-size:16px;color:#252072;">(DRMS)</span>
                                                            </td>
                                                            <td align="right"><img src="{{ asset('b-range.png') }}" style="height: 80px;" /></td>
                                                         </tr>
                                                      </table>
                                                   </div>
                                                   <br />
                                                </div>
                                                
                                                
                                                <div class="t-Region i-h390  t-Region--removeHeader t-Region--textContent t-Region--scrollBody t-Form--noPadding" id="notice" >
                                                   <div class="t-Region-header">
                                                      <div class="t-Region-headerItems t-Region-headerItems--title">
                                                         <h2 class="t-Region-title" id="notice_heading">notice</h2>
                                                      </div>
                                                      <div class="t-Region-headerItems t-Region-headerItems--buttons"><span class="js-maximizeButtonContainer"></span></div>
                                                   </div>
                                                   <div class="t-Region-bodyWrap">
                                                      <div class="t-Region-buttons t-Region-buttons--top">
                                                         <div class="t-Region-buttons-left"></div>
                                                         <div class="t-Region-buttons-right"></div>
                                                      </div>
                                                      <div class="t-Region-body">
                                                         <div id="report_3752657380276669926_catch">
                                                            <ul class="t-Cards t-Cards--featured t-Cards--cols t-Cards--animColorFill"  style="margin: 36px;border: none;color: black;font-size: 42px !important;font-weight: bold;"  id="notice_cards">
                                                              
                                                              
                                                                 <br>
                                                                           <br>
                                                                           <br>
                                                               <li class="t-Cards-item #CARD_MODIFIERS#">
                                                                  <div class="t-Card">
                                                                     <div class="t-Card-wrap">
                                                                        <div class="t-Card-icon u-color #CARD_COLOR#"><span class="t-Icon fa #CARD_ICON#"><span class="t-Card-initials" role="presentation">#CARD_INITIALS#</span></span></div>
                                                                        <div class="t-Card-titleWrap">
                                                                           <h3 class="t-Card-title">
                                                                              <p style="text-align: center;"><span style="font-size:26px"><span style=""><strong><span style="color:#32b941">হেল্প ডেস্ক</span></strong></span></span></p>
                                                             
                                                                           </h3>
                                                                           
                                                                           <br>
                                                                       
                                                                        </div>
                                                                        <div class="t-Card-body">
                                                                           <div class="t-Card-desc">
                                                                              <p>
                                                                                  <span style="font-size:16px">
                                                                                      (ডিআরএমএস) সফটওয়্যার সংক্রান্ত কোন সমস্যা পরিলক্ষিত হলে সমস্যার বিস্তারিত বিবরণ স্কিন শটসহ ই-মেইল করুন ictbslrange@gmail.com  </span></p>
                                                                                      
                                                                           </div>
                                                                           <div class="t-Card-info">-</div>
                                                                        </div>
                                                                        <span class="t-Card-colorFill u-color #CARD_COLOR#"></span>
                                                                     </div>
                                                                  </div>
                                                               </li>
                                                            </ul>
                                                            <table class="t-Report-pagination" role="presentation"></table>
                                                         </div>
                                                      </div>
                                                      <div class="t-Region-buttons t-Region-buttons--bottom">
                                                         <div class="t-Region-buttons-left"></div>
                                                         <div class="t-Region-buttons-right"></div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div id="R7580005356996013486"  class="fade-in login3">
                                                   <style>
                                                      #main_tab {
                                                      height:50px;
                                                    
                                                      width: 100%;
                                                      }
                                                      #main_tab {
                                                      height: 50px;
                                                      font-size: 17px;
                                                        color: #2500d9;
                                                      }
                                                   </style>
                                                   <div align="center">
                                                      <table id="main_tab">
                                                         <tr>
                                                            <td>&nbsp;</td>
                                                            <td align="center">
                                             
                                                               Design and Developed By: Engineer BD Network.</p>
                                                            </td>
                                                            <td>&nbsp;</td>
                                                         </tr>
                                                      </table>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="t-Region-buttons t-Region-buttons--bottom">
                                       <div class="t-Region-buttons-left"></div>
                                       <div class="t-Region-buttons-right"></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <footer class="t-Footer">
                     <div class="t-Footer-body">
                        <div class="t-Footer-content"></div>
                        <div class="t-Footer-apex">
                           <div class="t-Footer-version"> Release 1.0</div>
                           <div class="t-Footer-customize"></div>
                           <div class="t-Footer-srMode"><a href="http://cdmstraining.police.gov.bd:8080/apex/f?p=100:101:1076220509954:::::"> </a></div>
                        </div>
                     </div>
                     <div class="t-Footer-top">
                        <a href="#top" class="t-Footer-topButton" id="t_Footer_topButton"><span class="a-Icon icon-up-chevron"></span></a>
                     </div>
                  </footer>
               </div>
            </div>
         </div>
         <div class="t-Body-inlineDialogs">
         </div>
         <input type="hidden" id="pPageItemsRowVersion" value="" /><input type="hidden" id="pPageItemsProtected" value="SoCNxn4OfUK0oivez8kz6A" />
      </form>
      <script type="text/javascript">
         var apex_img_dir = "http://cdmstraining.police.gov.bd:8080/i/", htmldb_Img_Dir = apex_img_dir;
      </script>
      <!--[if lt IE 9]><script type="text/javascript" src="/i/libraries/jquery/1.12.3/jquery-1.12.3.min.js?v=5.1.0.00.45"></script><![endif]-->
      <!--[if gte IE 9]><!--><script type="text/javascript" src="{{ asset('i/libraries/jquery/2.2.3/jquery-2.2.3.min9ee3.js?v=5.1.0.00.45') }}"></script><!--<![endif]-->
      <script type="text/javascript" src="{{ asset('i/libraries/apex/minified/desktop.min9ee3.js?v=5.1.0.00.45') }}"></script>
      <script type="text/javascript" src="wwv_flow6707.js_messages?p_app_id=100&amp;p_lang=en&amp;p_version=5.1.0.00.45-246744619') }}"></script>
      <script type="text/javascript" src="{{ asset('i/libraries/apex/minified/legacy.min9ee3.js?v=5.1.0.00.45') }}"></script>
      <script type="text/javascript" src="{{ asset('i/libraries/jquery-migrate/1.4.1/jquery-migrate-1.4.1.min9ee3.js?v=5.1.0.00.45') }}"></script>
      <script type="text/javascript">
         apex.da.initDaEventList = function(){
         apex.da.gEventList = [
         {"triggeringElementType":"BUTTON","triggeringButtonId":"P101_SEND","conditionElement":"P101_USERNAME","triggeringConditionType":"NOT_NULL","bindType":"bind","bindEventType":"click","anyActionsFireOnInit":false,actionList:[{"eventResult":true,"executeOnPageInit":false,"stopExecutionOnError":true,"waitForResult":true,javascriptFunction:apex.da.executePlSqlCode,"ajaxIdentifier":"gYMn_BLWSnSrksUz9HHNgmnftzn4Kih5pdLIJ1iDRZc","attribute01":"#P101_USERNAME","attribute04":"N","attribute05":"sync","action":"NATIVE_EXECUTE_PLSQL_CODE"}]},
         {"triggeringElementType":"ITEM","triggeringElement":"P101_USERNAME","conditionElement":"P101_USERNAME","triggeringConditionType":"NOT_NULL","bindType":"bind","bindEventType":"change","anyActionsFireOnInit":false,actionList:[{"eventResult":true,"executeOnPageInit":false,"stopExecutionOnError":true,"waitForResult":true,javascriptFunction:apex.da.executePlSqlCode,"ajaxIdentifier":"gYMn_BLWSnSrksUz9HHNgqMV4boEjtDoHYPhXAblv8w","attribute01":"#P101_USERNAME","attribute02":"#P101_OTP_FLAG","attribute04":"N","attribute05":"sync","action":"NATIVE_EXECUTE_PLSQL_CODE"}]},
         {"conditionElement":"P0_IP","triggeringConditionType":"NULL","bindEventType":"ready","anyActionsFireOnInit":false,actionList:[{"eventResult":true,"executeOnPageInit":false,"stopExecutionOnError":true,javascriptFunction:function (){ /* Add "https://api.ipify.org?format=json" statement
         			this will communicate with the ipify servers in
         			order to retrieve the IP address $.getJSON will
         			load JSON-encoded data from the server using a
         			GET HTTP request */
         				
         	$.getJSON("https://api.ipify.org/?format=json", function(data) {
         		
         		// Setting text of element P with id gfg
         		$s("P0_IP",data.ip);
         	})
         },"action":"NATIVE_JAVASCRIPT_CODE"}]},
         {"triggeringElementType":"ITEM","triggeringElement":"P101_OTP_FLAG","conditionElement":"P101_OTP_FLAG","triggeringConditionType":"EQUALS","triggeringExpression":"Y","bindType":"bind","bindEventType":"change","anyActionsFireOnInit":true,actionList:[{"eventResult":true,"executeOnPageInit":true,"stopExecutionOnError":true,"affectedElementsType":"ITEM","affectedElements":"P101_OTP",javascriptFunction:apex.da.show,"attribute01":"N","action":"NATIVE_SHOW"},{"eventResult":false,"executeOnPageInit":true,"stopExecutionOnError":true,"affectedElementsType":"ITEM","affectedElements":"P101_OTP",javascriptFunction:apex.da.hide,"attribute01":"N","action":"NATIVE_HIDE"},{"eventResult":true,"executeOnPageInit":true,"stopExecutionOnError":true,"affectedElementsType":"BUTTON",javascriptFunction:apex.da.show,"attribute01":"N","action":"NATIVE_SHOW"},{"eventResult":false,"executeOnPageInit":true,"stopExecutionOnError":true,"affectedElementsType":"BUTTON",javascriptFunction:apex.da.hide,"attribute01":"N","action":"NATIVE_HIDE"}]},
         {"triggeringElementType":"ITEM","triggeringElement":"P101_USERNAME","triggeringConditionType":"JAVASCRIPT_EXPRESSION","triggeringExpression": function() {
         return (this.browserEvent.which === 13
         ); },"bindType":"bind","bindEventType":"keydown","anyActionsFireOnInit":false,actionList:[{"eventResult":true,"executeOnPageInit":false,"stopExecutionOnError":true,"affectedElementsType":"ITEM","affectedElements":"P101_PASSWORD",javascriptFunction:apex.da.setFocus,"action":"NATIVE_SET_FOCUS"}]},
         {"triggeringElementType":"ITEM","triggeringElement":"P101_USERNAME","bindType":"bind","bindEventType":"change","anyActionsFireOnInit":true,actionList:[{"eventResult":true,"executeOnPageInit":true,"stopExecutionOnError":true,"waitForResult":true,"affectedElementsType":"ITEM","affectedElements":"P101_GROUP_ADDMIN",javascriptFunction:apex.da.setValue,"ajaxIdentifier":"ZuG78_JHi_F-7dStjAR8CuRx986x1iDxIbypzIdAEis","attribute01":"SQL_STATEMENT","attribute04":"#P101_USERNAME","attribute09":"N","attribute11":"sync","action":"NATIVE_SET_VALUE"}]}];
         }
      </script>
      <script type="text/javascript" src="{{ asset('i/libraries/hammer/2.0.4/hammer-2.0.4.min9ee3.js?v=5.1.0.00.45') }}"></script>
      <script type="text/javascript" src="{{ asset('i/libraries/apex/minified/widget.apexTabs.min9ee3.js?v=5.1.0.00.45') }}"></script>
      <script type="text/javascript" src="{{ asset('i/libraries/apex/minified/widget.stickyWidget.min9ee3.js?v=5.1.0.00.45') }}"></script>
      <script type="text/javascript" src="{{ asset('i/libraries/apex/minified/widget.stickyTableHeader.min9ee3.js?v=5.1.0.00.45') }}"></script>
      <script type="text/javascript" src="{{ asset('i/themes/theme_42/1.1/js/modernizr-custom.min9ee3.js?v=5.1.0.00.45') }}"></script>
      <script type="text/javascript" src="{{ asset('i/themes/theme_42/1.1/js/theme42.min9ee3.js?v=5.1.0.00.45') }}"></script>
      <script type="text/javascript">
         function viewPassword()
         {
           var passwordInput = document.getElementById('P101_PASSWORD');
           var passStatus = document.getElementById('pass-status');
         
         
           if (passwordInput.type == 'password'){
             passwordInput.type='text';
             passStatus.className='fa fa-eye-slash field-icon';
             
           }
           else{
             passwordInput.type='password';
             passStatus.className='fa fa-eye field-icon';
           }
         }
         
         var input = document.getElementById('P101_PASSWORD');// Pass Your Item Name
         
         var text = document.getElementById('caps_lock_on');
         
          //WHEN KEYUP
         
         input.addEventListener('keyup', function(event) {
         
         if (event.getModifierState('CapsLock')) {
         
             text.style.display = 'block';
         
           } else {
         
             text.style.display = 'none'
         
           }
         
         })
         
          //WHEN MOUSEDOWN
         
         input.addEventListener('mousedown', function(event) {
         
         if (event.getModifierState('CapsLock')) {
         
             text.style.display = 'block';
         
           } else {
         
             text.style.display = 'none'
         
           }
         
         })
      </script>  
      <script type="text/javascript" src="{{ asset('i/libraries/apex/minified/widget.report.min9ee3.js?v=5.1.0.00.45"></script>
   </body>

</html>
