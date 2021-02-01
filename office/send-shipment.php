<?php
include_once("includes/header.php");
include_once("../includes/pdo_connect.php");
include_once("../includes/cargo_functions.php");
$obj=new cargo($con);
$officeid=$_SESSION['offid'];
if(isset($_POST['submit']) && $_POST['submit']=='Search')
{
	$aws_no=$_POST['srch'];
	$result=mysql_query("SELECT * FROM cargo WHERE aws_no='$aws_no' AND status='Pending'");	 
	$count=mysql_num_rows($result);
	if($count==0)
	{		
		$trackRes=mysql_query("SELECT * FROM cargotracking WHERE aws_no='$aws_no' AND NextLocation='$officeid' AND status='Arrived'");	
		$trackRescount=mysql_num_rows($trackRes);
		if($trackRescount!=0)
		{
			//echo "SELECT * FROM cargo WHERE aws_no='$aws_no'";exit;
			$result=mysql_query("SELECT * FROM cargo WHERE aws_no='$aws_no'");	  
		}
	}
}
if(isset($_POST['submit']) && $_POST['submit']=='Send')
{
	$send_shipp=$_POST['send_shipp'];
	$lastLocation=$_POST['lastLocation'];
	$nextLocation=$_POST['nextLocation'];
	$vec_id=$_POST['vec_id'];
	$aws_no=$_POST['aws_no'];
	$departDateTime=date('Y-m-d H:i:s');
	$expectedArrivalDate=date('Y-m-d',strtotime($departDateTime . '+1 day'));
	//echo "INSERT INTO cargotracking (aws_no,lastLocation,NextLocation,departDateTime,expectedArrivalDate,vechile_id,status) VALUES ('$aws_no','$lastLocation','$nextLocation','$departDateTime','$expectedArrivalDate','$vec_id','In Transit')";exit;
	$inst=mysql_query("INSERT INTO cargotracking (aws_no,lastLocation,NextLocation,departDateTime,expectedArrivalDate,vechile_id,status) VALUES ('$aws_no','$lastLocation','$nextLocation','$departDateTime','$expectedArrivalDate','$vec_id','In Transit')");	
	
	$update=mysql_query("UPDATE cargo SET status='In Transit' WHERE aws_no='$aws_no'"); 
	header('location:send-shipment.php');
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
<script src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/typeahead.min.js"></script>
<body onLoad="search_Usr();">

<fieldset class="table-bor">
<legend><strong>Send Shipment </strong></legend> 
<form action="" method="post" autocomplete="off">
  <table border="0" align="center" width="98%">
    <tbody>
    <tr>
      <td class="Partext1" align="right"><strong> AWS Number</strong></td>
       <td><input type="text" name="srch" style="width: 50%"></td>
    </tr>
    <tr>
      <td class="Partext1" align="center"></td>
       <td><input type="submit" name="submit" value="Search"></td>
    </tr>
  </tbody>
 </table>
 </form>		

<?php if(isset($_POST['submit']) && $_POST['submit']=='Search') { 
while($data = mysql_fetch_array($result))
{ 
//echo "<pre>";print_r($data);echo "</pre>";exit;
?>	
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
            !-- Column 2 --> 
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
               <?php $orig=explode('-',$data['origin']); 
			   		 $origId=$orig[0];
			   		 $query=mysql_query("SELECT id FROM cargo_cities WHERE code='$origId'");
					 $lastLocId=mysql_fetch_object($query);
					 
					 $dest=explode('-',$data['destination']); 
			   		 $destId=$dest[0];
			   		 $query=mysql_query("SELECT id FROM cargo_cities WHERE code='$destId'");
					 $nextLocId=mysql_fetch_object($query);
			   ?>
               <td class="vtop item-details" width="20%">
                  <input type="text" name="send_shipp" id="origin" placeholder="Destination" /> <br/>
                  <input type="button" name="checkVehicles" id="checkVehicles" placeholder="Destination" value="Check Vehicles"></input>
                  <div id="vehList">
                  </div>
                  <br/>
                  <input type="hidden" name="lastLocation" value="<?php echo $lastLocId->id; ?>" />
                  <input type="hidden" name="nextLocation" value="<?php echo $nextLocId->id; ?>" />
                  <input type="hidden" name="aws_no" value="<?php echo $data['aws_no']; ?>" />
                  <input type="submit" name="submit" value="Send" class="btn-medium btn-blue btn" />         
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
<?php }
if($trackRescount==0)
{ ?>
	<table border="0" align="center" width="98%">
    <tbody>
    <tr>
      <td class="Partext1" colspan="2" bgcolor="F9F5F5" align="center"><strong> Your Searching Package Not Available In Your Location</strong></td>
    </tr>
	</tbody>
	</table>
    <?php 
}
} ?>
		</fieldset>
</body>
<?php include "includes/footer.php"; ?>
<script>
$('#origin').typeahead({
    name: 'cabdest',
	 remote: {
            url : '../includes/source.php?query=%QUERY'
        },
    minLength: 3, // send AJAX request only after user type in at least 3 characters
    limit: 10 // limit to show only 10 results
});
$( "#checkVehicles" ).click(function() {
	var origin=$("#origin").val();
  	$.post( "listAvailVeh.php?origin="+origin, function( data ) {
	  $( "#vehList" ).html( data );
	});
});
</script>