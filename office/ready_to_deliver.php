<?php
include '../includes/pdo_connect.php';
include '../includes/cargo_functions.php';
$obj=new cargo($con);
include_once("includes/header_pdo.php");
$officeid=$_SESSION['offid'];
$officeLoc[]=$officeLocationCode;
$officeLoc[]=$officeLocation;
$offLoc=implode('-',$officeLoc);
$data=array('Arrived',$offLoc,$officeid);
$packages=$obj->getArrivedPackages($data);
//echo "<pre>"; print_r($packages); echo "</pre>";
?>
<style>
	.fk-text-center{text-align:left}
	.order-details-MP .orderDetails-tracking .item-img-div{width:250px}
	.unit h6{margin:5px 0;font-size:12px}
	.order_item_row_0 .vtop.product-info .prod {width: 25%;}				  
	.order_item_row_0 .vtop.product-info .gran {width: 8%;}
	.order_item_row_0 .vtop.product-info .del {width: 22%;}
	.order_item_row_0 .vtop.product-info .sub {width: 17%;}
	li.send_shipdet{width:25%;float:left;padding:10px 0}
	.tt-dropdown-menu {top: 38px !important;width: 173px;}
</style> 
<fieldset class="table-bor">
<legend><strong>Ready to Delivery Packages</strong></legend> 
  <table border="1" align="center" width="100%">
  <thead>
  <tr>
  <th>Package Id</th>
  <th>Reference No</th>
  <th>AWS No</th>
  <th>Shipped From</th>
  <th>Send To</th>
  <th>Consignor Detail</th>
  <th>Consignee Detail</th>
  <th>Service Type</th>
  <th>Package Type</th>
  <th>Delivery Type</th>
  <th>Status</th>
  <th>&nbsp;</th>
  </tr>
  </thead>
    <tbody>
    <?php foreach ($packages as $pack) { ?>
    <tr>
      <td><?php echo $pack['id']; ?></td>
      <td><?php echo $pack['ref_no']; ?></td>
      <td><?php echo $pack['aws_no']; ?></td>
      <td><?php echo $pack['origin']; ?></td>
      <td><?php echo $pack['destination']; ?></td>
      <td><?php echo $pack['consignor_name']. ', <br />' .
	  				 $pack['consignor_address']. ', <br />' .
					 $pack['consignor_pincode']. ', <br />' .
					 $pack['consignor_email']. ', <br />' .
					 $pack['consignor_mobile']; ?></td>
      <td><?php echo $pack['consignee_name']. ', <br />' .
	  				 $pack['consignee_address']. ', <br />' .
	  				 $pack['consignee_pincode']. ', <br />' .
	  				 $pack['consignee_email']. ', <br />' .
	  				 $pack['consignee_mobile']; ?></td>
      <td><?php echo $pack['serviceTypeCode']; ?></td>
      <td><?php echo $pack['typeofPackageCode']; ?></td>
      <td><?php if($pack['deliveryType']=='RC')
	  			{	
	  				echo "Received By Consignee";
	  			}
				else
				{
					echo "Door Delivery";
				}
				?></td>
      <td><?php echo $pack['status']; ?></td>
      <td><input type="" ></td>
    </tr>
    <?php }?>
  </tbody>
 </table>	
</fieldset>
</body>
<?php include "includes/footer.php"; ?>