@if (str_contains(url()->current(), '/admin/narcotic/dashboard'))
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
         ['District', 'Case', { role: 'style' }, {role: 'annotation', type: 'string'}],
         
         @foreach(session("numofcase") as $key => $value)

         ['{{$value->district->bn_name}}', {{$value->totalcase}}, 'color: #9b0001', '{{$value->totalcase}}' ],

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
        chart.draw(data, options);
      }


      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart2);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart2() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Authority', 'Total', { role: 'style' }, {role: 'annotation', type: 'string'}],
         
         @foreach(session("conduautho") as $key => $value)

         ['{{$value->name_of_investigator_org}}', {{$value->totalinvisauth}}, 'color: #9b0001', '{{$value->totalinvisauth}}' ],

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
        var chart = new google.visualization.BarChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }


      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {

        var data = google.visualization.arrayToDataTable([
          ['Arrest by unit', 'count'],
          @foreach(session("arrastbyu") as $key => $value)
          ['{{$value->district->bn_name}}', {{$value->totalarrast}}],
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

      @endif


      @if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Thana', 'Case', { role: 'style' }, {role: 'annotation', type: 'string'}],
         
         @foreach(session("numofcase") as $key => $value)

         ['{{$value->thana->bn_name}}', {{$value->totalcase}}, 'color: #9b0001', '{{$value->totalcase}}' ],

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
        chart.draw(data, options);
      }


      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart2);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart2() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Authority', 'Total', { role: 'style' }, {role: 'annotation', type: 'string'}],
         
         @foreach(session("conduautho") as $key => $value)

         ['{{$value->name_of_investigator_org}}', {{$value->totalinvisauth}}, 'color: #9b0001', '{{$value->totalinvisauth}}' ],

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
        var chart = new google.visualization.BarChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }


      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {

        var data = google.visualization.arrayToDataTable([
          ['Arrest by unit', 'count'],
          @foreach(session("arrastbyu") as $key => $value)
          ['{{$value->thana->bn_name}}', {{$value->totalarrast}}],
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

      @endif

      </script>

      @endif