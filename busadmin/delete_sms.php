<?php

include_once("includes/header.php");
	
if(isset($_REQUEST['smsid']))
{
	
	$smsid=$_REQUEST['smsid'];
		
	$mqry="delete FROM smslog WHERE sms_id=".$smsid;
	
	$mem_rs=mysql_query($mqry);
	
	if($mem_rs)
	{
		header("location:sms_log.php?ds") ;
		//echo 1 ;
	}
	else
	{
		header("location:sms_log.php?de") ;
		//echo 0 ;
	}
	
}

?>