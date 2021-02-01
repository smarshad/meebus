<?php
include_once '../../server/server.php';  
unset($_SESSION['FILL']['PASSENGER']);
unset($_SESSION['FILL']['AGE']);
unset($_SESSION['FILL']['GENDER']);
unset($_SESSION['FILL']['EMAIL']);
unset($_SESSION['FILL']['MOBILE']);
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
$_SESSION['common']['pagename'] = "Print"; 
include_once '../includes/functions.php';
include_once '../../sendsms.php';
$obj=new agent_module($con); 
$status='BOOKED';
$agent_id=$_SESSION['agent']['log']['id'];
$data=array($_GET['ticket'],$status,$agent_id);
$ticket=$obj->getTicket($data);
$tid = $ticket[0]['id'];
$data1 = array($tid,$agent_id);
$getAgentLog = $obj->getAgentlogoDet($data1);
//print_r($getAgentLog); exit;

$terms=$obj->getterms(array($agent_id));
$terms=$terms[0];

$infoCA='';
echo '<head>';
include_once '../includes/head.php';
echo '</head>';
include_once '../includes/top_menu.php';
?>
<script type="text/javascript">
function sendsms(tno)
{
	$.post("re_send_sms.php?tno="+tno, function(data){
	alert(data);
    });
}
function printDiv() {
	var printContents = document.getElementById('agentTicketPrint').innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
}
</script>
<div class="container-fluid">
<div class="row-fluid">
	<?php include '../includes/leftmenu.php' ?> 
<div id="content" class="span9">
    <div style="width: 800px; margin: 0px auto;">
    <img src="images/email.png" id="email" style="cursor:pointer; float:left;">
    <img src="../images/sms.png" width="40" onclick="return sendsms('<?php echo $_GET['ticket']; ?>');" style=" float:left; padding-left:350px; cursor:pointer;">
      <img src="images/printer.png" onclick="return printDiv();" style=" float:right; cursor:pointer;">
    </div>
</div>
<div class="span9" id="content">

  <div id='agentTicketPrint'>
<?php 

//echo "<pre>"; print_r($ticket); echo "</pre>"; exit;

if($ticket!=0)
{
foreach($ticket as $t)
{
	//echo "<pre>"; print_r($t); echo "</pre>";
	$cancel = $t['cancellationDescList'];
	$tin=$t['tiket_no']; 
	$pnr=$t['PNR']; 
	$fromStation=$t['fromStationId'];  
	$toStation=$t['toStationId'];  
	$DepartureTime=$t['DepartureTime']; 
	$ArrivalTime=$t['ArrivalTime']; 
	$emailId=$t['emailId'];
	$mobileNbr=$t['mobileNbr'];
	$serviceCharges = $t['serviceChargeValues'].'.00';
	
	$travelDate=$t['travelDate']; 
	if($t['id']>=4480)
	{
		$lead_pax_name=$t['lead_pax_name'];
		$busInfo=$t['bus_provider']; 
		$bus=explode('|A|',$busInfo); 
		$travelsName=$bus['0']; 
		if(isset($bus['1']))
		$busType=$bus['1']; 
		$boardingInfo=$t['boardingPointId'];
		$board=explode('-',$boardingInfo); 
		if(isset($board['1']))
		$boardingtime=$board['1']; 
		if(isset($board['0']))
		$boardingaddress=$board['0'];
		if(isset($board['0']))
		$boardingpoint=$board['0'];
		if(isset($board['4']) && $board['4']!=''){
		$boardingcontact="Contact No : ".$board['4']; } else { $boardingcontact=''; }
		
		if(isset($board['5']))
		$boardinglandmark=$board['5'];
		else 
		$boardinglandmark=$board['0'];
		
		
		if($boardingpoint==$boardinglandmark){ $boardinglandmark=''; }
		else { $boardinglandmark='<br/><b>Landmark : </b>'.$boardinglandmark; }
		
		$bookingDate1=explode(' ', $t['dateOfIssue']);
		$bookingDate=explode('-',$bookingDate1[0]);
		$bookingDate = $bookingDate[2].'/'.$bookingDate[1].'/'.$bookingDate[0];
		$oneway_fare=$t['oneway_fare']-$serviceCharges.'.00'; 
		$passenger=array(); 
		$passenger_name=$t['passenger_name'];
		$passenger_fare=explode('^',$t['passenger_fare']);		
		$passenger['name']=explode('|A|',$passenger_name);
		$passenger_age=$t['passenger_age'];
		$passenger['age']=explode('|A|',$passenger_age); 
		$passenger_seat=$t['passenger_seat']; 
		$passenger['seat']=explode('|A|',$passenger_seat); 
		$passenger_sex=$t['passenger_sex']; 
		$passenger['sex']=explode('|A|',$passenger_sex); 
		
		
		for($i=0; $i<count($passenger['name']); $i++)
		{
			if($passenger['name'][$i]!='')
			$passenger1['name'][]=$passenger['name'][$i];	
		}
		unset($passenger['name']);
		$passenger['name'] = $passenger1['name'];
		
		
		for($i=0; $i<count($passenger['age']); $i++)
		{
			if($passenger['age'][$i]!='')
			$passenger1['age'][]=$passenger['age'][$i];	
		}
		unset($passenger['age']);
		$passenger['age'] = $passenger1['age'];
		
		for($i=0; $i<count($passenger['seat']); $i++)
		{
			if($passenger['seat'][$i]!='')
			$passenger1['seat'][]=$passenger['seat'][$i];	
		}
		unset($passenger['seat']);
		$passenger['seat'] = $passenger1['seat'];
		
	}
	else
	{
		$travelsName=$t['bus_provider'];
		$busType=$t['bus_type'];
		$boardingtime=$t['BPTime'];
		$boardingaddress='';
		$boardingpoint=$t['boardingPointId'];
		if(isset($t['travelsPhoneNbr']) && $t['travelsPhoneNbr']!='') { $boardingcontact="Contact No : ".$t['travelsPhoneNbr'];
	} else { $boardingcontact =''; }
		$boardinglandmark=$t['BPLandmark'];
		
		if($boardingpoint==$boardinglandmark){ $boardinglandmark=''; }
		else { $boardinglandmark='<br/><b>Landmark : </b>'.$boardinglandmark; }
		$bookingDate=$t['booked_on'];
		$oneway_fare=$t['total_fare']-$serviceCharges.'.00';
		$passenger=array(); 
		$passenger_name=$t['passenger_name'];
		$passenger_fare=explode('^',$t['passenger_fare']);
		$p=explode('|A|',$passenger_name);
		foreach($p as $pass)
		{
			if($pass!='')
		$passenger['name'][]=$pass;
		}
		$lead_pax_name = $passenger['name'][0];
		$passenger_age=$t['passenger_age'];
		$p_age=explode('|A|',$passenger_age); 
		foreach($p_age as $pass)
		{
			$passenger['age'][]=$pass;
		}
		
		$passenger_seat=$t['passenger_seat']; 
		$p_seat=explode('|A|',$passenger_seat);
		foreach($p_seat as $pass)
		{
			if($pass!='')
			$passenger['seat'][]=$pass;
		}
		$passenger_sex=$t['passenger_sex']; 
		$p_sex=explode('|A|',$passenger_sex); 
		foreach($p_sex as $pass)
		{
			$passenger['sex'][]=$pass;
		}
		
	}
	$status=$t['status']; 
}


$netAmt = $oneway_fare+$serviceCharges;
$cnclDatas = '';
$cnclDatas.='<div style="background: #fff none repeat scroll 0 0; font-family: Verdana,Geneva,sans-serif; height: auto; margin: 0 auto; width: 100%;"><div style="color: #000; float: left; font-size: 15px; font-weight: bold; height:20px; line-height:10px; padding-left: 5px; width:99%;border-bottom: 1px solid #CCC;">Cancellation Policy</div><div style="width:100%; flot:left;"><div style="border-right: 1px solid #ccc; color: #000; float: left; font-size: 13px;    font-weight: bold; height: 30px;  line-height: 30px; padding-left: 5px; width:68%; flot:left;">Cancellation time</div><div style="float: left; font-size: 13px; font-weight: bold; height: 30px; line-height: 30px; padding-left: 5px; width:30%;  flot:left;">Cancellation Charges</div><div style="width:100%; float:left; height:auto;">';
                $h = 0;				
				$new11=array();
				 $cancel_pol=explode(';',$cancel);
				 
                foreach ($cancel_pol as $fd) {

                    if ($h <= count($cancel_pol)) {
						if($cancel_pol[$h]!='')
						{
                        $new11 = explode(':', $cancel_pol[$h]); 
							if ($new11[1] == -1) {
	
								$cnclDatas.='<div style="border-right: 1px solid #ccc; border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:68%;">';
								$cnclDatas.=$new11[0];
								$cnclDatas.=' hours before journey time</div><div style="border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height:30px; padding-left:5px; width:30%;">';
								$cnclDatas.=$new11[2];
								$cnclDatas.=' % &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;';
								$cnclDatas.=round($netAmt/100*$new11[2]);
								$cnclDatas.=' Rs  (Approximately) </div>';
							} else {
								$cnclDatas.='<div style=" border-right: 1px solid #ccc; border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:68%;" >Between ';
								if(isset($new11[1]))
								$cnclDatas.=$new11[1];
								$cnclDatas.=' hours and ';
								$cnclDatas.=$new11[0];
								$cnclDatas.=' hours before journey time</div><div style="border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:30%;">';
								if(isset($new11[2]))
								$cnclDatas.=$new11[2];
								$cnclDatas.=' % &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;';
								$cnclDatas.=round($netAmt/100*$new11[2]);
								$cnclDatas.=' Rs  (Approximately) </div>';
							}
						}
                    } $h++;
                } $cnclDatas.='</div></div></div>'; 

$ticket_html='<div id="agentTicketPrint"><div id="frame"><div style="font-family:Arial;font-size:12px;margin:0;padding:0;background-color:#ffffff;width:100%!important;line-height:140%"><table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:0;padding:0;background-color:#fafafa;height:100%;width:100%;border-collapse:collapse"><tbody><tr><td style="padding-top:10px"><table width="650" cellspacing="0" cellpadding="10" border="0" style="background-color:#ffffff;border-collapse:collapse;width:800px;margin:0px auto;border: 1px solid #000;"><tbody><tr style="border-bottom:solid black 3px"><td width="440" align="left" style="font-size:18px;width:440px;text-align:left">Ticket Booking - '.strtoupper($lead_pax_name).' ('.$mobileNbr.') '.$emailId.'</td><td width="197" align="center" style="text-align:center;width:197px"><img width="195px" height="60px" src="https://busraja.com/images/logo2.png" class="CToWUd"></td></tr><tr><td style="border-bottom:solid #b2b2b2 3px" colspan="2">Dear <span style="font-weight:bold">'.strtoupper($lead_pax_name).'</span><br>Your bus ticket has been successfully Booked. ( Ticket No: '.$tin.' )<br/>(PNR: '.$pnr.' )</td></tr><tr><td align="left" colspan="2" style="font-weight:bold;font-size:25px;padding-top:12px;text-align:center;border-bottom:solid #b2b2b2 3px">Booking Summary</td></tr><tr><td colspan="2" style="border-bottom:solid #b2b2b2 1px"><table width="630" cellspacing="0" cellpadding="0" style="border-collapse:collapse;width:770px"><tbody><tr><td width="320" style="font-weight:bold;font-size:22px;width:250px" rowspan="2">'.$obj->getStationName($fromStation).' to '.$obj->getStationName($toStation).'</td><td width="98" style="width:75px" rowspan="2"><span data-term="goog_352209185" class="aBn" tabindex="0"><span class="aQJ"></span></span></td><td width="200" align="right" style="width:200px"><table cellspacing="0" cellpadding="0" align="right" style="border-collapse:collapse;width:100%"><tbody><tr><td width="75" align="right" style="text-align:left">Ticket No:</td><td align="left" style="font-weight:bold"> '.$tin.'</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0px;border-bottom:solid #b2b2b2 1px"><table width="100%" cellspacing="0" cellpadding="0" style="width:100%;border-collapse:collapse"><tbody><tr><td align="center" style="font-size:14px;padding-top:0px;padding-bottom:12px;text-align:center" colspan="3">'.$travelsName.' <br />'.$busType.'</td></tr><tr><td width="44%" align="right" style="padding-top:0px;padding-bottom:6px;text-align:right;width:44%"><span style="font-size:16px">'.$obj->getStationName($fromStation).'</span>&nbsp;&nbsp;<span style="font-size:20px"><span data-term="goog_352209186" class="aBn" tabindex="0"><span class="aQJ">'.$DepartureTime.'</span></span></span></td><td width="12%" align="center" style="font-size:20px;padding-top:0px;padding-bottom:6px;text-align:center;width:12%">-</td><td width="44%" align="left" style="padding-top:0px;padding-bottom:6px;text-align:left;width:44%"><span style="font-size:16px">'.$obj->getStationName($toStation).'</span>&nbsp;&nbsp; <span style="font-size:20px"><span data-term="goog_352209187" class="aBn" tabindex="0"><span class="aQJ">'.$ArrivalTime.'</span></span></span></td></tr><tr><td align="right" style="font-size:14px;padding-top:0px;padding-bottom:12px;color:#5f5f5f;text-align:right"><span data-term="goog_352209188" class="aBn" tabindex="0"><span class="aQJ"></span></span></td><td align="center" style="font-size:12px;padding-top:0px;padding-bottom:12px;color:#5f5f5f;text-align:center"> </td><td align="left" style="font-size:14px;padding-top:0px;padding-bottom:12px;color:#5f5f5f;text-align:left"><span data-term="goog_352209189" class="aBn" tabindex="0"><span class="aQJ"></span></span></td></tr></tbody></table></td><td valign="top" align="center" style="border-left:solid #b2b2b2 1px;border-bottom:solid #b2b2b2 1px;text-align:center" rowspan="2"><table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:0;padding:0;background-color:#ffffff;border-collapse:collapse;width:100%"><tbody><tr><td width="60%" align="right" style="color:#5f5f5f;padding:15px 0 5px 0;text-align:center;border-bottom:solid #b2b2b2 1px;font-weight: bold;">Booking Date:</td><td width="40%" valign="middle" align="right" style="color:#5f5f5f;padding:15px 0 5px 0;text-align:center;border-bottom:solid #b2b2b2 1px"><strong>'.$bookingDate.'</strong></td></tr><tr><td width="60%" align="right" style="color:#5f5f5f;padding:15px 0 5px 0;text-align:center;border-bottom:solid #b2b2b2 1px;font-weight: bold;">Traveling Date:</td><td width="40%" valign="middle" align="right" style="color:#5f5f5f;padding:15px 0 5px 0;text-align:center;border-bottom:solid #b2b2b2 1px"><strong>'.$travelDate.'<strong></td></tr><tr><td align="center" colspan="2" style="font-size:16px;font-weight:bold;text-align:center">Booking Receipt</td></tr><tr><td width="60%" align="right" style="color:#5f5f5f;padding:15px 0 5px 0;text-align:right;">Net Fare:</td><td width="40%" valign="middle" align="right" style="color:#5f5f5f;padding:15px 0 5px 0;text-align:right;">'.round($netAmt).'.00</td></tr></tbody></table></td></tr><tr><td style="border-bottom:solid #b2b2b2 1px">
<span style="color:red">*</span>Boarding Point : <span>'.$boardingpoint.', <span>'.$boardinglandmark.'<b></b></span><br><span><b>'.$boardingtime.'</b></span>, <span><b>'.$boardingcontact.'</b></span> 

</td></tr><tr><td align="left" colspan="2" style="font-weight:bold;font-size:16px;padding-top:3px;text-align:left;border-bottom:solid #b2b2b2 1px">

<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:0;padding:0;background-color:#ffffff;border-collapse:collapse;width:100%;"><tbody><tr><td width="60%" height="30" colspan="7" align="center" style="text-align:center;width:40%;border-bottom:solid #b2b2b2 1px"> <span style="font-weight:bold">Passenger List</span></td></tr><tr><th align="center" style="">Name</th><th align="center" style="">Gender</th><th align="center" style="">Age</th><th align="center" style="">Seat No</th><th align="center">Fare</th></tr>
';

$mrms = '';
$firstName='';
$fareNew = $netAmt/count($passenger['name']);
for($i=0; $i<count($passenger['name']); $i++)
{
	$firstName = $passenger["name"][0];
	if($passenger["sex"][$i]=='Male')
	{
		$mrms = "Mr. ";
	}
	else 
	{
		$mrms = "Ms. ";
	}
$ticket_html.='<tr  height="30" style="color:#5f5f5f">
<td align="center">'.$mrms.strtoupper($passenger["name"][$i]).'</td>
<td align="center">'.$passenger["sex"][$i].'</td>
<td align="center">'.$passenger["age"][$i].'</td>
<td align="center">'.$passenger["seat"][$i].'</td>
<td align="center">'.round($fareNew).'</td>
</tr>';
}
$ticket_html.='</tbody></table></td></tr><tr><td style="color:#7a7a7a; font-size:10px; border-bottom:1px solid #E0E0E0; " colspan="2" >'.$cnclDatas.'</td></tr>';
if(isset($terms) && $terms!='')
{
$ticket_html.='<tr><td colspan="2"><strong>Trems and Conditions</strong>
<tr><td style="border-bottom:solid #E0E0E0 1px" colspan="2">'.$terms['terms'].'</td></tr>';
}
$ticket_html.='<tr><td colspan="2"><strong>Agent Info</strong>
<table width=100% border=0><tr><td width=15%>Agency Name</td><td width=35%>'.strtoupper($_SESSION['agent']['log']['agency_name']).'</td><td width=50% align="right">Customer Support No : +91 95669 43649</td></tr><tr><td>Mobile</td><td>'.$_SESSION['agent']['log']['mobile'].'</td><td align="right">&nbsp;</td></tr><tr><td>Email</td><td>'.$_SESSION['agent']['log']['email'].'</td><td align="right">&nbsp;</td></tr></table></td></tr></table><br/></td></tr></tbody></table></td></tr></tbody></table><div class="yj6qo"></div><div class="adL"></div></div></div></div>'; 

echo $ticket_html;
?>

</div>
<?php

$subject = "Urbus E-Ticket";
$subject1 = "Coppy - Urbus E-Ticket";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers.= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
$headers.= "From:Urbus.com \r\n";


$sms_ret = $obj->getStationName($fromStation). " To " . $obj->getStationName($toStation) . " Seat No -  " . str_replace('|A|', ',', $passenger_seat) . " PNR -  " . $pnr . " Ticket No - " . $tin . " Travels  - " . $travelsName . " Dep Time - " . $boardingtime . " Dep Date -  " . $travelDate . " Boarding Point - " . $boardingpoint . ",".$boardinglandmark." " . $boardingcontact . " Have a happy journey Thanks for using Urbus.com";	

if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='E:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampp/htdocs') { } else {
$_SESSION['agent']['bus']['user_mail']= $emailId;
if(mail($emailId, $subject, $ticket_html, $headers))
{
echo "<b>Email Send Successfully</b><br/>";
}
else 
{
echo "<b>Email Not Resend Again</b><br/>";	
}
mail('Urbus@gmail.com', $subject1, $ticket_html, $headers);	
$sms_ret = str_replace('&',' And ',$sms_ret);
$smsStatus = sendsms($sms_ret,$mobileNbr);
$smsStatus1 = explode(':',$smsStatus);
//$smsStatus2 = explode('|',$smsStatus1[0]);

if($smsStatus1) { 
if($smsStatus1[0]==1)
{
	echo "<b>SMS Send Successfully</b><br/><br/><br/><br/>"; 
}
else 
{
	echo "<b>SMS Send Statu Pending</b><br/><br/><br/><br/>"; 	
}
}
else 
{
	echo "<b>SMS Not Send Please Resend Again</b><br/><br/><br/><br/>"; 	
}
voice_booking($mobileNbr);
}
}
?>
</div>
</div>
</div>
<?php
$_SESSION['agent']['bus']['ticket']=$ticket_html;
?>
<script>
$(document).ready(function() {
    $('#email').click(function () {
        $.post( "sendmail.php", function( data ) {
			alert(data);
		});
    });
});
</script>

<?php 
$data2 = array(addslashes($ticket_html),$sms_ret,$_GET['ticket']);
$updateES = $obj->updateEmail_sms($data2);

$error_logs.= "Page : ticket.php ,<br/>POST Value :".implode('^',$_POST)."<br/>Ticket No : ".$_GET['ticket'];


include '../includes/footer.php';
?>
