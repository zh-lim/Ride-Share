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
		<th>Confirm</th>
		</tr>
<?php 
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["transConfirm"])){
		$originalAmount = $_POST["transConfirm"];
		$sql = "UPDATE account SET balance = (balance + '".$originalAmount."' - '".$_POST["amount"]."') WHERE username = '".$_POST["debitFrom"]."';";
		$result = pg_query($sql) or die('Query failed: ' . pg_last_error());

		$sql = "UPDATE account SET balance = (balance - '".$originalAmount."' + '".$_POST["amount"]."') WHERE username = '".$_POST["creditTo"]."' ;";	
		$result = pg_query($sql) or die('Query failed: ' . pg_last_error());

		$sql = "UPDATE transaction SET amount = '".$_POST["amount"]."' WHERE \"debitFrom\" = '".$_POST["debitFrom"]."' AND \"creditTo\" = '".$_POST["creditTo"]."' AND \"rStart\" = '".$_POST["rStart"]."' AND \"rDate\" = '".$_POST["rDate"]."';";	
		$result = pg_query($sql) or die('Query failed: ' . pg_last_error());	

		$sql = "SElECT * FROM transaction WHERE \"debitFrom\" = '".$_POST["debitFrom"]."' AND \"creditTo\" = '".$_POST["creditTo"]."' AND \"rStart\" = '".$_POST["rStart"]."' AND \"rDate\" = '".$_POST["rDate"]."';";
		$result = pg_query($sql) or die('Query failed: ' . pg_last_error());
	}else {
		$index = $_POST["editTrans"];
		$sql = "SElECT * FROM transaction WHERE \"debitFrom\" = '".$_POST["debitFrom".$index]."' AND \"creditTo\" = '".$_POST["creditTo".$index]."' AND \"rStart\" = '".$_POST["rStart".$index]."' AND \"rDate\" = '".$_POST["rDate".$index]."';";
		$result = pg_query($sql) or die('Query failed: ' . pg_last_error());
	}
	$row = pg_fetch_row($result); ?>
		<tr>
		<td><input type = "text" value = <?php echo "\"".$row[0]."\"";?> name = 'debitFrom'/></td>
		<td><input type = "text" value = <?php echo "\"".$row[1]."\"";?> name = 'creditTo'/></td>
		<td><input type = "text" value = <?php echo "\"".$row[2]."\"";?> name = 'rStart'/></td>
		<td><input type = "text" value = <?php echo "\"".$row[3]."\"";?> name = 'rDate'/></td>
		<td><input type = "text" value = <?php echo "\"".$row[4]."\"";?> name = 'amount'/></td>
		<td><button id="transConfirm" name="transConfirm" value = <?php echo "\"".$row[4]."\"";?> >Confirm</button></td>
		</tr>			
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
