<?php
ob_start();
session_start();
require "../includes/pdo_connect.php";
include "../includes/cargo_functions.php";
$obj=new cargo($con); 
if (!isset($_SESSION['offid']) || !isset($_SESSION['office_name']))
{
	header("location:index.php");
}
else
{
	$offid=$_SESSION['offid'];
	$officeDetails=$obj->getOfficeDetails(array($offid));
	$officeDetails=$officeDetails[0];
	$officeLocationID=$officeDetails['location'];
	$officeloc=$obj->getCargoCities(array($officeLocationID));
	$officeloc=$officeloc[0];
	$officeLocationCode=$officeloc['code'];
	$officeLocation=$officeloc['location'];
}
$aws=$_GET['aws'];
$origin=$_GET['origin'];
$type=$_GET['type'];
$data=array($aws,$origin,$type);
$res=$obj->getOffShipmentDestinationTrack($data);

?>
<div class="page-scroll">
                            <table cellpadding="0" cellspacing="0" border="0" class="table-border" width="100%">
                                <thead>
                                    <tr>
                                    <td><strong>S.No</strong></td>
                                    <td><strong>Reference No</strong></td>
                                    <td><strong>AWS No</strong></td>
                                    <td><strong>Consignor Info</strong></td>
                                    <td><strong>Consignee Info</strong></td>
                                    <td><strong>Insurance Status</strong></td>
                                    <td><strong>Origin</strong></td>
                                    <td><strong>Destination</strong></td>
                                    <td><strong>Service Type</strong></td>
                                    <td><strong>Package Type</strong></td>
                                    <td><strong>Package Measurement (lXwXh)</strong></td>
                                    <td><strong>Package Weight</strong></td>
                                    <td><strong>Quantity</strong></td>
                                    <td><strong>Total Price</strong></td>
                                    <td><strong>Delivery Type</strong></td>
                                    <td><strong>Expected Delivery Date</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
										$i=1;
										//echo "<pre>"; print_r($res); echo "</pre>";
										foreach($res as $cargo) 
										{
									?>
                                	 <tr>
                                     <td><?php echo $i;?></td>
                                     <td><?php echo $cargo['ref_no'];?></td>
                                     <td><?php  echo $cargo['aws_no'];?></td>
                                     <td><?php  echo $cargo['consignor_name'] .', <br />'. 
									 				 $cargo['consignor_address'] .', <br />'. 
													 $cargo['consignor_pincode'] .', <br />'.
													 $cargo['consignor_email'] .', <br />'.
													 $cargo['consignor_phone'] .', <br />'.
													 $cargo['consignor_mobile'];?></td>
                                     <td><?php  echo $cargo['consignee_name'] .', <br />'. 
									 				 $cargo['consignee_address'] .', <br />'. 
													 $cargo['consignee_pincode'] .', <br />'.
													 $cargo['consignee_email'] .', <br />'.
													 $cargo['consignee_phone'] .', <br />'.
													 $cargo['consignee_mobile'];?></td>
                                     <td><?php  if($cargo['insurance_status']==1)
									 			{
													echo "Insured";
												}
												else
												{
													echo "Not Insured";
												}
												?></td>
                                     <td><?php  echo $cargo['origin'];?></td>
                                     <td><?php  echo $cargo['destination'];?></td>
                                     <td><?php  echo $service=$obj->getServiceType(array($cargo['serviceTypeCode'])); ?></td>
                                     <td><?php  echo $pack=$obj->getPackageType(array($cargo['typeofPackageCode']));?></td>
                                     <td><?php  echo $cargo['length'] .' X '. $cargo['width'] .' X '. $cargo['height'];?></td>
                                     <td><?php  echo $cargo['weight'];?></td>
                                     <td><?php  echo $cargo['quantity'];?></td>
                                     <td><?php  echo $cargo['totalPrice'];?></td>
                                     <td><?php  if($cargo['deliveryType']=='RC')
									 			{
													echo "Recived By Consignee";
												}
												else
												{
													echo "Door Delivery";
												}
									 ?></td>
                                     <td><?php  echo "";?></td>
                                    </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                            
                            </div>