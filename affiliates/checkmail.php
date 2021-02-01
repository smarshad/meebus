<?php
session_start();
ob_start();
include_once('../database/connect.php');
$email_id = $_GET['q'];
$_SESSION['block_e']='0';
if(!isset($_SESSION['block_m']))
{
	$_SESSION['block_m']='0';	
}

$email = $email_id;
$_SESSION['block_e'].' --- '.$_SESSION['block_m'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
{

$selectD = "SELECT * FROM aff_login WHERE email='".$email_id."'";
$queryD = mysql_query($selectD);
$num_rows = mysql_num_rows($queryD);
if($num_rows==0) 
	{
		$_SESSION['block_e']='1';
		if($_SESSION['block_e']=='1' && $_SESSION['block_m']=='1') 
		{
			
			echo "available";
		}
		else 
		{
			$_SESSION['block_e']='1';
			echo "Email Ok";
		}
	} 
else
{
	$_SESSION['block_e']='0';
	echo "Not Available";	
}	
} 
else 
{
	$_SESSION['block_e']='0';
	echo "not valid";
}


?>