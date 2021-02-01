<?php

include "includes/header.php";

if(isset($_POST['book'])){

  //session_register('book_var'); 
 $_SESSION['book_var']=$_POST; ?>
 <?php /*?>$ress=mysql_query("select * from bookinginfo where pay_status=3");
	while($del=mysql_fetch_array($ress))
	{
	$value = strtotime($del['book_time'])."<br>";
	$cur_time=time()."<br>"; 
	$time_diff=($value-$cur_time)."<br>"; 
	$minutes = floor($time_diff % 3600 / 60);
	if($minutes>25)
	{
	mysql_query("delete from bookinginfo where auto_id='$del[auto_id]'");
	}
	}<?php */?>
	<?php

   $SP_id=mysql_real_escape_string($_POST['sp_id']);
  $Bus_id=mysql_real_escape_string($_POST['bus_id']);  
 $dat=mysql_real_escape_string($_POST['travel_date']);
 
  
  $query = mysql_fetch_array(mysql_query("SELECT * FROM businfo where Bus_id= $Bus_id "));
  $from_cityid = $query['Bus_fromcity'];
  $to_cityid = $query['Bus_tocity'];
  
  $from_city = strtoupper(get_city_name($from_cityid));
  $to_city = strtoupper(get_city_name($to_cityid));
  
  $bustype = get_bus_type($query['Bus_type']);
  //$fare = $query['Bus_fare'];
 $triptype = $_REQUEST['triptype'];
  $coupon_id=$_REQUEST['coupp'];
  $discoun=$_REQUEST['disamount'];
  $coup_id=$_REQUEST['couppid'];
  $disfare = $_REQUEST['fare'];
 
  
  $spid = get_SP_name($_POST['sp_id']);
  $time = mktime();
  $ticket = '';
  for ($x=3;$x<10;$x++) {
  $ticket .= substr($time,$x,1);
  }
  $ticket_id = date("y").date("m").date("d").strtoupper(substr($spid,0,3)).$ticket;				 
  //session_register('ticket_id'); 
  $_SESSION['ticket_id']=$ticket_id; 
  
  /*if($_POST['payment']==2) {
	  header("location: view_ticket.php");
  }*/
  
  //echo $fare."<br>".$bustype."<br>".$to_city."<br>".$from_city."<br>".$Bus_id."<br>".$dat."<br>".$SP_id."<br>".$_POST['payment'];//exit;
  
 
  
  	$tot_seat = $_SESSION['book_var']['seat_count'];
	$tot_seat_num = $_SESSION['book_var']['tot_seat'];
	$total_amt = $_SESSION['book_var']['total_amt'];
	$total_amtt = $_SESSION['book_var']['total_amtt'];
	$payment = mysql_real_escape_string($_SESSION['book_var']['payment']);
	 $bus_fare = $_POST['bus_fare']; 
//$bus_fare2 = explode("Rs. ",$bus_fare1);
	 //$bus_fare=$bus_fare2[1]; 
	$bus_type = mysql_real_escape_string($_SESSION['book_var']['bus_type']);
	$from_city = mysql_real_escape_string($_SESSION['book_var']['from_city']);
	$to_city = mysql_real_escape_string($_SESSION['book_var']['to_city']);
	$boading_point = mysql_real_escape_string($_SESSION['book_var']['boading_point']);
	
	$booker_name = mysql_real_escape_string($_POST['booker_name']);
	$email = mysql_real_escape_string($_POST['email']);
	$address1 = mysql_real_escape_string($_POST['address1']);
	$address2 = mysql_real_escape_string($_POST['address2']);
	$mobile = mysql_real_escape_string($_POST['mobile']);
	$fare = $total_amt;
	
	
	for($i=1; $i<=$tot_seat; $i++)
	{
		$seat_num = "seatno_".$i;
		$pass_name = "passname_".$i;
		$gender = "gender_".$i;
		$age = "age_".$i;
		$gen.=$_SESSION['book_var'][$gender]."," ;
		$page.=$_SESSION['book_var'][$age]."," ;
		
				
		$dt=date("Y-m-d");

		$qry = mysql_query("insert into bookinginfo (auto_id, SP_id, Bus_id, SeatNo, booking_type, travelling_date, booked_date, Ticket_ID, userid, usertype, cancelledStatus, Blocked, BlockedBy, BlockedType, PaymentType,booking_amt,pay_status ) values ('','".$SP_id."', '".$Bus_id."', '".$_SESSION['book_var'][$seat_num]."', '1', '".$dat."', '".$dt."', '".$ticket_id."', '', '1', '0', '0', '0', '0', '".$payment."','".$bus_fare."','1' ) ");
		
		
				
		if($qry)
		{
			$qry1 = mysql_query("insert into passengerinfo (passenger_ID, Ticket_ID, passenger_Name, passenger_seatNo, passenger_Gender, passenger_Age, bus_fare) values ('', '".$ticket_id."', '".$_SESSION['book_var'][$pass_name]."', '".$_SESSION['book_var'][$seat_num]."', '".$_SESSION['book_var'][$gender]."', '".$_SESSION['book_var'][$age]."', '".$bus_fare."' ) ");
		}
	}
$total_amtt1 = $total_amtt; 
$total_amtt2 = explode("Rs. ",$total_amtt1);
	 $total_amtts=$total_amtt2[1]; 
$fare1 = $fare; 
$fare2 = explode("Rs. ",$fare1);
	 $fares=$fare2[1];
	

	mysql_query("insert into booker_details (booker_id,user_id, Ticket_ID, Booker_name, Booker_email, Booker_address1, Booker_address2, Booker_mobile,booking_total,Booker_coup,Booker_discount,booking_amt, payment_type, boarding_point) values ('','$_SESSION[user_id]', '".$ticket_id."', '".$booker_name."', '".$email."', '".$address1."', '".$address2."', '".$mobile."','".$total_amtts."','".$coupon_id."','".$discoun."','".$fares."', '".$payment."', '".$boading_point."')");
	
	
	// Coupon
	
	mysql_query("update bus_coupons set coup_status=2,coup_ticket='$ticket_id' where coup_id='$coup_id'");
	
	$newaddr=$address1.($address2=='') ? " " : ", ".$address2;
	
	$ip=$_SERVER['REMOTE_ADDR'];
	
	mysql_query("INSERT INTO payment_transaction (ticket_id,Service_provider_id,trans_type, bus_id, pay_address, pay_tele, pay_email, pay_fare, pay_coupon, pay_discount, pay_amount, pay_st_time, pay_ip, ticket_count,pay_status) VALUES ('$ticket_id', '$SP_id', '1', '$Bus_id', '$newaddr', '$mobile', '$email', '$total_amtts', '$coupon_id', '$discoun', '$fares', NOW(), '$ip', '$tot_seat','1')");
	
	
  
   
  $rnd=rand(0000,9999);
  
  if($_POST['payment']==4) {
	  
	 // echo "<script>window.location='ccavenue/checkout.php?$rnd';</script>";
header("location:view_ticket.php?paysuccess&pay_id=$ticket_id");	
	  
	  
  } elseif($_POST['payment']==2) {
	  
	  echo "<script>window.location='paypal/process.php?$rnd';</script>";
	  header("location:../paypal/process.php?$rnd");
	  
  }
  
  elseif($_POST['payment']==3) {
	  
	  echo "<script>window.location='paypal/process.php?$rnd';</script>";
	  header("location:wallet_process.php?$rnd");
	  
  }
  
 
}
?>