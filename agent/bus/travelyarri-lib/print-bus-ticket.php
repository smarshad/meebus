<?php error_reporting(E_NOTICE^E_ALL);
ob_start();
session_start();
require_once("../database/connect.php");
$sql=mysql_query("select * from book_bus_tickets where bookingId='$_GET[pnr]'");
$result=mysql_fetch_array($sql);
if(!$qry1=mysql_query('SELECT * FROM stations ORDER BY station_name')) exit(mysql_error());

while($res1=mysql_fetch_array($qry1)) {

	$c=$res1['station_id'];

	$station_name[$c]=$res1['station_name'];

	unset($c);	

}
?>

<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td></td><td align="center" class="bl_13b" colspan="3"  style="border-bottom:1px solid #ccc; padding-bottom:5px;">Bus E-Ticket</td></tr>
<tr><td width="13">&nbsp;</td>
    <td width="142" ><img src="<?php $url="../images/logo.jpg"; if(file_exists($url)){ echo $url;}else{ echo "../".$url; }?>" width="220" height="120"  /></td>
   
    <td width="609"><table width="100%" border="0">
      <tr>
        <th width="57%" scope="col">&nbsp;</th>
        <th width="22%" scope="col" align="right"><span id="bookid" style="text-align:center; float:left;">Booking PNR : </span></th>
        <th width="24%" scope="col"><span style="text-align:center; float:left; margin-left:10px;"><?php echo $result[RBTicketNo]; ?></span></th>
      </tr>
      <tr>
        <th scope="row">&nbsp;</th>
        <td align="right"><span id="bookid" style="text-align:center; float:left; ">Booking Id :</span></td>
        <td><span style="text-align:center; float:left; margin-left:10px;"><?php echo $_GET[pnr]; ?></span></td>
      </tr>
      <tr>
        <th scope="row">&nbsp;</th>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
	<td width="13">&nbsp;</td>
</tr>
<tr><td><div class="spacer1"></div></td></tr>

<tr>
<td>&nbsp;</td>
<td colspan="3" style=" padding:0px 0px 0px 10px">
    <table width="100%" border="1" bordercolor="#CCCCCC" style="border:1px solid #B2B2B2; border-collapse:collapse;"cellspacing="0" cellpadding="5">
    <tr>
        <td colspan="4" align="center" class="bl_13b" bgcolor="#e1f3fb">Passenger Information</td>
        </tr>
    <tr>
        <td width="25%" align="center" class="departing" style="text-align:center" >Seat</td><td width="25%" align="center" class="departing">Passenger Name</td>
        <td width="25%" align="center" class="departing" style="text-align:center">Age</td><td width="25%" align="center" class="departing">Sex</td>
    </tr>
	<tr>
	  <td style="text-align:center"><?php 
          //$name = explode("|A|", $result[passenger_name]);
          //$age = explode("|A|", $result[passenger_age]);
          //$sex = explode("|A|", $result[passenger_sex]);
	   for($i=1;  $i < count($seat); $i++ )
	   {  
		   echo $seat[$i].","; 
	   }?></td>
	<td style="text-align:center"> <?php echo $name[$i-1]; ?></td><td style="text-align:center"><?php echo $age[$i-1] ?></td> <td style="text-align:center"><?php echo  $sex[$i-1] ?></td></tr>
  </table></td></tr>
<tr><td><div class="spacer1"></div></td></tr>

<tr>
<td>&nbsp;</td>
<td colspan="3" style=" padding:0px 0px 0px 10px">
    <table width="100%" border="1" bordercolor="#CCCCCC" style="border:1px solid #B2B2B2; border-collapse:collapse;"cellspacing="0" cellpadding="5">
    <tr>
        <td width="25%" class="ac_det"><span  id="from" style="text-align:right;float:right">From:</span></td>
        <td width="25%" class="normal" style="text-align:center"><?php echo $station_name[$result[fromStationId]]; ?></td>
        <td width="25%" class="ac_det"><span id="to" style="text-align:right;float:right">To:</span></td>
        <td width="25%" class="normal" style="text-align:center"><?php echo $station_name[$result[toStationId]]; ?></td>
    </tr>
    <tr>
        <td class="ac_det" ><span  id="bus_type" style="text-align:right;float:right">Travels:</span></td>
        <td class="normal" style="text-align:center;"><b><?php echo $result[bus_provider]; ?></b></td>
        <td class="ac_det"  > <span  id="bus_type" style="text-align:right;float:right">Bus Type:</span></td>
        <td class="normal" style="text-align:center"><?php echo $result[bus_type] ; ?></td>
    </tr>
    <tr>
        <td class="ac_det">Total Fare:</td>
        <td class="normal" colspan="3" style="text-align:left"><?php echo $result[total_fare]; ?>&nbsp;INR</td>
    </tr>
  </table></td></tr>
<tr><td><div class="spacer1"></div></td></tr>
<tr><td>&nbsp;</td>
<td colspan="3" style="padding:0px 0px 0px 10px;">
    <table width="100%" border="1" bordercolor="#CCCCCC" style="border:1px solid #B2B2B2; border-collapse:collapse;" cellspacing="0" cellpadding="5">
    <tr>
        <td colspan="2" class="ac_det">
        <span style="float:left">Boarding Address :</span> &nbsp;<?php echo wordwrap($result['BPAddress'],50);  ?><br />
        <span style="float:left">Landmark:</span><?php echo $result['BPLandmark'];?><br />
        <span style="float:left">Boarding time</span><?php echo $result['BPTime']; ?></td>
        <td width="48%" class="normal">Travel Related Contacts: <?php echo $result[mobileNbr]; ?></td>
    </tr>
    <tr>
        <td width="17%" class="ac_det">Journey Date :</td>
        <td width="35%" class="normal"><?php echo date('d-M-Y',strtotime($result[travelDate])); ?></td>
    </tr>
    <tr><td class="ac_det">Boarding Point :</td>
    <td colspan="2" class="normal"><?php echo $result[BPName]; ?></td></tr>
  </table></td></tr>
<tr><td><div class="spacer1"></div></td></tr>
<tr><td>&nbsp;</td><td colspan="3" style="border-bottom:1px solid #ccc;"><p style="font-weight:bold; font-size:12px; font-family:Verdana, Geneva, sans-serif">Terms and conditions </p>
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td width="2%" valign="top"><br />
          1. </td>
        <td width="46%" valign="top" style="font-size:12px"><p>Bagyourseat is    ONLY a bus ticket agent. It does not operate bus services of its own. In    order to provide a comprehensive choice of bus operators, departure times and    prices to customers, it has tied up with many bus operators.<br />
          Bagyourseat advice to customers is to choose bus operators they are aware of and    whose service they are comfortable with.<br /> <br />
          <strong>Bagyourseat&nbsp;responsibilities include: </strong></p>
          <p>(1)    Issuing a valid ticket (a ticket that will be accepted by the bus operator)    for its' &nbsp;network of bus operators <br />
            (2)    Providing refund and support in the event of cancellation <br />
            (3)    Providing customer support and information in case of any delays /    inconvenience </p>
<p><strong>Bagyourseat    &nbsp;responsibilities do NOT include: </strong></p>
<p><strong>  </strong>(1)    The bus operator's bus not departing / reaching on time <br />
  (2)    The bus operator's employees being rude <br />
  (3)    The bus operator's bus seats etc not being up to the customer's expectation <br />
  (4)    The bus operator canceling the trip due to unavoidable reasons <br />
  (5)    The baggage of the customer getting lost / stolen / damaged <br />
  (6)    The bus operator changing a customer's seat at the last minute to accommodate    a lady / child <br />
  (7)    The customer waiting at the wrong boarding point (please call the bus    operator to find out the exact boarding point if you are not a regular traveler    on that particular bus) <br />
  (8)    The bus operator changing the boarding point and/or using a pick-up vehicle    at the boarding point to take customers to the bus departure point </p></td>
        <td width="52%" valign="top"><div align="right">
          <table border="0" cellspacing="0" cellpadding="0" width="94%" style="font-size:12px; font-family:Verdana, Geneva, sans-serif">
            <tr >
              <td width="6%" valign="top">
                2.              </td>
              <td>The departure time mentioned on the ticket are only      tentative timings. However the bus will not leave the source before the      time that is mentioned on the ticket. </td>
            </tr>
            <tr>
              <td width="6%" valign="top">3. </td>
              <td>Passengers are required to furnish the following at      the time of boarding the bus:<br />
                  (1) A copy of the ticket (A print out of the ticket or the print out of the      ticket e-mail). <br />
                  (2) A valid identity proof <br />
                  Failing to do so, they may not be allowed to board the bus. </td>
            </tr>
            <tr>
              <td width="6%" valign="top">4. </td>
              <td>Change of bus: In case the bus operator changes the      type of bus due to some reason, Bagyourseat will refund the differential amount      to the customer upon being intimated by the customers in 24 hours of the      journey. </td>
            </tr>
            <tr>
              <td width="6%" valign="top">6. </td>
              <td>In case one needs the refund to be credited back to      his/her bank account, please write your cash coupon details to info@bagyourseat.com       The home delivery charges (if any), will not be refunded in the event of      ticket cancellation </td>
            </tr>
            <tr>
              <td width="6%" valign="top">7. </td>
              <td>In case a booking confirmation e-mail and sms gets      delayed or fails because of technical reasons or as a result of incorrect      e-mail ID / phone number provided by the user etc, a ticket will be      considered 'booked' as long as the ticket shows up on the confirmation page      of www.Bagyourseat.com </td>
            </tr>
          </table>
        </div>
          <p align="right"> </p></td>
      </tr>
  </table></td></tr>

<tr>
<tr><td>&nbsp;</td><td colspan="3" style="border-bottom:1px solid #ccc;"></td></tr>
<td>&nbsp;</td>
<td colspan="3" align="center"><div id="printOption" align="center">
<a href="javascript:void();" onclick="document.getElementById('printOption').style.visibility = 'hidden'; print(); return true;" class="farebreakup">Print</a>
</div></td>
</tr>
<tr><td>&nbsp;</td><td colspan="3" style="border-bottom:1px solid #ccc;"></td></tr>
<tr><td>&nbsp;</td><td colspan="3" style="border-bottom:1px solid #ccc;"></td></tr>
</table>
