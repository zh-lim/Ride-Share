<?php
	include("header.php");
	
?>
<script>
	function choosePass(username){
		alert("Hello! I am an alert box!! "+username);
		$('#'+username).val("Decline");
	}
</script>	
<title>Ride Offer History</title>
<body>
<div id="layout">
<?php 
	$active2 = "id='active'";
	$pageTitle = "Ride's Details";
	include("banner.php");
	include("navigationAdmin.php");
?>
  <div id="container" class="box">
<div >
	<h3>Ride's Details</h3>
<?php
	
	if (isset($_POST["driver".$_POST["chooseRide"]])) $_SYSTEM["driver"] = $_POST["driver".$_POST["chooseRide"]];
	if (isset($_POST["startTime".$_POST["chooseRide"]])) $_SYSTEM["startTime"] = $_POST["startTime".$_POST["chooseRide"]];
	if (isset($_POST["date".$_POST["chooseRide"]])) $_SYSTEM["date"] = $_POST["date".$_POST["chooseRide"]];
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delPass"])){
		$query = "DELETE FROM passenger WHERE rstart = '".$_POST["startTime"]."' AND rdate = '".$_POST["date"]."' AND rdriver = '".$_POST["driver"]."' AND name = '".$_POST["delPass"]."';";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());	
	}
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateRide"])){
		if ($_POST["seats"] > $_SESSION["maxSeats"]) {
			echo "<h3>Number Of Available Seats Keyed In Is Larger Than The Maximum Seats That Can Be Offered!</h3>";
		}else{
			$query = "UPDATE ride SET starttime = '". $_POST["startTime"] ."', date = '". $_POST["date"] ."', driver = '". $_POST["driver"] ."', availseats = '". $_POST["seats"] ."', cost = '". $_POST["cost"] ."', snhood = '". $_POST["snhood"] ."', spostal = '". $_POST["spostcode"] ."', saddr = '". $_POST["saddr"] ."', dnhood = '". $_POST["dnhood"] ."', dpostal = '". $_POST["dpostcode"] ."', daddr = '". $_POST["daddr"] ."', status  = '". trim($_POST["status"]) ."'  WHERE starttime = '".$_SYSTEM["startTime"]."' AND date = '".$_SYSTEM["date"]."' AND driver = '".$_SYSTEM["driver"]."';";
			$_SYSTEM["driver"] = $_POST["driver"];
			$_SYSTEM["startTime"] = $_POST["startTime"];
			$_SYSTEM["date"] = $_POST["date"];
			$result = pg_query($query) or die('Query failed: ' . pg_last_error());	
		}
	}

	$query = "SELECT r.starttime, r.date, r.availseats, r.cost, r.saddr, r.snhood, r.spostal, r.daddr, r.dnhood, r.dpostal, r.status, r.driver, c.numseat-1 FROM ride r, car c WHERE r.driver='".$_POST["driver".$_POST["chooseRide"]]."' AND r.starttime = '".$_POST["startTime".$_POST["chooseRide"]]."' AND r.date = '".$_POST["date".$_POST["chooseRide"]]."' AND r.car = c.regnum;";
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	$row = pg_fetch_row($result);
	$_SESSION["maxSeats"] = $row[12];
	echo "<form action='rideEdit.php' method='POST'><table border=\"1\" >
	<col width=\"7%\">
	<col width=\"8%\">
	<col width=\"5%\">
	<col width=\"7%\">
	<col width=\"14%\">
	<col width=\"8%\">
	<col width=\"8%\">
	<col width=\"14%\">
	<col width=\"8%\">
	<col width=\"8%\">
	<col width=\"8%\">
	<col width=\"5%\">
	<tr>
	<th>Starting Time</th>
	<th>Date</th>
	<th>Seats (Max ".$row[12].")</th>
	<th>Cost</th>
	</tr>";


      
      echo "<tr>";
      echo "<td><input type = 'text' name = 'startTime' value = '" . $row[0] . "'/></td>";
      echo "<td><input type = 'text' name = 'date' value = '" . $row[1] . "'/></td>";
      echo "<td><input type = 'text' name = 'seats' value = '" . $row[2] . "'/></td>";
      echo "<td><input type = 'text' name = 'cost' value = '" . $row[3] . "'/></td>";
?>
	<tr>
	<th colspan = "2">Departure - Address</th>
	<th>Neighbourhood</th>
	<th>Postal Code</th>
	</tr>
	<tr>
<?php 
	echo "<td colspan = '2'><input type = 'text' name = 'saddr' value = '" . $row[4] . "'/></td>";
	echo "<td><input type = 'text' name = 'snhood' value = '" . $row[5] . "'/></td>";
	echo "<td><input type = 'text' name = 'spostcode' value = '" . $row[6] . "'/></td>";
?>
	</tr>
	<tr>
	<th colspan = "2">Destination - Address</th>
	<th>Neighbourhood</th>
	<th>Postal Code</th>
	</tr>
	
<?php 
	echo "<td colspan = '2'><input type = 'text' name = 'daddr' value = '" . $row[7] . "'/></td>";
	echo "<td><input type = 'text' name = 'dnhood' value = '" . $row[8] . "'/></td>";
	echo "<td><input type = 'text' name = 'dpostcode' value = '" . $row[9] . "'/></td>";
?>

	<tr>
	<th>Driver</th>
	<th>Status</th>
	</tr>

<?php
	echo "<td><input type = 'text' name = 'driver' value = '" . $row[11] . "'/></td>"; 
	echo "<td><input type = 'text' name = 'status' value = '" .$row[10]. "' pattern = '{1,1}'/></td><td><input type = 'submit' name='updateRide' value = 'Update' /></td></tr>";
?>

	</table>
    
<?php    pg_free_result($result);?>
</div>
<div id="obsah" class="content box">
	<h3>List Of Passenger Requests</h3>
<?php
    $query = "SELECT p.name, p.status FROM passenger p WHERE p.rdriver = '".$_POST["driver".$_POST["chooseRide"]]."' AND p.rstart = '".$_POST["startTime".$_POST["chooseRide"]]."' AND p.rdate = '".$_POST["date".$_POST["chooseRide"]]."' ORDER BY p.timestamp;";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    echo "<table border=\"1\" >	
	<tr>
	<th>UserName</th>
	<th>Status</th>
	</tr>";


      while ($row = pg_fetch_row($result)){
      echo "<tr>";
      echo "<td><input type = 'hidden' name = 'passenger' value = '" . $row[0] . "'/>" . $row[0] . "</td>";
      echo "<td>" . $row[1] . "</td>";
      echo "<td><button name='delPass' value='".$row[0]."'>Delete</button></td>";
      }
    echo "</table></form>";
    
    pg_free_result($result);
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