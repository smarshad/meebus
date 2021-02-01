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
$report=$obj->busBookingReport_basedDate($agent_id,$from,$to);
$BookedSeatCount=0;
$total_booked_fare=0;
$total_cancel_fare=0;
$CancelSeatCount=0;
$totalRefund=0;
$totalCancellationCharge=0;
$totalCommision=0;
$totalCommisionReversal=0;
$passenger_fare = '';
$passenger_fare = array();
foreach($report as $rep)
{
	$cancelSeat=explode('^',$rep['cancel_data']); 
	$seat=explode('|A|',$rep['passenger_seat']); 
	$passenger_fare=explode('^',$rep['passenger_fare']); 
	if(isset($cancelSeat[0]) && $cancelSeat[0]!='')
	foreach($cancelSeat as $cs)
	{
		if($s=array_search($cs,$seat))
		{	
			unset($seat[$s]);
			$BookedSeatCount++;
		}
		
	}
	else
	$BookedSeatCount+=count($seat);
	
	$i=0;
	foreach($seat as $s)
	{
		$fareArray[$s]=$passenger_fare[$i];
		$i++;
	}
	$i=0;
	foreach($cancelSeat as $c )
	{
		if(isset($fareArray[$c]))
		{
		}
		else
		{
			//$total_booked_fare+=$passenger_fare[$i];
		}
		$i++;
	}
	//echo array_sum($passenger_fare).'<br/>';
	$total_booked_fare =$total_booked_fare+array_sum($passenger_fare);
	$totalCommision+=$rep['agent_comm'];
}

$report1=$obj->getbusCancelingReport($agent_id,$from,$to); 
foreach($report1 as $rep)
{
    $cancelSeat=explode('^',$rep['cancel_data']); 
	$seat=explode('|A|',$rep['passenger_seat']); 
	$passenger_fare=explode('^',$rep['passenger_fare']);
	$CancelSeatCount+=count($cancelSeat);
	$totalRefund+=$rep['RefundAmount'];
	$totalCancellationCharge+=$rep['cancel_amount'];
	$i=0;
	foreach($seat as $s)
	{
		$fareArray[$s]=$passenger_fare[$i];
		$i++;
	}
/*	echo "<pre>";
	print_r($fareArray);
	print_r($cancelSeat);
	echo "</pre>";*/
	$i=0;
	foreach($cancelSeat as $c )
	{
		if(isset($fareArray[$c]))
		{
			$total_cancel_fare+=$fareArray[$c]; 		
		}
		$i++;
	} 
	
	
	$commBySeat=explode('|A|',$rep['commBySeat']); 
	$i=0;
	foreach($seat as $s)
	{
		$commBySeatArray[$s]=$commBySeat[$i];
		$i++;
	}
	$total_commision=0;
	foreach($cancelSeat as $c )
	{
		$totalCommisionReversal+=$commBySeatArray[$c];
	}
}
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
                                <div class="muted pull-left">Booking & Cancel Commission Report</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                <div id='agentTicketPrint'>
                                <div style="background:none repeat scroll 0% 0% rgb(71, 80, 99);color: rgb(255, 255, 255);">
    <table width="100%" align="center" border="1" cellpadding="5" cellspacing="0">
      <tbody><tr>
       <td width="18%">Total Booked Seats</td>
        <td width="13%"><?php echo $BookedSeatCount; ?></td>
        <td width="18%">Total Bookings Value</td>
        <td width="13%"><?php echo $total_booked_fare; ?></td>
        <td height="30" width="18%">Total Commission</td>
        <td width="10%"><?php echo $totalCommision; ?></td>
  <td width="18%">TDS on Bookings</td>
  <td width="16%">0.00</td>
      </tr><tr>
        <td width="18%">Total Cancelled Seats</td>
        <td width="13%"><?php echo $CancelSeatCount; ?></td>
        <td height="30" width="18%">Total Cancelled Value</td>
        <td width="13%"><?php echo $total_cancel_fare; ?></td>
   <td height="30" width="18%">Total Commission Reversal</td>
        <td width="13%"><?php echo $totalCommisionReversal; ?></td>
  <td height="30" width="18%">TDS on Cancellations</td>
    <td width="10%">0</td>
      </tr>
      
      <tr>
          <td height="30" width="18%">Total Cancellation Charges</td>
          <td width="13%"><?php echo $totalCancellationCharge; ?></td>
    <td height="30" width="18%">Total Refund</td>
    <td width="16%"><?php echo $totalRefund; ?></td>
      </tr>
    </tbody></table>
  </div>
                                <h5> Booking</h5>
                                    
                                    <table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered tablescrool" id="bookingReport">
                                        <thead>
                                            <tr>
                                                <th width="9%">DOB</th>
                                                <th width="8%">Tin</th>
                                                <th width="19%">Passenger Name</th>
                                                <th width="9%">DOJ</th>
                                                <th width="11%">Travels</th>
												<th width="9%">Seats</th>
                                                <th width="10%">Route</th>
												<th width="11%">Fare</th>
												<th width="14%">Commission</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                       <?php
									   $total_fare_Sum=0; $agent_Comm=0; $agent_Comm_Sum=0; $tmpTotal=0;
									   foreach($report as $rep)
									   {
									   ?>
                                       <tr class="gradeX odd">
                                            <td class="  sorting_1"><?php echo date('d/m/Y', strtotime($rep['booked_on']));?></td>
                                            <td class=" "><?php echo $rep['tiket_no'];?></td>
                                                <td class=" ">
                                                <?php echo $rep['lead_pax_name'];?>
                                                </td>
                                                <td class="center "><?php echo $rep['travelDate'];?></td>
                                                <td class="center "><?php $travels=explode('|A|',$rep['bus_provider']);  echo $travels[0];?></td>
                                                <td class="center "><?php 
												$cancelSeat=explode('^',$rep['cancel_data']); 
												$seat=explode('|A|',$rep['passenger_seat']); 
												if(isset($cancelSeat[0]) && $cancelSeat[0]!='')
												foreach($cancelSeat as $cs)
												{
													$s=array_search($cs,$seat);
													unset($seat[$s]);
													
												}
												
												echo implode(',',$seat); ?></td>
                                                <td class="center "><?php echo $rep['fromStationName'].' to '.$rep['toStationName'];?></td>
                                                <td class="center ">
												<?php 
												$total_fare=0;
												$fareArray='';
												$fareArray = array();
													$passenger_fare=explode('^',$rep['passenger_fare']); 
													foreach($seat as $s)
													{
														$fareArray[$s]=$passenger_fare[$i];
														$i++;
													}
													$i=0;
													echo array_sum($passenger_fare);
												$tmpTotal = $tmpTotal+array_sum($passenger_fare);													
												foreach($cancelSeat as $c )	
													{
														if(isset($fareArray[$c]))
														{
														}
														else
														$total_fare+=$passenger_fare[$i];
													}
													$net_Total_fare = $net_Total_fare+$total_fare;

													$total_fare_Sum = $total_fare_Sum+$total_fare;
												?>
                                                </td>
												<td class="center "><?php echo $agent_Comm = $rep['agent_comm']; $agent_Comm_Sum = $agent_Comm_Sum+$agent_Comm; ?></td>
                                                <!--<td class="center ">594.66</td>-->
                                            </tr> <?php } ?>
                                       <tr class="gradeX odd">
                                         <td colspan="7" class="  sorting_1" style="text-align:right !important;"><strong>Total</strong></td>
                                         <td class="center "><?php echo round($tmpTotal); ?></td>
                                         <td class="center "><?php echo round($agent_Comm_Sum); ?></td>
                                         </tr>
                                           
                                        </tbody>
                                    </table>
                                    
                                     <h5> Cancellation</h5>
                                  
                                    <table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered tablescrool" id="cancelReport">
                                        <thead>
                                       
                                            <tr>
                                                <th>DOC</th>
                                                <th>Tin</th>
                                                <th>Passenger Name</th>
                                                <th>DOJ</th>
                                                <th>Travels</th>
                                                <th>Seats</th>
                                                <th>Route</th>
												<th>Fare</th>
												<th>Comm</th>
                                                <th>Cancel Charges</th>
                                                <th>Refund</th>
                                                <th>Date Of Cancel</th>
                                                <!--<th>Partner <span style="color:#FFF;">-</span>ST</th>-->
                                                                                              
           </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php  $report1=$obj->busCancelingReport($agent_id); 
										$totalsum_fare=0;
										$total_sumcommision=0;
										$cancel_amountt=0;
										$RefundAmountt=0;
									   foreach($report1 as $rep)
									   {
									   ?>
                                       <tr class="gradeX odd">
                                            <td class="  sorting_1"><?php echo date('d/m/Y', strtotime($rep['booked_on']));?></td>
                                            <td class=" "><?php echo $rep['tiket_no'];?></td>
                                                <td class=" ">
                                                <?php echo $rep['lead_pax_name'];?>
                                                </td>
                                                <td class="center "><?php echo $rep['travelDate'];?></td>
                                                <td class="center "><?php $travels=explode('|A|',$rep['bus_provider']); echo $travels[0];?></td>
                                                <td class="center "><?php 
												$cancelSeat=explode('^',$rep['cancel_data']); 
												/*$seat=explode('|A|',$rep['passenger_seat']); 
												foreach($cancelSeat as $cs)
												{
													$s=array_search($cs,$seat);
													unset($seat[$s]);
													
												}
												print_r($seat);*/
												echo implode(',',$cancelSeat); ?></td>
                                                <td class="center "><?php echo $rep['fromStationName'].' to '.$rep['toStationName'];?></td>
                                                <td class="center "><?php
												$seat=explode('|A|',$rep['passenger_seat']); 
												$passenger_fare=explode('^',$rep['passenger_fare']); 
												$i=0;
												foreach($seat as $s)
												{
													$fareArray[$s]=$passenger_fare[$i];
													$i++;
												}
												$total_fare=0;
												foreach($cancelSeat as $c )
												{
													$total_fare+=$fareArray[$c];
												}
												//print_r($fareArray);
												 echo $total_fare;
												 $totalsum_fare=$totalsum_fare+$total_fare;
												 ?></td>
												<td class="center "><?php 
												$commBySeat=explode('|A|',$rep['commBySeat']); 
												$i=0;
												foreach($seat as $s)
												{
													$commBySeatArray[$s]=$commBySeat[$i];
													$i++;
												}
												$total_commision=0;
												foreach($cancelSeat as $c )
												{
													$total_commision+=$commBySeatArray[$c];
												}
												echo $total_commision;
												$total_sumcommision=$total_sumcommision+$total_commision;?></td>
                                                <td class="center "><?php echo $rep['cancel_amount'];?></td>
                                                <?php $cancel_amountt=$cancel_amountt+$rep['cancel_amount']; ?>
                                                <td class="center "><?php echo $rep['RefundAmount'];?></td>
                                                <?php $RefundAmountt=$RefundAmountt+$rep['RefundAmount']; ?>
                                                <td class="center "><?php echo $rep['cancel_date'];?></td>
                                                <!--<td class="center ">594.66</td>-->
                                            </tr>
                                             <?php } ?>
                                       <tr class="gradeX odd">
                                         <td colspan="7" class="  sorting_1" style="text-align:right !important;"><strong>Total</strong></td>
                                         <td class="center "><?php echo round($totalsum_fare); ?></td>
                                         <td class="center "><?php echo round($total_sumcommision); ?></td>
                                         <td class="center "><?php echo round($cancel_amountt); ?></td>
                                         <td class="center "><?php echo round($RefundAmountt); ?></td>
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
function printDiv() {
	var printContents = document.getElementById('agentTicketPrint').innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
}
function createXlsReport()
{
	window.open('excel_bookcancel.php?from='+from+'&to='+to, 'Excel Report Generate', 'window settings');
}
</script>