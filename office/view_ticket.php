<?php
	include_once("includes/header.php");
	include_once("../includes/functions.php");
	$_SESSION['back'] = htmlentities($_SERVER['REQUEST_URI']);
	//Seat Checking			 
	$ress=mysql_query("select * from bookinginfo where pay_status=3");
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
	}
//print_r($_SESSION['book_var']);exit;
	
   $SP_id=mysql_real_escape_string($_SESSION['book_var']['sp_id']);
   $Bus_id=mysql_real_escape_string($_SESSION['book_var']['bus_id']);
   $dat=mysql_real_escape_string($_SESSION['book_var']['travel_date']);
	
	$query = mysql_fetch_array(mysql_query("SELECT * FROM businfo where Bus_id= $Bus_id "));
	$from_city = $query['Bus_fromcity'];
	//$fcity = get_city_name($fcity_id);
	$to_city = $query['Bus_tocity'];
	//$tcity = get_city_name($tcity_id);
	
	//$ftcity = ucfirst($fcity)." - ".ucfirst($tcity);
	
	$boarding_point = explode(",",$query['Bus_boarding_time']);
	// print_r($boarding_point);
?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td align="center" valign="top">
          <div id="test">
			<table cellpadding="3" cellspacing="5" border="0" width="100%" align="center">
				<tr>
					<td width="185px" valign="top" align="left">
                     <div id="left">
						<table cellpadding="0" cellspacing="0" border="0" width="100%" >
									<tr>
										<td valign="middle" class="pane_head">SUMMARY</td>
									</tr>
									<tr>
										<td class="pane_content">
											<div><b>Starting Point:</b> <?php echo strtoupper(get_city_name($from_city));?> </div>

											<div><b>Destination Point:</b> <?php echo strtoupper(get_city_name($to_city));?> </div>

											<div><b>Journey Date:</b> <?php echo changedateformat(date($dat)); ?> </div>			
											<div><b>Bus Type:</b> <?php echo get_bus_type($query['Bus_type']); ?> </div>											
											<div><b>Bus Fare:</b> <?php echo $query['Bus_fare']; ?>  <br />&nbsp;</div>									                                        </td>
									</tr>
									<tr><td colspan="2" bgcolor="#FFFFFF">&nbsp;</td></tr>	
									<tr>
										<td class="pane_content" valign="top">
											<div class="breadcrumb"><img src="./images/oneOn.gif" title="Select Bus" alt="Select Bus" style="vertical-align:middle;">&nbsp;&nbsp;Bus Selection</div>

													<div class="breadcrumb"><img src="./images/twoOn.gif" title="Seat Selection" alt="Seat Selection" style="vertical-align:middle;">&nbsp;&nbsp;Seat Selection</div>

													<div class="breadcrumb"><img src="./images/threeOn.gif" title="Summary of Booking" alt="Summary of Booking" style="vertical-align:middle;">&nbsp;&nbsp;Passenger Details</div>

													<div class="breadcrumb"><img src="./images/fourOver.gif" title="Passenger Details" alt="Passenger Details" style="vertical-align:middle;">&nbsp;&nbsp;<a href="javascript:;" class="bread_sel">Summary of Booking</a></div>										</td>
									</tr>
									<tr><td colspan="2" bgcolor="#FFFFFF">&nbsp;</td></tr>
													</table>
													</div>
					</td>
					<td valign="top">
						<table cellpadding="3" cellspacing="5" border="0" width="95%">
							<tr>
								<td valign="top">
<script>
	function fn_show_srch_form(){

		$('#quick_search').show();

		$('#mod_srch').hide();
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

<table cellpadding="0" cellspacing="0" border="0" width="100%">

	<tr>

		<td valign="top" height="30">

<div style="width:100%;" align="center">
<span style="color:#00CC00; font-weight:bolder; font-size:14px;">Payment succeded !!!</span>
</div>

			<div id="quick_search" style="display:none;">

			


<link type="text/css" href="./css/jquery.ui.datepicker.css" rel="stylesheet" />

<script type="text/javascript" src="./js/jquery.ui.datepicker.js"></script>

<script language="javascript" type="text/javascript">

	function fn_hide(){

		if($("#datepicker").val() == "pick a date"){

			$("#datepicker").val('');

		}

	}
	function fn_show_value(){
		if($("#datepicker").val() == ""){
			$("#datepicker").val('pick a date');
		}
	}
</script>



<script type="text/javascript">

	$(function() {

		$('#datepicker').datepicker({ numberOfMonths: 2, showButtonPanel: false, minDate: +0, maxDate: '+12M +0D'	});

		$('#rdatepicker').datepicker({ numberOfMonths: 2, showButtonPanel: false, minDate: +0, maxDate: '+12M +0D'	});

	});

</script>


<script type="text/javascript">
var tot = 0;
function seat_display(val)
{   
	
	seat_no = "seat_"+val;
	var s_no = document.getElementById(seat_no).value;
	
	var fare = parseInt(document.getElementById('bus_fare').value);

	if(document.getElementById(seat_no).checked) {
	
	document.getElementById('total_seats').value += s_no+",";
	
	tot=tot+fare; 
	
	}
	else
	{
		tot=tot-fare;
		
		var arr = document.getElementById('total_seats').value;
		
		var seatno = arr.split(",");
		
		for( var i=0; i<seatno.length; i++ )
		{
			if(seatno[i] == s_no )
			
				seatno.splice(i,1);
		
		}
		
		document.getElementById('total_seats').value = seatno;
		
		if(tot < 0){
		 tot=0; }
		 
	}
	
	document.getElementById('total_amt').value = "Rs. "+tot;

}

</script>
	
			</div>
			<div class="clear">&nbsp;</div>
		</td>

	</tr>
	
	
	<?php 
	    // if(isset($_SESSION['book_var']['book_x']) && $_SESSION['action']==0)
          // {  
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
			$total_amtt = $_SESSION['book_var']['total_amtt'];
			
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
			$fare = $total_amt;
			
			//COUPON DETAILS
	
			$coupon_id=$_SESSION['book_var']['coupp'];
			$disamount=$_SESSION['book_var']['disamount'];
			$coup_id=$_SESSION['book_var']['couppid'];
			
			
			if (!isset($_SESSION["accessing_LogID"]) && !isset($_SESSION['accessing_type'])) {			
			    $accessing_LogID=chkusremail($email);		    
				if($accessing_LogID>0){
				   //mysql_query("UPDATE users SET user_firstname='".$booker_name."', user_mobileno='".$mobile."', user_address1_1='".$address1."', user_address1_2='".$address2."' WHERE user_id=".$accessing_LogID) or die("update: ".mysql_error());
				   $usr=getUserData($accessing_LogID);
				   $accessing_type=$usr['user_typeID'];
				}
				else{
			//mysql_query("insert into users (user_id, user_email, user_firstname, user_mobileno, user_address1_1, user_address1_2, user_typeID, user_status) values ('', '".$email."', '".$booker_name."', '".$mobile."', '".$address1."', '".$address2."', '4', '1' ) ");				
				$accessing_LogID = mysql_insert_id();							
				$accessing_type = "4";			  
				}
				
			}
			else
			{
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
				/*
				$qry = mysql_query("insert into bookinginfo (auto_id, SP_id, Bus_id, SeatNo, booking_amt, travelling_date, booked_date, Ticket_ID, userid, usertype, cancelledStatus, Blocked, BlockedBy, BlockedType, PaymentType,pay_status ) values ('','".$SP_id."', '".$Bus_id."', '".$_SESSION['book_var'][$seat_num]."', '".$bus_fare."', '".$dat."', NOW(), '".$ticket_id."', '".$accessing_LogID."', '".$accessing_type."', '0', '1', '0', '0', '".$payment."','1' ) ");
				
				
				
				if($qry)
				{
					$qry1 = mysql_query("insert into passengerinfo (passenger_ID, Ticket_ID, passenger_Name, passenger_seatNo, passenger_Gender, passenger_Age, bus_fare) values ('', '".$ticket_id."', '".$_SESSION['book_var'][$pass_name]."', '".$_SESSION['book_var'][$seat_num]."', '".$_SESSION['book_var'][$gender]."', '".$_SESSION['book_var'][$age]."', '".$bus_fare."'  ) ");
				
				}*/
			
			}
			
		/*	mysql_query("insert into booker_details (booker_id, Ticket_ID, Booker_name, Booker_email, Booker_address1, Booker_address2, Booker_mobile,booking_amt, payment_type, boarding_point) values ('', '".$ticket_id."', '".$booker_name."', '".$email."', '".$address1."', '".$address2."', '".$mobile."','".$total_amt."', '".$payment."', '".$boading_point."'  ) ");*/
			
			
			
        $image = dirname($_SERVER[PHP_SELF]).'/images/'.$imglogo; 	
		
		$img = "http://$_SERVER[HTTP_HOST]".$image; 							
						
		$subject = "Receive your Ticker from ".$spid ;	
					
		$msg = "<table width='700' cellpadding='0' cellspacing='0' border='0' bgcolor='#F49E23' style='border:solid 10px #A5DCFF;'>
	<tr bgcolor='#FFFFFF' height='25'> 
	
		<td height='94'>

			<img src='$img' border='0'  />

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
							<td valign='top' width='150'><b>Mobile number</b></td>
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
							<td valign='top'>Rs. ".$bus_fare."</td>
							
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
							<td valign='top'>".$total_amtt."</td>
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
							<td valign='top'>".$disamount."</td>
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

			<font color='black'> &copy; Copyright 2013 <b><i> $siteteam </i></b>. </font>			

		</td> 

	</tr> 


</table>";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:'.$website_name.'<'.$mail_url.'>' . "\r\n";

	echo $mess = "
	<table cellpadding='7' cellspacing='10' border='0' width='750' class='normal' style='background:#ffffff; padding:10px;'>
	
	<tr><td align='left' style='padding-left:30px;'>&nbsp;</td><td align='right' style='padding-right:30px;'><a href='javascript:void(0);' onClick='javascript:print_pop();'><strong>Print</strong></a></td></tr>
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
							<td align='left' valign='top'>".ucwords($spid). "  ".$bus_type."</td>
							<td align='left' valign='top'></td>
							<td align='left' valign='top' nowrap='nowrap'><b>Booker Name & Email</b></td>
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
							<td align='left' valign='top'>".$total_amtt."</td>
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
							<td valign='top'>".$disamount."</td>
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
						<div style=" width:730px; margin-left:30px; height:auto;border:1px solid #B7E3FF; background:#F3FBFF;font-size:12px;">
					<table width="100%" border="0" cellpadding="3" cellspacing="5">	
					<tr><td colspan='9' align='center'><strong>Passenger Details </strong></td></tr>
				    <tr>
					<td><strong>S.No</strong></td>
					<td><strong>Passenger Name</strong> </td>
					<td><strong>Seat No</strong> </td>
					<td><strong>Gender</strong> </td>
					<td><strong>Age</strong> </td>
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
				<div style=" width:750px; height:auto;border:1px solid #B7E3FF; background:#F3FBFF; margin:10px 30px ; font-size:12px;">
					<table width="100%" border="0" cellpadding="3" cellspacing="5">	
					<tr><td colspan='9' align='center'><strong style="font-size:15px;">Terms & Conditions</strong></td></tr>
				   
					<tr>
									
					<td align="left" colspan='9'><?php echo $query['conditions']; ?></td>
					</tr>
					</table>
										
					</div>
				<?php
	$t_v=mysql_query("select * from bookinginfo as bkin, businfo as bin,booker_details as bd where bkin.Ticket_ID = '".$ticket."' and bkin.Bus_id = bin.Bus_id AND bd.Booker_email='".$email."' AND bkin.cancelledStatus=0 AND bkin.Ticket_ID=bd.Ticket_ID") or die(mysql_error());
	$print_num_passengers= mysql_num_rows($t_v);	
	$trow = mysql_fetch_object($t_v);
	$msg_print='<div style="width:750px; height:auto; background-color:#fff; border:10px solid rgb(165, 220, 255);  margin:0px; padding:0px;">
<div style="width:209px; height:50px;"><img border="0" src="'.$img.'"></div>
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
							<td valign="top" nowrap="nowrap">'.get_SP($trow->SP_id).'&'.get_bus_type($trow->Bus_type).'</td>
							<td valign="top"></td>
							<td valign="top" nowrap="nowrap"><b>Mobile Number</b></td>
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
						<td valign="top" nowrap="nowrap"><b>Need to Pay</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap">Rs.'.$total_amtt.'</td>	
							<td>&nbsp;</td>
							<td valign="top">Promotional Code</td>
							<td valign="top">:</td>
							<td valign="top">'.$coupon_id.'</td>
							<td >&nbsp;</td>
							
								
						</tr>
						<tr>
						<td>&nbsp;</td>
						<td valign="top" nowrap="nowrap"><b>Discount Amount</b></td>
							<td valign="top">:</td>
							<td valign="top" nowrap="nowrap">Rs.'.$disamount.'</td>	
							<td>&nbsp;</td>
							<td valign="top">Total amount Paid</td>
							<td valign="top">:</td>
							<td valign="top">'.$fare.'</td>
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
//echo $msg;
//session_start();
	$_SESSION['msgg']=$msg_print;
	
	
	//echo $_SESSION['msg'];
	
	?>
	<?php
						
mail($email,$subject,$msg_print,$headers);

$transactiondetails=mysql_fetch_array(mysql_query("SELECT * FROM payment_transaction WHERE ticket_id='$ticket_id'"));

$provider=mysql_fetch_array(mysql_query("SELECT * FROM serviceprovider_info WHERE SP_id='$SP_id'"));

$bookinfodetails=mysql_fetch_array(mysql_query("SELECT * FROM bookinginfo WHERE Ticket_ID='$ticket_id'"));

$userid=$bookinfodetails['userid'];

$txtmobile='';
$msg='';
$providername=substr($provider['SP_name'],0,8);

$userdetails=mysql_fetch_array(mysql_query("SELECT user_mobileno FROM users WHERE user_id='$userid'"));

$txtmobile=$userdetails['user_mobileno'];

$smsticket = sendsms($txtmobile,$msg,$providername);
	
	//echo $smsticket;exit;
	
	if($smsticket=='') {
		$msgstatus="Page error";
		$smsstatus=2;
	} elseif($smsticket=='nocredit') {
		$msgstatus="No sms balance";
		$smsstatus=2;
	} elseif($smsticket<0) {
		$msgstatus="Number error";
		$smsstatus=2;
	} elseif(strlen($smsticket)>15) {
		$msgstatus="progress";	
		$smsstatus=0;
	} else {
		$msgstatus="failed";
		$smsstatus=2;
	}
	
	//echo "<br>".$msgstatus."<br>";
	//echo $txttick."<br>".$txtmobile."<br>".$smsticket."<br>";
	
	
	$usertype=1;
	
	$smsinsert=mysql_query("INSERT INTO smslog (sms_spid, smsbus_id, sms_usertype, sms_userid, sms_mailid, sms_ticket, sms_purpose, sms_from, sms_to, sms_date, datetime, sms_status, status) VALUES ('$SP_id', '$Bus_id', '$usertype', '$userid', '$transactiondetails[pay_email]', '$ticket_id', 'Payment confirmation', '$providername', '$txtmobile', NOW(), NOW(), '$msgstatus', '$smsstatus')");

  // $_SESSION['action']=1;	
   //}
	/*else{
	     $_SESSION['action']=0;        
	     header("location: index.php");
	}*/
		 //unset($_SESSION['book_var']);         
		 //unset($_SESSION['ticket_id']); 	
?>
	
						</table>
						</td>
						</tr>
	
</table>


	

	</td>

							</tr>

						</table>

					</td>

				</tr>
				<tr><td colspan="2" height="110">&nbsp;</td></tr>	
			</table>	
          </div>
		</td>
      
	</tr>

</table>



					</td>

					    </tr>

					    <tr>

					    	<td valign="top">

<?php	include_once("includes/footer.php"); ?>

					        </td>

					    </tr>

					</table>

					

        </td>

    </tr>

</table>

</body>

</html>