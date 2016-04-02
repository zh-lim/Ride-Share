<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
<head>
<title>SimpleEvent</title>
<link href="screen.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>
<?php
	
include("config.php");
session_start();
?>

<body>
<div id="layout">
  <div id="header">
    <h1 id="logo"><a href="http://all-free-download.com/free-website-templates/">SimpleEvent</a></h1>
    <span id="slogan">Your slogan goes here</span>
    <hr class="noscreen" />
    <p class="noscreen noprint"> <em>Rychlá navigace: <a href="http://all-free-download.com/free-website-templates/">obsah</a>, <a href="http://all-free-download.com/free-website-templates/">navigace</a>.</em></p>
    <div id="quicknav"> <a href="http://all-free-download.com/free-website-templates/">Home</a> <a href="http://all-free-download.com/free-website-templates/">Contact</a> <a href="http://all-free-download.com/free-website-templates/">Sitemap</a> </div>
    <div id="search">
      <form href="http://all-free-download.com/free-website-templates/" method="post">
        <fieldset>
        <input type="text" id="phrase" name="phrase" value="search phrase" onfocus="if(this.value=='search phrase')this.value=''" />
        <input type="submit" id="submit" value="SEARCH" />
        </fieldset>
      </form>
    </div>
  </div>
  <hr class="noscreen" />
  <div id="nav" class="box">
    <ul>
      <li id="active"><a href="index.php">Home</a></li>
      <li><a href="driver.php">I am a Driver</a></li>
      <li><a href="passenger.php">I am a Passenger</a></li>
      <!--li><a href="http://all-free-download.com/free-website-templates/">Portfolio</a></li>
      <li><a href="http://all-free-download.com/free-website-templates/" class="nosep">Contacts</a></li>-->
    </ul>
    <hr class="noscreen" />
  </div>
  <div id="container" class="box">
    <div id="obsah" class="content box">
		<div class="in">
			<form class="form-horizontal" action="driver-submitted.php" method="post">
				<fieldset>

					<!-- Form Name -->
					<legend>Post your trip</legend>

					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="pickUp">Pick up location</label>  
						<div class="col-md-4">
							<input id="pickUp" name="pickUp" type="text" placeholder="" class="form-control input-md">
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group">
  					<label class="col-md-4 control-label" for="Destination">Destination</label>  
						<div class="col-md-4">
							<input id="Destination" name="Destination" type="text" placeholder="" class="form-control input-md">
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="Date">Date (e.g. 01 Dec 2016)</label>  
						<div class="col-md-4">
							<input id="Date" name="Date" type="text" placeholder="" class="form-control input-md">
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="startTime">Start time (e.g. 09:15)</label>  
						<div class="col-md-4">
							<input id="startTime" name="startTime" type="text" placeholder="" class="form-control input-md">
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="seatNum">Available seat</label>  
						<div class="col-md-4">
							<input id="seat" name="seatNum" type="text" placeholder="" class="form-control input-md"> 
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="cost">cost ($)</label>  
						<div class="col-md-4">
							<input id="cost" name="cost" type="text" placeholder="" class="form-control input-md">
						</div>
					</div>

					<!-- Textarea -->
					<div class="form-group">
						<label class="col-md-4 control-label" for="car">Car Description</label>
						<div class="col-md-4">                     
							<textarea class="form-control" id="car" name="car" style="margin: 0px; width: 275px; height: 87px;">Provide some words to passengers to identify your car... </textarea>
						</div>
					</div>
					<input type="submit" value="Submit">

				</fieldset>
			</form>

		</div>
    </div>
    <div id="panel-right" class="box panel">
		<div id="bottom">
			<?php include("sidebar.php")?>
		</div>
    </div>
  </div>
</div>
<div id="footer">
  <div id="foot">
    <div id="page-bottom"> <a href="#header">Go up</a> </div>
    <p class="f-left">&copy; 2008 - <a href="http://all-free-download.com/free-website-templates/">SimpleEvent</a></p>
    <p class="f-right"><a href="http://www.tvorimestranky.cz" id="webdesign">Webdesign</a>: <a href="http://www.tvorimestranky.cz">TvorimeStranky.cz</a> | Sponsored by: <a href="http://www.topas-tachlovice.cz/topas-tachlovice.aspx">Tachlovice</a></p>
  </div>
</div>
<div align=center>This template  downloaded form <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></body>
</html>
