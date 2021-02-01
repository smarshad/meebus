<?php
require_once("../config/config.php");
include_once("../includes/functions.php");

//print_r($_REQUEST);

$tidd=base64_decode($_REQUEST['tidd']);
$amountusd=$_REQUEST['mc_gross'];
$payer_id=$_REQUEST['payer_id'];
$payment_date=$_REQUEST['payment_date'];
$payment_status=$_REQUEST['payment_status'];
$address_name=$_REQUEST['address_name'];
$payer_email=$_REQUEST['payer_email'];
$item_number=$_REQUEST['item_number'];

session_start();

//echo $payment_status;

if($tidd==$item_number && $payment_status=="Completed") {
	//echo "success";
	$selectinfo=mysql_query("UPDATE bookinginfo SET pay_status='1' WHERE Ticket_ID='$item_number'");
	
	$updatetrans=mysql_query("UPDATE payment_transaction SET pay_trans_id='$item_number', pay_bank_name='$address_name', pay_bankRespMsg='$payment_status', pay_amount='$amountusd', pay_order_Id='$payer_id', pay_date_time=NOW(), pay_status='1' WHERE ticket_id='$item_number'");
	
	header("Location:../view_ticket.php?paysuccess&pay_id=$item_number");
	
} else {
	
	
	
	header("Location:../orderfailed.php?paypal");exit;
}

exit;
?>
