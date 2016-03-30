<?php 
if (checkLoggedIn) { ?> 
	<form id="edit-profile" action="edit-profile-sumbitted.php" method="post" style="display:none">
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
	<input type="submit" name="edit-submit" value="Confirm" style="float:left"/>
	<a href="profile.php"><button name="Edit" type="button" style="float:left; width:50px;margin-left: 10px">Go back</button></a>
	<br/>
</form>

<?php } ?>