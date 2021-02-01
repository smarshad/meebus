<?php include_once("includes/header.php"); ?>
<script type="text/javascript">
function printthis()
{
 var w = window.open('', '', 'width=800,height=600,resizeable,scrollbars');
 w.document.write($("#table1").html());
 w.document.close(); // needed for chrome and safari
 javascript:w.print();
 w.close();
 return false;
}
</script>
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
		
		<table width="100%" border="1" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="13" align="left"><strong>API Booking Info</strong></td>
    </tr>
  <tr>
    <td align="center"><strong>S No</strong></td>
    <td align="center"><strong>Agent / User</strong></td>
    <td align="center"><strong>Ticket Number</strong></td>
    <td align="center"><strong>Travels</strong></td>

    <td align="center"><strong>Booker Name</strong></td>
    <td align="center"><strong>Mobile</strong></td>
    <td align="center"><strong>Travel Date</strong></td>
    <td align="center"><strong>From</strong></td>
    <td align="center"><strong>To</strong></td>
    <td align="center"><strong>Fare</strong></td>
    <td align="center"><strong>No of Seat</strong></td>
    <td align="center"><strong>Seat No</strong></td>
  </tr>
  <?php 
  echo $selectAPIBooking = "SELECT * FROM book_bus_tickets WHERE status='BOOKED' ORDER BY id DESC";
   $queryAPIBooking = mysql_query($selectAPIBooking);
   $numRows = mysql_num_rows($queryAPIBooking);
   if($numRows>0) { 
   $i=1;
   while($apibookingData = mysql_fetch_object($queryAPIBooking)) { 
   ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php if($apibookingData->agent_id == 0) { echo 'User'; } else { echo 'Agent'; } ?></td>
    <td><?php echo $apibookingData->tiket_no; ?></td>
    <td><?php $busDatas =  explode('|A|',$apibookingData->bus_provider); echo $busDatas[0].'<br/>'.$busDatas[1].'<br/>';  ?></td>
    
    <td><?php echo $apibookingData->lead_pax_name; ?></td>
    <td><?php echo $apibookingData->mobileNbr; ?></td>
    <td><?php echo $apibookingData->travelDate; ?></td>
    <td><?php echo $apibookingData->fromStationName; ?></td>
    <td><?php echo $apibookingData->toStationName; ?></td>
    <td><?php echo $apibookingData->total_fare; ?></td>
    <td><?php $seatcount =  explode('|A|',$apibookingData->passenger_seat); echo count($seatcount); ?></td>
    <td><?php echo str_replace('|A|',',',$apibookingData->passenger_seat); ?></td>
  </tr>
  <?php $i++; } }  else { ?>
  <tr>
    <td height="50" colspan="13" align="center"><strong>No Record Found</strong></td>
    </tr>
    <?php } ?>
  
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