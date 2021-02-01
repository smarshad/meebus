<?php	

// include('../server/server.php');

error_reporting(1);
function getSources()
{
	$url="http://test.etravelsmart.com/etsAPI/api/getStations";
	$ch = curl_init();
	$username="meebus";
	$password='Shannu2$';
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
	$output = curl_exec($ch);
	curl_close($ch);
	return json_decode($output, true);
}
function getAvailableBuses($source,$destination,$doj)
{
	GLOBAL $conn;
	$_SESSION['log']['bus']['uniqId']='BUS'.rand(100000000,99999999999).time();
	$obj=$GLOBALS['obj'];
	$url="http://test.etravelsmart.com/etsAPI/api/getAvailableBuses?sourceCity=".$source."&destinationCity=".$destination."&doj=".$doj;
	$uniq = $_SESSION['log']['bus']['uniqId'];
	
	$sql3 = "INSERT INTO bus_api_log (unicid,searchReq) values ('$uniq','$url')";
	$query3 = $conn->query($sql3);
	
	$ch = curl_init();
	$username="meebus";
	$password='Shannu2$';
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
	$output = curl_exec($ch);
	
	$sql = "UPDATE bus_api_log SET searchRes= '$output' WHERE unicid='$uniq'";
	$query = $conn->query($sql);
	
	curl_close($ch);
	return json_decode($output, true);
}

function getBusLayout($source,$destination,$doj,$inventoryType,$routeScheduleId)
{
	$obj=$GLOBALS['obj'];
	$url="http://test.etravelsmart.com/etsAPI/api/getBusLayout?sourceCity=".$source."&destinationCity=".$destination."&doj=".$doj."&inventoryType=".$inventoryType."&routeScheduleId=".$routeScheduleId;
	$obj->updateBusSeatlayoutReqLog(array($url,$_SESSION['log']['bus']['uniqId']));
	$ch = curl_init();
	$username="meebus";
	$password='Shannu2$';
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
	$output = curl_exec($ch);
	$obj->updateBusSeatlayoutResLog(array($output,$_SESSION['log']['bus']['uniqId']));
	curl_close($ch);
	return json_decode($output, true);
}

function getBlockTicket($requestJson)
{
	$obj=$GLOBALS['obj'];
	$url="http://test.etravelsmart.com/etsAPI/api/blockTicket";
	$obj->updateBusBlockReqLog(array($requestJson,$_SESSION['log']['bus']['uniqId']));
	$ch = curl_init();
	$username='meebus';
	$password='Shannu2$';
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
	curl_setopt($ch, CURLOPT_POST, 1);                                                                   
	curl_setopt($ch, CURLOPT_POSTFIELDS, $requestJson);                                                                  
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
	'Content-Type: application/json',                                                                                
	 'Content-Length: ' . strlen($requestJson))                                                                       
   );                                                                                                                   
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);    
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	$obj->updateBusBlockResLog(array($result,$_SESSION['log']['bus']['uniqId']));
	curl_close($ch);
	$result=json_decode($result, true);
	return $result;
}
function confirmTicket($BlockingID)
{
	$obj=$GLOBALS['obj'];
	$url="http://test.etravelsmart.com/etsAPI/api/seatBooking?blockTicketKey=".$BlockingID;
	$obj->updateBusConfirmTicketReqLog(array($url,$_SESSION['log']['bus']['uniqId']));
	$ch = curl_init();
	$username="meebus";
	$password='Shannu2$';
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
	$output = curl_exec($ch);
	$obj->updateBusConfirmTicketResLog(array($output,$_SESSION['log']['bus']['uniqId']));
	curl_close($ch);
	return json_decode($output, true);
}
function getTicket($ETSTNumber)
{
	$obj=$GLOBALS['obj'];
	$url="http://test.etravelsmart.com/etsAPI/api/getTicketByETSTNumber?".$BlockingID;
	$obj->updateBusgetTicketReqLog(array($url,$_SESSION['log']['bus']['uniqId']));
	$ch = curl_init();
	$username="meebus";
	$password='Shannu2$';
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
	$output = curl_exec($ch);
	$obj->updateBusgetTicketResLog(array($output,$_SESSION['log']['bus']['uniqId']));
	curl_close($ch);
	return json_decode($output, true);
}
function cancelTicketConfirmation($requestJson)
{
	$obj=$GLOBALS['obj'];
	$url="http://test.etravelsmart.com/etsAPI/api/cancelTicketConfirmation";
	$obj->insBusConfirmCancleReqLog(array($requestJson,$_SESSION['log']['bus']['uniqId']));
	$ch = curl_init();
	$username='meebus';
	$password='Shannu2$';
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
	curl_setopt($ch, CURLOPT_POST, 1);                                                                   
	curl_setopt($ch, CURLOPT_POSTFIELDS, $requestJson);                                                                  
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
	'Content-Type: application/json',                                                                                
	 'Content-Length: ' . strlen($requestJson))                                                                       
   );                                                                                                                   
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);    
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	$obj->updateBusConfirmCancleResLog(array($result,$_SESSION['log']['bus']['uniqId']));
	curl_close($ch);
	$result=json_decode($result, true);
	return $result;
}
function cancelTicket($requestJson)
{
	$obj=$GLOBALS['obj'];
	$url="http://test.etravelsmart.com/etsAPI/api/cancelTicket";
	$obj->updateBusCancleReqLog(array($requestJson,$_SESSION['log']['bus']['uniqId']));
	$ch = curl_init();
	$username='meebus';
	$password='Shannu2$';
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
	curl_setopt($ch, CURLOPT_POST, 1);                                                                   
	curl_setopt($ch, CURLOPT_POSTFIELDS, $requestJson);                                                                  
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
	'Content-Type: application/json',                                                                                
	 'Content-Length: ' . strlen($requestJson))                                                                       
   );                                                                                                                   
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);    
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	$obj->updateBusCancleResLog(array($result,$_SESSION['log']['bus']['uniqId']));
	curl_close($ch);
	$result=json_decode($result, true);
	return $result;
}
?>