<?php
ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
include_once 'Authenticate.php';
$search_query->RouteScheduleId = '142060848';
$search_query->JourneyDate = '2015-09-12';
$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
$result = $client->GetRouteScheduleDetailsWithComm($search_query);
echo '<pre>';
print_r($search_query);
print_r($result);
echo '</pre>';
 /*if($result->AuthenticateResult->Response->IsSuccess){
  echo "UserID:=>".$result->AuthenticateResult->UserID;
  echo "UserType:=>".$result->AuthenticateResult->UserType;
  echo "Key:=>".$result->AuthenticateResult->Key;
  echo "UserName:=>".$result->AuthenticateResult->UserName;
  echo "LoginName:=>".$result->AuthenticateResult->LoginName;
 }else{
  echo "Error:=>".$result->AuthenticateResult->Response->Message;
 }*/
 ?>