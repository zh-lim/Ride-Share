<div class="in"> 	
<script>
function switchToLogin() {
    document.getElementById('register-sidebar').style.display='none';
	document.getElementById('login-sidebar').style.display='block';         
}

function switchToRegister() {
    document.getElementById('register-sidebar').style.display='block';
	document.getElementById('login-sidebar').style.display='none';
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
	if (isset($_POST['username']) && isset($_POST['password'])) {
		
		$myusername=pg_escape_string($db,$_POST['username']); 
		$mypassword=pg_escape_string($db,$_POST['password']); 
	
		$sql="SELECT lastname FROM account WHERE username='".$myusername."' and password='".$mypassword."'";
		//$result=mysqli_query($db,$sql);
		$result=pg_query($db,$sql) or die('Query failed: ' . pg_last_error());
	
		$row= pg_fetch_array($result, null, MYSQLI_ASSOC);
		//$active=$row['active'];
		$count=pg_num_rows($result);


		// If result matched $myusername and $mypassword, table row must be 1 row
		if($count==1)
		{
			//session_register("myusername");
			$_SESSION['login_user']=$myusername;

			//header("location: index.php");
		}
		else 
		{
			$error="Your Login Name or Password is invalid";
		}
	} else if (isset($_POST['usernameRegister']) && isset($_POST['passwordRegister'])){
		$username = pg_escape_string($_POST["usernameRegister"]);
		$password = pg_escape_string($_POST["passwordRegister"]);
		$firstname = pg_escape_string($_POST["firstname"]);
		$lastname = pg_escape_string($_POST["lastname"]);
		//$_POST[endTime];
		$licensenum = pg_escape_string($_POST["licenseNum"]);
		$email = pg_escape_string($_POST["email"]);
		$birthday = pg_escape_string($_POST["birthday"]);
		
		$sql = "INSERT INTO \"public\".\"account\" (\"username\",\"firstname\",\"lastname\",\"licensenum\",\"email\",\"birthday\",\"password\")
				VALUES ('".$username."','".$firstname."','".$lastname."','".$licensenum."','".$email."','".$birthday."','".$password."');";
		//echo $sql;
		$result=pg_query($sql);
		if ($result != false) {
			$isRegisterSuccessful = true;
		}
	}
}
if(isset($_SESSION['login_user'])){ 
	if (!isset($_SESSION["First name"])) {			
		$sql = "SELECT * FROM account WHERE username='".$_SESSION["login_user"]."';";
		$result=pg_query($_SESSION['database'],$sql);
		$row=pg_fetch_array($result, null, MYSQLI_ASSOC);
		$_SESSION["First name"] = $row["firstname"];
		$_SESSION["Last name"] = $row["lastname"];
		$_SESSION["Birthday"] = $row["birthday"];
		$_SESSION["Email"] = $row["email"];
		//$_SESSION["Contact"] = $row["Contact"];
		$_SESSION["licenseNumber"] = $row["licensenum"];
	}
?>
			
			<div>
				<h4 align="center" style="margin:0px">Wecome  <?php echo $_SESSION["login_user"]; ?></h4>
				<h3 align="center" style="margin:0px;font-size: 100%">Your Profile</h3>
				<p><B>First Name: </B><?php echo $_SESSION["First name"];?></p>
				<p><B>Last Name: </B><?php echo $_SESSION["Last name"];?></p>
				<p><B>Birthday: </B><?php echo $_SESSION["Birthday"];?></p>
				<p><B>License number: </B><?php echo $_SESSION["licenseNumber"];?></p>
				<!--<p><B>Contact: </B><?php //echo $_SESSION["Contact"];?></p>-->
				<p><B>Email: </B><?php echo $_SESSION["Email"];?></p>
				<form action="logout.php" method="post">
					<input type="submit" value=" Logout "/><br />
				</form>
			</div>
<?php	} else { ?>
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
				?>					
						<p>Your registration is successful!!</p>
				<?php	}	?>
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
				<label>Birthday: </label>
				<input type="text" name="birthday"/><br/>
				<label>License number: </label>
				<input type="text" name="licenseNum"/><br/>
				<label>Email: </label>
				<input type="text" name="email"/><br/>
				<br/>
				<input type="submit" value=" Submit "/>
				<a onclick="switchToLogin();" style="float:right">Login -></a>
			</form>
	
<?php	} ?> 	
        </div>