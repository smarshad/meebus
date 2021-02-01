<?php 
include_once'../server/server.php';  
include_once 'includes/functions.php';
$obj=new admin_module($con);  
$dist_id=$_GET['id']; 
$datas=array(0,$dist_id);
$edit=$obj->activateUser($datas);
echo $msg="Deactivated Successfully";
?>