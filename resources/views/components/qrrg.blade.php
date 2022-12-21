@if ( request()->is('admin/qrrs/srcs') || request()->is('admin/qrrs/charts'))
@php 
$allin = request()->all();
$removarr = \Illuminate\Support\Arr::except($allin, 'districtID');
$string1 = url('/admin/qrrs/srcs/data') .'?'. http_build_query($removarr);
//dd($string);
@endphp
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin']))

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['District', 'Incident', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         @if (empty(request()->input('districtID')))
         ['বরগুনা', {{session('borgona')}}, '#756bb1', '{{session("borgona")}}', '@if (request()->is("admin/qrrs/srcs")) {!!$string1 . "&districtID=34&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=34"!!} @endif'],            // RGB value
         ['বরিশাল', {{session('barisal')}}, '#bbbbdb', '{{session("barisal")}}', '@if (request()->is("admin/qrrs/srcs")) {!!$string1 . "&districtID=35&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=35"!!} @endif'],         // English color name
         ['পিরোজপুর', {{session('pirojpur')}}, 'color: #756bb1', '{{session("pirojpur")}}', '@if (request()->is("admin/qrrs/srcs")) {!!$string1 . "&districtID=39&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=39"!!} @endif'],
         ['পটুয়াখালী', {{session('patuakhali')}}, 'color: #bbbbdb', '{{session("patuakhali")}}', '@if (request()->is("admin/qrrs/srcs")) {!!$string1 . "&districtID=38&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=38"!!} @endif'],
         ['ভোলা', {{session('bhola')}}, '#756bb1', '{{session("bhola")}}', '@if (request()->is("admin/qrrs/srcs")) {!!$string1 . "&districtID=36&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=36"!!} @endif'],
         ['ঝালকাঠি', {{session('jalokhati')}}, 'color: #bbbbdb',  '{{session("jalokhati")}}', '@if (request()->is("admin/qrrs/srcs")) {!!$string1 . "&districtID=37&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=37"!!} @endif'], // CSS-style declaration
        @endif

         @php 
      $allin = request()->all();
     $removarr = \Illuminate\Support\Arr::except($allin, 'thanaID');
     $string1 = url('/admin/qrrs/srcs/data') .'?'. http_build_query($removarr);
      @endphp

        @if (!empty(request()->input('thanaID')))
        ['{{session("disthananame")}}', {{session('disthanavalue')}}, '#26a49a', '{{session("disthanavalue")}}', '@if (request()->is("admin/qrrs/srcs")) {!!$string1 . "&thanaID=".session("disthanaid")!!} @else {!!$string1 . "&thanaID=".session("disthanaid")!!} @endif'],
        @elseif(!empty(request()->input('districtID')))
        @foreach(session("disthana") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}, 'color: #9b0001', '{{$value[0]}}', '@if (request()->is("admin/qrrs/srcs")) {!!$string1 . "&thanaID=".$value[2]!!} @else {!!$string1 . "&thanaID=".$value[2]!!} @endif'],

         @endforeach
        @endif
      ]);

        // Set chart options
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
        
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        google.visualization.events.addListener(chart, 'select', function (e) {
            var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link =data.getValue(row, 4);
                    //window.open(link, '_blank');
                    window.open(link, '_blank');
                   
                }
        });
        chart.draw(data, options);
      }

      @endif

      @if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      @php 
      $allin = request()->all();
     $removarr = \Illuminate\Support\Arr::except($allin, 'thanaID');
     $string1 = url('/admin/qrrs/srcs/data') .'?'. http_build_query($removarr);
      @endphp
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['District', 'Incident', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         
         @foreach(session("spthana") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}, 'color: #9b0001', '{{$value[0]}}', '@if (request()->is("admin/qrrs/srcs")) {!!$string1 . "&thanaID=".$value[2] . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&thanaID=".$value[2]!!} @endif'],

         @endforeach
        
       
      ]);

        // Set chart options
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
        
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        google.visualization.events.addListener(chart, 'select', function (e) {
            var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link =data.getValue(row, 4);
                    window.open(link, '_blank');
                }
        });
        chart.draw(data, options);
      }

      @endif

      @if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))

      @php 
      $allin = request()->all();
     $removarr = \Illuminate\Support\Arr::except($allin, 'thanaID');
     $string1 = url('/admin/qrrs/srcs/data') .'?'. http_build_query($removarr);
      @endphp

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['District', 'Incident', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],

         ['{{session("octhananame")}}', {{session('octhanavalue')}}, '#26a49a', '{{session("octhanavalue")}}', '@if (request()->is("admin/qrrs/srcs")) {!!$string1 . "&thanaID=".session("octhanaid") . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&thanaID=".session("octhanaid")!!} @endif'],

      ]);

        // Set chart options
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
        
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        google.visualization.events.addListener(chart, 'select', function (e) {
            var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link =data.getValue(row, 4);
                    window.open(link, '_blank');
                }
        });
        chart.draw(data, options);
      }

      @endif

      google.charts.setOnLoadCallback(drawChart2);

      @php 
      $allin = request()->all();
     $removarr = \Illuminate\Support\Arr::except($allin, 'source_of_info');
     $string1 = url('/admin/qrrs/srcs/data') .'?'. http_build_query($removarr);
      @endphp

      function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['Information source', 'count', { role: 'link' }, {role: 'annotation', type: 'string'}],
          ['এলাকা', {{session('insala')}}, '@if (request()->is("admin/qrrs/srcs")) {!!$string1 . "&source_of_info=এলাকা" . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&source_of_info=এলাকা"!!} @endif', '{{session("insala")}}'],
          ['কোর্ট',  {{session('inscou')}}, '@if (request()->is("admin/qrrs/srcs")) {!!$string1 . "&source_of_info=কোর্ট" . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&source_of_info=কোর্ট"!!} @endif', '{{session("inscou")}}'],
          ['থানা',  {{session('instha')}}, '@if (request()->is("admin/qrrs/srcs")) {!!$string1 . "&source_of_info=থানা" . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&source_of_info=থানা"!!} @endif', '{{session("instha")}}'],
          ['৯৯৯', {{session('ins99')}}, '@if (request()->is("admin/qrrs/srcs")) {!!$string1 . "&source_of_info=৯৯৯" . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&source_of_info=৯৯৯"!!} @endif', '{{session("ins99")}}']
        ]);

        var options = {
          title: '',
          is3D: true,
        width: "98%",
        height: "300",
        pieSliceText: 'value',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        google.visualization.events.addListener(chart, 'select', function (e) {
            var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link =data.getValue(row, 2);
                    window.open(link, '_blank');
                }
        });

        chart.draw(data, options);
      }

       // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart3);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and

      @php
      $string = url('/admin/qrrs/srcs/data') .'?'. http_build_query(request()->all());
      @endphp
      // draws it.
      function drawChart3() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Crime Type', 'Incident', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         @if (session('etmara') > 0)
         ['মারামারি', {{session('etmara')}}, '#26a59a', '{{session("etmara")}}', '{!!$string . "&eventtype=মারামারি"!!}'],
         @endif
         @if (session('etkun') > 0)
         ['খুন', {{session('etkun')}}, '#26a59a', '{{session("etkun")}}', '{!!$string . "&eventtype=খুন"!!}'],
         @endif
         @if (session('etchori') > 0)
         ['চুরি', {{session('etchori')}}, '#26a59a', '{{session("etchori")}}', '{!!$string . "&eventtype=চুরি"!!}'],
         @endif
         @if (session('etdakati') > 0)
         ['ডাকাতি', {{session('etdakati')}}, 'color: #26a59a', '{{session("etdakati")}}', '{!!$string . "&eventtype=ডাকাতি"!!}'], 
         @endif
         @if (session('etsompds') > 0)
         ['বিরোধ', {{session('etsompds')}}, '#26a59a', '{{session("etsompds")}}', '{!!$string . "&eventtype=বিরোধ"!!}'],
         @endif
         @if (session('etnikoj') > 0)
         ['নিখোঁজ', {{session('etnikoj')}}, '#26a59a', '{{session("etnikoj")}}', '{!!$string . "&eventtype=নিখোঁজ"!!}'],
         @endif
         @if (session('etdusht') > 0)
         ['দস্যুতা', {{session('etdusht')}}, '#26a59a', '{{session("etdusht")}}', '{!!$string . "&eventtype=দস্যুতা"!!}'],
         @endif
         @if (session('etjua') > 0)
         ['জুয়া', {{session('etjua')}}, '#26a59a', '{{session("etjua")}}', '{!!$string . "&eventtype=জুয়া"!!}'],
         @endif
         @if (session('etsorokd') > 0)
         ['সড়ক দুর্ঘটনা', {{session('etsorokd')}}, '#26a59a', '{{session("etsorokd")}}', '{!!$string . "&eventtype=সড়ক দুর্ঘটনা"!!}'],
         @endif
         @if (session('etnarios') > 0)
         ['নারী ও শিশু', {{session('etnarios')}}, '#26a59a', '{{session("etnarios")}}', '{!!$string . "&eventtype=নারী ও শিশু"!!}'],
         @endif
         @if (session('etagun') > 0)
         ['অগ্নিকান্ড', {{session('etagun')}}, '#26a59a', '{{session("etagun")}}', '{!!$string . "&eventtype=অগ্নিকান্ড"!!}'],
         @endif
         @if (session('etmadok') > 0)
         ['মাদক', {{session('etmadok')}}, '#26a59a', '{{session("etmadok")}}', '{!!$string . "&eventtype=মাদক"!!}'],
         @endif
         @if (session('etcyber') > 0)
         ['সাইবার', {{session('etcyber')}}, '#26a59a', '{{session("etcyber")}}', '{!!$string . "&eventtype=সাইবার"!!}'],
         @endif
         @if (session('etprota') > 0)
         ['প্রতারণা', {{session('etprota')}}, '#26a59a', '{{session("etprota")}}', '{!!$string . "&eventtype=প্রতারণা"!!}'],
         @endif
         @if (session('etrajnoi') > 0)
         ['দুর্ঘটনা', {{session('etrajnoi')}}, '#26a59a', '{{session("etrajnoi")}}', '{!!$string . "&eventtype=দুর্ঘটনা"!!}'],
         @endif
         @if (session('etonno') > 0)
         ['অন্যান্য', {{session('etonno')}}, '#26a59a', '{{session("etonno")}}', '{!!$string . "&eventtype=অন্যান্য"!!}'],
         @endif
      ]);

        // Set chart options
        var options = {
        title: "",
        width: "98%",
        height: 350,
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div2'));
        google.visualization.events.addListener(chart, 'select', function (e) {
            var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link =data.getValue(row, 4);
                    window.open(link, '_blank');
                }
        });
        chart.draw(data, options);
      }




      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart4);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and

      @php
      $string = url('/admin/qrrs/srcs/data') .'?'. http_build_query(request()->all());
      @endphp
      // draws it.
      function drawChart4() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Crime Type', 'Incident', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         @foreach(session('begningofevent') as $key => $value)
         ['{{$value->begening_of_event}}', {{$value->begevcount}}, '#26a59a', '{{$value->begevcount}}', ' @if (request()->is("admin/qrrs/srcs")) {!!$string . "&begening_of_event=" . $value->begening_of_event . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string . "&begening_of_event=" . $value->begening_of_event!!} @endif'],
         @endforeach
      ]);

        // Set chart options
        var options = {
        title: "",
        width: "98%",
        height: 350,
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div4'));
        google.visualization.events.addListener(chart, 'select', function (e) {
            var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link =data.getValue(row, 4);
                    window.open(link, '_blank');
                }
        });
        chart.draw(data, options);
      }


      google.charts.setOnLoadCallback(drawChart6);

      function drawChart6() {

        var data = google.visualization.arrayToDataTable([
          ['Action taken', 'count', 'number', { role: 'link' }],
          @foreach(session("actiontaken") as $key => $value)
          ['{{$value->action_taken}}', {{$value->actioncount}}, '{{$value->actioncount}}', '@if (request()->is("admin/qrrs/srcs")) {!!$string . "&action_taken=" . $value->action_taken . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string . "&action_taken=" . $value->action_taken!!} @endif'],
          @endforeach
        ]);

        var options = {
          title: '',
          is3D: true,
        width: "98%",
        height: "300",
        pieSliceText: 'value',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart3'));

        google.visualization.events.addListener(chart, 'select', function (e) {
            var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link =data.getValue(row, 3);
                    location.href = link;
                }
        });
        chart.draw(data, options);
      }

      </script>

      @endif