<?php  
include_once'../../server/server.php';   
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php'); }
include '../includes/functions.php';
$obj=new agent_module($con);
$_SESSION['common']['pagename'] = "Summary Report";
$agent_id=$_SESSION['agent']['log']['id'];
$tdate = explode('/', $_GET['from']);
$from = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];
$tdate = explode('/', $_GET['to']);
$to = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];

$file="Cancel_Excel_Report_".date('d_m_Y_h_i_s_A',time()).".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");

?>
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
  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered tablescrool" id="cancelReport">
                                        <thead>
                                       
                                            <tr>
                                                <th>SNo</th>
                                                <th>DOC</th>
                                                <th>Ticket No</th>
                                                <th>Source <br/> Destination</th>
                                                <th>Travels</th>
                                                <th>DOJ</th>
                                                 <th>Pax Name</th>
												<th>Seat No</th>
                                                <th>DOC</th>
                                                <th>Fare</th>
                                                <th>Commn</th>
                                                <th>Cancel Charge</th>
												<th>Refund Amt</th>
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
										$net_Reund=0;
									   foreach($report as $rep)
									   {
									   ?>
                                       <tr class="gradeX odd">
                                            <td class=" "><?php echo $i;?></td>
                                            <td class="  sorting_1"><?php echo date('d/m/Y', strtotime($rep['booked_on']));?></td>
                                            <td class=" "><?php echo $rep['tiket_no'];?></td>
                                                <td class=" "><?php echo $rep['fromStationName'].' To '.$rep['toStationName'];?></td>

                                                <td class="center "><?php $travels=explode('|A|',$rep['bus_provider']);  echo $travels[0];?></td>
                                                <td class="center "><?php echo $rep['travelDate'];?></td>
                                                <td class="center "><?php echo $rep['lead_pax_name'];?></td>
                                                <td class="center "><?php 									
												echo $seat=str_replace('^',',',$rep['cancel_data']); ?></td>
                                                <td class="center "><?php echo $rep['cancel_date'];?></td>
												<td class="center ">
												<?php $tot_fare=0; $fare=explode('^',$rep['passenger_fare']);  $seatArray=explode(',',$seat); $seatArray1=explode(',',$rep['passenger_seat']); foreach($seatArray as $se) { $a=array_search($se,$seatArray1); $tot_fare+=$fare[$a]; } $net_tot_fare= $net_tot_fare+$tot_fare;  echo $tot_fare; ?></td>
                                                <td class="center "><?php $net_agent_comm = $net_agent_comm+$rep['agent_comm']; echo $rep['agent_comm'];?></td>
                                                <td class="center "><?php $net_cancel_amt =$net_cancel_amt+$rep['cancel_amount']; echo $rep['cancel_amount']; ?></td>
                                                
                                                <td class="center "><?php $net_Reund = $net_Reund+$rep['RefundAmount']; echo $rep['RefundAmount']; ?></td>
                                                <td class="center "><?php echo $rep['status'];?></td>
                                                <!--<td class="center ">594.66</td>-->
                                            </tr><?php $i++; } ?>
                                       <tr class="gradeX odd">
                                         <td colspan="9" class="" style=" text-align:right !important;"><strong>Total</strong></td>
                                         <td class="center "><?php echo $net_tot_fare; ?></td>
                                         <td class="center "><?php echo $net_agent_comm; ?></td>
                                         <td class="center "><?php echo $net_cancel_amt; ?></td>
                                         <td class="center "><?php echo $net_Reund; ?></td>
                                         <td class="center ">&nbsp;</td>
                                       </tr>
                                            
                                        </tbody>
                                    </table>
