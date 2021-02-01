<?php 
include_once("../includes/pdo_connect.php");
include_once("../includes/cargo_functions.php");
$obj=new cargo($con);
$officeid=$_SESSION['offid'];
$vecle_id=$_POST['vecle_id'];
$destn=$_POST['destn'];
$trcid=$_POST['trcid'];
$location=explode('-',$destn);
$locationCode=$location[0];
$locationName=$location[1];
$locationId=$obj->getLocationByCode(array($locationCode));
$data=array($vecle_id,$officeid,$locationId,'Ready To Transit');
$insdesc=$obj->InsVehicleTracking($data);
$upda=$obj->updateTrcveclast(array('1',$trcid));
header('location:vechile-mgt.php');
?>