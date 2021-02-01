<?php
include '../includes/pdo_connect.php';
include '../includes/cargo_functions.php';
$obj=new cargo($con);
include_once("includes/header_pdo.php");
$officeid=$_SESSION['offid'];
if(isset($_POST['submit']) && $_POST['submit']=='Search')
{
	$aws_no=$_POST['srch'];
	$data1=array($officeid,$aws_no,'In Transit');
	$cark=$obj->getAwsnolist($data1);
	$cark=$cark[0];
	$awsnoss=$cark['aws_no'];
	$datas=array($officeid,$awsnoss,'In Transit');
	$cark=$obj->getAwsnodet($datas);
	$data=$cark['0'];
}
if(isset($_POST['submit']) && $_POST['submit']=='Receive')
{
	$awsnos=$_POST['awsnos'];
	$cark=$obj->updateAwsnolist(array($awsnos));
	$cargo=$obj->updateStatCargo(array($awsnos));
	header('location:receive-shipment.php');
}
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
<body onLoad="search_Usr();">

<fieldset class="table-bor">
<legend><strong>Receive Shipment </strong></legend> 
<form action="" method="post" autocomplete="off">
  <table border="0" align="center" width="98%">
    <tbody>
    <tr>
      <td class="Partext1" align="right"><strong> AWS Number</strong></td>
       <td><input type="text" name="srch" style="width: 50%;"></td>
    </tr>
    <tr>
      <td class="Partext1" align="center"></td>
       <td><input type="submit" name="submit" value="Search"></td>
    </tr>
  </tbody>
 </table>
 </form>		
	
<?php if(isset($data['id']) && $data['id']!='') { ?>	
<div class="order-details-MP order-details-bottom tmargin20">
   <div class="orderDetails-tracking tmargin10 line">
   <form method="post" action="" autocomplete="off">
      <table class="order-details-table bmargin15" width="100%" cellspacing="0" cellpadding="0" align="left">
         <tbody>
            <tr class="caption nondigital order_item_row_0" align="left">
               <th colspan="5" class="vtop product-info" align="left">
                  <div class="table-head clearfix">
                     <div class="heads prod"> <span class="text">Consignor Name</span> </div>
                     <div class="heads line gran"><div class="detail appr">APPROVAL</div></div>
                     <div class="heads del"> <span class="text">Consignee Name</span> </div>
                     <div class="heads del"> <span class="text">Details</span> </div>
                     <div class="heads sub"> <span class="text">Select Detination</span> </div>
                  </div>
               </th>
            </tr>
            <!-- List of items to display --> 
            <h4>AWS Number : <?php echo $data['aws_no']; ?></h4>
				  <h5>Reference Number : <?php echo $data['ref_no']; ?></h5>
            <tr class="order_item_row_1" align="left">
               <!-- Column 1 --> 
               <td class="vtop item-details" width="25%">
                  <div class="line">                
                     <div class="unit item-img-div fk-text-center"> 
                    <h6>Name: <?php echo $data['consignor_name']; ?></h6>
                    <h6>Address: <?php echo $data['consignor_address']; ?></h6>
                    <h6>Pincode:  <?php echo $data['consignor_pincode']; ?></h6>
                    <h6>Email:  <?php echo $data['consignor_email']; ?></h6>
                    <h6>Phone:  <?php echo $data['consignor_phone']; ?></h6>
                    <h6>Mobile:  <?php echo $data['consignor_mobile']; ?></h6>
                      </div>                     
                  </div>
               </td>
               <!-- Column 2 --> 
               <td class="vtop item-shipment" width="10%">
                  <div class="rposition">
                      <h3><?php echo $data['status']; ?></h3>
                  </div>
               </td>
               <!-- Column 3 --> 
               <td class="vtop item-shipment" width="23%">
                  <div class="graph lpadding10 tpadding5">
                     <div class="unit item-img-div fk-text-center">
                     <h6>Name : <?php echo $data['consignee_name']; ?></h6>
                     <h6>Address : <?php echo $data['consignee_address']; ?></h6>
                     <h6>Pincode : <?php echo $data['consignee_pincode']; ?></h6>
                     <h6>Email : <?php echo $data['consignee_email']; ?></h6>
                     <h6>Phone : <?php echo $data['consignee_phone']; ?></h6>
                     <h6>Mobile : <?php echo $data['consignee_mobile']; ?></h6>
                     </div>
                  </div>
               </td>
               <td class="vtop item-shipment" width="23%">
                  <div class="graph lpadding10 tpadding5">
                     <div class="unit item-img-div fk-text-center">
                     <h6>Orgin :  <?php echo $data['origin']; ?></h6>
                     <h6>Destination : <?php echo $data['destination']; ?></h6>
                     <h6>Width : <?php echo $data['width']; ?></h6>
                     <h6>Height : <?php echo $data['height']; ?></h6>
                     <h6>Quantity : <?php echo $data['quantity']; ?></h6>
                     <h6>Price/ Kg : <?php echo $data['priceperKG']; ?></h6>
                     <h6>Total Price : <?php echo $data['totalPrice']; ?></h6>
                     </div>
                  </div>
               </td>
               <!-- Column 4 --> 
               <td class="vtop item-details" width="20%">
               <form action="" method="post">
                  <input type="hidden" name="awsnos" value="<?php echo $data['aws_no']; ?>" />
                  <input type="submit" name="submit" value="Receive" class="btn-medium btn-blue btn" />         
                </form>  
               </td>
            </tr>
            <tr>
               <td class="all-buttons" colspan="5">
                  <ul class="fk-inline-block tmargin20 buttons-list clearfix">
                     <li class="send_shipdet">
                    Insurance : <?php echo $data['insurance_details']; ?>
                     </li>
                     <li class="send_shipdet">
                    Type : <?php echo $data['transferType']; ?>
                     </li>
                     <li class="send_shipdet">
                    Service Type : <?php echo $data['serviceTypeCode']; ?>
                     </li>
                     <li class="send_shipdet">
                    Type Of Package Code : <?php echo $data['typeofPackageCode']; ?>
                     </li>
                     <li class="send_shipdet">
                    Measurement Mode <?php echo $data['measurementMode']; ?>
                     </li>
                     <li class="send_shipdet">
                    Length : <?php echo $data['length']; ?>
                     </li>
                     <li class="send_shipdet">
                    Weight : <?php echo $data['weight']; ?>
                     </li>
                     <li class="send_shipdet">
                    Surface Weight : <?php echo $data['volumetric_surface_weight']; ?>
                     </li>
                     <li class="send_shipdet">
                    Air Weight : <?php echo $data['volumetric_air_weight']; ?>
                     </li>
                     <li class="send_shipdet">
                    Chargeable Weight : <?php echo $data['chargeable_weight']; ?>
                     </li>                     
                     <li class="send_shipdet">  
                    Delivery Type : <?php echo $data['deliveryType']; ?>
                     </li>
                     <li class="send_shipdet">  
                    Delivery Date : <?php echo $data['delivery_date']; ?>
                     </li>                     
                  </ul>
               </td>
            </tr>
         </tbody>
      </table>
      </form>
   </div>
</div>	
<?php } else { ?> 
<style>.norec tbody{height:35px; text-align:center}</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="norec table-border">
<tbody>
  <tr>
    <td align="center"><strong>No Record Found</strong></td>
  </tr>
  </tbody>
</table>
<?php } ?>
		</fieldset>
</body>
<?php include "includes/footer.php"; ?>