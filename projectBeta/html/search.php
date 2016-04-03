<?php
	include("header.php");	
?>
<title> Search </title>
<body>
	<div id="layout">
		<!-- <div id="header"> -->
		    <?php 
				$active5 = "id='active'";
				$pageTitle = "Search";
				include("banner.php");
				include("navigation.php");
			?>

			<div id="container" class="box">
			    <div id="obsah" class="content box">
					<div class="in">
						<form class="form-horizontal" action="#" method="post">
							<fieldset>
								<!-- Form Name -->
								<legend>Search for your ride</legend>
							
								<!-- Text input--><!-- For start Address -->
								<!-- <div class="form-group">
									<label class="col-md-4 control-label" for="pickUp">Pick up location</label>  
									<div class="col-md-4">
										<input id="pickUp" name="pickUp" type="text" placeholder="" class="form-control input-md">
									</div>
								</div> -->

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="pickUp">Pick up Neighbourhood</label>  
									<div class="col-md-4">
										<select id="pickUpNH" name="pickUpNH" class="form-control input-md">
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
										</select>
									</div>
								</div>

								<!-- Text input--><!-- For start postal -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="pickUpP">Pick up Postal</label>  
									<div class="col-md-4">
										<input id="pickUpP" name="pickUpP" type="text" placeholder="" class="form-control input-md">
									</div>
								</div>

								<!-- Text input--><!-- For dest Address -->
								<!-- <div class="form-group">
				  					<label class="col-md-4 control-label" for="Destination">Destination</label>  
									<div class="col-md-4">
										<input id="Destination" name="Destination" type="text" placeholder="" class="form-control input-md">
									</div>
								</div> -->

								<div class="form-group">
				  					<label class="col-md-4 control-label" for="DestinationNH">Destination Neighbourhood</label>  
									<div class="col-md-4">
										<select id="DestinationNH" name="DestinationNH" class="form-control input-md">
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
										</select>
									</div>
								</div>								

								<div class="form-group">
				  					<label class="col-md-4 control-label" for="DestinationP">Destination Postal</label>  
									<div class="col-md-4">
										<input id="DestinationP" name="DestinationP" type="text" placeholder="" class="form-control input-md">
									</div>
								</div>

								<input type="submit" name="Search" value="Search"/>
							</fieldset>
						</form>

					</div>
					<div id="panel-right" class="box panel">
						<div id="bottom">
							<?php include("sidebar.php");?>
						</div>
				
					</div>
				<?php 
				$query = "SELECT * FROM ride WHERE ";
				if($_POST['pickUpNH']){
					$pickupnh = $_POST['pickUpNH'];
					$query .= "snhood ='".$pickupnh."' AND ";
				}
				if($_POST['pickUpP']){
					$pickupp = $_POST['pickUpP'];
					$spostal1 = intval($pickupp) - 30;
					$spostal2 = intval($pickupp) + 30;
					$query .= "spostal BETWEEN '".$spostal1."' AND '".$spostal2."' AND ";
				}
				if($_POST['DestinationNH']){
					$destnh = $_POST['DestinationNH'];
					$query .= "dnhood = '".$destnh."' AND ";
				}
				if($_POST['DestinationP']){
					$destp = $_POST['DestinationP'];
					$dpostal1 = intval($destp) - 30;
					$dpostal2 = intval($destp) + 30;
					$query .= "dpostal BETWEEN '".$dpostal1."' AND '".$dpostal2."' AND ";
				}

				$query = substr($query, 0, -5);

				// if($_POST['pickUpNH']||$_POST['pickUpP']||$_POST['DestinationNH']||$_POST['DestinationP']){

				// // $pickup = $_POST['pickUp'];
				// $pickupnh = $_POST['pickUpNH'];
				// $pickupp = $_POST['pickUpP'];
				// // $dest = $_POST['Destination'];
				// $destnh = $_POST['DestinationNH'];
				// $destp = $_POST['DestinationP']; 

				// $spostal1 = intval($pickupp) - 10;
				// $spostal2 = intval($pickupp) + 10;
				// $dpostal1 = intval($destp) - 10;
				// $dpostal2 = intval($destp) + 10;

				// $query = "SELECT * FROM ride WHERE snhood = '".$pickupnh."' AND spostal BETWEEN '".$spostal1."' AND '".$spostal2."' AND dnhood = '".$destnh."' AND dpostal BETWEEN '".$dpostal1."' AND '".$dpostal2."'";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
				// if($pickup == ""){
				echo "<b>SQL:   </b>".$query."<br><br>";
				// 	$query = "SELECT * FROM ride WHERE ";
				// 	$result=pg_query($sql);
				// }
				echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" class=\"db-table\" >
				<col width=\"5%\">
				<col width=\"7%\">
				<col width=\"9%\">
				<col width=\"5%\">
				<col width=\"7%\">
				<col width=\"14%\">
				<col width=\"8%\">
				<col width=\"8%\">
				<col width=\"14%\">
				<col width=\"8%\">
				<col width=\"8%\">
				<col width=\"7%\">
				<tr>
				<th>Starting Time</th>
				<th>Date</th>
				<th>Driver</th>
				<th>Vehicle</th>
				<th>Seats</th>
				<th>Cost</th>
				<th>Pick up</th>
				<th>Destination</th>
				<th>Status</th>
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

			      pg_free_result($result);
			// }
			?>
					
		    </div><!-- end of obsah -->
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

