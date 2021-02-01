<?php
include_once "server/server.php";
include "bus_library/APICaller.php";
include "includes/pdo_functions.php";
$obj=new user_module($con);
if(isset($_POST['con-canl']) && $_POST['con-canl']=='Confirm Cancel')
{
	$seats=explode(',',$_POST['seats']);
	$ticket=$_POST['ticket'];
	$request=array("etsTicketNo"=>"$ticket","seatNbrsToCancel"=>$seats);
	//print_r($request);
	//exit;
	$requestjson=json_encode($request);
	$cancel=cancelTicket($requestjson);
	if($cancel['apiStatus']['message']=='SUCCESS')
	{
		$user_id=$obj->getUserId(array($ticket));
		$totalTicketFare=$cancel['totalTicketFare'];
		$totalRefundAmount=$cancel['totalRefundAmount'];
		$cancelChargesPercentage=$cancel['cancelChargesPercentage'];
		$cancellationCharges=$cancel['cancellationCharges'];
		$canceldata=json_encode($cancel);
		if($user_id!=0)
		{
			$balance=$obj->getBalance(array($user_id));
			$current_bal=$balance+$totalRefundAmount;
			$obj->updateUserBalance(array($current_bal,$user_id));
			$obj->insTransLog(array($user_id,'credit',$totalRefundAmount,$current_bal,'Cancellation Refund '.$unicId,'SUCCESS',time(),$unicId));
		}
		$update_canceldata=$obj->updateCancel(array('Cancelled',$canceldata,$ticket));
		if($update_canceldata==1)
		{
			header('location:cancel-success.php?ref='.$ticket);
			exit;
		}
	}
	else
	{
		$canceldata=json_encode($cancel);
		$update_canceldata=$obj->updateCancelFailed(array($canceldata,$ticket));
		header('location:cancel-success.php?ref='.$ticket);
		exit;
	}
}