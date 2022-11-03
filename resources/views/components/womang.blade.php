@if (str_contains(url()->current(), '/admin/woman/dashboard') || str_contains(url()->current(), '/admin/woman/src'))
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
         ['District', 'Complain', { role: 'style' }, {role: 'annotation', type: 'string'}],
         
         @foreach(session("totalcomplains") as $key => $value)

         ['{{$value->district->bn_name}}', {{$value->totalcomplain}}, 'color: #9b0001', '{{$value->totalcomplain}}' ],

         @endforeach
        
       
      ]);

        // Set chart options
        var options = {
        title: "Number of complain",
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

      var options = {
        title: "Disposal report",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }

      @endif

      @if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))

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
        var options = {
        title: "Number of complain",
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

      var options = {
        title: "Disposal report",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
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
        var options = {
        title: "Number of complain",
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

      var options = {
        title: "Disposal report",
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