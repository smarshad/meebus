<?php  
include_once'../../server/server.php';   
include '../includes/functions.php';
require('html_table.php');
$obj=new agent_module($con);
$_SESSION['common']['pagename'] = "Summary Report";
$agent_id=$_SESSION['agent']['log']['id'];
$data2=array($agent_id);
$deposit_data1=$obj->getDepositfulldata($data2);
$data3=array($agent_id);
$deposits_data=$obj->getDepositdata($data3);
foreach($deposits_data as $ds)
{
	$aname=$ds['agency_name']; 
	$abal=$ds['account_balance']; 
}
?>

<?php
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',6);
$html='<table border="1">
<tr>
<td width="50px">Sl.No</th>
<td width="70px">Payment Date</td>
<td width="150px">Remark</td>
<td width="70px">Credit(Rs.)</td>
<td width="70px">Debit(Rs.)</td>
<td width="70px">Charges</td>
<td width="70px">Balance</td>
<td width="100px">Mode of Payment </td>
<td width="100px">Request Status </td>
</tr>';

$i=1;
$balanceDisp = 0;
foreach($deposit_data1 as $row)
{
if($row['balance']>0)
{
$balanceDisp = $row['balance']; 
}
else 
{
$balanceDisp = 0; 
}
$html.='<tr>
<td width="50px"> '.$i.' </td>';
$depostiData = explode('-',$row['payment_date']);
$html.='<td width="70px">'.$depostiData[2].'-'.$depostiData[1].'-'.$depostiData[0].'</td>
<td width="150px">'.$row['remark'].'</td>
<td width="70px">'.$row['credit'].'</td>
<td width="70px">'.$row['debit'].'</td>
<td width="70px">'.$row['charges'].'</td> 
<td width="70px">'.$balanceDisp.'</td> 
<td width="100px">'.$row['type_of_pay'].'</td>							       
<td width="100px">'.$row['status'].'</td>
</tr>';
$i=$i+1;
} 
$html.='</table>';
//echo $html;
$pdf->WriteHTML($html);
$pdf->Output();
