<?php
   include_once("includes/header.php");
   $SP_id=mysql_real_escape_string($_SESSION['book_var']['sp_id']);
   $Bus_id=mysql_real_escape_string($_SESSION['book_var']['bus_id']);
   $dat=mysql_real_escape_string($_SESSION['book_var']['travel_date']);		
/*	if(isset($_REQUEST['ticket']))
	{
		$ticket = $_REQUEST['ticket'] ;
	}
	
	if(isset($_REQUEST['tdate']))
	{
		$tdate = $_REQUEST['tdate'] ;
	}
	
	$getdata = mysql_fetch_array(mysql_query("select * from bookinginfo as bi , serviceprovider_info as sp where bi.Ticket_ID='$ticket' and bi.SP_id = sp.SP_id ")) ;
*/
	
?>
<body>

<fieldset class="table-bor">

		<legend><strong>Passangers Details</strong></legend> 
		<?php
		
   		   $spid = get_SP_name($SP_id);
			//$sp_name = strtoupper(substr($spid,0,3));			
			//$ticket_id = date("ymd").$sp_name.rand();			
			
			///// Generate Ticket Number
			      /*$time = mktime();
                  $ticket = '';
                  for ($x=3;$x<10;$x++) {
                  $ticket .= substr($time,$x,1);
                  }
	              $ticket_id = date("y").date("m").date("d").strtoupper(substr($spid,0,3)).$ticket;*/
				  
				  $ticket_id = $_SESSION['ticket_id'];
			///// End 
			
			$tot_seat = $_SESSION['book_var']['seat_count'];
			$tot_seat_num = $_SESSION['book_var']['tot_seat'];
			$total_amt = $_SESSION['book_var']['total_amt'];
			
			$total_amtt=explode("Rs.",$total_amt);
			$total_rupe=$total_amtt[1];
			
			$coupon_id=$_SESSION['book_var']['coupp'];
			 $discoun=$_SESSION['book_var']['disamount'];
			$coup_id=$_SESSION['book_var']['couppid'];
			$disfare = $_SESSION['book_var']['fare']; 
			if($disfare=="")
	  {
	  $fare = $total_rupe;
	  }
	  else
	  {
	  $fare = $_SESSION['book_var']['fare'];
	  }
			$payment = mysql_real_escape_string($_SESSION['book_var']['payment']);
			$bus_fare = mysql_real_escape_string($_SESSION['book_var']['bus_fare']);
			$bus_type = mysql_real_escape_string($_SESSION['book_var']['bus_type']);
			$from_city = mysql_real_escape_string($_SESSION['book_var']['from_city']);
			$to_city = mysql_real_escape_string($_SESSION['book_var']['to_city']);
			$boading_point = mysql_real_escape_string($_SESSION['book_var']['boading_point']);
			
			$booker_name = mysql_real_escape_string($_SESSION['book_var']['booker_name']);
			$email = mysql_real_escape_string($_SESSION['book_var']['email']);
			$address1 = mysql_real_escape_string($_SESSION['book_var']['address1']);
			$address2 = mysql_real_escape_string($_SESSION['book_var']['address2']);
			$mobile = mysql_real_escape_string($_SESSION['book_var']['mobile']);
			
			
			if (!isset($_SESSION["accessing_LogID"]) && !isset($_SESSION['accessing_type'])) {			
			    $accessing_LogID=chkusremail($email);		    
				if($accessing_LogID>0){
				   mysql_query("UPDATE users SET user_firstname='".$booker_name."', user_mobileno='".$mobile."', user_address1_1='".$address1."', user_address1_2='".$address2."' WHERE user_id=".$accessing_LogID) or die("update: ".mysql_error());
				   $usr=getUserData($accessing_LogID);
				   $accessing_type=$usr['user_typeID'];
				}
				else{
			mysql_query("insert into users (user_id, user_email, user_firstname, user_mobileno, user_address1_1, user_address1_2, user_typeID, user_status) values ('', '".$email."', '".$booker_name."', '".$mobile."', '".$address1."', '".$address2."', '4', '1' ) ");				
				$accessing_LogID = mysql_insert_id();							
				$accessing_type = "4";			  
				}				
			}
			else{
				$accessing_LogID = $_SESSION['accessing_LogID'];				
			    $accessing_type = $_SESSION['accessing_type'];
			}
			
			for($i=1; $i<=$tot_seat; $i++)
			{
				$seat_num = "seatno_".$i;
				$pass_name = "passname_".$i;
				$gender = "gender_".$i;
				$age = "age_".$i;
				$gen.=$_SESSION['book_var'][$gender]."," ;
				$page.=$_SESSION['book_var'][$age]."," ;						
				
				$qry = mysql_query("insert into bookinginfo (auto_id, SP_id, Bus_id, SeatNo, booking_type, booking_amt, travelling_date, booked_date, Ticket_ID, userid, usertype, cancelledStatus, Blocked, BlockedBy, BlockedType, PaymentType,pay_status ) values ('','".$SP_id."', '".$Bus_id."', '".$_SESSION['book_var'][$seat_num]."', '1', '".$bus_fare."', '".$dat."', NOW(), '".$ticket_id."', '".$accessing_LogID."', '".$accessing_type."', '0', '1', '0', '0', '".$payment."','1' ) ");
				
				
				
				if($qry)
				{
					$qry1 = mysql_query("insert into passengerinfo (passenger_ID, Ticket_ID, passenger_Name, passenger_seatNo, passenger_Gender, passenger_Age, bus_fare) values ('', '".$ticket_id."', '".$_SESSION['book_var'][$pass_name]."', '".$_SESSION['book_var'][$seat_num]."', '".$_SESSION['book_var'][$gender]."', '".$_SESSION['book_var'][$age]."', '".$bus_fare."'  ) ");
				
				}
			
			}
			
			mysql_query("update bus_coupons set coup_status=2,coup_ticket='$ticket_id' where coup_id='$coup_id'");	
						
			mysql_query("insert into booker_details (booker_id, Ticket_ID, Booker_name, Booker_email, Booker_address1, Booker_address2, Booker_mobile,booking_total,Booker_coup,Booker_discount,booking_amt, payment_type, boarding_point) values ('', '".$ticket_id."', '".$booker_name."', '".$email."', '".$address1."', '".$address2."', '".$mobile."','".$total_rupe."','".$coupon_id."','".$discoun."','".$fare."', '".$payment."', '".$boading_point."'  ) ");
			

        /*$image = dirname($_SERVER[PHP_SELF]).'/images/'.$imglogo; 	
		
		$img = "http://$_SERVER[HTTP_HOST]".$image; 	*/
								
		$img =$site_url."/images/".$imglogo; 		
				
		$subject = "Receive your Ticker from ".$spid ;	
					
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
							<td valign='top' width='150'>".strtoupper(get_city_name($from_city))."</td>
							<td valign='top' width='50'></td>
							<td valign='top' width='150'><b>To</b></td>
							<td valign='top' width='25'>:</td>
							<td valign='top' width='150'>".strtoupper(get_city_name($to_city))."</td>
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
							<td valign='top'>".changedateformat($dat)."</td>
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
						
						
						
						<<tr>
							<td align='left'>&nbsp;</td>
							<td align='left' valign='top' nowrap='nowrap'><b>Total Amount</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>".$total_amt."</td>
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
	<table cellpadding='7' cellspacing='10' border='0' width='750' class='normal' style='background:#ffffff; padding:10px;'>
	
	<tr><td align='left' style='padding-left:30px;'><!--<a href='available_seat.php?bus_id=$Bus_id&travel_date=$dat'><strong>Back</strong></a>--></td><td align='right' style='padding-right:30px;'><a href='javascript:void(0);' onClick='javascript:print_pop()'><strong>Print</strong></a></td></tr>
	<tr><td align='center' colspan='2'><font color='green'><b> Your Ticket has been sent to your mail. Please, Go to check your mail and print the ticket.</b></font></td></tr>
	
	
	<tr><td colspan='2'>
	<table cellpadding='7' cellspacing='10' border='0' width='100%' style='border:1px solid #B7E3FF; background:#B7E3FF; padding:10px;'>
						
						<tr><td colspan='9' align='center'><strong>Ticket Details </strong></td></tr>
						
						<tr>
							<td align='left' width='20'>&nbsp;</td>
							<td align='left' valign='top' width='175' nowrap='nowrap'><b>Ticket Number</b></td>
							<td align='left' valign='top' width='25'>:</td>
							<td align='left' valign='top' width='150'>  ".$ticket_id."</td>
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
							<td align='left' valign='top'>".ucwords(get_SP_name($SP_id)). "  ".$bus_type."</td>
							<td align='left' valign='top'></td>
							<td align='left' valign='top' nowrap='nowrap'><b>Booker Name & Email </b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>". ucwords($booker_name)." & ".$email."</td>
							<td align='left'>&nbsp;</td>
						</tr>
												
						<tr>
							<td align='left' width='30'>&nbsp;</td>
							<td align='left' valign='top' width='175'><b>From</b></td>
							<td align='left' valign='top' width='25'>:</td>
							<td align='left' valign='top' width='150'>".strtoupper(get_city_name($from_city))."</td>
							<td align='left' valign='top' width='50'></td>
							<td align='left' valign='top' width='150'><b>To</b></td>
							<td align='left' valign='top' width='25'>:</td>
							<td align='left' valign='top' width='150'>".strtoupper(get_city_name($to_city))."</td>
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
							<td align='left' valign='top'>".changedateformat($dat)."</td>
							<td align='left'>&nbsp;</td>

						</tr>
						
						<tr>
							<td align='left'>&nbsp;</td>
							<td align='left' valign='top' nowrap='nowrap'><b>Departure Time </b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>".$boading_point."</td>
							<td align='left'>&nbsp;</td>
							<td align='left' valign='top' nowrap='nowrap'><b>Total Passengers</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>". $tot_seat."</td>
						</tr>
						
						<tr>
							<td align='left'>&nbsp;</td>
							<td align='left' valign='top' nowrap='nowrap'><b>Seat Number(s)</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>".$tot_seat_num."</td>
							<td align='left' valign='top'>&nbsp;</td>
							<td align='left' valign='top' nowrap='nowrap'><b>Fare per Ticket</b></td>
							<td align='left' valign='top'>:</td>
							<td align='left' valign='top'>Rs.".$bus_fare."</td>
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
							<td align='left' valign='top'>".$total_amt."</td>
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
							<td valign='top'>".$fare."</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td valign='top'>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					
						</table>
						
						</td></tr></table>";
						//$i=0;
						?>
						<div style=" width:730px; height:auto; border:1px solid #B7E3FF; background:#F3FBFF; font-size:12px; margin-left:30px;">
					<table width="100%" border="0" cellpadding="3" cellspacing="5">	
					<tr><td colspan='9' align='center'><strong>Passenger Details </strong></td></tr>
				    <tr>
					<th>S.No</th>
					<th> Passenger Name </th>
					<th> Seat No </th>
					<th> Gender </th>
					<th> Age </th>
				    </tr>
				
		<?php 
					$ticket = $ticket_id;
					$i = 1;
					$qry = mysql_query("SELECT * FROM bookinginfo WHERE cancelledStatus = 0  and Ticket_ID = '".$ticket."'");
					 $num = mysql_num_rows($qry);
					while($row = mysql_fetch_array($qry))
					{  					
					$qry1=mysql_fetch_array(mysql_query("select * from passengerinfo where passenger_seatNo = '".$row['SeatNo']."' and Ticket_ID = '".$ticket."' "));					 
				?>				
				<tr>
					<td><?php echo  $i++; ?></td>	
					
					<td> <?php echo $qry1['passenger_Name']; ?> </td>
					<td> <?php echo $qry1['passenger_seatNo']; ?> </td>
					<td> <?php echo $qry1['passenger_Gender']; ?> </td>
					<td> <?php echo $qry1['passenger_Age']; ?> </td>
				</tr>
				<?php
				 $s_no.=$qry1['passenger_seatNo'].",";
				 } ?>
				
				</table>
				</div>
				
				
	<?php

	$t_v=mysql_query("select * from bookinginfo as bkin, businfo as bin,booker_details as bd where bkin.Ticket_ID = '".$ticket."' and bkin.Bus_id = bin.Bus_id AND bd.Booker_email='".$email."' AND bkin.cancelledStatus=0 AND bkin.Ticket_ID=bd.Ticket_ID");
	$print_num_passengers= mysql_num_rows($t_v);	
	$trow = mysql_fetch_object($t_v);
	
	$msg_print='<div style="width:750px; height:800px; background-color:#fff; border:10px solid rgb(165, 220, 255);  margin:0px; padding:0px;">
<div style="width:209px; height:119px;"><img border="0px" src="'.$img.'"></div>
<div style=" width:720px; height:auto;border:1px solid #B7E3FF; background:#F3FBFF; margin:10px 15px ; ">
		<table cellpadding="7" cellspacing="10" border="0" style="font-size:12px; font-weight:normal; " >
		<tr>
		<td height="31" colspan="9" align="left" nowrap="nowrap"><b style="font-size:15px;color:#0066FF; ">Booking Details</b></td>
		</tr>
						<tr>
							<td width="1">&nbsp;</td>
							<td valign="top" width="126" ><b>Ticket Number</b></td>
							<td valign="top" width="3">:</td>
							<td valign="top" width="138" nowrap="nowrap">'.$trow->Ticket_ID.'</td>
							<td valign="top" width="1">&nbsp;</td>
							
							<td valign="top" nowrap="nowrap"><b>Booker Name & Email</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap">'.get_booker($trow->Ticket_ID).' & '.$email.'</td>
							
							<td width="1">&nbsp;</td>
						</tr>

					<tr>
							<td>&nbsp;</td>
							<td valign="top" nowrap="nowrap"><b>Service Provider & Type</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap">'.get_SP_name($trow->SP_id).' & '.get_bus_type($trow->Bus_type).'</td>
							<td valign="top"></td>
							<td valign="top" nowrap="nowrap"><b>Mobile</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap">'.$mobile.'</td>
							<td>&nbsp;</td>
						</tr>
												
						<tr>
							<td width="1">&nbsp;</td>
							<td valign="top" width="166"><b>From</b></td>
							<td valign="top" width="3">:</td>
							<td valign="top" width="138" nowrap="nowrap">'.strtoupper(get_city_name($trow->Bus_fromcity)).'</td>
							<td valign="top" width="1"></td>
							<td valign="top" width="115"><b>To</b></td>
							<td valign="top" width="3">:</td>
							<td valign="top" width="95" nowrap="nowrap">'.strtoupper(get_city_name($trow->Bus_tocity)).'</td>
							<td width="1">&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign="top" nowrap="nowrap"><b>Date of Booking</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap">'.date("d-m-Y", strtotime($trow->booked_date)).'</td>
							<td valign="top"></td>
							<td valign="top" nowrap="nowrap"><b>Date of Journey</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap">'.changedateformat($trow->travelling_date).'</td>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td valign="top" nowrap="nowrap"><b>Departure Point &amp; Time </b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap">'.get_board_time($trow->Ticket_ID).'</td>
							<td valign="top">&nbsp;</td>
							
							<td valign="top" nowrap="nowrap"><b>Total Passengers</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap">'.$print_num_passengers.'</td>							
							<td>&nbsp;</td>
						</tr>						
						<tr>
							<td>&nbsp;</td>
							<td valign="top" nowrap="nowrap"><b>Seat Number(s)</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap">'.get_seat_number($trow->Ticket_ID).'</td>							
							<td valign="top">&nbsp;</td>
							<td valign="top" nowrap="nowrap"><b>Fare per Ticket</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap">Rs.'.number_format($trow->Bus_fare).'</td>
							<td>&nbsp;</td>
						</tr>	
						<tr>
						<td>&nbsp;</td>
						<td valign="top" nowrap="nowrap"><b>Total Amount</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap">Rs.'.number_format($print_num_passengers * ($trow->Bus_fare)).'</td>	
							<td>&nbsp;</td>
							<td valign="top">Address</td>
							<td valign="top">:</td>
							<td valign="top">'.$address1.','.$address1.'</td>
							<td >&nbsp;</td>
							
								
						</tr>
						<tr>
						<td>&nbsp;</td>
						<td valign="top" nowrap="nowrap"><b>Promotional Code</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap">Rs.'.$coupon_id.'</td>	
							<td>&nbsp;</td>
							<td valign="top">Discount Amount</td>
							<td valign="top">:</td>
							<td valign="top">'.$dis_bus.'</td>
							<td >&nbsp;</td>
							
								
						</tr>
						<tr>
						<td>&nbsp;</td>
						<td valign="top" nowrap="nowrap"><b>Total amount Paid</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap">Rs.'.$fare.'</td>	
							<td>&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td valign="top">&nbsp;</td>
							<td >&nbsp;</td>
							
								
						</tr>
				  </table>	
					
		</div>
				<div style=" width:720px; height:auto;border:1px solid #B7E3FF; background:#F3FBFF; margin:10px 15px ; font-size:12px;">
					<table  border="0" cellpadding="3" cellspacing="7" style="font-size:12px; font-weight:normal;">	
					<tr><td colspan="9" align="left"><strong style="font-size:15px; color:#0066FF;">Passenger\'s Details</strong></td></tr>
				    <tr>
					<td width="26" align="left"><strong>S.No</strong></td>
					<td width="295" align="left"><strong>Passenger Name</strong></td>
					<td width="67" align="left"><div align="center"><strong>Seat No</strong></div></td>
					<td width="144" align="left"><div align="center"><strong>Gender</strong></div></td>
					<td width="110" align="left"><div align="center"><strong>Age</strong></div></td>
				    </tr>';
					$ticket = $trow->Ticket_ID;
					$i = 1;
					$qry = mysql_query("SELECT * FROM bookinginfo WHERE Ticket_ID = '".$ticket."'");
					 $num = mysql_num_rows($qry);
					 $gen=""; $ages=""; $submsg="";
					while($row = mysql_fetch_array($qry))
					{  					
					$qry1=mysql_fetch_array(mysql_query("select * from passengerinfo where passenger_seatNo = '".$row['SeatNo']."' and Ticket_ID = '".$ticket."' "));		
					$submsg.='<tr>
					<td align="left"><div align="center">'.$i++.'</div></td>					
					<td align="left"><div align="left">'.$qry1["passenger_Name"].'</div></td>
					<td align="left"><div align="center">'.$qry1["passenger_seatNo"].'</div></td>
					<td align="left"><div align="center">'.$qry1["passenger_Gender"].'</div></td>
					<td align="left"><div align="center">'.$qry1["passenger_Age"].'</div></td>
				    </tr>';
				}
				$msg_print.=$submsg;
				$msg_print.='<tr><td colspan="9" align="center"><strong style="font-size:15px;">Terms & Conditions</strong></td></tr>
				    
					<tr>
									
					<td align="left" colspan="9">'.$trow->conditions.' </td>
					</tr>
					</table></div>
</div>
<div style="width:750px; position:relative; height:20px; background-color:#FFF; background-position:bottom;">
<p align="right" style="text-align: right;"><span style="font-size: 7.5pt; color: black;">&copy; Copyright '.date("Y").' <b><i>'.$siteteam.'</i></b>.</span></p>
</div>';
		session_start();
		
	$_SESSION['msgg']=$msg_print;	
					
	mail($email,$subject,$msg,$headers);
						
   $_SESSION['action']=1;	
  
		 unset($_SESSION['book_var']);         
		 unset($_SESSION['ticket_id']); 
		?>
		<!--<table border="0" cellspacing="2" cellpadding="5" align="center" width="75%">
		
		  <tr><td><br></td></tr>
		  
		  <tr><td colspan="4" align="left"><strong><a href="passmgmt.php"> &lt;&lt; Back</a></strong></td></tr>
		  
		  <tr><td><br></td></tr>
		
		  <tr>
		    <th>Ticket Id</th>
			<td><?php echo $ticket ; ?></td>	
		</tr>
		<tr>
			<th>Travel Date</th>			
			<td><?php echo $tdate ; ?></td>
		  </tr>		
		  
		  <tr>
			<th>Service Provider Name</th>
			<td><?php echo $getdata['SP_name'] ; ?></td>								
		  </tr>		  
		
 		  <tr><td><br><br></td></tr>		
		  
		  <tr>
			<th>Passenger Name</th>
			<th>Gender</th>
			<th>Age</th>
			<th>Seat No</th>	
			<th>Bus Fare</th>					
		  </tr>		
		  
		  	<?php  					
				$sql = mysql_query("select * from passengerinfo where Ticket_ID='$ticket'") ;
				
				while($getrow = mysql_fetch_array($sql))
				{
			?>
		  	
		  <tr>		  
			
			<td><?php echo ucwords($getrow['passenger_Name']); ?></td>
			
			<td >
				<?php 
				if($getrow['passenger_Gender'] =='f' || $getrow['passenger_Gender'] =='F')
				{
					echo "Female" ;
				}
				else if($getrow['passenger_Gender'] =='m' || $getrow['passenger_Gender'] =='M' )
				{
					echo "Male" ;
				}
				
				?>
			</td>
			
			<td align="center"><?php echo $getrow['passenger_Age']; ?></td>
			
			<td align="center"><?php echo $getrow['passenger_seatNo']; ?></td>		
			
			<td align="center"><?php echo $getrow['bus_fare']; ?></td>			
						
		  </tr>
		   <?php } ?>	 
		</table>-->

		<div style=" width:730px; height:auto;border:1px solid #B7E3FF; background:#F3FBFF; margin:10px 30px ; font-size:12px;">
					<table width="100%" border="0" cellpadding="3" cellspacing="5">	
					<tr><td colspan='9' align='center'><strong style="font-size:15px;">Terms & Conditions</strong></td></tr>
				   
					<tr>
									
					<td align="left" colspan="9"><?php echo $trow->conditions; ?></td>
					</tr>
					</table>
										
					</div>
		</fieldset>
</body>
<script type="text/javascript">
function print_pop(){
mywindow = window.open("../msg.php", "mywindow", "menubar=0,resizable=1,width=500,height=500");
}
</script>