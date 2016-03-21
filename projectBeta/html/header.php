<?php	
include("config.php");
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
<head>
<link rel="stylesheet" href="css/my-slider.css">
<link href="screen.css" type="text/css" rel="stylesheet" media="screen,projection" />
<style>
body { background-color: #fff; color: #000; padding: 0; margin: 0; }
.container { width: 1500px; margin: auto; padding-top: 1em; }
.container .ism-slider { margin-left: auto; margin-right: auto; }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
         $('#rideLink').click(function() {
              $.post("passenger-submit.php", { n: "203000"} );
         });
    });
</script>
<link rel="stylesheet" href="ism/css/my-slider.css">
<script src="ism/js/ism-2.1.js"></script>
</head>
<?php
	$updateStatement = "UPDATE ride SET status = 'E' WHERE starttime <= CURRENT_TIME AND date <= CURRENT_DATE;";
	$result = pg_query($updateStatement) or die('Query failed: ' . pg_last_error());
?>

