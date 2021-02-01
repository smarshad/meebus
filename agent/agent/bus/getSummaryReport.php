<?php
include_once'../../server/server.php';   
include '../includes/functions.php';
$obj=new agent_module($con);
$agent_id=$_SESSION['agent']['log']['id'];
include_once '../includes/head.php';
$tdate = explode('/', $_GET['from']);
$from = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];
$tdate = explode('/', $_GET['to']);
$to = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];
$to = date('Y-m-d', strtotime($to . ' +1 day'));
 ?>
                            <div class="navbar navbar-inner block-header">
                             <a href="javascript:void(0);" onclick="return createPDFReport();"><img style="border:0px; float:right; margin-right:10px;" border=0 src="images/pdf.png" width="40px" /></a>
                            <a href="javascript:void(0);" onclick="return createXlsReport();"><img style="border:0px; float:right; margin-right:10px;" border=0 src="images/excel.png" /></a>
                            <img src="images/print.png" width="40px" onclick="return printDiv();" style=" float:right; cursor:pointer;">
                                <div class="muted pull-left">Agent Transaction Report </div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                <div id='agentTicketPrint'>
                                    <table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="example2">
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
                                    </div>
                                </div>
                            </div>

<script src="<?php echo $base_url;?>js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $base_url;?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url;?>assets/scripts.js"></script>		
<script src="<?php echo $base_url; ?>vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url; ?>assets/DT_bootstrap.js"></script>
<script>
function printDiv() {
	var printContents = document.getElementById('agentTicketPrint').innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
}
function createXlsReport()
{
	window.open('excel_SummaryByDate.php?from='+from+'&to='+to, 'Excel Report Generate', 'window settings');
}
function createPDFReport()
{
	window.open('pdf_report.php?from='+from+'&to='+to, 'Excel Report Generate', 'window settings');
}

</script>