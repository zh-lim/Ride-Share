<?php
	include("header.php");
	
?>
<title>Car Pooling</title>
<body>
<div id="layout">
<?php 
	$active1 = "id='active'";
	$pageTitle = "Car Pooling";
	include("banner.php");
	include("navigationAdmin.php");
?>
  <div id="container" class="box">
	<div style="text-align:left;">
		<table style="text-align:left;">
<?php
	$query = "SELECT * FROM account a ORDER BY a.username;";
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	$count = 1;
	while ($row = pg_fetch_row($result)){
?>
		<tr>
		<th>Index</th>
		<th style="text-align:left;">UserName: </th>
		<td><?php echo $row[0]; ?></td>
		<th style="text-align:left;">Gender: </th>
		<td><?php echo $row[9]; ?></td>
		<th style="text-align:left;">First Name: </th>
		<td><?php echo $row[1]; ?></td>
		<th style="text-align:left;">Last Name: </th>
		<td><?php echo $row[2]; ?></td>
		<td><button>Edit</buton></td>
		</tr>		

		<tr>
		<td><?php echo $count; ?></td>
		<th style="text-align:left;">Password: </th>
		<td><?php echo $row[6]; ?></td>
		<th style="text-align:left;">Birthday: </th>
		<td><?php echo $row[5]; ?></td>
		<th style="text-align:left;">Contact: </th>
		<td><?php echo $row[8]; ?></td>
		<th style="text-align:left;">Balance: </th>
		<td><?php echo $row[7]; ?></td>
		</tr>

		<tr>
		<td/>
		<th colspan = "2" style="text-align:left;">Email: </th>
		<td colspan = "2" style="text-align:left;"><?php echo $row[4]; ?></td>
		<th colspan = "2" style="text-align:left;">License Number: </th>
		<td colspan = "2" style="text-align:left;"><?php echo $row[3]; ?></td>
		</tr>
	<?php
		$query2 = "SELECT c.regnum, c.model, c.make, c.color, c.numseat FROM car c WHERE c.owner = '".$row[0]."' ORDER BY c.regnum;";
		$result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());
		while ($row2 = pg_fetch_row($result2)){
	?>
		<tr>
		<td/>
		<th colspan = "2" style="text-align:left;">USER'S CAR'S DETAILS</th>
		<th colspan = "2" style="text-align:right;">Car's Register Number: </th>
		<td colspan = "4" ><?php echo $row2[0]; ?></td>
		</tr>

		<tr>
		<td/>
		<th style="text-align:left;">Model: </th>
		<td><?php echo $row2[1]; ?></td>
		<th style="text-align:left;">Make: </th>
		<td><?php echo $row2[2]; ?></td>
		<th style="text-align:left;">Colour: </th>
		<td><?php echo $row2[3]; ?></td>
		<th style="text-align:left;">Total Seats: </th>
		<td><?php echo $row2[4]; ?></td>
		</tr>
	<?php } ?>
		<tr><td colspan='10'>&nbsp;</td></tr>
<?php $count++; } ?>
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
