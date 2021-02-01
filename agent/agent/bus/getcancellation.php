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
    padding: 8px 6px;
	font-size: 11px;
    text-align: center;
}
.tablescrool {
    width: 99.8%;
    overflow-y: auto; 
    height: auto !important;
}
.table td {
	font-size: 11px;
	text-align: center;
}
</style>
<div class="block">
                            <div class="navbar navbar-inner block-header">
                              <a href="javascript:void(0);" onclick="return createXlsReport();"><img style="border:0px; float:right; margin-right:10px;" border=0 src="images/excel.png" /></a>
                               <img src="images/print.png" width="40px" onclick="return printDiv();" style=" float:right; cursor:pointer;">
                                <div class="muted pull-left">Cancel Report</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                <?php $report=$obj->getbusCancelingReport($agent_id,$from,$to); 
									$rep1='';
									 foreach($report as $rep)
									   {
										  $rep1=$rep['cancel_data'].'^';
									   }
									   $seatC=explode('^',$rep1);
									   //print_r($seatC);
									   $seatCount=count($seatC);
								?>
                                                                    
                                  <h5> Cancellation</h5>
                                    <div id='agentTicketPrint11'>
                                    <table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered tablescrool" id="cancelReport">
                                        <thead>
                                       
                                            <tr>
                                                <th>SNo</th>
                                                <th>DOC</th>
                                                <th>Ticket No</th>
                                                <th>Source <br/>Destination</th>
                                                <th>Travels</th>
                                                <th>DOJ</th>
                                                 <th>Pax Name</th>
												<th>Seat No</th>
                                                <th>DOC</th>
                                                <th>Fare</th>
                                                <th>Commn</th>
                                                <th>Cancel Charge</th>
												<th>Refund Amount</th>
												<th>Status</th>
                                                <!--<th>Partner <span style="color:#FFF;">-</span>ST</th>-->
                                                                                              
           </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php  
										$i=1;
										$net_tot_fare = 0; 
										$net_agent_comm=0;
										$net_cancel_amt=0;
										$$net_Reund=0;
									   foreach($report as $rep) { 
									   ?>
                                       <tr class="gradeX odd">
                                            <td class=" "><?php echo $i;?></td>
                                            <td class="  sorting_1"><?php echo date('d/m/Y', strtotime($rep['booked_on']));?></td>
                                            <td class=" "><?php echo $rep['tiket_no'];?></td>
                                                <td class=" ">
                                                <?php echo $rep['fromStationName'].' To '.$rep['toStationName'];?>
                                                </td>
                                                <td class="center "><?php $travels=explode('|A|',$rep['bus_provider']);  echo $travels[0];?></td>
                                                <td class="center "><?php echo $rep['travelDate'];?></td>
                                                <td class="center "><?php echo $rep['lead_pax_name'];?></td>
                                                <td class="center "><?php 									
												echo str_replace('^',',',$rep['cancel_data']); ?></td>
                                                <td class="center "><?php echo $rep['cancel_date'];?></td>
                                                <td class="center "><?php $tot_fare=0; $fare=explode('^',$rep['passenger_fare']);  $seatArray=explode(',',$seat); $seatArray1=explode(',',$rep['passenger_seat']); foreach($seatArray as $se) { $a=array_search($se,$seatArray1); $tot_fare+=$fare[$a]; } echo $tot_fare; ?></td>
												<td class="center "><?php $net_agent_comm = $net_agent_comm+$rep['agent_comm']; echo $rep['agent_comm'];?></td>
                                                <td class="center "><?php $net_cancel_amt =$net_cancel_amt+$rep['cancel_amount']; echo $rep['cancel_amount']; ?></td>
                                                <td class="center "><?php  $net_Reund = $net_Reund+$rep['RefundAmount']; echo $rep['RefundAmount']; ?></td>
                                                <td class="center "><?php echo $rep['status'];?></td>
                                                <!--<td class="center ">594.66</td>-->
                                            </tr>
                                            <?php $i++; } ?>

                                       <tr class="gradeX odd">
                                         <td colspan="9" style=" text-align:right !important;"><strong>Total</strong></td>
                                         <td class="center "><?php echo $net_tot_fare; ?></td>
                                         <td class="center "><?php echo $net_agent_comm; ?></td>
                                         <td class="center "><?php echo $net_cancel_amt; ?></td>
                                         <td class="center "><?php echo $net_Reund; ?></td>
                                         <td class="center ">&nbsp;</td>
                                       </tr>
                                                                                    </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
     
<script src="<?php echo $base_url;?>js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $base_url;?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url;?>assets/scripts.js"></script>		
<script src="<?php echo $base_url; ?>vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url; ?>assets/DT_bootstrap.js"></script>
<script>
function createXlsReport()
{
	window.open('excel_cancelation.php?from='+from+'&to='+to, 'Excel Report Generate', 'window settings');
}
function printDiv() {
	var printContents = document.getElementById('agentTicketPrint11').innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
}
</script>

                   
