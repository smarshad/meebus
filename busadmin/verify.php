<?php 
require "../config/config.php";

     if(isset($_REQUEST['verify'])){
		 $vcode=mysql_real_escape_string($_REQUEST['verify']);	   
		mysql_query("UPDATE `serviceprovider_info` SET `SP_status` =  '1' WHERE  `serviceprovider_info`.`SP_id` =".$vcode);
		header("location: index.php?versucc");
	 }
	 else{
	      header("location: index.php?vererr");
	 }

?>
