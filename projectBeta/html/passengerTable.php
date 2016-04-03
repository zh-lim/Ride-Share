<?php
	include("header.php");
	
?>
<title>Ride Offer History</title>
<body>
<div id="layout">
<?php 
	$active2 = "id='active'";
	$pageTitle = "Ride History";
	include("banner.php");
	include("navigationAdmin.php");
?>
  <div id="container" class="box">

	<div>
<?php
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delRide"])){
		$query = "DELETE FROM ride WHERE starttime = '".$_POST["startTime".$_POST["delRide"]]."' AND date = '".$_POST["date".$_POST["delRide"]]."' AND driver = '".$_POST["driver".$_POST["delRide"]]."';";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());	
	}
    $query = "SELECT starttime, date, availseats, cost, saddr, snhood, spostal, daddr, dnhood, dpostal, status, driver FROM ride ORDER BY date, starttime, status;";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
?>
	<table border="1" >
	<col width="5%">
	<col width="7%">
	<col width="9%">
	<col width="5%">
	<col width="7%">
	<col width="14%">
	<col width="8%">
	<col width="8%">
	<col width="14%">
	<col width="8%">
	<col width="8%">
	<col width="7%">
	<tr>
	<th>Options</th>
	<th>Driver</th>
	<th>Starting Time</th>
	<th>Date</th>
	<th>Seats</th>
	<th>Cost</th>
	<th>Departure</th>
	<th></th>
	<th></th>
	<th>Destination</th>
	<th></th>
	<th></th>
	<th>Status</th>
	</tr>
	<tr>
<script>
	function pg_refresh(){
		$("form[name='form_chooseRide']").attr("action","passengerTable.php");	
	}
</script>
<?php
	$count = 0;
    while ($row = pg_fetch_row($result)){
      echo "<td><form name = 'form_chooseRide' action='rideEdit.php' method='post'><button name = 'chooseRide' value='".$count."'/>Edit</button>
	<button name = 'delRide' value='".$count."' onclick = 'pg_refresh();'/>Delete</button></td>";
	echo "<td><input type = 'hidden' name = 'driver" . $count . "' value = '" . $row[11] . "'/>" . $row[11] . "</td>";
      echo "<td><input type = 'hidden' name = 'startTime" . $count . "' value = '" . $row[0] . "'/>" . $row[0] . "</td>";
      echo "<td><input type = 'hidden' name = 'date" . $count . "' value = '" . $row[1] . "'/>" . $row[1] . "</td>";
      echo "<td><input type = 'hidden' name = 'availSeats" . $count . "' value = '" . $row[2] . "'/>" . $row[2] . "</td>";
      echo "<td><input type = 'hidden' name = 'cost" . $count . "' value = '" . $row[3] . "'/>" . $row[3] . "</td>";
      echo "<td><input type = 'hidden' name = 'saddr" . $count . "' value = '" . $row[4] . "'/>" . $row[4] . "</td>";
      echo "<td><input type = 'hidden' name = 'snhood" . $count . "' value = '" . $row[5] . "'/>" . $row[5] . "</td>";
      echo "<td><input type = 'hidden' name = 'spostal" . $count . "' value = '" . $row[6] . "'/>" . $row[6] . "</td>";
      echo "<td><input type = 'hidden' name = 'daddr" . $count . "' value = '" . $row[7] . "'/>" . $row[7] . "</td>";
      echo "<td><input type = 'hidden' name = 'dnhood" . $count . "' value = '" . $row[8] . "'/>" . $row[8] . "</td>";
      echo "<td><input type = 'hidden' name = 'dpostal" . $count . "' value = '" . $row[9] . "'/>" . $row[9] . "</td>";
      echo "<td><input type = 'hidden' name = 'status" . $count . "' value = '" . $row[10] . "'/>";
	$rideStatus = $row[10];
	if ($rideStatus == 'E') echo "Expired</td>";
	else if ($rideStatus == 'P') echo "Pending</td>";
	else if ($rideStatus == 'C') echo "Confirmed</td>";
	else echo "Finished</td>";
      echo "</form></tr>";
    }
    echo "</table>";
?>
</div>

    <div id="panel-right" class="box panel">
		<div id="bottom">
			<?php include("sidebar.php")?>
		</div>
    </div>
  </div>
</div>
<div id="footer">
  <div id="foot">
    <div id="page-bottom"> <a href="#header">Go up</a> </div>
  </div>
</div>
</html>