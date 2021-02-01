<?php 
include "includes/header.php"; 

if(isset($_REQUEST['search']))
{
extract($_POST);
if($triptype==2)
{
header("location:booking_round.php?from=$ter_from&to=$ter_to&dat=$date_from&dat1=$date_to&triptype=$triptype&service=$servicee");
}
else if($triptype==1)
{
header("location:booking_oneway.php?from=$ter_from&to=$ter_to&dat=$date_from&triptype=$triptype&service=$servicee");
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

}
else
{
document.getElementById('returnshow').style.display="none";
}
}
</script>
<script type="text/javascript">
function valsub()
{
if(document.getElementById('date').value!="Select Date")
{
document.getElementById('date_from').value=document.getElementById('date').value;
}

if(document.getElementById('date1').value!="Select Date")
{

document.getElementById('date_to').value=document.getElementById('date1').value;
}

}
</script>


<!-- // date & Time picker -->


<body>

<fieldset class="table-bor">

	<legend><strong>Ticket Booking</strong></legend>
<form method="post" action="" onSubmit="valsub();">
<table width="90%" border="0" cellspacing="5" cellpadding="5" align="center">

  <tr><td colspan="3"><strong>Bus Terminals</strong></td>

<tr><td colspan="3"><input type="radio" name="triptype" id="triptype" value="1" checked="checked" onClick="showreturn(this.value);" />&nbsp;&nbsp;&nbsp;One-Way
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="triptype" id="triptype" value="2" onClick="showreturn(this.value);" />&nbsp;&nbsp;&nbsp;Round Trip

</td></tr>
  <tr>
  	<td width="49%"> &nbsp;From 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<select name="ter_from" id="ter_from" onChange="get_destination_points(this.value);">
	<option value="none">--Select From--</option>
	<?php
	$sp_qry=mysql_query("SELECT * FROM service_routes WHERE SR_status=1 group by SR_source");
	 
	while($row=mysql_fetch_object($sp_qry)){
	?>
	<option value="<?php echo $row->SR_source; ?>"><?php echo get_city_name($row->SR_source); ?></option>
	<?php } ?>
	</select>
	</td>
  	<td width="51%">To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<span id="get_destination">
	<select name="ter_to" id="ter_to" >
	<option value="none">--Select To--</option>	
	</select>
	</span>
	<span id="loading"></span>
	</td>
  </tr>
  
	 <tr>
  	<td> &nbsp;Journey Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" name="date" id="date" readonly class="textbox" value="Select Date" onFocus="hide_value();" onBlur="show_value();" /><input type="hidden" name="date_from" id="date_from" /></td>
  	<td> <span id="returnshow" style="display:none;"> Return Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" name="date1" id="date1" readonly class="textbox" value="Select Date" onFocus="hide_value();" onBlur="show_value();" /><input type="hidden" name="date_to" id="date_to" /></span>
	</td>
  </tr>
	<tr>
	
	<td colspan="2" style="padding-left:250px;">
	
	<input type="hidden" name="servicee" id="servicee" value="<?php echo $_SESSION['SP_id']; ?>">
	<span id="round_sub"><input type='submit' value='Search' name="search" id="search"  ></span>
	</td>
	</tr>
	
</table>
</form>
	<!--<div id="loading"></div>
	 <div id="container">
	  <div class="data" id="gan"></div>	
	 </div>
	 <div class="pagination"></div>-->
</fieldset>
	 
</body>


<?php

include "includes/footer.php";
?>