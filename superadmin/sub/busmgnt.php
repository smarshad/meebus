<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");

if(isset($_REQUEST['opt'])){
   $opt=mysql_real_escape_string($_REQUEST['opt']);
   $bus_id=mysql_real_escape_string($_REQUEST['busid']);
   
   if($opt=='chg'){
   $status=mysql_real_escape_string($_REQUEST['sts']);
     mysql_query("UPDATE businfo SET Bus_status = ".$status." WHERE Bus_id=".$bus_id);
	 $status=mysql_real_escape_string($_REQUEST['sts']);
   }
   
   if($opt=='del'){
      mysql_query("DELETE FROM bus_structure WHERE bus_id=".$bus_id);
      mysql_query("DELETE FROM businfo WHERE Bus_id=".$bus_id);
   } 
}
?>
