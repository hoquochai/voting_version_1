<div class="col-lg-12">
    <!-- bar chart -->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', '');
            var optionRateBarChart = {!! $optionRateBarChart !!};
            data.addRows(optionRateBarChart);
            var options = {'width': 700, 'height': 400, 'is3D': true};
            var chart = new google.visualization.BarChart(document.getElementById('chart'));
            chart.draw(data, options);
        }
    </script>
    <div id="chart"></div>
</div>
