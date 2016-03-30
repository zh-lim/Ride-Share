<?php 
if (checkLoggedIn) { 
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
	if ($result != false){
		?> 
		echo "Edited successfully";
	<?php }
}
?>