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
$json =  array();
	$a=0;
 
   $_SESSION['back'] = htmlentities($_SERVER['REQUEST_URI']);	
   
  $agent_id=$_REQUEST['agent_id'];
  $busid=$_REQUEST['bus_id'];
  $seat_no=$_REQUEST['seat_no'];
  $ticket_id=$_REQUEST['ticket_id'];
  //cancelledStatus$qry=mysql_query("DELETE from bookinginfo  WHERE SeatNo='$seat_no' and Ticket_ID = '$ticket_id' and Bus_id='$busid' and agent_id='$agent_id' ");
$seat_nos=explode(',',$seat_no);
$cnt=count($seat_nos);
for($i=0;$i<$cnt;$i++){
$seat=$seat_nos[$i];


 $qry=mysql_query("update bookinginfo set cancelledStatus='1' WHERE SeatNo='$seat' and Ticket_ID = '$ticket_id' and Bus_id='$busid' and agent_id='$agent_id' ");




$qy=mysql_query("select * from bookinginfo  where Ticket_ID = '$ticket_id'");
while($rw=mysql_fetch_array($qy)){
$SP_id=$rw['SP_id'];

$travelling_date=$rw['travelling_date'];$book_amt=$rw['booking_amt'];

}

$q=mysql_query("select * from agents where agent_id='$agent_id'");
while($r=mysql_fetch_array($q)){$bal=$r[account_balance];}
$curbal=$bal+$book_amt;
 $qry=mysql_query("update agents set account_balance='$curbal' where agent_id='$agent_id'");

$dat=date("Y-m-d");
$qry1=mysql_query("insert into cancelled_tickets (SP_id,Bus_id,travelling_date,cancelled_date,SeatNo,book_amt,Ticket_id,userid)values('$SP_id','$busid','$travelling_date','$dat','$seat','$book_amt','$ticket_id','$agent_id') ");



}
if($qry)
{
$stat="success";

}
else
{
$stat="failure";

}

for($i=0;$i<1;$i++){
$json[$a]['status']=$stat;
$json[$a]['bus_id']=$busid;
$json[$a]['Agent_id']=$agent_id;
$json[$a]['SeatNumber']=$seat_no;

}


  

?>


									<?php 


echo json_encode($json, 1);
?>
