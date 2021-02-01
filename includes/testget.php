<?php
include_once '../server/server.php';
include_once 'pdo_functions.php';
$obj=new user_module($con); 
$result=$obj->getbustypes();
//$result=$result[0];
echo "<pre>";
print_r($result);    exit;

//$result1=$obj->getbustypes1();
//$result=$result[0];
//echo "<pre>";
//print_r($result1); 

?>
