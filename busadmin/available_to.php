<?php
include "includes/header.php";

if(isset($_REQUEST['bus_id']) && isset($_REQUEST['dat1'])){
   $SP_id=mysql_real_escape_string($_REQUEST['sp_id']);
   $Bus_id=mysql_real_escape_string($_REQUEST['bus_id']);
   $dat=mysql_real_escape_string($_REQUEST['dat1']);
   $_SESSION['action']=0;
   ?>
<script type="text/javascript">
function seat_check(val,val1,val2,val3,val4)
{
/*alert(val);
alert(val1);
alert(val2);*/

var jdate=val4+"-"+val3+"-"+val2;

var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var arr=xmlhttp.responseText;
	var data=arr.split("#");
	document.getElementById("err_seat").innerHTML=data[0];
	document.getElementById("err_seat1").innerHTML=data[1];
    }
  }
xmlhttp.open("GET","seatcheck.php?seat="+val+"&busid="+val1+"&dat="+jdate,true);
xmlhttp.send();
}
</script>
<script type="text/javascript">
var tot = 0;
function seat_display(val)
{   
	
	seat_no = "seat_"+val;
	var s_no = document.getElementById(seat_no).value;
	
	var fare = parseInt(document.getElementById('bus_fare').value);

	if(document.getElementById(seat_no).checked) {
	
	document.getElementById('total_seats').value += s_no+",";
	
	tot=tot+fare; 
	
	}
	else
	{
		tot=tot-fare;
		
		var arr = document.getElementById('total_seats').value;
		
		var seatno = arr.split(",");
		
		for( var i=0; i<seatno.length; i++ )
		{
			if(seatno[i] == s_no )
			
				seatno.splice(i,1);
		
		}
		
		document.getElementById('total_seats').value = seatno;
		
		if(tot < 0){
		 tot=0; }
		 
	}
	
	document.getElementById('total_amt').value = "Rs. "+tot;

}

</script>


<fieldset class="table-bor">
		<legend><strong>Available Seats</strong></legend> 
		<div align="center" id="err_seat"></div>
<form name="form" action="booking_round.php" method="post">
				<table cellpadding="1" cellspacing="5" border="0" width="100%" >
				<tr><td colspan="2">&nbsp; </td></tr>
				<tr><td colspan="2">
					<?php 
						$query = mysql_fetch_array(mysql_query("SELECT * FROM businfo WHERE Bus_id= $Bus_id AND Bus_status=1"));						
						$fcity_id = $query['Bus_fromcity'];
							$fcity = get_city_name($fcity_id);
							$tcity_id = $query['Bus_tocity'];
						$tcity = get_city_name($tcity_id);
						
						 $ftcity = ucfirst($fcity)." - ".ucfirst($tcity);
						 
						 $boarding_point = explode(",",$query['Bus_boarding_time']);
						// print_r($boarding_point);
										
					 ?>
											 
				<table width="100%" border="0" cellpadding="2" cellspacing="5">
				<tr>
						<td><strong>Service Provider :</strong> <?php echo get_SP_name($query['SP_id']); ?></td>
						<td><strong>From - To City :</strong> <?php echo $ftcity ; ?> </td>
					</tr>
					<tr>
						<td><strong>Bus Fare :</strong> Rs. <?php echo $query['Bus_fare'] ; ?> </td>
						<td><strong>Bus Type :</strong> <?php echo get_bus_type($query['Bus_type']); ?> </td>
						<td><strong>Travelling Date:</strong> <?php echo changedateformat($dat); ?></td>
					</tr>
				</table>
				</td></tr>
				<tr><td colspan="2">&nbsp; </td></tr>
				<tr><td colspan="2">
				<table width="99%" border="0" cellpadding="2" cellspacing="3" style="border:1px #666666 solid;">
			
						<tr>
							<td valign="top" width="35"><img src="../images/stearing.gif" alt="bus" title="bus" border="0" /></td>
							<td valign="top">
							<input type="hidden" name="bus_id" id="bus_id" value="<?php echo $Bus_id ?>" />
							<input type="hidden" name="travel_date" id="travel_date" value="<?php echo $dat; ?>" />
							<input type="hidden" name="travv_date" id="travv_date" value="<?php echo $dat1; ?>" />
							<input type="hidden" name="sp_id" id="sp_id" value="<?php echo $query['SP_id']; ?>" />
							<input type="hidden" name="triptype" id="triptype" value="<?php echo $query['triptype']; ?>" />
								<table cellpadding="3" cellspacing="5" border="0" width="100%" bgcolor="#FFFFFF" id="chk_seats" >
									<tbody bgcolor="#D4DDEE" style="text-align:center;" class="normal" >
									<?php 
									$booked_seat = get_booked_seat($Bus_id,$dat);									
									$sdate=explode("-",$dat);
									$day=$sdate[2];
									$mon=$sdate[1];
									$year=$sdate[0];
										 $r=0;
										 for($i=1;$i<=5;$i++){
										 echo "<tr>";
										 for($j=1;$j<=10;$j++){
											$r=$r+1;
											$sel = mysql_query("select seat_no from bus_structure where bus_id = $Bus_id and position = $r ");
			$row=mysql_fetch_array($sel);
			  
									?>
									
									<td width="8%" <?php if($row['seat_no']=="xx") { ?> bgcolor="#FFFFFF" <?php } ?>>
									<input type="hidden" name="bus_fare" id="bus_fare" value="<?php echo $query['Bus_fare']; ?>">										
									 <?php if($row['seat_no']!="xx") { echo $row['seat_no']."<br>"; } else { echo "&nbsp;&nbsp;<br>"; }
									if(count($booked_seat) > 0){
									 if(!in_array($row['seat_no'],$booked_seat)) {  if($row['seat_no']!="xx")
			   { ?>									
									<input type="checkbox" name="<?php echo "seat_".$row['seat_no']; ?>" id="<?php echo "seat_".$row['seat_no']; ?>"  value="<?php echo $row['seat_no']; ?>" onclick="seat_display(this.value);" /><?php } } 
									else {
									      $gender=getPsr_Gender($Bus_id,$dat,$row['seat_no']);
									}
									?>
									</td>
									<?php
											}
											else
											{
											  if($row['seat_no']!="xx")
			                                  {
									 ?>
									 <input type="checkbox" name="<?php echo "seat_".$row['seat_no']; ?>" id="<?php echo "seat_".$row['seat_no']; ?>"  value="<?php echo $row['seat_no']; ?>" onclick="seat_display(this.value);" />
									 <?php
									       
									 		}
											}
											
											}
										echo "</tr>";
										}							
									?>				
									</tbody>
								</table>							
							</td>
						</tr></table></td></tr>
						
						<tr><td colspan="2">&nbsp;</td></tr>
						
						<tr>
						<td style="padding-left:50px;">Select Seats : <input type="text" id="total_seats" name="total_seats" value="" readonly /></td>
						<td>Total Amount :<input type="text" id="total_amt" name="total_amt" value="Rs.0" readonly /></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
						<td colspan="2" align="center"> 
							<select name="boading_point" id="boading_point">
							<option value="all">-- Boarding Point --</option>
							<?php for($b=0; $b<count($boarding_point); $b++){ ?>	
							<option value="<?php echo $boarding_point[$b]; ?>"><?php echo $boarding_point[$b]; ?></option>
							<?php } ?>	
							</select>						
						</td>
						</tr>
					<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
						<td colspan="2" align="center">
						<input type="hidden" name="round" id="round" value="2" />
						<!--<a href="bookingmgnt.php">--><input type="button" id="back" name="back" value=" Back " onclick="window.location.href='bookingmgnt.php'" /><!--</a>-->
						<span id="err_seat1"></span>							
						</td>
						</tr>
					</table>
					</form>
   <?php
  }
   else
  {
  	header("Locaion: bookingmgnt.php");
  }
  ?>
  </fieldset>
  
  <?php
include "includes/footer.php"; ?>
