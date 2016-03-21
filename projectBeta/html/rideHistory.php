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
	include("navigation.php");
?>
  <div id="container" class="box">

	<div>
<?php
    $query = "SELECT starttime, date, availseats, cost, saddr, snhood, spostal, daddr, dnhood, dpostal, status FROM ride WHERE driver='".$_SESSION["login_user"]."' ORDER BY date, starttime, status;";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
	echo "<form action='rideDetails.php' method='post'><table border=\"1\" >
	<col width=\"5%\">
	<col width=\"7%\">
	<col width=\"9%\">
	<col width=\"5%\">
	<col width=\"7%\">
	<col width=\"14%\">
	<col width=\"8%\">
	<col width=\"8%\">
	<col width=\"14%\">
	<col width=\"8%\">
	<col width=\"8%\">
	<col width=\"7%\">
	<tr>
	<th>Details</th>
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
	</tr>";


    while ($row = pg_fetch_row($result)){
      echo "<tr>";
      $concat = $row[0] . "|" . $row[1];
      echo "<td><button name = 'chooseRide' value='".$concat."'/>View</button></td>";
      echo "<td>" . $row[0] . "</td>";
      echo "<td>" . $row[1] . "</td>";
      echo "<td>" . $row[2] . "</td>";
      echo "<td>" . $row[3] . "</td>";
      echo "<td>" . $row[4] . "</td>";
      echo "<td>" . $row[5] . "</td>";
      echo "<td>" . $row[6] . "</td>";
      echo "<td>" . $row[7] . "</td>";
      echo "<td>" . $row[8] . "</td>";
      echo "<td>" . $row[9] . "</td>";
      echo "<td>";
	$rideStatus = $row[10];
	if ($rideStatus == 'E') echo "Expired</td>";
	else if ($rideStatus == 'P') echo "Pending</td>";
	else if ($rideStatus == 'C') echo "Confirmed</td>";
	else echo "Finished</td>";
      echo "</tr>";
    }
    echo "</table></form>";
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