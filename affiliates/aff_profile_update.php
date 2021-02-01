<?php 
session_start();
include '../database/connect.php';

$first_name=$_POST["name"];

$mobile_number=$_POST["mobile_number"];


$website = $_POST['website'];

$age = $_POST['age'];

$account_number = $_POST['account_number'];

$pan_card = $_POST['pan_card'];

$bank_name = $_POST['bank_name'];

$ifsc = $_POST['ifsc'];





$id=$_SESSION['aff']['affiliate_id'];
 $sql="Update aff_login  set name='$first_name',mobile_number='$mobile_number', website='$website',age='$age' ,account_number='$account_number' ,pan_card='$pan_card',bank_name='$bank_name',ifsc='$ifsc' WHERE id='$id'"; 
$result=mysql_query($sql);

header("location:aff_profile.php?msg=Succuessfully Updated");
?>