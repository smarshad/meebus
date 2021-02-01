<?php
session_start();
require_once("../config/config.php");
include_once("../includes/functions.php");

$subject="$website_team Transaction Cancelled";

$msg =" 		
	<table width='700' cellpadding='0' cellspacing='0' border='0' bgcolor='#F49E23' style='border:solid 10px #A5DCFF;'>
	<tr bgcolor='#FFFFFF' height='25'> 
	
		<td height='94'>

			<img src='$img' border='0px' />

		</td> 

	</tr> 
	<tr bgcolor='#FFFFFF'> <td> </td> </tr> 
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Dear Admin, </b> 	
		
		</td> 
	</td>
		
	</tr>	
	
	
	<tr bgcolor='#FFFFFF'>
			<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
Your transaction has been Cancelled. Please try again .</td>
		</tr>


	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Payment status</b> : Cancelled	
		
		</td> 
	</td>
		
	</tr>
	
	
	
	


	
	

	<tr bgcolor='#FFFFFF'> 

		<td height='77' align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> 


			<p>Regards,<br> $siteteam <br>  <a href='$siteurl' target='_blank'> $siteurl </a> </p>

  		</td>

	</tr> 

	<tr bgcolor='#FFFFFF'><td> </td></tr> 	

	<tr height='40'> 	

		<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color: #A5DCFF;'>

			<font color='black'> &copy; Copyright 2013 <b><i> $siteteam </i></b>. </font>			

		</td> 

	</tr> 


</table>";	
	
$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From:'.$website_name.'<'.$mail_url.'>' . "\r\n";
				       

/*$to='sheik.inet@gmail.com';	*/
$to=$mail_url;	
	   			
//echo $userto;
//echo $subject;
//echo $msg;
//echo $headers;exit;

mail($to,$subject,$msg,$headers);
	
	
	header("Location:paymentmgnt.php?pay_cancel");
	
	unset($_SESSION['crsamt']);
};
?>