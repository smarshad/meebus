<?php 
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
$lux=$_REQUEST['luxid'];
$status=$_REQUEST['status'];
mysql_query("UPDATE bus_luxitem SET lux_status=".$status." WHERE lux_id=".$lux) or die(mysql_error());
?>