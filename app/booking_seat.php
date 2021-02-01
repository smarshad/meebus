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
include_once("..includes/functions.php");
$_SESSION['back'] = htmlentities($_SERVER['REQUEST_URI']);
$filename = basename($_SERVER["PHP_SELF"], ".php");	

	
 
   //$_SESSION['back'] = htmlentities($_SERVER['REQUEST_URI']);	
    $Bus_id=$_REQUEST['Busid'];
     $dat=$_REQUEST['dat'];
     $seat_id=$_REQUEST['seat_id'];	
   $fare=$_REQUEST['fare'];
   $frm=$_REQUEST['frm'];
  $to=$_REQUEST['to'];
  $agent_id=$_REQUEST['agent_id'];
   $dat_str=explode("-",$dat);
  
   if($dat_str[2]<10){
      $dat_str[2]=$dat_str[2];
   }

   if($dat_str[1]<10){
      $dat_str[1]=$dat_str[1];
   }
	
	$dat=$dat_str[2]."-".$dat_str[1]."-".$dat_str[0];
$query1 = mysql_query("SELECT *,b.typeName as tname,a.sp_id as spid FROM businfo as a,bustypes as b where a.Bus_id='$Bus_id' and a.Bus_type=b.typeID ");
$query=mysql_fetch_array($query1);
	$spid = $query['spid'];
  $bus_type = $query['tname'];
  $btime=$query['Bus_boarding_time'];
  $dtime=$query['Bus_departure_time'];
  $busname=$query['Bus_name']; 
  $time = mktime();
  $ticket = '';
  for ($x=3;$x<10;$x++) {
  $ticket .= substr($time,$x,1);
  }
  $ticket_id = date("y").date("m").date("d").strtoupper(substr($spid,0,3)).$ticket;				 
  //session_register('ticket_id'); 
  $_SESSION['ticket_id']=$ticket_id; 

?>


									<?php 
$st_id=explode(',',$seat_id);
$conts=count($st_id);
$tot_fare=$conts*$fare;
$seat_no='';$cnt='';
for($j=0;$j<$conts;$j++){
$sid=$st_id[$j];

if($sid!=''){
$seat_no.=$sid.",";
 //echo $q="select * from bookinginfo where Bus_id='$Bus_id' and SeatNo='$sid' and travelling_date='$dat'";
 $qrys = mysql_query("select * from bookinginfo where Bus_id='$Bus_id' and SeatNo='$sid' and travelling_date='$dat'");
$num= mysql_num_rows($qrys);

if($num>=1){$cnt.=$sid.',';}

}
}

if($cnt==''){
for($k=0;$k<$conts;$k++){
$sid1=$st_id[$k];

if($sid1!=''){
$seat_no.=$sid1.",";

$qry = mysql_query("insert into bookinginfo (Bus_id,SP_id, SeatNo, booking_type, travelling_date, booked_date, Ticket_ID, usertype, booking_amt,agent_id,pay_status ) values ('".$Bus_id."','".$spid."', '".$sid1."', '1', '".$dat."', NOW(), '".$ticket_id."', '1','".$fare."','".$agent_id."','1' ) ");
}
}
}else{$cnt=rtrim($cnt,',');$stat="failure";}
if($qry)
{
$stat="success";

}
else
{
$stat="failure";

}
$seat_no=rtrim($seat_no, ",");
$json =  array();
for($a=0;$a<1;$a++){
 $json[$a]['status']=$stat;
 $json[$a]['ticket']=$ticket_id;
 $json[$a]['Service_Provider']=get_SP_name($spid);
 $json[$a]['bus_type']=$bus_type;
 $json[$a]['From']=$frm;
$json[$a]['to']=$to;
$json[$a]['Date_of_Booking']=date('Y-m-d');
$json[$a]['Date_of_Journey']=$dat;
$json[$a]['Agent_id']=$agent_id;
$json[$a]['Departure_Point_Time']=$btime;
$json[$a]['Arrival_Point_Time']=$dtime;
$json[$a]['Bus_name']=$busname;
$json[$a]['Total_Passengers']=$conts;
$json[$a]['SeatNumber']=$seat_no;
$json[$a]['Total_Amount']=$tot_fare;
$json[$a]['Already_Booked_Seatno']=$cnt;

}
echo json_encode($json, JSON_UNESCAPED_SLASHES);
?>
