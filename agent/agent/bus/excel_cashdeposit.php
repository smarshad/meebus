<?php  
include_once'../../server/server.php';   
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php'); }
include '../includes/functions.php';
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
$file="Deposite_Excel_Report_".date('d_m_Y_h_i_s_A',time()).".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");

?>
	  <table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>Sl.No</th>
												<th>Payment Date</th>
												<th>Description</th>
                                                <th>Remarks</th>
												<th>Credit(Rs.)</th>
												<th>Debit(Rs.)</th>
                                                <th>Charges</th>
                                                <th>Balance</th>
                                                <th>Mode of Payment </th>
                                                <th>Request Status </th>
											</tr>
										</thead>
										<tbody> 	 	
                                         	<?php
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
											   ?>
											<tr class="odd gradeX">
												<td><?php echo $i;?></td>
												<td><?php $depostiData = explode('-',$row['payment_date']); 
												echo $depostiData[2].'-'.$depostiData[1].'-'.$depostiData[0];
												?></td>
												<td><?php if($row['remark'])echo $row['remark']; else echo "No Description"; ?></td>
                                                <td><?php if($row['remarks'])echo $row['remarks']; else echo "No Remarks"; ?></td>
												 <td><?php echo $row['credit']; ?></td>
                                                                          <td><?php echo $row['debit']; ?></td>
                                                                          <td><?php echo $row['charges']; ?></td> 
                                                                          <td><?php echo $balanceDisp; ?></td> 
                                                                          <td><?php echo $row['type_of_pay']; ?></td>							
                                                                          <td><?php echo $row['status']; ?>    </td>
											</tr>
                                            <?php
											$i=$i+1;
										   }
										   ?>
											
										</tbody>
									</table>
