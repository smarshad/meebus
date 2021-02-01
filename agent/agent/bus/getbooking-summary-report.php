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
//echo 'work '; exit;
 ?>
 <style type="text/css">
.tablescrool thead th {
    padding: 8px 12px;
	font-size: 12px;
    text-align: center;
}
.tablescrool {
    width: 99%;
    overflow-y: auto; 
    height: auto !important;
}
.table td {
	font-size: 13px;
	text-align: center;
}
</style>
<div class="block">
                            <div class="navbar navbar-inner block-header">
                            <a href="javascript:void(0);" onclick="return createPDFReport();"><img style="border:0px; float:right; margin-right:10px;" border=0 src="images/pdf.png" width="40px" /></a>
                            <a href="javascript:void(0);" onclick="return createXlsReport();"><img style="border:0px; float:right; margin-right:10px;" border=0 src="images/excel.png" /></a>
                            <img src="images/print.png" width="40px" onclick="return printDiv();" style=" float:right; cursor:pointer;">
                                <div class="muted pull-left">Booking Summary Report</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                <h5> Booking</h5>
                                    <div id='agentTicketPrint11'>
                                    <table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                       
                                            <tr>
                                                <th>SNo</th>
                                                <th>DOB</th>
                                                <th>Ticket Number</th>
                                                <th>Source /<br/> Destination</th>
                                                <th>Travels</th>
                                                <th>DOJ</th>
                                                 <th>PAX Name</th>
												<th>Seat Name(s)</th>
                                                <th>Fare </th>
												<th>Commission </th>
												<th>Service Charge</th>
                                                <!--<th>Partner <span style="color:#FFF;">-</span>ST</th>-->
                                                                                              
           </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php  $report=$obj->getbusBookingReport($agent_id,$from,$to);
										/*echo "<pre>";
										print_r($report);
										echo "</pre>";*/
										$fare=0;
										$commission=0;
										$serviceCharge=0;
										$i=1;
									   foreach($report as $rep)
									   {
									   ?>
                                       <tr class="gradeX odd">
                                            <td class="  sorting_1"><?php echo $i; $i++; ?></td>
                                            <td class="  sorting_1"><?php echo date('d/m/Y', strtotime($rep['booked_on']));?></td>
                                            <td class=" "><?php echo $rep['tiket_no'];?></td>
                                                <td class=" ">
                                                <?php echo $rep['fromStationName'];?>
                                                To <?php echo $rep['toStationName'];?></td>
                                                <td class="center "><?php $travels=explode('|A|',$rep['bus_provider']);  echo $travels[0];?></td>
                                                <td class="center "><?php echo $rep['travelDate'];?></td>
                                                <td class="center "><?php echo $rep['lead_pax_name'];?></td>
                                                <td class="center "><?php 
												$cancelSeat=explode('^',$rep['cancel_data']); 
												$seat=explode('|A|',$rep['passenger_seat']); 
												if(isset($cancelSeat[0]) && $cancelSeat[0]!='')
												foreach($cancelSeat as $cs)
												{
													echo $s=array_search($cs,$seat);
													unset($seat[$s]);
													
												}
												
												echo implode(',',$seat); ?></td>
                                                <td class="center "><?php echo round($rep['total_fare']); $fare+=$rep['total_fare']; ?></td>
                                                <td class="center "><?php echo round($rep['agent_comm']); $commission+=$rep['agent_comm'];?></td>

                                                <td class="center "><?php echo round($rep['service_charges']); $serviceCharge+=$rep['service_charges']; ?></td>
                                                <!--<td class="center ">594.66</td>-->
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="8"  style="text-align:right !important;"><strong>Total </strong></td>
         
												<td style="border-top:2px solid #3366cc;"><?php echo round($fare); ?></td>
												<td style="border-top:2px solid #3366cc;"><?php echo round($commission); ?></td>
												<td style="border-top:2px solid #3366cc;"><?php echo round($serviceCharge);  ?></td>
                                           </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                     <!--<h5> Cancellation</h5>-->
                                    
                                    <?php /*?><table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered tablescrool" id="cancelReport">
                                        <thead>
                                       
                                            <tr>
                                                <th>DOI</th>
                                                <th>Ticket Number</th>
                                                <th>Source</th>
                                                <th>Destination</th>
                                                <th>Travels</th>
                                                <th>DOJ</th>
                                                 <th>User/Agent</th>
												<th>Seat Name(s)</th>
												<th>Commission 	</th>
												<th>Service Charge</th>
                                                <!--<th>Partner <span style="color:#FFF;">-</span>ST</th>-->
                                                                                              
           </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php  $report=$obj->busCancelingReport($agent_id);
									   foreach($report as $rep)
									   {
									   ?>
                                       <tr class="gradeX odd">
                                            <td class="  sorting_1"><?php echo date('d/m/Y', strtotime($rep['booked_on']));?></td>
                                            <td class=" "><?php echo $rep['tiket_no'];?></td>
                                                <td class=" ">
                                                <?php echo $rep['fromStationName'];?>
                                                </td>
                                                <td><?php echo $rep['toStationName'];?></td>
                                                <td class="center "><?php $travels=explode('|A|',$rep['bus_provider']);  echo $travels[0];?></td>
                                                <td class="center "><?php echo $rep['travelDate'];?></td>
                                                <td class="center "><?php echo $rep['lead_pax_name'];?></td>
                                                <td class="center "><?php 
												$cancelSeat=explode('^',$rep['cancel_data']); 
												$seat=explode('|A|',$rep['passenger_seat']); 
												echo "<PRE>";
												print_r($cancelSeat);
												print_r($seat);
												echo "</PRE>";
												foreach($seat as $s)
												{
													foreach($cancelSeat as $cs)
													{
														if($s!=$cs)
														$seatArray[]=$s;
													}
													
												}
												echo implode(',',$seatArray); ?></td>
                                                <td class="center "><?php echo $rep['agent_comm'];?></td>

                                                <td class="center "><?php echo $rep['service_charges'];?></td>
                                                <!--<td class="center ">594.66</td>-->
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table><?php */?>
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
	var printContents = document.getElementById('agentTicketPrint11').innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
}
function createXlsReport()
{
	window.open('excel_bookingSummary.php?from='+from+'&to='+to, 'Excel Report Generate', 'window settings');
}
function createPDFReport()
{
	window.open('pdf_bookingSummary.php?from='+from+'&to='+to, 'Excel Report Generate', 'window settings');
}
</script>