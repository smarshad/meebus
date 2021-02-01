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


$bussid=$_REQUEST['busid'];
$seat=explode('^',$_REQUEST['seat']);
//echo count($seat);
//print_r($seat);
$travel1=$_REQUEST['travel_date']; 
$booking_amt = explode('^',$_REQUEST['amt']);
$agent_id = $_REQUEST['agent_id'];
$boarding_point = $_REQUEST['boarding_point'];
//echo count($booking_amt);
//print_r($booking_amt);

$booking_total = array_sum($booking_amt); 

$booking_amts = array_sum($booking_amt);
$payment_type = 1; 

$randomString ='';

function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i <17; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    
	$check = "SELECT Ticket_ID FROM booker_details WHERE Ticket_ID='$randomString' ";
	$checQurey = mysql_query($check);
	$num_rows = mysql_query($checQurey);
	
	if($num_rows==0)
	{
		
		return $randomString;
		//break;
	}
	else 
	{
		generateRandomString();
	}

}
$tid = '';

//$tid = 'PHQI1QU6E2UKVMLM3';

$selectLogin="SELECT * FROM agents WHERE agent_id='$agent_id' AND status='yes'";
$resultLogin=mysql_query($selectLogin) or die("Could not match the database");
$rows=mysql_fetch_array($resultLogin);
if($rows['status']=="yes")
{
	$Booker_name=$rows['agent_name'];
	$Booker_email=$rows['email'];
	$Booker_address1=$rows['address'];
	$Booker_mobile=$rows['mobile_phone'];
}


if(isset($REQUEST['name']) && $REQUEST['name']!='')
{
	$Booker_name=$REQUEST['name'];
}

if(isset($REQUEST['email']) && $REQUEST['email']!='')
{
	$Booker_email=$REQUEST['email'];
}

if(isset($REQUEST['mobile']) && $REQUEST['mobile']!='')
{
	$Booker_mobile=$REQUEST['mobile'];
}

if(isset($REQUEST['address']) && $REQUEST['address']!='')
{
	$Booker_address1=$REQUEST['address'];
}

									

$i1=0;
for($i=0;$i<count($seat); $i++)
{
$seat1 = $seat[$i];
$select1 = "select * from bookinginfo where Bus_id='$bussid' and SeatNo=$seat1 and travelling_date='$travel1' and Blocked=1"; 
$seat_avail=mysql_num_rows(mysql_query($select1));	
if($seat_avail==0)
{
	
	
}
else
{
	
$i1++;
}

}

if($i1==0)
{
	$tid = generateRandomString();
	$insertTicket  = "INSERT INTO booker_details SET 
										agent_id		= 	'$agent_id',
										Ticket_ID 		=	'$tid', 
										Booker_name		=	'$Booker_name',
										Booker_email	=	'$Booker_email',
										Booker_address1	=	'$Booker_address1',
										Booker_mobile	=	'$Booker_mobile',
										booking_total	=	'$booking_total',
										Booker_coup		=	'',
										Booker_discount	=	'0',
										booking_amt		=	'$booking_amts',
										payment_type	=	'$payment_type',
										boarding_point	=	'$boarding_point',
										delete_status	=	'1'";
$insertTicketQuery = mysql_query($insertTicket);	

	$booked_date = date('Y-m-d',time());
	
	for($i2=0;$i2<count($seat); $i2++)
{
	$seat2 = $seat[$i2];
	$booking_amt2 =  $booking_amt[$i2];
	$inseret = "insert into bookinginfo (Bus_id, SeatNo, travelling_date, Blocked, pay_status, book_time,booking_amt,booked_date,agent_id,Ticket_ID,booking_type,PaymentType,BlockedType) values ('".$bussid."', '".$seat2."', '".$travel1."', '1', '1',NOW(),'".$booking_amt2."','".$booked_date."','".$agent_id."','".$tid."','1','1','2') ";
    $qry = mysql_query($inseret);
}
	
	
}
else 
{
	$data = array("Ticket Already Booked Please Select Other Seat");
}

if(isset($tid) && $tid!='') { $data = array($tid); }

echo json_encode($data,1);

?>  