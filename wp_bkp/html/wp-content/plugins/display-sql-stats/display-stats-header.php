<!-- inserted by Wordpress plugin Display SQL Stats start-->
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

  // Load the Visualization API and the piechart package.
  google.load('visualization', '1.0', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  google.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart() {

	
<?php
	//get data as matrix
	include('display-stats-getdata.php');
	
	// set chart options
	include('display-stats-setchart.php');
	
?>	


  }
</script>
<!-- inserted by Wordpress plugin Display SQL Stats end-->