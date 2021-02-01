<?php 
include 'server/server.php';
include 'includes/pdo_functions.php';
$obj=new user_module($con);
$user_id=$_SESSION['user']['log']['id'];
$res=$obj->getuserPass(array($user_id));
$pass=sha1($_GET['pass']);
if($pass==$res)
{
	echo "Password Matched";
}
else
{
	echo "Password Incorrect";
}
?>