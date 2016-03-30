<?php
	include("header.php");
	
?>

		
<title>Ride Offer</title>
<body>
<div id="layout">
<?php 

	
	$pageTitle = "Ride History";
	include("banner.php");
	include("navigation.php");
if (isset($_POST['regnum'])) {
	$model = $_POST['model'];
	$color = $_POST['color'];
	$make = $_POST['make'];
	$regnum = $_POST['regnum'];
	$numseat = $_POST['numseat'];
	$login_user = $_SESSION['login_user'];
	
	$sql = "INSERT INTO car VALUES ('" .$regnum. "'," .$numseat. ",'" .$model. "','" .$login_user. "','" .$color. "','" .$make. "');";
	$result=pg_query($sql);
	if ($result != false) {
		$isRegisterSuccessful = true;
	} else {
		$isRegisterSuccessful = false;
	}
}
?>
  <div id="container" class="box">
<div id="obsah" class="content box">
	<div class="inner cover">
		<!--Driver content here -->
			<p><strong>Register a car</strong></p>
			<form class="form-horizontal" action="carReg.php" method="post">

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="pickUp">Model of your car :</label>  
					<div class="col-md-4">
						<input id="pickUp" name="model" type="text" placeholder="" class="form-control input-md">
					</div>
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="Destination">Color :</label>  
					<div class="col-md-4">
						<input id="Destination" name="color" type="text" placeholder="" class="form-control input-md">
					</div>
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="Date">Make :</label>  
					<div class="col-md-4">
						<input id="Date" name="make" type="text" placeholder="" class="form-control input-md">
					</div>
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="startTime">Max. number of available seat :</label>  
					<div class="col-md-4">
						<input id="startTime" name="numseat" type="text" placeholder="" class="form-control input-md">
					</div>
				</div>
				
				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="cost">regnum</label>  
					<div class="col-md-4">
						<input id="cost" name="regnum" type="text" placeholder="" class="form-control input-md">
					</div>
				</div>

				<br>
				<input type="submit" value="Submit">
				<?php 
				if (isset($isRegisterSuccessful)) {
					if ($isRegisterSuccessful == true) {
						?>
						<font color="green">Registration is successful!!</font>
				<?php }	else if ($isRegisterSuccessful == false){?>
						<font color="red">Registration is unsuccessful!!</font>
						
				<?php }	
				}?>
			</form>

			
	</div>
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