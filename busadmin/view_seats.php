<?php
//error_reporting(0);
	include_once("includes/header.php");	
	$ticket_no=$_REQUEST['ticket_no'];
	$dat=$_REQUEST['dat'];
	$fromcity= $_REQUEST['fromcity'];
	$tocity=$_REQUEST['tocity'];
	$SP_id=$_REQUEST['SP_id'];
	
	if(isset($_REQUEST['submit']))
	{ 
	//echo $_REQUEST['seatval']; exit;
	
	
	
	$SP_id=$_REQUEST['SP_id'];
	  $n = $_REQUEST['seatval'];
        // print_r($n); exit;
	//echo count($n); 
		
			// echo $stno; exit;
			//echo $_REQUEST['seatval']; exit;
		   if(isset($_REQUEST['seatval']))
			{
			for($j=0; $j<count($n); $j++)
		 {
		    $seat_no = $n[$j]; 
			//echo $n[0]."-".$n[1]."-".$n[2]."-".$n[3]; exit;
			 $stno = "seatno_".$seat_no; 
		//echo "SELECT SP_id,Bus_id,SeatNo,travelling_date,booked_date,Ticket_id,userid,usertype FROM bookinginfo WHERE SeatNo='".$seat_no."' and Ticket_ID = '".$_REQUEST['ticket_id']."'"; exit;
			
			 $booking=mysql_fetch_array(mysql_query("SELECT SP_id,Bus_id,SeatNo,travelling_date,booked_date,booking_amt,Ticket_id,userid,usertype FROM bookinginfo WHERE SeatNo='".$seat_no."' and Ticket_ID = '".$_REQUEST['ticket_id']."'"));
			 
			  $details=mysql_fetch_array(mysql_query("SELECT * from booker_details where Ticket_ID='".$_REQUEST['ticket_id']."'"));
			  
			  $cancel_chg_sql=mysql_query("SELECT * FROM cancellation_policies WHERE SP_id=".$SP_id." AND status=1 ORDER BY time DESC");		
			  //echo "SELECT * FROM cancellation_policies WHERE SP_id=".$SP_id." AND status=1 ORDER BY time DESC"; 
			$bus_arr=mysql_fetch_array(mysql_query("SELECT * FROM businfo WHERE SP_id = ".$SP_id));
			  
			 $cur_date=mktime(0, 0, 0, date("m"), date("d"),date("Y"));
            
			$traa=$booking['travelling_date'];
			$str=explode("-",$traa);
			
			$traa_date=mktime(0, 0, 0, date($str[1])  , date($str[2]), date($str[0]));
			
			
					 
					    while($cancel_SPdata=mysql_fetch_array($cancel_chg_sql))
						{
						   // echo "test"; 
							 $db_duration=$cancel_SPdata['duration'];
							  $db_time=$cancel_SPdata['time'];
							 $db_refundamt=$cancel_SPdata['refundable_amt'];
							  
						}
			
			   $ins=mysql_query("INSERT INTO `cancelled_tickets` (`SP_id`, `Bus_id`, `SeatNo`, `travelling_date`, `cancelled_date`, `Ticket_id`, `userid`, `usertype`,`book_amt`) values ('$SP_id','$booking[Bus_id]','$seat_no','$booking[travelling_date]',NOW(),'$_REQUEST[ticket_id]','$booking[userid]','$booking[usertype]','$booking[booking_amt]')");
			  
			  
			 // echo "INSERT INTO `cancelled_tickets` (`SP_id`, `Bus_id`, `SeatNo`, `travelling_date`, `cancelled_date`, `Ticket_id`, `userid`, `usertype`) values ()"  exit;
		
				//echo $db_refundamt;	 exit;
					
			  $lastID=mysql_insert_id();
			  
			// echo "UPDATE cancelled_tickets SET cancelled_date='".date('Y-m-d')."', refund_amt='".ceil($booking['booking_amt']*($db_refundamt/100))."' WHERE auto_id=".$lastID; exit;
			  
			  mysql_query("UPDATE cancelled_tickets SET cancelled_date='".date('Y-m-d')."', refund_amt='".ceil($booking['booking_amt']*($db_refundamt/100))."' WHERE auto_id=".$lastID) or die(mysql_error());
			  
				$qry=mysql_query("UPDATE bookinginfo set cancelledStatus='1' WHERE SeatNo='".$seat_no."' and Ticket_ID = '".$_REQUEST['ticket_id']."' ");
				
				mysql_query("UPDATE passengerinfo set cancelledStatus='1' WHERE passenger_seatNo='".$seat_no."' and Ticket_ID = '".$_REQUEST['ticket_id']."' ");
				
				if($ins)
				{
				
				$booker_name=$details['Booker_name'];
		$booker_email=$details['Booker_email'];
		$booking_date=$booking['booked_date'];
		$journey_date=$booking['travelling_date'];
		$booker_mobile=$details['Booker_mobile'];


		$from_city=strtoupper(get_city_name($bus_arr['Bus_fromcity']));
		$to_city=strtoupper(get_city_name($bus_arr['Bus_tocity']));
		$cancel_date=date("d-m-Y");
		 $bus_fare=$bus_arr['Bus_fare'];
				$sp_name=get_SP($SP_id);
		$mail_bustype=get_bus_type($bus_arr['Bus_type']) ;	
		
		$image = $site_url.'/images/'.$imglogo; 	
		
		$img = $image;	
		
		//echo $img; exit;
		$subject = "Cancelled Ticket Details - ".$title;        
		
            //ini_set(SMTP,"mail.i-netsolution.com");
            $headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From:'.$website_name.'<'.$mail_url.'>' . "\r\n";		
		
		$msg='<table width="600" cellspacing="0" cellpadding="0" border="1" style="width: 525pt; background: none repeat scroll 0% 0% rgb(244, 158, 35); border: 6pt solid rgb(165, 220, 255);">
 <tbody><tr style="min-height: 70.5pt;">
  <td style="border: medium none; background: none repeat scroll 0% 0% white; padding: 0in; min-height: 70.5pt;">
  <p ><img src="$img" border="0" width="180" height="120"></p>
  </td>
 </tr>
 <tr>
  <td style="border: medium none; background: none repeat scroll 0% 0% white; padding: 0in;"></td>
 </tr>
 <tr>
  <td style="border: medium none; background: none repeat scroll 0% 0% white; padding: 0in;">
  <table width="100%" cellspacing="10" cellpadding="0" border="1" style="width: 100%; background: none repeat scroll 0% 0% rgb(243, 251, 255); border: 1pt solid rgb(183, 227, 255);">
   <tbody><tr>
    <td width="50" style="width: 37.5pt; border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td nowrap="" width="175" valign="top" style="width: 131.25pt; border: medium none; padding: 7.5pt;">
    <p ><b>Ticket Number</b></p>    </td>
    <td width="25" valign="top" style="width: 18.75pt; border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td width="150" valign="top" style="width: 115.5pt; border: medium none; padding: 7.5pt;"  nowrap="nowrap">
    <p>'.$_REQUEST["ticket_id"].'</p>    </td>
    <td width="50" valign="top" style="width: 37.5pt; border: medium none; padding: 7.5pt;"></td>
    <td width="150" valign="top" style="width: 112.5pt; border: medium none; padding: 7.5pt;"></td>
    <td width="25" valign="top" style="width: 18.75pt; border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>Mobile Number</td>
    <td width="150" valign="top" style="width: 112.5pt; border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>:</td>
    <td width="50" style="width: 37.5pt; border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>'.$booker_mobile.'</td>
   </tr>
   <tr>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;" nowrap="nowrap">
    <p ><b>Service Provider &amp; Type</b></p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >'.$sp_name.'&'.$mail_bustype.'</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"></td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">
    <p ><b>Booker Name & Email</b></p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >'.ucfirst($booker_name).' & '.$booker_email.'</p>    </td>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
   </tr>
   <tr>
    <td width="50" style="width: 37.5pt; border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td width="175" valign="top" style="width: 131.25pt; border: medium none; padding: 7.5pt;">
    <p ><b>From</b></p>    </td>
    <td width="25" valign="top" style="width: 18.75pt; border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td width="150" valign="top" style="width: 112.5pt; border: medium none; padding: 7.5pt;"  nowrap="nowrap">
    <p >'.$from_city.'</p>    </td>
    <td width="50" valign="top" style="width: 37.5pt; border: medium none; padding: 7.5pt;"></td>
    <td width="150" valign="top" style="width: 112.5pt; border: medium none; padding: 7.5pt;">
    <p ><b>To</b></p>    </td>
    <td width="25" valign="top" style="width: 18.75pt; border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td width="150" valign="top" style="width: 112.5pt; border: medium none; padding: 7.5pt;"  nowrap="nowrap">
    <p >'.$to_city.'</p>    </td>
    <td width="50" style="width: 37.5pt; border: medium none; padding: 7.5pt;">

    <p >&nbsp;</p>    </td>
   </tr>
   <tr>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">
    <p ><b>Date of Cancellation </b></p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >'.$cancel_date.'</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"></td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">
    <p ><b>Date of Journey</b></p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >'.$journey_date.'</p>    </td>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
   </tr>
   <tr>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td nowrap="nowrap" valign="top" style="border: medium none; padding: 7.5pt;"><p ><b>Fare per Ticket</b></p></td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"><p >:</p></td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"><p >Rs.'.$bus_fare.' </p></td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"></td>
    <td nowrap="nowrap" valign="top" style="border: medium none; padding: 7.5pt;"><p ><b>Date of Booking </b></p></td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"><p >:</p></td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"><p >'.$booking_date.'</p></td>
    <td style="border: medium none; padding: 7.5pt;"></td>
   </tr>
   <tr>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">
    <p ><b>Seat Number(s)</b></p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >:</p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">
    <p >'.$seat_no.' </p>    </td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"></td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
   </tr>
   <tr>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">Percentage of Cancellation</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">'.$db_refundamt.' %</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"></td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
   </tr>
  <tr>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;"></td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"></td>
    <td valign="top" style="border: medium none; padding: 7.5pt;"></td>
    <td nowrap="" valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td valign="top" style="border: medium none; padding: 7.5pt;">&nbsp;</td>
    <td style="border: medium none; padding: 7.5pt;">
    <p >&nbsp;</p>    </td>
   </tr>
  </tbody></table>
  </td>
 </tr>
 <tr style="min-height: 57.75pt;">
  <td style="border: medium none; background: none repeat scroll 0% 0% white; padding: 0in 0in 0in 15pt; min-height: 57.75pt;">
  <p style="line-height: 13.5pt;"><span style="font-size: 8.5pt; color: black;">Regards,<br>
  '.$siteteam.' </span></p>
  </td>
 </tr>
 <tr>
  <td style="border: medium none; background: none repeat scroll 0% 0% white; padding: 0in;"></td>
 </tr>
 <tr style="min-height: 30pt;">
  <td style="border: medium none; background: none repeat scroll 0% 0% rgb(165, 220, 255); padding: 0in; min-height: 30pt;">
  <p align="right" style="text-align: right;" ><span style="font-size: 7.5pt; color: black;">&copy;
  Copyright &copy; 2013 <b><i>'.$siteteam.'</i></b>. </span><span style="font-size: 7.5pt;"></span></p>
  </td>
 </tr>
</tbody></table>';

//echo $booker_email."<br>".$subject."<br>".$msg."<br>".$headers; exit;

mail($booker_email,$subject,$msg,$headers);




}

}
header("Location:view_seats.php?ticket_no=$ticket_no&dat=$dat&fromcity=$fromcity&tocity=$tocity&SP_id=$SP_id&suc");	
}	
else
{
			//echo "UPDATE bookinginfo SET cancelledStatus = 0 WHERE SeatNo=".$seat_no." and Ticket_ID = ".$_REQUEST['ticket_id'];
header("Location:view_seats.php?ticket_no=$ticket_no&dat=$dat&fromcity=$fromcity&tocity=$tocity&SP_id=$SP_id&succ");
}
}
?>
<script src="../js/pagination.js" type="text/javascript"></script>

<script type="text/javascript" language="javascript">

		
function fn_hide()
{
	if($("#datepicker").val() == "Click here")
	{
		$("#datepicker").val('');
	}
}
				
function fn_show_value()
{
	if($("#datepicker").val() == "")
	{
		$("#datepicker").val('Click here');
	}
}

	$(function() 
	{
		$('#datepicker').datepicker({numberOfMonths: 1, showButtonPanel: false});
	});
	
</script>

<body>
<fieldset class="table-bor">
		<legend><strong>View Seats</strong></legend> 
	
		
		<table width="100%" border="0" cellspacing="2" cellpadding="5">
		
		
		<tr><td colspan="4">[ Note: <span class="suc_msg">Available Tickets</span> &nbsp; <span class="err_msg">Journey Date Expired Tickets</span>]
		</td></tr>
		<tr><td colspan="4">&nbsp;</td></tr>
		
		<?php if(isset($_REQUEST['suc'])) { ?>
		<tr><td colspan="4">&nbsp;</td></tr>
			<tr><td colspan="4" style="color:#006633;" align="center"><strong>Ticket has been Canceled Succesfully</strong></td></tr>
		
		<?php } else if(isset($_REQUEST['succ'])) { ?>
		<tr><td colspan="4">&nbsp;</td></tr>
			<tr><td colspan="4" style="color:#006633;" align="center"><strong>Ticket has not been cancelled </strong> </td></tr>
			
		<?php } ?>
			<tr>
			<th width="10%" align="center">Ticket No :</th>
			<th width="35%">
			<?php echo $_REQUEST['ticket_no']; ?> <br>
			</th>
			
							
			<th width="10%" align="center"> Travel Date : </th>
			<th width="22%">
				<?php echo $_REQUEST['dat']; ?>
			</th>
			
		  </tr>
		  
		  <tr><td colspan="4">&nbsp;</td></tr>
		  
		 <tr>
		 	<td colspan="4">
				<table width="100%" border="0" cellpadding="3" cellspacing="5">
				
				<form name="form" action="" method="post">
				<tr>
					<td><input type="checkbox" name="selectall" id="selectall" onClick=""></td>
					<td> <strong>Service Provider</strong> </td>
					<td> <strong>From - To City</strong> </td>
					<td> <strong>Seat No</strong> </th>
					<td> <strong>Passenger Name</strong> </td>
					<td> <strong>Gender</strong> </td>
					<td> <strong>Age</strong> </td>
				</tr>
				
		<?php 
		$frm = $_REQUEST['fromcity'] ;
		
		$scount12 = mysql_fetch_array(mysql_query("select * from cities where id = '$frm'"));
		
		$fcity = ucwords($scount12['city_name']) ;
		
		$to = $_REQUEST['tocity'] ;
		
		$scount13 = mysql_fetch_array(mysql_query("select * from cities where id = '$to'"));
		
		$tcity = ucwords($scount13['city_name']) ;
				
			$frmtocity = $fcity." - ".$tcity;	
				  
					$ticket = $_REQUEST['ticket_no'];
					$i = 1;
					$qry = passenger_info($ticket);
					
					//echo $qry; 
					
					$num = mysql_num_rows($qry);
					while($row = mysql_fetch_array($qry))
					{  
					 $qry1=mysql_fetch_array(mysql_query("SELECT * FROM bookinginfo WHERE SeatNo = '".$row['passenger_seatNo']."' and Ticket_ID = '".$ticket."'"));
					
				?>
				<input type="hidden" name="passenger_id" id="passenger_id" value="<?php echo $row['passenger_ID']; ?>" >
				<input type="hidden" name="ticket_id" id="ticket_id" value="<?php echo $row['Ticket_ID']; ?>" >
				<input type="hidden" name="count" id="count" value="<?php echo $num; ?>" >
				<tr>
					<td> 
					<?php
					$cur_date=mktime(0, 0, 0, date("m"), date("d"),date("Y"));

                    $tra=$qry1['travelling_date'];
					$str=explode("-",$tra);
					
					$tra_date=mktime(0, 0, 0, date($str[1])  , date($str[2]), date($str[0]));
					if($cur_date>$tra_date){
					$proc=0;
					   ?>
					   <script type="text/javascript">
					   document.getElementById('selectall').style.display="none";
					   </script>
					   <span class="err_msg"><?php echo $i; ?></span>
					   <?php
					   }
					else{
					$proc=1;
					  ?>
					  <input type="checkbox" name="seatval[]" id="seatno[]" class="case"  value="<?php echo $row['passenger_seatNo']; ?>"/>
					  <?php
					   }
					?>
					</td>
					<td> <?php echo get_SP_name($_REQUEST['SP_id']); ?> </td>
					<td> <?php echo $frmtocity; ?> </td>
					<td> <?php echo $row['passenger_seatNo']; ?> </td>
					<td> <?php echo $row['passenger_Name']; ?> </td>
					<td> <?php echo $row['passenger_Gender']; ?> </td>
					<td> <?php echo $row['passenger_Age']; ?> </td>
				</tr>
				<?php
				 $s_no.=$row['passenger_seatNo'].",";
				 $i++; } ?>
				<input type="hidden" name="seatno" id="seatno" value="<?php echo $s_no; ?>" >
				<input type="hidden" name="SP_id" value="<?php echo $_REQUEST['SP_id']; ?>">
				
				<tr><td colspan="5" align="center">
				<?php if($proc==1) { ?>
				<!--<input type="button" name="submit" id="submit" value=" Cancel " onClick="alert('This is Demo version !!!');">-->    
				<input type="submit" name="submit" id="submit" value=" Cancel ">
				<?php } else{ echo "&nbsp;"; } ?>				
				<input type="button" name="back" id="back" value=" Back " onClick="window.location.href='passmgmt.php'">
				</td>
				</tr>
				</form>
				</table>
		 	</td>
		 </tr>
		</table>
		<br>		
		<div id="loading"></div>
        <div id="container">		
            <div class="data">			
			</div>
            <div class="pagination"></div>			
        </div>
		<br />
		</fieldset>
</body>
<?php include("includes/footer.php"); ?>
<SCRIPT language="javascript">
$(function(){ 
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () { 
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
	
	
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});
</SCRIPT>
