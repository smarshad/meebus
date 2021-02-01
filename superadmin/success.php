<?php
require_once("../config/config.php");
include_once("../includes/functions.php");

//print_r($_REQUEST); exit;

$tidd=base64_decode($_REQUEST['tidd']);
$amountusd=$_REQUEST['mc_gross'];
$payer_id=$_REQUEST['payer_id'];
$payment_date=$_REQUEST['payment_date'];
$payment_status=$_REQUEST['payment_status'];
$address_name=$_REQUEST['address_name'];
$payer_email=$_REQUEST['payer_email'];
$item_number=$_REQUEST['item_number'];
$item_name=$_REQUEST['item_name'];
$txn_id=$_REQUEST['txn_id'];
$pemail=$_REQUEST['payer_email'];
$remail=$_REQUEST['receiver_email'];
$dollar=$_REQUEST['mc_gross'];
$item_name=$_REQUEST['item_name'];

session_start();

//echo $payment_status;
$ip=$_SERVER['REMOTE_ADDR'];
if($tidd==$item_name && $payment_status=="Completed") {
	//echo "success";
	//$selectinfo=mysql_query("UPDATE bookinginfo SET pay_status='1' WHERE Ticket_ID='$item_number'");
	
//echo "insert into admin_transaction SET adtrans_transid='$txn_id',adtrans_spid='$item_number', adtrans_status='0', adtrans_amount='$_SESSION[crsamt]', adtrans_ordid='$payer_id', adtrans_date=NOW(), pay_status='1',payer_email='$pemail',receiver_email='$remail',amt_dollar='$dollar',item_name='$item_name',adtrans_paytype='1',adtrans_ip='$ip' ";  exit;
	
	$updatetrans=mysql_query("insert into admin_transaction SET adtrans_transid='$txn_id',adtrans_spid='$item_number', adtrans_status='0', adtrans_amount='$_SESSION[crsamt]', adtrans_ordid='$payer_id', adtrans_date=NOW(), pay_status='1',payer_email='$pemail',receiver_email='$remail',amt_dollar='$dollar',item_name='$item_name',adtrans_paytype='1',adtrans_ip='$ip' ");
	
	$sp_val=mysql_fetch_array(mysql_query("select * from serviceprovider_info where SP_id='$item_number'"));
	
	
	 $image = dirname($_SERVER[PHP_SELF]).'/images/'.$imglogo; 	
		
		$img = "http://$_SERVER[HTTP_HOST]".$image; 
		
	$subject="$website_team Transaction Details";


$msg =" 		
	<table width='700' cellpadding='0' cellspacing='0' border='0' bgcolor='#F49E23' style='border:solid 10px #A5DCFF;'>
	<tr bgcolor='#FFFFFF' height='25'> 
	
		<td height='94'>

			<img src='$img' border='0' width='180' height='120'/>

		</td> 

	</tr> 
	<tr bgcolor='#FFFFFF'> <td> </td> </tr> 

	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Dear $item_name, </b> 	
		
		</td> 
	
		
	</tr>	
	
	
	<tr bgcolor='#FFFFFF'>
			<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
Your amount sent to your paypal Account , please check it.</td>
		</tr>

	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		<table style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
			     
			    <tr><td><b>Transaction ID</b></td> <td>:</td> <td>$txn_id</td></tr> 	
			       <tr><td> <b> Amount</b> </td> <td>:</td> <td>$dollar $</td> </tr>
		            
					<tr><td><b>Transaction date</b></td> <td>:</td> <td>$payment_date</td></tr>
			
					
					
					<tr><td><b>Payment status</b></td> <td>:</td> <td>success</td></tr>	
		</table>
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
				       
$userto=$sp_val['SP_email'];	
/*$userto='sheik.inet@gmail.com';*/
//echo $userto;
//echo $subject;
//echo $msg;
//echo $headers;exit;
	   			
mail($userto,$subject,$msg,$headers);




$msg1 =" 		
	<table width='700' cellpadding='0' cellspacing='0' border='0' bgcolor='#F49E23' style='border:solid 10px #A5DCFF;'>
	<tr bgcolor='#FFFFFF' height='25'> 
	
		<td height='94'>

			<img src='$img' border='0px' />

		</td> 

	</tr> 
	<tr bgcolor='#FFFFFF'> <td> </td> </tr> 
	
	
	<tr bgcolor='#FFFFFF'>
			<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
<b>Transaction is succuess, your transaction Details.</b></td>
		</tr>

	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b> Receiver paypalId</b> : $remail	
		
		</td> 
	</td>
		
	</tr>
	
	
			<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Transaction date</b> : $payment_date	
		
		</td> 
	</td>
		
	</tr>

	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Transaction ID</b> : $txn_id 	
		
		</td> 
	</td>
		
	</tr>
	<tr bgcolor='#FFFFFF' height='35'>
	<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'> 
	
	<b>Service Provider Name</b> : $item_name
	
	</td> 
	</tr>
	
	
	 <tr  bgcolor='#FFFFFF' height='35'>
	<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
	 
	 <b>Amount</b>  : $dollar $
	 
	</td> 
	 </tr>
	
	
	
	
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Payment status</b> : Success	
		
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
 $headers1  = 'MIME-Version: 1.0' . "\r\n";
 $headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 $headers1 .= "From:$website_team	< $mail_url >" . "\r\n";
/*$adminto='mohaideen@i-netsolution.com';		*/			       
$adminto=$mail_url;	
	   			
//echo $adminto;
//echo $subject;
//echo $msg1;
//echo $headers1;exit;
/*if(mail($adminto,$subject,$msg1,$headers1))
{
header("location:order_complete.php?suss");
}*/

mail($adminto,$subject,$msg1,$headers1);
	header("Location:paymentmgnt.php?paysuccess");
	unset($_SESSION['crsamt']);
	
} else {
	
	else
{
$subject="$website_team Transaction failed";

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
Your transaction has been failed. Please try again .</td>
		</tr>


	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Payment status</b> : Failed	
		
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
	
	
	header("Location:paymentmgnt.php?pay_err");
	
	unset($_SESSION['crsamt']);
}


?>
