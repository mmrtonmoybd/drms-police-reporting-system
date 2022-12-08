@if ( request()->is('admin/case/dashboard'))

<script type="text/javascript">
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
         ['District', 'Case', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],

         @if (!is_null(session("diswisecase")))
         
         @foreach(session("diswisecase") as $key => $value)

         
         ['{{$value->district->bn_name}}', {{$value->countcase}}, 'color: #9b0001', '{{$value->countcase}}', '#'],
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

         
         ['{{$value->circle->name}}', {{$value->countcase}}, 'color: #9b0001', '{{$value->countcase}}', '#'],
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
   
         
         ['{{$value->thana->bn_name}}', {{$value->countcase}}, 'color: #9b0001', '{{$value->countcase}}', '#'],
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


      google.charts.setOnLoadCallback(drawChart2);

      @php 
      function intconber($value) {
        $mm = (int) $value;
        return $mm;
      }
      @endphp

      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Cases', { role: 'link' }],
          @if (!is_null(session("lastthreemonthcase")))
          @foreach(session("lastthreemonthcase") as $key => $value)
          ['{{$value->month}}',  {{intconber($value->totalcase)}}, '#'],
          @endforeach
          @endif
          
        ]);

        var options = {
          title: 'Last three month cases',
          hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div2'));
        google.visualization.events.addListener(chart, 'select', function (e) {
            var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link =data.getValue(row, 2);
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
          ['{{$value->nispotti_type}}', {{intconber($value->countnispotti_type)}}, '{{$value->countnispotti_type}}', '#'],
          @endforeach
          @endif
        ]);

        var options = {
          title: 'Nispotti type',
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
</script>

@endif