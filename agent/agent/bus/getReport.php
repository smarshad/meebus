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
 ?>
<div class="block">
                            <div class="navbar navbar-inner block-header">
                            <a href="javascript:void(0);" onclick="return createXlsReport();"><img style="border:0px; float:right; margin-right:10px;" border=0 src="images/excel.png" /></a>
                            <img src="images/print.png" width="40px" onclick="return printDiv();" style=" float:right; cursor:pointer;">
                                <div class="muted pull-left">Agent Bus Booking Detail Report </div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
								<div id='agentTicketPrint'>
                                    <table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered tablescrool" id="example2">
                                        <thead>
                                            <tr>
                                                <th>S No</th>
                                                <th>Tran.Type</th>
                                                <th> <span style="color:#00F;">PNR</span> / <span style="color:#930;">TICKET</span></th>
                                                <th>Booked<span style="color:#FFF;">-</span>Date</th>
                                                <th>Travel<span style="color:#FFF;">-</span>Date</th>
												<th>PAX</th>
												<th>From</th>
                                                <th>To</th>
												<th>Seats</th>
                                                <th>TXN<span style="color:#FFF;">-</span>Amt</th>
                                                <th>Commn</th>
                                               <?php /*?> <th>Extra<span style="color:#FFF;">-</span>Commn</th><?php */?>
                                               <?php /*?> <th>Service<span style="color:#FFF;">-</span>Charge<span style="color:#FFF;">-</span>Mode (Rs / %)</th>
                                                <th>Service<span style="color:#FFF;">-</span>Charge</th><?php */?>
                                                <th>SC Amt</th>
                                                <th>Profit</th>
                                                <th>TDS</th>

                                                <th>CAN Amt</th>
                                                <th>Cr.</th>
                                                <th>Dr.</th>
                                                <th>Balance</th>
                                                <th>Print</th>
                                                <th>Cancel</th>
                                                
           </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php 
										     $sno = 0;
											$report=$obj->busDetailReportByDate($agent_id,$from,$to); 
											
											//echo "<pre>"; print_r($report); echo "</pre>"; exit;
											//for($i=0;$i<2;$i++)
											foreach($report as $agent_report )
											{
												
												if($agent_report['PNR']!='') {
												$bcid = $agent_report['id']; 
												$getCommData = $obj->getAgentCommissionData($bcid);	
												//echo "<pre>"; print_r($getCommData[0]); echo "</pre>";
												$sno++;
											
										?>
                                            <tr class="odd gradeX">
                                            <td><?php echo $sno; ?>
                                                <td><?php if($getCommData[0]['remark']) { echo $getCommData[0]['remark']; } else { echo "Ticket Booked";  } ?></td>
                                                <td>
                                                <span style="color:#00F;"><?php echo $agent_report['PNR']; ?></span>
                                                <span style="color:#930;"><?php echo $agent_report['tiket_no']; ?></span>
                                                </td>
                                                <td class="center">
												<?php 
												$dateFormat1 = explode('-',$agent_report['booked_on']); 
												echo $dateFormat1[2].'-'.$dateFormat1[1].'-'.$dateFormat1[0];
												?>
                                                </td>
                                                <td class="center"><?php 
												//echo $agent_report['travelDate'].'<br/>';
												if(strpos($agent_report['travelDate'],'-'))
												{
													$testing = explode('-',$agent_report['travelDate']);
												}
												if(strpos($agent_report['travelDate'],'/'))
												{
													$testing = explode('/',$agent_report['travelDate']);
												}
												if(strlen($testing[0])==2)
												{
													echo str_replace('/','-',$agent_report['travelDate']); 
												}
												else 
												{
													echo $testing[2].'-'.$testing[1].'-'.$testing[0];
												}
												//$dateFormat1 = explode('/',$agent_report['travelDate']); 
												//echo $dateFormat1[2].'-'.$dateFormat1[1].'-'.$dateFormat1[0];
												?></td>
                                                <td class="center"><?php 
													$passangerNameDisp = explode('|A|',$agent_report['passenger_name']); 
													if(isset($passangerNameDisp[1]))
													echo str_replace('Mr','',$passangerNameDisp[1]);
													else 
													echo str_replace('Mr','',$passangerNameDisp[0]);
													
													//echo ltrim(str_replace('|A|','<br/>',$agent_report['passenger_name']),"<br/>"); 
												?></td>
                                                <td class="center"><?php echo $obj->getStationName($agent_report['fromStationId']); ?></td>
                                                 <td class="center"><?php echo $obj->getStationName($agent_report['toStationId']); ?></td>
                                                <td class="center"><?php 
												//echo substr($agent_report['passenger_seat'],2);
												$noseat = explode('|A|',$agent_report['passenger_seat']); 
												if(substr($agent_report['passenger_seat'],0,3)=='|A|') { echo count($noseat)-1; }
												else { echo count($noseat); }
												?></td>
                                                <td class="center"><?php if($agent_report['total_fare']!=0) { echo 
												round($agent_report['total_fare']); } else { echo round($getCommData[0]['credit']); } ?></td>
                                                <td class="center"><?php echo round($getCommData[0]['ag_comm']); ?></td>
                                               <?php /*?> <td class="center"><?php echo $getCommData[0]['ag_mark']; ?></td><?php */?>
                                               <?php /*?> <td class="center"><?php echo $agent_report['service_charge_mode']; ?></td>
                                                <td class="center"><?php echo $agent_report['service_charges']; ?></td><?php */?>
                                                <td class="center"><?php echo round($getCommData[0]['service_charge']); ?></td>
                                                <td class="center"><?php echo round($getCommData[0]['ag_prof']); ?></td>
                                                <td class="center"><?php if($getCommData[0]['tds']) { 
												echo round($getCommData[0]['tds']); } else { echo '0'; } ?></td>
                                                <td class="center"><?php echo round($agent_report['cancel_amount']); ?></td>
                                                <td class="center"><?php echo round($getCommData[0]['credit']); ?></td>
                                                <td class="center"><?php echo round($getCommData[0]['debit']); ?></td>
                                                <td class="center"><?php echo round($getCommData[0]['balance']); ?></td>
                                                <td class="center">
                     <?php if(isset($getCommData[0]['remark']) && $getCommData[0]['remark']!='' && $getCommData[0]['remark']=='Ticket Booked' && $agent_report['status']=='BOOKED') { ?>
					 <a href="view_ticket.php?ticket=<?php echo $agent_report['tiket_no']; ?>" target="_blank">
                                    <span style="text-align:center !important;"><i class="icon-print"></i></span></a>
                                    <?php } elseif($agent_report['status']=='CANCELLED') { echo "-"; }?>
                                                </td>
                                                <td class="center">
                    <?php $currentDate = date('Y-m-d',time());  
if($currentDate>!$agent_report['travelDate'] && isset($getCommData[0]['remark']) && $getCommData[0]['remark']!='' && $getCommData[0]['remark']=='Ticket Booked' && $agent_report['status']=='BOOKED') { ?>
                                                <span style="text-align:center !important;"><i class="icon-remove"></i></span>
                                                <?php } elseif($agent_report['status']=='CANCELLED') { ?>
                   -
                                                <?php } ?>
                                                </td>
                                                
                                            </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>

<script src="<?php echo $base_url;?>js/jquery-1.9.1.min.js"></script>
<script>
function createXlsReport()
{
	if($("#from").val()!='' && $("#to").val()!=''){
			from=$("#from").val(); to = $("#to").val();	
			window.open('excel_getReport.php?from='+from+'&to='+to, 'Excel Report Generate', 'window settings');
			//window.open('excel_SummaryByDate.php?from='+from+'&to='+to, 'Excel Report Generate', 'window settings');
	}
}
function printDiv() {
	var printContents = document.getElementById('agentTicketPrint').innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
}
</script>
<script src="<?php echo $base_url;?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url;?>assets/scripts.js"></script>		
<script src="<?php echo $base_url; ?>vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url; ?>assets/DT_bootstrap.js"></script>
