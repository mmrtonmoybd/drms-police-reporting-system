@if ( request()->is('admin/warrant/dashboard') || request()->is('admin/warrant/search'))
<script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      @if (auth()->user()->hasRole('Super Admin') && empty(request()->input('districtID')))

@php 
$allin = request()->all();
$removarr = \Illuminate\Support\Arr::except($allin, 'districtID');
$string1 = url('/admin/warrant/search/chart') .'?'. http_build_query($removarr);
//dd($string);
@endphp

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['District', 'Recive', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         ['বরগুনা', {{session('borgona')}}, '#b87333', '{{session('borgona')}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=34&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=34"!!} @endif'],            // RGB value
         ['বরিশাল', {{session('barisal')}}, 'silver', '{{session('barisal')}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=35&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=35"!!} @endif'],            // English color name
         ['ভোলা', {{session('bhola')}}, 'gold', '{{session('bhola')}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=36&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=36"!!} @endif'],
         ['ঝালকাঠি', {{session('jalokhati')}}, 'color: #e5e4e2', '{{session('jalokhati')}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=37&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=37"!!} @endif'], // CSS-style declaration
         ['পটুয়াখালী', {{session('patuakhali')}}, 'color: #b87333', '{{session('patuakhali')}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=38&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=38"!!} @endif'],
         ['পিরোজপুর', {{session('pirojpur')}}, 'color: Romance', '{{session('pirojpur')}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=39&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=39"!!} @endif'],
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

      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['নিষ্পত্তি by District wise', 'count', {role: 'annotation', type: 'string'}, { role: 'link' }],
          ['বরগুনা', {{session('borgonan')}}, {{session('borgonan')}}, '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=34&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=34"!!} @endif'],            // RGB value
          ['বরিশাল', {{session('barisaln')}}, {{session('barisaln')}}, '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=35&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=35"!!} @endif'],            // English color name
          ['ভোলা', {{session('bholan')}}, {{session('bholan')}}, '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=36&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=36"!!} @endif'],
          ['ঝালকাঠি', {{session('jalokhatin')}}, {{session('jalokhatin')}}, '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=37&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=37"!!} @endif'], // CSS-style declaration
          ['পটুয়াখালী', {{session('patuakhalin')}}, {{session('patuakhalin')}}, '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=38&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=38"!!} @endif'],
          ['পিরোজপুর', {{session('pirojpurn')}}, {{session('pirojpurn')}}, '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=39&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=39"!!} @endif']
        ]);

        var options = {
          title: '',
          width: "98%",
          height: 172,
          is3D: true,
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
         ['District', 'পেন্ডিং', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         ['বরগুনা', {{session('borgonap')}}, '#b87333', '{{session('borgonap')}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=34&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=34"!!} @endif'],            // RGB value
         ['বরিশাল', {{session('barisalp')}}, 'silver', '{{session('barisalp')}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=35&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=35"!!} @endif'],            // English color name
         ['ভোলা', {{session('bholap')}}, 'gold', '{{session('bholap')}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=36&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=36"!!} @endif'],
         ['ঝালকাঠি', {{session('jalokhatip')}}, 'color: #e5e4e2', '{{session('jalokhatip')}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=37&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=37"!!} @endif'], // CSS-style declaration
         ['পটুয়াখালী', {{session('patuakhalip')}}, 'color: #b87333', '{{session('patuakhalip')}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=38&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=38"!!} @endif'],
         ['পিরোজপুর', {{session('pirojpurp')}}, 'color: Romance', '{{session('pirojpurp')}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&districtID=39&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=39"!!} @endif'],
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
      
      @elseif (auth()->user()->hasRole('Super Admin') && !empty(request()->input('districtID')))

      @php 
      $allin = request()->all();
      $removarr = \Illuminate\Support\Arr::except($allin, 'thanaID');
      $string1 = url('/admin/warrant/search/chart') .'?'. http_build_query($removarr);
      @endphp

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Thana', 'Recive', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         @foreach(session("spthana") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}, 'color: #9b0001', '{{$value[0]}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&thanaID=".$value[2] . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&thanaID=".$value[2]!!} @endif'],

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

      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['নিষ্পত্তি by Thana wise', 'count', {role: 'annotation', type: 'string'}, { role: 'link' }],
          @foreach(session("spthanan") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}, {{$value[0]}}, '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&thanaID=".$value[2] . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&thanaID=".$value[2]!!} @endif'],

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
         ['Thana', 'পেন্ডিং', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         @foreach(session("spthanap") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}, 'color: #9b0001', '{{$value[0]}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&thanaID=".$value[2] . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&thanaID=".$value[2]!!} @endif'],

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



      @if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']))

      @php 
      $allin = request()->all();
      $removarr = \Illuminate\Support\Arr::except($allin, 'thanaID');
      $string1 = url('/admin/warrant/search/chart') .'?'. http_build_query($removarr);
      @endphp

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Thana', 'Recive', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         @foreach(session("spthana") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}, 'color: #9b0001', '{{$value[0]}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&thanaID=".$value[2] . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&thanaID=".$value[2]!!} @endif'],

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

      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['নিষ্পত্তি by Thana wise', 'count', {role: 'annotation', type: 'string'}, { role: 'link' }],
          @foreach(session("spthanan") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}, {{$value[0]}}, '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&thanaID=".$value[2] . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&thanaID=".$value[2]!!} @endif'],

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
         ['Thana', 'পেন্ডিং', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         @foreach(session("spthanap") as $key => $value)

         ['{{$value[1]}}', {{$value[0]}}, 'color: #9b0001', '{{$value[0]}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&thanaID=".$value[2] . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&thanaID=".$value[2]!!} @endif'],

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


      @if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))

       @php 
      $allin = request()->all();
      $removarr = \Illuminate\Support\Arr::except($allin, 'thanaID');
      $string1 = url('/admin/warrant/search/chart') .'?'. http_build_query($removarr);
      @endphp

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Thana', 'Recive', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         ['{{session("octhana")[1]}}', {{session('octhana')[0]}}, '#b87333', '{{session('octhana')[0]}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&thanaID=".session("octhana")[2] . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&thanaID=".session("octhana")[2]!!} @endif']
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

      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['নিষ্পত্তি by Thana wise', 'count', {role: 'annotation', type: 'string'}, { role: 'link' }],
         ['{{session("octhanan")[1]}}', {{session('octhanan')[0]}}, '{{session('octhanan')[0]}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&thanaID=".session("octhana")[2] . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&thanaID=".session("octhana")[2]!!} @endif']
        ]);

        var options = {
          title: '',
          is3D: true,
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
         ['Thana', 'পেন্ডিং', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         ['{{session("octhanap")[1]}}', {{session('octhanap')[0]}}, '#b87333', '{{session('octhanap')[0]}}', '@if (request()->is("admin/warrant/dashboard")) {!!$string1 . "&thanaID=".session("octhana")[2] . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&thanaID=".session("octhana")[2]!!} @endif']
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

      

     
    </script>
      @endif