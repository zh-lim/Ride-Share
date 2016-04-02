<?php
	include("header.php");	
echo "Transcation Complete!";
echo '<br/>';
?>

<?php     
$content=$_POST['content'];
$driver=$content[0];
$startTime=$content[1];
$date=$content[2];

$query1="SELECT p.name FROM passenger p WHERE p.rstart='$startTime' AND p.rdriver='$driver' AND p.rdate='$date';";
$result1 = pg_query($query1) or die('Error1!');
$arr=pg_fetch_all($result1);
$arrsize=sizeof($arr);

$query2="SELECT r.cost FROM ride r where r.date='$date' and r.starttime='$startTime' and r.driver='$driver';";
$result2 = pg_query($query2) or die('Error2!'.pg_last_error());
$costarr=pg_fetch_array($result2);
$cost=$costarr['cost'];

for ($i=0;$i<$arrsize;$i++)
{

$element=$arr[$i]["name"];

$query3="SELECT p.status FROM passenger p where p.name='".$element."' AND p.rstart='".$startTime."' AND p.rdriver='".$driver."' AND p.rdate='".$date."';";
$result3=pg_query($query3)or die('cannot find status');
$sarr=pg_fetch_array($result3);
$selement=$sarr['status'];


$query4="UPDATE ride SET status='F' where date='$date' and starttime='$startTime' and driver='$driver';";
$result4=pg_query($query4)or die('cannot find ride');

if($selement=='C')
{

//deduct and add balance
$query5="UPDATE account set balance =balance -'$cost' where username='$element' ;";
$result5=pg_query($query5)or die('cannot deduct balance');

$query6="UPDATE account set balance =balance +'$cost' where username='$driver' ;";
$result6=pg_query($query6)or die('cannot add balance');

$query8="INSERT INTO transaction values('$element','$driver','$startTime','$date','$cost');";
$result8=pg_query($query8)or die('cannot create transaction history.');

}
else 
{
echo "$element alreay paid";
echo '<br/>';
}
};//end of for loop
$query7="SELECT a.balance from account a where a.username='$driver';";
$result7=pg_query($query7) or die ('cannot update balance.');
$balancearr=pg_fetch_array($result7);
$_SESSION['balance']=$balancearr['balance'];


echo "<form action='rideDetails.php' method='POST'><input type = 'submit' name='whatever' value = 'Get Back'/></form>";

?>
