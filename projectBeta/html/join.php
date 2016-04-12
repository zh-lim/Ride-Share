 
<?php
include("config.php");
session_start();
if(isset($_POST['joinride'])){
	$string = $_POST['joinride'];
	$parts = explode(",", $string);
	$sql = "INSERT INTO passenger VALUES('".$_SESSION['login_user']."','".$parts[0]."','".$parts[2]."','".$parts[1]."','P');";
	echo $sql;
	$result = pg_query($sql) or die('Query failed: ' . pg_result_error());
	header("Location: index.php");
}
?>