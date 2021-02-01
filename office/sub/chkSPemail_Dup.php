<?php 
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");

if(isset($_REQUEST['email'])){
$email=mysql_real_escape_string($_REQUEST['email']);

$email_qry="SELECT * FROM serviceprovider_info where SP_email='".$email."'";

	if(isset($_REQUEST['id'])){
	$id=$_REQUEST['id'];
	$email_qry_R=mysql_query("SELECT * FROM serviceprovider_info where SP_email='".$email."' and SP_id=".$id);
		if(mysql_num_rows($email_qry_R)){
		   echo "<span class='suc_msg'>This Email Available.</span>||1";
		  }
		else{
		   chk($email_qry);
		}  
	}
	else{
	  chk($email_qry);
	}
}

function chk($email_qry){
$sql_mail=mysql_query($email_qry);
	if(mysql_num_rows($sql_mail)>0){
	   $r=mysql_fetch_array($sql_mail);
	     echo "<span class='err_msg'>This Email already Used.</span><a href='sp_Details.php?sp_id=".$r['SP_id']."'><strong>More Info</strong></a>||0";
	}
	else {
	      echo "<span class='suc_msg'>This Email Available.</span>||1";
	}   
}
?>
