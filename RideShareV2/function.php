<?php 
function checkLoggedIn() {
    if(isset($_SESSION['login_user'])){
		return false;
	} else {
		return true;
	}
}



?>