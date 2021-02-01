<?php
include '../server/server.php';
include '../bus_library/APICaller.php';
include "../includes/pdo_functions.php";
$obj=new user_module($con);  
$GLOBALS['obj']=$obj;
require_once 'TransactionResponse.php';
$transactionResponse = new TransactionResponse();
$transactionResponse->setRespHashKey("KEYRESP123657234");
if($transactionResponse->validateResponse($_POST)){
	$sessionid_b=$_POST['mer_txn'];
	if($_POST['desc']=='Transction Success')
	{
		$obj=$GLOBALS['obj'];
		$payment_msg=json_encode($_POST);
		$txnid=$_POST['mmp_txn'];
		$paymentstatus=$_POST['desc'];
		$rcamount=$_POST['amt'];
		$data=array($txnid,$paymentstatus,$payment_msg,$sessionid_b);
		$res=$obj->updatPaymentStatus($data);
		$detail=$obj->getTicketDetail($sessionid_b,'PENDING');
		if($detail!=0)
		{
			$user_id=$detail[0]['user_id'];
			$walletpay=$detail[0]['wallet_pay'];
			$balancepay=$detail[0]['balance_pay'];
			$booking_type=$detail[0]['booking_type'];
			if($booking_type=='complete')
			{
				$BlockingID_oneway=$detail[0]['TentativeBooking_oneway'];
				$bookingDetail = confirmTicket($BlockingID_oneway);
			}
			/*if($booking_type=='tentative')
			{
				$alphabet_DDS1 = "ABCDEFGHJKLMNOPQRSTUWXYZ23456789";
				$alphaLength_DDS1 = strlen($alphabet_DDS1) - 1;
				for ($i_DDS1 = 0; $i_DDS1 < 7; $i_DDS1++) {
					$n_DDS1 = rand(0, $alphaLength_DDS1);    
					$pass_DDS1[] = $alphabet_DDS1[$n_DDS1];
				} 
				$opPNR=implode($pass_DDS1);
				$message='SUCCESS';
				$etstnumber='ASKB'.rand(999999999,9999999999);
				$bookingDetail=array("opPNR"=>$opPNR,"etstnumber"=>$etstnumber,"apiStatus"=>array("message"=>$message));
			}*/
			if($bookingDetail['apiStatus']['message']=='SUCCESS')
			{
				if($user_id!=0 && $walletpay>0)
				{
					$balance=$obj->getBalance(array($user_id));
					$bal=$balance-$walletpay;
					$obj->updateUserBalance(array($bal,$user_id));
					$obj->insTransLog(array($user_id,'debit',$oneway_fare,$bal,'Bus Booking '.$sessionid_b,'SUCCESS',time(),$sessionid_b));
				}
				$pnr=$bookingDetail['opPNR'];
				$tin=$bookingDetail['etstnumber'];
				if($bookingDetail['apiStatus']['message']=='SUCCESS')
				$status='BOOKED';
				$inventoryId=$bookingDetail['inventoryType'];
				$dateOfIssue=date('d-m-Y h:i:s A',time());
				$update_detail=array($pnr,$tin,$status,$inventoryId,$dateOfIssue,$sessionid_b);
				//echo '<pre>'; print_r($update_detail); echo '</pre>';
				$update_bus=$obj->updateBookerDetail($update_detail);
				if($update_bus==1)
				{
					header('location:../ticket.php?tin='.$tin);
					exit;
				}
			}
		}
		else
		{
			$status='Failed';
			$pnr=NULL;
			$tin=NULL;
			$inventoryId=NULL;
			$dateOfIssue=date('d-m-Y h:i:s A',time());
			$bookingErrmsg=$bookingDetail['apiStatus']['message'];
			if($user_id!=0 && $walletpay>0)
			{
				$total=$walletpay+$balancepay;
				$balance=$obj->getBalance(array($user_id));
				$currentbal=$balance+$total;
				$obj->updateUserBalance(array($currentbal,$user_id));
				$obj->insTransLog(array($user_id,'credit',$total,$currentbal,'Refund for booking failed '.$sessionid_b,'SUCCESS',time(),$unicId));
			}
			$update_detail=array($pnr,$tin,$status,$inventoryId,$dateOfIssue,$bookingErrmsg,$sessionid_b);
			$update_bus=$obj->updateBookerDetailFailed($update_detail);
			header('location:../bookingFailed.php?uid='.$sessionid_b);
			exit;
		}
	}
} else {
    echo "Invalid Signature";
	header('location:payment-failure.php');
	exit;
}