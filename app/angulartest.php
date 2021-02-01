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
//include_once("..includes/mysqlclass.php");
include_once("..includes/functions.php");
$_SESSION['back'] = htmlentities($_SERVER['REQUEST_URI']);
$filename = basename($_SERVER["PHP_SELF"], ".php");	
$json =  array();
	$a=0;
 
   $_SESSION['back'] = htmlentities($_SERVER['REQUEST_URI']);	
   
  $agent_id=$_REQUEST['agent_id'];
$dat=date("Y-m-d");
$tot_seat=0;$tot_amount=0;
//echo $t="select distinct Bus_id from bookinginfo where agent_id='$agent_id'";
    $sql1=mysql_query("select * from bookinginfo where agent_id='$agent_id' and booked_date='$dat' and cancelledStatus='0' ");

$json = '[{"__v":0,"_id":"57b964b94371a28203d68358","active":true,"dob":"2016-08-22T16:00:00.000Z","email":"deded","name":"4343434","phone":"12235656"},{"name":"dd","dob":"2016-08-02T22:00:00.000Z","phone":"ddd","email":"ddd","photo":"dddd","_id":"57c1f22d4371a28203d68368","__v":0},{"__v":0,"_id":"57c26a174371a28203d68369","active":false,"dob":"2016-08-25T05:00:00.000Z","name":"cristhian camilo"}]';


$json = json_decode($json, TRUE);

echo json_encode($json, JSON_UNESCAPED_SLASHES);
?>