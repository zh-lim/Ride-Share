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
							<p><strong>Post Ride Details</strong></p>
							<form class="form-horizontal" action="driver-submitted.php" method="post">

									<!-- Text input-->
									<div class="form-group">
										<label class="col-md-4 control-label" for="pickUp">Pick up location</label>  
										<div class="col-md-4">
											<input id="pickUp" name="pickUp" type="text" placeholder="" class="form-control input-md">
										</div>
									</div>

									<!-- Text input-->
									<div class="form-group">
										<label class="col-md-4 control-label" for="Destination">Destination</label>  
										<div class="col-md-4">
											<input id="Destination" name="Destination" type="text" placeholder="" class="form-control input-md">
										</div>
									</div>

									<!-- Text input-->
									<div class="form-group">
										<label class="col-md-4 control-label" for="Date">Date (e.g. 01 Dec 2016)</label>  
										<div class="col-md-4">
											<input id="Date" name="Date" type="text" placeholder="" class="form-control input-md">
										</div>
									</div>

									<!-- Text input-->
									<div class="form-group">
										<label class="col-md-4 control-label" for="startTime">Start time (e.g. 09:15)</label>  
										<div class="col-md-4">
											<input id="startTime" name="startTime" type="text" placeholder="" class="form-control input-md">
										</div>
									</div>

									<!-- Text input-->
									<div class="form-group">
										<label class="col-md-4 control-label" for="seatNum">Available seat</label>  
										<div class="col-md-4">
											<input id="seat" name="seatNum" type="text" placeholder="" class="form-control input-md"> 
										</div>
									</div>

									<!-- Text input-->
									<div class="form-group">
										<label class="col-md-4 control-label" for="cost">cost ($)</label>  
										<div class="col-md-4">
											<input id="cost" name="cost" type="text" placeholder="" class="form-control input-md">
										</div>
									</div>

									<!-- Textarea -->
									<div class="form-group">
										<label class="col-md-4 control-label" for="car">Car Description</label>
										<div class="col-md-4">                     
											<textarea class="form-control" id="car" name="car" style="margin: 0px; width: 275px; height: 87px;">Provide some words to passengers to identify your car... </textarea>
										</div>
									</div>
									<input type="submit" value="Submit">
							</form>

						
				</div>
				<!--Driver content ends -->
			</div>
		</div>
	</div>
	</html>
