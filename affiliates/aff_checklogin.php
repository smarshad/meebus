<?php
session_start();
include '../database/connect.php';
$email_id=mysql_real_escape_string(strip_tags($_POST["email_id"]));
$password=mysql_real_escape_string(strip_tags($_POST["password"]));
//echo $new="SELECT * FROM user_login WHERE email_id='$email_id' AND password='$password'"; die;
echo $res="SELECT * FROM aff_login WHERE email='$email_id' AND password='$password' AND status='1'";

$result = mysql_query($res);
$data = mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){   
$_SESSION['aff']['affiliate_id']=$data['id'];
$first_name=$_SESSION['aff']['first_name']=$data['first_name'];
$mobile_number=$_SESSION['aff']['mobile_number']=$data['mobile_number'];
$balance=$_SESSION['aff']['balance']=$data['balance'];
$_SESSION['aff']['email_id']=$email_id;

//$_SESSION['user']['password']=$password;
header("location:aff_dashboard.php"); }
else { header("location:aff_sign_in.php?msg=Username or Password wrong"); }
?>
