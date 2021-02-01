<?php include "includes/header.php"; ?>
<script src="../js/pagination.js" type="text/javascript"></script>
<!-- date & Time picker -->

<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-timepicker-addon.min.js"></script>	
	<script type="text/javascript" src="js/timepicker.js"></script>

<script type="text/javascript">
	$(function() {
	var dateFormat;
	try{
    dateFormat= $( ".selector" ).datepicker( "option", "dateFormat" );
	}
	catch(e){ }
	
		$('#date1').datepicker({ 		
			numberOfMonths: 1, 
			showButtonPanel: false, 
			//minDate: +0, 
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

<body onLoad="searchBlockseats_new('all');">
<fieldset class="table-bor">
<legend><strong>Block / Unblock Seats Management</strong></legend>

<form onSubmit="return searchBlockseats_new('all');">

<!-- <table width="50" border="0" cellspacing="5" cellpadding="5" align="center">
  <tr>
    <td>
	<select name="sp_list" id="sp_list" onChange="getbuslist_fromProviser(this.value);">
	<option value="all">--Select Service Provider--</option>
	<?php
	$sp_qry=mysql_query("SELECT * FROM serviceprovider_info ORDER BY SP_name ASC");
	while($row=mysql_fetch_object($sp_qry)){
	?>
	<option value="<?php echo $row->SP_id; ?>"><?php echo $row->SP_name; ?></option>
	<?php } ?>
	</select>
	</td>
    <td>
	<div id="bus_show">
	<select name="bus_list" id="bus_list" onChange="searchBlockseats_new();">
	<option value="all">--Select Bus Name--</option>
	<?php
	$bus_query=mysql_query("SELECT * FROM businfo ORDER BY Bus_name ASC");
	while($bus=mysql_fetch_object($bus_query)){
	?>
	<option value="<?php echo $bus->Bus_id; ?>"><?php echo $bus->Bus_name; ?></option>
	<?php } ?>
	</select>
	</div>
	</td>
	<td>
	<input type="text" name="date" id="date" class="textbox" value="Select Date" onFocus="hide_value();" onBlur="show_value();" onChange="searchBlockseats_new();" />
	</td>
	<td>
	<input type="reset" value="Reset All" onClick="searchBlockseats_new();">
	</td>
  </tr>
</table> -->
<center>
<table align="center">
	<tr>
		<td width="70">&nbsp;</td>
		<td width="665" align="center"> 
		
			<input type="hidden" id="sp_list" name="sp_list" value="1">
			
			<input type="hidden" id="bus_list" name="bus_list" value="1">
					
			</td>
		<td width="70">Choose Date: <input type="text" id="date1" name="date1" value="<?php echo date("d-m-Y"); ?>" onChange="searchBlockseats_new('all')" ></td>
	</tr>
	
</table>
</center>
</form>

<hr/>

<br>

	<div id="loading"></div>
	 <div id="container">
	  <div class="data" id="gan"></div>	
	 </div>
	 <div class="pagination"></div>
</fieldset>
<script type="text/javascript">
function blockseats(spid,busid,dat){
document.blckseats.sp_id.value=spid;
document.blckseats.bus_id.value=busid;
document.blckseats.dat.value=dat;
document.blckseats.submit();
}
</script>
<form name="blckseats" id="blckseats" action="block_seats.php" method="post">
<input type="hidden" name="sp_id" id="sp_id" value="">
<input type="hidden" name="bus_id" id="bus_id" value="">
<input type="hidden" name="dat" id="dat" value="">
</form>
</body>
<?php include "includes/footer.php"; ?>