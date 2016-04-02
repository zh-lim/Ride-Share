<?php
	include("header.php");	
?>

<body>
	<div id="layout">
		<div id="header">
		    <h1 id="logo"><a href="http://all-free-download.com/free-website-templates/">SimpleEvent</a></h1>
		    <span id="slogan">Your slogan goes here</span>
		    <hr class="noscreen" />
		    <p class="noscreen noprint"> <em>Rychlá navigace: <a href="http://all-free-download.com/free-website-templates/">obsah</a>, <a href="http://all-free-download.com/free-website-templates/">navigace</a>.</em></p>
		    <div id="quicknav"> <a href="http://all-free-download.com/free-website-templates/">Home</a> <a href="http://all-free-download.com/free-website-templates/">Contact</a> <a href="http://all-free-download.com/free-website-templates/">Sitemap</a> </div>
		    <hr class="noscreen" />
		    <div id="nav" class="box">
			    <ul>
			      <li id="active"><a href="index.php">Home</a></li>
			      <li><a href="driver.php">I am a Driver</a></li>
			      <li><a href="passenger.php">I am a Passenger</a></li>
			      <li><a href="search.php">Search</a></li>
			  	</ul>
			  	<hr class="noscreen" />
			</div>

			<div id="container" class="box">
			    <div id="obsah" class="content box">
					<div class="in">
						<form class="form-horizontal" action="driver-submitted.php" method="post">
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

								<input type="submit" name="search" value="Search"/>
							</fieldset>
						</form>

					</div>
			    



			
			<?php if(isset($_GET['formSubmit'])){
				// $pickup = $_POST['pickUp'];
				$pickupnh = $_POST['pickUpNH'];
				$pickupp = $_POST['pickUpP'];
				// $dest = $_POST['Destination'];
				$destnh = $_POST['DestinationNH'];
				$destp = $_POST['DestinationP']; 

				$spostal1 = intval($pickupp) - 10;
				$spostal2 = intval($pickupp) + 10;
				$dpostal1 = intval($destp) - 10;
				$dpostal2 = intval($destp) + 10;

				$query = "SELECT * FROM ride WHERE sNHood = '".$pickupnh."' OR sPostal BETWEEN '".$spostal1."' AND '".$spostal2."' OR dNHood = '".$destnh."' OR dPostal BETWEEN '".$dpostal1."' AND '".$dpostal2."'";
				$result = pg_query($query);
				// if($pickup == ""){

				// 	$query = "SELECT * FROM ride WHERE ";
				// 	$result=pg_query($sql);
				// }
			}
			?>
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

