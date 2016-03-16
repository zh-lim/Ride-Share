<?php
session_start();
if(!session_is_registered(Email)){
header("location:signin.php");
}
?>

<html>
<body>
Login Successful
</body>
</html>