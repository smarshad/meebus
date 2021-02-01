<?php
ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
include_once 'Authenticate.php';
$search_query->RouteScheduleId = '169037277';
$search_query->JourneyDate = '2014-01-05';
$search_query->PickUpID = '14532860';
$search_query->ContactInformation = new StdClass();
$search_query->ContactInformation->CustomerName = 'Heera Jaiswal';
$search_query->ContactInformation->Email = 'heera.jaiswal@travelyaari.com';
$search_query->ContactInformation->Phone = '7204608909';
$search_query->ContactInformation->Mobile = '7204608909';
$search_query->Passengers->Passenger = new StdClass();
$search_query->Passengers->Passenger->Name = 'Heera Jaiswal';
$search_query->Passengers->Passenger->Age = '23';
$search_query->Passengers->Passenger->Gender = 'M';
$search_query->Passengers->Passenger->SeatNo = 'R19';
$search_query->Passengers->Passenger->Fare = '1100';
$search_query->Passengers->Passenger->IsAcSeat = 'true';
$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
$result = $client->HoldSeatsForSchedule($search_query);
echo '<pre>';
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