<?php
ob_start();
session_start();
$_SESSION['SP_id']=$_REQUEST['sp_id'];
header("Location:addNewBus.php?sp_id=".$_REQUEST['sp_id']);exit;
?>