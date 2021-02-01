<?php
include_once'../server/server.php'; 
include_once 'includes/functions.php';
$obj=new agent_module($con);
$_SESSION['common']['pagename'] = "LogOut";
$system_data=''; $system_data=array('Agent',$_SESSION['agent']['log']['id'],'Logout','Successfully','');
$system_log = $obj->systemlogs($system_data);  $system_data='';

session_destroy();
header('location:index.php');
?>

