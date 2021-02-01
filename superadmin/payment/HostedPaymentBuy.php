<?php
ob_start();
session_start();
//include("includes/config.php");
require_once("./JavaBridge/java/Java.inc");
$path_e24class = getcwd().'/WEB-INF/classes';
/*echo getcwd() . "\n";*/ 
java_require($path_e24class);
$pipe = new Java("e24PaymentPipe");
$merchant = trim($_SESSION['ordid']);
$cntqty = mysql_fetch_object(mysql_query("select sum(`quantity`) as totqty  from ck_orders where order_id=".$merchant));
$pr_qt =  "ck-product_".$cntqty->totqty;
$amount=trim($_SESSION['totamt']);
$name=trim($pr_qt);
$email=trim($_SESSION['bilemail']);
$phone=trim($_SESSION['contact']);
$addr=trim($_SESSION['biladdress']);
$trckid = rand(10000,99999).date('s') ;
$pipe->setCurrency("356");
$pipe->setLanguage("USA");
$pipe->setAction("1");
$pipe->setResponseURL("http://condomking.in/intermediate.php");
$pipe->setErrorURL("http://condomking.in/failure.php");
$pipe->setResourcePath("/home/condomki/public_html/resource/");
$pipe->setAlias("70001795");
$pipe->setAmt($amount);
$pipe->setTrackId($trckid); 

$pipe->setUdf1($name);
$pipe->setUdf2($email);
$pipe->setUdf3($phone);
$pipe->setUdf4($addr);
$pipe->setUdf5($merchant);

$status = $pipe->performPaymentInitialization();
$payID = $pipe->getPaymentId();
$payURL = $pipe->getPaymentPage();
$urlToRedirect = $payURL . '?PaymentID=' . $payID;

header('Location: '. $urlToRedirect);
?>