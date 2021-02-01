<?php
ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
$params = array(
 'LoginID'=>'Urbus',
 'Password'=>'Urbus123',
 'UserType'=>'S',
 'LoginCode'=>9542,
);
$client = new SoapClient("http://affapi.mantistechnologies.com/Service.asmx?WSDL",array('trace' => 1)); // WSDL file for function definitions
$result = $client->Authenticate($params);
 echo '<pre>';
 print_r($result);
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