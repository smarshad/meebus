<?php
session_start();
ob_start();
include_once('../database/connect.php');
$id = $_SESSION['last_insert_id'];
$eotp = $_GET['eotp']; 
$motp = $_GET['motp']; 

//$selectD = "SELECT * FROM user_login WHERE id='$id' AND otp='$motp' AND email_otp='$eotp' AND Status='0'";
$selectD = "SELECT * FROM aff_login WHERE id='$id' AND otp='$motp' AND status='0'";
$queryD = mysql_query($selectD);
$num_rows = mysql_num_rows($queryD);

if($num_rows==1)
{
	$updateS  = "UPDATE aff_login SET  status = '1' WHERE id = '$id'";
	$updateQuery - mysql_query($updateS);
	echo '1';
}
else 
{
	echo '0';	
}

?>