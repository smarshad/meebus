<?php  
include_once'../../server/server.php';   
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php'); }
include '../includes/functions.php';
$obj=new agent_module($con);
$_SESSION['common']['pagename'] = "Summary Report";
$agent_id=$_SESSION['agent']['log']['id'];

$file="Transaction_Excel_Report_".date('d_m_Y_h_i_s_A',time()).".xls";

$tdate = explode('/', $_GET['from']);
$from = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];
$tdate = explode('/', $_GET['to']);
$to = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];
$to = date('Y-m-d', strtotime($to . ' +1 day'));

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");

?>
	  <table cellpadding="2" cellspacing="0" border="1" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>S No</th>
                                                <th>Date</th>
                                                <th>Transaction Details</th>											
                                                <th>Cr</th>
                                                <th>Dr</th>
                                                <th>Balance</th>
								           </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php 
										     $sno = 1;
											$report=$obj->busDetailSummaryReportByDate($agent_id,$from,$to); 
											foreach($report as $agent_report)
											{
										?>
                                            <tr class="odd gradeX">
                                            <td><?php echo $sno; ?>
                                            <td class="center"><?php $date = explode(' ',$agent_report['created_datetime']); $date1 = explode('-',$date[0]);
											echo $date1[2].'/'.$date1[1].'/'.$date1[0];											
											?></td>
                                            <td class="center"><?php echo $agent_report['reason']; ?></td>
                                            <td class="center"><?php echo round($agent_report['credit']); ?></td>
                                            <td class="center"><?php echo round($agent_report['debit']); ?></td>
                                            <td class="center"><?php echo round($agent_report['balance']); ?></td>
                                            </tr>
                                            <?php $sno++; } ?>
                                        </tbody>
                                    </table>
