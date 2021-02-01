<?php
include '../server/server.php';
include "../includes/pdo_functions.php";
$obj=new user_module($con);  
$GLOBALS['obj']=$obj;
require_once 'TransactionResponse.php';
$transactionResponse = new TransactionResponse();
$transactionResponse->setRespHashKey("KEYRESP123657234");
if($transactionResponse->validateResponse($_POST)){
	$ref_id=$_POST['mer_txn'];
	if($_POST['desc']=='Transction Success')
	{
		$obj=$GLOBALS['obj'];
		$payment_msg=json_encode($_POST);
		$txnid=$_POST['mmp_txn'];
		$paymentstatus=$_POST['desc'];
		$rcamount=$_POST['amt'];
		$walDet=$obj->getwalletdet(array($ref_id));
		$walDet=$walDet[0];
		$user_id=$walDet['user_id'];
		$balance=$obj->getBalance(array($user_id));
		$currentbal=$balance+$rcamount;
		$obj->updateUserBalance(array($currentbal,$user_id));
		$data=array('SUCCESS',$txnid,$paymentstatus,$payment_msg,$ref_id);
		$res=$obj->updatWalletPaymentStatus($data);
		if($res==1)
		{
			header('location:../wallet-success.php?ref='.$ref_id);
			exit;
		}
	}
} else {
    echo "Invalid Signature";
	header('location:../payment-failure.php');
	exit;
}