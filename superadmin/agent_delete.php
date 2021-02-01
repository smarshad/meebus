<?php
include("includes/header.php");
include_once("mailer.php");

$bread_tail="Edit Agent";


if(isset($_REQUEST['aid']) && $_REQUEST['aid']!='' && $_REQUEST['aid']!=0)
	{	   
	$aid=mysql_real_escape_string($_REQUEST['aid']);
 
 $sql="UPDATE `agents` SET status='no' WHERE `agent_id`= $aid";
  

      $db->query($sql) or die(mysql_error());
	header("location:agent_mage.php");
	   
	}
	else
	{
		header("location:agent_mage.php");
	}
	   ?>