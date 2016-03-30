<?php	
include("config.php");
session_start();
?>

<body>
	<div class="site-wrapper">
		<div class="site-wrapper-inner">
			<div class="cover-container">
				<?php
				include("header.php");	
				?>
				<div class="inner cover">
				<!--Driver content here -->
				<?php
				$start = pg_escape_string($_POST["pickUp"]);
				$destination = pg_escape_string($_POST["Destination"]);
				$date = pg_escape_string($_POST["Date"]);
				$starttime = pg_escape_string($_POST["startTime"]);
				//$_POST[endTime];
				$availSeats = pg_escape_string($_POST["seatNum"]);
				$car = pg_escape_string($_POST["car"]);
				$cost = pg_escape_string($_POST["cost"]);
				
				$sql = "INSERT INTO \"public\".\"ride\" (\"starttime\",\"date\",\"driver\",\"start\",\"destination\",\"car\",\"availSeats\",\"cost\")
					VALUES ('".$starttime."','".$date."','".$_SESSION['login_user']."','".$start."','".$destination."','".$car."','".$availSeats."',".$cost.");";
				//echo $sql;
				$result=pg_query($sql);
				if ($result != false){
					echo "Your post is successful.";
				}
					
			?>
				<!--Driver content ends -->
			</div>
		</div>
	</div>
	</html>
