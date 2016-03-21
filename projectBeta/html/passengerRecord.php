<?php
	include("header.php");
	
	
	
?>

<body>
<div id="layout">
<?php 
	$active4 = "id='active'";
	$pageTitle = "Passenger's Record";
	include("banner.php");
	include("navigation.php");
?>
  <div id="container" class="box">
	<div id="obsah" class="content box">
		<h3>Ride Request History</h3>
<?php 
	
?>
		<table border="1">
		<col width="20%">
		<col width="10%">
		<col width="16%">
		<col width="20%">
		<col width="14%">
		<col width="20%">
		
		<tr>
		<th>Request Time</th>
		<th>Trip's Starting Time</th>
		<th>Trip's Starting Date</th>
		<th>Driver</th>
		<th>Cost</th>
		<th>Request Status</th>
		</tr>
<?php
	$sql = "SELECT p.timestamp, p.rstart, p.rdate, p.rdriver, r.cost, p.status, r.saddr, r.snhood, r.spostal, r.daddr, r.dnhood, r.dpostal, r.status FROM passenger p, ride r WHERE p.name = '".$_SESSION['login_user']."' AND p.rstart = r.starttime AND p.rdriver = r.driver AND p.rdate = r.date;";
	$result = pg_query($sql) or die('Query failed: ' . pg_last_error());
	while ($row = pg_fetch_row($result)) {
		echo "<tr>";
		echo "<td>" . $row[0] . "</td>";
		echo "<td>" . $row[1] . "</td>";
		echo "<td>" . $row[2] . "</td>";
		echo "<td>" . $row[3] . "</td>";
		echo "<td>" . $row[4] . "</td>";
		if ($row[5] == "P" && $row[12] == "E") {
			echo "<td>Expired</td>";
		}else if ($row[5] == "P" && $row[12] == "P") {
			echo "<td>Pending</td>";
		}else if ($row[5] == "C") {
			echo "<td>Confirmed</td>";
		}else {
			echo "<td>Rejected</td>";
		}
		
		echo "</tr>";
		echo "<tr>";
		echo "<th>Departure</th>";
		echo "<td colspan='5'>".$row[6].", ".$row[7].", S".$row[8]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Destination</th>";
		echo "<td colspan='5'>".$row[9].", ".$row[10].", S".$row[11]."</td>";
		echo "</tr>";
		echo "<tr><td colspan='6'>&nbsp;</td></tr>";
		echo "<tr><td colspan='6'>&nbsp;</td></tr>";
	}
?>		
		</table>		
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
    <p class="f-left">&copy; 2008 - <a href="http://all-free-download.com/free-website-templates/">SimpleEvent</a></p>
    <p class="f-right"><a href="http://www.tvorimestranky.cz" id="webdesign">Webdesign</a>: <a href="http://www.tvorimestranky.cz">TvorimeStranky.cz</a> | Sponsored by: <a href="http://www.topas-tachlovice.cz/topas-tachlovice.aspx">Tachlovice</a></p>
  </div>
</div>
<div align=center>This template  downloaded form <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></body>
</html>
