<?php
include_once '../../server/server.php';  
$_SESSION['common']['pagename'] = "Print"; 
include_once '../includes/functions.php';
include_once '../../sendsms.php';
$obj=new agent_module($con); 
$status='BOOKED';
$agent_id=$_SESSION['agent']['log']['id'];
$data=array($_GET['ticket'],$status,$agent_id);
$ticket=$obj->getTicket($data);
$infoCA='';
echo '<head>';
include_once '../includes/head.php';
echo '</head>';
include_once '../includes/top_menu.php';
?>
<script type="text/javascript">
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
    <div style="width: 668px; margin: 0px auto;">
      <img src="http://Meebus.com/agent/agent/bus/images/email.png">
      <img src="http://Meebus.com/agent/agent/bus/images/printer.png" onclick="return printDiv();" style=" float:right; cursor:pointer;">
    </div>
</div>
<div class="span9" id="content">
<?php
if($ticket!=0)
{
foreach($ticket as $t)
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
	$lead_pax_name=$t['lead_pax_name'];
	$travelDate=$t['travelDate']; 
	if($t['id']>=4480)
	{
		$busInfo=$t['bus_provider']; 
		$bus=explode('|A|',$busInfo); 
		$travelsName=$bus['0']; 
		if(isset($bus['1']))
		$busType=$bus['1']; 
		$boardingInfo=$t['boardingPointId'];
		$board=explode('|A|',$boardingInfo); 
		if(isset($board['1']))
		$boardingtime=$board['1']; 
		if(isset($board['2']))
		$boardingaddress=$board['2'];
		if(isset($board['3']))
		$boardingpoint=$board['3'];
		if(isset($board['4']))
		$boardingcontact=$board['4'];
		if(isset($board['5']))
		$boardinglandmark=$board['5'];
		$bookingDate1=explode('T', $t['dateOfIssue']);
		$bookingDate=$bookingDate1[0];
		$oneway_fare=$t['oneway_fare']; 
		$passenger=array(); 
		$passenger_name=$t['passenger_name'];
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
		$boardingcontact=$t['travelsPhoneNbr'];
		$boardinglandmark=$t['BPLandmark'];
		$bookingDate=$t['booked_on'];
		$oneway_fare=$t['total_fare'];
		$passenger=array(); 
		$passenger_name=$t['passenger_name'];
		$p=explode('|A|',$passenger_name);
		foreach($p as $pass)
		{
			if($pass!='')
		$passenger['name'][]=$pass;
		}
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







$cnclDatas = '';
                $cnclDatas.='<div style="background: #fff none repeat scroll 0 0; font-family: Verdana,Geneva,sans-serif; height: auto; margin: 0 auto; width: 100%;"><div style="color: #000; float: left; font-size: 15px; font-weight: bold; height: 40px; line-height: 30px; padding-left: 5px; width:99%;border-bottom: 1px solid #CCC;">Cancellation Policy</div><div style="width:100%; flot:left;"><div style="border-right: 1px solid #ccc; color: #000; float: left; font-size: 13px;    font-weight: bold; height: 30px;  line-height: 30px; padding-left: 5px; width:68%; flot:left;">Cancellation time</div><div style="float: left; font-size: 13px; font-weight: bold; height: 30px; line-height: 30px; padding-left: 5px; width:30%;  flot:left;">Cancellation Charges</div><div style="width:100%; float:left; height:auto;">';
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
								$cnclDatas.=' %</div>';
							} else {
								$cnclDatas.='<div style=" border-right: 1px solid #ccc; border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:68%;" >Between ';
								if(isset($new11[1]))
								$cnclDatas.=$new11[1];
								$cnclDatas.=' hours and ';
								$cnclDatas.=$new11[0];
								$cnclDatas.=' hours before journey time</div><div style="border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:30%;">';
								if(isset($new11[2]))
								$cnclDatas.=$new11[2];
								$cnclDatas.='% </div>';
							}
						}
                    } $h++;
                } $cnclDatas.='</div></div></div>'; 
				


$ticket_html='<div style="width: 800px; margin: 10px auto;" id="agentTicketPrint"><div id="frame" style="border: 1px solid rgb(0, 0, 0);  width: 668px;  margin: 0px auto;  box-shadow: 0px 0px 20px #3b485b; background:#3b485b;"><table style="table-layout:fixed; margin:0 auto; background:none;" align="center"border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center"><table style="table-layout:fixed; margin:0 auto;" align="center" border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center"><table style="table-layout:fixed;  margin:0 auto; min-width:668px;" align="center"border="0" cellpadding="0" cellspacing="0" width="668"><tbody><tr><td style="min-width:668px;" height="30" align="center"></td></tr></tbody></table></td></tr></tbody></table><table style="table-layout:fixed; margin:0 auto;" align="center"border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center"><table style="table-layout:fixed; margin:0 auto; min-width:668px;" align="center"border="0" cellpadding="0" cellspacing="0" width="668"><tbody><tr><td style="min-width:668px;" align="center"><table style="border-bottom:1px solid #dde5f1;  border-radius:6px 6px 0 0;" align="center" bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td style="min-width:629px;" align="left" width="629"> <table align="left" border="0" cellpadding="0" cellspacing="0" width="260"><tbody><tr><td><table style="border-bottom-color:#67bffd;  margin-left:0;" border="0" cellpadding="0" cellspacing="0"><tbody><tr><td width="30"></td><td style="line-height:1px;" align="center"><a href="#" target="_blank" style="text-decoration: none;"><img src="http://Urbus.com/agent/agent/bus/images/logo.png" style="display: block; text-decoration: none; border: none;" alt="Logo Image" align="top" border="0" hspace="0" vspace="0"></a></td><td width="30"></td></tr></tbody></table></td></tr></tbody></table><table align="right" border="0" cellpadding="0" cellspacing="0" width="348"><tbody><tr><td colspan="2" style="font-size:0; line-height:0;" height="10">&nbsp; </td></tr><tr><td style="color: rgb(66, 80, 101);  font-family: sans-serif;  text-align: right;  line-height: 150%;  font-weight: bold;  letter-spacing: 1px;  font-size: 16px;" height="80" align="right" valign="middle" width="318"><img src="http://Urbus.com/agent/agent/bus/images/mobile.png" style="vertical-align: middle;  margin-right: 5px;"><strong>+91-86953 63636</strong></td><td width="30"></td></tr><tr><td colspan="2" style="font-size:0; line-height:0;" height="10">&nbsp; </td></tr></tbody></table></td></tr> </tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><table style="table-layout:fixed; margin:0 auto;" align="center"border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center"><table style="table-layout:fixed; margin:0 auto; min-width:668px;" align="center"border="0" cellpadding="0" cellspacing="0" width="668"><tbody><tr><td style="min-width:668px;" align="center"> <table style="min-width:628px;" align="center" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td style="min-width:628px;"><table align="left" bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td><table align="center" bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0"><tbody><tr><th style="margin:0;  padding:0; vertical-align:top; border-bottom:1px solid #dde5f1;" width="314"><table align="center" border="0" cellpadding="0" cellspacing="0" width="314"><tbody><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr><tr><td width="30"></td><td align="center" valign="top"><table align="left" border="0" cellpadding="0" cellspacing="0" width="252"><tbody><tr><td style="line-height:1px;" rowspan="2" align="center" valign="top" width="25"><img alt="IMG" style="display:block;" src="http://Urbus.com/agent/agent/bus/images/home-icon-20x20.png" border="0" hspace="0" vspace="0"></td><td style="font-size:0; line-height:0;" rowspan="2" width="14">&nbsp; </td><td style="color: #425065; font-family: sans-serif; font-size: 17px; line-height: 19px; font-weight: bold;" align="left" valign="top" width="211"><a style="text-decoration: none; color: #67bffd; font-weight: bold;" target="_blank" href="#"></a>'.$obj->getStationName($fromStation).'</td></tr><tr><td style="color: #425065; font-family: sans-serif; font-size: 16px; font-weight: bold; line-height: 23px;" align="left" valign="top" width="179"><a style="text-decoration: none; color: #67bffd; font-weight: bold;" target="_blank" href="#"></a>'.$DepartureTime.'</td></tr><tr><td style="font-size:0; line-height:0;" colspan="3" height="10">&nbsp; </td></tr></tbody></table></td><td width="30"></td></tr></tbody></table></th><th style="border-left:1px solid #dde5f1; border-bottom:1px solid #dde5f1; margin:0;  padding:0; vertical-align:top;" valign="top" width="314"><table align="center" border="0" cellpadding="0" cellspacing="0" width="314"><tbody><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr><tr><td width="30"></td><td align="center" valign="top"><table align="left" border="0" cellpadding="0" cellspacing="0" width="252"><tbody><tr><td style="line-height:1px;" rowspan="2" align="center" valign="top" width="25"><img alt="IMG" style="display:block;" src="http://Urbus.com/agent/agent/bus/images/home-icon-20x20.png" border="0" hspace="0" vspace="0"></td><td style="font-size:0; line-height:0;" rowspan="2" width="14">&nbsp; </td><td style="color: #425065; font-family: sans-serif; font-size: 17px;  line-height: 19px; font-weight: bold;" align="left" valign="top" width="211"><a style="text-decoration: none; color: #67bffd; font-weight: bold;" target="_blank" href="#"></a>'.$obj->getStationName($toStation).'</td></tr><tr><td style="color: rgb(66, 80, 101);  font-family: sans-serif;  font-size: 16px;font-weight: bold;  line-height: 23px;" align="left" valign="top" width="179"><a style="text-decoration: none; color: #67bffd; font-weight: bold;" target="_blank" href="#"></a>'.$ArrivalTime.'</td></tr><tr><td style="font-size:0; line-height:0;" colspan="3" height="10">&nbsp; </td></tr></tbody></table></th></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><table style="table-layout:fixed; margin:0 auto;" align="center"border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center"><table style="table-layout:fixed; margin:0 auto; min-width:668px;" align="center"border="0" cellpadding="0" cellspacing="0" width="668"><tbody><tr><td style="min-width:668px;" align="center"><table style="min-width:629px;" align="center" bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td style="min-width:629px;"><table style="border-bottom:1px solid #dde5f1;" align="left" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td align="center"><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td align="center"><tableborder="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr><tr><td width="30"></td><td style="color: rgb(114, 126, 141);  font-family: sans-serif;  line-height: 23px;  text-align: center;  font-weight: bold;  font-size: 18px;">'.$travelsName.' <br />'.$busType.'</td><td width="30"></td></tr><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr></tbody></table></td></tr> </tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><table style="table-layout:fixed; margin:0 auto;" align="center"border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center"><table style="table-layout:fixed; margin:0 auto; min-width:668px;" align="center"border="0" cellpadding="0" cellspacing="0" width="668"><tbody><tr><td style="min-width:668px;" align="center"> <table style="min-width:629px;" align="center" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td style="min-width:629px;"><table align="left" bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td align="left"><table align="center" bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0"><tbody><tr><th style="margin:0;  padding:0; vertical-align:top; border-bottom:1px solid #dde5f1;" width="209"><table align="center" border="0" cellpadding="0" cellspacing="0" width="209"><tbody><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr><tr><td width="30"></td><td align="center" valign="top"><table align="left" border="0" cellpadding="0" cellspacing="0" width="145"><tbody><tr><td style="line-height:1px;" rowspan="2" align="center" valign="top" width="25"><img alt="IMG" style="display:block;" src="http://Urbus.com/agent/agent/bus/images/number-icon-20x20.png" border="0" hspace="0" vspace="0"></td><td style="font-size:0; line-height:0;" rowspan="2" width="14">&nbsp; </td><td style="color: #425065; font-family: sans-serif; font-size: 14px; text-align: left; line-height: 19px; font-weight: lighter;" align="left" valign="top"><a style="text-decoration: none; color: #67bffd; font-weight: bold;" target="_blank" href="#"></a>PNR Number</td></tr><tr><td style="color: #425065; font-family: sans-serif; font-size: 14px; font-weight: bold; text-align: left; line-height: 23px;" align="left" valign="top"><a style="text-decoration: none; color: #67bffd; font-weight: bold;" target="_blank" href="#"></a>'.$pnr.'</td></tr><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr></tbody></table></td><td width="30"></td></tr></tbody></table></th><th style="border-bottom:1px solid #dde5f1; border-left:1px solid #dde5f1; margin:0;  padding:0; vertical-align:top;" width="209"><table align="center" border="0" cellpadding="0" cellspacing="0" width="209"><tbody><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr><tr><td width="30"></td><td align="center" valign="top"><table align="left" border="0" cellpadding="0" cellspacing="0" width="145"><tbody><tr><td style="line-height:1px;" rowspan="2" align="center" valign="top" width="25"><img src="http://Urbus.com/agent/agent/bus/images/number-icon-20x20.png" style="display:block;" alt="IMG" border="0" hspace="0" vspace="0"></td><td style="font-size:0; line-height:0;" rowspan="2" width="14">&nbsp; </td><td style="color: #425065; font-family: sans-serif; font-size: 14px; text-align: left; line-height: 19px; font-weight: lighter;" align="left" valign="top"><a href="#" target="_blank" style="text-decoration: none; color: #67bffd; font-weight: bold;"></a>Ticket Number</td></tr><tr><td style="color: #425065; font-family: sans-serif; font-size: 14px; font-weight: bold; text-align: left; line-height: 23px;" align="left" valign="top"><a href="#" target="_blank" style="text-decoration: none; color: #67bffd; font-weight: bold;"></a>'.$tin.'</td></tr><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr></tbody></table></td><td width="30"></td> </tr></tbody></table></th><th style="border-bottom:1px solid #dde5f1; border-left:1px solid #dde5f1; margin:0;  padding:0; vertical-align:top;" width="209"><table align="center" border="0" cellpadding="0" cellspacing="0" width="209"><tbody><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr><tr><td width="30"></td><td align="center" valign="top"><table align="left" border="0" cellpadding="0" cellspacing="0" width="145"><tbody><tr><td style="line-height:1px;" rowspan="2" align="center" valign="top" width="25"><img src="http://Urbus.com/agent/agent/bus/images/date-icon-20x20.png" style="display:block;" alt="IMG" border="0" hspace="0" vspace="0"></td><td style="font-size:0; line-height:0;" rowspan="2" width="14">&nbsp; </td><td style="color: #425065; font-family: sans-serif; font-size: 14px; text-align: left; line-height: 19px; font-weight: lighter;" align="left" valign="top"><a href="#" target="_blank" style="text-decoration: none; color: #67bffd; font-weight: bold;"></a>Traveling Date</td></tr><tr><td style="color: #425065; font-family: sans-serif; font-size: 14px; font-weight: bold; text-align: left; line-height: 23px;" align="left" valign="top"><a href="#" target="_blank" style="text-decoration: none; color: #67bffd; font-weight: bold;"></a>'.$travelDate.'</td></tr><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr></tbody></table></td><td width="30"></td> </tr></tbody></table></th></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>
<table style="table-layout:fixed; margin:0 auto;" align="center"border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center">
<table style="table-layout:fixed; margin:0 auto; min-width:668px;" align="center"border="0" cellpadding="0" cellspacing="0" width="668"><tbody><tr><td style="min-width:668px;" align="center"> <table style="min-width:628px;" align="center" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td style="min-width:628px;"><table align="left" bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td><table align="center" bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
<th width="191" style="margin:0;  padding:0; vertical-align:top; border-bottom:1px solid #dde5f1;"><table width="191" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td height="25" colspan="3" style="font-size:0; line-height:0;">&nbsp; </td></tr><tr><td width="30"></td><td valign="top" align="center"><table width="145" cellspacing="0" cellpadding="0" border="0" align="left"><tbody><tr><td width="25" valign="top" align="center" rowspan="2" style="line-height:1px;"><img vspace="0" border="0" hspace="0" src="http://Urbus.com/agent/agent/bus/images/map.png" style="display:block;" alt="IMG"></td><td width="14" rowspan="2" style="font-size:0; line-height:0;">&nbsp; </td><td valign="top" align="left" style="color: #425065; font-family: sans-serif; font-size: 14px; text-align: left; line-height: 19px; font-weight: lighter;"><a href="#" target="_blank" style="text-decoration: none; color: #67bffd; font-weight: bold;"></a>Address</td></tr><tr><td valign="top" align="left" style="color: #425065; font-family: sans-serif; font-size: 14px; font-weight: bold; text-align: left; line-height: 23px;"><a href="#" target="_blank" style="text-decoration: none; color: #67bffd; font-weight: bold;"></a>'.$boardingaddress.'</td></tr><tr><td height="25" colspan="3" style="font-size:0; line-height:0;">&nbsp; </td></tr></tbody></table></td><td width="30"></td></tr></tbody></table></th>
<th style="border-left:1px solid #dde5f1; border-bottom:1px solid #dde5f1; margin:0;  padding:0; vertical-align:top;" valign="top" width="400"><table align="center" border="0" cellpadding="0" cellspacing="0" width="400"><tbody><tr><td colspan="3" style="font-size:0; line-height:0;" height="25">&nbsp; </td></tr><tr><td width="30"></td><td align="center" valign="top"><table align="left" border="0" cellpadding="0" cellspacing="0" width="400"><tbody><tr><td rowspan="2" style="line-height:1px;" align="center" valign="top" width="25"><img src="http://Urbus.com/agent/agent/bus/images/land.png" style="display:block;" alt="IMG" border="0" hspace="0" vspace="0"></td><td rowspan="2" style="font-size:0; line-height:0;" width="14">&nbsp; </td><td style="color: #425065; font-family: sans-serif; font-size: 14px; text-align: left; line-height: 19px; font-weight: lighter;" align="left" valign="top" width="211">';
$ticket_html.='<a style="text-decoration: none; color: #67bffd; font-weight:bold;" target="_blank" href="#"></a>'.$boardingpoint.'</td></tr><tr><td style="color: #425065; font-family: sans-serif; font-size: 14px; font-weight: bold; text-align: left; line-height: 23px;" align="left" valign="top" width="179"><a href="#" target="_blank" style="text-decoration: none; color: #67bffd; font-weight: bold;"></a>'.$boardinglandmark.'</td></tr><tr><td colspan="3" style="font-size:0; line-height:0;" height="10">&nbsp; </td></tr><tr><td colspan="3" style="color: #727e8d; font-family: sans-serif; font-size: 17px; font-weight: bold; text-align: left; line-height: 23px;"><img alt="IMG" style="display: block; float: left; padding-right: 10px;" src="http://Urbus.com/agent/agent/bus/images/time.png">'.$boardingtime.'</td><td colspan="3" style="color: rgb(103, 191, 253); font-family: sans-serif; font-size: 17px; font-weight: bold; text-align: left; line-height: 23px;"><img alt="IMG" style="display: block; padding-right: 10px; float: left;" src="http://Urbus.com/agent/agent/bus/images/mobile.png">'.$boardingcontact.'</td></tr><tr><td colspan="3" style="font-size:0; line-height:0;" height="25">&nbsp; </td></tr></tbody></table></td><td width="30"></td> </tr></tbody></table></th></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>

<table style="table-layout:fixed; margin:0 auto;" align="center"border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center"><table style="table-layout:fixed; margin:0 auto; min-width:668px;" align="center"border="0" cellpadding="0" cellspacing="0" width="668"><tbody><tr><td style="min-width:668px;" align="center"> <table style="min-width:629px;" align="center" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td style="min-width:629px;"><table align="left" bgcolor="#67bffd" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td align="left"><table align="center" border="0" cellpadding="0" cellspacing="0"><tbody><tr><th style="margin:0;  padding:0; vertical-align:top; border-bottom-color:#dde5f1;" width="209"><table align="center" border="0" cellpadding="0" cellspacing="0" width="209"><tbody><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr><tr><td width="30"></td><td style="color: #ffffff; font-family: sans-serif; font-size: 15px; text-align: center; line-height: 27px; font-weight: bold;"><a style="text-decoration: none; color: #ffffff;" target="_blank" href="#"></a>Passanger</td><td width="30"></td></tr><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr></tbody></table></th><th style="border-left:1px solid #dde5f1; border-bottom-color:#dde5f1; margin:0;  padding:0; vertical-align:top;" width="139"><table align="center" border="0" cellpadding="0" cellspacing="0" width="139"><tbody><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr><tr><td width="30"></td><td style="color: #ffffff; font-family: sans-serif; font-size: 15px; text-align: center; line-height: 27px; font-weight: bold;"><a style="text-decoration: none; color: #ffffff;" target="_blank" href="#"></a>Seat No</td><td width="30"></td></tr><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr></tbody></table></th><th style="border-left:1px solid #dde5f1; border-bottom-color:#dde5f1; margin:0;  padding:0; vertical-align:top;" width="139"><table align="center" border="0" cellpadding="0" cellspacing="0" width="139"><tbody><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr><tr><td width="30"></td><td style="color: #ffffff; font-family: sans-serif; font-size: 15px; text-align: center; line-height: 27px; font-weight: bold;"><a style="text-decoration: none; color: #ffffff;" target="_blank" href="#"></a>Gender</td><td width="30"></td> </tr><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr></tbody></table></th><th style="border-left:1px solid #dde5f1; border-bottom-color:#dde5f1; margin:0;  padding:0; vertical-align:top;" width="139"><table align="center" border="0" cellpadding="0" cellspacing="0" width="139"><tbody><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr><tr><td width="30"></td><td style="color: #ffffff; font-family: sans-serif; font-size: 15px; text-align: center; line-height: 27px; font-weight: bold;"><a style="text-decoration: none; color: #ffffff;" target="_blank" href="#"></a>Age</td><td width="30"></td></tr><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr></tbody></table></th></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>';
//$i=0;
//$passenger['name'] = array_filter($passenger['name']);
//echo "<pre>"; print_r($passenger);

//foreach($passenger as $p_name) 
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
$ticket_html.='<table style="table-layout:fixed; margin:0 auto;" align="center"border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center"><table style="table-layout:fixed; margin:0 auto; min-width:668px;" align="center"border="0" cellpadding="0" cellspacing="0" width="668"><tbody><tr><td style="min-width:668px;" align="center"> <table style="min-width:629px;" align="center" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td style="min-width:629px;"><table align="left" bgcolor="#eff3f7" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td align="left"><table align="center" border="0" cellpadding="0" cellspacing="0"><tbody><tr><th style="margin:0;  padding:0; border-bottom:1px solid #dde5f1;" width="209"><table align="center" border="0" cellpadding="0" cellspacing="0" width="209"><tbody><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr><tr><td width="30"></td><td style="color: #425065; font-family: sans-serif; font-size: 14px; text-align: left; line-height: 19px; font-weight: lighter;"><a style="text-decoration: none; color: #67bffd;" target="_blank" href="#"></a>'.$mrms.ucfirst($passenger["name"][$i]).'</td><td width="30"></td></tr><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr></tbody></table></th><th style="border-left:1px solid #dde5f1; border-bottom:1px solid #dde5f1; margin:0;  padding:0;" width="139"><table align="center" border="0" cellpadding="0" cellspacing="0" width="139"><tbody><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr><tr><td width="30"></td><td style="color: #425065; font-family: sans-serif; font-size: 14px; font-weight: lighter; text-align: center; line-height: 23px;"><a style="text-decoration: none; color: #67bffd;" target="_blank" href="#"></a>'.$passenger["seat"][$i].'</td><td width="30"></td> </tr><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr></tbody></table></th><th style="border-left:1px solid #dde5f1; border-bottom:1px solid #dde5f1; margin:0;  padding:0;" width="139"><table align="center" border="0" cellpadding="0" cellspacing="0" width="139"><tbody><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr><tr><td width="30"></td><td style="color: #425065; font-family: sans-serif; font-size: 14px; font-weight: lighter; text-align: center; line-height: 23px;"><a style="text-decoration: none; color: #67bffd;" target="_blank" href="#"></a>'.$passenger["sex"][$i].'</td><td width="30"></td></tr><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr></tbody></table></th><th style="border-left:1px solid #dde5f1; border-bottom:1px solid #dde5f1; margin:0;  padding:0;" width="139"><table align="center" border="0" cellpadding="0" cellspacing="0" width="139"><tbody><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr><tr><td width="30"></td><td style="color: #425065; font-family: sans-serif; font-size: 14px; font-weight: lighter; text-align: center; line-height: 23px;"><a style="text-decoration: none; color: #67bffd;" target="_blank" href="#"></a>'.$passenger["age"][$i].'</td><td width="30"></td></tr><tr><td colspan="3" style="font-size:0; line-height:0;" height="20">&nbsp; </td></tr></tbody></table></th></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>';
//$i++;
}

$infoCA = '<table bgcolor=#FFFFFF width=100% border=0 cellpadding=0 cellspacing=0><tr><td width=25%>&nbsp;&nbsp;Passenger Info</td><td><table width=100% border=0><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td width=29%>Name</td><td width=71%>'.$firstName.'</td></tr><tr><td>Mobile</td><td>'.$mobileNbr.'</td></tr><tr><td>Email</td><td>'.$emailId.'</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr></table></td></tr><tr><td height=1 colspan=2 bgcolor=#CCEEDD></td></tr><tr><td>&nbsp;&nbsp;Agent Info</td><td><table width=100% border=0><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td width=29%>Agnecy Name</td><td width=71%>'.$_SESSION['agent']['log']['agency_name'].'</td></tr><tr><td>Mobile</td><td>'.$_SESSION['agent']['log']['mobile'].'</td></tr><tr><td>Email</td><td>'.$_SESSION['agent']['log']['email'].'</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr></table></td></tr></table>';				

$ticket_html.='<table style="table-layout:fixed; margin:0 auto;" align="center"border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center"><table style="table-layout:fixed; margin:0 auto; min-width:668px;" align="center"border="0" cellpadding="0" cellspacing="0" width="668"><tbody><tr><td style="min-width:668px;" align="center"> <table style="min-width:629px;" align="center" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td style="min-width:629px;"><table align="left" bgcolor="#eff3f7" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><table style="table-layout:fixed; margin:0 auto;" align="center"border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center"><table style="table-layout:fixed; margin:0 auto; min-width:668px;" align="center"border="0" cellpadding="0" cellspacing="0" width="668"><tbody><tr><td style="min-width:668px;" align="center"> <table style="min-width:629px;" align="center" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td style="min-width:629px;"><table align="left" bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td align="left"><table align="center" bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0"><tbody><tr><th style="margin:0;  padding:0; vertical-align:top; border-bottom:1px solid #dde5f1;" width="209"><table align="center" border="0" cellpadding="0" cellspacing="0" width="209"><tbody><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr><tr><td width="30"></td><td align="center" valign="top"><table align="left" border="0" cellpadding="0" cellspacing="0" width="145"><tbody><tr><td style="line-height:1px;" rowspan="2" align="center" valign="top" width="25"><img alt="IMG" style="display:block;" src="http://Urbus.com/agent/agent/bus/images/number-icon-20x20.png" border="0" hspace="0" vspace="0"></td><td style="font-size:0; line-height:0;" rowspan="2" width="14">&nbsp; </td><td style="color: #425065; font-family: sans-serif; font-size: 14px; text-align: left; line-height: 19px; font-weight: lighter;" align="left" valign="top"><a href="#" target="_blank" style="text-decoration: none; color: #67bffd; font-weight: bold;"></a>Status</td></tr><tr><td style="color: rgb(66, 80, 101);  font-family: sans-serif;  font-weight: bold;  text-align: left;  line-height: 23px;  font-size: 18px;" align="left" valign="top"><a href="#" target="_blank" style="text-decoration: none; color: #67bffd; font-weight: bold;"></a>Conformed</td></tr><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr></tbody></table></td><td width="30"></td></tr></tbody></table></th><th style="border-bottom:1px solid #dde5f1; border-left:1px solid #dde5f1; margin:0;  padding:0; vertical-align:top;" width="209"><table align="center" border="0" cellpadding="0" cellspacing="0" width="209"><tbody><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr><tr><td width="30"></td><td align="center" valign="top"><table align="left" border="0" cellpadding="0" cellspacing="0" width="145"><tbody><tr><td style="line-height:1px;" rowspan="2" align="center" valign="top" width="25"><img alt="IMG" style="display:block;" src="http://Urbus.com/agent/agent/bus/images/date-icon-20x20.png" border="0" hspace="0" vspace="0"></td><td style="font-size:0; line-height:0;" rowspan="2" width="14">&nbsp; </td><td style="color: #425065; font-family: sans-serif; font-size: 14px; text-align: left; line-height: 19px; font-weight: lighter;" align="left" valign="top"><a href="#" target="_blank" style="text-decoration: none; color: #67bffd; font-weight: bold;"></a>Booking Date</td></tr><tr><td style="color: #425065; font-family: sans-serif; font-size: 14px; font-weight: bold; text-align: left; line-height: 23px;" align="left" valign="top"><a style="text-decoration: none; color: #67bffd; font-weight: bold;" target="_blank" href="#"></a>'.$bookingDate.'</td></tr><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr></tbody></table></td><td width="30"></td> </tr></tbody></table></th><th style="border-bottom:1px solid #dde5f1; border-left:1px solid #dde5f1; margin:0;  padding:0; vertical-align:top;" width="209"><table align="center" border="0" cellpadding="0" cellspacing="0" width="209"><tbody><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr><tr><td width="30"></td><td align="center" valign="top"><table align="left" border="0" cellpadding="0" cellspacing="0" width="145"><tbody><tr><td style="line-height:1px;" rowspan="2" align="center" valign="top" width="25"><img alt="IMG" style="display:block;" src="http://Urbus.com/agent/agent/bus/images/dollar-icon-20x20.png" border="0" hspace="0" vspace="0"></td><td style="font-size:0; line-height:0;" rowspan="2" width="14">&nbsp; </td><td style="color: #425065; font-family: sans-serif; font-size: 14px; text-align: left; line-height: 19px; font-weight: lighter;" align="left" valign="top"><a style="text-decoration: none; color: #67bffd; font-weight: bold;" target="_blank" href="#"></a>Total Fare</td></tr><tr><td style="color: #425065; font-family: sans-serif; font-size: 14px; font-weight: bold; text-align: left; line-height: 23px;" align="left" valign="top"><a style="text-decoration: none; color: #67bffd; font-weight: bold;" target="_blank" href="#"></a>'.round($oneway_fare).'</td></tr><tr><td style="font-size:0; line-height:0;" colspan="3" height="25">&nbsp; </td></tr></tbody></table></td><td width="30"></td> </tr></tbody></table></th></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><table style="table-layout:fixed; margin:0 auto;" align="center"border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center"><table style="table-layout:fixed; margin:0 auto; min-width:668px;" align="center"border="0" cellpadding="0" cellspacing="0" width="668"><tbody><tr><td style="min-width:668px;" align="center"> <table style="min-width:629px;" align="center" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td style="min-width:629px;"><table style="border-radius:0 0 6px 6px;" align="left" bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0" width="629"><tbody><tr><td><tableborder="0" cellpadding="0" cellspacing="0" width="627"><tbody><tr><td colspan="3" style="font-size:0; line-height:0;" height="25">&nbsp; </td></tr><tr><td width="30"></td> <td style="padding:5px; background: rgb(204, 238, 221) none repeat scroll 0% 0%;" align="left">'.$infoCA.'<br/>'.$cnclDatas.'</td><td width="30"></td></tr><tr><td colspan="3"style="font-size:0; line-height:0;" height="30">&nbsp; </td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="table-layout:fixed;margin:0 auto;"><tbody><tr>	<td align="center">	<table width="668" cellspacing="0" cellpadding="0" border="0" align="center" style="table-layout:fixed;margin:0 auto;min-width:668px;"><tbody><tr><td align="center" style="min-width:668px;"> <table width="629" cellspacing="0" cellpadding="0" border="0" align="center" style="table-layout:fixed;margin:0 auto;min-width:629px;"><tbody><tr><td align="center" style="min-width:629px;"><table width="610" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td height="25"></td></tr> <tr><!--NOTES -->																																																					<td style="font-family: sans-serif; font-size: 13px; text-align: center; font-weight: bold; line-height: 190%; color: rgb(255, 160, 36);"> <a style="text-decoration: none;color: #67bffd;font-weight: bold;" target="_blank" href="#"></a>THANK YOU VERY MUCH FOR CHOOSING OUR WEBSITE</td></tr><tr><td height="25" style="font-size:0;line-height:0;">&nbsp;</td></tr><tr> 	    <td><table width="570" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td width="64"><img width="64" height="69" src="http://Urbus.com/agent/agent/bus/images/unnamed.png"></td>
<td width="367" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; line-height: 18px; color: rgb(255, 255, 255);"><strong>You can use Urbus on all mobile devices. Book from anywhere!</strong><br>Just log on to <a target="_blank" href="www.Urbus.com" style="color: rgb(255, 182, 57);"><strong>Urbus.com</strong></a> from your handset to use the mobile version.</td><td width="10" align="center"></td><td width="109"><table width="100" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td height="20" align="center" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(255, 255, 255);" colspan="3"><strong>Connect with us </strong></td></tr><tr><td width="45" align="right" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000000"><a target="_blank" href="#"><img width="32" border="0" height="32" src="http://Urbus.com/agent/agent/bus/images/facebook.gif"></a></td><td width="7" align="right" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000000">&nbsp;</td><td width="48" align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000000"><img width="32" height="32" src="http://Urbus.com/agent/agent/bus/images/twiter.gif"></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td height="25"></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div></div>'; 
?>
<div id='agentTicketPrint'>
<?php echo $ticket_html; ?>
</div>
<?php

$subject = "Urbus E-Ticket";
$subject1 = "Coppy - Urbus E-Ticket";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers.= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
$headers.= "From:Urbus.com \r\n";
mail($emailId, $subject, $ticket_html, $headers);
mail('Urbus@gmail.com', $subject1, $ticket_html, $headers);	

$sms_ret = $obj->getStationName($fromStation). " To " . $obj->getStationName($toStation) . "
Seat No -  " . str_replace('|A|', ',', $passenger_seat) . "
PNR -  " . $pnr . "
Travels  - " . $travelsName . "
Dep Time - " . $boardingtime . "
Dep Date -  " . $travelDate . "
Boarding Point - " . $boardingpoint . ",".$boardinglandmark."
Contact No - " . $boardingcontact . "
Have a happy journey 
Thanks for using Urbus.com";			

sendsms($sms_ret,$mobileNbr);
voice_booking($mobileNbr);

}
?>
</div>
</div>
</div>
<?php 
include '../includes/footer.php';
?>
