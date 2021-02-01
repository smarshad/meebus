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
<td width="100px" height="30">SNo</td>
<td width="100px" height="30">Date</td>
<td width="200px" height="30">Transaction Details</td>
<td width="100px" height="30"> Cr</td>
<td width="100px" height="30">Dr</td>
<td width="100px" height="30">Balance</td>
</tr>';
$sno = 1;
if($from=='' && $to=='')
{
	$report=$obj->busSummaryReport($agent_id); 
}
else
{
    $report=$obj->busDetailSummaryReportByDate($agent_id,$from,$to); 
}
foreach($report as $agent_report)
{
$travels=explode('|A|',$rep['bus_provider']);
$html.='<tr>
<td  width="100px">'.$sno.'</td>';
$date = explode(' ',$agent_report['created_datetime']); 
$date1 = explode('-',$date[0]);
$html.='<td width="100px">'.$date1[2].'/'.$date1[1].'/'.$date1[0].'</td>
<td width="200px">'.$agent_report['reason'].'</td>
<td width="100px">'.round($agent_report['credit']).'</td>
<td width="100px">'.round($agent_report['debit']).'</td>
<td width="100px">'.round($agent_report['balance']).'</td></tr>';
$sno++;
} 
$html.='</table>';
//echo $html;
$pdf->WriteHTML($html);
$pdf->Output();