<?php 
include_once'../server/server.php';  
include_once 'includes/functions.php';
$obj=new admin_module($con);  
$id=$_GET['id']; 
$datas=array(1,$id);
$edit=$obj->activateUser($datas);
echo $msg="Activated Successfully";
?>