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

while($qry = mysql_fetch_assoc($sql1)){
    $booking_amt=$qry['booking_amt'];
    $tot_seat+=1;
    $tot_amount+=$booking_amt;

}
for($i=0;$i<1;$i++){
$json[$a]['agent_id']=$agent_id;
$json[$a]['today_date']=$dat;
$json[$a]['total_seat']=$tot_seat;
$json[$a]['total_fare']=$tot_amount;
}



echo json_encode($json, JSON_UNESCAPED_SLASHES);
?>
