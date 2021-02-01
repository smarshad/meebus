<?php 

include_once("includes/header.php");


	if(isset($_REQUEST['submit']))	
	{

	trim(extract($_POST));

	$bank_details = $_REQUEST['bank_details'];
	$amount = $_REQUEST['amount'];
    $date=$_REQUEST['datepick'];
	$sp_id=$_REQUEST['sp_id'];
	$item_name=$_REQUEST['item'];
	$receipt=$_FILES['receipt']['name'];
	$tmp_logo=$_FILES['receipt']['tmp_name'];
	$dir="receipt/".time()."".$receipt;
	
	move_uploaded_file($tmp_logo,$dir);

	mysql_query("insert into admin_transaction SET adtrans_paydetails='$bank_details',adtrans_receiptimg='$dir',adtrans_spid='$sp_id', adtrans_status='0', adtrans_amount='$amount', adtrans_ordid='$payer_id', adtrans_date=NOW(), pay_status='1',item_name='$item_name',adtrans_paytype='1',adtrans_ip='$ip' ");

     $sp_val=mysql_fetch_array(mysql_query("select * from serviceprovider_info where SP_id='$sp_id'"));


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
Your amount sent to your Account , please check it.</td>
		</tr>

	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		<table style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
			     	<tr><td> <b> Bank Details</b> </td> <td>:</td> <td>$bank_details</td> </tr>
			       <tr><td> <b> Amount</b> </td> <td>:</td> <td>$amount</td> </tr>
				   <tr><td> <b> Date</b> </td> <td>:</td> <td>$date</td> </tr>
				   
				   <tr><td> <b> Receipt Scan Image</b> </td> <td>:</td> <td><img src='$siteurl/$dir' ></td> </tr>
               
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


    header("location:paymentmgnt.php?send");

	}
	

?>

<script type="text/javascript">

function validate()
{
//alert("hello");
if(document.getElementById('receipt').value == "")
{
if(document.getElementById('bank_details').value=="")
{
alert("Enter the bank details");
document.getElementById('bank_details').focus();
return false;
}

if(document.getElementById('amount').value=="")
{
alert("Enter the transaction amount");
document.getElementById('amount').focus();
return false;
}

if(document.getElementById('datepick').value=="")
{
alert("Enter the datepicker");
document.getElementById('datepick').focus();
return false;
}
} else {

if(document.getElementById('receipt').value != "")
{
		var ss=document.getElementById('receipt').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew != "jpg" && ssivanew != "png" && ssivanew != "jpeg" && ssivanew != "gif" && ssivanew != "JPG" && ssivanew != "PNG" && ssivanew != "JPEG" && ssivanew != "GIF")
		{
			  alert("Upload jpg,png,jpeg,gif images only...");
			  document.getElementById('receipt').value="";
			  document.getElementById('receipt').focus();
			  return false;
		 }
	}
}

}

</script>

<script type="text/javascript" src="datepickr.js"></script>
		
		<style type="text/css">
			
			.calendar {
				font-family: 'Trebuchet MS', Tahoma, Verdana, Arial, sans-serif;
				font-size: 12px;;
				background-color: #EEE;
				color: #333;
				border: 1px solid #DDD;
				-moz-border-radius: 4px;
				-webkit-border-radius: 4px;
				border-radius: 4px;
				padding: 0.2em;
				width: 200px;;
				font-weight:bold;
			}
			
			.calendar a {
				outline: none;
			}
			
			.calendar .months {
				background-color: #F6AF3A;
				border: 1px solid #E78F08;
				-moz-border-radius: 4px;
				-webkit-border-radius: 4px;
				border-radius: 4px;
				color: #FFF;
				padding: 0.2em;
				text-align: center;
			}
			
			.calendar .prev-month,
			.calendar .next-month {
				padding: 0;
			}
			
			.calendar .prev-month {
				float: left;
			}
			
			.calendar .next-month {
				float: right;
			}
			
			.calendar .current-month {
				margin: 0 auto;
			}
			
			.calendar .months a {
				color: #FFF;
				text-decoration: none;
				padding: 0 0.4em;
				-moz-border-radius: 4px;
				-webkit-border-radius: 4px;
				border-radius: 4px;
			}
			
			.calendar .months a:hover {
				background-color: #FDF5CE;
				color: #C77405;
			}
			
			.calendar table {
				border-collapse: collapse;
				padding: 0;
				font-size: 12px;;
				width: 100%;
			}
			
			.calendar th {
				text-align: center;
			}
			
			.calendar td {
				text-align: right;
				padding: 1px;
				width: 14.3%;
			}
			
			.calendar td a {
				display: block;
				color: #1C94C4;
				background-color: #F6F6F6;
				border: 1px solid #CCC;
				text-decoration: none;
				padding: 0.2em;
			}
			
			.calendar td a:hover {
				color: #C77405;
				background-color: #FDF5CE;
				border: 1px solid #FBCB09;
			}
			
			.calendar td.today a {
				background-color: #FFF0A5;
				border: 1px solid #FED22F;
				color: #363636;
			}
			
		</style>
	
		
<fieldset class="table-bor">

<legend><strong>Bank Details</strong></legend>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"> 

<form action="" name="settings" method="post" enctype="multipart/form-data" onsubmit="return validate();"> 

	<tr height="14px"><td colspan="3"></td></tr>


	<tr> 
	
		<td width="9">&nbsp;</td> 
		
		<td width="215" align="left" valign="top" nowrap="nowrap" class="admintext">
			<strong>Bank Details:</strong></td> 
		
		<td width="88" class="content1" align="center" valign="top"><strong> :</strong></td> 
		
		<td width="661" align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<textarea name="bank_details" id="bank_details" style="width:250px; height:100px;"></textarea> 
		
		  </font>
	  </td> 
	
	</tr> 
		<tr height="10px"><td colspan="3"></td></tr>
	<tr> 
	
		<td width="9">&nbsp;</td> 
		
		<td width="215" align="left" valign="top" nowrap="nowrap" class="admintext">
			<strong>Amount:</strong></td> 
		
		<td width="88" class="content1" align="center" valign="top"><strong> :</strong></td> 
		
		<td width="661" align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="amount" id="amount" style="width:200px;" />
		
		  </font>
	  </td> 
	
	</tr> 
	</tr> 
		<tr height="10px"><td colspan="3"></td></tr>
	<tr> 
	
		<td width="9">&nbsp;</td> 
		
		<td width="215" align="left" valign="top" nowrap="nowrap" class="admintext">
			<strong>Transaction Date:</strong></td> 
		
		<td width="88" class="content1" align="center" valign="top"><strong> :</strong></td> 
		
		<td width="661" align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="datepick" id="datepick" class="date-pick" style="width:200px;" />
		<script type="text/javascript">
			new datepickr('datepick', { dateFormat: 'Y-m-d' });
		</script>
		  </font>
	  </td> 
	
	</tr> 

		
		
	
	<tr height="10px"><td colspan="3"></td></tr>

	<tr> 
	
		<td>&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong> Receipt Scan Image</strong></td> 
		
		<td width="88" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="file" name="receipt" id="receipt"/>
		
			</font>
			
		</td> 
	
	</tr> 
	
	<tr height="3px"><td colspan="3"></td></tr>

	

	<tr> 
	
		<td colspan="4">&nbsp;</td> 
		
		</tr>	
		<input type="hidden" name="item" id="item" value="<?php echo $_REQUEST['item']; ?>" />
		<input type="hidden" name="sp_id" id="sp_id" value="<?php echo $_REQUEST['sp_id']; ?>" />
		<tr> 
		
		
		<td height="27" colspan="4" align="center"> &nbsp;
			<input type="submit" name="submit" value="Save" class="submitlink" onclick="return chk_genvalidation()"/> 
			<!--<input type="button" name="submit" value="Save" class="submitlink" onclick="alert('This is Demo version !!!');"/> -->
		</td> 
	
	</tr> 
	
</form> 

</table> 

</fieldset>

<?php include "includes/footer.php"; ?>