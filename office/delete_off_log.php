<?php

include_once("includes/header.php");
	
if(isset($_REQUEST['id']))
{
	
	$memid=$_REQUEST['id'];
		
	$mqry="delete FROM tbl_courier_officers WHERE cid=".$memid;
	
	$mem_rs=mysql_query($mqry);
	
	if($mem_rs)
	{
		header("location:add-off-login.php?ds") ;
		//echo 1 ;
	}
	else
	{
		header("location:add-off-login.php?de") ;
		//echo 0 ;
	}
	
}

?>