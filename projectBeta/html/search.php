<?php
	include("header.php");	
?>
<title> Search </title>
<body>
	<div class='profilebox'>
		<?php
		if($_SESSION["login_user"]){
			echo "hello ".$_SESSION["login_user"];
			echo "<br/><a href='logout.php'>Logout</a> | ";
			echo "<a href='profile.php'>Profile</a>";
		}
	?>
	</div>
	<div id="layout">
		<!-- <div id="header"> -->
		    <?php 
				$active5 = "id='active'";
				$pageTitle = "Search";
				// include("banner.php");
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
							<?php //include("sidebar.php");?>
						</div> 
				
					</div>
					</div><!-- end of obsah -->
				<?php 
				$query = "SELECT * FROM ride WHERE ";
				$post = false;
				if($_POST['pickUpNH']){
					$pickupnh = $_POST['pickUpNH'];
					$query .= "snhood ='".$pickupnh."' AND ";
					$post = true;
				}
				if($_POST['pickUpP']){
					$pickupp = $_POST['pickUpP'];
					$spostal1 = intval($pickupp) - 30;
					$spostal2 = intval($pickupp) + 30;
					$query .= "spostal BETWEEN '".$spostal1."' AND '".$spostal2."' AND ";
					$post = true;
				}
				if($_POST['DestinationNH']){
					$destnh = $_POST['DestinationNH'];
					$query .= "dnhood = '".$destnh."' AND ";
					$post = true;
				}
				if($_POST['DestinationP']){
					$destp = $_POST['DestinationP'];
					$dpostal1 = intval($destp) - 30;
					$dpostal2 = intval($destp) + 30;
					$query .= "dpostal BETWEEN '".$dpostal1."' AND '".$dpostal2."' AND ";
					$post = true;
				}

				if($_POST["Search"]){
					if($post == true){
						$query = substr($query, 0, -5);
						$result = pg_query($query) or die('Query failed: ' . pg_last_error());
						// echo "<b>SQL:   </b>".$query."<br><br>";
					}
					else{
						$query = substr($query, 0, -7);
						$result = pg_query($query) or die('Query failed: ' . pg_last_error());
						// echo "<b>SQL:   </b>".$query."<br><br>";
					}
				}
				// if($pickup == ""){
				
				// 	$query = "SELECT * FROM ride WHERE ";
				// 	$result=pg_query($sql);
				// }
				echo "<form action='join.php' method='post'>";
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

				while($row = pg_fetch_row($result)){
				// $row = pg_fetch_row($result);
					$ride = $row[0].",".$row[1].",".$row[2];
				    echo "<tr>";
				    echo "<td>" . $row[0] . "</td>";
				    echo "<td>" . $row[1] . "</td>";
				    echo "<td>" . $row[2] . "</td>";
				    echo "<td>" . $row[3] . "</td>";
				    echo "<td>" . $row[4] . "</td>";
				    echo "<td>" . $row[5] . "</td>";
				    echo "<td>" . $row[7] . "</td>";
				    echo "<td>" . $row[9] . "</td>";
				    echo "<td>" . $row[10] . "</td>";
				    echo "<td> <button name='joinride' value='".$ride."' >JOIN RIDE</button> </td>";
				 	echo "</tr>";
				    
				}
				echo "</table></form>";
			    pg_free_result($result);
			// }
			?>
					
		    
  </div>
</div>

<div id="footer">
  <div id="foot">
    <div id="page-bottom"> <a href="#header">Go up</a> </div>
    <p class="f-left">&copy; 2008 - <a href="http://all-free-download.com/free-website-templates/">SimpleEvent</a></p>
    <p class="f-right"><a href="http://www.tvorimestranky.cz" id="webdesign">Webdesign</a>: <a href="http://www.tvorimestranky.cz">TvorimeStranky.cz</a> | Sponsored by: <a href="http://www.topas-tachlovice.cz/topas-tachlovice.aspx">Tachlovice</a></p>
  </div>
</div>
<!-- <div align=center>This template  downloaded form <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></body> -->
</html>

