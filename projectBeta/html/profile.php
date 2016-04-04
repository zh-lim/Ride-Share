<?php
	include("header.php");	
?>
<script>
function switchToLogin() {
    document.getElementById('register-sidebar').style.display='none';
	document.getElementById('login-sidebar').style.display='block';         
}

function switchToRegister() {
    document.getElementById('register-sidebar').style.display='block';
	document.getElementById('login-sidebar').style.display='none';
	document.getElementById('logInMsg').style.display='none';
}

function switchToEditProf() {
    document.getElementById('edit-profile').style.display='block';
	document.getElementById('profile').style.display='none';
}

function switchToProf() {
    document.getElementById('profile').style.display='block';
	document.getElementById('edit-profile').style.display='none';
}
 </script>
<body>
	<div id="profileDisplay">
		<div id="profile" style="display:block">
			<h4 align="center" style="margin:0px">Welcome  <?php echo $_SESSION["login_user"]; ?></h4>
			<h3 align="center" style="margin:0px;font-size: 100%">Your Profile</h3>
			<p><B>First Name: </B><?php echo $_SESSION["First name"];?></p>
			<p><B>Last Name: </B><?php echo $_SESSION["Last name"];?></p>
			<p><B>Gender: </B><?php echo $_SESSION["gender"];?></p>
			<p><B>Birthday: </B><?php echo $_SESSION["birthday"];?></p>
			<p><B>License number: </B><?php echo $_SESSION["licenseNumber"];?></p>

			<p><B>Email: </B><?php echo $_SESSION["Email"];?></p>
			<p><B>Contact: </B><?php echo $_SESSION["contact"];?></p>
			<p><B>balance: </B><?php echo $_SESSION["balance"];?></p>
			<button name="Edit" value="Edit" onclick="switchToEditProf();"  style=" width:50px;margin-right: 10px"> Edit </button>
			
		</div>
		<form id="edit-profile" action="index.php" method="post" style="display:none">
			<label>UserName :</label>
			<input type="text" name="usernameRegister" value="<?php echo $_SESSION["login_user"]; ?>" readonly/><br />
			<label>Password :</label>
			<input type="password" name="passwordRegister" value="<?php echo $_SESSION["password"]; ?>"/><br/>
			<label>First Name: </label>				
			<input type="text" name="firstname" value="<?php echo $_SESSION["First name"]; ?>"/><br/>
			<label>Last Name: </label>
			<input type="text" name="lastname" value="<?php echo $_SESSION["Last name"]; ?>"/><br/>
			<label>Birthday: </label>
			<input type="text" name="birthday" value="<?php echo $_SESSION["Birthday"]; ?>" readonly/><br/>
			<label>License number: </label>
			<input type="text" name="licenseNum" value="<?php echo $_SESSION["licenseNumber"]; ?>"/><br/>
			<label>Email: </label>					
			<input type="text" name="email" value="<?php echo $_SESSION["Email"]; ?>"/><br/>
			<label>Contact: </label>
			<input type="text" name="contact" value="<?php echo $_SESSION["contact"]; ?>"/><br/>
			<label>Gender: </label><br/>
			<select name="gender">
				<?php if ($_SESSION["gender"] == 'F') { ?>						
					<option value="F" selected="selected">F</option>
					<option value="M">M</option>		
				<?php } else {?>					
					<option value="F">F</option>
					<option value="M" selected="selected">M</option>	
				<?php }?>
			</select>
			<br/><br/>
			<input type="submit" name="edit-submit" value="Confirm" />
			<button name="Edit" type="button" onclick="switchToProf();"  style="width:50px;margin-left: 10px"> Cancel </button>
			<br/>
		</form>
	</div>
	<?php 
/**************************************** Edit Profile*******************************************/
	if(isset($_SESSION['login_user'])){ 
		if (isset($_POST["edit-submit"]) && isset($_SESSION["First name"])){
			$_SESSION["First name"] = $_POST["firstname"];
			$_SESSION["Last name"] = $_POST["lastname"];
			$_SESSION["Email"] = $_POST["email"];
			$_SESSION["contact"] = $_POST["contact"];
			$_SESSION["licenseNumber"] = $_POST["licenseNum"];
			$_SESSION["gender"] = $_POST["gender"];
			$sql = "UPDATE account SET firstname='".$_SESSION["First name"]."', lastname='".$_SESSION["Last name"]."', email='".$_SESSION["Email"]."', contact='".$_SESSION["contact"]."', licensenum='".$_SESSION["licenseNumber"]."', gender='".$_SESSION["gender"]."'  WHERE username='".$_SESSION["login_user"]."';";
			$result=pg_query($_SESSION['database'],$sql);
		}
	}
	
/**************************************** Edit Profile End **************************************/
	?>
</body>
</html>