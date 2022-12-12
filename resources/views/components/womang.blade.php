@if ( request()->is('admin/woman/dashboard') || request()->is('admin/woman/src'))
    <script type="text/javascript">
@php 
$allin = request()->all();
$removarr = \Illuminate\Support\Arr::except($allin, 'districtID');
$string1 = url('/admin/woman/chart/data') .'?'. http_build_query($removarr);

$removarr2 = \Illuminate\Support\Arr::except($allin, 'action_taken');
$string2 = url('/admin/woman/chart/data') .'?'. http_build_query($removarr2);
$string3 = url('/admin/woman/chart/data') .'?'. http_build_query($allin);
//dd($string);
@endphp
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      @if (auth()->user()->hasRole('Super Admin'))

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['District', 'Complain', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         
         @foreach(session("totalcomplains") as $key => $value)

         @if (request()->filled('districtID'))
         ['{{$value->thana->bn_name}}', {{$value->totalcomplain}}, 'color: #9b0001', '{{$value->totalcomplain}}', '@if (request()->is("admin/woman/dashboard")) {!!$string1 . "&thanaID=".$value->thana->id!!} @else {!!$string1 . "&thanaID=".$value->thana->id . "&districtID=".$value->district->id!!} @endif'],
         @else
         ['{{$value->district->bn_name}}', {{$value->totalcomplain}}, 'color: #9b0001', '{{$value->totalcomplain}}', '@if (request()->is("admin/woman/dashboard")) {!!$string1 . "&districtID=".$value->district->id!!} @else {!!$string1 . "&districtID=".$value->district->id!!} @endif'],
         @endif
         @endforeach
        
       
      ]);

        // Set chart options
           // title: "Number of complain",
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


      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {

        var data = google.visualization.arrayToDataTable([
          ['Action taken', 'count', 'number', { role: 'link' }],
          @foreach(session("actiontakens") as $key => $value)
          ['{{$value->action_taken}}', {{$value->totalactiontaken}}, '{{$value->totalcomplain}}', '@if (request()->is("admin/woman/dashboard")) {!!$string2 . "&action_taken=".$value->action_taken!!} @else {!!$string2 . "&action_taken=".$value->action_taken!!} @endif'],
          @endforeach
        ]);

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

      google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
      var data = google.visualization.arrayToDataTable([
        ["Report", "count", { role: "style" } , { role: 'link' }],
         @foreach(session("disposalrepors") as $key => $value)
          ['{{$value->nreport}}', {{$value->disposalrepor}}, "gold", '@if (request()->is("admin/woman/dashboard")) {!!$string3 . "&nreport=".$value->nreport!!} @else {!!$string3 . "&nreport=".$value->nreport!!} @endif'],
          @endforeach
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);


//Disposal Report
      var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
       google.visualization.events.addListener(chart, 'select', function (e) {
            var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link =data.getValue(row, 3);
                    location.href = link;
                }
        });
      chart.draw(view, options);
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
$string1 = url('/admin/woman/chart/data') .'?'. http_build_query($removarr);
      @endphp
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Thana', 'Complain', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         
         @foreach(session("totalcomplains") as $key => $value)

         ['{{$value->thana->bn_name}}', {{$value->totalcomplain}}, 'color: #9b0001', '{{$value->totalcomplain}}' , '@if (request()->is("admin/woman/dashboard")) {!!$string1 . "&thanaID=".$value->thana->id!!} @else {!!$string1 . "&thanaID=".$value->thana->id!!} @endif'],

         @endforeach
        
       
      ]);

        // Set chart options
        //Number OF complain
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


      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {

        var data = google.visualization.arrayToDataTable([
          ['Action taken', 'count', 'number', { role: 'link' }],
          @foreach(session("actiontakens") as $key => $value)
          ['{{$value->action_taken}}', {{$value->totalactiontaken}}, '{{$value->totalcomplain}}', '@if (request()->is("admin/woman/dashboard")) {!!$string2 . "&action_taken=".$value->action_taken!!} @else {!!$string2 . "&action_taken=".$value->action_taken!!} @endif'],
          @endforeach
        ]);

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

      google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
      var data = google.visualization.arrayToDataTable([
        ["Report", "count", { role: "style" } , { role: 'link' }],
         @foreach(session("disposalrepors") as $key => $value)
          ['{{$value->nreport}}', {{$value->disposalrepor}}, "gold", '@if (request()->is("admin/woman/dashboard")) {!!$string3 . "&nreport=".$value->nreport!!} @else {!!$string3 . "&nreport=".$value->nreport!!} @endif'],
          @endforeach
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);
        // title: "Disposal report",
      var options = {
        title: "",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      google.visualization.events.addListener(chart, 'select', function (e) {
            var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link =data.getValue(row, 3);
                    location.href = link;
                }
        });
      chart.draw(view, options);
  }

      @endif

      @if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Thana', 'Complain', { role: 'style' }, {role: 'annotation', type: 'string'}],
         
         @foreach(session("totalcomplains") as $key => $value)

         ['{{$value->thana->bn_name}}', {{$value->totalcomplain}}, 'color: #9b0001', '{{$value->totalcomplain}}' ],

         @endforeach
        
       
      ]);

        // Set chart options
         //   title: "Number of complain",
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
        
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }


      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {

        var data = google.visualization.arrayToDataTable([
          ['Action taken', 'count'],
          @foreach(session("actiontakens") as $key => $value)
          ['{{$value->action_taken}}', {{$value->totalactiontaken}}],
          @endforeach
        ]);

        var options = {
          title: '',
          is3D: true,
        width: "98%",
        height: "172",
        pieSliceText: 'value',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

      google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
      var data = google.visualization.arrayToDataTable([
        ["Report", "count", { role: "style" } ],
         @foreach(session("disposalrepors") as $key => $value)
          ['{{$value->nreport}}', {{$value->disposalrepor}}, "gold"],
          @endforeach
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);
 // title: "Disposal report",
      var options = {
        title: "",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }

      @endif

      </script>

      @endif