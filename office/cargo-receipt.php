<?php
include '../includes/pdo_connect.php';
include '../includes/cargo_functions.php';
$obj=new cargo($con);
include_once("includes/header_pdo.php");
if(isset($_GET['awsNO']))
{
	$aws_no=trim($_GET['awsNO']);
	$cark=$obj->getCargoReceipt(array($aws_no));
	$data=$cark['0'];
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
<script type="text/javascript">
function printthis()
{
 var w = window.open('', '', 'width=800,height=600,resizeable,scrollbars');
 w.document.write($("#table1").html());
 w.document.close(); // needed for chrome and safari
 javascript:w.print();
 w.close();
 return false;
}
</script>
<body>
	
<div class="order-details-MP order-details-bottom order-actions">
   <div class="table-head padding10">
      ORDER RECEIPT
   </div>
   <ul class="line">
      <li class="unit" style="width:32.333333333333%"> 
     <!--a id="print-order" alt="Print this page"> <i id="print"></i>PRINT ORDER </a-->
     <a href="#" onClick="printthis(); return false;> <i id="print"></i>PRINT ORDER </a> 
      </li>
      <li class="unit" style="width:32.333333333333%"> 
      <a class="invoice"> <i id="invoice"></i>EMAIL INVOICE </a> 
      </li>
      <li class="unit last" style="width:32.333333333333%"> 
      <a href="#"><i id="contact-us"></i>CONTACT US</a> 
      </li>
   </ul>
</div>
<div class="order-details-MP order-details-bottom tmargin20" id="table1">
   <div class="orderDetails-tracking tmargin10 line">
   <div class="unit size1of4"> <a class="orderIdBtn btn btn-medium btn-blue" target="_blank" href="#"><?php echo $data['aws_no']; ?></a> </div>
   <form method="post" action="" autocomplete="off">
      <table class="order-details-table bmargin15" width="100%" cellspacing="0" cellpadding="0" align="left">
         <tbody>
            <tr class="caption nondigital order_item_row_0" align="left">
               <th colspan="5" class="vtop product-info" align="left">
                  <div class="table-head clearfix">
                     <div class="heads prod"> <span class="text">Consignor Name</span> </div>
                     <div class="heads line gran"><div class="detail appr">STATUS</div></div>
                     <div class="heads del"> <span class="text">Consignee Name</span> </div>
                     <div class="heads del"> <span class="text">Details</span> </div>
                  </div>
               </th>
            </tr>
            <!-- List of items to display --> 
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
                  Amount : Rs.<strong><?php echo $data['totalPrice'];?></strong>         
                </form>  
               </td>
            </tr>
            <tr>
               <td class="all-buttons" colspan="5">
                  <ul class="fk-inline-block tmargin20 buttons-list clearfix">
                     <li class="send_shipdet">
                    Insurance : <?php if($data['insurance_status']==0) echo 'NA'; else echo $data['insurance_details']; ?>
                     </li>
                     <li class="send_shipdet">
                    Package Type : <?php echo $data['typeofPackageCode']; ?>
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
                    Length : <?php echo $data['length'].' '.$data['measurementMode']; ?>
                     </li>
                     <li class="send_shipdet">
                    Weight : <?php echo $data['weight'].' '.$data['measurementMode']; ?>
                     </li>
                     <li class="send_shipdet">
                    Surface Weight : <?php echo $data['volumetric_surface_weight'].' KG'; ?>
                     </li>
                     <li class="send_shipdet">
                    Air Weight : <?php echo $data['volumetric_air_weight'].' KG'; ?>
                     </li>
                     <li class="send_shipdet">
                    Chargeable Weight : <?php echo $data['chargeable_weight'].' KG'; ?>
                     </li>                     
                     <li class="send_shipdet">  
                    Delivery Type : <?php if($data['deliveryType']=='DD') echo 'DOOR DELIVERY'; else echo 'RECEIVE BY CONSIGNEE'; ?>
                     </li>
                     <li class="send_shipdet">  
                    Delivery Date : <?php if($data['delivery_date']=='0000-00-00') echo 'NA'; else echo $data['delivery_date']; ?>
                     </li>                     
                  </ul>
               </td>
            </tr>
         </tbody>
      </table>
      </form>
   </div>
</div>	
</body>
<?php include "includes/footer.php"; ?>