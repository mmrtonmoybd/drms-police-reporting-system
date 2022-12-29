@if ( request()->is('admin/case/dashboard/search'))

@php
function removeArr(...$arg)
    {
        $arr = request()->all();
        $hh = \Illuminate\Support\Arr::except($arr, $arg);
        $string1 = url('/admin/case/dashboard/chart/data') .'?'. http_build_query($hh);
        return $string1;
    }
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
         ['District', 'Case', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],

         @if (empty(request()->input('districtID')) && empty(request()->input('thanaID')) && empty(request()->input('circleID')))
         
         @if (!is_null(session("diswisecase")))
         @foreach(session("diswisecase") as $key => $value)

         
         ['{{$value->district->bn_name}}', {{$value->countcase}}, 'color: #756bb1', '{{$value->countcase}}', '{!! removeArr("districtID") !!}&districtID={{$value->district->id}}'],
         @endforeach
         @endif

         @elseif(!empty(request()->input('districtID')) && (empty(request()->input('thanaID')) && empty(request()->input('circleID'))))
        @if (!is_null(session("circlewisecase")))
         @foreach(session("circlewisecase") as $key => $value)

         
         ['{{$value->circle->name}}', {{$value->countcase}}, 'color: #756bb1', '{{$value->countcase}}', '{!! removeArr("thanaID", "circleID") !!}&circleID={{$value->circle->id}}'],
         @endforeach
         @endif

         @elseif((!empty(request()->input('districtID')) && !empty(request()->input('circleID'))) && empty(request()->input('thanaID')))
          @if (!is_null(session("circlewisethanacase")))
        @foreach(session("circlewisethanacase") as $key => $value)

         
         ['{{$value->thana->bn_name}}', {{$value->countcase}}, 'color: #756bb1', '{{$value->countcase}}', '{!! removeArr("thanaID") !!}&thanaID={{$value->thana->id}}'],
         @endforeach
         @endif

         @elseif(!empty(request()->input('districtID')) && !empty(request()->input('circleID')) && !empty(request()->input('thanaID')))
         @if (!is_null(session("searchthanacase")))
         @foreach(session("searchthanacase") as $key => $value)

         
         ['{{$value->thana->bn_name}}', {{$value->countcase}}, 'color: #756bb1', '{{$value->countcase}}', '{!! removeArr("thanaID") !!}&thanaID={{$value->thana->id}}'],
         @endforeach
         @endif

         @endif
       
      ]);

        // Set chart options
        var options = {
        title: "Number of case",
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

         @if (empty(request()->input('circleID')) && empty(request()->input('thanaID')))
         @if (!is_null(session("circlewisecase")))
         @foreach(session("circlewisecase") as $key => $value)

         
         ['{{$value->circle->name}}', {{$value->countcase}}, 'color: #756bb1', '{{$value->countcase}}', '{!! removeArr("circleID") !!}&circleID={{$value->circle->id}}'],
         @endforeach
         @endif

         @elseif(!empty(request()->input('circleID')) && empty(request()->input('thanaID')))
         @if(!is_null(session("circlethanawisecase")))
         @foreach(session("circlethanawisecase") as $key => $value)

         
         ['{{$value->thana->bn_name}}', {{$value->countcase}}, 'color: #756bb1', '{{$value->countcase}}', '{!! removeArr("thanaID") !!}&thanaID={{$value->thana->id}}'],
         @endforeach
         @endif

         @elseif(!empty(request()->input('circleID')) && !empty(request()->input('thanaID')))
         @if (!is_null(session("searchthanacase")))
         @foreach(session("searchthanacase") as $key => $value)

         
         ['{{$value->thana->bn_name}}', {{$value->countcase}}, 'color: #756bb1', '{{$value->countcase}}', '{!! removeArr("thanaID") !!}&thanaID={{$value->thana->id}}'],
         @endforeach
         @endif
         @endif
        
       
      ]);

        // Set chart options
        var options = {
        title: "Number of case",
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
         @if(!is_null(session("octhanacase")))
         @foreach(session("octhanacase") as $key => $value)

         
         ['{{$value->thana->bn_name}}', {{$value->countcase}}, 'color: #756bb1', '{{$value->countcase}}', '{!! removeArr("thanaID") !!}&thanaID={{$value->thana->id}}'],
         @endforeach
         @endif
        
       
      ]);

        // Set chart options
        var options = {
        title: "Number of case",
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


      @php 
      function intconber($value) {
        $mm = (int) $value;
        return $mm;
      }
      @endphp


      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {

        var data = google.visualization.arrayToDataTable([
          ['Case type', 'count', 'number', { role: 'link' }],
          @if (!is_null(session("caseendingtypes")))
          @foreach(session("caseendingtypes") as $key => $value)
          ['{{$value->nispotti_type}}', {{intconber($value->countnispotti_type)}}, '{{$value->countnispotti_type}}', '{!! removeArr("nispotti_type") !!}&nispotti_type={{$value->nispotti_type}}'],
          @endforeach
          @endif
        ]);


// নিস্পত্তি টাইপ
        var options = {
          title: '',
          is3D: true,
        width: "98%",
        height: "172",
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

         
         ['{{$value->casetype->type}}', {{$value->countcase_type}}, 'color: #756bb1', '{{$value->countcase_type}}', '{!! removeArr("caseTypeID", "casesubID") . "&caseTypeID=". $value->casetype->id !!}'],
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

         
         ['{{$value->casesubtype->type}}', {{$value->countcasesub_type}}, 'color: #756bb1', '{{$value->countcasesub_type}}', '{!! removeArr("caseTypeID", "casesubID") . "&casesubID=". $value->casesubtype->id . "&caseTypeID=". $value->case_type !!}'],
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