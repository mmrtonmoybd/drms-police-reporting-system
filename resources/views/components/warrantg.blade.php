@if (str_contains(url()->current(), '/warrant/dashboard') || str_contains(url()->current(), '/warrant/search'))
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
         ['District', 'Recive', { role: 'style' }, {role: 'annotation', type: 'string'}],
         ['বরগুনা', {{session('borgona')}}, '#b87333', '{{session('borgona')}}'],            // RGB value
         ['বরিশাল', {{session('barisal')}}, 'silver', '{{session('barisal')}}'],            // English color name
         ['ভোলা', {{session('bhola')}}, 'gold', '{{session('bhola')}}'],
         ['ঝালকাঠি', {{session('jalokhati')}}, 'color: #e5e4e2', '{{session('jalokhati')}}'], // CSS-style declaration
         ['পটুয়াখালী', {{session('patuakhali')}}, 'color: #b87333', '{{session('patuakhali')}}'],
         ['পিরোজপুর', {{session('pirojpur')}}, 'color: Romance', '{{session('pirojpur')}}'],
      ]);

        // Set chart options
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['নিষ্পত্তি by District wise', 'count', {role: 'annotation', type: 'string'}],
          ['বরগুনা', {{session('borgonan')}}, {{session('borgonan')}}],            // RGB value
          ['বরিশাল', {{session('barisaln')}}, {{session('barisaln')}}],            // English color name
          ['ভোলা', {{session('bholan')}}, {{session('bholan')}}],
          ['ঝালকাঠি', {{session('jalokhatin')}}, {{session('jalokhatin')}}], // CSS-style declaration
          ['পটুয়াখালী', {{session('patuakhalin')}}, {{session('patuakhalin')}}],
          ['পিরোজপুর', {{session('pirojpurn')}}, {{session('pirojpurn')}}]
        ]);

        var options = {
          title: '',
          width: "98%",
          height: 172,
          is3D: true,
          pieSliceText: 'value',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

       // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart3);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart3() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['District', 'পেন্ডিং', { role: 'style' }, {role: 'annotation', type: 'string'}],
         ['বরগুনা', {{session('borgonap')}}, '#b87333', '{{session('borgonap')}}'],            // RGB value
         ['বরিশাল', {{session('barisalp')}}, 'silver', '{{session('barisalp')}}'],            // English color name
         ['ভোলা', {{session('bholap')}}, 'gold', '{{session('bholap')}}'],
         ['ঝালকাঠি', {{session('jalokhatip')}}, 'color: #e5e4e2', '{{session('jalokhatip')}}'], // CSS-style declaration
         ['পটুয়াখালী', {{session('patuakhalip')}}, 'color: #b87333', '{{session('patuakhalip')}}'],
         ['পিরোজপুর', {{session('pirojpurp')}}, 'color: Romance', '{{session('pirojpurp')}}'],
      ]);

        // Set chart options
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
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
         ['Thana', 'Recive', { role: 'style' }, {role: 'annotation', type: 'string'}],
         @foreach(session("spthana") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}, 'color: #9b0001', '{{$value[0]}}'],

         @endforeach
      ]);

        // Set chart options
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['নিষ্পত্তি by Thana wise', 'count', {role: 'annotation', type: 'string'}],
          @foreach(session("spthanan") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}, {{$value[0]}}],

         @endforeach
        ]);

        var options = {
          title: '',
          width: "98%",
          height: 172,
          is3D: true,
          pieSliceText: 'value',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

       // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart3);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart3() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Thana', 'পেন্ডিং', { role: 'style' }, {role: 'annotation', type: 'string'}],
         @foreach(session("spthanap") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}, 'color: #9b0001', '{{$value[0]}}'],

         @endforeach
      ]);

        // Set chart options
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
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
         ['Thana', 'Recive', { role: 'style' }, {role: 'annotation', type: 'string'}],
         ['{{session("octhana")[1]}}', {{session('octhana')[0]}}, '#b87333', '{{session('octhana')[0]}}']
      ]);

        // Set chart options
        var options = {
        title: "",
        width: "98%",
        height: 300,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['নিষ্পত্তি by Thana wise', 'count', {role: 'annotation', type: 'string'}],
         ['{{session("octhanan")[1]}}', {{session('octhanan')[0]}}, '{{session('octhanan')[0]}}']
        ]);

        var options = {
          title: '',
          is3D: true,
          pieSliceText: 'value',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

       // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart3);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart3() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Thana', 'পেন্ডিং', { role: 'style' }, {role: 'annotation', type: 'string'}],
         ['{{session("octhanap")[1]}}', {{session('octhanap')[0]}}, '#b87333', '{{session('octhanap')[0]}}']
      ]);

        // Set chart options
        var options = {
        title: "",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
      }

      @endif

      

     
    </script>
      @endif