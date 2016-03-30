<?php 
if (isset($_POST['usernameRegister']) && isset($_POST['passwordRegister']) && !isset($_POST['Edit']) && !isset($_POST['edit-submit'])){
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
	
	$sql = "INSERT INTO \"public\".\"account\" (\"username\",\"firstname\",\"lastname\",\"licensenum\",\"email\",\"birthday\",\"password\",\"balance\",\"contact\",\"gender\")
			VALUES ('".$username."','".$firstname."','".$lastname."','".$licensenum."','".$email."','".$birthday."','".$password."', 0,'".$contact."','".$gender."');";
	//echo $sql;
	$result=pg_query($sql);
	if ($result != false) {
		?>
		<p>Register is successful</p>
		
		<?php
	}

?>