<?php
include "includes/header.php";
if(isset($_REQUEST['bus_id']) && isset($_REQUEST['travel_date'])){
   $SP_id=mysql_real_escape_string($_REQUEST['sp_id']);
   $Bus_id=mysql_real_escape_string($_REQUEST['bus_id']);
   $dat=mysql_real_escape_string($_REQUEST['travel_date']);
	 $trip=mysql_real_escape_string($_REQUEST['trip']);
   
   if(isset($_REQUEST['book']))
   { 
   		    $spid = get_SP_name($SP_id);
			//$sp_name = strtoupper(substr($spid,0,3));			
			//$ticket_id = date("ymd").$sp_name.rand();
			
			///// Generate Ticket Number
			      $time = mktime();
                  $ticket = '';
                  for ($x=3;$x<10;$x++) {
                  $ticket .= substr($time,$x,1);
                  }
	              $ticket_id = date("y").date("m").date("d").strtoupper(substr($spid,0,3)).$ticket;
			///// End 			
			

						
/*if(mail($email,$subject,$msg,$headers))
{						
	
}
else
{
	
	header("Location: booker_details.php?bus_id=$Bus_id&travel_date=$dat");
}*/


			
	
   		
   }
   else{
   
   ?>
   
<script type="text/javascript">
function discountcheck(val,val1,val2,val3,val4)
{
/*alert(val);
alert(val1);
alert(val2);
alert(val3);*/
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
    document.getElementById("discount_res").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","calculate.php?code="+val+"&spid="+val1+"&busid="+val2+"&fare="+val3+"&dat="+val4,true);
xmlhttp.send();
}
</script>

<script>
function checkcode(val,val1,val2,val3)
{
/*alert(val);
alert(val1);
alert(val2);*/
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
    document.getElementById("check_res").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","checkcode.php?code="+val+"&spid="+val1+"&busid="+val2+"&dat="+val3,true);
xmlhttp.send();
}
</script>	

<script type="text/javascript">

function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
            }
         return true;
      }
</script>


<fieldset class="table-bor">
		<legend><strong> Booker Details </strong></legend> 
<form name="form" action="inter.php" method="post">
				<table cellpadding="1" cellspacing="5" border="0" width="100%" >
				<tr><td colspan="2">&nbsp; </td></tr>
				<tr><td colspan="2">
					<?php 
						$query = mysql_fetch_array(mysql_query("SELECT * FROM businfo where Bus_id= $Bus_id "));
						$fcity_id = $query['Bus_fromcity'];
							$fcity = get_city_name($fcity_id);
							$tcity_id = $query['Bus_tocity'];
						$tcity = get_city_name($tcity_id);
						
						 $ftcity = ucfirst($fcity)." - ".ucfirst($tcity);
						 
						 $boarding_point = explode(",",$query['Bus_boarding_time']);
						// print_r($boarding_point);
						
						$tot_seat = substr($_REQUEST['total_seats'],0,-1);
						$total_seats = explode(",",$tot_seat); 
						
						//print_r($total_seats);
					     $count = count($total_seats); 
						 
						 $tott_fare=($count*$query['Bus_fare']);
										
					 ?>
											 
				<table width="100%" border="0" cellpadding="2" cellspacing="5">
				<tr>
						<td><strong>Service Provider :</strong> <?php echo get_SP_name($query['SP_id']); ?></td>
						<td><strong>From - To City :</strong> <?php echo $ftcity ; ?> </td>
					</tr>
					<tr>
						<td><strong>Bus Fare :</strong> Rs. <?php echo $query['Bus_fare'] ; ?> </td>
						<td><strong>Travelling Date:</strong> <?php echo changedateformat($dat); ?></td>
					</tr>
					<tr>
						<td><strong>Total Fare :</strong> Rs. <?php echo $tott_fare; ?>  </td>
						<td><strong>Total Member :</strong> <?php echo $count; ?>  </td>
					</tr>
				</table>
				</td></tr>
				
				
				
				<tr><td colspan="2">&nbsp; </td></tr>
				
				
				<tr><td colspan="2">
				<table width="99%" border="0" cellpadding="2" cellspacing="3" style="border:1px #666666 solid;">
				<tr><td colspan="5"><strong>Do you have discount coupons?</strong></td></tr>
				<tr><td colspan="5">&nbsp;</td></tr>
				
				<tr>
				<td width="40%" style="padding-left:30px;">Enter Promotional code for discounts </td><td width="3%">:</td>
				<td width="57%">
				<input type="text" name="promo_code" id="promo_code" style="width:200px; height:25px; " onblur="checkcode(this.value,'<?php echo $SP_id; ?>','<?php echo $Bus_id; ?>','<?php echo $dat; ?>')" value="<?php echo $_REQUEST['promo_code']; ?>"  /> 
				
				<a href="javascript:void(0)" onclick="discountcheck(form.promo_code.value,'<?php echo $SP_id; ?>','<?php echo $Bus_id; ?>','<?php echo $tott_fare; ?>','<?php echo $dat; ?>');"> <input type="button" id="discount" name="discount" value=" Calculate Discount " /></a>
				</td>
				</tr>
				<tr><td colspan="2">&nbsp;</td><td><div id="check_res"></div></td></tr>
				<tr>
				<td colspan="3" style="padding-left:30px;">
				<span id="discount_res"></span>
				</td>
				</tr>
				<tr><td colspan="3">&nbsp;</td></tr>
				</table>
				</td>
				</tr>
				
				<tr><td colspan="2">&nbsp; </td></tr>	
				
				
				
				<tr><td colspan="2">
				<table width="99%" border="0" cellpadding="2" cellspacing="3" style="border:1px #666666 solid;">
				 <tr><td colspan="5"><strong>Passenger Details</strong></td></tr>
				 <tr><td colspan="5">&nbsp;</td></tr>
				 
					<tr>
						<th align="center">S.No</th>
						<th align="center">Seat No</th>
						<th align="center">Passenger Name</th>
						<th align="center">Gender</th>
						<th align="center">Age</th>
						
					</tr>
					<?php 
						$tot_seat = substr($_REQUEST['total_seats'],0,-1);
						$total_seats = explode(",",$tot_seat); 
						
						//print_r($total_seats);
					     $count = count($total_seats); 
					?>	
				<input type="hidden" name="trip" id="trip" value="<?php echo $trip; ?> " >
				<input type="hidden" name="tot_seat" id="tot_seat" value="<?php echo $tot_seat; ?> " >
				<input type="hidden" name="seat_count" id="seat_count" value="<?php echo $count; ?> " >
				<input type="hidden" name="total_amt" id="total_amt" value="<?php echo $_REQUEST['total_amt']; ?> " >
				<input type="hidden" name="boading_point" id="boading_point" value="<?php echo $_REQUEST['boading_point']; ?>" >
				<input type="hidden" name="bus_fare" id="bus_fare" value="<?php echo $query['Bus_fare']; ?> " >
				<input type="hidden" name="bus_type" id="bus_type" value="<?php echo get_bus_type($query['Bus_type']); ?>" />
				<input type="hidden" name="from_city" id="from_city" value="<?php echo $fcity_id; ?> " >
				<input type="hidden" name="to_city" id="to_city" value="<?php echo $tcity_id; ?>" />
				<input type="hidden" name="bus_id" id="bus_id" value="<?php echo $Bus_id; ?> " >
				<input type="hidden" name="travel_date" id="travel_date" value="<?php echo $dat; ?>" />
				<input type="hidden" name="sp_id" id="sp_id" value="<?php echo $query['SP_id']; ?>" />
					
					<?php $j=1;
						for($i=0; $i<$count; $i++)
						{
					?>
					<tr>
						<td align="center"><?php echo $j; ?></td>
						<td align="center"><?php echo $total_seats[$i]; ?>
						<input type="hidden" name="seatno_<?php echo $j; ?>" id="seatno_<?php echo $j; ?>" value="<?php echo $total_seats[$i]; ?>">
						</td>
						<td align="center"><input type="text" name="passname_<?php echo $j; ?>" id="passname_<?php echo $j; ?>" ></td>
						<td align="center"><input type="radio" name="gender_<?php echo $j; ?>" id="gender_<?php echo $j; ?>" value="M" checked="checked"> Male
						<input type="radio" name="gender_<?php echo $j; ?>" id="gender_<?php echo $j; ?>" value="F"> Female
						</td>
						<td align="center"><input type="text" name="age_<?php echo $j; ?>" id="age_<?php echo $j; ?>" size="5" maxlength="2" onkeypress="return isNumberKey(event);"></td>
					</tr>	
					<?php		
							$j++;
						}
					?>
					
					
				<tr><td colspan="5">&nbsp;</td></tr>
				</table></td></tr>
					<tr><td colspan="2">&nbsp;</td></tr>	
						<tr><td colspan="2">
				<table width="99%" border="0" cellpadding="2" cellspacing="3" style="border:1px #666666 solid; padding-left:30px;">
				 <tr><td colspan="2"><strong>Booker Details</strong></td></tr>
				 <tr><td colspan="2">&nbsp;</td></tr>
				 
					<tr>
						<td width="25%">Booker Name <font color="#FF0000">*</font></td><td width="3%">:</td>
						<td><input type="text" name="booker_name" id="booker_name" value=""></td>
					</tr>
					<tr>
						<td  width="25%">Email ID <font color="#FF0000">*</font></td><td width="3%">:</td>
						<td><input type="text" name="email" id="email" value=""></td>
					</tr>
					<tr>
						<td  width="25%">Address 1 <font color="#FF0000">*</font></td><td width="3%">:</td>
						<td><input type="text" name="address1" id="address1" value=""></td>
					</tr>
					<tr>
						<td  width="25%">Address 2 </td><td width="3%">:</td>
						<td><input type="text" name="address2" id="address2" value=""></td>
					</tr>
					<tr>
						<td width="25%">Mobile / Phone No <font color="#FF0000">*</font></td><td width="3%">:</td>
						<td><input type="text" name="mobile" id="mobile" value="" maxlength="10" onkeypress="return isNumberKey(event);"></td>
					</tr><input type="hidden" name="payment" id="payment" value="0" />
					<!--<tr>
						<td width="25%">Payment Type <font color="#FF0000">*</font></td><td width="3%">:</td>
						<td>-->
						
						<!--<select name="payment" id="payment">
							<option value="">- Select Payment Type -</option>
							<option value="paypal">PayPal</option>	
						</select>-->
						
						<!--<table border="0" cellspacing="0" cellpadding="5">
						<tr>
						<td>
						<input type="radio" name="payment" id="payment" value="1" />&nbsp;
                        <img src="../images/my.gif" border="0" alt="Through Credit Cards" title="Credit Cards" /></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
						<td><input type="radio" name="payment" id="payment" checked="checked" value="2" />&nbsp;<img src="../images/paypal_tiny.gif" border="0" alt="Paypal" title="Paypal" /></td>						
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
						<td><input type="radio" name="payment" id="payment" value="3" />&nbsp;<img src="../images/net-banking.gif" border="0" alt="Net Banking" title="Net Banking" /></td>
						</tr>
						</table>-->						
						<!--</td>
					</tr>-->
					
					
				<tr><td colspan="5">&nbsp;</td></tr>
				</table></td></tr>
						
						
						<tr><td colspan="2">&nbsp;</td></tr>
						
						
						<tr>
						<td colspan="2" align="center">
						<!--<a href="available_seat.php?bus_id=<?php echo $Bus_id; ?>&dat=<?php echo $dat; ?>"><input type="button" id="back" name="back" value=" Back " /></a>-->
						<input type="button" value="Back" onclick="funbck()" />
						<input type="submit" id="book" name="book" value=" Book " onclick="return validate_booker(this.form);" />						
						</td>
						</tr>
					</table>
					</form>
					<script type="text/javascript">
					function funbck(){
					document.bck_frm.submit();
					}
					</script>
					<form name="bck_frm" id="bck_frm" method="post" action="available_seat.php">
					<input type="hidden" id="bus_id" name="bus_id" value="<?php echo $Bus_id; ?>" />
					<input type="hidden" id="dat" name="dat" value="<?php echo $dat; ?>"
					</form>
   <?php
   }
  }
   else
  {
  	header("Locaion: bookingmgnt.php");
  }
  ?>
  </fieldset>
  
  <?php
include "includes/footer.php"; ?>
