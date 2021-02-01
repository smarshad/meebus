<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");

if(isset($_REQUEST['opt'])){
   $opt=mysql_real_escape_string($_REQUEST['opt']);
   $coupid=mysql_real_escape_string($_REQUEST['coupid']);
   
   if($opt=='chg'){
   $status=mysql_real_escape_string($_REQUEST['sts']);
     mysql_query("UPDATE bus_coupons SET coup_status = ".$status." WHERE coup_id=".$coupid);
	 $status=mysql_real_escape_string($_REQUEST['sts']);
   }
   
   if($opt=='del'){
      mysql_query("DELETE FROM bus_coupons WHERE coup_id=".$coupid);
   }
   
   
}
?>
