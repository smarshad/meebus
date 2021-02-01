<?php

include_once("includes/header.php");
	
if(isset($_REQUEST['id']))
{
	
	$memid=$_REQUEST['id'];
		
	$mqry="delete FROM tbl_offices WHERE id=".$memid;
	
	$mem_rs=mysql_query($mqry);
	
	if($mem_rs)
	{
		header("location:add-location.php?ds") ;
		//echo 1 ;
	}
	else
	{
		header("location:add-location.php?de") ;
		//echo 0 ;
	}
	
}

?>