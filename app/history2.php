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
   
  $agent_id=$_REQUEST['agent_id'];$dat= date('Y-m-d');
//echo $t="select distinct Bus_id from bookinginfo where agent_id='$agent_id' and booked_date='$dat'";
    $sql1=mysql_query("select distinct(Bus_id) from bookinginfo where agent_id='$agent_id'  ");
while($qry = mysql_fetch_assoc($sql1)){
   $Bus_ids=$qry['Bus_id'];
  
    $sq2=mysql_query("select * from bookinginfo where Bus_id='$Bus_ids' and agent_id='$agent_id' and cancelledStatus='0'  and booked_date='$dat' group by Ticket_ID order by auto_id desc");
while($qry1 = mysql_fetch_assoc($sq2)){
$Ticket_ID2=$qry1['Ticket_ID'];
      $sq21=mysql_query("select * from bookinginfo where Bus_id='$Bus_ids' and Ticket_ID='$Ticket_ID2' and agent_id='$agent_id'  and cancelledStatus='0' and booked_date='$dat' order by Ticket_ID desc ");
while($qry11 = mysql_fetch_assoc($sq21)){
    $seatno[]=$qry11['SeatNo'];
    $booking_amt[]=$qry11['booking_amt'];
    $travelling_date[]=$qry11['travelling_date'];
      $travelling_dates=$qry11['travelling_date'];
}
$cnt=count($seatno);
for($j=0;$j<=$cnt;$j++){
 $stno.=$seatno[$j].',';
}



$cnt2=count($booking_amt);
for($j2=0;$j2<=$cnt2;$j2++){
$stno2.=$booking_amt[$j2].',';
}

$cnt3=count($travelling_date);
for($j3=0;$j3<=$cnt3;$j3++){
$stno3.=$travelling_date[$j3].',';
}
$query1 = mysql_query("SELECT *,b.typeName as tname,a.SP_id as spid FROM businfo as a,bustypes as b where a.Bus_id='$Bus_ids' and a.Bus_type=b.typeID ");
$query=mysql_fetch_array($query1);
$from_city = $query['Bus_fromcity'];
$to_city = $query['Bus_tocity'];
$fcity = get_city_name($from_city);
$tcity=get_city_name($to_city);
	$spid = $query['spid'];
  $bus_type = $query['tname'];

  $btime=$query['Bus_boarding_time'];
  $dtime=$query['Bus_departure_time'];
  $busname=$query['Bus_name']; 
 $json[$a]['ticket']=$qry1['Ticket_ID'];
$json[$a]['bus_id']=$Bus_ids;
$json[$a]['Service_Provider']=get_SP_name1($spid);
 $json[$a]['bus_type']=$bus_type;

$json[$a]['From']=$fcity;
$json[$a]['to']=$tcity ;
$json[$a]['Date_of_Journey']=$travelling_dates;

$json[$a]['Agent_id']=$agent_id;
$json[$a]['Departure_Point_Time']=$btime;
$json[$a]['Arival_Point_Time']=$dtime;
$json[$a]['Bus_name']=$busname;

$json[$a]['Total_Passengers']=$cnt;
$stno=rtrim($stno, ",");

$stno2=rtrim($stno2, ",");
$json[$a]['SeatNumber']=$stno;
$json[$a]['Total_Amount']=$stno2;
$stno='';$stno1='';$stno2='';$stno3='';
$seatno='';$booking_amt='';$travelling_date='';

$a++;


} 


//echo $t="SELECT *,b.typeName as tname,a.sp_id as spid FROM businfo as a,bustypes as b where a.Bus_id='$Bus_ids' and a.Bus_type=b.typeID ";

}


echo json_encode($json, JSON_UNESCAPED_SLASHES);
?>
