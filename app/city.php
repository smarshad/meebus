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
	$selectLogin="SELECT cities.city_name as city_name FROM service_routes, cities WHERE service_routes.SR_status =1 AND cities.id = service_routes.SR_source
AND cities.del_status !=0 GROUP BY service_routes.SR_source ORDER BY cities.city_name ASC ";
	$resultLogin=mysql_query($selectLogin) or die("Could not match the database");
	
		
		while($rows=mysql_fetch_array($resultLogin)){
 $data[]=$rows['city_name'];
 

}
echo json_encode($data, 1);
?>