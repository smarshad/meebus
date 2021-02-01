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
$html='<table border="1"><tr><td width="50px">Sl.No</td><td width="80px">Payment Date</td><td width="150px">Description</td><td width="125px">Remarks</td><td width="50px">Credit(Rs.)</td><td width="50px">Debit(Rs.)</td><td width="50px">Charges</td><td width="50px">Balance</td><td width="100px">Mode of Payment</td><td width="75px">Request Status</td></tr>';
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
if($row['remark']) { $remarks =  $row['remark']; } else { $remarks = " - "; }
if($row['remarks']) { $remarkss =  $row['remarks']; } else { $remarkss = " - "; }

if($row['credit']) { $credit =  $row['credit']; } else { $credit = " - "; }
if($row['debit']) { $debit =  $row['debit']; } else { $debit = " - "; }
if($row['charges']) { $charges =  $row['charges']; } else { $charges = " - "; }
if($row['type_of_pay']) { $type_of_pay =  $row['type_of_pay']; } else { $type_of_pay = " - "; }
if($row['status']) { $status =  $row['status']; } else { $status = " - "; }
$depostiData = explode('-',$row['payment_date']); 
$html.='<tr><td width="50px">'.$i.'</td><td width="80px">'.$depostiData[2].'-'.$depostiData[1].'-'.$depostiData[0].'</td><td width="150px" align="justify">'.$remarks.'</td><td width="125px" align="justify">'.$remarkss.'</td><td width="50px" align="justify">'.$credit.'</td><td width="50px" align="justify">'.$debit.'</td><td width="50px" align="justify">'.$charges.'</td><td width="50px" align="justify">'.$balanceDisp.'</td><td width="100px" align="justify">'.$type_of_pay.'</td><td width="75px" align="justify">'.$status.'</td></tr>';
$i=$i+1;
} 
$html.='</table>';
//echo $html;
$pdf->WriteHTML($html);
$pdf->Output();
?>