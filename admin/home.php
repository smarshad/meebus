<?php include_once("includes/header.php");
//Checking For seat availability
 $ress=mysql_query("select * from bookinginfo where pay_status=3");
 while($del=mysql_fetch_array($ress))
 {
$value = strtotime($del['book_time'])."<br>";
 $cur_time=time()."<br>"; 
$time_diff=($cur_time-$value)."<br>"; 
$minutes = floor($time_diff % 3600 / 60);
if($minutes>25)
{
mysql_query("delete from bookinginfo where auto_id='$del[auto_id]'");
}
 }
 ?>
<script src="../js/pagination.js" type="text/javascript"></script>
<style type="text/css">

/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */

a.ovalbutton{
background: transparent url('oval-blue-left.gif') no-repeat top left;
display: block;
float: left;
font: normal 13px Tahoma; /* Change 13px as desired */
line-height: 16px; /* This value + 4px + 4px (top and bottom padding of SPAN) must equal height of button background (default is 24px) */
height: 24px; /* Height of button background height */
padding-left: 11px; /* Width of left menu image */
text-decoration: none;
}

a:link.ovalbutton, a:visited.ovalbutton, a:active.ovalbutton{
color: #494949; /*button text color*/
}

a.ovalbutton span{
background: transparent url('oval-blue-right.gif') no-repeat top right;
display: block;
padding: 4px 11px 4px 0; /*Set 11px below to match value of 'padding-left' value above*/
}

a.ovalbutton:hover{ /* Hover state CSS */
background-position: bottom left;
}

a.ovalbutton:hover span{ /* Hover state CSS */
background-position: bottom right;
color: black;
}

.buttonwrapper{ /* Container you can use to surround a CSS button to clear float */
overflow: hidden; /*See: http://www.quirksmode.org/css/clearing.html */
width: 100%;
}

</style>
<body onLoad="search_SP();">
<fieldset class="table-bor">
		<legend><strong>Ticket  Statistics</strong></legend> 		
			
			<table width="100%">
			<tr>
			<td colspan="5" style="font-weight:bold;">Number of Tickets Sold</td>
			
			</tr>
			<?php 
		           $dat1=date("Y-m-d");
					 $dat2=strtotime($dat1);
					 $dat3 = strtotime("-7 day", $dat2);
					 $dat4=date("Y-m-d",$dat3);
				     $dat5 = strtotime("-30 days", $dat2);
					$dat6=date("Y-m-d",$dat5); 
					  $dat7 = strtotime("-365 days", $dat2);
					$dat8=date("Y-m-d",$dat7); 
			$sql1="SELECT * FROM bookinginfo WHERE cancelledStatus = 0 and pay_status='1' and booked_date='$dat1'";
			$sql2="SELECT * FROM bookinginfo WHERE cancelledStatus = 0 and pay_status='1' and (booked_date between '$dat4' and '$dat1')";
			$sql3="SELECT * FROM bookinginfo WHERE cancelledStatus = 0 and pay_status='1' and (booked_date between '$dat6' and '$dat1')";
			$sql4="SELECT * FROM bookinginfo WHERE cancelledStatus = 0 and pay_status='1' and (booked_date between '$dat8' and '$dat1')";
			$count1=mysql_num_rows(mysql_query($sql1)); 
			$count2=mysql_num_rows(mysql_query($sql2)); 
			$count3=mysql_num_rows(mysql_query($sql3)); 
			$count4=mysql_num_rows(mysql_query($sql3)); 
			
			?>
			<tr>
			
			<td width="8%">&nbsp;</td>
			<td width="16%">Today </td>
			<td width="4%">:</td>
			<td width="59%"><?php echo $count1; ?></td>
			<td width="13%">&nbsp;</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			
			<td>Month </td>
			<td>:</td>
			<td><?php echo $count3; ?></td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			
			<td>Year </td>
			<td>:</td>
			<td><?php echo $count4; ?></td>
			<td>&nbsp;</td>
			</tr>
			
			</table>
			<hr />
			<table width="100%">
			<tr>
			<td colspan="5" style="font-weight:bold;">
			Individual service providers ticket sold count</td>
			</tr>
			<?php
			$ser="select * from serviceprovider_info "; 
			$ser_qry=mysql_query($ser);
			$i=1;
			while($ser_row=mysql_fetch_array($ser_qry))
			{
			$sp=mysql_fetch_array(mysql_query("SELECT * FROM bookinginfo WHERE cancelledStatus = 0 and pay_status='1' and SP_id='$ser_row[SP_id]'"));
			$sp_count=mysql_num_rows(mysql_query("SELECT * FROM bookinginfo WHERE cancelledStatus = 0 and pay_status='1' and SP_id='$ser_row[SP_id]'"));
			 ?>
			<tr>
			<td width="8%">&nbsp;</td>
			<td width="16%"><?php echo $ser_row['SP_name']; ?> </td>
			<td width="4%">:</td>
			<td width="64%"><?php echo $sp_count; ?></td>
			<td width="8%">&nbsp;</td>
			</tr>
			<?php } ?>
			
	</table>
	<hr />
	<table>
	<tr>
	<td colspan="5" style="font-weight:bold;">
	Bar Graph between Ticket sale and Agencies
	</td>
	</tr>
	
	<tr>
	<td colspan="5">
	<?php include("bar_chart.php"); ?>
	</td>
	</tr>
	
	
	
	</table>
			
	<hr />
	<table>
	<tr>
	<td colspan="5" style="font-weight:bold;">
	Ticket Sale Graph of bus
	</td>
	</tr>
	
	<tr>
	<td colspan="5">
	<?php include("graph_chart.php"); ?>
	</td>
	</tr>
	
	
	
	</table>		
			
        </div>
		<br />
		</fieldset>
</body>
<?php include "includes/footer.php"; ?>