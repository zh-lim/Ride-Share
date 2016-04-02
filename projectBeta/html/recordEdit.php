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
		<form action="recordEdit.php" method="post">
		<h3>Edit Particulars</h3>
		<table style="text-align:left;">
<?php
	if (isset($_POST['recordEdit'])) $_SESSION["UserName"] = $_POST['recordEdit'];
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateRec"])){
		$sql = "UPDATE account SET username = '".$_POST["username"]."', gender = '".$_POST["gender"]."', firstname='".$_POST["fname"]."', lastname='".$_POST["lname"]."', password = '".$_POST["password"]."', birthday = '".$_POST["birthday"]."', contact = '".$_POST["contact"]."', balance = '".$_POST["balance"]."', email = '".$_POST["email"]."', licensenum = '".$_POST["licensenum"]."' WHERE account.username = '".$_SESSION["UserName"]."';";
		$result = pg_query($sql) or die('Query failed: ' . pg_last_error());
		$_SESSION["UserName"] = $_POST['username'];
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateCar"])) {
		$concat = $_POST["updateCar"];
		$_SESSION['regnum']=substr($concat,0,strpos($concat,"|"));
		$_SESSION['choice']=substr($concat,strpos($concat,"|")+1);
		$sql = "UPDATE car SET regnum = '".$_POST["cregnum".$_SESSION["choice"]]."', numseat='".$_POST["cseats".$_SESSION["choice"]]."', make='".$_POST["cmake".$_SESSION["choice"]]."', model = '".$_POST["cmodel".$_SESSION["choice"]]."', color = '".$_POST["ccolor".$_SESSION["choice"]]."' WHERE owner = '".$_SESSION["UserName"]."' AND regnum = '".$_SESSION["regnum"]."';";
		$result = pg_query($sql) or die('Query failed: ' . pg_last_error());
	}
	$query = "SELECT * FROM account a WHERE a.username = '".$_SESSION['UserName']."';";
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	$row = pg_fetch_row($result);
?>
		<tr>
		<th>Index</th>
		<th style="text-align:left;">UserName: </th>
		<td><input type = "text" name = "username" value = <?php echo "'$row[0]'"; ?>/></td>
		<th style="text-align:left;">Gender: </th>
		<td><input type = "text" name = "gender" value = <?php echo "'$row[9]'"; ?>/></td>
		<th style="text-align:left;">First Name: </th>
		<td><input type = "text" name = "fname" value = <?php echo "'$row[1]'"; ?>/></td>
		<th style="text-align:left;">Last Name: </th>
		<td><input type = "text" name = "lname" value = <?php echo "'$row[2]'"; ?>/></td>
		</tr>		

		<tr>
		<td/>
		<th style="text-align:left;">Password: </th>
		<td><input type = "text" name = "password" value = <?php echo "'$row[6]'"; ?>/></td>
		<th style="text-align:left;">Birthday: </th>
		<td><input type = "date" name = "birthday" value = <?php echo "'$row[5]'"; ?>/></td>
		<th style="text-align:left;">Contact: </th>
		<td><input type = "text" name = "contact" value = <?php echo "'$row[8]'"; ?>/></td>
		<th style="text-align:left;">Balance: </th>
		<td><input type = "text" name = "balance" value = <?php echo "'$row[7]'"; ?>/></td>
		</tr>

		<tr>
		<td/>
		<th colspan = "2" style="text-align:left;">Email: </th>
		<td colspan = "2" style="text-align:left;"><input type = "text" name = "email" value = <?php echo "'$row[4]'"; ?>/></td>
		<th colspan = "2" style="text-align:left;">License Number: </th>
		<td colspan = "2" style="text-align:left;"><input type = "text" name = "licensenum" value = <?php echo "'$row[3]'"; ?>/></td>
		</tr>
	
		<tr><td><button name = "updateRec" id = "updateRec">Update Particulars</buton></td></tr>
	<?php
		$query2 = "SELECT c.regnum, c.model, c.make, c.color, c.numseat FROM car c WHERE c.owner = '".$row[0]."' ORDER BY c.regnum;";
		$result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());
		$count = 0;
		while ($row2 = pg_fetch_row($result2)){
			$concat = $row2[0] . "|" . $count;
	?>
		<tr>
		<td/>
		<th colspan = "2" style="text-align:left;">USER'S CAR'S DETAILS</th>
		<th colspan = "2" style="text-align:right;">Car's Register Number: </th>
		<td colspan = "3" ><input type = "text" name = <?php echo "cregnum".$count;?> value = <?php echo "'$row2[0]'"; ?> pattern = "{8,8}"/></td>
		
		<td><button name = "updateCar" id = "updateCar" value = <?php echo "'$concat'"; ?> >Update Car Details</buton></td>
		</tr>

		<tr>
		<td/>
		<th style="text-align:left;">Model: </th>
		<td><input type = "text" name = <?php echo "cmodel".$count;?> value = <?php echo "'$row2[1]'"; ?>/></td>
		<th style="text-align:left;">Make: </th>
		<td><input type = "text" name = <?php echo "cmake".$count;?> value = <?php echo "'$row2[2]'"; ?>/></td>
		<th style="text-align:left;">Colour: </th>
		<td><input type = "text" name = <?php echo "ccolor".$count;?> value = <?php echo "'$row2[3]'"; ?>/></td>
		<th style="text-align:left;">Total Seats: </th>
		<td><input type = "text" name = <?php echo "cseats".$count;?> value = <?php echo "'$row2[4]'"; ?>/></td>
		</tr>
	<?php $count++;} ?>
		
		</table>
		</form>
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
