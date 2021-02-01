<?php
include_once '../../server/server.php';   
include_once '../includes/functions.php';
$obj=new agent_module($con);
include_once '../../sendsms.php';
$tno = $_GET['tno'];
$data4 = array($tno);
$getSMSData='';
$getSMSData = $obj->resendSMS($data4);
$smstext = str_replace('&',' AND',$getSMSData[0]['sms_data']);
$mobileno = $getSMSData[0]['mobileNbr'];
//if(sendsms($smstext,$mobileno)) { echo '1'; }
//else { echo '0'; }
//echo $mobileno.'-'.$smstext; exit;
$smsStatus = sendsms($smstext,$mobileno);
$smsStatus1 = explode(':',$smsStatus);
$smsStatus2 = explode('|',$smsStatus1[0]);

if($smsStatus1) { 
if($smsStatus2[0]==1)
{
	echo "SMS Send Successfully"; 
}
else 
{
	echo "SMS Send Status Pending"; 	
}
}
else 
{
	echo "SMS Not Send Please Resend Again"; 	
}

?>
