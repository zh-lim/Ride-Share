<?php
include("config.php");
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from Form
$myusername=mysqli_real_escape_string($db,$_POST['username']); 
$mypassword=mysqli_real_escape_string($db,$_POST['password']); 

$sql="SELECT `Last name` FROM `users` WHERE `User name`='$myusername' and `Password`='$mypassword'";
$result=mysqli_query($db,$sql);

$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
//$active=$row['active'];
$count=mysqli_num_rows($result);


// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
{
//session_register("myusername");
$_SESSION['login_user']=$myusername;

header("location: welcome.php");
}
else 
{
$error="Your Login Name or Password is invalid";
}
}

?>


<form action="index.php" method="post">
<label>UserName :</label>
<input type="text" name="username"/><br />
<label>Password :</label>
<input type="password" name="password"/><br/>
<input type="submit" value=" Submit "/><br />
</form>
site templates</a></div></body>
</html>
