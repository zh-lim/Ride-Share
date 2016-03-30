<?php
if (checkLoggedIn) {
	if (!isset($_SESSION["First name"])) {			
		$sql = "SELECT * FROM account WHERE username='".$_SESSION["login_user"]."';";
		$result=pg_query($_SESSION['database'],$sql);
		$row=pg_fetch_array($result, null, MYSQLI_ASSOC);
		$_SESSION["First name"] = $row["firstname"];
		$_SESSION["Last name"] = $row["lastname"];
		$_SESSION["Email"] = $row["email"];
		$_SESSION["contact"] = $row["contact"];
		$_SESSION["licenseNumber"] = $row["licensenum"];
		$_SESSION["balance"] = $row["balance"];
		$_SESSION["gender"] = $row["gender"];
	} ?> 

<div id="profile" style="display="block">
	<h4 align="center" style="margin:0px">Wecome  <?php echo $_SESSION["login_user"]; ?></h4>
	<h3 align="center" style="margin:0px;font-size: 100%">Your Profile</h3>
	<p><B>First Name: </B><?php echo $_SESSION["First name"];?></p>
	<p><B>Last Name: </B><?php echo $_SESSION["Last name"];?></p>
	<p><B>Gender: </B><?php echo $_SESSION["gender"];?></p>
	<p><B>Birthday: </B><?php echo $_SESSION["Birthday"];?></p>
	<p><B>License number: </B><?php echo $_SESSION["licenseNumber"];?></p>
	<!--<p><B>Contact: </B><?php //echo $_SESSION["Contact"];?></p>-->
	<p><B>Email: </B><?php echo $_SESSION["Email"];?></p>
	<p><B>Contact: </B><?php echo $_SESSION["contact"];?></p>
	<p><B>balance: </B><?php echo $_SESSION["balance"];?></p>
	<a href="edit-profile.php"><button name="Edit" value="Edit" style="float:left; width:50px;margin-right: 10px"> Edit </button></a>
</div>
<?php
} else {
	header( 'Location: index.php' );
}
?>