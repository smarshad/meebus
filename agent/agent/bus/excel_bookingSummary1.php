<?php  
include_once'../../server/server.php';   
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php'); }
include '../includes/functions.php';
$obj=new agent_module($con);
$_SESSION['common']['pagename'] = "Booking Summary Report";
$agent_id=$_SESSION['agent']['log']['id'];

$file="Booking_Summary_Excel_Report_".date('d_m_Y_h_i_s_A',time()).".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");

?>
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
                                        <?php  $report=$obj->busBookingReport($agent_id);
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
                                            <td class=" "><?php echo "'".$rep['tiket_no']."'";?></td>
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
												<td style="border-top:2px solid #3366cc;"><?php echo round($serviceCharge); ?></td>
                                           </tr>
                                        </tbody>
                                    </table>
