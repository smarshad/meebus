<?php include "includes/header.php"; 	
	$arr = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');		
?>

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
	if($("#date1").val() == "Select Date"){
		$("#date1").val('');
	}
}
				
function show_value(){
	if($("#date1").val() == ""){
		$("#date1").val('Select Date');
	}
}

</script>
<!-- // date & Time picker -->

<body onLoad="searchBlockseats_new('all');">
<fieldset class="table-bor">
<legend><strong>Block / Unblock Seats Management</strong></legend>

<form onSubmit="return searchBlockseats_new('all');">
<table align="center">
	<tr>
		<td width="70">&nbsp;</td>
		<td width="665" align="center"> 
		
			<input type="hidden" id="sp_list" name="sp_list" value="1">
			
			<input type="hidden" id="bus_list" name="bus_list" value="1">
			
			<!--<input type="hidden" id="date" name="date" value="0000-00-00">-->		
			
			<?php 							
				foreach ($arr as $value) 
				{					
					?>
					<span onclick=searchBlockseats_new('<?php echo $value; ?>'); style='cursor:pointer;'><?php echo $value; ?></span>&nbsp;&nbsp;
			<?php 	} 	?>			</td>
		<td width="70"><fieldset class="table-bor"><legend>Choose Date</legend>
		   <input type="text" id="date1" name="date1" value="<?php echo date("d-m-Y"); ?>" onChange="searchBlockseats_new('all')"/>
		</fieldset></td>
	</tr>
</table>

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