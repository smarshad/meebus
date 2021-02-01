<?php
	include_once("includes/header.php");
   $SP_id=$_REQUEST['SP_id'];
   $Bus_id=$_REQUEST['Bus_id'];
   $dat=$_REQUEST['travel_date'];
   $ticket=$_REQUEST['ticket'];	
   $email=$_REQUEST['email'];
?>

<body>
<span style="font-weight:bold;">&nbsp;&nbsp;<a href="javascript:void(0);" onClick="window.history.back();">Back >></a> &nbsp; &nbsp;</span>
<fieldset class="table-bor">

		<legend><strong>Ticket Details</strong></legend> 

	    	<?php
				
		 $fullpath = dirname($_SERVER[PHP_SELF]).'/images/'.$imglogo; 	
		
		$image =$site_url."/images/".$imglogo; 
	 
	//echo "select * from bookinginfo as bkin, businfo as bin,booker_details as bd where bkin.Ticket_ID = '".$ticket."' and bkin.Bus_id = bin.Bus_id AND bkin.SP_id = bin.SP_id AND bd.Booker_email='".$email."' AND bkin.cancelledStatus=0 AND bkin.Ticket_ID=bd.Ticket_ID"; exit;
	
	$t_v=mysql_query("select * from bookinginfo as bkin, businfo as bin,booker_details as bd where bkin.Ticket_ID = '".$ticket."' and bkin.Bus_id = bin.Bus_id AND bkin.SP_id = bin.SP_id AND bd.Booker_email='".$email."' AND bkin.cancelledStatus=0 AND bkin.Ticket_ID=bd.Ticket_ID");
	$print_num_passengers= mysql_num_rows($t_v);	
	$trow = mysql_fetch_object($t_v); 
	//echo $trow->booking_type;
?>
<div style=" width:760px; height:auto;border:1px solid #B7E3FF; background:#F3FBFF; margin:10px 10px ; ">
		<table cellpadding="7" cellspacing="10" border="0" style="font-size:12px; font-weight:normal; " >
		<tr>
		<td height="31" colspan="5" align="left" nowrap="nowrap"><b style="font-size:15px;color:#0066FF; ">Booking Details</b></td>
		<td colspan="4" align="right"><b style="font-size:15px;color:#0066FF; "><?php if($trow->booking_type==1) { echo "One-way"; } else if($trow->booking_type==2) { echo "Round-trip"; } else { }  ?></b></td>
		</tr>
						<tr>
							
							<td valign="top" width="126" ><b>Ticket Number</b></td>
							<td valign="top" width="3">:</td>
							<td valign="top" width="138"   style="word-wrap:break-word;"><?php echo $trow->Ticket_ID; ?></td>
							
							<td valign="top" width="126"><b>Booker Name & Email</b></td>
							<td valign="top" width="3">:</td>
							<td colspan="2" width="138" valign="top" style="word-break:break-all;"><?php echo get_booker($trow->Ticket_ID)."&";?><?php echo $email;?></td>
							
						</tr>

					<tr>
							
							<td valign="top" nowrap="nowrap"><b>Service Provider & Type </b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap" style="word-wrap:break-word;"><?php echo get_SP_name($trow->SP_id)." & "; ?> <?php echo get_bus_type($trow->Bus_type); ?></td>
							
							<td valign="top" nowrap="nowrap"><b>Mobile Number</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap" style="word-wrap:break-word;"><?php echo $trow->Booker_mobile; ?></td>
							<td>&nbsp;</td>
						</tr>
												
						<tr>
							
							<td valign="top" width="166"><b>From</b></td>
							<td valign="top" width="3">:</td>
							<td valign="top" width="138" nowrap="nowrap" style="word-wrap:break-word;"><?php echo strtoupper(get_city_name($trow->Bus_fromcity)); ?></td>
							
							<td valign="top" width="115"><b>To</b></td>
							<td valign="top" width="3">:</td>
							<td valign="top" width="95" nowrap="nowrap" style="word-wrap:break-word;"><?php echo strtoupper(get_city_name($trow->Bus_tocity)); ?></td>
							<td width="1">&nbsp;</td>
						</tr>
						
						<tr>
							
							<td valign="top" nowrap="nowrap"><b>Date of Booking</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap" style="word-wrap:break-word;"><?php echo date("d-m-Y", strtotime($trow->booked_date)); ?></td>
							
							<td valign="top" nowrap="nowrap"><b>Date of Journey</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap" style="word-wrap:break-word;"><?php echo changedateformat($trow->travelling_date); ?> </td>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							
							<td valign="top" nowrap="nowrap"><b>Departure Point &amp; Time </b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap" style="word-wrap:break-word;"><?php echo get_board_time($trow->Ticket_ID); ?></td>
							
							
							<td valign="top" nowrap="nowrap"><b>Total Passengers</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap" style="word-wrap:break-word;"><?php echo $print_num_passengers; ?></td>							
							<td>&nbsp;</td>
						</tr>						
						<tr>
							
							<td valign="top" nowrap="nowrap"><b>Seat Number(s)</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap" style="word-wrap:break-word;"><?php echo get_seat_number($trow->Ticket_ID); ?></td>							
							
							<td valign="top" nowrap="nowrap"><b>Fare per Ticket</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap" style="word-wrap:break-word;">Rs.<?php echo number_format($trow->Bus_fare); ?></td>
							<td>&nbsp;</td>
						</tr>	
						<tr>
						
						<td valign="top" nowrap="nowrap"><b>Total Amount</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap" style="word-wrap:break-word;">Rs.<?php echo number_format($print_num_passengers * ($trow->Bus_fare)); ?></td>		
						    
							<td valign="top"><b>Address</b></td>
							<td valign="top">:</td>
							<td valign="top" style="word-wrap:break-word;"><?php echo $trow->Booker_address1."," ?><?php echo $trow->Booker_address2; ?></td>
							<td>&nbsp;</td>
						
						
						</tr>
				  </table>	
					
		</div>
				
       <?php 
	   
	   $tick_id=$trow->Ticket_ID;
	   
	   $mn=mysql_fetch_array(mysql_query("select * from booker_details where Ticket_ID='$tick_id'"));
		
		$book_coup=$mn['Booker_coup'];
		
		$discount=$mn['Booker_discount'];
		
		$fare=$mn['booking_amt'];
	   ?>
	   
	   <?php if($book_coup!="") { ?>
		<div style=" width:760px; height:auto;border:1px solid #B7E3FF; background:#F3FBFF; margin:10px 10px ; font-size:12px;">
		<table cellpadding="7" cellspacing="10" border="0" style="font-size:12px; font-weight:normal; " >
		<tr>
		<td height="31" colspan="9" align="left" nowrap="nowrap"><b style="font-size:15px;color:#0066FF; ">Payment Details</b></td>
		</tr>
		<tr>
		
		<td width="171" valign="top" nowrap="nowrap"><b>Actual Total Amount</b></td>
		<td width="3" valign="top">:</td>
		<td width="137" valign="top" nowrap="nowrap" style="word-wrap:break-word;">Rs.<?php echo number_format($print_num_passengers * ($trow->Bus_fare)); ?></td>		
		
		<td width="129" valign="top"><b>Coupon Number </b></td>
		<td width="3" valign="top">:</td>
		<td width="97" valign="top" style="word-wrap:break-word;"><?php echo $book_coup; ?></td>
		<td width="1">&nbsp;</td>
		
		
		</tr>
		<tr>
		
		<td width="171" valign="top" nowrap="nowrap"><b>Discount Amount</b></td>
		<td width="3" valign="top">:</td>
		<td width="137" valign="top" nowrap="nowrap" style="word-wrap:break-word;">Rs.<?php echo $discount; ?></td>		
		
		<td width="129" valign="top"><b>Total Paid Amount  </b></td>
		<td width="3" valign="top">:</td>
		<td width="97" valign="top" style="word-wrap:break-word;">Rs.<?php echo $fare; ?></td>
		<td width="1">&nbsp;</td>
		
		
		</tr>
		</table>
				
		</div>
		<?php } else { } ?>			
					
	<div style=" width:760px; height:auto;border:1px solid #B7E3FF; background:#F3FBFF;font-size:12px; margin-left:10px;">
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
						
		
	<div style=" width:760px; height:auto;border:1px solid #B7E3FF; background:#F3FBFF; margin:10px 10px ; font-size:12px;">
					<table width="100%" border="0" cellpadding="3" cellspacing="5">	
					<tr><td colspan='9' align='center'><strong style="font-size:15px;">Terms & Conditions</strong></td></tr>
				    
					<tr>
									
					<td align="left" colspan="9" style="word-wrap:break-word;"><?php echo $trow->conditions; ?></td>
					</tr>
					</table>
										
					</div>
		
		</fieldset>
		
		<?php include "includes/footer.php"; ?>
</body>
<script type="text/javascript">
function print_pop(){
mywindow = window.open("../msg.php", "mywindow", "menubar=0,resizable=1,width=500,height=500");
}
</script>