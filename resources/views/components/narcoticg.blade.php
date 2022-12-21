@if ( request()->is('admin/narcotic/dashboard') || request()->is('admin/narcotic/src'))
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      @if (auth()->user()->hasRole('Super Admin'))

@php 
$allin = request()->all();
if (request()->filled('districtID')) {
$removarr = \Illuminate\Support\Arr::except($allin, ['districtID', 'thanaID']);
} else {
$removarr = \Illuminate\Support\Arr::except($allin, 'districtID');

}
$string1 = url('/admin/narcotic/chart/data') .'?'. http_build_query($removarr);
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
         ['District', 'Case', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         
         @foreach(session("numofcase") as $key => $value)

         @if (request()->filled('districtID'))

         ['{{$value->thana->bn_name}}', {{$value->totalcase}}, 'color: #9b0001', '{{$value->totalcase}}', '@if (request()->is("admin/narcotic/dashboard")) {!!$string1 . "&districtID=".$value->district->id."&thanaID=".$value->thana->id!!} @else {!!$string1 . "&districtID=".$value->district->id."&thanaID=".$value->thana->id!!} @endif'],

         @else 
         ['{{$value->district->bn_name}}', {{$value->totalcase}}, 'color: #9b0001', '{{$value->totalcase}}', '@if (request()->is("admin/narcotic/dashboard")) {!!$string1 . "&districtID=".$value->district->id . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=".$value->district->id!!} @endif'],
         @endif
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
                    location.href = link;
                }
        });
        chart.draw(data, options);
      }


      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart2);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.

      @php 
$allin = request()->all();
$removarr = \Illuminate\Support\Arr::except($allin, 'name_of_investigator_org');
$string2 = url('/admin/narcotic/chart/data') .'?'. http_build_query($removarr);
//dd($string);
@endphp

      function drawChart2() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Authority', 'Total', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         
         @foreach(session("conduautho") as $key => $value)

         ['{{$value->name_of_investigator_org}}', {{$value->totalinvisauth}}, 'color: #9b0001', '{{$value->totalinvisauth}}', '@if (request()->is("admin/narcotic/dashboard")) {!!$string1 . "&name_of_investigator_org=".$value->name_of_investigator_org . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&name_of_investigator_org=".$value->name_of_investigator_org!!} @endif'],

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
          ['Arrest by unit', 'count', { role: 'link' }],
          @foreach(session("arrastbyu") as $key => $value)
          @if (request()->filled('districtID'))
          ['{{$value->thana->bn_name}}', {{$value->totalarrast}}, '@if (request()->is("admin/narcotic/dashboard")) {!!$string1 . "&districtID=".$value->district->id."&thanaID=".$value->thana->id!!} @else {!!$string1 . "&districtID=".$value->district->id."&thanaID=".$value->thana->id!!} @endif'],
          @else
          ['{{$value->district->bn_name}}', {{$value->totalarrast}}, '@if (request()->is("admin/narcotic/dashboard")) {!!$string1 . "&districtID=".$value->district->id . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&districtID=".$value->district->id!!} @endif'],
          @endif
          @endforeach
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
                    location.href = link;
                }
        });
        chart.draw(data, options);
      }

      @endif


      @if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2']) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])))

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.

      @php 
$allin = request()->all();
$removarr = \Illuminate\Support\Arr::except($allin, 'thanaID');
$string1 = url('/admin/narcotic/chart/data') .'?'. http_build_query($removarr);
//dd($string);
@endphp
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Thana', 'Case', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         
         @foreach(session("numofcase") as $key => $value)

         ['{{$value->thana->bn_name}}', {{$value->totalcase}}, 'color: #9b0001', '{{$value->totalcase}}', '@if (request()->is("admin/narcotic/dashboard")) {!!$string1 . "&thanaID=".$value->thana->id . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&thanaID=".$value->thana->id!!} @endif'],

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
                    location.href = link;
                }
        });
        chart.draw(data, options);
      }


      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart2);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      @php 
$allin = request()->all();
$removarr = \Illuminate\Support\Arr::except($allin, 'name_of_investigator_org');
$string2 = url('/admin/narcotic/chart/data') .'?'. http_build_query($removarr);
//dd($string);
@endphp
      function drawChart2() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Authority', 'Total', { role: 'style' }, {role: 'annotation', type: 'string'}, { role: 'link' }],
         
         @foreach(session("conduautho") as $key => $value)

         ['{{$value->name_of_investigator_org}}', {{$value->totalinvisauth}}, 'color: #9b0001', '{{$value->totalinvisauth}}', '@if (request()->is("admin/narcotic/dashboard")) {!!$string1 . "&name_of_investigator_org=".$value->name_of_investigator_org . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&name_of_investigator_org=".$value->name_of_investigator_org!!} @endif'],

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
          ['Arrest by unit', 'count', { role: 'link' }],
          @foreach(session("arrastbyu") as $key => $value)
          ['{{$value->thana->bn_name}}', {{$value->totalarrast}}, '@if (request()->is("admin/narcotic/dashboard")) {!!$string1 . "&thanaID=".$value->thana->id . "&form=" . session("agomonthday") . "&to=" . session("currentday")!!} @else {!!$string1 . "&thanaID=".$value->thana->id!!} @endif'],
          @endforeach
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
                    location.href = link;
                }
        });
        chart.draw(data, options);
      }

      @endif

      </script>

      @endif