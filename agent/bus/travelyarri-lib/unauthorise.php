<?php
if(($_SESSION['EMAIL']=='')&&($_SESSION['user_id']==''))
{
	 header('location:index.php');
	 exit;
}
?>