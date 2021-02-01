<?php
ob_start();
session_start();
/*if(!isset($_SESSION['id']))
{
//header("location:login.php");
}*/

/*if($_POST['ordid']=="")
{
	  $userdetail=$product->userDetails($_SESSION['id']);
	  $taxamt_percent=$product->getTax();
	  $orderidfor="";
	  $order=$product->addOrder($orderidfor); 
	  $ordership=$product->addShippingdetails($order);
	  }
	  else{
	  $_SESSION['ordid']=$_POST['ordid'];
	  }*/
	  
	  
	
//mail($to,$subject,$meess,$headers);
$formaction = "https://www.tpsl-india.in/PaymentGateway/CheckGatewayEnter.jsp";
$srcsiteid = "L991";
$currency = "INR";
$amount = number_format($_SESSION['book_var']['total_amt'],2);
//$amount = "1";
//$item = "Item_Code";
$item=$_SESSION['ticket_id']."#".$_SESSION['ticket_id1'];
 $triptype=$_SESSION['book_var']['triptype']; 
$prn = "78688";
if($triptype==1)
$success = $site_url."/view_ticket.php";
else if($triptype==2)
$success = $site_url."/ticket_round.php";
else { }
$fail =$site_url."/thanks.php";
//$success = "http://www.udhayanidhi.com/demo/condomking/paysuccess.php";
//$fail = "http://www.udhayanidhi.com/demo/condomking/payfailure.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CONDOM KING</title>
</head>
<script>
function FormSubmit()
{
document.frm_netbank.submit();	
}
</script>

<body onload="Javascript:FormSubmit();">
<table width="100%" height="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle">
    <form name="frm_netbank" method="post" action="<?php echo $formaction; ?>">
<center>&nbsp;<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="333333">Processing &nbsp;<img src="../images/loading.gif" border="0" alt="loading" />&nbsp; Transaction . . . </font></center>
<input type="hidden" name="cmd" value="_xclick" />

<!-- Owner Paypal Id -->
<input type="hidden" name="SRCSITEID" value="<?php echo $srcsiteid; ?>" />

<!-- Product Name -->
<input type="hidden" name="CRN" value="<?PHP echo $currency; ?>" />

<!-- Product Amount -->
<input type="hidden" name="AMT" value="<?php echo $amount; ?>" />

<input type="hidden" name="ITC" value="<?php echo $item; ?>" />

<!-- Amount Currency -->
<input type="hidden" name="PRN" value="<?php echo $prn; ?>" />

<!-- Success Return Path -->
<input type="hidden" name="return" value="<?php echo $success; ?>">

<!-- Failure Return Path -->
<input type="hidden" name="cancel_return" value="<?php echo $fail; ?>" />
</form>
    </td>
  </tr>
</table>

</body>
</html>