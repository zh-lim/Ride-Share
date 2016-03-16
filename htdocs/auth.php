<?php
$host="localhost"; // Host name
$username="postgres"; //username
$password="2102"; // password
$db_name="postgres"; // Database name
$tbl_name="account"; // Table name

// Connect to server and select databse.
$dbconn = pg_connect("host=$host port=5432 dbname=$db_name user=$username
password=$password")
or die('Could not connect: ' . pg_last_error());


// username and password sent from form
$Email= pg_escape_string($_POST['Email']);
//echo $Email . " count returned.\n";
$Password=pg_escape_string($_POST['Password']);

$query="SELECT * FROM $tbl_name WHERE email='$Email' and password='$Password'";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Mysql_num_row is counting table row
$count=pg_num_rows($result);
echo $count;
}
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("Email");
session_register("Password");
header("location:login_success.php");
}
else {
echo "Wrong Username or Password";
}
pg_close($dbconn);
?>
