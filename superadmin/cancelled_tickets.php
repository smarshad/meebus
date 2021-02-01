<?php include_once("includes/header.php"); ?>
<script src="../js/pagination.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
		
function fn_hide()
{
	if($("#datepicker1").val() == "Click here")
	{
		$("#datepicker1").val('');
	}
	
	if($("#datepicker2").val() == "Click here")
	{
		$("#datepicker2").val('');
	}
}
				
function fn_show_value()
{
	if($("#datepicker1").val() == "")
	{
		$("#datepicker1").val('Click here');
	}

	if($("#datepicker2").val() == "")
	{
		$("#datepicker2").val('Click here');
	}	
}

	$(function() {
	var dateFormat;
	try{
    dateFormat= $( ".selector" ).datepicker( "option", "dateFormat" );
	}
	catch(e){ }
	//minDate: +0, 
	//showOn: 'button',
		$('#datepicker1').datepicker({ 		
			numberOfMonths: 1, 
			showButtonPanel: false, 			
			maxDate: '+3M +0D', 			 
			buttonImage: '../images/calendar_icon.gif', 
			buttonImageOnly: true, 
		    dateFormat: 'dd-mm-yy'			
		});	
		
		$('#datepicker2').datepicker({ 		
			numberOfMonths: 1, 
			showButtonPanel: false, 			
			maxDate: '+3M +0D', 			 
			buttonImage: '../images/calendar_icon.gif', 
			buttonImageOnly: true, 
		    dateFormat: 'dd-mm-yy'			
		});
	});
</script>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />

<body onLoad="search_cancelTickets();">
<fieldset class="table-bor">
		<legend><strong>Cancelled Tickets Management</strong></legend> 
		
		<table width="100%" border="0" cellspacing="2" cellpadding="5">
		  <?php if(isset($_REQUEST['successproc'])) { ?>
		<tr><td colspan="4">&nbsp;</td></tr>
			<tr><td colspan="4" style="color:#006633;" align="center"><strong>Refund Status has been Changed Successfully</strong></td></tr>
		
		<?php } ?>
		  
		  <tr>
			<td width="17%">Provider Name</td>
			<td width="35%">
			<input type="text" size="50" class="textbox2" onKeyUp="search_cancelTickets();" id="provider_search" /> <br>
			</td>							
			<td width="16%" align="center"> Ticket No </td>
			<td width="22%">
				<input type="text" id="ticket" name="ticket" class="textbox"  onKeyUp="search_cancelTickets();"/>
			</td>		
		  </tr>		
			<tr>		
			<td width="17%"> Cancel Date </td>			
			<td>			
				<input type="text" id="datepicker1" name="datepicker1"  style="cursor:pointer;" class="textbox" onKeyUp="search_cancelTickets();" onChange="search_cancelTickets();" /> <a href="javascript:void(0)" onClick="document.getElementById('datepicker1').value='';search_cancelTickets();"><u>Clear</u></a>				
			</td>
				
			<td width="18%" align="center"> Travel Date </td>
			<td>
			    <input type="text" id="datepicker2" name="datepicker2"  style="cursor:pointer;" class="textbox" onKeyUp="search_cancelTickets();" onChange="search_cancelTickets();" /> <a href="javascript:void(0)" onClick="document.getElementById('datepicker2').value='';search_cancelTickets();"><u>Clear</u></a>
			</td>
			
		  </tr>		    
			  
		</table>
		
		<hr/>
		
		<table>
			<tr>
				<td>
					<label id='errmsg' class="errmsg"></label>
					<label id='response' class="errmsg"></label>
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

<?php include "includes/footer.php"; ?>