<?php  
include_once "server/server.php";
include "includes/pdo_functions.php";
$obj=new user_module($con);
if(isset($_SESSION['user']['log']['id']))
{
	$user_id=$_SESSION['user']['log']['id'];
}
else
{
	$user_id=0;
}
if(isset($_POST['submit']) && $_POST['submit']=='Submit')
{
	$ticketnum=$_POST['ticketnum'];
	$email=$_POST['email'];
	$checkEmail=$obj->checkbusEmail(array($email,$ticketnum));
	if($checkEmail!=0)
	{
		$data=array($ticketnum,$email);
		$res=$obj->getTicketdetails($data);
	
	if($res!=0)
	{
	foreach($res as $t)
	{
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
		$netAmt = $t['paidAmount'];
		$travelDate=$t['travelDate']; 
		$lead_pax_name=$t['lead_pax_name'];
		$busInfo=$t['busInfo']; 
		$bus=explode('^',$busInfo); 
		$travelsName=$bus['0']; 
		if(isset($bus['1']))
		$busType=$bus['1']; 
		$boardingInfo=$t['boardingInfo'];
		$board=explode('^',$boardingInfo); 
		if(isset($board['0']))
		$boardingtime=$board['0'];
		if(isset($board['1']))
		$boardinginfor=$board['1']; 
		if(isset($board['2']))
		$boardingaddress=$board['2'];
		if(isset($board['3']))
		$boardingpoint=$board['3'];
		if(isset($board['4']) && $board['4']!=''){
		$boardingcontact="Contact No : ".$board['4']; } else { $boardingcontact=''; }
		
		if(isset($board['5']))
		{
			$boardinglandmark=$board['5'];
			if($boardingpoint==$boardinglandmark){ $boardinglandmark=''; }
			else { $boardinglandmark='<br/><b>Landmark : </b>'.$boardinglandmark; }
		}
		$bookingDate=$t['dateOfIssue'];
		//$bookingDate = $bookingDate[2].'/'.$bookingDate[1].'/'.$bookingDate[0];
		$oneway_fare=$t['oneway_fare']-$serviceCharges.'.00'; 
		$offerAmt=$t['offerAmount'];
		$passenger=array(); 
		$passenger_name=$t['passenger_name'];
		$passenger_fare=explode('^',$t['passenger_fare']);		
		$passenger['name']=explode('^',$passenger_name);
		$passenger_age=$t['passenger_age'];
		$passenger['age']=explode('^',$passenger_age); 
		$passenger_seat=$t['passenger_seat']; 
		$passenger['seat']=explode('^',$passenger_seat); 
		$passenger_sex=$t['passenger_sex']; 
		$passenger['sex']=explode('^',$passenger_sex); 
		
		
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
		$status=$t['status']; 
	}

$ticket_html='<div><table style="background-color:#dcdcdc;border-collapse:collapse;margin:0;padding:0" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">   <tbody><tr><td style="background-color: rgb(255, 255, 255);" valign="top" align="center"><table id="busTicket" style="border-collapse: collapse; width: 100%; max-width: 660px; background: rgb(223, 231, 240) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204);margin-bottom: 25px;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td valign="top" align="center"><table style="width: 100% ! important; background: rgb(255, 255, 255) none repeat scroll 0% 0%;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td valign="top" align="center"><table style="text-align:left" width="100%" cellspacing="0" cellpadding="0" border="0" align="left"><tbody><tr><td style="display:inline-block;vertical-align:middle" valign="middle" align="center"><table style="width:315px;border-collapse:collapse;vertical-align:middle" width="315" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td valign="middle" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td style="padding:0 10px 5px 10px" valign="middle" align="left"><a href="#" target="_blank" data-saferedirecturl=""><img alt="meebus" src="http://meebus.com/images/buslogo.png" style="width:150px;" class="CToWUd" vspace="0" hspace="0" border="0"></a></td></tr></tbody></table></td></tr></tbody></table></td><td style="display:inline-block;vertical-align:middle" valign="middle" align="center"><table style="width:315px;border-collapse:collapse;vertical-align:middle" width="315" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td valign="middle" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td style="height: 2px; text-align: right;" height="2"><div style="font-size: 16px; line-height: 22px; color: rgb(0, 0, 0);"><strong  style="color:#141416;font-weight:bold;font-size:15px;">PNR : </strong><strong  style="color:#a4a4a2;font-size:15px;">'.$pnr.'</strong></div><div style="font-size: 16px; line-height: 22px; color: rgb(0, 0, 0);"><strong style="color:#141416;font-weight:bold;font-size:15px;"> Booked On :</strong><strong  style="color:#a4a4a2;font-size:15px;"> '.date('d-M-Y h:i A',strtotime($bookingDate)).'</strong></div></td></tr><tr><td style="color:#101010;text-align:right" valign="middle" align="center"></td></tr><tr><td style="height:5" height="5"></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><table style="width: 100% ! important; background: rgb(255, 255, 255) none repeat scroll 0% 0%;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td style="background-color:#cccccc;height:1px" height="1"></td></tr><tr><td style="padding:10px;background: #e31e25;" valign="middle" align="left"><a href="" style="color: #fff; font-weight: bold; text-decoration: none; font-size: 21px; line-height: 30px;display:block;text-align:center" target="_blank" data-saferedirecturl="">Ticket Confirmed</a></td></tr><tr><td style="background-color:#cccccc;height:1px" height="1"></td></tr><tr><td style="padding:10px" valign="middle" align="left"><span style="color: rgb(1, 1, 1); font-family: font-weight: bold; text-decoration: none; font-size: 16px; line-height: 30px;" target="_blank" data-saferedirecturl="">Dear '.$lead_pax_name.'</a><br><span style="color: rgb(1, 1, 1); font-family:  text-decoration: none; line-height: 30px; font-size: 14px; font-weight: 600;" data-saferedirecturl="">Thank you for choosing meebus</span><br><span style="color: rgb(1, 1, 1); font-family: text-decoration: none; line-height: 30px; font-size: 14px; font-weight: 600;" data-saferedirecturl="">You have paid Rs. '.$netAmt.'</span>&nbsp;</td></tr><tr><td style="background-color:#cccccc;height:1px" height="1"></td></tr><tr><td style="padding:10px" valign="middle" align="left"><table width="49%" cellspacing="0" cellpadding="0" border="0" align="left"><tbody><tr><td style="width:8px" width="8"></td><td style="vertical-align: middle; text-align: left;" valign="middle"><div style="font-size: 16px; line-height: 22px; color: rgb(0, 0, 0);"><strong  style="color:#141416;font-weight:bold;font-size:15px;">'.$fromStation.' - '.$toStation.'</strong></div></td></tr></tbody></table><table width="49%" cellspacing="0" cellpadding="0" border="0" align="right"><tbody><tr><td style="width:8px" width="8"></td><td style="vertical-align: middle; text-align: left;" valign="middle"><div style="font-size: 16px; line-height: 22px; color: rgb(0, 0, 0);"><strong style="color:#141416;font-weight:bold;font-size:15px;">Travel Date</strong><br><strong style="color:#a4a4a2;font-size:14px;">'.date('d M Y',strtotime($travelDate)).'</strong></div></td></tr></tbody></table>&nbsp;</td></tr><tr><td style="background-color:#cccccc;height:1px" height="1"></td></tr><tr><td style="padding:10px" valign="middle" align="left"><table width="49%" cellspacing="0" cellpadding="0" border="0" align="left"><tbody><tr><td style="width:8px" width="8"></td><td style="vertical-align: middle; text-align: left;" valign="middle"><div style="font-size: 16px; line-height: 22px; color: rgb(0, 0, 0);"><strong style="color:#141416;font-weight:bold;font-size:15px;">'.$travelsName.'</strong><br><strong style="color:#a4a4a2;font-size:14px;">'.$busType.'</strong></div></td></tr></tbody></table><table width="49%" cellspacing="0" cellpadding="0" border="0" align="right"><tbody><tr><td style="width:8px" width="8"></td><td style="vertical-align: middle; text-align: left;" valign="middle"><div style="font-size: 16px; line-height: 22px; color: rgb(0, 0, 0);"><strong style="color:#141416;font-weight:bold;font-size:15px;">'.$fromStation.' - '.$toStation.' </strong><br><strong style="color:#a4a4a2;font-size:14px;">'.$DepartureTime.' - '.$ArrivalTime.'</strong></div></td></tr></tbody></table>&nbsp;</td></tr><tr><td style="background-color:#cccccc;height:1px" height="1"></td></tr><tr><td style="padding:10px" valign="middle" align="left">';
$mrms = '';
$firstName='';
for($i=0; $i<count($passenger['name']); $i++)
{
	$firstName = $passenger["name"][0];
	if($passenger["sex"][$i]=='M')
	{
		$mrms = "Mr. ";
	}
	else 
	{
		$mrms = "Ms. ";
	}
$ticket_html.='<table width="49%" cellspacing="0" cellpadding="0" border="0" align="left"><tbody><tr><td style="width:8px" width="8"></td><td style="vertical-align: middle; text-align: left;" valign="middle"><div style="font-size: 16px; line-height: 22px; color: rgb(0, 0, 0);"><strong style="color:#a4a4a2;font-size: 14px;">Passenger Name</strong><br><strong style="color:#141416;font-weight:bold;font-size:15px;">'.$mrms.ucfirst($passenger["name"][$i]).'</strong></div></td></tr></tbody></table><table width="49%" cellspacing="0" cellpadding="0" border="0" align="right"><tbody><tr><td style="width:8px" width="8"></td><td style="vertical-align: middle; text-align: left;" valign="middle"><div style="font-size: 16px; line-height: 22px; color: rgb(0, 0, 0);"><strong style="color:#a4a4a2;font-size: 14px;">Seat No. </strong><br><strong style="color:#141416;font-weight:bold;font-size:15px;">'.$passenger["seat"][$i].' </strong></div></td></tr></tbody></table>';
}
$ticket_html.='&nbsp;</td></tr><tr><td style="background-color:#cccccc;height:1px" height="1"></td></tr><tr><td style="padding:10px" valign="middle" align="left"><table width="49%" cellspacing="0" cellpadding="0" border="0" align="left"><tbody><tr><td style="width:8px" width="8"></td><td style="vertical-align: middle; text-align: left;" valign="middle"><div style="font-size: 16px; line-height: 22px; color: rgb(0, 0, 0);"><strong style="color:#a4a4a2;font-size: 14px;">Boarding Point </strong><br><strong style="color:#141416;font-weight:bold;font-size:15px;">'.$boardinginfor.'</strong></div></td></tr></tbody></table><table width="49%" cellspacing="0" cellpadding="0" border="0" align="right"><tbody><tr><td style="width:8px" width="8"></td><td style="vertical-align: middle; text-align: left;" valign="middle"><div style="font-size: 16px; line-height: 22px; color: rgb(0, 0, 0);"><strong style="color:#a4a4a2;font-size: 14px;">Departure Time   </strong><br><strong style="color:#141416;font-weight:bold;font-size:15px;">'.$boardingtime.'</strong></div></td></tr></tbody></table>&nbsp;</td></tr></tbody></table><table style="width: 100% !important;padding: 0;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td valign="middle" align="left"><table style="width: 100% ! important;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td style="height:3;background-color:#666666" height="3"></td></tr></tbody></table><table style="background: rgb(255, 255, 255) none repeat scroll 0% 0%;padding: 10px;" width="100%" cellspacing="0" cellpadding="10" border="0" align="left"><tbody><tr><td style="font-size:11px;color:#888888;line-height:16px" valign="top" align="left">We hope you enjoy your travel with Meebus. Were still small, so it would really help us if you can help us spread the word by telling your friends about Meebus.<br><br><strong style="color:#333333"><a href="mailto:support@meebus.com">Meebus support</a> - It is FASTER to WRITE to US</strong><br>Click Here to to! Your Issue or goto <a href="http://meebus.com" style="color:#4a8aca;text-decoration:none" target="_blank" data-saferedirecturl="">meebus.com</a><br></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>'; 
}
$subject = "Meebus Ticket";
$fromMailid="support@meebus.com";
$description="Bus Ticket";
$data1=array($user_id,$fromMailid,$email,$subject,$ticket_html,$description,1);
$maildata=$obj->insertMail($data1);	
$_SESSION['user']['bus']="SMS & Email Send Successfully";
header('location:email_sms.php');
exit;
}
else
{
	$_SESSION['user']['bus']='Email ID AND Ticket Number Is Invalid';
	header('location:email_sms.php');
	exit;
}
}

?>


</body>
</html>
