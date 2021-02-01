<?php
include '../server/server.php';
// include '../includes/pdo_functions.php';


if(!isset($_SESSION['user']['log']['id']))
{
	header('location:../index.php');
	exit;
}
else

$balance = $_SESSION['user']['log']['balance'];

date_default_timezone_set();
$datenow = date("d/m/Y h:m:s");
$transactionDate = str_replace(" ", "%20", $datenow);
$transactionId = 'MBUS'.time().rand(100,999);
$amount=$_POST['wallet'];

if(isset($_POST['wallet']) && $_POST['wallet'] != 0 && $_POST['wallet'] != NULL){
$o = "INSERT INTO user_trans_log (user_id, mode, amount, balance, description, book_status, time_format, ref_id) VALUES ('$user_id','credit','$amount','$balance','Add Wallet Fund '.$transactionId, 'pending',time(),$transactionId)";
$query = $conn->query($o);
if($query=1){
    echo "inserted";
}else{
    echo "not working";
}
}else{
    echo "<script> alert('Please input valid Amount');</script>";
    header('profile.php');
    exit;
}

include 'TransactionRequest.php';

$transactionRequest = new TransactionRequest();
exit;
//Setting all values here
$transactionRequest->setMode("test");
$transactionRequest->setLogin(197);
$transactionRequest->setPassword("Test@123");
$transactionRequest->setProductId("NSE");
$transactionRequest->setAmount($amount);
$transactionRequest->setTransactionCurrency("INR");
$transactionRequest->setTransactionAmount($amount);
$transactionRequest->setReturnUrl("http://meebus.com/atom/response-wallet.php");

$transactionRequest->setClientCode(123);
$transactionRequest->setTransactionId($transactionId);
$transactionRequest->setTransactionDate($transactionDate);
$transactionRequest->setCustomerName("Test Name");
$transactionRequest->setCustomerEmailId("test@test.com");
$transactionRequest->setCustomerMobile("9999999999");
$transactionRequest->setCustomerBillingAddress("Mumbai");
$transactionRequest->setCustomerAccount("639827");
$transactionRequest->setReqHashKey("KEY123657234");

$url = $transactionRequest->getPGUrl();
print_r($url);
header('location: $url');