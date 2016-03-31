<?php
	include("header.php");
	
?>

		
<title>Ride Offer</title>
<body>
<div id="layout">
<?php 
	$active1 = "id='active'";
	$pageTitle = "Ride History";
	include("banner.php");
	include("navigation.php");
?>
  <div id="container" class="box">
<div id="obsah" class="content box">

<?php 
	

	$query = "SELECT * FROM car c WHERE c.owner = '".$_SESSION["login_user"]."';";
	$result=pg_query($query) or die('Query failed: ' . pg_last_error());
	$display = "block";
	if ($_POST["carChoice"] <> "") $_SESSION["regNum"] = $_POST["carChoice"];
	if(pg_num_rows($result)==0) {
		echo "<h3>You Have Not Registered A Car! Register Your Car Before Posting A Ride</h3>";
		echo "<a href=\"carReg.php\">Register Car</a>";
		$display = none;
	} else if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["regNum"] == "") {
		echo "<h3>Please Select A Car Before Posting Your Offer</h3>";
		echo "<a href=\"http://localhost/ridePosting.php\">Back</a>";
		$display = none;
	} else {
?>
	<lable>Choose your car: </label>
	<form action = "ridePosting.php" method = "POST">
		<select id = "carChoice" name = "carChoice" onchange = "this.form.submit();">
			<option value = <?php echo $_POST["carChoice"]; ?>><?php
				if ($_SESSION["regNum"] == "") echo "Select Your Car";
				else echo $_SESSION["regNum"];
			?></option>
			<?php
        		$query = "SELECT regnum FROM car WHERE owner = '".$_SESSION["login_user"]."';";
		        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
         
		        while($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
           			foreach ($line as $col_value) {
					if ($col_value <> $_SESSION["regNum"]) echo "<option value=\"".$col_value."\">".$col_value."</option><br>";
         			}
        		}
        		pg_free_result($result);
        		?>
		</select>
	</form>
	<br/>
<?php
	}
	$query2 = "SELECT numseat FROM car c WHERE c.owner = '".$_SESSION["login_user"]."' AND c.regnum = '".$_SESSION["regNum"]."';";
	$result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());
	$value = pg_fetch_object($result2);
	$numSeat = $value->numseat;
	
	
	if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["regNum"] <> ""){
		if (isset($_POST['startTime']) && isset($_POST['startDate']) && isset($_POST['availSeats']) && isset($_POST['sPostCode']) && isset($_POST['dPostCode'])) {
		$sql = "INSERT INTO ride VALUES ('" .$_POST['startTime']. "','" .$_POST['startDate']. "','" .$_SESSION['login_user']. "','" .$_SESSION['regNum']. "'," .$_POST['availSeats']. "," .$_POST['cost']. ",'" .$_POST['sNhood']. "','" .$_POST['sPostCode']. "','" .$_POST['sAddress']. "','" .$_POST['dNhood']. "','" .$_POST['dPostCode']. "','" .$_POST['dAddress']. "','P');";
		$result3 = pg_query($sql);
		
		if ($result3 != false) {
			echo "<h3>Your Ride Offer Has Been Posted!</h3>";
		}else {
			echo "<h3>Ride Offer Could Not Be Processed!</h3>";
			$sql2 = "SELECT * FROM ride r WHERE r.driver='" .$_SESSION['login_user']. "' AND r.starttime='" .$_POST['startTime']. "' AND r.date='" .$_POST['startDate']. "';";
			$result4 = pg_query($sql2);
			if ($result4){
				echo "<p>You Have Offered Another Ride At The Same Provided Time</p>";
			}	
		}
		$display = none;
		echo "<a href=\"http://localhost/ridePosting.php\">Post Another Ride Offer</a>";
		}
	}

	echo "<form id='post-form' action='ridePosting.php' method='post' style='display:".$display."'>";
?>

<script>
	var check1=true;
	var check2=true;
	var check3=true;
	function checkSeats(){
		if($('#availSeats').val() >= <?php echo $numSeat; ?>){
			$('#messageSeats').html('There Are More Available Seats Than The Seats In Your Car!').css('color', 'red');
			$('#submitButton').attr('disabled', 'disabled');
			$('#messageDisable').html('Please Ensure All The Constraints Are Fullfilled').css('color','red');
			check1=false
		}else {
			$('#messageSeats').html('Accepted!').css('color', 'green');
			check1=true;
			if (check1==true && check2==true && check3==true) {
				$('#messageDisable').html('');
				$('#submitButton').removeAttr('disabled');
			}
		}
	}
	
	function getStartDateTime(){
		$startTimeEntered = $('#startDate').val() + " " + $('#startTime').val();
		var startTime = new Date($startTimeEntered);
		var timeNow = new Date();
		if(startTime<timeNow){
			$('#messageDateTime').html('Starting Time Is Invalid: The Provided Time Has Passed').css('color','red');
			$('#messageDisable').html('Please Ensure All The Constraints Are Fullfiled').css('color','red');
			$('#submitButton').attr('disabled', 'disabled');
			check2=false;
		}else{
			$('#messageDateTime').html('Accepted').css('color','green');
			check2=true;
			if (check1==true && check2==true && check3==true) {
				$('#messageDisable').html('');
				$('#submitButton').removeAttr('disabled');
			}
		}
	}	
	function checkPostCode(){
		if($('#sPostCode').val() == $('#dPostCode').val()){
			$('#messagePostCode').html('Enter A Code Different From The Departure\'s Postal Code').css('color','red');
			$('#messageDisable').html('Please Ensure All The Constraints Are Fullfiled').css('color','red');
			$('#submitButton').attr('disabled', 'disabled');
			check3=false;
		}else{
			$('#messagePostCode').html('Accepted').css('color','green');
			check3=true;
			if (check1==true && check2==true && check3==true) {
				$('#messageDisable').html('');
				$('#submitButton').removeAttr('disabled');
			}
		}
	}	
</script>
	<label>Start Time :</label>
	<input type="time" id="startTime" name="startTime" onchange="getStartDateTime();" required/><br/>
	<label>Date :</label>
	<input type="date" id="startDate" name="startDate" onchange="getStartDateTime();" required/>

	<span id='messageDateTime'></span><br/>
	
	<label >Number of Seats Offered: </label>				
	<input id="availSeats" type="number" name="availSeats" onchange="checkSeats();" required/><br/>
	<span id='messageSeats'></span><br/>
	<label>Cost: </label>
	<input id="cost" type="number" name="cost"/><br/>
	<br/>
	<h3>Start From:</h3>
	<div>
		<label>Full Address:</label>
		<input id = "sAddress" name="sAddress" required type="text"/><br/>
		<label>Neighbourhood: </label>
		<select id = "sNhood" name="sNhood">
			<option value = "">Select A Neighbourhood</option>
			<option value = "Ang Mo Kio">Ang Mo Kio</option>
			<option value = "Bedok">Bedok</option>
			<option value = "Bishan">Bishan</option>
			<option value = "Bukit Batok">Bukit Batok</option>
			<option value = "Bukit Merah">Bukit Merah</option>
			<option value = "Bukit Panjang">Bukit Panjang</option>
			<option value = "Choa Chu Kang">Choa Chu Kang</option>
			<option value = "Clementi">Clementi</option>
			<option value = "Geylang">Geylang</option>
			<option value = "Hougang">Hougang</option>
			<option value = "Jurong East">Jurong East</option>
			<option value = "Jurong West">Jurong West</option>
			<option value = "Kallang/Whampoa">Kallang/Whampoa</option>
			<option value = "Pasir Ris">Pasir Ris</option>
			<option value = "Punggol">Punggol</option>
			<option value = "Queenstown">Queenstown</option>
			<option value = "Sembawang">Sembawang</option>
			<option value = "Serangoon">Serangoon</option>
			<option value = "Sengkang">Sengkang</option>
			<option value = "Simei">Simei</option>
			<option value = "Tampines">Tampines</option>
			<option value = "Tampines North">Tampines North</option>
			<option value = "Toa Payoh">Toa Payoh</option>
			<option value = "Woodlands">Woodlands</option>
			<option value = "Yishun">Yishun</option>
		</select><br/>
		<label>Postal Code: </label>
		<input id="sPostCode" name="sPostCode" required pattern=".{6,6}" onchange="checkPostCode();"/><br/>
	</div>
	<br/>
	<h3>Destination</h3>
	<div>
		<label>Full Address:</label>
		<input id="dAddress" name="dAddress" required type="text"/><br/>
		<label>Neighbourhood: </label>
		<select id="dNhood" name="dNhood">
			<option value = "">Select A Neighbourhood</option>
			<option value = "Ang Mo Kio">Ang Mo Kio</option>
			<option value = "Bedok">Bedok</option>
			<option value = "Bishan">Bishan</option>
			<option value = "Bukit Batok">Bukit Batok</option>
			<option value = "Bukit Merah">Bukit Merah</option>
			<option value = "Bukit Panjang">Bukit Panjang</option>
			<option value = "Choa Chu Kang">Choa Chu Kang</option>
			<option value = "Clementi">Clementi</option>
			<option value = "Geylang">Geylang</option>
			<option value = "Hougang">Hougang</option>
			<option value = "Jurong East">Jurong East</option>
			<option value = "Jurong West">Jurong West</option>
			<option value = "Kallang/Whampoa">Kallang/Whampoa</option>
			<option value = "Pasir Ris">Pasir Ris</option>
			<option value = "Punggol">Punggol</option>
			<option value = "Queenstown">Queenstown</option>
			<option value = "Sembawang">Sembawang</option>
			<option value = "Serangoon">Serangoon</option>
			<option value = "Sengkang">Sengkang</option>
			<option value = "Simei">Simei</option>
			<option value = "Tampines">Tampines</option>
			<option value = "Tampines North">Tampines North</option>
			<option value = "Toa Payoh">Toa Payoh</option>
			<option value = "Woodlands">Woodlands</option>
			<option value = "Yishun">Yishun</option>
		</select><br/>
		<label>Postal Code: </label>
		<input id="dPostCode" name="dPostCode" required pattern=".{6,6}" onchange="checkPostCode();"/><br/>
		<span id='messagePostCode'></span><br/>
	</div>
		<br/><br/>
		<input type="submit" id="submitButton" name="submit" value=" Submit "/><span id='messageDisable'></span><br/>
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
  </div>
</div>
</html>