<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<div class="middle-body"> 
 
Account Name: <?php echo $address['AccountName']; ?><br />
Account Number: <?php echo $address['ldcAcct']; ?><br />
Address: <?php echo $address['add1']; ?><br />
<?php echo $address['csz']; ?><br /> 
 
<?php echo $table_results; ?>

<br />


<br />
<br />
	

</div>

<div id="chart_div" class="middle-body"></div>

<script type="text/javascript">
		$('.flex').flexigrid();
</script>

<script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Read Date');
        data.addColumn('number', 'kWh');
        data.addRows(<?php echo $chartrecs; ?>);

        // Set chart options
        var options = {'title':'Last 12 months Consumption',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>