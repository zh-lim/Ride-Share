<?php
	include("header.php");
	
?>
<title>Car Pooling</title>
<body>
<div id="layout">
<?php 
	$active3 = "id='active'";
	$pageTitle = "Car Pooling";
	include("banner.php");
	include("navigationAdmin.php");
?>
<script>
	function editTransaction(){
		$("form[name='transactionView']").attr("action","transEdit.php");
	}
</script>
  <div id="container" class="box">
    
	<div>
	<form name="transactionView" method="POST">
	<table>
		<tr>
		<th>Debit From</th>
		<th>Credit To</th>
		<th>Ride's Starting Time</th>
		<th>Ride's Date</th>
		<th>Amount</th>
		<th>Edit</th>
		<th>Delete</th>
		</tr>
<?php 
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delTrans"])){
		$index = $_POST["delTrans"];
		$sql = "UPDATE account SET balance = (balance + '".$_POST['amount'.$index]."') WHERE username = '".$_POST["debitFrom".$index]."';";
		$result = pg_query($sql) or die('Query failed: ' . pg_last_error());

		$sql = "UPDATE account SET balance = (balance - '".$_POST['amount'.$index]."') WHERE username = '".$_POST["creditTo".$index]."' ;";	
		$result = pg_query($sql) or die('Query failed: ' . pg_last_error());		

		$sql = "UPDATE ride SET availseats = availseats + 1 WHERE starttime = '".$_POST["rStart".$index]."' AND date = '".$_POST["rDate".$index]."' AND driver = '".$_POST["creditTo".$index]."';";	
		$result = pg_query($sql) or die('Query failed: ' . pg_last_error());		

		$sql = "DELETE FROM transaction WHERE \"debitFrom\" = '".$_POST["debitFrom".$index]."' AND \"creditTo\" = '".$_POST["creditTo".$index]."' AND \"rStart\" = '".$_POST["rStart".$index]."' AND \"rDate\" = '".$_POST["rDate".$index]."';";	
		$result = pg_query($sql) or die('Query failed: ' . pg_last_error());
	}
	$sql = "SElECT * FROM transaction";
	$result = pg_query($sql) or die('Query failed: ' . pg_last_error());
	$count = 0;
	while ($row = pg_fetch_row($result)) {?>
		<tr>
		<td><input type = "hidden" value = <?php echo "\"".$row[0]."\"";?> name = <?php echo "\"debitFrom".$count."\"";?>/><?php echo $row[0];?></td>
		<td><input type = "hidden" value = <?php echo "\"".$row[1]."\"";?> name = <?php echo "\"creditTo".$count."\"";?>/><?php echo $row[1];?></td>
		<td><input type = "hidden" value = <?php echo "\"".$row[2]."\"";?> name = <?php echo "\"rStart".$count."\"";?>/><?php echo $row[2];?></td>
		<td><input type = "hidden" value = <?php echo "\"".$row[3]."\"";?> name = <?php echo "\"rDate".$count."\"";?>/><?php echo $row[3];?></td>
		<td><input type = "hidden" value = <?php echo "\"".$row[4]."\"";?> name = <?php echo "\"amount".$count."\"";?>/><?php echo $row[4];?></td>
		<td><button name = "editTrans" id = "editTrans" value = <?php echo "\"".$count."\"";?> onclick="editTransaction();">Edit</button></td>
		<td><button name = "delTrans" id = "delTrans" value = <?php echo "\"".$count."\"";?> >Delete</button></td>
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
