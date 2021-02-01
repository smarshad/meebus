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
                                <div class="muted pull-left">Booking & Cancel Discount Report</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                <h5> Booking</h5>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered tablescrool" id="bookingReport">
                                        <thead>
                                            <tr>
                                                <th>DOI</th>
                                                <th>Tin</th>
                                                <th>Passenger Name</th>
                                                <th>DOJ</th>
                                                <th>Travels</th>
												<th>Seats</th>
                                                <th>Route</th>
												<th>Fare</th>
												<th>Discount</th>
                                                <th>BookingBy</th>
                      						</tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php  $report=$obj->getbusBookingReport($agent_id,$from,$to);
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
												foreach($cancelSeat as $cs)
												{
													$s=array_search($cs,$seat);
													unset($seat[$s]);
													
												}
												
												echo implode(',',$seat); ?></td>
                                                <td class="center "><?php echo $rep['fromStationName'].' to '.$rep['toStationName'];?></td>
                                                <td class="center "><?php echo $rep['total_fare'];?></td>
												<td class="center "><?php echo 0;?></td>
                                                <td class="center "><?php echo $_SESSION['agent']['log']['agency_name'];?></td>
                                                <!--<td class="center ">594.66</td>-->
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                     <h5> Cancellation</h5>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered tablescrool" id="cancelReport">
                                        <thead>
                                       
                                            <tr>
                                                <th>DOI</th>
                                                <th>Tin</th>
                                                <th>Passenger Name</th>
                                                <th>DOJ</th>
                                                <th>Travels</th>
                                                <th>Seats</th>
                                                <th>Route</th>
												<th>Fare</th>
												<th>Discount</th>
												<th>Cancel Charges</th>
                                                <th>Refund</th>
                                                <th>Booking By</th>
                                                <th>Cancelled By</th>
                                                <th>Date Of Cancel</th>
                                                <!--<th>Partner <span style="color:#FFF;">-</span>ST</th>-->
                                                                                              
           </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php  $report=$obj->getbusCancelingReport($agent_id,$from,$to);
									   foreach($report as $rep)
									   {
										  //echo "<pre>"; print_r($rep); echo "</pre>";
									   ?>
                                       <tr class="gradeX odd">
                                            <td class="  sorting_1"><?php echo date('d/m/Y', strtotime($rep['booked_on']));?></td>
                                            <td class=" "><?php echo $rep['tiket_no'];?></td>
                                                <td class=" ">
                                                <?php echo $rep['lead_pax_name'];?>
                                                </td>
                                                <td class="center "><?php echo $rep['travelDate'];?></td>
                                                <td class="center "><?php $travelsbUS=explode('|A|',$rep['bus_provider']); echo $travelsbUS[0];?></td>
                                                <td class="center "><?php 
												$cancelSeat=explode('^',$rep['cancel_data']); 
												$seat=explode('|A|',$rep['passenger_seat']); 
												foreach($cancelSeat as $cs)
												{
													$s=array_search($cs,$seat);
													unset($seat[$s]);
													
												}
												
												echo implode(',',$seat); ?></td>
                                                <td class="center "><?php echo $rep['fromStationName'].' to '.$rep['toStationName'];?></td>
                                                <td class="center "><?php echo $rep['total_fare'];?></td>
												<td class="center "><?php echo 0;?></td>
                                                <td class="center "><?php echo $rep['cancel_amount'];?></td>
                                                <td class="center "><?php echo $rep['RefundAmount'];?></td>
                                                <td class="center "><?php echo $_SESSION['agent']['log']['agency_name'];?></td>
                                                <td class="center "><?php echo $_SESSION['agent']['log']['agency_name'];?></td>
                                                <td class="center "><?php echo $rep['cancel_date'];?></td>
                                                <!--<td class="center ">594.66</td>-->
                                            </tr>
                                            <?php } ?>
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
