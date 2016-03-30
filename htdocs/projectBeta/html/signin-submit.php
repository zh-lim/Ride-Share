<?php 
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
		$_SESSION['password']= $mypassword;
		//header("location: index.php");
		echo "Your Login is successful.";
	}
	else 
	{
		//$error="Your Login Name or Password is invalid";
		echo "Your Login Name or Password is invalid";
	}
} 
?>