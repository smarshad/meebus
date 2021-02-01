<?php 
include_once'../server/server.php';  
$_SESSION['common']['pagename'] = "control panel"; 
include_once '../includes/functions.php';
$obj=new agent_module($con);  

$time = time();
$session_id_b = $_REQUEST['Description'];

$data=array($session_id_b);
$deposit_pd=$obj->getPaymentgatewaydata($data);

$getDatas = mysql_fetch_object($query);
foreach($deposits_data as $getDatas)
{
$agent_id = $getDatas['agent_id'];
$session_id = $session_id_b;
$dist_id = $getDatas['dist_id'];
$balance = $getDatas['balance'];
$amount = $_GET['Amount'];
$charges = ($amount*2.5) /100;
$charges = round($charges,2);
$date1 = date('Y-m-d',time());
	}




if (isset($_GET['ResponseMessage']) && $_GET['ResponseMessage']!='' && strpos($_GET['ResponseMessage'],'Failed') == false) 
	{
		 $data1=array($session_id_b);
	$deposit_pd1=$obj->getPaymentgatewaydataup($data1);

		
		$data2=array($balance,$agent_id);
	$deposit_pd2=$obj->getPaymentgatewaydataup1($data2);
	
		
header('location:deposit.php?msg=Success');
	}
else 
{
	$data3=array($session_id_b);
	$deposit_pd3=$obj->getPaymentgatewaydataup2($data3);
	
	header('location:deposit.php?msg=Failed');
}	
	
?>
