<?php 
function checkLoggedIn() {
    return isset($_SESSION['login_user']);
	
}



?>