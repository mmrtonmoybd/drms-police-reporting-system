<x-admin-header />

<script src="https://code.jquery.com/jquery-latest.min.js"></script>



<style>


.button-label {
  display: inline-block;
padding:5px 10px;
width:;
  margin: 0.5em;
  cursor: pointer;
  color: #292929;
  border-radius: 0.25em;
  background: #efefef;
  box-shadow:  inset 0 -3px 0 rgba(0, 0, 0, 0.22);
  transition: 0.3s;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}
.button-label h1 {
  font-size: 14px;
  text-align: center;

}
.button-label:hover {
  background: #d6d6d6;
  color: #101010;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2), inset 0 -3px 0 rgba(0, 0, 0, 0.32);
}
.button-label:active {
  transform: translateY(2px);
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2), inset 0px -1px 0 rgba(0, 0, 0, 0.22);
}
@media (max-width: 40em) {
  .button-label {
    padding: 0em 1em 3px;
    margin: 0.25em;
  }
}

#myCheckgd:checked + .button-label {
  background: #2ECC71;
  color: #efefef;
}
#myCheckgd:checked + .button-label:hover {
  background: #29b765;
  color: #e2e2e2;
}






#myCheck:checked + .button-label {
  background: #2ECC71;
  color: #efefef;
}
#myCheck:checked + .button-label:hover {
  background: #29b765;
  color: #e2e2e2;
}




#myCheckmim:checked + .button-label {
  background: #2ECC71;
  color: #efefef;
}
#myCheckmim:checked + .button-label:hover {
  background: #29b765;
  color: #e2e2e2;
}





#myCheckain:checked + .button-label {
  background: #2ECC71;
  color: #efefef;
}
#myCheckain:checked + .button-label:hover {
  background: #29b765;
  color: #e2e2e2;
}

input:checked + .button-label h1{
  color: #fff;
}


#nogd:checked + .button-label {
  background: #D91E18;
  color: #efefef;
}
#nogd:checked + .button-label:hover {
  background: #c21b15;
  color: #e2e2e2;
}



#no:checked + .button-label {
  background: #D91E18;
  color: #fff;
}
#no:checked + .button-label:hover {
  background: #c21b15;
  color: #e2e2e2;
}


#maybe-button:checked + .button-label {
  background: #4183D7;
  color: #efefef;
}
#maybe-button:checked + .button-label:hover {
  background: #2c75d2;
  color: #e2e2e2;
}


.hidden {
  display: none;
}
</style>
<style>


/*!Don't remove this!
 * jQuery MDTimePicker v1.0 plugin
 * 
 * Author: Dionlee Uy
 * Email: dionleeuy@gmail.com
 *
 * Date: Tuesday, August 28 2017
 */
@import url(https://fonts.googleapis.com/css?family=Roboto);
.mdtp__wrapper,
body[mdtimepicker-display="on"] {
  overflow: hidden;
}
.mdtimepicker {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  font-family: Roboto, sans-serif;
  font-size: 14px;
  background-color: rgba(10, 10, 10, 0.7);
  transition: background-color 0.28s ease;
  z-index: 100001;
}
.mdtimepicker.hidden {
  display: none;
}
.mdtimepicker.animate {
  background-color: transparent;
}
.mdtp__wrapper {
  position: absolute;
  display: flex;
  flex-direction: column;
  left: 50%;
  bottom: 24px;
  min-width: 280px;
  opacity: 1;
  user-select: none;
  border-radius: 2px;
  transform: translateX(-50%) scale(1);
  box-shadow: 0 11px 15px -7px rgba(0, 0, 0, 0.2),
    0 24px 38px 3px rgba(0, 0, 0, 0.14), 0 9px 46px 8px rgba(0, 0, 0, 0.12);
  transition: transform 0.28s ease, opacity 0.28s ease;
}
.mdtp__wrapper.animate {
  transform: translateX(-50%) scale(1.05);
  opacity: 0;
}
.mdtp__time_holder {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  font-size: 46px;
  padding: 20px 24px;
  color: rgba(255, 255, 255, 0.5);
  text-align: center;
  background-color: #1565c0;
}
.mdtp__time_holder > span {
  display: inline-block;
  line-height: 48px;
  cursor: default;
}
.mdtp__time_holder > span:not(.mdtp__timedots):not(.mdtp__ampm) {
  cursor: pointer;
  margin: 0 4px;
}
.mdtp__time_holder .mdtp__time_h.active,
.mdtp__time_holder .mdtp__time_m.active {
  color: #fafafa;
}
.mdtp__time_holder .mdtp__ampm {
  font-size: 18px;
}
.mdtp__clock_holder {
  position: relative;
  padding: 20px;
  background-color: #fff;
}
.mdtp__clock_holder .mdtp__clock {
  position: relative;
  width: 250px;
  height: 250px;
  margin-bottom: 20px;
  border-radius: 50%;
  background-color: #eee;
}
.mdtp__clock .mdtp__am,
.mdtp__clock .mdtp__pm {
  display: block;
  position: absolute;
  bottom: -8px;
  width: 36px;
  height: 36px;
  line-height: 36px;
  text-align: center;
  cursor: pointer;
  border-radius: 50%;
  border: 1px solid rgba(0, 0, 0, 0.1);
  background: rgba(0, 0, 0, 0.05);
  transition: background-color 0.2s ease, color 0.2s;
  z-index: 3;
}
.mdtp__clock .mdtp__am {
  left: -8px;
}
.mdtp__clock .mdtp__pm {
  right: -8px;
}
.mdtp__clock .mdtp__am:hover,
.mdtp__clock .mdtp__pm:hover {
  background-color: rgba(0, 0, 0, 0.1);
}
.mdtp__clock .mdtp__am.active,
.mdtp__clock .mdtp__pm.active {
  color: #fafafa;
  background-color: #1565c0;
}
.mdtp__clock .mdtp__clock_dot {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 4px;
  background-color: #1565c0;
  border-radius: 50%;
}
.mdtp__clock .mdtp__hour_holder,
.mdtp__clock .mdtp__minute_holder {
  position: absolute;
  top: 0;
  width: 100%;
  height: 100%;
  opacity: 1;
  transform: scale(1);
  transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.35s ease;
  overflow: hidden;
}
.mdtp__clock .mdtp__hour_holder.animate {
  transform: scale(1.2);
  opacity: 0;
}
.mdtp__clock .mdtp__minute_holder.animate {
  transform: scale(0.8);
  opacity: 0;
}
.mdtp__clock .mdtp__hour_holder.hidden,
.mdtp__clock .mdtp__minute_holder.hidden {
  display: none;
}
.mdtp__clock .mdtp__digit {
  position: absolute;
  width: 50%;
  top: 50%;
  left: 0;
  margin-top: -16px;
  transform-origin: right center;
  z-index: 1;
}
.mdtp__clock .mdtp__digit span {
  display: inline-block;
  width: 32px;
  height: 32px;
  line-height: 32px;
  margin-left: 8px;
  text-align: center;
  border-radius: 50%;
  cursor: pointer;
  transition: background-color 0.28s, color 0.14s;
}
.mdtp__clock .mdtp__digit span:hover,
.mdtp__digit.active span {
  background-color: #1565c0 !important;
  color: #fff;
  z-index: 2;
}
.mdtp__button,
.mdtp__wrapper[data-theme="blue"] .mdtp__button {
  color: #1565c0;
}
.mdtp__digit.active:before {
  content: "";
  display: block;
  position: absolute;
  top: calc(50% - 1px);
  right: 0;
  height: 2px;
  width: calc(100% - 40px);
  background-color: #1565c0;
}
.mdtp__clock .mdtp__minute_holder .mdtp__digit {
  font-size: 13px;
}
.mdtp__clock .mdtp__minute_holder .mdtp__digit:not(.marker) {
  margin-top: -6px;
  height: 12px;
}
.mdtp__clock .mdtp__minute_holder .mdtp__digit:not(.marker).active:before {
  width: calc(100% - 26px);
}
.mdtp__clock .mdtp__minute_holder .mdtp__digit:not(.marker) span {
  width: 12px;
  height: 12px;
  line-height: 12px;
  margin-left: 14px;
}
.mdtp__clock .mdtp__minute_holder .mdtp__digit.marker {
  margin-top: -12px;
}
.mdtp__clock .mdtp__minute_holder .mdtp__digit.marker.active:before {
  width: calc(100% - 34px);
}
.mdtp__clock .mdtp__minute_holder .mdtp__digit.marker span {
  width: 24px;
  height: 24px;
  line-height: 24px;
  margin-left: 10px;
}
.mdtp__digit.rotate-6 {
  transform: rotate(6deg);
}
.mdtp__digit.rotate-6 span {
  transform: rotate(-6deg);
}
.mdtp__digit.rotate-12 {
  transform: rotate(12deg);
}
.mdtp__digit.rotate-12 span {
  transform: rotate(-12deg);
}
.mdtp__digit.rotate-18 {
  transform: rotate(18deg);
}
.mdtp__digit.rotate-18 span {
  transform: rotate(-18deg);
}
.mdtp__digit.rotate-24 {
  transform: rotate(24deg);
}
.mdtp__digit.rotate-24 span {
  transform: rotate(-24deg);
}
.mdtp__digit.rotate-30 {
  transform: rotate(30deg);
}
.mdtp__digit.rotate-30 span {
  transform: rotate(-30deg);
}
.mdtp__digit.rotate-36 {
  transform: rotate(36deg);
}
.mdtp__digit.rotate-36 span {
  transform: rotate(-36deg);
}
.mdtp__digit.rotate-42 {
  transform: rotate(42deg);
}
.mdtp__digit.rotate-42 span {
  transform: rotate(-42deg);
}
.mdtp__digit.rotate-48 {
  transform: rotate(48deg);
}
.mdtp__digit.rotate-48 span {
  transform: rotate(-48deg);
}
.mdtp__digit.rotate-54 {
  transform: rotate(54deg);
}
.mdtp__digit.rotate-54 span {
  transform: rotate(-54deg);
}
.mdtp__digit.rotate-60 {
  transform: rotate(60deg);
}
.mdtp__digit.rotate-60 span {
  transform: rotate(-60deg);
}
.mdtp__digit.rotate-66 {
  transform: rotate(66deg);
}
.mdtp__digit.rotate-66 span {
  transform: rotate(-66deg);
}
.mdtp__digit.rotate-72 {
  transform: rotate(72deg);
}
.mdtp__digit.rotate-72 span {
  transform: rotate(-72deg);
}
.mdtp__digit.rotate-78 {
  transform: rotate(78deg);
}
.mdtp__digit.rotate-78 span {
  transform: rotate(-78deg);
}
.mdtp__digit.rotate-84 {
  transform: rotate(84deg);
}
.mdtp__digit.rotate-84 span {
  transform: rotate(-84deg);
}
.mdtp__digit.rotate-90 {
  transform: rotate(90deg);
}
.mdtp__digit.rotate-90 span {
  transform: rotate(-90deg);
}
.mdtp__digit.rotate-96 {
  transform: rotate(96deg);
}
.mdtp__digit.rotate-96 span {
  transform: rotate(-96deg);
}
.mdtp__digit.rotate-102 {
  transform: rotate(102deg);
}
.mdtp__digit.rotate-102 span {
  transform: rotate(-102deg);
}
.mdtp__digit.rotate-108 {
  transform: rotate(108deg);
}
.mdtp__digit.rotate-108 span {
  transform: rotate(-108deg);
}
.mdtp__digit.rotate-114 {
  transform: rotate(114deg);
}
.mdtp__digit.rotate-114 span {
  transform: rotate(-114deg);
}
.mdtp__digit.rotate-120 {
  transform: rotate(120deg);
}
.mdtp__digit.rotate-120 span {
  transform: rotate(-120deg);
}
.mdtp__digit.rotate-126 {
  transform: rotate(126deg);
}
.mdtp__digit.rotate-126 span {
  transform: rotate(-126deg);
}
.mdtp__digit.rotate-132 {
  transform: rotate(132deg);
}
.mdtp__digit.rotate-132 span {
  transform: rotate(-132deg);
}
.mdtp__digit.rotate-138 {
  transform: rotate(138deg);
}
.mdtp__digit.rotate-138 span {
  transform: rotate(-138deg);
}
.mdtp__digit.rotate-144 {
  transform: rotate(144deg);
}
.mdtp__digit.rotate-144 span {
  transform: rotate(-144deg);
}
.mdtp__digit.rotate-150 {
  transform: rotate(150deg);
}
.mdtp__digit.rotate-150 span {
  transform: rotate(-150deg);
}
.mdtp__digit.rotate-156 {
  transform: rotate(156deg);
}
.mdtp__digit.rotate-156 span {
  transform: rotate(-156deg);
}
.mdtp__digit.rotate-162 {
  transform: rotate(162deg);
}
.mdtp__digit.rotate-162 span {
  transform: rotate(-162deg);
}
.mdtp__digit.rotate-168 {
  transform: rotate(168deg);
}
.mdtp__digit.rotate-168 span {
  transform: rotate(-168deg);
}
.mdtp__digit.rotate-174 {
  transform: rotate(174deg);
}
.mdtp__digit.rotate-174 span {
  transform: rotate(-174deg);
}
.mdtp__digit.rotate-180 {
  transform: rotate(180deg);
}
.mdtp__digit.rotate-180 span {
  transform: rotate(-180deg);
}
.mdtp__digit.rotate-186 {
  transform: rotate(186deg);
}
.mdtp__digit.rotate-186 span {
  transform: rotate(-186deg);
}
.mdtp__digit.rotate-192 {
  transform: rotate(192deg);
}
.mdtp__digit.rotate-192 span {
  transform: rotate(-192deg);
}
.mdtp__digit.rotate-198 {
  transform: rotate(198deg);
}
.mdtp__digit.rotate-198 span {
  transform: rotate(-198deg);
}
.mdtp__digit.rotate-204 {
  transform: rotate(204deg);
}
.mdtp__digit.rotate-204 span {
  transform: rotate(-204deg);
}
.mdtp__digit.rotate-210 {
  transform: rotate(210deg);
}
.mdtp__digit.rotate-210 span {
  transform: rotate(-210deg);
}
.mdtp__digit.rotate-216 {
  transform: rotate(216deg);
}
.mdtp__digit.rotate-216 span {
  transform: rotate(-216deg);
}
.mdtp__digit.rotate-222 {
  transform: rotate(222deg);
}
.mdtp__digit.rotate-222 span {
  transform: rotate(-222deg);
}
.mdtp__digit.rotate-228 {
  transform: rotate(228deg);
}
.mdtp__digit.rotate-228 span {
  transform: rotate(-228deg);
}
.mdtp__digit.rotate-234 {
  transform: rotate(234deg);
}
.mdtp__digit.rotate-234 span {
  transform: rotate(-234deg);
}
.mdtp__digit.rotate-240 {
  transform: rotate(240deg);
}
.mdtp__digit.rotate-240 span {
  transform: rotate(-240deg);
}
.mdtp__digit.rotate-246 {
  transform: rotate(246deg);
}
.mdtp__digit.rotate-246 span {
  transform: rotate(-246deg);
}
.mdtp__digit.rotate-252 {
  transform: rotate(252deg);
}
.mdtp__digit.rotate-252 span {
  transform: rotate(-252deg);
}
.mdtp__digit.rotate-258 {
  transform: rotate(258deg);
}
.mdtp__digit.rotate-258 span {
  transform: rotate(-258deg);
}
.mdtp__digit.rotate-264 {
  transform: rotate(264deg);
}
.mdtp__digit.rotate-264 span {
  transform: rotate(-264deg);
}
.mdtp__digit.rotate-270 {
  transform: rotate(270deg);
}
.mdtp__digit.rotate-270 span {
  transform: rotate(-270deg);
}
.mdtp__digit.rotate-276 {
  transform: rotate(276deg);
}
.mdtp__digit.rotate-276 span {
  transform: rotate(-276deg);
}
.mdtp__digit.rotate-282 {
  transform: rotate(282deg);
}
.mdtp__digit.rotate-282 span {
  transform: rotate(-282deg);
}
.mdtp__digit.rotate-288 {
  transform: rotate(288deg);
}
.mdtp__digit.rotate-288 span {
  transform: rotate(-288deg);
}
.mdtp__digit.rotate-294 {
  transform: rotate(294deg);
}
.mdtp__digit.rotate-294 span {
  transform: rotate(-294deg);
}
.mdtp__digit.rotate-300 {
  transform: rotate(300deg);
}
.mdtp__digit.rotate-300 span {
  transform: rotate(-300deg);
}
.mdtp__digit.rotate-306 {
  transform: rotate(306deg);
}
.mdtp__digit.rotate-306 span {
  transform: rotate(-306deg);
}
.mdtp__digit.rotate-312 {
  transform: rotate(312deg);
}
.mdtp__digit.rotate-312 span {
  transform: rotate(-312deg);
}
.mdtp__digit.rotate-318 {
  transform: rotate(318deg);
}
.mdtp__digit.rotate-318 span {
  transform: rotate(-318deg);
}
.mdtp__digit.rotate-324 {
  transform: rotate(324deg);
}
.mdtp__digit.rotate-324 span {
  transform: rotate(-324deg);
}
.mdtp__digit.rotate-330 {
  transform: rotate(330deg);
}
.mdtp__digit.rotate-330 span {
  transform: rotate(-330deg);
}
.mdtp__digit.rotate-336 {
  transform: rotate(336deg);
}
.mdtp__digit.rotate-336 span {
  transform: rotate(-336deg);
}
.mdtp__digit.rotate-342 {
  transform: rotate(342deg);
}
.mdtp__digit.rotate-342 span {
  transform: rotate(-342deg);
}
.mdtp__digit.rotate-348 {
  transform: rotate(348deg);
}
.mdtp__digit.rotate-348 span {
  transform: rotate(-348deg);
}
.mdtp__digit.rotate-354 {
  transform: rotate(354deg);
}
.mdtp__digit.rotate-354 span {
  transform: rotate(-354deg);
}
.mdtp__digit.rotate-360 {
  transform: rotate(360deg);
}
.mdtp__digit.rotate-360 span {
  transform: rotate(-360deg);
}
.mdtp__buttons {
  margin: 0 -10px -10px;
  text-align: right;
}
.mdtp__button {
  display: inline-block;
  padding: 0 16px;
  min-width: 50px;
  text-align: center;
  text-transform: uppercase;
  line-height: 32px;
  font-weight: 500;
  cursor: pointer;
}
.mdtp__button:hover {
  background-color: #e0e0e0;
}
.mdtp__wrapper[data-theme="blue"] .mdtp__clock .mdtp__am.active,
.mdtp__wrapper[data-theme="blue"] .mdtp__clock .mdtp__clock_dot,
.mdtp__wrapper[data-theme="blue"] .mdtp__clock .mdtp__pm.active,
.mdtp__wrapper[data-theme="blue"] .mdtp__time_holder {
  background-color: #1565c0;
}
.mdtp__wrapper[data-theme="blue"] .mdtp__clock .mdtp__digit span:hover,
.mdtp__wrapper[data-theme="blue"] .mdtp__digit.active span {
  background-color: #1565c0 !important;
}
.mdtp__wrapper[data-theme="blue"] .mdtp__digit.active:before {
  background-color: #1565c0;
}
.mdtp__wrapper[data-theme="red"] .mdtp__clock .mdtp__am.active,
.mdtp__wrapper[data-theme="red"] .mdtp__clock .mdtp__clock_dot,
.mdtp__wrapper[data-theme="red"] .mdtp__clock .mdtp__pm.active,
.mdtp__wrapper[data-theme="red"] .mdtp__time_holder {
  background-color: #c62828;
}
.mdtp__wrapper[data-theme="red"] .mdtp__clock .mdtp__digit span:hover,
.mdtp__wrapper[data-theme="red"] .mdtp__digit.active span {
  background-color: #c62828 !important;
}
.mdtp__wrapper[data-theme="red"] .mdtp__digit.active:before {
  background-color: #c62828;
}
.mdtp__wrapper[data-theme="red"] .mdtp__button {
  color: #c62828;
}
.mdtp__wrapper[data-theme="purple"] .mdtp__clock .mdtp__am.active,
.mdtp__wrapper[data-theme="purple"] .mdtp__clock .mdtp__clock_dot,
.mdtp__wrapper[data-theme="purple"] .mdtp__clock .mdtp__pm.active,
.mdtp__wrapper[data-theme="purple"] .mdtp__time_holder {
  background-color: #6a1b9a;
}
.mdtp__wrapper[data-theme="purple"] .mdtp__clock .mdtp__digit span:hover,
.mdtp__wrapper[data-theme="purple"] .mdtp__digit.active span {
  background-color: #6a1b9a !important;
}
.mdtp__wrapper[data-theme="purple"] .mdtp__digit.active:before {
  background-color: #6a1b9a;
}
.mdtp__wrapper[data-theme="purple"] .mdtp__button {
  color: #6a1b9a;
}
.mdtp__wrapper[data-theme="indigo"] .mdtp__clock .mdtp__am.active,
.mdtp__wrapper[data-theme="indigo"] .mdtp__clock .mdtp__clock_dot,
.mdtp__wrapper[data-theme="indigo"] .mdtp__clock .mdtp__pm.active,
.mdtp__wrapper[data-theme="indigo"] .mdtp__time_holder {
  background-color: #283593;
}
.mdtp__wrapper[data-theme="indigo"] .mdtp__clock .mdtp__digit span:hover,
.mdtp__wrapper[data-theme="indigo"] .mdtp__digit.active span {
  background-color: #283593 !important;
}
.mdtp__wrapper[data-theme="indigo"] .mdtp__digit.active:before {
  background-color: #283593;
}
.mdtp__wrapper[data-theme="indigo"] .mdtp__button {
  color: #283593;
}
.mdtp__wrapper[data-theme="teal"] .mdtp__clock .mdtp__am.active,
.mdtp__wrapper[data-theme="teal"] .mdtp__clock .mdtp__clock_dot,
.mdtp__wrapper[data-theme="teal"] .mdtp__clock .mdtp__pm.active,
.mdtp__wrapper[data-theme="teal"] .mdtp__time_holder {
  background-color: #00695c;
}
.mdtp__wrapper[data-theme="teal"] .mdtp__clock .mdtp__digit span:hover,
.mdtp__wrapper[data-theme="teal"] .mdtp__digit.active span {
  background-color: #00695c !important;
}
.mdtp__wrapper[data-theme="teal"] .mdtp__digit.active:before {
  background-color: #00695c;
}
.mdtp__wrapper[data-theme="teal"] .mdtp__button {
  color: #00695c;
}
.mdtp__wrapper[data-theme="green"] .mdtp__clock .mdtp__am.active,
.mdtp__wrapper[data-theme="green"] .mdtp__clock .mdtp__clock_dot,
.mdtp__wrapper[data-theme="green"] .mdtp__clock .mdtp__pm.active,
.mdtp__wrapper[data-theme="green"] .mdtp__time_holder {
  background-color: #2e7d32;
}
.mdtp__wrapper[data-theme="green"] .mdtp__clock .mdtp__digit span:hover,
.mdtp__wrapper[data-theme="green"] .mdtp__digit.active span {
  background-color: #2e7d32 !important;
}
.mdtp__wrapper[data-theme="green"] .mdtp__digit.active:before {
  background-color: #2e7d32;
}
.mdtp__wrapper[data-theme="green"] .mdtp__button {
  color: #2e7d32;
}
@media (max-height: 360px) {
  .mdtp__wrapper {
    flex-direction: row;
    bottom: 8px;
  }
  .mdtp__time_holder {
    width: 160px;
    padding: 20px;
  }
  .mdtp__clock_holder {
    padding: 16px;
  }
  .mdtp__clock .mdtp__am,
  .mdtp__clock .mdtp__pm {
    bottom: -4px;
  }
  .mdtp__clock .mdtp__am {
    left: -4px;
  }
  .mdtp__clock .mdtp__pm {
    right: -4px;
  }
}
@media (max-height: 320px) {
  .mdtp__wrapper {
    bottom: 0;
  }
}

</style>


                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a href="{{url('admin/qrrs')}}">QRR</a></li>
                                            <li class="breadcrumb-item active">Add QRR</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i class="uil uil-plus"></i> QRR Data Entry </h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <x-admin-validation-errors :errors="$errors->all()"/>

                        <div class="row">
                            <div class="col-sm-12 ">
                                <form action="{{url('admin/qrrs/add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-body" id="app">
                                        <div class="row">

                                        @if (auth()->user()->hasRole('Super Admin'))
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="districtID" class="form-label "> জেলা </label>
                                                    <select name="districtID" id="districtID" class="form-select form-control"  v-model="district_id" @change="getUpozillasAndThana()"  required>
                                                        <option value="">Select</option>
                                                        @if($districts)

                                                        @foreach($districts as $district)
                                                        <option value="{{$district->id}}">{{$district->bn_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label">থানা</label>
                                                    <select name="thanaID" id="thanaID"  v-model="thana_id" class="form-select form-control" required>
                                                        <option value="">Select</option>
                                                        <option v-for="(thana,key,index) in thanas" v-bind:value="thana.id"> @php echo '{{ thana.name }}'; @endphp </option>
                                                    </select>
                                                </div>
                                            </div>
                                            @endif

                                            @if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label">থানা</label>
                                                    <select name="thanaID" id="thanaID" class="form-select form-control" required>
                                                        <option value="">Select</option>
                                                        @if($spthanas)

                                                        @foreach($spthanas as $thnsp)
                                                        <option value="{{$thnsp->id}}">{{$thnsp->bn_name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            @endif

                                            @if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="thanaID" class="form-label">থানা</label>
                                                    <select name="thanaID" id="thanaID" class="form-select form-control" required>
                                                        <option value="" disabled >Select</option>
                                                        @if($octhana)

                                                        <option value="{{$octhana->id}}" selected>{{$octhana->bn_name}}</option>
                                                        
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="village_word" class="form-label"> গ্রাম/ওয়ার্ড </label>
                                                    <input type="text" name="village_word"  value="{{old('village_word')}}" id="village_word" class="form-control  @error('village_word') is-invalid @enderror" placeholder="গ্রাম/ওয়ার্ড">
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="source_of_info" class="form-label">  তথ্য প্রাপ্তির উৎস </label>
                                                    <select name="source_of_info" id="source_of_info" class="form-select form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="এলাকা"> এলাকা </option>
                                                        <option value="কোর্ট">কোর্ট</option>
                                                        <option value="থানা">থানা</option>
                                                        <option value="৯৯৯">৯৯৯</option>
                                                    </select>
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="date_time_of_incident" class="form-label">   ঘটনার তারিখ ও সময়  </label>
                                                   
                                                    <div class="input-group" id="timepicker-input-group1">
                                                        <input type="text" name="date_time_of_incident"  value="{{old('date_time_of_incident')}}" id="date_time_of_incident" class="form-control datepicker  @error('date_time_of_incident') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="ঘটনার তারিখ ও সময়  " required>

                                                        <!-- Date dime -->
                                                        <input name="incident_time" id="timepicker" type="text" class="form-control timepicker" data-provide="timepicker" required>
                                                    </div>
                                                        
                                                </div>
                                              
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="date_time_of_police_news" class="form-label">  পুলিশের সংবাদ প্রাপ্তির তারিখ ও সময় </label>
                                                    <div class="input-group" id="timepicker-input-group2">
                                                        <input type="text" name="date_time_of_police_news"  value="{{old('date_time_of_police_news')}}" id="date_time_of_police_news" class="form-control datepicker  @error('date_time_of_police_news') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="সংবাদ প্রাপ্তির তারিখ ও সময়" required>

                                                        <!-- Date dime -->
                                                        <input name="police_news_time" type="text" class="form-control timepicker" data-provide="timepicker" required>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="date_time_response" class="form-label">  রেসপন্সের তারিখ ও সময় </label>
                                                    <div class="input-group" id="timepicker-input-group2">
                                                        <input type="text" name="date_time_response"  value="{{old('date_time_response')}}" id="date_time_response" class="form-control datepicker  @error('date_time_response') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="রেসপন্সের তারিখ ও সময়" >

                                                        <!-- Date dime -->
                                                        <input name="response_time" type="text" class="form-control timepicker" data-provide="timepicker" >
                                                    </div>
                                                </div>
                                            </div>

                                            


                                            
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="event_type" class="form-label">   ঘটনার ধরণ     </label>
                                                    <select name="event_type" id="event_type" class="form-select form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="মারামারি"> মারামারি </option>
                                                        <option value="খুন">খুন</option>
                                                        <option value="চুরি">চুরি</option>
                                                        <option value="ডাকাতি">ডাকাতি</option>
                                                        <option value="বিরোধ">বিরোধ</option>
                                                        <option value="দস্যুতা">দস্যুতা</option>
                                                        <option value="নিখোঁজ-অপহরণ">নিখোঁজ/ অপহরণ</option>
                                                        <option value="জুয়া">জুয়া</option>
                                                        <option value="সড়ক দুর্ঘটনা">সড়ক দুর্ঘটনা</option>
                                                        <option value="নারী ও শিশু">নারী ও শিশু</option>
                                                        <option value="অগ্নিকান্ড">অগ্নিকান্ড</option>
                                                        <option value="মাদক">মাদক</option>
                                                        <option value="সাইবার">সাইবার</option>
                                                        <option value="প্রতারণা">প্রতারণা</option>
                                                        <option value="রাজনৈতিক">দুর্ঘটনা</option>
                                                        <option value="অন্যান্য">অন্যান্য</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
      
                                            
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="begening_of_event" class="form-label">  ঘটনার সূত্রপাত  </label>
                                                    <select name="begening_of_event" id="begening_of_event" class="form-select form-control">
                                                        <option value="">Select</option>
                                                        <option value="জমিজমা"> জমিজমা </option>
                                                        <option value="রাজনৈতিক">রাজনৈতিক</option>
                                                        <option value="পারিবারিক">পারিবারিক</option>
                                                        <option value="তুচ্ছ কারণ">তুচ্ছ কারণ</option>
                                                        <option value="প্রেম ঘটিত">প্রেম ঘটিত</option>
                                                        <option value="লেনদেন সংক্রান্ত">লেনদেন সংক্রান্ত</option>
                                                        <option value="অসতর্কতা">অসতর্কতা</option>
                                                        <option value="অন্যান্য">অন্যান্য</option>
                                                    </select>
                                                </div>
                                            </div>

                                             <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="short_dettails" class="form-label">  ঘটনার সংক্ষিপ্ত বিবরন   </label>
                                                    <textarea type="text" name="short_dettails"  value="{{old('short_dettails')}}" id="short_dettails" class="form-control  @error('short_dettails') is-invalid @enderror" placeholder="  ঘটনার সংক্ষিপ্ত বিবরন  "> </textarea>
                                                </div>
                                            </div>
                                            
                                               <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="short_dettails" class="form-label">  ঘটনার সংক্ষিপ্ত বিবরন   </label>
                                                    <textarea type="text" name="short_dettails"  value="{{old('short_dettails')}}" id="short_dettails" class="form-control  @error('short_dettails') is-invalid @enderror" placeholder="  ঘটনার সংক্ষিপ্ত বিবরন  "> </textarea>
                                          

 
 
 
											</div>
                                            </div>
											
											
           
                                           
                                            
                   
      
          <div class="col-sm-12" >
                                             <hr>
												
                                            </div>
      
                        
                                            
                                                <div class="col-sm-12">
                                                <div class="mb-3">
                                               গৃহীত ব্যবস্থাঃ
                                               &nbsp; &nbsp;
  <input class="hidden radio-label" type="radio" name="action_taken" id="myCheckgd" value="জিডি" onclick="myFunction()">
    <label class="button-label" for="myCheckgd">
      <h1>জিডি</h1>
    </label>
	
	
    <input class="hidden radio-label" type="radio" name="action_taken" id="myCheck" value="মামলা" onclick="myFunction()" >
    <label class="button-label" for="myCheck">
      <h1>মামলা</h1>
	   </label>
	  
	     <input class="hidden radio-label" type="radio" name="action_taken" value="স্থানীয় পর্যায়ে মীমাংসা" id="myCheckmim" onclick="myFunction()" >
    <label class="button-label" for="myCheckmim">
      <h1>স্থানীয় পর্যায়ে মীমাংসা</h1>
	   </label>
	   
	       <input class="hidden radio-label" type="radio" name="action_taken" id="myCheckain" value="আইনগত পরামর্শ" onclick="myFunction()"     >
    <label class="button-label" for="myCheckain">
      <h1>আইনগত পরামর্শ</h1>
    </label>   

                                               
                                               
                                                </div>
                                            </div>
                                            
											
											
											
				

<script>


function myFunction() {

  var checkBoxgd = document.getElementById("myCheckgd");
    var checkBox = document.getElementById("myCheck");
  var checkBoxmim = document.getElementById("myCheckmim");
  var checkBoxain = document.getElementById("myCheckain");
  
      var gd1 = document.getElementById("gd1");
      var gd2 = document.getElementById("gd2");
	   var gd3 = document.getElementById("gd3");
   
     var mam = document.getElementById("mam");
     var mam2 = document.getElementById("mam2");
     var mam3 = document.getElementById("mam3");
     
	 
	var mim = document.getElementById("mim");
     var ain = document.getElementById("ain");
	 
	 
     
   if (checkBox.checked == true){
      mam.style.display = "block";
      mam2.style.display = "block";
      mam3.style.display = "block";
  
  } else {
         mam.style.display = "none";
         mam2.style.display = "none";
         mam3.style.display = "none";
         
     
  }
  
  
  
    if (checkBoxgd.checked == true){
  
      
      gd1.style.display = "block";
      gd2.style.display = "block";
	   gd3.style.display = "block";
  } else {

         
         gd1.style.display = "none";
         gd2.style.display = "none";
         gd3.style.display = "none";
		 
  }
  
  
  
  
  
  
}



</script>

                                            
                                            
                                
								                               <div class="col-sm-4" id="gd1" style="display:none">
                                                <div class="mb-3">
                                                    <label for="gd_no" class="form-label">  জিডি নং   </label>
                                                    <input type="text" name="gd_no"  value="{{old('gd_no')}}" id="gd_no" class="form-control  @error('gd_no') is-invalid @enderror" placeholder="  জিডি নং  ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4" id="gd2" style="display:none">
                                                <div class="mb-3">
                                                    <label for="gd_date" class="form-label">  জিডির তারিখ   </label>
                                                    
                                                    <input type="text" name="gd_date"  value="{{old('gd_date')}}" id="gd_date" class="form-control datepicker  @error('gd_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ">

                                                </div>
                                            </div>
											
											   <div class="col-sm-4" id="gd3" style="display:none">
                                              
                                            </div>
											
								
								
								
								
                                            <div class="col-sm-4" id="mam" style="display:none">
                                                <div class="mb-3">
                                                    <label for="case_no" class="form-label">  মামলা নং   </label>
                                                    <input type="text" name="case_no"  value="{{old('case_no')}}" id="case_no" class="form-control  @error('case_no') is-invalid @enderror" placeholder="   মামলা নং ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4" id="mam2" style="display:none"> 
                                                <div class="mb-3">
                                                    <label for="case_date" class="form-label"> মামলার  তারিখ  </label>
                                           
                                                    <input type="text" name="case_date"  value="{{old('case_date')}}" id="case_date" class="form-control datepicker  @error('case_date') is-invalid @enderror"  data-date-format="dd/mm/yyyy"  placeholder="তারিখ" >
                                                </div>
                                            </div>
      
      
                                             
                                            <div class="col-sm-4" id="mam3" style="display:none">
                                                <div class="mb-3">
                                                    <label for="clause" class="form-label">মামলার ধারা </label>
                                                    <input type="text" name="clause"  value="{{old('clause')}}" id="clause" class="form-control  @error('clause') is-invalid @enderror" placeholder=" ধারা">
                                                </div>
												
                                            </div>
      
      
          <div class="col-sm-12" >
                                             <hr>
												
                                            </div>
      
      
      
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="nopc" class="form-label"> বাদীর/ সংবাদদাতার নাম </label>
                                                    <input type="text" name="nopc"  value="{{old('nopc')}}" id="nopc" class="form-control  @error('nopc') is-invalid @enderror" placeholder="বাদীর/ সংবাদদাতার নাম ">
                                                </div>
                                            </div>
      
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="plaintiff_mobile" class="form-label">  বাদীর মোবাইল নং  </label>
                                                    <input type="text" minlength="11" maxlength="11" name="plaintiff_mobile"  value="{{old('plaintiff_mobile')}}" id="plaintiff_mobile" class="form-control  @error('plaintiff_mobile') is-invalid @enderror" placeholder=" বাদীর মোবাইল নং  " >
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="number_of_victims" class="form-label">   ভিকটিমের সংখ্যা   </label>
                                                    <input type="text" name="number_of_victims"  value="{{old('number_of_victims')}}" id="number_of_victims" class="form-control  @error('number_of_victims') is-invalid @enderror" placeholder="ভিকটিমের সংখ্যা ">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="number_of_accused" class="form-label">  অভিযুক্তের  সংখ্যা   </label>
                                                    <input type="text" name="number_of_accused"  value="{{old('number_of_accused')}}" id="number_of_accused" class="form-control  @error('number_of_accused') is-invalid @enderror" placeholder="অভিযুক্তের  সংখ্যা ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="name_of_investigator" class="form-label">রেসপন্সকারী/ তদন্তকারী কর্মকর্তার নাম   </label>
                                                    <input type="text" name="name_of_investigator"  value="{{old('name_of_investigator')}}" id="name_of_investigator" class="form-control  @error('name_of_investigator') is-invalid @enderror" placeholder=" রেসপন্সকারী/ তদন্তকারী কর্মকর্তার নাম " required>
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="bp_no" class="form-label"> বিপি নং   </label>
                                                    <input type="text" name="bp_no"  value="{{old('bp_no')}}" id="bp_no" class="form-control  @error('bp_no') is-invalid @enderror" placeholder="  বিপি নং ">
                                                </div>
                                            </div>
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="mobile_no" class="form-label">  মোবাইল নং    </label>
                                                    <input type="text"   minlength="11" maxlength="11" name="mobile_no"  value="{{old('mobile_no')}}" id="mobile_no" class="form-control  @error('mobile_no') is-invalid @enderror" placeholder=" মোবাইল নং" required>
                                                </div>
                                            </div>
      
      
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="image_video" class="form-label">   ছবি/ভিডিও প্রাপ্তি    </label>
                                                    <select name="image_video" id="image_video" class="form-select form-control" >
                                                        <option value="">Select</option>
                                                        <option value="হ্যা">হ্যা</option>
                                                        <option value="না">না</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
      
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="media_quality" class="form-label">   সন্তুষ্টির মান   </label>
                                                    <select name="media_quality" id="media_quality" class="form-select form-control" >
                                                        <option value="">Select</option>
                                                        <option value="সন্তুষ্ট"> সন্তুষ্ট </option>
                                                        <option value="মোটামুটি সন্তুষ্ট">মোটামুটি সন্তুষ্ট</option>
                                                        <option value="অসন্তুষ্ট">অসন্তুষ্ট</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
      
                                            
                                    
                                            
                                            
                                                <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="main_event" class="form-label"> মূল রিপোর্ট  </label>
                                                    
                                                    <textarea name="main_event"  class="form-control  @error('main_event') is-invalid @enderror" id="main_event" rows="2" placeholder="মূল ঘটনা" required>{{old('main_event')}}</textarea>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                               <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="comments" class="form-label">মন্তব্য</label>
                                                    <textarea name="comments"  class="form-control  @error('comments') is-invalid @enderror" id="address" rows="2" placeholder="মন্তব্য">{{old('comments')}}</textarea>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
     
                                </form>
                                
                                
                                
                            </div>
                        </div>
                        <!-- end row -->
                        @php
                if($request->input('divisionID'))
                    $division_id = $request->input('divisionID');
                if($request->input('districtID'))
                    $district_id = $this->input('districtID');
                if($request->input('upazilaID'))
                    $upozilla_id = $request->input('upazilaID');
                if($request->input('thanaID'))
                    $thana_id = $request->input('thanaID');

                @endphp
    <script src="{{ asset('my-assets/admin/js/vue.js') }}"></script>
    <script src="{{ asset('my-assets/admin/js/axios.min.js') }}"></script>






  <script>
    var app = new Vue({
          el: '#app',
          data: {
            message: 'Hello Vue!',
            ajax_url: '<?php echo url('admin'); ?>',
           
              
            divisions:null,
            districts:null,
            upozillas:null,
            thanas:null,
            
            division_id:'@if(isset($division_id) and $division_id){{$division_id}}@endif',
            district_id:'@if(isset($district_id) and $district_id){{$district_id}}@endif',
            upozilla_id:'@if(isset($upozilla_id) and $upozilla_id){{$upozilla_id}}@endif',
            thana_id:'@if(isset($thana_id) and $thana_id){{$thana_id}}@endif',


          },

            created(){
                
                if(this.division_id!=""){
                    this.getDistricts();
                }
                if(this.district_id!=""){
                    this.getUpozillas();
                }
                
            },


            methods:{

                
                // send message to account customer
                getDivisions(){
                     axios.get(this.ajax_url+'/divisions')
                    .then(res => {
                        this.divisions = res.data;
                    })
                    .catch(err => {console.log(err); });
                    
                },
                
                
                //this method for get districts
                getDistricts(){
                    if(this.division_id==""){
                   }else{
                        axios.get(this.ajax_url+'/districts/'+this.division_id)
                        .then(res => {
                            this.districts = res.data;
                        })
                        .catch(err => {console.log(err); });
                      
                   }
                    
                },

                getUpozillasAndThana(){
                    //this.getUpozillas();
                    this.getThanas();
                },
                
                //this method for get medicals
                getUpozillas(){
                    if(this.district_id==""){
                   }else{
                        axios.get(this.ajax_url+'/upazilas/'+this.district_id)
                        .then(res => {
                            this.upozillas = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },

                
                //this method for get medicals
                getThanas(){
                    if(this.district_id==""){
                   }else{
                        axios.get(this.ajax_url+'/thanas/'+this.district_id)
                        .then(res => {
                            this.thanas = res.data;
                        })
                        .catch(err => {console.log(err); }); 
                   }
                    
                },
                

            }

        });

    </script>


<script>

var defaults = {
	calendarWeeks: true,
	showClear: true,
	showClose: true,
	allowInputToggle: true,
	useCurrent: false,
	ignoreReadonly: true,
	minDate: new Date(),
	toolbarPlacement: 'top',
	locale: 'nl',
	icons: {
		time: 'fa fa-clock-o',
		date: 'fa fa-calendar',
		up: 'fa fa-angle-up',
		down: 'fa fa-angle-down',
		previous: 'fa fa-angle-left',
		next: 'fa fa-angle-right',
		today: 'fa fa-dot-circle-o',
		clear: 'fa fa-trash',
		close: 'fa fa-times'
	}
};


</script>    



<script>
$( document ).ready(function() {
    
    var checkboxes = $("input[type='checkbox']"),
    actions = $("#actions");

    checkboxes.click(function() {
    
       actions.attr("hidden", !checkboxes.is(":checked"));
      
    });
      
});
</script>  


<script>
  $(document).ready(function(){
    $('.timepicker').mdtimepicker();
  });
</script>
<!-- partial -->
  <script>
  /* -- DO NOT REMOVE --
 * jQuery MDTimePicker v1.0 plugin
 * 
 * Author: Dionlee Uy
 * Email: dionleeuy@gmail.com
 *
 * Date: Tuesday, August 28 2017
 *
 * @requires jQuery
 * -- DO NOT REMOVE -- */
if ("undefined" == typeof jQuery) throw new Error("MDTimePicker: This plugin requires jQuery"); + function(e) {
    var t = "mdtimepicker",
        i = 120,
        s = 90,
        n = 360,
        r = 30,
        a = 6,
        o = [9, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123],
        c = function(t, i) {
            this.hour = t, this.minute = i, this.format = function(t, i) {
                var s = this,
                    n = (t.match(/h/g) || []).length > 1;
                return e.trim(t.replace(/(hh|h|mm|ss|tt|t)/g, function(e) {
                    switch (e.toLowerCase()) {
                        case "h":
                            var t = s.getHour(!0);
                            return i && 10 > t ? "0" + t : t;
                        case "hh":
                            return s.hour < 10 ? "0" + s.hour : s.hour;
                        case "mm":
                            return s.minute < 10 ? "0" + s.minute : s.minute;
                        case "ss":
                            return "00";
                        case "t":
                            return n ? "" : s.getT().toLowerCase();
                        case "tt":
                            return n ? "" : s.getT()
                    }
                }))
            }, this.setHour = function(e) {
                this.hour = e
            }, this.getHour = function(e) {
                return e ? 0 === this.hour || 12 === this.hour ? 12 : this.hour % 12 : this.hour
            }, this.invert = function() {
                "AM" === this.getT() ? this.setHour(this.getHour() + 12) : this.setHour(this.getHour() - 12)
            }, this.setMinutes = function(e) {
                this.minute = e
            }, this.getMinutes = function() {
                return this.minute
            }, this.getT = function() {
                return this.hour < 12 ? "AM" : "PM"
            }
        },
        d = function(t, i) {
            var s = this;
            this.visible = !1, this.activeView = "hours", this.hTimeout = null, this.mTimeout = null, this.input = e(t), this.config = i, this.time = new c(0, 0), this.selected = new c(0, 0), this.timepicker = {
                overlay: e('<div class="mdtimepicker hidden"></div>'),
                wrapper: e('<div class="mdtp__wrapper"></div>'),
                timeHolder: {
                    wrapper: e('<section class="mdtp__time_holder"></section>'),
                    hour: e('<span class="mdtp__time_h">12</span>'),
                    dots: e('<span class="mdtp__timedots">:</span>'),
                    minute: e('<span class="mdtp__time_m">00</span>'),
                    am_pm: e('<span class="mdtp__ampm">AM</span>')
                },
                clockHolder: {
                    wrapper: e('<section class="mdtp__clock_holder"></section>'),
                    am: e('<span class="mdtp__am">AM</span>'),
                    pm: e('<span class="mdtp__pm">PM</span>'),
                    clock: {
                        wrapper: e('<div class="mdtp__clock"></div>'),
                        dot: e('<span class="mdtp__clock_dot"></span>'),
                        hours: e('<div class="mdtp__hour_holder"></div>'),
                        minutes: e('<div class="mdtp__minute_holder"></div>')
                    },
                    buttonsHolder: {
                        wrapper: e('<div class="mdtp__buttons">'),
                        btnOk: e('<span class="mdtp__button ok">Ok</span>'),
                        btnCancel: e('<span class="mdtp__button cancel">Cancel</span>')
                    }
                }
            };
            var n = s.timepicker;
            if (s.setup(n).appendTo("body"), n.clockHolder.am.click(function() {
                    "AM" !== s.selected.getT() && s.setT("am")
                }), n.clockHolder.pm.click(function() {
                    "PM" !== s.selected.getT() && s.setT("pm")
                }), n.timeHolder.hour.click(function() {
                    "hours" !== s.activeView && s.switchView("hours")
                }), n.timeHolder.minute.click(function() {
                    "minutes" !== s.activeView && s.switchView("minutes")
                }), n.clockHolder.buttonsHolder.btnOk.click(function() {
                    s.setValue(s.selected);
                    var t = s.getFormattedTime();
                    s.input.trigger(e.Event("timechanged", {
                        time: t.time,
                        value: t.value
                    })).trigger("onchange"), s.hide()
                }), n.clockHolder.buttonsHolder.btnCancel.click(function() {
                    s.hide()
                }), s.input.on("keydown", function(e) {
                    return 13 === e.keyCode && s.show(), !(o.indexOf(e.which) < 0 && s.config.readOnly)
                }).on("click", function() {
                    s.show()
                }).prop("readonly", s.config.readOnly), "" !== s.input.val()) {
                var r = s.parseTime(s.input.val(), s.config.format);
                s.setValue(r)
            } else {
                var r = s.getSystemTime();
                s.time = new c(r.hour, r.minute)
            }
            s.resetSelected(), s.switchView(s.activeView)
        };
    d.prototype = {
        constructor: d,
        setup: function(t) {
            if ("undefined" == typeof t) throw new Error("Expecting a value.");
            var o = this,
                c = t.overlay,
                d = t.wrapper,
                u = t.timeHolder,
                m = t.clockHolder;
            u.wrapper.append(u.hour).append(u.dots).append(u.minute).append(u.am_pm).appendTo(d);
            for (var l = 0; 12 > l; l++) {
                var p = l + 1,
                    h = (i + l * r) % n,
                    f = e('<div class="mdtp__digit rotate-' + h + '" data-hour="' + p + '"><span>' + p + "</span></div>");
                f.find("span").click(function() {
                    var t = parseInt(e(this).parent().data("hour")),
                        i = o.selected.getT(),
                        s = (t + ("PM" === i && 12 > t || "AM" === i && 12 === t ? 12 : 0)) % 24;
                    o.setHour(s), o.switchView("minutes")
                }), m.clock.hours.append(f)
            }
            for (var l = 0; 60 > l; l++) {
                var v = 10 > l ? "0" + l : l,
                    h = (s + l * a) % n,
                    k = e('<div class="mdtp__digit rotate-' + h + '" data-minute="' + l + '"></div>');
                l % 5 === 0 ? k.addClass("marker").html("<span>" + v + "</span>") : k.html("<span></span>"), k.find("span").click(function() {
                    o.setMinute(e(this).parent().data("minute"))
                }), m.clock.minutes.append(k)
            }
            switch (m.clock.wrapper.append(m.am).append(m.pm).append(m.clock.dot).append(m.clock.hours).append(m.clock.minutes).appendTo(m.wrapper), m.buttonsHolder.wrapper.append(m.buttonsHolder.btnCancel).append(m.buttonsHolder.btnOk).appendTo(m.wrapper), m.wrapper.appendTo(d), o.config.theme) {
                case "red":
                case "blue":
                case "green":
                case "purple":
                case "indigo":
                case "teal":
                    d.attr("data-theme", o.config.theme);
                    break;
                default:
                    d.attr("data-theme", e.fn.mdtimepicker.defaults.theme)
            }
            return d.appendTo(c), c
        },
        setHour: function(t) {
            if ("undefined" == typeof t) throw new Error("Expecting a value.");
            var i = this;
            this.selected.setHour(t), this.timepicker.timeHolder.hour.text(this.selected.getHour(!0)), this.timepicker.clockHolder.clock.hours.children("div").each(function(t, s) {
                var n = e(s),
                    r = n.data("hour");
                n[r === i.selected.getHour(!0) ? "addClass" : "removeClass"]("active")
            })
        },
        setMinute: function(t) {
            if ("undefined" == typeof t) throw new Error("Expecting a value.");
            this.selected.setMinutes(t), this.timepicker.timeHolder.minute.text(10 > t ? "0" + t : t), this.timepicker.clockHolder.clock.minutes.children("div").each(function(i, s) {
                var n = e(s),
                    r = n.data("minute");
                n[r === t ? "addClass" : "removeClass"]("active")
            })
        },
        setT: function(e) {
            if ("undefined" == typeof e) throw new Error("Expecting a value.");
            this.selected.getT() !== e.toUpperCase() && this.selected.invert();
            var t = this.selected.getT();
            this.timepicker.timeHolder.am_pm.text(t), this.timepicker.clockHolder.am["AM" === t ? "addClass" : "removeClass"]("active"), this.timepicker.clockHolder.pm["PM" === t ? "addClass" : "removeClass"]("active")
        },
        setValue: function(e) {
            if ("undefined" == typeof e) throw new Error("Expecting a value.");
            var t = "string" == typeof e ? this.parseTime(e, this.config.format) : e;
            this.time = new c(t.hour, t.minute);
            var i = this.getFormattedTime();
            this.input.val(i.value).attr("data-time", i.time).attr("value", i.value)
        },
        resetSelected: function() {
            this.setHour(this.time.hour), this.setMinute(this.time.minute), this.setT(this.time.getT())
        },
        getFormattedTime: function() {
            var e = this.time.format(this.config.timeFormat, !1),
                t = this.time.format(this.config.format, this.config.hourPadding);
            return {
                time: e,
                value: t
            }
        },
        getSystemTime: function() {
            var e = new Date;
            return new c(e.getHours(), e.getMinutes())
        },
        parseTime: function(e, t) {
            var i = this,
                s = "undefined" == typeof t ? i.config.format : t,
                n = (s.match(/h/g) || []).length,
                r = n > 1,
                a = ((s.match(/m/g) || []).length, (s.match(/t/g) || []).length),
                o = e.length,
                d = s.indexOf("h"),
                u = s.lastIndexOf("h"),
                m = "",
                l = "",
                p = "";
            if (i.config.hourPadding || r) m = e.substr(d, 2);
            else {
                var h = s.substring(d - 1, d),
                    f = s.substring(u + 1, u + 2);
                m = u === s.length - 1 ? e.substring(e.indexOf(h, d - 1) + 1, o) : 0 === d ? e.substring(0, e.indexOf(f, d)) : e.substring(e.indexOf(h, d - 1) + 1, e.indexOf(f, d + 1))
            }
            s = s.replace(/(hh|h)/g, m);
            var v = s.indexOf("m"),
                k = s.lastIndexOf("m"),
                g = s.indexOf("t"),
                w = s.substring(v - 1, v);
            s.substring(k + 1, k + 2);
            l = k === s.length - 1 ? e.substring(e.indexOf(w, v - 1) + 1, o) : 0 === v ? e.substring(0, 2) : e.substr(v, 2), p = r ? parseInt(m) > 11 ? a > 1 ? "PM" : "pm" : a > 1 ? "AM" : "am" : e.substr(g, 2);
            var H = "pm" === p.toLowerCase(),
                _ = new c(parseInt(m), parseInt(l));
            return (H && parseInt(m) < 12 || !H && 12 === parseInt(m)) && _.invert(), _
        },
        switchView: function(e) {
            var t = this,
                i = this.timepicker,
                s = 350;
            "hours" !== e && "minutes" !== e || (t.activeView = e, i.timeHolder.hour["hours" === e ? "addClass" : "removeClass"]("active"), i.timeHolder.minute["hours" === e ? "removeClass" : "addClass"]("active"), i.clockHolder.clock.hours.addClass("animate"), "hours" === e && i.clockHolder.clock.hours.removeClass("hidden"), clearTimeout(t.hTimeout), t.hTimeout = setTimeout(function() {
                "hours" !== e && i.clockHolder.clock.hours.addClass("hidden"), i.clockHolder.clock.hours.removeClass("animate")
            }, "hours" === e ? 20 : s), i.clockHolder.clock.minutes.addClass("animate"), "minutes" === e && i.clockHolder.clock.minutes.removeClass("hidden"), clearTimeout(t.mTimeout), t.mTimeout = setTimeout(function() {
                "minutes" !== e && i.clockHolder.clock.minutes.addClass("hidden"), i.clockHolder.clock.minutes.removeClass("animate")
            }, "minutes" === e ? 20 : s))
        },
        show: function() {
            var t = this;
            if ("" === t.input.val()) {
                var i = t.getSystemTime();
                this.time = new c(i.hour, i.minute)
            }
            t.resetSelected(), e("body").attr("mdtimepicker-display", "on"), t.timepicker.wrapper.addClass("animate"), t.timepicker.overlay.removeClass("hidden").addClass("animate"), setTimeout(function() {
                t.timepicker.overlay.removeClass("animate"), t.timepicker.wrapper.removeClass("animate"), t.visible = !0, t.input.blur()
            }, 10)
        },
        hide: function() {
            var t = this;
            t.timepicker.overlay.addClass("animate"), t.timepicker.wrapper.addClass("animate"), setTimeout(function() {
                t.switchView("hours"), t.timepicker.overlay.addClass("hidden").removeClass("animate"), t.timepicker.wrapper.removeClass("animate"), e("body").removeAttr("mdtimepicker-display"), t.visible = !1, t.input.focus()
            }, 300)
        },
        destroy: function() {
            var e = this;
            e.input.removeData(t).unbind("keydown").unbind("click").removeProp("readonly"), e.timepicker.overlay.remove()
        }
    }, e.fn.mdtimepicker = function(i) {
        return e(this).each(function() {
            var s = this,
                n = e(this),
                r = e(this).data(t);
            options = e.extend({}, e.fn.mdtimepicker.defaults, n.data(), "object" == typeof i && i), r || n.data(t, r = new d(s, options)), "string" == typeof i && r[i](), e(document).on("keydown", function(e) {
                27 === e.keyCode && r.visible && r.hide()
            })
        })
    }, e.fn.mdtimepicker.defaults = {
        timeFormat: "hh:mm:ss.000",
        format: "h:mm tt",
        theme: "blue",
        readOnly: !0,
        hourPadding: !1
    }
}(jQuery);
  
  
  
  </script>


<x-admin-footer/>
<script>
$("input[type='radio']").on("change", function(){
   if($('#secondInput').is(':checked')){
    $("input[type='text']").show();
    $("input[type='text']").prop('required',true);
  } else {
    $("input[type='text']").hide();
    $("input[type='text']").prop('required',false);
  }
});
<script>