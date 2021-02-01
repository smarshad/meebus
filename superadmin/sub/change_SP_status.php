<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
if(isset($_REQUEST['sp_id']) && isset($_REQUEST['status'])){
$sp_id=mysql_real_escape_string($_REQUEST['sp_id']);
$status=mysql_real_escape_string($_REQUEST['status']);

   $qry="UPDATE  `serviceprovider_info` SET  `SP_status` =  '".$status."' WHERE  `serviceprovider_info`.`SP_id` =".$sp_id;
   $s=mysql_query($qry) or die(mysql_error());
   
   	if($status==0){
	   $sta="Active?";
	   $chg_status=1;
	   $title="Click to Unblock";
	   $src="../images/inactive.png";	   
	}
	else{
	   $sta="Deactive?";
	   $chg_status=0;
	   $title="Click to Block";
	   $src="../images/Active.png";	
	}
   
   if($s){
       echo '<a href="javascript:void(0);" onclick="change_SP_status('.$sp_id.','.$chg_status.');" title="Click to '.$title.'"><img src="'.$src.'" border="0" /></a>||'.$sp_id;
      } 
}
?>
