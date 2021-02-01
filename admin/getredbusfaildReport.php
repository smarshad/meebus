<?php  
include_once'../server/server.php';  
include_once 'includes/functions.php';
$obj=new admin_module($con);  
$from_date1=explode('/',$_GET['from']);
$from_date = $from_date1[2].'-'.$from_date1[1].'-'.$from_date1[0];
$from=$from_date.' 00:00:00';
$to_date1=explode('/',$_GET['to']);
$to_date = $to_date1[2].'-'.$to_date1[1].'-'.$to_date1[0];
$to=$to_date.' 23:59:59';
$data=array('Cancelled',$from,$to);
$result=$obj->getuserbookedreportdetails($data);



?>
<div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">ETS Bus Failed Report</div>
                                <?php /*?><a href="javascript:void(0);" onclick="return createXlsReport('<?php echo $from;?>','<?php echo $to; ?>','<?php echo $area_id; ?>','<?php echo $channel_id; ?>','<?php echo $distributor_id; ?>');"><img style="border:0px; float:right; margin-right:10px;margin-top:10px;" border=0 src="images/excel.png" /></a> 
                                <a href="javascript:void(0);" onclick="return createPDFReport('<?php echo $from;?>','<?php echo $to; ?>','<?php echo $area_id; ?>','<?php echo $channel_id; ?>','<?php echo $distributor_id; ?>');"><img style="border:0px; float:right; margin-right:10px;margin-top:10px;" border=0 src="images/pdf.png" width="40px" /></a><?php */?>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                      <?php
											if($result!='') {
												?>
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>S. No</th>
                                                  <th>Status</th>
                                                  <th>From</th>
                                                  <th>To</th>
                                                  <th>Seats</th>
                                                 <th>Booked On</th>
                                                  <th>Travel Date</th>
                                                  <th>Lead Pax Name</th>
                                                  <th>PNR</th>
                                                  <th>Mobile Number</th>
                                                  <th>Email Id</th>
                                                  <th>Total Fare</th>
											</tr>
										</thead>
										<tbody> 	 
                                        		<?php
												
												
												$i=1; 
												//echo '<pre>';print_r($adminRes);echo '</pre>';
												foreach($result as $res)
												{	
												?>
												<tr>
												  <td><?php echo $i; ?></td>
												  <td><?php echo $res['status']; ?></td>
												  <td><?php echo $res['fromStationId']; ?> </td>
												  <td><?php echo $res['toStationId']; ?></td>
												  <td><?php echo $res['passenger_seat'];?></td>
												  <td><?php echo $res['booked_on']; ?></td>
												  <td><?php echo $res['travelDate']; ?></td>
												  <td><?php echo $res['lead_pax_name']; ?></td>
												  <td><?php echo $res['PNR'];?></td>
												  <td><?php echo $res['mobileNbr']; ?></td>
												  <td><?php echo $res['emailId']; ?></td>
												  <td><?php echo $res['total_fare']; ?></td> 
												<?php $i++; }  }

											else
											{
												echo 'No Record Found';
											}
											
												?>
										</tbody>
									</table>
                                </div>
                            </div>
                        </div>
						
