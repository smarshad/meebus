<?php
session_cache_limiter("private, must-revalidate");
session_start();
ob_start();
ini_set('max_execution_time', 3000);
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Calcutta');
ini_set('display_errors',0);
session_cache_expire(15);
$cache_expire = session_cache_expire();
require_once("../config/config.php");


$json =  array();
$frm=$_REQUEST['frm'];
$selectLogin="SELECT * FROM cities WHERE city_name='$frm' and cities.del_status!=0 ";
	$resultLogin=mysql_query($selectLogin) or die("Could not match the database");
while($row=mysql_fetch_array($resultLogin)){
$id=$row['id'];
}


	 $selectLogin1="SELECT * FROM service_routes WHERE SR_status =1 AND SR_source = '$id' ";
	$resultLogin1=mysql_query($selectLogin1) or die("Could not match the database");
	
		
		while($rows=mysql_fetch_array($resultLogin1)){
 $dt=$rows['SR_destination'];
$selectLogin2="SELECT * FROM cities WHERE id='$dt' and cities.del_status!=0 ";
	$resultLogin2=mysql_query($selectLogin2) or die("Could not match the database");
while($row2=mysql_fetch_array($resultLogin2)){
$data[]=$row2['city_name'];
}

}
echo json_encode($data, 1);
?>