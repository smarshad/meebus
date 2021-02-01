<?php

include_once("includes/header.php");
	
if(isset($_REQUEST['memid']))
{
	
	$memid=$_REQUEST['memid'];
		
	$mqry="update users set user_status = '0' WHERE user_id=".$memid;
	
	$mem_rs=mysql_query($mqry);
	
	if($mem_rs)
	{
		header("location:usermgmt.php?s") ;
	}
	else
	{
		header("location:usermgmt.php?e") ;
	}
	
}

?>