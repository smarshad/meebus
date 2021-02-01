<?php  
include_once'../../server/server.php';   
include '../includes/functions.php';
require('html_table.php');
$obj=new agent_module($con);
$from='';
$to = '';

$agent_id=$_SESSION['agent']['log']['id'];
if(isset($_GET['from']) && $_GET['from']!='')
{
$tdate = explode('/', $_GET['from']);
$from = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];
}
if(isset($_GET['to']) && $_GET['to']!='')
{

$tdate = explode('/', $_GET['to']);
$to = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];
}
?>

<?php
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',6);
$html='<table border="1">
<tr>
<td width="50px" height="30">SNo</td>
<td width="75px" height="30">DOB</td>
<td width="75px" height="30">Ticket Number</td>
<td height="30">Source / Destination</td>
<td width="75px" height="30">Travels</td>
<td width="50px" height="30">DOJ</td>
<td width="75px" height="30">PAX Name</td>
<td width="50px" height="30">Seat No</td>
<td width="50px" height="30">Fare</td>
<td width="60px" height="30">Commission</td>
<td width="75px" height="30">Service Charge</td>
</tr>';
if($from=='' && $to=='')
{
	$report=$obj->busBookingReport($agent_id);
}
else
{
    $report=$obj->getbusBookingReport($agent_id,$from,$to);
}
$fare=0;
$commission=0;
$serviceCharge=0;
$i=1;
foreach($report as $rep)
{
$travels=explode('|A|',$rep['bus_provider']);
$html.='<tr>
<td  width="50px"  height="30">'.$i; $i++; $html.='</td>
<td width="75px"  height="30">'.date('d/m/Y', strtotime($rep['booked_on'])).'</td>
<td width="75px"  height="30">'.$rep['tiket_no'].'</td>
<td height="30">'.$rep['fromStationName'].' To '.$rep['toStationName'].'</td>
<td width="75px" height="30">'.$travels[0].'</td>
<td width="50px" height="30">'.$rep['travelDate'].'</td>
<td width="75px" height="30">'.$rep['lead_pax_name'].'</td>
<td  width="50px" height="30">';
$cancelSeat=explode('^',$rep['cancel_data']); 
$seat=explode('|A|',$rep['passenger_seat']); 
if(isset($cancelSeat[0]) && $cancelSeat[0]!='')
foreach($cancelSeat as $cs){ $s=array_search($cs,$seat); $html.=$s; unset($seat[$s]); }
$html.=implode(',',$seat); $html.='</td>
<td  width="50px" height="30">'.round($rep['total_fare']); 
$fare+=$rep['total_fare']; $html.='</td>
<td  width="60px" height="30">'.round($rep['agent_comm']); 
$commission+=$rep['agent_comm'];
$html.='</td><td  width="75px" height="30">'.round($rep['service_charges']); 
$serviceCharge+=$rep['service_charges']; 
$html.='</td></tr>';
} 
$html.='</table>';
//echo $html;
$pdf->WriteHTML($html);
$pdf->Output();