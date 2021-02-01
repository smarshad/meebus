<?php
include_once'../../server/server.php';   
include '../includes/functions.php';
$obj=new agent_module($con);
$agent_id=$_SESSION['agent']['log']['id'];
$agent_id = array($agent_id);
//print_r($agent_id);
$getLastPassengerDetails = $obj->getLastPassengerDetails($agent_id);
$getLastPassengerDetails = $getLastPassengerDetails[0];

//echo "<pre>"; print_r($getLastPassengerDetails); echo "</pre>"; 

//$LastpassengerName = explode('|A|',$getLastPassengerDetails['passenger_name']);
//$LastpassengerAGE = explode('|A|',$getLastPassengerDetails['passenger_age']);
//$LastpassengerGender = explode('|A|',$getLastPassengerDetails['passenger_sex']);
//$LastPassengerMobile = $getLastPassengerDetails['mobileNbr'];
//$LastPassengerEmail = $getLastPassengerDetails['emailId'];

$LastpassengerName = explode('|A|',$_SESSION['FILL']['PASSENGER']);
$LastpassengerAGE = explode('|A|',$_SESSION['FILL']['AGE']);
$LastpassengerGender = explode('|A|',$_SESSION['FILL']['GENDER']);
$LastPassengerMobile = $_SESSION['FILL']['MOBILE'];
$LastPassengerEmail = $_SESSION['FILL']['EMAIL'];

//echo "<pre>"; print_r($LastpassengerName); echo "</pre>"; 

echo count($LastpassengerName).'^'.implode(',',$LastpassengerName).'^'.implode(',',$LastpassengerAGE).'^'.implode(',',$LastpassengerGender).'^'.$LastPassengerMobile.'^'.$LastPassengerEmail;

?>