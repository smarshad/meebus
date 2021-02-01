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
$data=array($from,$to);
$adminRes=$obj->getuserTransHistory($data); 
?>
<div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">View User</div>
                                <?php /*?><a href="javascript:void(0);" onclick="return createXlsReport('<?php echo $from;?>','<?php echo $to; ?>','<?php echo $area_id; ?>','<?php echo $channel_id; ?>','<?php echo $distributor_id; ?>');"><img style="border:0px; float:right; margin-right:10px;margin-top:10px;" border=0 src="images/excel.png" /></a> 
                                <a href="javascript:void(0);" onclick="return createPDFReport('<?php echo $from;?>','<?php echo $to; ?>','<?php echo $area_id; ?>','<?php echo $channel_id; ?>','<?php echo $distributor_id; ?>');"><img style="border:0px; float:right; margin-right:10px;margin-top:10px;" border=0 src="images/pdf.png" width="40px" /></a><?php */?>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                      <?php
											if($adminRes!='') {
												?>
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
										<thead>
                                            <tr>
                                            	<th>S. No</th>
                                                  <th>First Name</th>
                                                  <th>Mobile</th>
                                                  <th>Email Id</th>
                                                  <th>Account Balance</th>
                                                  <th>Mode</th>
                                                  <th>Amount</th>
                                                  <th>Description</th>
          									</tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
											$i=1; 
											//echo '<pre>'; print_r($adminRes); echo '</pre>';
											foreach($adminRes as $res)
											{	
												$user_id=$res['user_id'];
												$userDet=$obj->getUserById(array($user_id));
												$userDet=$userDet[0];
											?>
											<tr>
											  <td><?php echo $i; ?></td>
											  <td><?php echo $userDet['first_name']; ?></td>
											  <td><?php echo $userDet['mobile_number']; ?></td>
											  <td><?php echo $userDet['email_id'];?></td>
											  <td><?php echo $userDet['balance']; ?></td>
                                              <td><?php echo $res['mode']; ?></td>
                                              <td><?php echo $res['amount']; ?></td>
                                              <td><?php echo $res['description']; ?></td>
											<?php $i++; } ?>
                                        </tbody>
									</table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>