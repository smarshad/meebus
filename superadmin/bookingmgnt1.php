<?php include "includes/header.php"; ?>

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
	});



function hide_value(){
	if($("#date").val() == "Select Date"){
		$("#date").val('');
	}
}
				
function show_value(){
	if($("#date").val() == ""){
		$("#date").val('Select Date');
	}
}

</script>


<!-- // date & Time picker -->


<body>

<fieldset class="table-bor">

	<legend><strong>Ticket Booking</strong></legend>

<table width="90%" border="0" cellspacing="5" cellpadding="5" align="center">

  <tr><td colspan="3"><strong>Bus Terminals</strong></td>
<tr><td colspan="3"><input type="radio" name="triptype" id="triptype" value="1" />&nbsp;&nbsp;&nbsp;One-Way
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="triptype" id="triptype" value="2" />&nbsp;&nbsp;&nbsp;Round Trip

</td></tr>
  <tr>
  	<td>From</td><td>To</td><td>Journey Date</td>
  </tr>
  <tr>
    <td>
	<select name="ter_from" id="ter_from" onChange="get_destination_points(this.value);">
	<option value="none">--Select From--</option>
	<?php
	$sp_qry=mysql_query("SELECT * FROM service_routes,cities WHERE service_routes.SR_status=1 and cities.id=service_routes.SR_source and cities.del_status!=0  group by service_routes.SR_source order by cities.city_name asc");
	 
	while($row=mysql_fetch_object($sp_qry)){
	?>
	<option value="<?php echo $row->SR_source; ?>"><?php echo get_city_name($row->SR_source); ?></option>
	<?php } ?>
	</select>
	</td>
    <td>
	<span id="get_destination">
	<select name="ter_to" id="ter_to" >
	<option value="none">--Select To--</option>	
	</select>
	</span>
	<span id="loading"></span>
	</td>
	<td>
	<input type="text" name="date" id="date" class="textbox" readonly="readonly" value="Select Date" onFocus="hide_value();" onBlur="show_value();" />
	</td>
	<td>
	<input type="submit" value="Search" onClick="return available_bus();">
	</td>
  </tr>
</table>
	<div id="loading"></div>
	 <div id="container">
	  <div class="data" id="gan"></div>	
	 </div>
	 <div class="pagination"></div>
</fieldset>
<script type="text/javascript">
function avl_seats(bus_id,dat,trip){
 document.book_needs.bus_id.value=bus_id;
 document.book_needs.dat.value=dat;
 document.book_needs.trip.value=trip;
 document.book_needs.submit();
}
</script>
<form name="book_needs" id="book_needs" action="available_seat.php" method="post">
<input type="hidden" name="bus_id" id="bus_id" value="">
<input type="hidden" name="dat" id="dat" value="">
<input type="hidden" name="trip" id="trip" value="">
</form>
</body>


<?php

include "includes/footer.php";
?>