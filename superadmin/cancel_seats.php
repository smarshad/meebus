<?php
//error_reporting(0);
	include_once("includes/header.php");	
	$ticket_no=$_REQUEST['ticket_no'];
	$dat=$_REQUEST['dat'];
	$fromcity= $_REQUEST['fromcity'];
	$tocity=$_REQUEST['tocity'];
	$SP_id=$_REQUEST['SP_id'];
	
	if(isset($_REQUEST['submit']))
	{ 
	//print_r($_REQUEST);
	 $n = explode(",",substr($_REQUEST['seatno'],0,-1));
	//print_r($n); 
	//echo count($n);
		for($j=0; $j<count($n); $j++)
		 {
		    $seat_no = $n[$j];
			 $stno = "seatno_".$seat_no; 
			echo $_REQUEST[$stno]; 
		   if(isset($_REQUEST[$stno]))
			{
			  //echo "UPDATE bookinginfo SET cancelledStatus = 1 WHERE SeatNo=".$_REQUEST[$stno]." and Ticket_ID = ".$_REQUEST['ticket_id'];
			
				$qry=mysql_query("DELETE from bookinginfo  WHERE SeatNo='".$_REQUEST[$stno]."' and Ticket_ID = '".$_REQUEST['ticket_id']."' ");
				
				mysql_query("DELETE from  passengerinfo  WHERE passenger_seatNo='".$_REQUEST[$stno]."' and Ticket_ID = '".$_REQUEST['ticket_id']."' ");
				
				if($qry)
				{
					header("Location:cancel_seats.php?ticket_no=$ticket_no&dat=$dat&fromcity=$fromcity&tocity=$tocity&SP_id=$SP_id&suc");
				}
				
				
			}
	   		else
			{
			//echo "UPDATE bookinginfo SET cancelledStatus = 0 WHERE SeatNo=".$seat_no." and Ticket_ID = ".$_REQUEST['ticket_id'];
		
				
					header("Location:cancel_seats.php?ticket_no=$ticket_no&dat=$dat&fromcity=$fromcity&tocity=$tocity&SP_id=$SP_id&succ");
				
			}
		}
	}
	
		
	if(isset($_REQUEST['proceed']))
{
	$_REQUEST['ticketid'];
	$_REQUEST['sp_id'];
	
$proceedsuc=mysql_query("update cancelled_tickets set cancelled_status='2' where Ticket_id='$_REQUEST[ticketid]' and SP_id='$_REQUEST[sp_id]'");
if($proceedsuc)
{
	header("location:cancelled_tickets.php?sp_id=$_REQUEST[sp_id]&successproc");
}
	
}
?>
<script src="../js/pagination.js" type="text/javascript"></script>

<script type="text/javascript" language="javascript">

		
function fn_hide()
{
	if($("#datepicker").val() == "Click here")
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

	$(function() 
	{
		$('#datepicker').datepicker({numberOfMonths: 1, showButtonPanel: false});
	});
	
</script>

<body>
<fieldset class="table-bor">
		<legend><strong>View Seats</strong></legend> 
	
		
		<table width="100%" border="0" cellspacing="2" cellpadding="5">
		
		
		<!--<tr><td colspan="4">[ Note: <span class="suc_msg">Available Tickets</span> &nbsp; <span class="err_msg">Journey Date Expired Tickets</span>]
		</td></tr>-->
		<tr><td colspan="4">&nbsp;</td></tr>
		
		<?php if(isset($_REQUEST['suc'])) { ?>
		<tr><td colspan="4">&nbsp;</td></tr>
			<tr><td colspan="4" style="color:#006633;" align="center"><strong>Ticket has been Canceled Succesfully</strong></td></tr>
		
		<?php } else if(isset($_REQUEST['succ'])) { ?>
		<tr><td colspan="4">&nbsp;</td></tr>
			<tr><td colspan="4" style="color:#006633;" align="center"><strong>Ticket has not been cancelled </strong> </td></tr>
			
		<?php } ?>
			<tr>
			<th width="10%" align="center">Ticket No :</th>
			<th width="35%">
			<?php echo $_REQUEST['ticket_no']; ?> <br>
			</th>
			
							
			<th width="10%" align="center" nowrap="nowrap"> Travel Date : </th>
			<th width="22%" nowrap="nowrap">
				<?php echo $_REQUEST['dat']; ?>
			</th>
			
		  </tr>
		  <tr>
		  <th nowrap="nowrap">Cancelled Date:</th>
		  <th nowrap="nowrap">
		  <?php 
		  $ti=$_REQUEST['ticket_no'];
		  $sql=mysql_fetch_array(mysql_query("SELECT * FROM cancelled_tickets WHERE Ticket_id='".$ti."' GROUP BY SeatNo"));
		  echo $sql['cancelled_date'];
		  ?>
		  </th>
		  </tr>
		  <tr><td colspan="4">&nbsp;</td></tr>
		  
		 <tr>
		 	<td colspan="4">
				<table width="100%" border="0" cellpadding="3" cellspacing="5">
				
				<form name="form" action="" method="post">
				<tr>
					<td>&nbsp;</td>
					<td> <strong>Service Provider</strong> </td>
					<td> <strong>From - To City</strong> </td>
					<td> <strong>Seat No</strong> </th>
					<td> <strong>Passenger Name</strong> </td>
					<td> <strong>Gender</strong> </td>
					<td> <strong>Age</strong> </td>
				</tr>
				
		<?php 
		$frm = $_REQUEST['fromcity'] ;
		
		$scount12 = mysql_fetch_array(mysql_query("select * from cities where id = '$frm'"));
		
		$fcity = ucwords($scount12['city_name']) ;
		
		$to = $_REQUEST['tocity'] ;
		
		$scount13 = mysql_fetch_array(mysql_query("select * from cities where id = '$to'"));
		
		$tcity = ucwords($scount13['city_name']) ;
				
			$frmtocity = $fcity." - ".$tcity;	
				  
					$ticket = $_REQUEST['ticket_no'];
					$i = 1;
					//$qry = passenger_info($ticket);
					$qry=mysql_query("SELECT * FROM passengerinfo, cancelled_tickets WHERE passengerinfo.Ticket_ID = '".$ticket."' AND cancelled_tickets.Ticket_id =  '".$ticket."' AND passengerinfo.passenger_seatNo =  cancelled_tickets.SeatNo");
					$num = mysql_num_rows($qry);
					while($row = mysql_fetch_array($qry))
					{  
					 $qry1=mysql_fetch_array(mysql_query("SELECT * FROM cancelled_tickets WHERE SeatNo = '".$row['passenger_seatNo']."' and Ticket_ID = '".$ticket."'"));
					
				?>
				<input type="hidden" name="passenger_id" id="passenger_id" value="<?php echo $row['passenger_ID']; ?>" >
				<input type="hidden" name="ticket_id" id="ticket_id" value="<?php echo $row['Ticket_ID']; ?>" >
				<input type="hidden" name="count" id="count" value="<?php echo $num; ?>" >
				<tr>
					<td>&nbsp;</td>
					<td> <?php echo get_SP_name($_REQUEST['SP_id']); ?> </td>
					<td> <?php echo $frmtocity; ?> </td>
					<td> <?php echo $row['passenger_seatNo']; ?> </td>
					<td> <?php echo $row['passenger_Name']; ?> </td>
					<td> <?php echo $row['passenger_Gender']; ?> </td>
					<td> <?php echo $row['passenger_Age']; ?> </td>
				</tr>
				<?php
				 $s_no.=$row['passenger_seatNo'].",";
				 $i++; } ?>
				<input type="hidden" name="seatno" id="seatno" value="<?php echo $s_no; ?>" >
				<tr><td colspan="5" align="center">
				<?php if($proc==1) { ?>
				<!--<input type="button" name="submit" id="submit" value=" Cancel " onClick="alert('This is Demo version !!!');">-->
				<input type="button" name="submit" id="submit" value=" Cancel ">
				<?php } else{ echo "&nbsp;"; } ?>
								
				<?php if($qry1['cancelled_status'] != '2') { ?>
			<a href="cancel_seats.php?proceed&ticketid=<?php echo $ticket; ?>&sp_id=<?php echo $_REQUEST['SP_id']; ?>" class="ovalbutton"><span><strong>Refund</strong></span></a><?php } ?><input type="button" name="back" id="back" value=" Back " onClick="window.location.href='cancelled_tickets.php'">
				</td>
				</tr>
				</form>
				</table>
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
<?php include("includes/footer.php"); ?>
<SCRIPT language="javascript">
$(function(){ 
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () { 
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});
</SCRIPT>
