<?php include "includes/header.php"; ?>

<?php 

$val_Dateeee=date("Y-m-d",strtotime($_REQUEST["dat"]));
$sssga=date('Y-m-d');
$journey_date	= date("d-m-Y",strtotime($_REQUEST["dat"]));
$service=$_REQUEST['service'];
$triptype=$_REQUEST['triptype'];

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


<!-- // date & Time picker -->


<body>

<fieldset class="table-bor">

	<legend><strong>Ticket Booking</strong></legend>

  <table>
  
  <tr>
  <td width="841">
  <?php
  $query = "SELECT * FROM businfo WHERE SP_id ='$service' and Bus_status = 1 and ('$val_Dateeee' <= DATE_ADD('$sssga',INTERVAL `active_days` DAY)) and (disable_date NOT LIKE '%$journey_date%') ";

if(isset($_REQUEST['ter_from']) && isset($_REQUEST['ter_to']) && isset($_REQUEST['dat']) && $_REQUEST['ter_from']!='none' && $_REQUEST['ter_to']!='none'){
  $ter_from=mysql_real_escape_string($_REQUEST['ter_from']);
   $ter_to=mysql_real_escape_string($_REQUEST['ter_to']);
  $service=mysql_real_escape_string($_REQUEST['service']); 

  $flag=1;
  $query .=" AND ";
  $query .=" `Bus_fromcity` = ".$ter_from." and `Bus_tocity` = ".$ter_to;  
  }
   $query .= " group by Bus_id LIMIT 0,20";
   $result_pag_data = mysql_query($query) or die('MySql Error' . mysql_error());
$msg = "";

$msg .='<div class="data"><table width="90%" border="0" cellspacing="2" cellpadding="5" align="center">
  <tr>
    <th>Travels</th>
	<th>Bus Name</th>
    <th>Bus Type</th>
    <th align="left">Departure</th>
   <!-- <th align="center">Arrival</th>-->
    <th align="center">Fare in Rs</th>
    <th align="center">No.of Seats</th>
    <th align="left">Status</th>
  </tr>';
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
		//echo count($booked_seat)."<br>";
		// echo count($total_seat);
		
		//$available_seat = available_seats($booked_seat,$total_seat);
		if(count($booked_seat)!=0 && count($total_seat)!=0){
		$available_seat = array_diff($total_seat,$booked_seat); 
		//print_r($available_seat);
		}
		else{
		$available_seat=$total_seat;
		}
		
		if(count($total_seat) > 0)
		{
			if(count($available_seat)>0)
			{
				$bus_status = '<a href="available_seat.php?bus_id='.$bus_id.'&dat='.$dat.'&triptype='.$triptype.'" title="Book Seats In this Bus">Book</a>';
			}
			else
			{
				$bus_status = "Sold out";
			}
		
			
		$msg.='<tr>
			<td align="left">'.get_SP_name($sp_id).'</td>
			<td align="left">'.get_bus_name($bus_id).'</td>
			<td align="left">'.get_bus_type($bus_type).'</td>
			<td  align="left">'.$departure[0].'</td>
			<!--<td  align="center"></td>-->
			<td align="center">'.$bus_fare.'</td>
			<td align="center">'.count($available_seat).'</td>
			<td align="left">
			'.$bus_status.'</td> 
		  </tr>';
		  }
		}
    }
	else {
            $msg.='<tr>
			<td colspan="7" align="center"><span class="err_msg">Buses Not Available .</span></td>
			
		  </tr>';	
	}	
	$msg.= "</table></div>" ;
echo $msg =  $msg ;
  ?>  </td>
 
  </tr>
  </table>
</fieldset>
	 
</body>


<?php

include "includes/footer.php";
?>