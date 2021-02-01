<?php
include "includes/header.php";
//$dat = date("Y-m-d");
//$sql="SELECT * FROM bookinginfo where travelling_date = '".$dat."' ORDER BY SP_id";
?>
<script src="../js/pagination.js" type="text/javascript"></script>
<body onLoad="searchcollection();">
<fieldset class="table-bor">
<legend><strong>Payment Booked Details</strong></legend>
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
		$('#date').datepicker({ 		
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
</script>
<!-- // date & Time picker -->
<table width="100%" cellpadding="3" cellspacing="10">
	<tr>		
		<td>			
			Service Provider : <select name="search_str" id="search_str" onChange="searchcollection();" class="combobox-small">
				<option value="">All</option>
				
				<?php  					
					$sql = mysql_query("select * from serviceprovider_info where SP_status='1' order by SP_name asc") ;
					
					while($getrow = mysql_fetch_array($sql))
					{
				?>
				<option value="<?php echo $getrow['SP_id']; ?>"><?php echo $getrow['SP_name'] ; ?> </option>
				<?php } ?>				
				</select>
				
	  </td>
	  <td></td>
	</tr>
	
	<tr>
	<td><input type="hidden" name="sp_id" id="sp_id" value="<?php echo $sp_id; ?>"  /></td>
	</tr>
</table>

<?php 
if(isset($_REQUEST['paysuccess'])) { 
?>
<div align="center" style="color:#339933; font-weight:bold;"> Your Transaction is Successfull !!!</div>
<?php } else if(isset($_REQUEST['pay_err'])){ ?>
<div align="center" style="color:#FF0000; font-weight:bold;"> Your Transaction is Failed !!! </div>
<?php } else if(isset($_REQUEST['pay_cancel'])){ ?>
<div align="center" style="color:#FF0000; font-weight:bold;"> Your Transaction is Cancelled !!! </div>

<?php } else if(isset($_REQUEST['send'])){ ?>
<div align="center" style="color:#339933; font-weight:bold;"> Sent Bank details to service provider successfully !!! </div>
<?php } ?>

	<div id="loading"></div>
	 <div id="container">
	  <div class="data" id="gan"></div>	
	 </div>	
<!--</div>-->
</fieldset>
<?php
include "includes/footer.php";
?>
</body>