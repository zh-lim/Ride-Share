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
				<!--Passenger content here -->
				<div class="inner cover">
					
					<div id="container" class="box">
						<div id="obsah" class="content box">
							<div class="in">
								<div class="ism-slider" id="my-slider" style="height: 500px"><div class="ism-frame">
									<ol class="ism-slides" style="margin: 0px; width: 300%; perspective: 1000px; backface-visibility: hidden; transform: translateX(-1800px);">
										<?php 
										
										$sql = "SELECT * FROM ride";
						//echo $sql;
										$result=pg_query($sql);
										if ($result == false){
											echo "sql fail";
										} else
										{
											$row_counter = 0; 
											$ride_posted = 0;
											while ($row = pg_fetch_array($result, null,PGSQL_ASSOC)) { 
												if ($row_counter%6 == 0) { ?>
												<li class="ism-slide ism-slide-<?php echo $row_counter/6; ?>" style="width: 33.3333%; left: 0%;background-color:white">
													<?php } ?>
													<form action="passenger-submit.php" method="POST">
														<a href="#" onclick="jQuery(this).closest('form').submit()">
															<div style="z-index:6 ;margin: 10px;padding: 10px 10px 0 10px;float: left;text-align: left;border-radius: 3px;border-style:solid;border-width:2px;border-color:gray">
																<h4 align="center" style="margin:0px">From <?php echo $row["driver"];?></h4>										
																<p><B>Date: </B><?php echo $row["date"];?></p>
																<p><B>Time: </B><?php echo $row["starttime"];?></p>
																<p><B>Start Location: </B><?php echo $row["start"];?></p>
																<p><B>Destination: </B><?php echo $row["destination"];?></p>
																<p><B>Car: </B><?php echo $row["car"];?></p>
																<p><B>Available Seats: </B><?php echo $row["availSeats"];?></p>
																<p><B>Cost: </B><?php echo $row["cost"];?></p>
																<input type="hidden" name="driver" value="<?php echo $row["driver"]; ?>">
																<input type="hidden" name="date" value="<?php echo $row["date"]; ?>">
																<input type="hidden" name="starttime" value="<?php echo $row["starttime"]; ?>">
																<input type="hidden" name="start" value="<?php echo $row["start"]; ?>">
																<input type="hidden" name="destination" value="<?php echo $row["destination"]; ?>">
																<input type="hidden" name="car" value="<?php echo $row["car"]; ?>">
																<input type="hidden" name="availSeats" value="<?php echo $row["availSeats"]; ?>">
																<input type="hidden" name="cost" value="<?php echo $row["cost"]; ?>">
															</div> 
														</a>
													</form>
													<?php if ($ride_posted == 6) { 
														$ride_posted = 0;
														?>
													</li>
													<?php }
													$ride_posted++;
													$row_counter++; 
												} 
												if ($ride_posted != 0)
												{
													?>
												</li>
												<?php
											}
										}
										?>
										
										
    				<!--<li class="ism-slide ism-slide-2" style="width: 33.3333%; left: 66.6667%;">
						<div class="ism-img-frame"><img src="ism/image/slides/summer-192179_1280.jpg" class="ism-img"></div>
      					<div class="ism-caption ism-caption-0 ism-caption-anim" style="visibility: visible;">My slide caption text</div>
    				
      				</li>-->
      			</ol>
      		</div>

      	</div>			
      </div>
  </div>

  <div id="panel-right" class="box panel">
  	<div id="bottom">
  		<?php include("sidebar.php")?>
  	</div>
  </div>
  
</div>
<!--Driver content ends -->
</div>
</div>
</div>
</html>
