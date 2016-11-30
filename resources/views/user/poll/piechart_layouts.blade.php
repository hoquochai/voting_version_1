<div class="col-lg-12">
    <!-- pie chart -->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            var optionRateBarChart = {!! $optionRateBarChart !!};
            data.addRows(optionRateBarChart);
            var options = {'width': 700, 'height': 400};
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
    <div id="chart_div"></div>
</div>
