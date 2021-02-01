<?php

include_once("includes/header.php");
	
if(isset($_REQUEST['emailid']))
{
	
	$emailid=$_REQUEST['emailid'];
		
	$mqry="delete FROM email_log WHERE email_id=".$emailid;
	
	$mem_rs=mysql_query($mqry);
	
	if($mem_rs)
	{
		header("location:email_log.php?ds") ;
		//echo 1 ;
	}
	else
	{
		header("location:email_log.php?de") ;
		//echo 0 ;
	}
	
}

?>