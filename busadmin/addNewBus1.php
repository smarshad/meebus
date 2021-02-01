<?php
include "includes/header.php";
 
$bus_id=$_REQUEST['busid'];
$qry=mysql_query("SELECT * FROM businfo WHERE Bus_id=".$bus_id);
if(mysql_num_rows($qry)>0){
   $bus=mysql_fetch_object($qry);
   //$gstdetails=$bus->cancellationpolicy;
  $busd= $bus->Bus_name; 
		//$result = json_decode($gstdetails);
		echo "<pre>"; print_r($busd); exit;
}
?>
