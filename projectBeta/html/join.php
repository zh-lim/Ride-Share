<?php
session_start();
if(isset($_POST['joinride'])){
	$string = $_POST['joinride'];
	$parts = explode(",", $string);
	$query = "INSERT INTO passenger VALUES('".$_SESSION['login_user']."','".$parts[0]."','".$parts[2]."','".$parts[1]."','P');";
	echo $query;
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
}
?>