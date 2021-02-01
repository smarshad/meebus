<?php 
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
$city=$_REQUEST['cityid'];
$status=$_REQUEST['status'];
mysql_query("UPDATE cities SET status=".$status." WHERE id=".$city) or die(mysql_error());
?>