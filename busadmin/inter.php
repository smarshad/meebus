<?php
require_once("../config/config.php");
include_once("../includes/functions.php");
if(isset($_POST['book'])){
  session_register('book_var'); 
  $_SESSION['book_var']=$_POST; 
// print_r($_SESSION['book_var']);     exit;
  /*
  tot_seat
  seat_count
  total_amt
  boading_point
  bus_fare
  bus_type
  from_city
  to_city
  bus_id
  travel_date
  sp_id
  merchant
  seatno_1
  passname_1
  gender_1
  age_1
  booker_name
  email
  address1
  address2
  mobile
  payment
  */
  
  //exit;
  //echo $_SESSION['book_var']['total_amt'];
  
  			///// Generate Ticket Number
			      $spid = get_SP_name($_POST['sp_id']);
			      $time = mktime();
                  $ticket = '';
                  for ($x=3;$x<10;$x++) {
                  $ticket .= substr($time,$x,1);
                  }
	              $ticket_id = date("y").date("m").date("d").strtoupper(substr($spid,0,3)).$ticket;				 
				  session_register('ticket_id'); 
				  $_SESSION['ticket_id']=$ticket_id;
			///// End 
  
  
  if(isset($_POST['payment'])){
     $pay_option=$_POST['payment'];
	 if($pay_option==1)
     header("location: payment/HostedPaymentBuy.php");
	 elseif($pay_option==2)
	 header("location: payment/paypal.php");
	 elseif($pay_option==3)
	 header("location: payment/payment.php");
	 elseif($pay_option==0)
	 header("location: view_ticket.php");
	 else
	 header("location: home.php");
  } 
}
?>
