<?php
session_start(); 
ob_start(); 
if(isset($_SESSION['user']['pass'])){
	$pass=$_SESSION['user']['pass'];
}
else{
	$pass='';
}
if($pass!=''){
	$_SESSION['user']['pass']=$pass;
}

include('config.php');
$google_client->revokeToken();
session_destroy();
header('location:index.php');
?>