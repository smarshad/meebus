<?php 
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");

$from=$_REQUEST['fromid'];
$to_arr=explode(",",$_REQUEST['toid']);
foreach ($to_arr as $to){
$sql1=mysql_query("SELECT * FROM service_routes WHERE SR_source=".$from." and SR_destination=".$to);
if(mysql_num_rows($sql1)<1){
   add_destination($to,$from);
  }
}

view_routes_table($from);
?>
