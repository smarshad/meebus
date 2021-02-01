<?php

include_once("includes/header.php");
	
if(isset($_REQUEST['memid']))
{
	
	$memid=$_REQUEST['memid'];
		
	$mqry="delete FROM users WHERE user_id=".$memid;
	
	$mem_rs=mysql_query($mqry);
	
	if($mem_rs)
	{
		header("location:usermgmt.php?ds") ;
		//echo 1 ;
	}
	else
	{
		header("location:usermgmt.php?de") ;
		//echo 0 ;
	}
	
}

?>