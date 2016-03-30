<?php	
include("config.php");
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
				
					<?php 
						if (checkLoggedIn()) {
							//header( 'Location: index.php' );
						} else {
					?>

					<form id="register-sidebar" action="register-submit.php" method="post" >
						<label>UserName :</label>
						<input type="text" name="usernameRegister"/><br />
						<label>Password :</label>
						<input type="password" name="passwordRegister"/><br/>
						<label>First Name: </label>				
						<input type="text" name="firstname"/><br/>
						<label>Last Name: </label>
						<input type="text" name="lastname"/><br/>
						<label>Birthday: (e.g. 01 Dec 2015)</label>
						<input type="text" name="birthday"/><br/>
						<label>License number: </label>
						<input type="text" name="licenseNum"/><br/>
						<label>Email: </label>
						<input type="text" name="email"/><br/>
						<label>Contact: </label>
						<input type="text" name="contact"/><br/>
						<label>Gender: </label><br/>
						<select name="gender">
							<option value="F">F</option>
							<option value="M">M</option>
						</select>
						<br/><br/>
						<input type="submit" value=" Submit "/>
						<a href="signin.php" style="float:right">Login</a>
					</form>

				<?php } ?>
				</div>
      		</div>

      	</div>			
    </div>  
</body>

