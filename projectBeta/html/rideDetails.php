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
	include("navigation.php");
?>
  <div id="container" class="box">
<div >
	<h3>Ride's Details</h3>
<?php
	$displayButton;
	$startTimeClicked = $_SESSION['start_time_clicked'];
	$dateClicked = $_SESSION['date_clicked'];
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['chooseRide'])){
		$concat = $_POST['chooseRide'];
		$_SESSION['start_time_clicked']=substr($concat,0,strpos($concat,"|"));
		$_SESSION['date_clicked']=substr($concat,strpos($concat,"|")+1);
		$startTimeClicked = $_SESSION['start_time_clicked'];
		$dateClicked = $_SESSION['date_clicked'];
	}
	else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['choosePass'])){
		$sql = "SELECT availseats FROM ride WHERE driver = '".$_SESSION['login_user']."' AND starttime = '".$startTimeClicked."' AND date = '".$dateClicked."';";
		$result = pg_query($sql) or die('Query failed: ' . pg_last_error());
		$value = pg_fetch_object($result);
		$availSeats = $value->availseats;
		$sql = "SELECT status FROM passenger WHERE name = '".$_POST['choosePass']."' AND rdriver = '".$_SESSION['login_user']."' AND rstart = '".$startTimeClicked."' AND rdate = '".$dateClicked."';";
		$result = pg_query($sql) or die('Query failed: ' . pg_last_error());
		$value = pg_fetch_object($result);
		$pStatus = $value->status;

		if ($availSeats > 0 || ($availSeats == 0 && $pStatus == "C")) {
			if ($pStatus == "P") $sql = "UPDATE ride SET availseats = availseats-1 WHERE driver = '".$_SESSION['login_user']."' AND starttime = '".$startTimeClicked."' AND date = '".$dateClicked."';";
			else if ($pStatus == "C") $sql = "UPDATE ride SET availseats = availseats+1 WHERE driver = '".$_SESSION['login_user']."' AND starttime = '".$startTimeClicked."' AND date = '".$dateClicked."';";
			$result = pg_query($sql) or die('Query failed: ' . pg_last_error());

			$sql = "UPDATE passenger SET status = CASE WHEN status = 'P' THEN 'C' WHEN status = 'C' THEN 'P' ELSE status END WHERE name = '".$_POST['choosePass']."' AND rdriver = '".$_SESSION['login_user']."' AND rstart = '".$startTimeClicked."' AND rdate = '".$dateClicked."';";
			$result = pg_query($sql) or die('Query failed: ' . pg_last_error());
			
		}else echo "<h3>Your Ride Is Full. Drop Passengers To Take in Others</h3>";
	}else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmRide'])){
		if ($_POST['confirmRide'] == "Confirm"){
			$sql = "UPDATE ride SET status = 'C' WHERE driver = '".$_SESSION['login_user']."' AND starttime = '".$startTimeClicked."' AND date = '".$dateClicked."';";
			$result = pg_query($sql);
			$sql = "UPDATE passenger SET status = CASE WHEN status = 'P' THEN 'R' ELSE status END WHERE rdriver = '".$_SESSION['login_user']."' AND rstart = '".$startTimeClicked."' AND rdate = '".$dateClicked."';";
			$result = pg_query($sql) or die('Query failed: ' . pg_last_error());
		}else{
			$sql = "UPDATE ride SET status = 'P' WHERE driver = '".$_SESSION['login_user']."' AND starttime = '".$startTimeClicked."' AND date = '".$dateClicked."';";
			$result = pg_query($sql);
			$sql = "UPDATE passenger SET status = CASE WHEN status = 'R' THEN 'P' ELSE status END WHERE rdriver = '".$_SESSION['login_user']."' AND rstart = '".$startTimeClicked."' AND rdate = '".$dateClicked."';";
			$result = pg_query($sql) or die('Query failed: ' . pg_last_error());
		}
	}
	
    $query = "SELECT starttime, date, availseats, cost, saddr, snhood, spostal, daddr, dnhood, dpostal, status FROM ride WHERE driver='".$_SESSION["login_user"]."' AND starttime = '".$startTimeClicked."' AND date = '".$dateClicked."';";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    echo "<table border=\"1\" >
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
	<th>Seats</th>
	<th>Cost</th>
	<th>Departure</th>
	<th></th>
	<th></th>
	<th>Destination</th>
	<th></th>
	<th></th>
	<th>Status</th>
	<th></th>
	</tr>";


      $row = pg_fetch_row($result);
      echo "<tr>";
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
	if ($rideStatus == 'E') {
		echo "Expired";
		$displayButton = "disabled";
		$displayButton2 = "disabled";
		$setRideStatus = "Closed";
	}else if ($rideStatus == 'P') {
		echo "Pending";
		$displayButton = "";
		$displayButton2 = "";
		$setRideStatus = "Confirm";
	}else if ($rideStatus == 'C') {
		echo "Confirmed";
		$displayButton = "disabled";
		$displayButton2 = "";
		$setRideStatus = "Reopen";
	}else {
		echo "Finished";
		$displayButton = "disabled";
		$displayButton2 = "disabled";
		$setRideStatus = "Closed";
	}
      echo "</td><td><form action='rideDetails.php' method='POST'><input type = 'submit' name='confirmRide' value = '".$setRideStatus."' $displayButton2/></form></td></tr>";
    echo "</table>";
    
    pg_free_result($result);
?>
</div>
<div id="obsah" class="content box">
	<h3>List Of Passenger Requests</h3>
<?php
    $query = "SELECT a.firstname, a.lastname, a.gender, DATE_PART('year',CURRENT_DATE) - DATE_PART('year',a.birthday), a.contact, a.email, a.username, p.status FROM account a, passenger p WHERE a.username = p.name AND p.rdriver = '".$_SESSION['login_user']."' AND p.rstart = '".$startTimeClicked."' AND p.rdate = '".$dateClicked."' ORDER BY p.timestamp;";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    echo "<form action = 'rideDetails.php' method = 'POST'><table border=\"1\" >
	<col width=\"25%\">
	<col width=\"5%\">
	<col width=\"5%\">
	<col width=\"15%\">
	<col width=\"40%\">
	<col width=\"10%\">
	
	<tr>
	<th>Name</th>
	<th>Gender</th>
	<th>Age</th>
	<th>Contact</th>
	<th>Email</th>
	<th>Action</th>
	</tr>";


      while ($row = pg_fetch_row($result)){
      echo "<tr>";
      echo "<td>" . $row[0] . " ".$row[1]."</td>";
      echo "<td>" . $row[2] . "</td>";
      echo "<td>" . $row[3] . "</td>";
      echo "<td>" . $row[4] . "</td>";
      echo "<td>" . $row[5] . "</td>";
	$username = $row[6];
	if ($row[7] == "P" || $row[7] == "R") $actionValue = "Accept";
	else $actionValue = "Decline";
      echo "<td><button name='choosePass' value='".$username."' ".$displayButton.">".$actionValue."</button></td>";
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