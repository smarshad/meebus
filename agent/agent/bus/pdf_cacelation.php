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
<td width="50px">SNo</td>
<td width="50px">DOC</td>
<td width="50px">Ticket No</td>
<td width="50px">Source <br/> Destination</td>
<td width="50px">Travels</td>
<td width="50px">DOJ</td>
<td width="50px">Pax Name</td>
<td width="50px">Seat No</td>
<td width="50px">DOC</td>
<td width="50px">Fare</td>
<td width="50px">Commn</td>
<td width="50px">Cancel Charge</td>
<td width="50px">Refund Amt</td>
<td width="50px">Status</td>
</tr>';
if($from=='' && $to=='')
{
	$report=$obj->getbusCancelingReport1($agent_id); 
}
else
{
    $report=$obj->getbusBookingReport($agent_id,$from,$to);
}
$rep1='';
foreach($report as $rep)
{
$rep1=$rep['cancel_data'].'^';
}
$seatC=explode('^',$rep1);
//print_r($seatC);
$seatCount=count($seatC);
$i=1;
$net_tot_fare = 0; 
$net_agent_comm=0;
$net_cancel_amt=0;
$net_Reund=0;
foreach($report as $rep)
{
$html.='<tr>
<td class=" ">'.$i.'</td>
<td class="  sorting_1">'.date('d/m/Y', strtotime($rep['booked_on'])).'</td>
<td class=" ">'.$rep['tiket_no'].'</td>
<td class=" ">'.$rep['fromStationName'].' To '.$rep['toStationName'].'</td>
<td class="center ">'.$travels=explode('|A|',$rep['bus_provider']);  echo $travels[0].'</td>
<td class="center ">'.$rep['travelDate'].'</td>
<td class="center ">'.$rep['lead_pax_name'].'</td>
<td class="center ">'.$seat=str_replace('^',',',$rep['cancel_data']).'</td>
<td class="center ">'.$rep['cancel_date'].'</td>
<td class="center ">'.$tot_fare=0; $fare=explode('^',$rep['passenger_fare']);  $seatArray=explode(',',$seat); $seatArray1=explode(',',$rep['passenger_seat']); foreach($seatArray as $se) { $a=array_search($se,$seatArray1); $tot_fare+=$fare[$a]; } $net_tot_fare= $net_tot_fare+$tot_fare;  echo $tot_fare.'</td>
<td class="center ">'.$net_agent_comm = $net_agent_comm+$rep['agent_comm']; echo $rep['agent_comm'].'</td>
<td class="center ">'.$net_cancel_amt =$net_cancel_amt+$rep['cancel_amount']; echo $rep['cancel_amount'].'</td>

<td class="center ">'.$net_Reund = $net_Reund+$rep['RefundAmount']; echo $rep['RefundAmount'].'</td>
<td class="center ">'.$rep['status'].'</td>
</tr>';
} 
$i++;
$html.='</table>';
//echo $html;
$pdf->WriteHTML($html);
$pdf->Output();