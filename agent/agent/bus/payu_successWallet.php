<?php 
include_once'../../server/server.php';  
date_default_timezone_set('Asia/Calcutta');  
$time = time();
$_SESSION['common']['pagename'] = "control panel"; 
include_once '../includes/functions.php';
$obj=new agent_module($con);  
require_once("../../sendsms.php"); 

//echo '<pre/>'; print_r($_POST); echo '<pre/>';

$session_id_b = $productinfo = $_POST["productinfo"];

$data=array($session_id_b);
$deposit_pd=$obj->getPaymentgatewaydata($data);
$deposit_pd = $deposit_pd[0];

$agentDatas = $obj->getAgentDeatils($deposit_pd['agent_id']);
$agentDatas = $agentDatas[0];


$balance = $_SESSION['agent']['log']['account_balance'] = $agentDatas['account_balance'];
$agent_id = $_SESSION['agent']['log']['id']= $deposit_pd['agent_id'];
$api_selection = $obj->api_selection('agent');

$_SESSION['agent']['log']['agent_name']		     	=	$deposit_pd['agent_name'];
$_SESSION['agent']['log']['agency_name']		    =	$deposit_pd['agency_name'];
$_SESSION['agent']['log']['email']			      	=	$deposit_pd['email'];
$_SESSION['agent']['log']['username']			    =	$deposit_pd['agent_name'];
$_SESSION['agent']['log']['mobile']		       		=	$deposit_pd['mobile_phone'];
$_SESSION['agent']['log']['agentname']		      	=	$deposit_pd['agent_name'];
$_SESSION['agent']['log']['id']				     	=	$deposit_pd['agent_id'];
$_SESSION['agent']['log']['office_phone']	       	=	$deposit_pd['office_phone'];
$_SESSION['agent']['log']['account_balance']        =	$deposit_pd['account_balance'];
$_SESSION['agent']['log']['markup'] 			    =	$deposit_pd['a_bus'];
$_SESSION['agent']['log']['bus_markup']             =	$deposit_pd['bus_markup'];
$_SESSION['agent']['log']['commission']             =   $deposit_pd['bus_comm'];	
$_SESSION['agent']['log']['service_charge_mode']    =   $deposit_pd['service_charges_mode'];	
$_SESSION['agent']['log']['service_charges']        =   $deposit_pd['service_charges'];
$_SESSION['agent']['log']['api_select']       	    =   $api_selection[0]['api_select'];


$session_id = $session_id_b;


$date1 = date('Y-m-d',time());

$mobile = $_SESSION['agent']['log']['mobile'];

//echo "<pre>"; print_r($_POST); echo "</pre>";

if(isset($_POST["productinfo"]))
	{
		$status=$_POST["status"];
		$firstname=$_POST["firstname"];
		$amount=$_POST["amount"];
		$txnid=$_POST["txnid"];
		$posted_hash=$_POST["hash"];
		$key=$_POST["key"];
		$session_id_b = $productinfo = $_POST["productinfo"];
		$email=$_POST["email"];
		$salt="5hC5LnhA";
		$charges = ($amount*1)/100;
		$charges = round($charges,2);
		$additionalCharges = '';
		if (isset($_POST["additionalCharges"])) 
			{
				$additionalCharges=$_POST["additionalCharges"];
				$retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
			}
		else {	  
		
		//$retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
		
		$retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
			 }
			 $hash = hash("sha512", $retHashSeq);
		if ($_POST['status']!= 'failure') 
			{
				$_POST['status'];
				sendsms('Urbus Agent Wallet Amount Added Successfully Thanks for using Urbus.com',$_SESSION['agent']['log']['mobile']);
				$data1=array($session_id_b);
				$deposit_pd1=$obj->getPaymentgatewaydataup($data1);
				$balance = $balance+$amount-$charges;
				$data2=array($balance,$agent_id);
				$deposit_pd2=$obj->getPaymentgatewaydataup1($data2);
				
				
				$reason = "Agent Wallet Deposit Success. Service Charge : Rs ".$charges;
				$log=array($_SESSION['agent']['log']['id'],'Agent Instant Deposit Payment Gateway Process Success',$amount,$balance);					
				
				$update_detail2 = $obj->agentwalletDeptRecord($log);
				
				$other_data  = ''; $system_data=''; $other_data = $_POST['status'];
		 	    $system_data = array('Agent',$_SESSION['agent']['log']['id'],'Wallet Deposit','Success',$other_data);
			    $system_log  = $obj->systemlogs($system_data);  
			    $system_data=''; $other_data = '';
				header('location:deposit.php?msg=Success');
			}
		else 
			{
				sendsms('Urbus Agent Wallet Amount Added Failed Please Try Again Later',$_SESSION['agent']['log']['mobile']	);
				$data3=array($session_id_b);
				$deposit_pd3=$obj->getPaymentgatewaydataup2($data3);
				$dec=array($_SESSION['agent']['log']['id'],'Agent Cancel Instant Deposit Payment Gateway Process',$amount,$balance);
				$deposit_pd4 = $obj->agentwalletDeclRecord($dec);
				header('location:deposit.php?msg=Failed');
			}	
	
	
	}

	
?>
