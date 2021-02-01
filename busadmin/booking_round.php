<?php include "includes/header.php"; ?>

<?php 

$val_Dateeee=date("Y-m-d",strtotime($_REQUEST["dat"]));
$val_Dateeee1=date("Y-m-d",strtotime($_REQUEST["dat1"])); 
$sssga=date('Y-m-d');
$journey_date	= date("d-m-Y",strtotime($_REQUEST["dat"]));
$return_date	= date("d-m-Y",strtotime($_REQUEST["dat1"]));
$service=$_REQUEST['service']; 
$triptype=$_REQUEST['triptype'];
$ter_from=mysql_real_escape_string($_REQUEST['from']);
 $ter_to=mysql_real_escape_string($_REQUEST['to']);
$from_city=get_city_name($ter_from);
$to_city=get_city_name($ter_to);
 ?>
 
 <?php
if(isset($_REQUEST['submit']))
{

$bussid=$_REQUEST['bus_id'];
$round=$_REQUEST['round'];
$travel1=$_REQUEST['travel_date'];
$travel2=$_REQUEST['travv_date'];
$sppid=$_REQUEST['sp_id'];
$tripp=$_REQUEST['triptype'];
$tottseat=$_REQUEST['total_seats'];
$query = mysql_fetch_array(mysql_query("SELECT * FROM businfo where Bus_id= $bussid "));
$from_city = $query['Bus_fromcity'];
$to_city = $query['Bus_tocity'];
if($round==1)
{
$tot_seat = substr($_REQUEST['total_seats'],0,-1);
$total_seats = explode(",",$tot_seat); 
$count1 = (count($total_seats)-1);

$seat_avail=mysql_num_rows(mysql_query("select * from bookinginfo where Bus_id='$bussid' and SeatNo IN ($tot_seat) and travelling_date='$travel1' and Blocked=1")); 

if($seat_avail==0)
{

for($i=0; $i<=$count1; $i++)
{
$qry = mysql_query("insert into bookinginfo (Bus_id, SeatNo, travelling_date, Blocked) values ('".$bussid."', '".$total_seats[$i]."', '".$travel1."', '1') ");
}
header("location:booking_round.php?from=$from_city&to=$to_city&dat=$travel1&dat1=$travel2&triptype=$triptype&service=$sppid&bbusidd=$bussid&sseatt22=$tottseat&round=$round"); exit;
}
else
{
header("location:booking_round.php?from=$from_city&to=$to_city&dat=$travel1&dat1=$travel2&triptype=$triptype&service=$sppid&err_round"); exit;
 }
} 
else if($round==2)
{
$tot_seat = substr($_REQUEST['total_seats'],0,-1);
$total_seats = explode(",",$tot_seat); 
$count1 = (count($total_seats)-1);

$seat_avail=mysql_num_rows(mysql_query("select * from bookinginfo where Bus_id='$bussid' and SeatNo IN ($tot_seat) and travelling_date='$travel2' and Blocked=1")); 

if($seat_avail==0)
{

for($i=0; $i<=$count1; $i++)
{
$qry = mysql_query("insert into bookinginfo (Bus_id, SeatNo, travelling_date, Blocked) values ('".$bussid."', '".$total_seats[$i]."', '".$travel2."', '1') ");
}
header("location:booking_round.php?from=$to_city&to=$from_city&dat=$travel1&dat1=$travel2&triptype=$triptype&service=$sppid&bbusidd1=$bussid&sseattt1=$tottseat&round1=$round"); exit;
}
else
{
header("location:booking_round.php?from=$to_city&to=$from_city&dat=$travel1&dat1=$travel2&triptype=$triptype&service=$sppid&err_round1"); exit;
}
}
else { }
}

?>
<script src="../js/pagination.js" type="text/javascript"></script>

<!-- date & Time picker -->

<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
<!--	<script type="text/javascript" src="js/jquery-ui-timepicker-addon.min.js"></script>	
	<script type="text/javascript" src="js/timepicker.js"></script>
-->
<script type="text/javascript">


	$(function() {
	var dateFormat;
	try{
    dateFormat= $( ".selector" ).datepicker( "option", "dateFormat" );
	}
	catch(e){ }
	
		$('#date').datepicker({ 		
			numberOfMonths: 2, 
			showButtonPanel: false, 
			minDate: +0, 
			maxDate: '+3M +0D', 
			//showOn: 'button', 
			buttonImage: '../images/calendar_icon.gif', 
			buttonImageOnly: true, 
		    dateFormat: 'dd-mm-yy'
			
		});	
		$('#date1').datepicker({ 		
			numberOfMonths: 2, 
			showButtonPanel: false, 
			minDate: +0, 
			maxDate: '+3M +0D', 
			//showOn: 'button', 
			buttonImage: '../images/calendar_icon.gif', 
			buttonImageOnly: true, 
		    dateFormat: 'dd-mm-yy'
			
		});	
	});



function hide_value(){
	if($("#date").val() == "Select Date"){
		$("#date").val('');
	}
	if($("#date1").val() == "Select Date"){
		$("#date1").val('');
	}
}
				
function show_value(){
	if($("#date").val() == ""){
		$("#date").val('Select Date');
	}
	if($("#date1").val() == ""){
		$("#date1").val('Select Date');
	}
}

</script>

<script type="text/javascript">
function showreturn(val)
{
if(val==2) {
document.getElementById('returnshow').style.display="block";
document.getElementById('round_sub').innerHTML="<input type='submit' value='Search' onClick='return available_round();'>";
}
else
{
document.getElementById('returnshow').style.display="none";
}
}
</script>


<!-- // date & Time picker -->


<body>

<fieldset class="table-bor">

	<legend><strong>Ticket Booking</strong></legend>

  <table>
  <tr style="background-color:#EAF7FF;">
  <td valign="top" style="padding-left:20px;">
 
<?php if(isset($_REQUEST['round'])) {
$_SESSION['rround']= $_REQUEST['round'];
$_SESSION['bbusidd']= $_REQUEST['bbusidd'];
$_SESSION['sseatt22']= $_REQUEST['sseatt22'];
$_SESSION['trav_from']= $_REQUEST['dat'];
$_SESSION['trav_too']= $_REQUEST['dat1'];
$bbus=$_REQUEST['bbusidd'];
$sseatt=$_REQUEST['sseatt22'];
$tot_seat = substr($_REQUEST['sseatt22'],0,-1);
} else if(isset($_SESSION['rround'])) {
$bbus=$_SESSION['bbusidd'];
$sseatt=$_SESSION['sseatt22'];
$tot_seat = substr($_SESSION['sseatt22'],0,-1);
} else { }
$total_seats = explode(",",$tot_seat); 
$count = count($total_seats);
$_SESSION['sel_count']=$count;
$query = mysql_fetch_array(mysql_query("SELECT * FROM businfo where Bus_id='$bbus' "));
$fromm_city = $query['Bus_fromcity'];
$ffcity = get_city_name($fromm_city);
$too_city = $query['Bus_tocity'];
$buss_name = $query['Bus_name'];
$buss_fare = ($count*$query['Bus_fare']);
$ttcity = get_city_name($too_city);
?>
<br />
<?php
if(isset($_REQUEST['err_round'])) { ?>
<span style="color:#FF0000; font-size:12px; padding-left:100px;">Seats are already Booked</span>
<?php } ?>
<?php if(($_REQUEST['round']!="") || ($_SESSION['rround']!="")) { ?>
<span style="font-size:12px; font-weight:bold; color:#009900;"><?php echo $ffcity; ?> to <?php echo $ttcity; ?></span><br /><br />
<table><tr>
<td width="202" style="font-size:12px;">Bus Name : <?php echo $buss_name; ?></td> 
<td width="164" style="font-size:12px;">Seat Numbers : <?php echo $tot_seat; ?></td>
</tr>
<tr><td style="font-size:12px;">
Total seats : <?php echo $count; ?></td><td style="font-size:12px; color:#FF0000;"> Total Fare : Rs. <?php echo $buss_fare; ?></td>
</tr></table>
<br />

<?php }  ?>

  </td>
  <td valign="top" style="padding-left:20px;">
  <?php if(isset($_REQUEST['round1'])) {
$_SESSION['rround1']= $_REQUEST['round1'];
$_SESSION['bbusidd1']= $_REQUEST['bbusidd1'];
$_SESSION['sseattt1']= $_REQUEST['sseattt1'];
$bbus=$_REQUEST['bbusidd1'];
$sseatt=$_REQUEST['sseattt1'];
$tot_seat = substr($_REQUEST['sseattt1'],0,-1);
} else if(isset($_SESSION['rround1'])) {
$bbus=$_SESSION['bbusidd1'];
$sseatt=$_SESSION['sseattt1'];
$tot_seat = substr($_SESSION['sseattt1'],0,-1);
} else { }
$total_seats = explode(",",$tot_seat); 
$count = count($total_seats);
$_SESSION['sel_count']=$count;
$query = mysql_fetch_array(mysql_query("SELECT * FROM businfo where Bus_id='$bbus' "));
$fromm_city = $query['Bus_fromcity'];
$ffcity = get_city_name($fromm_city);
$too_city = $query['Bus_tocity'];
$buss_name = $query['Bus_name'];
$buss_fare = ($count*$query['Bus_fare']);
$ttcity = get_city_name($too_city);
?>
<br />
<?php
if(isset($_REQUEST['err_round1'])) { ?>
<span style="color:#FF0000; font-size:12px; padding-left:150px;">Seats are already Booked</span>
<?php } ?>
<?php if(($_REQUEST['round1']!="") || ($_SESSION['rround1']!="")) { ?>
<span style="font-size:12px; font-weight:bold; color:#009900;"><?php echo $ffcity; ?> to <?php echo $ttcity; ?></span><br /><br />
<table><tr>
<td width="209" style="font-size:12px;">Bus Name : <?php echo $buss_name; ?></td> 
<td width="157" style="font-size:12px;">Seat Numbers : <?php echo $tot_seat; ?></td>
</tr>
<tr><td style="font-size:12px;">
Total seats : <?php echo $count; ?></td><td style="font-size:12px; color:#FF0000;"> Total Fare : Rs. <?php echo $buss_fare; ?></td>
</tr></table>
<br />

<?php }  ?>
<?php
if(($_SESSION['rround']!="") && ($_SESSION['rround1']!="")) {
?>
<span >
<a href="booker_round.php"><img src="../images/book_red.jpg" /></a>

</span>
<?php } ?>
<br />
</td>
  
  </tr>
 <tr>
  <td width="453" valign="top" style="border-right:1px dashed #6AA6E8;">
  <table>
  <!--<tr>
  <td colspan="5" style="font-size:14px; font-weight:bold; color:#0E6CAA;">
  <?php echo $from_city; ?> to  <?php echo $to_city; ?>
  <hr>
  </td>
  </tr>-->
  
  <tr>
    <th width="51">Travels</th>
	<th width="92">Bus Name</th>
    <th width="85" align="center">Fare in Rs</th>
    <th width="110" align="center">No.of Seats</th>
    <th width="85" align="left">Status</th>
  </tr>
  
  <?php
  $query = "SELECT * FROM businfo WHERE Bus_status = 1 and ('$val_Dateeee' <= DATE_ADD('$sssga',INTERVAL `active_days` DAY)) and (disable_date NOT LIKE '%$journey_date%') ";

if(isset($_REQUEST['from']) && isset($_REQUEST['to']) && isset($_REQUEST['dat']) && $_REQUEST['from']!='none' && $_REQUEST['to']!='none'){
  $ter_from=mysql_real_escape_string($_REQUEST['from']);
   $ter_to=mysql_real_escape_string($_REQUEST['to']);
  $service=mysql_real_escape_string($_REQUEST['service']); 

  $flag=1;
  $query .=" AND ";
  $query .=" `Bus_fromcity` = ".$ter_from." and `Bus_tocity` = ".$ter_to;  
  }
  $query .= " group by Bus_id LIMIT 0,20";
  $result_pag_data = mysql_query($query) or die('MySql Error' . mysql_error());
  if(mysql_num_rows($result_pag_data)>0){
		while ($row = mysql_fetch_array($result_pag_data)) {
	
		$bus_id=$row['Bus_id'];
		$sp_id=$row['SP_id'];
		$bus_type=$row['Bus_type'];
		$bus_fare=$row['Bus_fare'];
		$departure = explode(",",$row['Bus_boarding_time']);
			
		 $dat= mysql_real_escape_string($_REQUEST['dat']);
		
		$dat=changedateformat($dat);	  
		$booked_seat = get_booked_seat($bus_id,$dat);	
		
		$total_seat = get_total_seat($bus_id);
		
		if(count($booked_seat)!=0 && count($total_seat)!=0){
		$available_seat = array_diff($total_seat,$booked_seat); 
		}
		else{
		$available_seat=$total_seat;
		}
		
		if(count($total_seat) > 0)
		{
			if(count($available_seat)>0)
			{
				$bus_status = '<a href="available_from.php?sp_id='.$sp_id.'&bus_id='.$bus_id.'&dat='.$val_Dateeee.'&dat1='.$val_Dateeee1.'&triptype='.$triptype.'" title="Book Seats In this Bus">Book</a>';
			}
			else
			{
				$bus_status = "Sold out";
			}
  ?>
  <tr>
			<td align="left"><?php echo get_SP_name($sp_id); ?></td>
			<td align="left"><?php echo get_bus_name($bus_id); ?></td>
			<td align="center"><?php echo $bus_fare; ?></td>
			<td align="center"><?php echo count($available_seat); ?></td>
			<td align="left"><?php echo $bus_status; ?></td> 
	    </tr>
		  <?php
		   }
		}
    }
	else {
		  ?>
		  <tr><td colspan="5"><span class="err_msg">Buses Not Available</span></td></tr>
  <?php } ?>
  </table>
  </td>
  <td width="472" valign="top"> 
  <table>
 <!-- <tr>
  
  <td colspan="5" style="font-size:14px; font-weight:bold; color:#0E6CAA;">
  <?php echo $to_city; ?> to  <?php echo $from_city; ?>
  <hr>
  </td>
  </tr>-->
 
  <tr>
    <th width="51">Travels</th>
	<th width="92">Bus Name</th>
    <th width="85" align="center">Fare in Rs</th>
    <th width="110" align="center">No.of Seats</th>
    <th width="85" align="left">Status</th>
  </tr>
  
  <?php
  $query1 = "SELECT * FROM businfo WHERE Bus_status = 1 and ('$val_Dateeee1' <= DATE_ADD('$sssga',INTERVAL `active_days` DAY)) and (disable_date NOT LIKE '%$return_date%') ";

if(isset($_REQUEST['from']) && isset($_REQUEST['to']) && isset($_REQUEST['dat']) && $_REQUEST['from']!='none' && $_REQUEST['to']!='none'){
  $ter_from=mysql_real_escape_string($_REQUEST['from']);
   $ter_to=mysql_real_escape_string($_REQUEST['to']);
  $service=mysql_real_escape_string($_REQUEST['service']); 

  $flag=1;
  $query1 .=" AND ";
  $query1 .=" `Bus_fromcity` = ".$ter_to." and `Bus_tocity` = ".$ter_from;  
  }
   $query1 .= " group by Bus_id LIMIT 0,20";
  $result_pag_data = mysql_query($query1) or die('MySql Error' . mysql_error());
  if(mysql_num_rows($result_pag_data)>0){
		while ($row = mysql_fetch_array($result_pag_data)) {
	
		$bus_id=$row['Bus_id'];
		$sp_id=$row['SP_id'];
		$bus_type=$row['Bus_type'];
		$bus_fare=$row['Bus_fare'];
		$departure = explode(",",$row['Bus_boarding_time']);
			
		 $dat= mysql_real_escape_string($_REQUEST['dat']);
		
		$dat=changedateformat($dat);	  
		$booked_seat = get_booked_seat($bus_id,$dat);	
		
		$total_seat = get_total_seat($bus_id);
		
		if(count($booked_seat)!=0 && count($total_seat)!=0){
		$available_seat = array_diff($total_seat,$booked_seat); 
		}
		else{
		$available_seat=$total_seat;
		}
		
		if(count($total_seat) > 0)
		{
			if(count($available_seat)>0)
			{
				$bus_status = '<a href="available_to.php?sp_id='.$sp_id.'&bus_id='.$bus_id.'&dat='.$val_Dateeee.'&dat1='.$val_Dateeee1.'&triptype='.$triptype.'" title="Book Seats In this Bus">Book</a>';
			}
			else
			{
				$bus_status = "Sold out";
			}
  ?>
  <tr>
			<td align="left"><?php echo get_SP_name($sp_id); ?></td>
			<td align="left"><?php echo get_bus_name($bus_id); ?></td>
			<td align="center"><?php echo $bus_fare; ?></td>
			<td align="center"><?php echo count($available_seat); ?></td>
			<td align="left"><?php echo $bus_status; ?></td> 
	    </tr>
		  <?php
		   }
		}
    }
	else {
		  ?>
		  <tr><td colspan="5"><span class="err_msg">Buses Not Available</span></td></tr>
  <?php } ?>
  </table>
   </td>
  </tr>
  </table>
</fieldset>
	 
</body>


<?php

include "includes/footer.php";
?>