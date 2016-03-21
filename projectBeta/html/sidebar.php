<div class="in"> 	
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
<?php

$myusername;
$mypassword;
$isRegisterSuccessful = false;


if($_SERVER["REQUEST_METHOD"] == "POST")
{
	

	// username and password sent from Form
	$_SESSION['database'] = $db;
	if (isset($_POST["username"]) && isset($_POST["password"])) {
		$myusername=pg_escape_string($db,$_POST["username"]); 
		$mypassword=pg_escape_string($db,$_POST["password"]); 
	
		$sql="SELECT lastname FROM account WHERE username='".$myusername."' and password='".$mypassword."'";
		$result=pg_query($db,$sql) or die('Query failed: ' . pg_last_error());

		// If result matched $myusername and $mypassword, table row must be 1
		if(pg_num_rows($result)==1)
		{
			$row= pg_fetch_array($result);
			$_SESSION['login_user']=$myusername;
			$_SESSION['password']= $mypassword;
			echo "<h3 id = 'logInMsg'>Logged In Successfully!</h3>";
		}
		else 
		{
			$error="User name does not exist or password is incorrect!";
			echo "<h3 id = 'logInMsg'>" .$error . "</h3>";
		}
		
	} else if (isset($_POST['usernameRegister']) && isset($_POST['passwordRegister']) && !isset($_POST['Edit']) && !isset($_POST['edit-submit'])){
		$username = pg_escape_string($_POST["usernameRegister"]);
		$password = pg_escape_string($_POST["passwordRegister"]);
		$firstname = pg_escape_string($_POST["firstname"]);
		$lastname = pg_escape_string($_POST["lastname"]);
		//$_POST[endTime];
		$licensenum = pg_escape_string($_POST["licenseNum"]);
		$email = pg_escape_string($_POST["email"]);
		$birthday = pg_escape_string($_POST["birthday"]);
		$contact = pg_escape_string($_POST["contact"]);
		$gender = pg_escape_string($_POST["gender"]);
		
		$sql = "INSERT INTO account VALUES ('" .$_POST['usernameRegister']. "','" .$_POST['firstname']. "','" .$_POST['lastname']. "','" .$_POST['licenseNum']. "','" .$_POST['email']. "','" .$_POST['birthday']. "','" .$_POST['passwordRegister']. "', 0,'" .$_POST['contact']. "','" .$_POST['gender']. "');";
		$result=pg_query($sql);
		if ($result != false) {
			$isRegisterSuccessful = true;
		}
	}
}
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
	if (!isset($_SESSION["First name"])) {		
		$sql = "SELECT * FROM account WHERE username='".$_SESSION["login_user"]."';";
		$result=pg_query($_SESSION['database'],$sql);
		$row=pg_fetch_array($result);
		$_SESSION["First name"] = $row["firstname"];
		$_SESSION["Last name"] = $row["lastname"];
		$_SESSION["Email"] = $row["email"];
		$_SESSION["contact"] = $row["contact"];
		$_SESSION["licenseNumber"] = $row["licensenum"];
		$_SESSION["balance"] = $row["balance"];
		$_SESSION["gender"] = $row["gender"];
		$_SESSION["birthday"] = $row["birthday"];
	}
?>
			
			<div id="profile" style="display="block">
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
				<button name="Edit" value="Edit" onclick="switchToEditProf();"  style="float:left; width:50px;margin-right: 10px"> Edit </button>
				<form action="logout.php" method="post">
					<input type="submit" value=" Logout "/><br />
				</form>
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
				<input type="submit" name="edit-submit" value="Confirm" style="float:left"/>
				<button name="Edit" type="button" onclick="switchToProf();"  style="float:left; width:50px;margin-left: 10px"> Cancel </button>
				<br/>
			</form>
<?php }else{ ?>
			<form id="login-sidebar" action="index.php" method="post">
				<label>UserName :</label>
				<input type="text" name="username"/><br />
				<label>Password :</label>
				<input type="password" name="password"/><br/>
				<br/>
				<input type="submit" value=" Submit "/>
				<a onclick="switchToRegister();" style="float:right">Register -></a>
				<?php 
					if ($isRegisterSuccessful == true) {				
						echo "<p>Your registration is successful!!</p>";
					}
				?>
			</form>
			
			<form id="register-sidebar" action="index.php" method="post" style="display:none">
				<label>UserName :</label>
				<input type="text" name="usernameRegister"/><br />
				<label>Password :</label>
				<input type="password" name="passwordRegister"/><br/>
				<label>First Name: </label>				
				<input type="text" name="firstname"/><br/>
				<label>Last Name: </label>
				<input type="text" name="lastname"/><br/>
				<label>Birthday: (e.g. 01 Dec 2015)</label>
				<input type="date" name="birthday"/><br/>
				<label>License number: </label>
				<input type="text" name="licenseNum" pattern=".{9,9}"/><br/>
				<label>Email: </label>
				<input type="email" name="email"/><br/>
				<label>Contact: </label>
				<input type="text" name="contact" pattern=".{6,8}"/><br/>
				<label>Gender: </label><br/>
				<select name="gender">
					<option value="F">F</option>
					<option value="M">M</option>
				</select>
				<br/><br/>
				<input type="submit" value=" Submit "/>
				<a onclick="switchToLogin();" style="float:right">Login -></a>
			</form>
	
<?php	} ?> 	
</div>