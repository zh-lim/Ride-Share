
<?php
	include("header.php");

	$driver = pg_escape_string($_POST["driver"]);
	$destination = pg_escape_string($_POST["destination"]);
	$date = pg_escape_string($_POST["date"]);
	$starttime = pg_escape_string($_POST["starttime"]);
	//$_POST[endTime];
	$start = pg_escape_string($_POST["start"]);
	$availSeats = $_POST["availSeats"] - 1;
	//$availSeats = pg_escape_string($_POST["availSeats"]);
	$car = pg_escape_string($_POST["car"]);
	$cost = pg_escape_string($_POST["cost"]);
				
	//$sql = "SELECT * FROM ride WHERE starttime = '".$starttime."' and date = '".$date."' and driver = '".$driver."' and start = '".$start."' and destination = '".$destination."';";
	$sql = "UPDATE \"public\".\"ride\" SET \"availSeats\" = ".$availSeats." WHERE \"starttime\"='".$starttime."' AND \"date\"='".$date."' AND \"driver\"='".$driver."' AND \"start\"='".$start."' AND \"destination\"='".$destination."'";

	echo $sql;
	$result=pg_query($sql);
	if ($result != false){
		header("Location: passenger.php");
	} 
?>