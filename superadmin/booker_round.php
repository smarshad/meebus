<?php
include "includes/header.php";

//echo "<h2>Available Seats</h2>";


// JOURNEY DATE

    $Bus_id=$_SESSION['bbusidd'];
	$dat=$_SESSION['trav_from'];
	$triptype=2;
	$query = mysql_fetch_array(mysql_query("SELECT * FROM businfo where Bus_id= $Bus_id "));
	$from_city = $query['Bus_fromcity'];
	$fcity = get_city_name($from_city);
	$to_city = $query['Bus_tocity'];
	$SP_id = $query['SP_id'];
	$_SESSION['SP_id']=$SP_id;
	$tcity = get_city_name($to_city);
	$bus_name=$query['Bus_name'];
	//$ftcity = ucfirst($fcity)." - ".ucfirst($tcity);
	$boarding_point = explode(",",$query['Bus_boarding_time']);
	// print_r($boarding_point);
	$tot_seat = substr($_SESSION['sseatt22'],0,-1);
	$total_seats = explode(",",$tot_seat); 
	$count = count($total_seats);
	$tott_fare=($count*$query['Bus_fare']); 
	

//RETURN DATE

	$Bus_id1=$_SESSION['bbusidd1'];
	$dat1=$_SESSION['trav_too'];
	$triptype=2;
	$query1 = mysql_fetch_array(mysql_query("SELECT * FROM businfo where Bus_id= '$Bus_id1' "));
	$SP_id1 = $query1['SP_id'];
	$_SESSION['SP_id1']=$SP_id1;
	$from_city1 = $query1['Bus_fromcity'];
	$fcity1 = get_city_name($from_city1);
	$to_city1 = $query1['Bus_tocity'];
	$tcity1 = get_city_name($to_city1);
	$bus_name1=$query1['Bus_name'];
	//$ftcity = ucfirst($fcity)." - ".ucfirst($tcity);
	$boarding_point1 = explode(",",$query['Bus_boarding_time']);
	// print_r($boarding_point);
	$tot_seat1 = substr($_SESSION['sseattt1'],0,-1);
	$total_seats1 = explode(",",$tot_seat1); 
	$count1 = count($total_seats1);
	$tott_fare1=($count1*$query1['Bus_fare']); 
	

   
    $tr_date=$dat;
	$t_date=changedateformat($tr_date);
	
	
	 //check for promotion for journey date
	$total_amtt=$tott_fare;
	$bus_prom=$query['bus_promo'];
	if($bus_prom=="")
	{
	 $fare = $total_amtt;
	 }
	 else
	 {
	 $promo_sql=mysql_query("select * from bus_promo where promo_id='$bus_prom' and promo_status='0'");
	 $promo_count=mysql_num_rows($promo_sql);
	 if($promo_count>0) {
	 $bus_promo=mysql_fetch_array($promo_sql);
	 $promo_type=$bus_promo['promo_type'];
	 $promo_from=$bus_promo['promo_from'];
	 $promo_to=$bus_promo['promo_to'];
	 $promo_atype=$bus_promo['promo_atype'];
	 $promo_value=$bus_promo['promo_value'];
	 $promo_ftime=$bus_promo['promo_ftime'];
	 $promo_ttime=$bus_promo['promo_ttime'];
	 if($promo_type==1) {
	 
	 if(($dat>=$promo_from) && ($dat<=$promo_to))
	 {
	 if($promo_atype==1) {
	  $fare = ($total_amtt-$promo_value);
	 }
	 else if($promo_atype==2) {
	 
	  $pro_dis=($total_amtt*($promo_value/100));
	  $fare = ($total_amtt-$pro_dis);
	 }
	 else {  $fare = $total_amtt; }
	 }
	 else {  $fare = $total_amtt; }	 
	 }
	 else if($promo_type==2) {
	 
	 $ftime=explode(" ",$promo_ftime);
	 $ttime=explode(" ",$promo_ttime);
	$ffrom=strtotime($ftime[0])."<br>";
	 $tto=strtotime($ttime[0])."<br>";	
			
	 $cur_time=strtotime(date("Y-m-d g:ia"));
	 
	 if(($dat>=$promo_from) && ($dat<=$promo_to) && ($cur_time>=$ffrom) && ($cur_time<=$tto))
	 {
	 //echo "dfdgfhgjgk";
	 if($promo_atype==1) {
	 $fare = ($total_amtt-$promo_value);
	 }
	 else if($promo_atype==2) {
	 
	  $pro_dis=($total_amtt*($promo_value/100));
	  $fare = ($total_amtt-$pro_dis);
	 }
	 else {  $fare = $total_amtt; }
	 }
	
	 else
	 {  $fare = $total_amtt; }
	 }
	 else
	 {
	  $fare = $total_amtt;
	 }
	 }
	  else
	 {
	  $fare = $total_amtt;
	 }
	 }
	 
	 //check for promotion for Return date
	$total_att=$tott_fare1;
	$bus_prom1=$query1['bus_promo'];
	if($bus_prom=="")
	{
	 $fare1 = $total_att;
	 }
	 else
	 {
	 $promo_sql1=mysql_query("select * from bus_promo where promo_id='$bus_prom' and promo_status='0'");
	 $promo_count1=mysql_num_rows($promo_sql1);
	 if($promo_count1>0) {
	 $bus_promo1=mysql_fetch_array($promo_sql1);
	 $promo_type1=$bus_promo1['promo_type'];
	 $promo_from1=$bus_promo1['promo_from'];
	 $promo_to1=$bus_promo1['promo_to'];
	 $promo_atype1=$bus_promo1['promo_atype'];
	 $promo_value1=$bus_promo1['promo_value'];
	 $promo_ftime1=$bus_promo1['promo_ftime'];
	 $promo_ttime1=$bus_promo1['promo_ttime'];
	 if($promo_type1==1) {
	 
	 if(($dat1>=$promo_from1) && ($dat1<=$promo_to1))
	 {
	 if($promo_atype1==1) {
	  $fare1 = ($total_att-$promo_value1);
	 }
	 else if($promo_atype1==2) {
	 
	  $pro_dis1=($total_att*($promo_value1/100));
	  $fare1 = ($total_att-$pro_dis1);
	 }
	 else {  $fare1 = $total_att; }
	 }
	 else {  $fare1 = $total_att; }	 
	 }
	 else if($promo_type1==2) {
	 
	 $ftime1=explode(" ",$promo_ftime1);
	 $ttime1=explode(" ",$promo_ttime1);
	$ffrom1=strtotime($ftime1[0])."<br>";
	 $tto1=strtotime($ttime1[0])."<br>";	
			
	$cur_time1=strtotime(date("Y-m-d g:ia"));
	 
	 if(($dat1>=$promo_from1) && ($dat1<=$promo_to1) && ($cur_time1>=$ffrom1) && ($cur_time1<=$tto1))
	 {
	 //echo "dfdgfhgjgk";
	 if($promo_atype1==1) {
	 $fare1 = ($total_att-$promo_value1);
	 }
	 else if($promo_atype1==2) {
	 
	  $pro_dis1=($total_att*($promo_value1/100));
	  $fare1 = ($total_att-$pro_dis1);
	 }
	 else {  $fare1 = $total_att; }
	 }
	
	 else
	 {  $fare1 = $total_att; }
	 }
	 else
	 {
	  $fare1 = $total_att;
	 }
	 }
	  else
	 {
	  $fare1 = $total_att;
	 }
	 }
	 
	 $total_tot=($fare+$fare1);
   
   if(isset($_REQUEST['book']))
   { 
   		   
			
		  //JOURNEY
		  $SP_id=$_SESSION['SP_id'];
		  $Bus_id=$_SESSION['bbusidd'];
		  $dat=$_SESSION['trav_from']; 
		  $query = mysql_fetch_array(mysql_query("SELECT * FROM businfo where Bus_id= $Bus_id "));
		  $from_cityid = $query['Bus_fromcity'];
		  $to_cityid = $query['Bus_tocity'];
		  $from_city = strtoupper(get_city_name($from_cityid));
		  $to_city = strtoupper(get_city_name($to_cityid)); 
		  $bustype = get_bus_type($query['Bus_type']);
		  //$fare = $query['Bus_fare'];
		  
		  
		  //RETURN
		  $SP_id1=$_SESSION['SP_id1'];
		  $Bus_id1=$_SESSION['bbusidd1'];
		  $dat1=$_SESSION['trav_too']; 
		  $query1 = mysql_fetch_array(mysql_query("SELECT * FROM businfo where Bus_id= $Bus_id1 "));
		  $from_cityid1 = $query1['Bus_fromcity'];
		  $to_cityid1 = $query1['Bus_tocity'];
		  $from_city1 = strtoupper(get_city_name($from_cityid1));
		  $to_city1 = strtoupper(get_city_name($to_cityid1)); 
		  $bustype1 = get_bus_type($query1['Bus_type']);
			
			
			///// Generate Ticket Number
			$spid = get_SP_name($_POST['sp_id']);
			$time = mktime();
			$ticket = '';
			for ($x=3;$x<10;$x++) {
			$ticket .= substr($time,$x,1);
			}
			$ticket_id = date("y").date("m").date("d").strtoupper(substr($spid,0,3)).$ticket;
			///// End 
			
			// RETURN TICKET
			$spid1 = get_SP_name($_POST['sp_id1']);
			$time1 = mktime();
			$ticket1 = '';
			for ($x=3;$x<10;$x++) {
			$ticket1 .= substr($time1,$x,1);
			}
			$ticket_id1 = date("d").date("m").date("y").strtoupper(substr($spid1,0,3)).$ticket1;	
			
			
			//COUPON
			$triptype = 2;
			$coupon_id=$_REQUEST['coupp'];
			$percent=$_REQUEST['percent'];
			$coup_id=$_REQUEST['couppid'];
			$disfare = $_REQUEST['fare'];
			
						
			//JOURNEY DATE
			
			$tot_seat = $_REQUEST['seat_count'];
			$tot_seat_num = $_REQUEST['tot_seat'];
			$total_amt2 = $_REQUEST['total_amt2'];
			
			$bus_fare = $_REQUEST['bus_fare'];
			$bus_type = $_REQUEST['bus_type'];
			$from_city = $_REQUEST['from_city'];
			$to_city = $_REQUEST['to_city'];
			$boading_point = $_REQUEST['boading_point'];
			$fare_tot=($tot_seat*$bus_fare);			
			$dis_bus=($fare_tot*($percent/100)); // Journey date discount	
			if($disfare=="")
			{
			$tot_fare=$total_amt2;
			}
			else
			{
			$tot_fare=($total_amt2-$dis_bus);
			}
			
			//RETURN DATE
			
			$tot_seat1 = $_REQUEST['seat_count1'];
			$tot_seat_num1 = $_REQUEST['tot_seat1'];
			$total_amt1 = $_REQUEST['total_amt1'];
			
			$bus_fare1 = $_REQUEST['bus_fare1'];
			$bus_type1 = $_REQUEST['bus_type1'];
			$from_city1 = $_REQUEST['from_city1'];
			$to_city1 = $_REQUEST['to_city1'];
			$boading_point1 = $_REQUEST['boading_point1'];
			$fare_tot1=($tot_seat1*$bus_fare1);				
			$dis_bus1=($fare_tot1*($percent/100)); // Journey date discount
			if($disfare=="")
			{
			$tot_fare1=$total_amt1;
			}
			else
			{
			$tot_fare1=($total_amt1-$dis_bus1);
			}	
	
	
	        $booker_name = mysql_real_escape_string($_REQUEST['booker_name']);
			$email = mysql_real_escape_string($_REQUEST['email']);
			$address1 = mysql_real_escape_string($_REQUEST['address1']);
			$address2 = mysql_real_escape_string($_REQUEST['address2']);
			$mobile = mysql_real_escape_string($_REQUEST['mobile']);
			$payment = mysql_real_escape_string($_REQUEST['payment']);
	
			  if($disfare=="")
			  {
			  $fare = ($total_amt2+$total_amt1);
			  }
			  else
			  {
			  $fare = $_REQUEST['fare'];
			  }
	
			for($i=1; $i<=$tot_seat; $i++)
	{
		$seat_num = "seatno_".$i;
		$pass_name = "passname_".$i;
		$gender = "gender_".$i;
		$age = "age_".$i;
		$gen.=$_REQUEST[$gender]."," ;
		$page.=$_REQUEST[$age]."," ;						
		
		$qry = mysql_query("insert into bookinginfo (auto_id, SP_id, Bus_id, SeatNo, booking_type, travelling_date, booked_date, Ticket_ID, userid, usertype, cancelledStatus, Blocked, BlockedBy, BlockedType, PaymentType,booking_amt ) values ('','".$SP_id."', '".$Bus_id."', '".$_REQUEST[$seat_num]."', '".$triptype."', '".$dat."', NOW(), '".$ticket_id."', '".$_SESSION['accessing_LogID']."', '".$_SESSION['accessing_type']."', '0', '1', '0', '0', '".$payment."','".$bus_fare."' ) ");
				
		if($qry)
		{
			$qry1 = mysql_query("insert into passengerinfo (passenger_ID, Ticket_ID, passenger_Name, passenger_seatNo, passenger_Gender, passenger_Age, bus_fare) values ('', '".$ticket_id."', '".$_REQUEST[$pass_name]."', '".$_REQUEST[$seat_num]."', '".$_REQUEST[$gender]."', '".$_REQUEST[$age]."', '".$bus_fare."' ) ");
		}
	}
	
	mysql_query("insert into booker_details (booker_id,user_id, Ticket_ID, Booker_name, Booker_email, Booker_address1, Booker_address2, Booker_mobile,booking_total,Booker_coup,Booker_discount,booking_amt, payment_type, boarding_point) values ('','$_SESSION[user_id]', '".$ticket_id."', '".$booker_name."', '".$email."', '".$address1."', '".$address2."', '".$mobile."','".$total_amt2."','".$coupon_id."','".$dis_bus."','".$tot_fare."', '".$payment."', '".$boading_point."')");

	for($i=1; $i<=$tot_seat1; $i++)
	{
		$seat_num1 = "seatno1_".$i;
		$pass_name = "passname_".$i;
		$gender = "gender_".$i;
		$age = "age_".$i;
		$gen.=$_REQUEST[$gender]."," ;
		$page.=$_REQUEST[$age]."," ;						
		
		$qry = mysql_query("insert into bookinginfo (auto_id, SP_id, Bus_id, SeatNo, booking_type, travelling_date, booked_date, Ticket_ID, userid, usertype, cancelledStatus, Blocked, BlockedBy, BlockedType, PaymentType,booking_amt ) values ('','".$SP_id1."', '".$Bus_id1."', '".$_REQUEST[$seat_num1]."', '".$triptype."', '".$dat1."', NOW(), '".$ticket_id1."', '".$_SESSION['accessing_LogID']."', '".$_SESSION['accessing_type']."', '0', '1', '0', '0', '".$payment."','".$bus_fare1."' ) ");
				
		if($qry)
		{
			$qry1 = mysql_query("insert into passengerinfo (passenger_ID, Ticket_ID, passenger_Name, passenger_seatNo, passenger_Gender, passenger_Age, bus_fare) values ('', '".$ticket_id1."', '".$_REQUEST[$pass_name]."', '".$_REQUEST[$seat_num1]."', '".$_REQUEST[$gender]."', '".$_REQUEST[$age]."', '".$bus_fare1."' ) ");
		}
	}

	mysql_query("insert into booker_details (booker_id,user_id, Ticket_ID, Booker_name, Booker_email, Booker_address1, Booker_address2, Booker_mobile,booking_total,Booker_coup,Booker_discount,booking_amt, payment_type, boarding_point) values ('','$_SESSION[user_id]', '".$ticket_id1."', '".$booker_name."', '".$email."', '".$address1."', '".$address2."', '".$mobile."','".$total_amt1."','".$coupon_id."','".$dis_bus1."','".$tot_fare1."', '".$payment."', '".$boading_point1."')");
					
					//echo $_SERVER[PHP_SELF];
		 $exp = explode("/admin", dirname($_SERVER[PHP_SELF]));
	
        $image = $exp[0].'/images/'.$imglogo;  
 			
		//$fullpath = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]);
		
		$img = "http://$_SERVER[HTTP_HOST]".$image; 
							
		//$image = $fullpath.'/images/'.$imglogo ;		
							
		$subject = "Receive your Ticker from ".$title ;	
					
		$msg = "<table width='700' cellpadding='0' cellspacing='0' border='0' bgcolor='#F49E23' style='border:solid 10px #A5DCFF;'> 

	<tr bgcolor='#FFFFFF' height='25'> 
	
		<td height='94'>

			<img src='$img' border='0' width='180' height='120'/>

		</td> 

	</tr> 

	<tr bgcolor='#FFFFFF'> <td> </td> </tr> 

<tr bgcolor='#FFFFFF'><td style='color:#0575BD; font-size:14px;'>".strtoupper(get_city_name($from_city1))." to ".strtoupper(get_city_name($to_city1))."</td></tr>

<tr bgcolor='#FFFFFF'> <td> </td> </tr> 

	
	<tr bgcolor='#FFFFFF'><td>

	<table cellpadding='7' cellspacing='10' border='0' width='100%' class='normal' style='border:1px solid #B7E3FF; background:#F3FBFF; padding:10px;'>
	
						<tr>
							<td width='50'>&nbsp;</td>
							<td valign='top' width='175' nowrap='nowrap'><b>Ticket Number</b></td>
							<td valign='top' width='25'>:</td>
							<td valign='top' width='150'>  ".$ticket_id."</td>
							<td valign='top' width='50'></td>
							<td valign='top' width='150'><b>Mobile Number</b></td>
							<td valign='top' width='25'>:</td>
							<td valign='top' width='150'>".$mobile."</td>
							<td width='50'>&nbsp;</td>
						</tr>

						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Service Provider & Type</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".ucwords($spid). "  ".$bus_type."</td>
							<td valign='top'></td>
							<td valign='top' nowrap='nowrap'><b>Booker Name & Email</b></td>
							<td valign='top'>:</td>
							<td valign='top'>". ucwords($booker_name)." & ".$email."</td>
							<td>&nbsp;</td>
						</tr>
												
						<tr>
							<td width='50'>&nbsp;</td>
							<td valign='top' width='175'><b>From</b></td>
							<td valign='top' width='25'>:</td>
							<td valign='top' width='150'>".strtoupper($from_city)."</td>
							<td valign='top' width='50'></td>
							<td valign='top' width='150'><b>To</b></td>
							<td valign='top' width='25'>:</td>
							<td valign='top' width='150'>".strtoupper($to_city)."</td>
							<td width='50'>&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Date of Booking</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".date('d-m-Y')."</td>
							<td valign='top'></td>
							<td valign='top' nowrap='nowrap'><b>Date of Journey</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$t_date."</td>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Departure Time </b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$boading_point."</td>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Total Passengers</b></td>
							<td valign='top'>:</td>
							<td valign='top'>". $tot_seat."</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Seat Number(s)</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$tot_seat_num."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Fare per Ticket</b></td>
							<td valign='top'>:</td>
							<td valign='top'>Rs.".$bus_fare."</td>
							
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Passenger Gender</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$gen."</td>
							<td valign='top'></td>
							<td valign='top' nowrap='nowrap'><b>Passenger Age</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$page."</td>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Total Amount</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$total_amt2."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>Address</td>
							<td valign='top'>:</td>
							<td valign='top'>".$address1.",".$address1."</td>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Promotional Code</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$coupon_id."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>Discount Amount</td>
							<td valign='top'>:</td>
							<td valign='top'>".$dis_bus."</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Total amount Paid</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$tot_fare."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						
						</table>

	  </td>
	</tr>
	<tr bgcolor='#FFFFFF'> <td> </td> </tr>
	<tr bgcolor='#FFFFFF'><td style='color:#0575BD; font-size:14px;'>".strtoupper(get_city_name($from_city1))." to ".strtoupper(get_city_name($to_city1))."</td></tr>
	<tr bgcolor='#FFFFFF'> <td> </td> </tr>
	<tr bgcolor='#FFFFFF'><td>


	<table cellpadding='7' cellspacing='10' border='0' width='100%' class='normal' style='border:1px solid #B7E3FF; background:#F3FBFF; padding:10px;'>
						<tr>
							<td width='50'>&nbsp;</td>
							<td valign='top' width='175' nowrap='nowrap'><b>Ticket Number</b></td>
							<td valign='top' width='25'>:</td>
							<td valign='top' width='150'>  ".$ticket_id1."</td>
							<td valign='top' width='50'></td>
							<td valign='top' width='150'><b>Mobile number</b></td>
							<td valign='top' width='25'>:</td>
							<td valign='top' width='150'>".$mobile."</td>
							<td width='50'>&nbsp;</td>
						</tr>

						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Service Provider & Type</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".ucwords($spid1). "  ".$bus_type1."</td>
							<td valign='top'></td>
							<td valign='top' nowrap='nowrap'><b>Booker Name & Email</b></td>
							<td valign='top'>:</td>
							<td valign='top'>". ucwords($booker_name)." & ".$email."</td>
							<td>&nbsp;</td>
						</tr>
												
						<tr>
							<td width='50'>&nbsp;</td>
							<td valign='top' width='175'><b>From</b></td>
							<td valign='top' width='25'>:</td>
							<td valign='top' width='150'>".strtoupper(get_city_name($from_city1))."</td>
							<td valign='top' width='50'></td>
							<td valign='top' width='150'><b>To</b></td>
							<td valign='top' width='25'>:</td>
							<td valign='top' width='150'>".strtoupper(get_city_name($to_city1))."</td>
							<td width='50'>&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Date of Booking</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".date('d-m-Y')."</td>
							<td valign='top'></td>
							<td valign='top' nowrap='nowrap'><b>Date of Journey</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".changedateformat($dat1)."</td>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Departure Time </b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$boading_point1."</td>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Total Passengers</b></td>
							<td valign='top'>:</td>
							<td valign='top'>". $tot_seat1."</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Seat Number(s)</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$tot_seat_num1."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Fare per Ticket</b></td>
							<td valign='top'>:</td>
							<td valign='top'>Rs. ".$bus_fare1."</td>
							
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Passenger Gender</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$gen."</td>
							<td valign='top'></td>
							<td valign='top' nowrap='nowrap'><b>Passenger Age</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$page."</td>
							<td>&nbsp;</td>
						</tr>
						
						
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Total Amount</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$total_amt1."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>Address</td>
							<td valign='top'>:</td>
							<td valign='top'>".$address1.",".$address1."</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Promotional Code</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$coupon_id."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>Discount Amount</td>
							<td valign='top'>:</td>
							<td valign='top'>".$dis_bus1."</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Total amount Paid</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$tot_fare1."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						</table>

	 </td>
	</tr>
	
	<tr bgcolor='#FFFFFF'> 

		<td height='77' align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> 


			<p>Regards,<br> $siteteam <br>  <a href='$siteurl' target='_blank'> $siteurl </a> </p>

  		</td>

	</tr> 

	<tr bgcolor='#FFFFFF'><td> </td></tr> 	

	<tr height='40'> 	

		<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color: #A5DCFF;'>

			<font color='black'> &copy; Copyright 2013 <b><i> $siteteam </i></b>. </font>			

		</td> 

	</tr> 


</table>";


					
$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From:'.$website_name.'<'.$mail_url.'>' . "\r\n";

//echo $email."<br>".$subject."<br>".$msg."<br>".$headers;  exit;


	
	echo $mess = "
	<table cellpadding='7' cellspacing='10' border='0' width='98%' class='normal' style='background:#ffffff; padding:10px;'>
	
	<tr><td align='left' style='padding-left:30px;'><!--<a href=' booker_details.php?bus_id=$Bus_id&travel_date=$dat'><strong>Back</strong></a>--></td><td align='right' style='padding-right:30px;'><a href='#' onClick='javascript:print()'><strong>Print</strong></a></td></tr>
	<tr><td align='center' colspan='2'><font color='green'><b> Your Ticket has been sent to your mail. Please, Go to check your mail and print the ticket.</b></font></td></tr>
	<tr><td colspan='2' style='color:#0575BD; font-size:14px; font-weight:bold;'>".strtoupper(get_city_name($from_city))." to ".strtoupper(get_city_name($to_city))." (Up Ticket)</td></tr>
	<tr><td colspan='2'>
	<table cellpadding='7' cellspacing='10' border='0' width='100%' style='border:1px solid #B7E3FF; background:#B7E3FF; padding:10px;'>
						
						<tr><td colspan='9' align='center'><strong>Ticket Details </strong></td></tr>
						
						<tr>
							<td width='20'>&nbsp;</td>
							<td valign='top' width='175' nowrap='nowrap'><b>Ticket Number</b></td>
							<td valign='top' width='25'>:</td>
							<td valign='top' width='150'>  ".$ticket_id."</td>
							<td valign='top' width='50'></td>
							<td valign='top' width='150'><b>Mobile Number</b></td>
							<td valign='top' width='25'>:</td>
							<td valign='top' width='150'>".$mobile."</td>
							<td width='10'>&nbsp;</td>
						</tr>

						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Service Provider & Type</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".ucwords($spid). "  ".$bus_type."</td>
							<td valign='top'></td>
							<td valign='top' nowrap='nowrap'><b>Booker Name</b></td>
							<td valign='top'>:</td>
							<td valign='top'>". ucwords($booker_name)." & ".$email."</td>
							<td>&nbsp;</td>
						</tr>
												
						<tr>
							<td width='30'>&nbsp;</td>
							<td valign='top' width='175'><b>From</b></td>
							<td valign='top' width='25'>:</td>
							<td valign='top' width='150'>".strtoupper($from_city)."</td>
							<td valign='top' width='50'></td>
							<td valign='top' width='150'><b>To</b></td>
							<td valign='top' width='25'>:</td>
							<td valign='top' width='150'>".strtoupper($to_city)."</td>
							<td width='10'>&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Date of Booking</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".date('d-m-Y')."</td>
							<td valign='top'></td>
							<td valign='top' nowrap='nowrap'><b>Date of Journey</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$t_date."</td>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Departure Time </b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$boading_point."</td>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Total Passengers</b></td>
							<td valign='top'>:</td>
							<td valign='top'>". $tot_seat."</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Seat Number(s)</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$tot_seat_num."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Fare per Ticket</b></td>
							<td valign='top'>:</td>
							<td valign='top'>Rs.
                            ".$bus_fare."</td>
							
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Passenger Gender</b></td>
							<td valign='top'>:</td>
							<td valign='top'>
							".substr($gen,0,-1)."</td>
							<td valign='top'></td>
							<td valign='top' nowrap='nowrap'><b>Passenger Age</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".substr($page,0,-1)."</td>
							<td>&nbsp;</td>
						</tr>
						
						
						
						<tr>
							<td align='left'>&nbsp;</td>
							<td align='left' valign='top' nowrap='nowrap'><b>Total Amount</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>".$total_amt2."</td>
							<td align='left' valign='top'>&nbsp;</td>
							<td align='left' valign='top'>Address</td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>".$address1.",".$address1."</td>
							<td align='left'>&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Promotional Code</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$coupon_id."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>Discount Amount</td>
							<td valign='top'>:</td>
							<td valign='top'>".$dis_bus."</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Total amount Paid</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$tot_fare."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						</table>
						
						</td></tr>
						
						<tr><td colspan='2' style='color:#0575BD; font-size:14px; font-weight:bold;'>".strtoupper(get_city_name($from_city1))." to ".strtoupper(get_city_name($to_city1))." (Down Ticket) </td></tr>
						
						<tr><td colspan='2'>
	<table cellpadding='7' cellspacing='10' border='0' width='100%' style='border:1px solid #B7E3FF; background:#B7E3FF; padding:10px;'>
						
						<tr><td colspan='9' align='center'><strong>Ticket Details </strong></td></tr>
						
						<tr>
							<td align='left' width='20'>&nbsp;</td>
							<td align='left' valign='top' width='175' nowrap='nowrap'><b>Ticket Number</b></td>
							<td align='left' valign='top' width='25'>:</td>
							<td align='left' valign='top' width='150'>  ".$ticket_id1."</td>
							<td align='left' valign='top' width='50'></td>
							<td align='left' valign='top' width='150'><b>Mobile Number</b></td>
							<td align='left' valign='top' width='25'>:</td>
							<td align='left' valign='top' width='150'>".$mobile."</td>
							<td align='left' width='10'>&nbsp;</td>
						</tr>

						<tr>
							<td align='left'>&nbsp;</td>
							<td align='left' valign='top' nowrap='nowrap'><b>Service Provider & Type</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>".ucwords($spid1). "  ".$bus_type1."</td>
							<td align='left' valign='top'></td>
							<td align='left' valign='top' nowrap='nowrap'><b>Booker Name & Email</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>". ucwords($booker_name1)." & ".$email."</td>
							<td align='left'>&nbsp;</td>
						</tr>
												
						<tr>
							<td align='left' width='30'>&nbsp;</td>
							<td align='left' valign='top' width='175'><b>From</b></td>
							<td align='left' valign='top' width='25'>:</td>
							<td align='left' valign='top' width='150'>".strtoupper(get_city_name($from_city1))."</td>
							<td align='left' valign='top' width='50'></td>
							<td align='left' valign='top' width='150'><b>To</b></td>
							<td align='left' valign='top' width='25'>:</td>
							<td align='left' valign='top' width='150'>".strtoupper(get_city_name($to_city1))."</td>
							<td align='left' width='10'>&nbsp;</td>
						</tr>
						
						<tr>
							<td align='left'>&nbsp;</td>
							<td align='left' valign='top' nowrap='nowrap'><b>Date of Booking</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>".date('d-m-Y')."</td>
							<td align='left' valign='top'></td>
							<td align='left' valign='top' nowrap='nowrap'><b>Date of Journey</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>".changedateformat($dat1)."</td>
							<td align='left'>&nbsp;</td>
						</tr>
						
						<tr>
							<td align='left'>&nbsp;</td>
							<td align='left' valign='top' nowrap='nowrap'><b>Departure Time </b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>".$boading_point1."</td>
							<td align='left'>&nbsp;</td>
							<td align='left' valign='top' nowrap='nowrap'><b>Total Passengers</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>". $tot_seat1."</td>
						</tr>
						
						<tr>
							<td align='left'>&nbsp;</td>
							<td align='left' valign='top' nowrap='nowrap'><b>Seat Number(s)</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>".$tot_seat_num1."</td>
							<td align='left' valign='top'>&nbsp;</td>
							<td align='left' valign='top' nowrap='nowrap'><b>Fare per Ticket</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>Rs.".$bus_fare1."</td>
							<td align='left'>&nbsp;</td>
						</tr>
						
						<tr>
							<td align='left'>&nbsp;</td>
							<td align='left' valign='top' nowrap='nowrap'><b>Passenger Gender</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>".substr($gen,0,-1)."</td>
							<td align='left' valign='top'></td>
							<td align='left' valign='top' nowrap='nowrap'><b>Passenger Age</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>".substr($page,0,-1)."</td>
							<td align='left'>&nbsp;</td>
						</tr>
						
						
						
						<tr>
							<td align='left'>&nbsp;</td>
							<td align='left' valign='top' nowrap='nowrap'><b>Total Amount</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>".$total_amt1."</td>
							<td align='left' valign='top'>&nbsp;</td>
							<td align='left' valign='top'>Address</td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>".$address1.",".$address1."</td>
							<td align='left'>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Promotional Code</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$coupon_id."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>Discount Amount</td>
							<td valign='top'>:</td>
							<td valign='top'>".$dis_bus1."</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Total amount Paid</b></td>
							<td valign='top'>:</td>
							<td valign='top'>".$tot_fare1."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						</table>
						
						</td></tr>
						
						
						</table>";
						
						mail($email,$subject,$msg,$headers);
						
/*if(mail($email,$subject,$msg,$headers))
{						
	
}
else
{
	
	header("Location: booker_details.php?bus_id=$Bus_id&travel_date=$dat");
}*/


			
	
   		
   }
   else{
   
   ?>
   
<script type="text/javascript">
function discountcheq(val,val1,val2,val3,val4,val5,val6,val7)
{
/*alert(val);
alert(val1);
alert(val2);
alert(val3);*/
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("discount_res").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","calc_round.php?code="+val+"&spid="+val1+"&busid="+val2+"&spid1="+val3+"&busid1="+val4+"&fare="+val5+"&dat="+val6+"&dat1="+val7,true);
xmlhttp.send();
}
</script>

<script>
function cheqcode(val,val1,val2,val3,val4,val5,val6)
{
/*alert(val);
alert(val1);
alert(val2);*/
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("check_res").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","cheqcode.php?code="+val+"&spid="+val1+"&busid="+val2+"&spid1="+val3+"&busid1="+val4+"&dat="+val5+"&dat1="+val6,true);
xmlhttp.send();
}
</script>


<script type="text/javascript">

function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
            }
         return true;
      }
</script>


<fieldset class="table-bor">
		<legend><strong> Booker Details </strong></legend> 
<form name="form" action="inter_round.php" method="post">
				<table cellpadding="1" cellspacing="5" border="0" width="100%" >
				<tr><td colspan="2">&nbsp; </td></tr>
				<tr><td colspan="2">
					
			
<table>
<tr>
<td height="38" style="padding-left:18px; font-size:12px; color:#0575BD; font-weight:bold;"><?php echo $fcity." "."to"." ".$tcity." "."on"." ".date("d-m-Y",strtotime($dat)); ?> </td>
<td style="padding-left:18px; font-size:12px; color:#0575BD; font-weight:bold;"><?php echo $tcity." "."to"." ".$fcity." "."on"." ".date("d-m-Y",strtotime($dat1)); ?> </td>
</tr>
<tr>
<td width="397">
<table width="392">
<tr>
<td width="10">&nbsp;</td>
<td width="172" height="32" style="font-size:12px;">Bus Name : <span style="color:#FF0000;"><?php echo $bus_name; ?></span></td>
<td width="194" style="font-size:12px;">Total Seats : <span style="color:#FF0000;"><?php echo $count; ?></span></td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="font-size:12px;">Seat Numbers : <span style="color:#FF0000;"><?php echo $tot_seat; ?></span></td>
<td style="font-size:12px;">Total Fare : Rs. <span style="color:#FF0000;"><?php echo $tott_fare; ?></span></td>
</tr>
</table>
</td>
<td width="549">
<table width="420">
<tr>
<td width="10">&nbsp;</td>
<td width="216" height="32" style="font-size:12px;">Bus Name : <span style="color:#FF0000;"><?php echo $bus_name1; ?></span></td>
<td width="198" style="font-size:12px;">Total Seats : <span style="color:#FF0000;"><?php echo $count1; ?></span></td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="font-size:12px;">Seat Numbers : <span style="color:#FF0000;"><?php echo $tot_seat1; ?></span></td>
<td style="font-size:12px;">Total Fare : Rs. <span style="color:#FF0000;"><?php echo $tott_fare1; ?></span></td>
</tr>
</table>
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr><td height="47" colspan="3" style="font-size:14px; font-weight:bold; background-color:#EAF7FF; padding-left:20px;">Total Amount for Round Trip : Rs. <?php echo $totfare_tot=($tott_fare+$tott_fare1); ?></td>
</tr>
</table>



				</td></tr>
				<tr><td colspan="2">&nbsp; </td></tr>
				
				
				<tr><td colspan="2">
				<table width="99%" border="0" cellpadding="2" cellspacing="3" style="border:1px #666666 solid;">
				 <tr><td colspan="5"><strong>Do you have discount coupons?</strong></td></tr>
				 <tr><td colspan="5">&nbsp;</td></tr>
				 
					<tr>
						<td width="40%" style="padding-left:30px;">Enter Promotional code for discounts </td><td width="3%">:</td>
					  <td width="57%">
					 <input type="text" name="promo_code" id="promo_code" style="width:200px; height:25px; " onblur="cheqcode(this.value,'<?php echo $SP_id; ?>','<?php echo $Bus_id; ?>','<?php echo $SP_id1; ?>','<?php echo $Bus_id1; ?>','<?php echo $dat; ?>','<?php echo $dat1; ?>')" value="<?php echo $_REQUEST['promo_code']; ?>"  />
					  
					 <a href="javascript:void(0)" onclick="discountcheq(form.promo_code.value,'<?php echo $SP_id; ?>','<?php echo $Bus_id; ?>','<?php echo $SP_id1; ?>','<?php echo $Bus_id1; ?>','<?php echo $total_tot; ?>','<?php echo $dat; ?>','<?php echo $dat1; ?>');"><input type="button" id="discount" name="discount" value=" Calculate Discount " /></a>
					  </td>
					</tr>
					<tr><td colspan="2">&nbsp;</td><td><div id="check_res"><input type="hidden" name="total_amt" id="total_amt" value="<?php echo $total_tot; ?>" /></div></td></tr>
<tr>
<td colspan="3" style="padding-left:30px;">
<span id="discount_res"></span>
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
					</table>
					</td>
					</tr>
					
				<tr><td colspan="2">&nbsp; </td></tr>	
					
					
				<tr><td colspan="2">
				<table width="99%" border="0" cellpadding="2" cellspacing="3" style="border:1px #666666 solid;">
				 <tr><td colspan="5"><strong>Passenger Details</strong></td></tr>
				 <tr><td colspan="5">&nbsp;</td></tr>
				 
					<tr>
						<th align="center">S.No</th>
						<th align="center">Seat No</th>
						<th align="center">Passenger Name</th>
						<th align="center">Gender</th>
						<th align="center">Age</th>
						
					</tr>
					<?php 
						
					?>	
				
				
				<!--JOURNERY DATE-->
				
				<input type="hidden" name="tot_seat" id="tot_seat" value="<?php echo $tot_seat; ?> " >
				<input type="hidden" name="seat_count" id="seat_count" value="<?php echo $count; ?> " >
				<input type="hidden" name="total_amt2" id="total_amt2" value="<?php echo $fare; ?> " >
				<input type="hidden" name="boading_point" id="boading_point" value="<?php echo $query['Bus_boarding_time']; ?>" >
				<input type="hidden" name="bus_fare" id="bus_fare" value="<?php echo $query['Bus_fare']; ?> " >
				<input type="hidden" name="bus_type" id="bus_type" value="<?php echo get_bus_type($query['Bus_type']); ?>" />
				<input type="hidden" name="from_city" id="from_city" value="<?php echo $from_city; ?> " >
				<input type="hidden" name="to_city" id="to_city" value="<?php echo $to_city; ?>" />
				<input type="hidden" name="bus_id" id="bus_id" value="<?php echo $Bus_id; ?> " >
				<input type="hidden" name="travel_date" id="travel_date" value="<?php echo $dat; ?>" />
				<input type="hidden" name="sp_id" id="sp_id" value="<?php echo $query['SP_id']; ?>" />
				<input type="hidden" name="triptype" id="triptype" value="2" >
				
				
				
				<!--RETURN DATE-->
				
				<input type="hidden" name="tot_seat1" id="tot_seat1" value="<?php echo $tot_seat1; ?> " >
				<input type="hidden" name="seat_count1" id="seat_count1" value="<?php echo $count1; ?> " >
				<input type="hidden" name="total_amt1" id="total_amt1" value="<?php echo $fare1; ?> " >
				<input type="hidden" name="boading_point1" id="boading_point1" value="<?php echo $query1['Bus_boarding_time']; ?>" >
				<input type="hidden" name="bus_fare1" id="bus_fare1" value="<?php echo $query1['Bus_fare']; ?> " >
				<input type="hidden" name="bus_type1" id="bus_type1" value="<?php echo get_bus_type($query1['Bus_type']); ?>" />
				<input type="hidden" name="from_city1" id="from_city1" value="<?php echo $from_city1; ?> " >
				<input type="hidden" name="to_city1" id="to_city1" value="<?php echo $to_city1; ?>" />
				<input type="hidden" name="bus_id1" id="bus_id1" value="<?php echo $Bus_id1; ?> " >
				<input type="hidden" name="travel_date1" id="travel_date1" value="<?php echo $dat1; ?>" />
				<input type="hidden" name="sp_id1" id="sp_id1" value="<?php echo $query1['SP_id']; ?>" />
					
					<?php $j=1;
						for($i=0; $i<$count; $i++)
						{
					?>
					<tr>
						<td align="center"><?php echo $j; ?></td>
						<td align="center"><?php echo $total_seats[$i]; ?> ,  <?php echo $total_seats1[$i]; ?>
						<input type="hidden" name="seatno_<?php echo $j; ?>" id="seatno_<?php echo $j; ?>" value="<?php echo $total_seats[$i]; ?>">
						<input type="hidden" name="seatno1_<?php echo $j; ?>" id="seatno1_<?php echo $j; ?>" value="<?php echo $total_seats1[$i]; ?>">
						</td>
						<td align="center"><input type="text" name="passname_<?php echo $j; ?>" id="passname_<?php echo $j; ?>" ></td>
						<td align="center"><input type="radio" name="gender_<?php echo $j; ?>" id="gender_<?php echo $j; ?>" value="M" checked="checked"> Male
						<input type="radio" name="gender_<?php echo $j; ?>" id="gender_<?php echo $j; ?>" value="F"> Female
						</td>
						<td align="center"><input type="text" name="age_<?php echo $j; ?>" id="age_<?php echo $j; ?>" size="5" maxlength="2" onkeypress="return isNumberKey(event);"></td>
					</tr>	
					<?php		
							$j++;
						}
					?>
					
					
				<tr><td colspan="5">&nbsp;</td></tr>
				</table></td></tr>
					<tr><td colspan="2">&nbsp;</td></tr>	
						<tr><td colspan="2">
				<table width="99%" border="0" cellpadding="2" cellspacing="3" style="border:1px #666666 solid; padding-left:30px;">
				 <tr><td colspan="2"><strong>Booker Details</strong></td></tr>
				 <tr><td colspan="2">&nbsp;</td></tr>
				 
					<tr>
						<td width="25%">Booker Name <font color="#FF0000">*</font></td><td width="3%">:</td>
						<td><input type="text" name="booker_name" id="booker_name" value=""></td>
					</tr>
					<tr>
						<td  width="25%">Email ID <font color="#FF0000">*</font></td><td width="3%">:</td>
						<td><input type="text" name="email" id="email" value=""></td>
					</tr>
					<tr>
						<td  width="25%">Address 1 <font color="#FF0000">*</font></td><td width="3%">:</td>
						<td><input type="text" name="address1" id="address1" value=""></td>
					</tr>
					<tr>
						<td  width="25%">Address 2 </td><td width="3%">:</td>
						<td><input type="text" name="address2" id="address2" value=""></td>
					</tr>
					<tr>
						<td width="25%">Mobile / Phone No <font color="#FF0000">*</font></td><td width="3%">:</td>
						<td><input type="text" name="mobile" id="mobile" value="" maxlength="10" onkeypress="return isNumberKey(event);"><input type="hidden" name="payment" id="payment" value="0" /></td>
					</tr>
					
				
				
					
				<tr><td colspan="5">&nbsp;</td></tr>
				</table></td></tr>
						
						
						<tr><td colspan="2">&nbsp;</td></tr>
						
						
						<tr>
						<td colspan="2" align="center">
						<!--<a href="available_seat.php?bus_id=<?php echo $Bus_id; ?>&dat=<?php echo $dat; ?>">-->
						<input type="button" id="back" name="back" value=" Back " onclick="window.location.href='bookingmgnt.php'" /><!--</a>-->
						<input type="submit" id="book" name="book" value=" Book " onclick="return validate_booker(this.form);" />
						
						</td>
						</tr>
					</table>
					</form>
   <?php
   }
  
  ?>
  </fieldset>
  
  <?php
include "includes/footer.php"; ?>
