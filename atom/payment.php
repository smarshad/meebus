<?php
include '../server/server.php';
include '../includes/pdo_functions.php';
$obj=new user_module($con);
date_default_timezone_set('Asia/Calcutta');
$datenow = date("d/m/Y h:m:s");
$transactionDate = str_replace(" ", "%20", $datenow);
$transactionId = $_SESSION['bus']['payment']['unicId'];
$amount=$obj->getPGamount(array($transactionId));
require_once 'TransactionRequest.php';

$transactionRequest = new TransactionRequest();

//Setting all values here
$transactionRequest->setMode("live");
$transactionRequest->setLogin(69930);
$transactionRequest->setPassword("TROON@123");
$transactionRequest->setProductId("TROON");
$transactionRequest->setAmount($amount);
$transactionRequest->setTransactionCurrency("INR");
$transactionRequest->setTransactionAmount($amount);
$transactionRequest->setReturnUrl("http://meebus.com/atom/response.php");
//$transactionRequest->setReturnUrl("http://preethi/meebus/atom/response.php");
$transactionRequest->setClientCode(123);
$transactionRequest->setTransactionId($transactionId);
$transactionRequest->setTransactionDate($transactionDate);
$transactionRequest->setCustomerName("Test Name");
$transactionRequest->setCustomerEmailId("test@test.com");
$transactionRequest->setCustomerMobile("9999999999");
$transactionRequest->setCustomerBillingAddress("Mumbai");
$transactionRequest->setCustomerAccount("639827");
$transactionRequest->setReqHashKey("3ae42a3113dc4a8dec");
$transactionRequest->setRespHashKey("632e27a27c46d52795");
$url = $transactionRequest->getPGUrl();

header("Location: $url");