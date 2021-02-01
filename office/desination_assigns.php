<?php 
include_once("../includes/pdo_connect.php");
include_once("../includes/cargo_functions.php");
$obj=new cargo($con);
$vecle_id=$_POST['vecle_id'];
$data=array($vecle_id,'Arrived');
$insdesc=$obj->InsVehicleTracking($data);
header('location:vechile-mgt.php');
?>