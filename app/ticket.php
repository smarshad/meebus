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
   
  $date=$_REQUEST['dat'];
$bus_id=$_REQUEST['bus_id'];
$ticket=$_REQUEST['ticket'];

//echo $t="select * from bookinginfo where Bus_id='$bus_id' and travelling_date='$date' and Ticket_ID='$ticket'";
    $sql1=mysql_query("select * from bookinginfo where Bus_id='$bus_id' and travelling_date='$date' and Ticket_ID='$ticket'");
$cnt=1;
$sql21=mysql_query("select * from businfo where Bus_id='$bus_id'");

while($qry21 = mysql_fetch_assoc($sql21)){
	$frm=$qry21['Bus_fromcity'];
	$to=$qry21['Bus_tocity'];
	}
$sql3=mysql_query("select * from cities where id='$frm'");
while($qry3 = mysql_fetch_assoc($sql3)){
	$from=$qry3['city_name'];
	}
$sql4=mysql_query("select * from cities where id='$to'");
while($qry4 = mysql_fetch_assoc($sql4)){
	$tos=$qry4['city_name'];
	}
while($qry = mysql_fetch_assoc($sql1)){
	if($cnt=='1'){ $json['Busid']=$qry['Bus_id'];
	$json['dat']=$qry['travelling_date'];
	$json['fare']=$qry['booking_amt'];
	$json['agent_id']=$qry['agent_id'];
	$json['frm']=$from;
	$json['to']=$tos;
	}
	$tid=$qry['Ticket_ID'];
	$sno=$qry['SeatNo']; 
$sno1.=$qry['SeatNo'].','; 
	$sql2=mysql_query("select * from passengerinfo where Ticket_ID='$tid' and passenger_seatNo='$sno'");

while($qry2 = mysql_fetch_assoc($sql2)){
	$fname.=$qry2['firstname'].',';
	$lname.=$qry2['lastname'].',';
	$id.=$qry2['id'].',';
	$mob.=$qry2['mob'].',';
	}
	$json['firstname']=rtrim($fname, ",");
        $json['lastname']=rtrim($lname, ",");
        $json['id']=rtrim($id, ",");
        $json['mob']=rtrim($mob, ",");




  


	 
	 

$a++;	
$cnt=$cnt+1;	
	}

$json['seat_id']=rtrim($sno1, ",");;
  

?>


									<?php 


echo json_encode($json, JSON_UNESCAPED_SLASHES);
?>
