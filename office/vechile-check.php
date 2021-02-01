<?php
include_once("includes/header.php");
include_once("../includes/pdo_connect.php");
include_once("../includes/cargo_functions.php");
$obj=new cargo($con);
$officeid=$_SESSION['offid'];
$getVechilelist=$obj->getVechilelists(array($officeid,$officeid));
//print_r($getVechilelist);exit;
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
	thead{background: #f5f5f5;color: #000;height: 30px;text-align: center;}
	tbody{color: #000;height: 32px;}
</style>  
<script src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/typeahead.min.js"></script>
<body onLoad="search_Usr();">

<fieldset class="table-bor">
<legend><strong>Vehicle Transit Report</strong></legend> 
<div class="order-details-MP order-details-bottom tmargin20">
   <div class="orderDetails-tracking tmargin10 line">
   <form method="post" action="" autocomplete="off">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" class="table-border">
        <thead>      
          <tr>
          	<td><strong>S. No</strong></td>
            <td><strong>Vehicle Number</strong></td>
            <td><strong>Vehicle Name</strong></td>
            <td><strong>Fuel Level</strong></td>
            <td><strong>From Place</strong></td>
            <td><strong>To Place</strong></td>
            <td><strong>Status</strong></td>
          </tr>
        </thead>
        <tbody>
<?php $i=1; foreach($getVechilelist as $vecList) { ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php $vechid=$vecList['vehicle_id'];
			$vechiledet=$obj->getVechiledets(array($vechid));
			$vechiledet=$vechiledet[0];
			echo $vechiledet['vehicle_number'];
			 ?></td>
            <td><?php echo $vechiledet['vehicle_name']; ?></td>
            <td><?php echo $vechiledet['currentFuel_level']; ?></td>
            <td><?php $sr=$vecList['source'];
			$srplace=$obj->getcityss(array($sr));
			$srplace=$srplace[0];
			echo $srplace['location'];
			 ?></td>
            <td><?php $des=$vecList['destination'];
			$drplace=$obj->getcityss(array($des));
			$drplace=$drplace[0];
			echo $drplace['location'];
			?></td>
            <td><?php echo $vecList['status']; ?></td>
          </tr>
<?php $i++; } ?>          
        </tbody>
        </table>
      </form>
   </div>
</div>	
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
$('#destn').typeahead({
    name: 'vecle_det',
	 remote: {
            url : '../includes/source.php?query=%QUERY'
        },
    minLength: 3, // send AJAX request only after user type in at least 3 characters
    limit: 10 // limit to show only 10 results
});
</script>