@if ( request()->is('admin/case/dashboard'))

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
         ['District', 'Case', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],

         @if (!is_null(session("diswisecase")))
         
         @foreach(session("diswisecase") as $key => $value)

         
         ['{{$value->district->bn_name}}', {{$value->countcase}}, 'color: #756bb1', '{{$value->countcase}}', '{!!url("/admin/case/dashboard/chart/data") . "?districtID=". $value->district->id . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!}'],
         @endforeach

         @endif
        
       
      ]);

        // Set chart options
            // মোট কেস 
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
                    location.href = link;
                }
        });
        chart.draw(data, options);
      }

      @elseif(auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))
   
      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Circle', 'Case', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         
         @if (!is_null(session("circlewise")))
         @foreach(session("circlewise") as $key => $value)

         
         ['{{$value->thana->bn_name}}', {{$value->countcase}}, 'color: #756bb1', '{{$value->countcase}}', '{!!url("/admin/case/dashboard/chart/data") . "?thanaID=". $value->thana->id . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!}'],
         @endforeach
         @endif
        
       
      ]);

        // Set chart options
           // মোট কেস 
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
                    location.href = link;
                }
        });
        chart.draw(data, options);
      }

      @else

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Circle', 'Case', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         @if (!is_null(session("thanawise")))
         @foreach(session("thanawise") as $key => $value)
   
         
         ['{{$value->thana->bn_name}}', {{$value->countcase}}, 'color: #756bb1', '{{ $value->countcase}}', '{!!url("/admin/case/dashboard/chart/data") . "?thanaID=". $value->thana->id . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!}'],
         @endforeach
        @endif
       
      ]);

        // Set chart options
           // মোট কেস 
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
                    location.href = link;
                }
        });
        chart.draw(data, options);
      }


      @endif


      google.charts.setOnLoadCallback(drawChart2);

      @php 
      function intconber($value) {
        $mm = (int) $value;
        return $mm;
      }

      function lastthreemon($monthyear, string $type)
    {
        $carbon = \Illuminate\Support\Carbon::parse($monthyear);

        if ($type == 'start') {
            return $carbon->startOfMonth()->format('Y/m/d');
        } elseif ($type == 'end') {
            return $carbon->endOfMonth()->format('Y/m/d');
        }
    }

      @endphp

      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Cases', { role: "style" }, { role: 'link' }],
          @if (!is_null(session("lastthreemonthcase")))
          @foreach(session("lastthreemonthcase") as $key => $value)
          ['{{$value->month}}',  {{intconber($value->totalcase)}}, '#663399', '{!! url("/admin/case/dashboard/chart/data") . "?form=". lastthreemon($value->monthyear, "start") . "&to=". lastthreemon($value->monthyear, "end") !!}'],
          @endforeach
          @endif
          
        ]);
        
   // শেষ ৩ মাসের কেস
        var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("chart_div2"));
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


      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {

        var data = google.visualization.arrayToDataTable([
          ['Case type', 'count', 'number', { role: 'link' }],
          @if (!is_null(session("caseendingtypes")))
          @foreach(session("caseendingtypes") as $key => $value)
          ['{{$value->nispotti_type}}', {{intconber($value->countnispotti_type)}}, '{{$value->countnispotti_type}}', '{!! url("/admin/case/dashboard/chart/data") . "?nispotti_type=". $value->nispotti_type . "&form2=" . session("agomonthday") . "&to2=" . session("currentday")!!}'],
          @endforeach
          @endif
        ]);


   // নিস্পত্তির ধরন
   
   
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
                    let link =data.getValue(row, 3);
                    location.href = link;
                }
        });
        chart.draw(data, options);
      }


      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart4);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart4() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Case type', 'Case', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],

         @if (!is_null(session("casetypec")))
         
         @foreach(session("casetypec") as $key => $value)

         
         ['{{$value->casetype->type}}', {{$value->countcase_type}}, 'color: #756bb1', '{{$value->countcase_type}}', '{!! url("/admin/case/dashboard/chart/data") . "?caseTypeID=". $value->casetype->id . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!}'],
         @endforeach

         @endif
        
       
      ]);

        // Set chart options
            // মোট কেস 
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
        
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart4_div'));
        google.visualization.events.addListener(chart, 'select', function (e) {
            var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link =data.getValue(row, 4);
                    location.href = link;
                }
        });
        chart.draw(data, options);
      }



      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart5);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart5() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Case type', 'Case', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],

         @if (!is_null(session("casesubtypec")))
         
         @foreach(session("casesubtypec") as $key => $value)

         
         ['{{$value->casesubtype->type}}', {{$value->countcasesub_type}}, 'color: #756bb1', '{{$value->countcasesub_type}}', '{!! url("/admin/case/dashboard/chart/data") . "?casesubID=". $value->casesubtype->id . "&caseTypeID=". $value->case_type . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!}'],
         @endforeach

         @endif
        
       
      ]);

        // Set chart options
            // মোট কেস 
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
        
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart5_div'));
        google.visualization.events.addListener(chart, 'select', function (e) {
            var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link =data.getValue(row, 4);
                    location.href = link;
                }
        });
        chart.draw(data, options);
      }

</script>

@endif