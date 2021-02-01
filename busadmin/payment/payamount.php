<?php
ob_start();
session_start();
include("includes/config.php");
require_once("includes/pagination.php");
require_once("includes/user-function.php");
$product = new product;
$taxes=$product->getTax();
if(isset($_POST['pay']))
{
if($_POST['ordid']=="")
{
	  $userdetail=$product->userDetails($_SESSION['id']);
	  $taxamt_percent=$product->getTax();
	  $orderidfor="";
	  $order=$product->addOrder($orderidfor); 
	  $ordership=$product->addShippingdetails($order);
	  }
	  else{
	  $_SESSION['ordid']=$_POST['ordid'];
	  }
	  
$mode=$_POST['paymentmode'];
$_SESSION['totamt'] = $_POST['amount'];
$_SESSION['name'] = $_POST['name'];
$_SESSION['bilemail'] = $_POST['email'];
$_SESSION['biladdress'] = $_POST['address'];
$_SESSION['contact'] = $_POST['contnumber'];
$_SESSION['merch'] = $_POST['merchant'];
if($mode==1){
header("location:HostedPaymentBuy.php"); }
elseif($mode==2){
header("location:process.php"); }
elseif($mode==3){
header("location:payment.php");
}
}

$cartitems=$product->getCartdetails();
array_pop($cartitems);
$count=count($cartitems);
$billaddr=$product->getbillAddr();
//print_r($billaddr);
$shipaddr=$product->getshipAddr();
//print_r($shipaddr);
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::condom-king::</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/tab-view.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="javascript/common_ajax.js"></script>
<script type="text/javascript">
function checkrate(id)
{
var ids=id.split('_');
var ext=ids[1];
var shipty="shippingtype_"+ext;
var cour="courier_"+ext;
var compsta="compstate_"+ext;
var vendoridd="vendorid_"+ext;
var amountdiv="amt_"+ext;
var eachval="singleval_"+ext;
if(document.getElementById(shipty).value=="")
{
alert("Please Select Shipping Type");
document.getElementById(shipty).focus();
return false;
}
if(document.getElementById(cour).value=="")
{
alert("Please Select Courier Type");
document.getElementById(cour).focus();
return false;
}
var shippingtype=document.getElementById(shipty).value;
var couriername=document.getElementById(cour).value;
var shipstateid=document.getElementById('stateid').value;
var compstateid=document.getElementById(compsta).value;
var vendid=document.getElementById(vendoridd).value;



//var url="courieramount.php?shiptype="+shippingtype+"courier="+couriername+"fromstate="++"tostate="+;
var url="courieramount.php?shiptype="+shippingtype+"&courier="+couriername+"&fromstate="+compstateid+"&tostate="+shipstateid+"&vendorid="+vendid;
//alert (url);
var target_div=amountdiv;
showAvailability(url,target_div,eachval)
//alert('sdsadsadasda');
/*var count=document.getElementById('kcount').value;
//alert(count);
var b=0;
for(f=1; f<(count); f++)
{
//var incval=document.getElementById(incvalue).value;
alert(f);
var incvalue="singleval_"+f;
alert(incvalue);
var a=parseInt(document.getElementById(incvalue).value);
alert(a);
 b=b+a;
}
alert("fffff"+b);*/
}

function validatepayment()
{
if(document.getElementById('condition').checked==false)
{
alert("Please Verify General sales and condition");
return false;
}
var loopcount=document.getElementById('kcount').value;
for(g=1; g<loopcount; g++)
{
shipingtypes="shippingtype_"+g;
couriername="courier_"+g;
if(document.getElementById(shipingtypes).value=='')
{
alert('Please Select Shipping Type');
return false;
}
if(document.getElementById(couriername).value=='')
{
alert("Please Select Courier Name");
return false;
}
}

}
</script>

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

<body>
<table align="center" id="wraper" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td colspan="3" align="left" valign="middle"><?php include("includes/header.php"); ?></td>
  </tr>
  <tr>
    <td colspan="3"></td>
  </tr>
  <tr>
    <td width="190" align="left" valign="top" id="leftpannel"><table border="0" id="" cellspacing="0" cellpadding="0">
          <tr>
            <td height="284" align="left" valign="top"><?php include("includes/leftmenu.php"); ?></td>
          </tr>
          
        </table></td>
    <td width="563" align="left" valign="top"><table width="555" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><table border="0" align="center" cellpadding="0" cellspacing="0" id="banner">
          <tr>
            <?php $query_fonttext = mysql_fetch_assoc(mysql_query("SELECT `bannertext`,`bannertextcolor`,`bannertext1`,`bannertextcolor1` FROM `ck_contents`")); if(!isset($_SESSION['id'])){ ?>
		  
            <td class="dynamicbanner" width="534" height="149" valign="top"><table border="0" width="100%"><tr><td align="center" style="padding-top:30px;"><font size="+2" color="<?php echo $query_fonttext['bannertextcolor']; ?>"><?php echo stripslashes($query_fonttext['bannertext']); ?></font></td></tr><tr><td height="20" align="right"><a href="registration.php"><img src="images/register.jpg" border="0" width="138" height="37" alt="Register" title="register" /></a></td></tr></table>
            
              </td>
			  <?php }else{ ?>
			<td class="dynamicbanner" width="534" height="149" valign="top"><table border="0" width="100%"><tr><td align="center" style="padding-top:30px;"><font size="+2" color="<?php echo $query_fonttext['bannertextcolor1']; ?>"><?php echo stripslashes($query_fonttext['bannertext1']); ?></font></td></tr><tr><td height="20" align="right">&nbsp;</td></tr></table>
			  <?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="middle"><table width="535" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td></td>
          </tr>
          <tr>
            <td align="left" valign="middle" id="login-curve-top"><table width="260" border="0" cellpadding="0" cellspacing="0" class="margin">
                <tr>
                  <td width="13" align="right" valign="middle"><img src="images/log-left.jpg" width="11" height="33" /></td>
                  <td width="150" id="login-sm" class="blue-txt" >Cart Details- Payment »</td>
                  <td width="11"><img src="images/log-right.jpg" width="11" height="33" /></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" valign="top"  id="login-border"  ><table border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                  <td width="30" align="right" valign="top"  ><img src="images/blue-left.jpg" width="10" height="25" /></td>
                  <td width="68" align="left" valign="middle" class="blue-bgimg" >S No</td>
                  <td width="135" align="left" valign="middle" class="blue-bgimg" >Product Name.</td>
                  <td width="92" align="left" valign="middle" class="blue-bgimg" >Quantity</td>
                  <td width="99" align="left" valign="middle" class="blue-bgimg" >Unit Price</td>
                  <td width="78" align="left" valign="middle" class="blue-bgimg" >Total Price</td>
                  <td width="29" align="left" valign="middle"><img src="images/blue-right.jpg" width="10" height="25" /></td>
                </tr>
                <tr>
                  <td colspan="7"><table width="431"  border="0" align="center" cellpadding="0"cellspacing="0"  id="profile-border"> 
				    <?php
					
					$i=1;
					$brandtype=array();
					 if($count > 0){ for( $c=0; $c<$count; $c++){
					 if(!in_array($cartitems[$c]['brand'],$brandtype))
					 {
					 array_push($brandtype,$cartitems[$c]['brand']);
					 }
					  $query_font=mysql_fetch_assoc(mysql_query("SELECT `fontcolor`,`fontcolor1` FROM `ck_product` WHERE `id`='".$cartitems[$c]['prod_id']."'"));
					  ?>
                      <tr>
                        <td width="45" align="center" valign="middle"   class="boreder-bottom" id="orderno1"  ><?php echo $i; ?></td>
                        <td width="114" align="left"   class="boreder-bottom" id="delete" ><strong><span style="color:<?php echo $query_font['fontcolor']; ?>" onmouseout="this.style.color='<?php echo $query_font['fontcolor']; ?>'" onmouseover="this.style.color='<?php echo $query_font['fontcolor1']; ?>'"><?php echo stripslashes($cartitems[$c]['pro_name']); ?></span></strong></td>
                        <td width="71"   class="boreder-bottom" id="orderno" ><?php echo $cartitems[$c]['quantity']; ?></td>
                        <td width="96"   class="boreder-bottom" id="orderno" >Rs.<?php echo number_format($cartitems[$c]['unitprice'],2); ?>/-</td>
                        <td width="103"   class="boreder-bottom" id="ordernored" >Rs.<?php $total=$cartitems[$c]['quantity']*$cartitems[$c]['unitprice']; echo number_format($total,2); ?>/-</td>
                      </tr>
					  <?php $totalprice=$totalprice+$total; $i++; }} ?>
                      <!--<tr>
                        <td align="center" valign="middle"   class="boreder-bottom" id="orderno1"  >02</td>
                        <td width="114" align="left"   class="boreder-bottom" id="delete" >Ordernored</td>
                        <td width="71"   class="boreder-bottom" id="orderno" >100</td>
                        <td width="96"   class="boreder-bottom" id="orderno" >Rs.1000/-</td>
                        <td width="103"   class="boreder-bottom" id="ordernored" >Rs.2000/-</td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle"   class="boreder-bottom"  id="orderno1" >03</td>
                        <td width="114" align="left"   class="boreder-bottom" id="delete" >Moods - Spiral</td>
                        <td width="71"   class="boreder-bottom" id="orderno" >100</td>
                        <td width="96"   class="boreder-bottom" id="orderno" >Rs.1000/-</td>
                        <td width="103"   class="boreder-bottom" id="ordernored" >Rs.3000/-</td>
                      </tr>-->
					 <?php //print_r($brandtype); ?>
                      <tr>
                        <td colspan="3" align="center" valign="middle"   class="boreder-bottom"  id="orderno1" >&nbsp;</td>
                        <td width="96"   class="boreder-bottom" id="ordernobold" >Total Price</td>
                        <td width="103"   class="boreder-bottom" id="ordernored" >Rs.<?php echo number_format($totalprice,2); ?>/-</td>
                      </tr>
                      <tr>
                        <td colspan="3" align="center" valign="middle"   class="boreder-bottom"  id="orderno1" >&nbsp;</td>
                        <td width="96"   class="boreder-bottom" id="ordernobold1" >Tax</td>
                        <td width="103"   class="boreder-bottom" id="ordernored1" >Rs.<?php $taxpercent=$taxes; $tax=($totalprice*$taxpercent)/100; echo number_format($tax,2); ?>/-</td>
                      </tr>
                      <tr>
                        <td colspan="3" align="center" valign="middle"   class="boreder-bottom"  id="orderno1" >&nbsp;</td>
                        <td width="96"   class="boreder-bottom" id="ordernobold2" >Total Amount</td>
                        <td width="103"   class="boreder-bottom" id="ordernored2" >Rs.<?php $alltot=$totalprice+$tax; echo number_format($alltot,2); ?>/-<input type="hidden" name="producttotal" id="producttotal" value="<?php echo round($alltot,2); ?>" /></td>
                      </tr>
                  </table></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="bottom" id="login-border"><table width="513" border="0" align="center" cellpadding="0" cellspacing="0" id="blue-bg">
                <tr>
                  <td> Address Details of the customer</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="middle" id="login-border"><table border="0" align="center" cellpadding="0" cellspacing="0" id="blue-border">
			<form name="payment" method="post" action="#">
                <tr>
                  <td width="12" rowspan="4" align="left" valign="top">&nbsp;</td>
                  <td width="306" align="left" valign="top"><table width="242" border="0" align="center" cellpadding="0" cellspacing="0" id="hashbox">
                      <tr>
                        <td align="left" valign="top"><table width="232" border="0" align="center" cellpadding="0" cellspacing="8">
                            <tr>
                              <td class="plus">Billing Details</td>
                            </tr>
                            <tr>
                              <td><table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td class="plus-detail"><?php echo $billaddr[0]['name']." ".$billaddr[0]['lastname']; ?>.<br />
                                      City : <?php echo $billaddr[0]['city']; ?> <br />
                                      State : <?php echo state($billaddr[0]['state']); ?><br />
                                      Country : India
									  
									  <input type="hidden" name="name" value="<?php echo $billaddr[0]['name']." ".$billaddr[0]['lastname']; ?>" />
									   <input type="hidden" name="email" value="<?php echo $billaddr[0]['email']; ?>" />
									   
									    <input type="hidden" name="contnumber" value="<?php echo $billaddr[0]['phone']." ".$billaddr[0]['mobile']; ?>" />
										 <input type="hidden" name="merchant" value="BONNE" />
									  </td>
									  
									  				  <input type="hidden" name="address" value="<?php echo $billaddr[0]['address1']."  ".$billaddr[0]['address2']." ".$billaddr[0]['city']." ".$billaddr[0]['state']." India"; ?>" />
													  	
									  
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                  <td width="190" align="left" valign="top"><table width="242" border="0" align="center" cellpadding="0" cellspacing="0" id="hashbox">
                      <tr>
                        <td align="left" valign="top"><table width="232" border="0" align="center" cellpadding="0" cellspacing="8">
                            <tr>
                              <td class="plus">Shipping Details</td>
                            </tr>
                            <tr>
                              <td><table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td class="plus-detail"><?php echo $shipaddr[0]['name']." ".$shipaddr[0]['lastname']; ?>. <br />
                                      City : <?php echo $shipaddr[0]['city']; ?> <br />
                                      State : <?php echo state($shipaddr[0]['state']); ?><br />
                                      Country : India</td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2" align="left" valign="top"><table width="263" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="24"><label>
                          <input type="checkbox" name="condition" id="condition" />
                        </label></td>
                        <td width="239" class="accept"> I accept the <a href="salesterms.php" target="_blank">General Sales &amp; Conditions</a></td>
                      </tr>
                  </table></td>
             <!--   </tr>
                <tr>
                  <td colspan="2" align="left" valign="top"><table width="497" border="0" align="center" cellpadding="0" cellspacing="0" id="bg-hash-horizontal">
                      <tr>
                        <td align="left" valign="top"><table width="497" border="0" cellspacing="0" cellpadding="0" id="bg-hash-vertical">
                             Shipping type and courier coding was here
                        </table></td>
                      </tr>
                  </table></td>
                </tr> -->
                <tr>
                  <td colspan="2" align="left" valign="top"><table width="496" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr >
                        <td align="right" valign="bottom"><table width="497" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="31" align="center" valign="bottom"><img src="images/heading.jpg" width="495" height="31" /></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" background="images/shadow-middle.jpg" ><div style="margin:10px;">
                               <table width="229" border="0" cellspacing="0" cellpadding="5">
                              <tr>
                                <td width="14" rowspan="3">&nbsp;</td>
                                <td width="20"><label></label></td>
                                <td width="195" class="select"><input type="radio" name="paymentmode" id="select" value="1" />
                                  <img src="images/credit.jpg" border="0" alt="Credit Card" title="Credit Card" /></td>
                              </tr>
		
                              <tr>
                                <td width="20"><input type="radio" name="paymentmode" id="select2" checked="checked" value="2" /></td>
                                <td class="select"><img src="images/paypal1.jpg" border="0" alt="Paypal" title="Paypal" /></td>
                              </tr>
						
							     <tr>
                                <td width="20"><input type="radio" name="paymentmode" id="select2" value="3" /></td>
                                <td class="select"><img src="images/net-banking.jpg" border="0" alt="Net Banking" title="Net Banking" /></td>
                              </tr>
                            </table>
                        </div></td>
                      </tr>
                      <tr>
                        <td background="images/shadow-bootom.jpg" style="background-repeat:no-repeat;">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="9" style="padding-left:4px; padding-top:6px;"><label>
                          <input type="submit" class="continuebutton"  name="pay" id="button" value="Place An Order" onclick="return validatepayment();"/><input type="hidden" name="amount" id="amount" value="<?php echo $alltot; ?>"  />
                        <input type="hidden" name="stateid" id="stateid" value="<?php echo $shipaddr[0]['state']; ?>" /></label><!--<div id="asdf"></div>--></td>
                      </tr>
                      <tr>
                        <td height="9"><table width="537" border="0" align="center" cellpadding="0" cellspacing="0" id="yellow-bg-big">
                            <tr>
                              <td>Note:<span class="value1"> An order number will be generated after payment and confirmation message will be sent to your email address that you have provided during registration.</span></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="18">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="18">&nbsp;</td>
                      </tr>
					 
                  </table></td>
                </tr>
				</form>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="middle" id="login-border">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="middle" id="login-border">&nbsp;</td>
          </tr>
          <tr>
            <td><img src="images/login-bottom-curve.jpg" width="535" height="6" /></td>
          </tr>
        </table></td>
      </tr>
      
    </table></td>
    <td width="209" align="left" valign="top" id="rightpannel"><?php include("includes/rightmenu.php"); ?></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="middle"></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="middle">
   <?php include("includes/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>