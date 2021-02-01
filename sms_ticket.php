<?php  include_once("header.php"); 

if(isset($_REQUEST['txttick'])) {
	
	$txttick=$_REQUEST['txttick'];
	$txtmobile=$_REQUEST['txtmobile'];
	
	$transsel=mysql_query("SELECT bus_id,Service_provider_id,pay_email,pay_status FROM payment_transaction WHERE ticket_id='$txttick'");
	
	if(mysql_num_rows($transsel)<=0) {
		header("Location:ticket_status.php?noticket");exit;
	}
	
	$transaction=mysql_fetch_array($transsel);
	//echo $transaction['pay_status'];exit;
	if($transaction['pay_status']!='1') {
		header("Location:ticket_status.php?nopayment");exit;
	}
	
	$busdetail=mysql_fetch_array(mysql_query("SELECT * FROM businfo WHERE Bus_id='$transaction[bus_id]'"));
	
	$msg.="Ticket Id : $txttick\n";
	$msg.="$busdetail[Bus_name]\n";
	$msg.="$busdetail[Bus_boarding_time]\n";
	$msg.="Seat NO: ";
	
	$tick=mysql_query("SELECT SeatNo,userid FROM bookinginfo WHERE Ticket_ID='$txttick'");
	$seatnos='';
	$userid='';
	while($tickrow=mysql_fetch_array($tick)) {
		$seatnos.=($seatnos=='') ? $tickrow['SeatNo'] : ", ".$tickrow['SeatNo'];
		if($userid=='')
		$userid=$tickrow['userid'];
	}
	
	$msg.="$seatnos";
	
	$provider=mysql_fetch_array(mysql_query("SELECT * FROM serviceprovider_info WHERE SP_id='$busdetail[SP_id]'"));
	
	//echo $msg." <br> ".$transaction['Service_provider_id']." - ".$transaction['pay_email'];	exit;
	
	$providername=substr($provider['SP_name'],0,8);
	
	$smsticket = sendsms($txtmobile,$msg,$providername);
	
	//echo $smsticket;exit;
	
	if($smsticket=='') {
		$msgstatus="Page error";
		$smsstatus=2;
	} elseif($smsticket=='nocredit') {
		$msgstatus="No sms balance";
		$smsstatus=2;
	} elseif($smsticket<0) {
		$msgstatus="Number error";
		$smsstatus=2;
	} elseif(strlen($smsticket)>15) {
		$msgstatus="progress";	
		$smsstatus=0;
	} else {
		$msgstatus="failed";
		$smsstatus=2;
	}
	
	//echo "<br>".$msgstatus."<br>";
	//echo $txttick."<br>".$txtmobile."<br>".$smsticket."<br>";
	
	$userdetails=mysql_fetch_array(mysql_query("SELECT user_mobileno FROM users WHERE user_id='$userid'"));
	
	if($userdetails['user_mobileno']==$txtmobile) {
		$usertype=1;
	} else {
		$usertype=0;
	}
	
	$smsinsert=mysql_query("INSERT INTO smslog (sms_spid, smsbus_id, sms_usertype, sms_userid, sms_mailid, sms_ticket, sms_purpose, sms_from, sms_to, sms_date, datetime, sms_trans_no, sms_status, status) VALUES ('$busdetail[SP_id]', '$transaction[bus_id]', '$usertype', '$userid', '$transaction[pay_email]', '$txttick', 'Send ticket', '$providername', '$txtmobile', NOW(), NOW(), '$smsticket', '$msgstatus', '$smsstatus')");
	
	$msgstatus=base64_encode($msgstatus);
	
	if($smsstatus==0) {
		header("Location:ticket_status.php?smssuccess");
	} else {
		header("Location:ticket_status.php?failed=$msgstatus");
	}
}

?>

<style>
.button
{
	width:auto;
	float:left;
	margin-left:100px;
}
.left-btn
{
	width:10px;
	height:22px;
	float:left;
	background:url(images/a.jpg) no-repeat;
}
.mid-btn 
{
	width:auto;
	height:22px;
	float:left;
	background:#CF000B;
	
	font-size:12px;
	color:#FFFFFF;
	
	font-weight:bold;
}
.mid-btn a
{
	
	font-size:12px;
	color:#FFFFFF;
	font-weight:bold;
	text-decoration:none;
}
.mid-btn a:hover
{
	color:#ffffff;
}
.right-btn
{
	width:10px;
	height:22px;
	float:left;
	background:url(images/c.jpg) no-repeat;
}
.inner-content input[type="text"] {
    width: 300px;
}
</style>
<script>

function sms_ticket()
{
if(document.getElementById('txtmobile').value=="")
{
alert("Enter the Mobile Number");
document.getElementById('txtmobile').focus();
return false;
}

}

function submitform() {
	
	if(document.getElementById('txttick').value=='') {
		alert("Without ticket id we cant send sms");
		document.getElementById('txttick').focus();
		return false;
	}
	
	if(document.getElementById('txtmobile').value=='') {
		alert("Please enter your mobile number");
		document.getElementById('txtmobile').focus();
		return false;
	}
	
	document.smsticket.submit();
}

</script>

<div class="inner-content">

<div class="box_head_blue">SMS Ticket</div>

<form name="smsticket" action="" method="post">
		  <table border="0" align="center" cellpadding="2" cellspacing="2">
		  <tr>
		  <td colspan="4" align="center"><div id="errmsg" class="err_msg"></div></td>
		  <!--<td>&nbsp;</td><td nowrap="nowrap"></td>-->
		  </tr>
		  <tr>
		  <td>&nbsp;</td><td>&nbsp;</td>
		  </tr>
            <tr>
              <td nowrap="nowrap"><strong><font size="2">Enter Ticket Number</font></strong>&nbsp;<span class="err_msg" style="font-size:16px; font-weight:bold;">*</span>&nbsp;</td>
              <td nowrap="nowrap"><input name="txttick" type="text" id="txttick" size="30" value="<?php echo $_REQUEST['ticket']; ?>" readonly /></td>
            </tr>
			<tr><td>&nbsp;</td></tr>
			<?php if(!isset($_SESSION['user_id'])){ ?>			
			<tr>
			<td nowrap="nowrap">
			<strong><font size="2"> Mobile Number</font></strong>&nbsp;<span class="err_msg" style="font-size:16px; font-weight:bold;">*</span>
			&nbsp;	</td>
			
			
			<td nowrap="nowrap">
			
            <input name="txtmobile" type="text" id="txtmobile" size="30" onBlur="return sms_ticket();" value="<?php echo $usrdata['user_mobileno']; ?>" /><br />
            <span style="font-size:10px;">
            Note : Enter number format only with out + symbol <br />eg..8801616752
            </span>
            </td>
			</tr>
			<?php }
			      else{
			 ?>	
			 <input name="txtmobile" type="hidden" id="txtmobile" size="30" value="<?php echo $usrdata['user_mobileno']; ?>" />
			 <?php } ?>
			<tr><td>&nbsp;</td></tr>	
            <tr>
			<td>
			<?php if(isset($_POST['t_id'])){ ?>
			<div class="button">
				<div class="left-btn"><!-- left curve --></div>
				<div class="mid-btn"><a href="usr_tickets.php">Back</a></div>
				<div class="right-btn"><!-- right curve --> </div>
				</div>
			<?php } ?>	
			</td>
              <td nowrap="nowrap">
			    <div class="button">
				<div class="left-btn"><!-- left curve --></div>
				<div class="mid-btn"><a href="javascript:void()" onclick="return submitform();"> Send Sms</a></div>
				<div class="right-btn"><!-- right curve --> </div>
				</div>
              </td>
            </tr>
          </table>
          </form>

</div>

 <div id="disp_ticket"></div>
 <div id="hid_msg" style="display:none;"></div>


<?php
if(isset($_POST['t_id'])){
   ?>
   <script type="text/javascript">
   document.getElementById('txttick').value='<?php echo $_POST['t_id']; ?>';
   print_ticket();
   </script>
   <?php
}
?>
<?php  include_once("includes/footer.php"); ?>