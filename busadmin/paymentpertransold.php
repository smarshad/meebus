<?php include "includes/header.php"; ?>
<script src="../js/pagination.js" type="text/javascript"></script>
<body onLoad="collectionpertrans();">
<fieldset class="table-bor">
<legend><strong>Payment Details of <?php echo get_SP_name($_REQUEST['sp_id']); ?></strong></legend>
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

<!--<input type="text" size="90" class="textbox2" id="search_str" name="search_str" onKeyUp="searchcollection();" />
<input type="text" name="date" id="date" onChange="searchcollection()">
<input type="hidden" name="sp_id" id="sp_id" value="<?php echo $sp_id; ?>"  />-->

<table width="100%" cellpadding="3" cellspacing="10">
	<tr>
	    <td align="center"><font size="2"><strong>Service Provider Name :</strong> <?php echo ucfirst(get_SP_name($_REQUEST['sp_id'])); ?></font></td>
		<td align="center"><input type="hidden" name="sp_id" id="sp_id" value="<?php echo $_REQUEST['sp_id']; ?>" />
        <input type="hidden" name="b_id" id="b_id" value="<?php echo $_REQUEST['b_id']; ?>" /></td>	    
    </tr>
</table>

<table width="100%">
	<tr>		
		<td>			
		 <input type="hidden" size="90" class="textbox2" id="search_str" name="search_str" onKeyUp="collectionpertrans();" />		
	   </td>
	  
	 
	  <td><strong></strong> </td>
		<td><input type="hidden" name="date" id="date" value="<?php echo changedateformat($_REQUEST['dat']); ?>" onChange="collectionpertrans();" />
		</td>	
	</tr>
</table>
<hr />
	<div id="loading"></div>
	<div id="container">
	  <div class="data"></div>	
	</div>	
</fieldset>
<?php include "includes/footer.php"; ?>
</body>