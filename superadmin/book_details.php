<?php include_once("includes/header.php"); ?>
<script src="../js/pagination.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
		
function fn_hide()
{
	if($("#datepicker1").val() == "Click here")
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

	$(function() {
	var dateFormat;
	try{
    dateFormat= $( ".selector" ).datepicker( "option", "dateFormat" );
	}
	catch(e){ }
	//minDate: +0, 
	//showOn: 'button',
		$('#datepicker').datepicker({ 		
			numberOfMonths: 1, 
			showButtonPanel: false, 			
			maxDate: '+3M +0D', 			 
			buttonImage: '../images/calendar_icon.gif', 
			buttonImageOnly: true, 
		    dateFormat: 'dd-mm-yy'			
		});	
	});
	
	
function clear_text()
{
	document.getElementById('datepicker').value="";
	search_Psr();
}
	
	
</script>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />

<body onLoad="search_bkr();">
<fieldset class="table-bor">
		<legend><strong>Booking Details</strong></legend> 
		
		<table width="100%" border="0" cellspacing="2" cellpadding="5">
		  <tr>
			<td width="17%">Provider Name</td>
			<td width="35%">
			<input type="text" size="50" class="textbox2" onKeyUp="search_bkr();" id="usr_search" /> <br>
			</td>							
			<td width="16%" align="center"> Ticket No </td>
			<td width="22%">
				<input type="text" id="ticket" name="ticket" class="textbox"  onKeyUp="search_bkr();"/>
			</td>		
		  </tr>		
			<tr>		
			<td width="17%"> Travel Date </td>			
			<td>			
				<input type="text" id="datepicker" name="datepicker"  style="cursor:pointer;" class="textbox" onKeyUp="search_bkr();" onChange="search_bkr();" /> <a href="javascript:void(0)" onClick="return search_bkr();"><u>Clear</u></a>				
			</td>
				
			<td width="18%" align="center"> User Type </td>
			<td>
			    <select name="usr_type" id="usr_type" onChange="search_bkr();" class="combobox-small" style="width:150px;">
				<option value="0">All</option>				
				<?php  					
					$sql = mysql_query("select * from usertypes where usertype_id not in(1,2)") ;					
					while($getrow = mysql_fetch_array($sql))
					{
				?>
				<option value="<?php echo $getrow[0]; ?>"><?php echo $getrow[1] ; ?> </option>
				<?php } ?>				
				</select>
			</td>
			
		  </tr>		  
		    <tr>			
			<td width="17%"> From City </td>			
			<td>							
				<select name="frmcity" id="frmcity" onChange="search_bkr();" class="combobox-small" style="width:150px;">
				<option value="0">All</option>				
				<?php  					
					$sql = mysql_query("select * from cities where del_status!=0") ;					
					while($getrow = mysql_fetch_array($sql))
					{
				?>
				<option value="<?php echo $getrow[0]; ?>"><?php echo $getrow[1] ; ?> </option>
				<?php } ?>				
				</select>				
			</td>
						
				
			<td width="18%" align="center"> To City </td>
			<td>
			    <select name="tocity" id="tocity" onChange="search_bkr();" class="combobox-small" style="width:150px;">
				<option value="0">All</option>
				
				<?php  					
					$sql = mysql_query("select * from cities where del_status!=0");
					
					while($getrow = mysql_fetch_array($sql))
					{
				?>
				<option value="<?php echo $getrow[0]; ?>"><?php echo $getrow[1] ; ?> </option>
				<?php } ?>				
				</select>
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