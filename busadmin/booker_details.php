<?php
include "includes/header.php";

//echo "<h2>Available Seats</h2>";

if(isset($_REQUEST['bus_id']) && isset($_REQUEST['travel_date'])){
   $SP_id=mysql_real_escape_string($_REQUEST['sp_id']);
   $Bus_id=mysql_real_escape_string($_REQUEST['bus_id']);
   $dat=mysql_real_escape_string($_REQUEST['travel_date']);
   
	/*$explo = explode("/",$dat);
	$tr_date = $explo[2]."-".$explo[0]."-".$explo[1];
	$t_date =  $explo[1]."-".$explo[0]."-".$explo[2]; */
   
    $tr_date=$dat;
	$t_date=changedateformat($tr_date);
	
	
	 //check for promotion
	 $queryy = mysql_fetch_array(mysql_query("SELECT * FROM businfo where Bus_id= $Bus_id "));
	$total_amt=$_REQUEST['total_amt'];
	$bus_prom=$queryy['bus_promo'];
	if($bus_prom==0)
	{
	 $fare = $total_amt;
	 }
	 else
	 {
	 $faree = explode("Rs. ",$total_amt);
	 //echo $fare[1]; 
	 $promo_sql=mysql_query("select * from bus_promo where promo_id='$bus_prom' and promo_status=0");
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
	 $fare = ($faree[1]-$promo_value);
	 }
	 else if($promo_atype==2) {
	 
	  $pro_dis=($faree[1]*($promo_value/100));
	  $fare = ($faree[1]-$pro_dis);
	 }
	 else {  $fare = $total_amt; }
	 }
	 else {  $fare = $total_amt; }	 
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
	 $fare = ($faree[1]-$promo_value);
	 }
	 else if($promo_atype==2) {
	 
	  $pro_dis=($faree[1]*($promo_value/100));
	  $fare = ($faree[1]-$pro_dis);
	 }
	 else {  $fare = $total_amt; }
	 }
	
	 else
	 {  $fare = $total_amt; }
	 }
	 else
	 {
	  $fare = $total_amt;
	 }
	 }
	  else
	 {
	  $fare = $total_amt;
	 }
	 }
	
	 //echo $fare; exit;
	 
   
   if(isset($_REQUEST['book']))
   { 
   		    $spid = get_SP_name($SP_id);
			//$sp_name = strtoupper(substr($spid,0,3));
			
			//$ticket_id = date("ymd").$sp_name.rand();
			
			///// Generate Ticket Number
			      $time = mktime();
                  $ticket = '';
                  for ($x=3;$x<10;$x++) {
                  $ticket .= substr($time,$x,1);
                  }
	              $ticket_id = date("y").date("m").date("d").strtoupper(substr($spid,0,3)).$ticket;
			///// End 	
						
			$tot_seat = $_REQUEST['seat_count'];
			$tot_seat_num = $_REQUEST['tot_seat'];
			$total_amt = $_REQUEST['total_amt'];
			$total_amtt=explode("Rs.",$total_amt);
			$total_rupe=$total_amtt[1];
			$triptype=$_REQUEST['triptype'];
			$coupon_id=$_REQUEST['coupp'];
			$discoun=$_REQUEST['disamount'];
			$coup_id=$_REQUEST['couppid'];
			$disfare = $_REQUEST['fare'];
			if($disfare=="")
			{
			$fare = $total_amt;
			}
			else
			{
			$fare = $_REQUEST['fare'];
			}
			
			$booker_name = mysql_real_escape_string($_REQUEST['booker_name']);
			$email = mysql_real_escape_string($_REQUEST['email']);
			$address1 = mysql_real_escape_string($_REQUEST['address1']);
			$address2 = mysql_real_escape_string($_REQUEST['address2']);
			$mobile = mysql_real_escape_string($_REQUEST['mobile']);
			$payment = mysql_real_escape_string($_REQUEST['payment']);
			$bus_fare = mysql_real_escape_string($_REQUEST['bus_fare']);
			$bus_type = mysql_real_escape_string($_REQUEST['bus_type']);
			$from_city = mysql_real_escape_string($_REQUEST['from_city']);
			$to_city = mysql_real_escape_string($_REQUEST['to_city']);
			$boading_point = mysql_real_escape_string($_REQUEST['boading_point']);
			$gen;
			 
			for($i=1; $i<=$tot_seat; $i++)
			{
				$seat_num = "seatno_".$i;
				$pass_name = "passname_".$i;
				$gender = "gender_".$i;
				$age = "age_".$i;
				$gen.=$_REQUEST[$gender]."," ;
				$page.=$_REQUEST[$age]."," ;
				
				$qry = mysql_query("insert into bookinginfo (auto_id, SP_id, Bus_id, SeatNo, booking_type, booking_amt, travelling_date, booked_date, Ticket_ID, userid, usertype, cancelledStatus, Blocked, BlockedBy, BlockedType, PaymentType ) values ('','".$SP_id."', '".$Bus_id."', '".$_REQUEST[$seat_num]."', '".$triptype."', '".$bus_fare."', '".$tr_date."', NOW(), '".$ticket_id."', '".$_SESSION['accessing_LogID']."', '".$_SESSION['accessing_type']."', '0', '0', '0', '0', '0' ) ");
				
				if($qry)
				{
					$qry1 = mysql_query("insert into passengerinfo (passenger_ID, Ticket_ID, passenger_Name, passenger_seatNo, passenger_Gender, passenger_Age, bus_fare) values ('', '".$ticket_id."', '".$_REQUEST[$pass_name]."', '".$_REQUEST[$seat_num]."', '".$_REQUEST[$gender]."', '".$_REQUEST[$age]."', '".$bus_fare."'  ) ");
				
				}
			
			}	
			/*mysql_query("insert into booker_details (booker_id, Ticket_ID, Booker_name, Booker_email, Booker_address1, Booker_address2, Booker_mobile, payment_type, boarding_point) values ('', '".$ticket_id."', '".$booker_name."', '".$email."', '".$address1."', '".$address2."', '".$mobile."', '".$payment."', '".$boading_point."'  ) ");*/
			
			mysql_query("insert into booker_details (booker_id, Ticket_ID, Booker_name, Booker_email, Booker_address1, Booker_address2, Booker_mobile,booking_total,Booker_coup,Booker_discount,booking_amt, payment_type, boarding_point) values ('', '".$ticket_id."', '".$booker_name."', '".$email."', '".$address1."', '".$address2."', '".$mobile."','".$total_rupe."','".$coupon_id."','".$discoun."','".$fare."', '".$payment."', '".$boading_point."')");
					
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
							<td valign='top'>".$fare."</td>
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

			<font color='black'> &copy; Copyright 2010 <b><i> $siteteam </i></b>. </font>			

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
	
	
	<tr><td colspan='2'>
	<table cellpadding='7' cellspacing='10' border='0' width='100%' class='normal' style='border:1px solid #B7E3FF; background:#ffffff; padding:10px;'>
						
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
							<td>&nbsp;</td>
							<td valign='top' nowrap='nowrap'><b>Total Amount</b></td>
							<td valign='top'>:</td>
							<td valign='top'>
						    ".$fare."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						</table>
						
						</td></tr></table>";
						
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
function discountcheck(val,val1,val2,val3,val4)
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
xmlhttp.open("GET","calculate.php?code="+val+"&spid="+val1+"&busid="+val2+"&fare="+val3+"&dat="+val4,true);
xmlhttp.send();
}
</script>

<script>
function checkcode(val,val1,val2,val3)
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
xmlhttp.open("GET","checkcode.php?code="+val+"&spid="+val1+"&busid="+val2+"&dat="+val3,true);
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
<form name="form" action="inter.php" method="post">
				<table cellpadding="1" cellspacing="5" border="0" width="100%" >
				<tr><td colspan="2">&nbsp; </td></tr>
				<tr><td colspan="2">
					<?php 
						$query = mysql_fetch_array(mysql_query("SELECT * FROM businfo where Bus_id= $Bus_id AND Bus_status=1"));
						$fcity_id = $query['Bus_fromcity'];
							$fcity = get_city_name($fcity_id);
							$tcity_id = $query['Bus_tocity'];
						$tcity = get_city_name($tcity_id);
						
						 $ftcity = ucfirst($fcity)." - ".ucfirst($tcity);
						 
						 $boarding_point = explode(",",$query['Bus_boarding_time']);
						// print_r($boarding_point);
						
						$tot_seat = substr($_REQUEST['total_seats'],0,-1);
						$total_seats = explode(",",$tot_seat); 
						
						//print_r($total_seats);
					     $count = count($total_seats); 
						 
						 $tott_fare=($count*$query['Bus_fare']);
										
					 ?>
											 
				<table width="100%" border="0" cellpadding="2" cellspacing="5">
				<tr>
						<td><strong>Service Provider :</strong> <?php echo get_SP_name($query['SP_id']); ?></td>
						<td><strong>From - To City :</strong> <?php echo $ftcity ; ?> </td>
					</tr>
					<tr>
						<td><strong>Bus Fare :</strong> Rs. <?php echo $query['Bus_fare'] ; ?> / member </td>
						<td><strong>Travelling Date:</strong> <?php echo changedateformat($dat); ?></td>
					</tr>
					<tr>
						<td><strong>Total Fare :</strong> Rs. <?php echo $tott_fare; ?>  </td>
						<td><strong>Total Member :</strong> <?php echo $count; ?>  </td>
					</tr>
					<tr style="background-color:#DEEDFA;">
						<td height="32" colspan="2" style="font-size:13px; padding-left:30px;"><strong>Need to Pay :</strong> <?php echo $fare; ?>  </td>
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
					  <input type="text" name="promo_code" id="promo_code" style="width:200px; height:25px; " onblur="checkcode(this.value,'<?php echo $SP_id; ?>','<?php echo $Bus_id; ?>','<?php echo $dat; ?>')" value="<?php echo $_REQUEST['promo_code']; ?>"  /> 
					  
					 <a href="javascript:void(0)" onclick="discountcheck(form.promo_code.value,'<?php echo $SP_id; ?>','<?php echo $Bus_id; ?>','<?php echo $fare; ?>','<?php echo $dat; ?>');"> <input type="button" id="discount" name="discount" value=" Calculate Discount " /></a>
					  </td>
					</tr>
					<tr><td colspan="2">&nbsp;</td><td><div id="check_res"></div></td></tr>
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
				<input type="hidden" name="tot_seat" id="tot_seat" value="<?php echo $tot_seat; ?>" >
				<input type="hidden" name="seat_count" id="seat_count" value="<?php echo $count; ?>" >
				<input type="hidden" name="total_amt" id="total_amt" value="<?php echo $fare; ?>" >
				<input type="hidden" name="boading_point" id="boading_point" value="<?php echo $_REQUEST['boading_point']; ?>" >
				<input type="hidden" name="bus_fare" id="bus_fare" value="<?php echo $query['Bus_fare']; ?>" >
				<input type="hidden" name="bus_type" id="bus_type" value="<?php echo get_bus_type($query['Bus_type']); ?>" />
				<input type="hidden" name="from_city" id="from_city" value="<?php echo $fcity_id; ?>" >
				<input type="hidden" name="to_city" id="to_city" value="<?php echo $tcity_id; ?>" />
				<input type="hidden" name="bus_id" id="bus_id" value="<?php echo $Bus_id; ?>" >
				<input type="hidden" name="travel_date" id="travel_date" value="<?php echo $dat; ?>" />
				<input type="hidden" name="sp_id" id="sp_id" value="<?php echo $query['SP_id']; ?>" />
					
					<?php $j=1;
						for($i=0; $i<$count; $i++)
						{
					?>
					<tr>
						<td align="center"><?php echo $j; ?></td>
						<td align="center"><?php echo $total_seats[$i]; ?>
						<input type="hidden" name="seatno_<?php echo $j; ?>" id="seatno_<?php echo $j; ?>" value="<?php echo $total_seats[$i]; ?>">
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
						<td><input type="text" name="mobile" id="mobile" value="" maxlength="10" onkeypress="return isNumberKey(event);"></td>
					</tr>
					<?php 
					     if($_SESSION['accessing_LogID']!=$SP_id){
					?>
					<!--<tr>
						<td width="25%">Payment Type <font color="#FF0000">*</font></td><td width="3%">:</td>
						<td>
						<table border="0" cellspacing="0" cellpadding="5">
						<tr>
						<td>
						<input type="radio" name="payment" id="payment" value="1" disabled="disabled" />&nbsp;
                        <img src="../images/my.gif" border="0" alt="Through Credit Cards" title="Credit Cards" /></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
						<td><input type="radio" name="payment" id="payment" checked="checked" value="2" />&nbsp;<img src="../images/paypal_tiny.gif" border="0" alt="Paypal" title="Paypal" /></td>						
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
						<td><input type="radio" name="payment" id="payment" value="3" disabled="disabled" />&nbsp;<img src="../images/net-banking.gif" border="0" alt="Net Banking" title="Net Banking" /></td>
						</tr>-->
						</table>
						<!--<select name="payment" id="payment">
							<option value="">- Select Payment Type -</option>
							<option value="paypal">PayPal</option>	</select>-->
						</td>
					</tr>
				<?php 
				}
				else{
				?>
				<input type="hidden" name="payment" id="payment" value="0" />
				<?php
				}
				?>	
					
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
  }
   else
  {
  	header("Locaion: bookingmgnt.php");
  }
  ?>
  </fieldset>
  
  <?php
include "includes/footer.php"; ?>
