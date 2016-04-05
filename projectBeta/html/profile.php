<?php
	include("header.php");	
	$_SESSION['database'] = $db;
	if (!isset($_SESSION["First name"])) {		
		$sql = "SELECT * FROM account WHERE username='".$_SESSION["login_user"]."';";
		$result=pg_query($_SESSION['database'],$sql);
		$row=pg_fetch_array($result);
		$_SESSION["First name"] = $row["firstname"];
		$_SESSION["Last name"] = $row["lastname"];
		$_SESSION["Email"] = $row["email"];
		$_SESSION["contact"] = $row["contact"];
		$_SESSION["licenseNumber"] = $row["licensenum"];
		$_SESSION["balance"] = $row["balance"];
		$_SESSION["gender"] = $row["gender"];
		$_SESSION["birthday"] = $row["birthday"];
	}
?>
<script>
function switchToEdit() {
    document.getElementById('carDisplay').style.display='none';
	document.getElementById('editCar').style.display='block';
}

function cancelEdit() {
    document.getElementById('editCar').style.display='none';
	document.getElementById('carDisplay').style.display='block';
}

function switchToLogin() {
    document.getElementById('register-sidebar').style.display='none';
	document.getElementById('login-sidebar').style.display='block';         
}

function switchToRegister() {
    document.getElementById('register-sidebar').style.display='block';
	document.getElementById('login-sidebar').style.display='none';
	document.getElementById('logInMsg').style.display='none';
}

function switchToEditProf() {
    document.getElementById('edit-profile').style.display='block';
	document.getElementById('profile').style.display='none';
}

function switchToProf() {
    document.getElementById('profile').style.display='block';
	document.getElementById('edit-profile').style.display='none';
}
 </script>
	<div id="profileDisplay">
		<div id="profile" style="display:block">
			<h4 align="center" style="margin:0px">Welcome  <?php echo $_SESSION["login_user"]; ?></h4>
			<h3 align="center" style="margin:0px;font-size: 100%">Your Profile</h3>
			<p><B>First Name: </B><?php echo $_SESSION["First name"];?></p>
			<p><B>Last Name: </B><?php echo $_SESSION["Last name"];?></p>
			<p><B>Gender: </B><?php echo $_SESSION["gender"];?></p>
			<p><B>Birthday: </B><?php echo $_SESSION["birthday"];?></p>
			<p><B>License number: </B><?php echo $_SESSION["licenseNumber"];?></p>

			<p><B>Email: </B><?php echo $_SESSION["Email"];?></p>
			<p><B>Contact: </B><?php echo $_SESSION["contact"];?></p>
			<p><B>balance: </B><?php echo $_SESSION["balance"];?></p>
			<button name="Edit" value="Edit" onclick="switchToEditProf();"  style=" width:50px;margin-right: 10px"> Edit </button>
			
		</div>
		<form id="edit-profile" action="index.php" method="post" style="display:none">
			<label>UserName :</label>
			<input type="text" name="usernameRegister" value="<?php echo $_SESSION["login_user"]; ?>" readonly/><br />
			<label>Password :</label>
			<input type="password" name="passwordRegister" value="<?php echo $_SESSION["password"]; ?>"/><br/>
			<label>First Name: </label>				
			<input type="text" name="firstname" value="<?php echo $_SESSION["First name"]; ?>"/><br/>
			<label>Last Name: </label>
			<input type="text" name="lastname" value="<?php echo $_SESSION["Last name"]; ?>"/><br/>
			<label>Birthday: </label>
			<input type="text" name="birthday" value="<?php echo $_SESSION["Birthday"]; ?>" readonly/><br/>
			<label>License number: </label>
			<input type="text" name="licenseNum" value="<?php echo $_SESSION["licenseNumber"]; ?>"/><br/>
			<label>Email: </label>					
			<input type="text" name="email" value="<?php echo $_SESSION["Email"]; ?>"/><br/>
			<label>Contact: </label>
			<input type="text" name="contact" value="<?php echo $_SESSION["contact"]; ?>"/><br/>
			<label>Gender: </label><br/>
			<select name="gender">
				<?php if ($_SESSION["gender"] == 'F') { ?>						
					<option value="F" selected="selected">F</option>
					<option value="M">M</option>		
				<?php } else {?>					
					<option value="F">F</option>
					<option value="M" selected="selected">M</option>	
				<?php }?>
			</select>
			<br/><br/>
			<input type="submit" name="edit-submit" value="Confirm" />
			<button name="Edit" type="button" onclick="switchToProf();"  style="width:50px;margin-left: 10px"> Cancel </button>
			<br/>
		</form>
	</div>
	<?php 
/**************************************** Edit Profile*******************************************/
	if(isset($_SESSION['login_user'])){ 
		if (isset($_POST["edit-submit"]) && isset($_SESSION["First name"])){
			$_SESSION["First name"] = $_POST["firstname"];
			$_SESSION["Last name"] = $_POST["lastname"];
			$_SESSION["Email"] = $_POST["email"];
			$_SESSION["contact"] = $_POST["contact"];
			$_SESSION["licenseNumber"] = $_POST["licenseNum"];
			$_SESSION["gender"] = $_POST["gender"];
			$sql = "UPDATE account SET firstname='".$_SESSION["First name"]."', lastname='".$_SESSION["Last name"]."', email='".$_SESSION["Email"]."', contact='".$_SESSION["contact"]."', licensenum='".$_SESSION["licenseNumber"]."', gender='".$_SESSION["gender"]."'  WHERE username='".$_SESSION["login_user"]."';";
			$result=pg_query($_SESSION['database'],$sql);			
		}
/**************************************** Edit Profile End **************************************/
/**************************************** Car Table edit Process **************************************/
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["car-edit-submit"])) {
			for ($i = 1; $i<=$_SESSION['carCount']; $i++) {
				$regnum = "regnum".$i;
				$numseat = "numseat".$i;
				$model = "model".$i;
				$color = "color".$i;
				$make = "make".$i;
				$sql = "UPDATE car SET numseat='".$_POST[$numseat]."', model='".$_POST[$model]."', color='".$_POST[$color]."', make='".$_POST[$make]."' WHERE regnum='".$_POST[$regnum]."'";
				//echo $sql;
				$result=pg_query($_SESSION['database'],$sql);
			}
			
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			for ($i = 1; $i<=$_SESSION['carCount']; $i++) {
				$submitName = 'car-remove-submit-'.$i;
				if (isset($_POST[$submitName])) {
					$regnum = "regnum".$i;
					$sql = "DELETE FROM ride WHERE car='".$_POST[$regnum]."'";
					echo $sql;
					$result=pg_query($_SESSION['database'],$sql);
					$sql = "DELETE FROM car WHERE regnum='".$_POST[$regnum]."'";
					$result=pg_query($_SESSION['database'],$sql);
					
				}
			}
		}
/**************************************** Car Table part **************************************/
		$sql = "SELECT * FROM car WHERE owner = '".$_SESSION['login_user']."';";
		$result=pg_query($_SESSION['database'],$sql);
		?>
		<div align="center" id="editCar" style="display:none">
			<form action="profile.php" method="POST">
				<Table style="width:50%" cellspacing="0" border="1">
					<tr>
						<td>Registration Number</td>
						<td>Number of seat</td>
						<td>Model</td>
						<td>Colour</td>
						<td>Make</td>
					</tr>
				<?php 
				$count = 0;
				while ($row=pg_fetch_array($result)) {
					$count = $count+1;
					$rowid = "row".$count;
					echo '<tr>';
					echo '<td><input type="text" id="'.$rowid.'" name="regnum'.$count.'" value="'.$row["regnum"].'" readonly/></td>';
					echo '<td><input type="text" id="'.$rowid.'" name="numseat'.$count.'" value="'.$row["numseat"].'"></td>';
					echo '<td><input type="text" id="'.$rowid.'" name="model'.$count.'" value="'.$row["model"].'"></td>';
					echo '<td><input type="text" id="'.$rowid.'" name="color'.$count.'" value="'.$row["color"].'"></td>';
					echo '<td><input type="text" id="'.$rowid.'" name="make'.$count.'" value="'.$row["make"].'"></td>';
					echo '<td><input type="submit" name="car-remove-submit-'.$count.'" value="Remove"></td>';
					echo '</tr>';
				}
				$_SESSION['carCount'] = $count;
				?>
				
				</Table>
				<div>
					<input type="submit" name="car-edit-submit" value="Submit">
					<button onclick="cancelEdit()" >Cancel</button>
				</div>
			</form>
		</div>
		<div id="carDisplay" align="center" style="display:block">
			<Table style="width:50%;" cellspacing="0" border="1">
				<tr>
					<td>Registration Number</td>
					<td>Number of seat</td>
					<td>Model</td>
					<td>Colour</td>
					<td>Make</td>
				</tr>
			<?php
			$count = 0;
			$sql = "SELECT * FROM car WHERE owner = '".$_SESSION['login_user']."';";
			$result=pg_query($_SESSION['database'],$sql);
			while ($row=pg_fetch_array($result)) {
				$count = $count+1;
				$rowid = "row".$count;
				echo '<tr>';
				echo '<td>'.$row["regnum"].'</td>';
				echo '<td>'.$row["numseat"].'</td>';
				echo '<td>'.$row["model"].'</td>';
				echo '<td>'.$row["color"].'</td>';
				echo '<td>'.$row["make"].'</td>';
				echo '</tr>';
			}
			?>			
			</Table>
			<div>
				<button onclick="switchToEdit()" >Edit</button>
			</div>
		</div>
		<?php
	}	
?>