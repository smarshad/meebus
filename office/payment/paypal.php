<?php
ob_start();
session_start();
//include("../../config/config.php");
//$formaction = "https://www.paypal.com/cgi-bin/webscr";
$formaction="https://www.sandbox.paypal.com/us/cgi-bin/webscr";
$paypalmail=$paypal;
$Product = "Busbooking Tickets";

//$success = "http://192.168.2.15/aishu/povoma/Busadmin/view_ticket.php";
//$fail = "http://192.168.2.15/aishu/povoma/Busadmin/pay_error.php";
$success = $site_url."/admin/view_ticket.php";
$fail = $site_url."/admin/pay_error.php";

// Check any submitions
if($_SESSION['book_var']['total_amt'] != NULL){
	// Amount to convert
	$amount = number_format(((float)$_SESSION['book_var']['total_amt']),2);
	
	// From
	$from = "INR";
	//$from_text = $list[$from];
	// To
	$to = "USD";
	//$to_text = $list[$to];
	// Get rate
	$rate = exchangeRate(); //0.0214; //$c->getRate($from,$to, true);
     //$rate = 0.0214;
	// Total price (to 2 decemial points)
	$gtotal = number_format(($rate*$amount),2);  
	 
}
function exchangeRate()
{
if (function_exists('curl_init'))
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://www.google.com.au/search?hl=en&q=1+usd+in+php&btnG=Search&meta=&aq=f&oq=');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0?');
$content = curl_exec($ch);
curl_close($ch);
$position1 = strpos($content,"1 U.S. dollar =");
$cleandata = substr($content,$position1+15,7);
return (1/$cleandata);
}
else
{
	$googleQuery = 1 . ''. "inr" . ' in ' . "usd";
    $googleQuery = urlEncode( $googleQuery );
    $askGoogle = file_get_contents( 'http://www.google.com/search?q=' . $googleQuery );
    $askGoogle = strip_tags( $askGoogle );
    $matches = array();
    preg_match( '/= (([0-9]|\.|,|\ )*)/', $askGoogle, $matches );
    return $matches[1] ? $matches[1] : false;
}
}

$item=$_SESSION['ticket_id']."#".$_SESSION['ticket_id1'];

$quantity_count=($_SESSION['book_var']['seat_count'] + $_SESSION['book_var']['seat_count1'])
//echo "asdfads".$gtotal; exit; //= currency_convert($_POST['amount'],'INR','USD'); exit;

//currency_convert($shop_detail[0]['grant_total'],'INR','USD');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Busbooking::Online Ticket Resrevation</title>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16753707-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<script>
function FormSubmit()
{
document.frm_process.submit();	
}
</script>

<body onload="Javascript:FormSubmit();">
<table width="100%" height="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle">

    <form name="frm_process" method="post" action="<?php echo $formaction; ?>">
<center>&nbsp;<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="333333">Processing &nbsp;<img src="../../images/loading.gif" border="0" alt="loading" />&nbsp; Transaction . . . </font></center>
<input type="hidden" name="cmd" value="_xclick" />

<!-- Owner Paypal Id -->
<input type="hidden" name="business" value="<?php echo $paypalmail; ?>" />

<!--Product Quantity -->
<input type="hidden" name="quantity" value="<?php echo $quantity_count; ?>" />

<!--Product Quantity -->
<input type="hidden" name="item_number" value="<?php echo $item; ?>" />


<!-- Product Name -->
<input type="hidden" name="item_name" value="<?php echo $Product; ?>" />

<!-- Product Amount -->
<input type="hidden" name="amount" value="<?php echo $gtotal; ?>" />

<input type="hidden" name="no_note" value="2" />

<!-- Amount Currency -->
<input type="hidden" name="currency_code" value="USD" />

<input type="hidden" name="bn" value="PP-BuyNowBF" />

<input type="hidden" name="tx" value="TransactionID">
<input type="hidden" name="at" value="YourIdentityToken"> 

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